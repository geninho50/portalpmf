<?php
session_start();
require_once(CAMINHO_SITE . "/scripts/php/funcoes_bd.php");
require_once('../scripts/js/fckeditor/fckeditor.php'); // Preservado fckeditor
$drive->conecta();

/*==========================================================================
1. INCLUSÃO DO PROCESSAMENTO (POST)
==========================================================================*/
if (isset($_POST["btSalvar"]) || isset($_POST["btSalvar_x"])) {
    include("noticias/php/php_noticia.php");
}

/*==========================================================================
2. CONTROLE DE FLUXO (INCLUIR VS EDITAR)
==========================================================================*/
$noticiaId = isset($_GET['n']) ? (int)$_GET['n'] : 0;
$Tnoticia = null;

if ($noticiaId === 0) {
    $Ttitulo = "incluir notícia";
} else {
    $Ttitulo = "editar notícia";
    $sqlNoti = "SELECT * FROM noticias WHERE noti_id = $noticiaId";
    $TbuscaNot = $drive->pedido($sqlNoti);
    if ($TbuscaNot) {
        $Tnoticia = pg_fetch_object($TbuscaNot);
    }
}

/*==========================================================================
3. CONSULTAS DE APOIO (EDITORIAS E EVENTOS)
==========================================================================*/
$sqlEdit = "SELECT * FROM editorias ORDER BY edit_nome ASC";
$TretEdit = $drive->pedido($sqlEdit);

$userEntidade = isset($_SESSION['SuserEnt']) ? (int)$_SESSION['SuserEnt'] : 0;
$sqlEve = "SELECT * FROM eventos WHERE evento_entidade_id = $userEntidade ORDER BY evento_nome ASC";
$TretEve = $drive->pedido($sqlEve);

// Helper rápido para higienizar dados corrompidos vindos do banco antes de irem pro value
function limparDadoFormulario($dado) {
    if (empty($dado)) return '';
    return htmlspecialchars(strip_tags(html_entity_decode(stripcslashes((string)$dado))));
}
?>

<link href="https://cdn.jsdelivr.net/npm/quill@2/dist/quill.snow.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/quill@2/dist/quill.js"></script>
<style type="text/css">
    .ql-toolbar.ql-snow {
        border: 1px solid #ccc !important;
        border-top-left-radius: 4px;
        border-top-right-radius: 4px;
        background-color: #fff;
    }
    #editor-container {
        border: 1px solid #ccc !important;
        border-top: none !important;
        border-bottom-left-radius: 4px;
        border-bottom-right-radius: 4px;
        height: 350px;
        background-color: #fff;
        font-size: 14px;
    }
</style>

<script type="text/javascript">
function verificaForm() {
    var inputData = document.getElementById('Fdata');
    if (inputData) {
        inputData.disabled = false;
    }
    return true;
}
</script>

<div class="conteudo-formulario">
    <div id="caminho_migalhas">atualização do portal &gt; notícias e eventos</div>
    <h1 id="titulo_pagina"><?= ucwords($Ttitulo) ?></h1>

    <?php include("noticias/formularios/abas_noticia.php"); ?>

    <div class="painel-formulario">
        <form method="post" onsubmit="return verificaForm();" id="frmNoticia">
            
            <?php if ($noticiaId === 0) { ?>
                <div class="form-group">
                    <label class="form-label">Status da Notícia:</label>
                    <div style="display: flex; gap: 15px; align-items: center; margin-top: 5px;">
                        <label><input type="radio" name="Fstatus" value="f" checked="checked"/> Em Edição</label>
                        <label><input type="radio" name="Fstatus" value="t"/> Publicar</label>
                    </div>
                </div>
                <hr class="divisor-formulario"/>
            <?php } else { ?>
                <input type="hidden" name="Fstatus" id="Fstatus" value="<?= htmlspecialchars($Tnoticia->noti_status ?? 'f') ?>"/>
            <?php } ?>

            <div class="form-group">
                <label for="Fevento" class="form-label">Notícia Referente ao Evento:</label>
                <select name="Fevento" id="Fevento" class="form-control">
                    <option value="0"></option>
                    <?php 
                    while ($obj = pg_fetch_object($TretEve)) {
                        $selected = (isset($Tnoticia->noti_evento_id) && $Tnoticia->noti_evento_id == $obj->evento_id) ? 'selected="selected"' : '';
                        echo "<option value=\"{$obj->evento_id}\" {$selected}>" . htmlspecialchars($obj->evento_name ?? $obj->evento_nome) . "</option>";
                    } 
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="Feditoria" class="form-label">Editoria:</label>
                <select name="Feditoria" id="Feditoria" class="form-control" required="required">
                    <option value=""></option>
                    <?php 
                    while ($obj = pg_fetch_object($TretEdit)) {
                        $selected = (isset($Tnoticia->noti_edit_id) && $Tnoticia->noti_edit_id == $obj->edit_id) ? 'selected="selected"' : '';
                        echo "<option value=\"{$obj->edit_id}\" {$selected}>" . htmlspecialchars($obj->edit_nome) . "</option>";
                    } 
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="Ftitulo" class="form-label">Título: <small style="color: var(--im-text-sub);">(No máximo 190 caracteres)</small></label>
                <input name="Ftitulo" id="Ftitulo" type="text" class="form-control" value="<?= limparDadoFormulario($Tnoticia->noti_titulo ?? '') ?>" maxlength="190" required="required" autocomplete="off"/>
            </div>

            <?php if (!isset($Tnoticia->noti_status) || $Tnoticia->noti_status === "f") { ?>
                <div class="form-group">
                    <label for="Ftweeter" class="form-label">Chamada para o Twitter: <small style="color: var(--im-text-sub);">(No máximo 119 caracteres)</small></label>
                    <input name="Ftweeter" id="Ftweeter" type="text" class="form-control" value="<?= limparDadoFormulario($Tnoticia->noti_twitter ?? '') ?>" maxlength="119" required="required" autocomplete="off"/>
                </div>
            <?php } ?>

            <div class="form-group">
                <label for="Fapoio" class="form-label">Linha de Apoio:</label>
                <textarea name="Fapoio" id="Fapoio" class="form-control" cols="45" rows="5"><?= limparDadoFormulario($Tnoticia->noti_manchete ?? '') ?></textarea>
            </div>

            <div class="form-group">
                <label for="editor-container" class="form-label">Texto:</label>
                <div id="editor-container"></div>
                <input type="hidden" name="Ftexto" id="Ftexto">
            </div>

            <?php if (!isset($Tnoticia->noti_status) || $Tnoticia->noti_status === "f") { ?>
                <div class="im-linha-filtros" style="margin-bottom: 0;">
                    <div class="form-group" style="flex: 1; min-width: 200px;">
                        <label for="Fdata" class="form-label">Data da Notícia:</label>
                        <div style="display: flex; gap: 5px; align-items: center;">
                            <input id="Fdata" name="Fdata" class="form-control" value="<?php 
                                if ($noticiaId > 0 && !empty($Tnoticia->noti_data)) {
                                    $Tdata = explode("-", $Tnoticia->noti_data);
                                    echo "{$Tdata[2]}/{$Tdata[1]}/{$Tdata[0]}";
                                } else {
                                    echo date("d/m/Y");
                                } 
                            ?>" readonly="readonly" disabled="disabled"/>
                            <a id="calendar-trigger" style="cursor: pointer; display: inline-flex; align-items: center;">
                                <img align="absmiddle" src="../layout/imagens/atualiza_btn_calendario.jpg" border="0" alt="Calendário"/>
                            </a>
                        </div>
                    </div>

                    <div class="form-group" style="flex: 1; min-width: 120px;">
                        <label for="Fhora" class="form-label">Hora da Notícia:</label>
                        <input name="Fhora" id="Fhora" type="text" class="form-control" value="<?php 
                            if ($noticiaId > 0 && !empty($Tnoticia->noti_hora)) {
                                echo htmlspecialchars($Tnoticia->noti_hora);
                            } else {
                                echo (date('G') - 1) . ':' . date('i');
                            } 
                        ?>" maxlength="5" required="required" placeholder="hh:mm"/>
                    </div>
                </div>

                <script type="text/javascript">
                Calendar.setup({
                    inputField: "Fdata",
                    trigger: "calendar-trigger",
                    onSelect: function() { this.hide(); }
                });
                </script>
            <?php } ?>

            <div class="form-group">
                <label for="Ftags" class="form-label">Tags de Busca:</label>
                <div class="form-group ui-ptags">
                    <div class="ui-ptags-tag-box-container" style="width: 100%;">
                        <input type="text" id="Ftags" name="Ftags" oncontextmenu="return false;" onpaste="return false;" value="<?= htmlspecialchars($Tnoticia->noti_palavra_chave ?? '') ?>" style="width: 100%;" placeholder="Adicione palavras-chave separadas por vírgula..."/>
                    </div>
                </div>
            </div>

            <div class="form-actions" style="margin-top: 25px;">
                <button type="submit" name="btSalvar" id="btSalvar" value="1" class="btn-salvar"><iclass="fa-solid fa-floppy-disk"></i>Salvar Notícia</button>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    var quill = new Quill('#editor-container', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ 'header': [1, 2, 3, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ 'color': [] }, { 'background': [] }],
                [{ 'script': 'sub'}, { 'script': 'super' }],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                [{ 'indent': '-1'}, { 'indent': '+1' }],
                [{ 'align': [] }],
                ['link', 'clean']
            ]
        }
    });

    var conteudoInicial = <?php echo json_encode(isset($Tnoticia) ? stripcslashes($Tnoticia->noti_texto ?? '') : ''); ?>;
    if (conteudoInicial) {
        quill.clipboard.dangerouslyPasteHTML(conteudoInicial);
    }

    document.getElementById('frmNoticia').addEventListener('submit', function(e) {
        var html = quill.root.innerHTML;
        if (html === '<p><br></p>') {
            html = '';
        }
        document.getElementById('Ftexto').value = html;
    });
</script>

<script type="text/javascript">
if (typeof LiveValidation !== 'undefined') {
    var Feditoria = new LiveValidation('Feditoria');
    Feditoria.add(Validate.Presence, {failureMessage: "Obrigatório"});
    
    var Ftitulo = new LiveValidation('Ftitulo');
    Ftitulo.add(Validate.Presence, {failureMessage: "Obrigatório"});
    
    if (document.getElementById('Ftweeter')) {
        var Ftweeter = new LiveValidation('Ftweeter');
        Ftweeter.add(Validate.Presence, {failureMessage: "Obrigatório"});
    }
    
    if (document.getElementById('Fhora')) {
        var Fhora = new LiveValidation('Fhora');
        Fhora.add(Validate.Presence, {failureMessage: "Obrigatório"});
    }
}
</script>

<?php 
$drive->close(); 
?>