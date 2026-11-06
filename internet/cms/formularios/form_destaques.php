<?php
require_once __DIR__ . '/../php/acoes.php';

// Assegura conexão ativa para operações de requisição pré-HTML
if (isset($drive) && method_exists($drive, 'conecta')) {
    $drive->conecta();
}

// ------------------------------------------------------------------------------------------
// INTERCEPTAÇÃO AJAX PARA REORDENAÇÃO (Drag & Drop com SortableJS)
// ------------------------------------------------------------------------------------------
if (isset($_REQUEST['ajax']) && $_REQUEST['ajax'] === 'reordenar_destaques_laterais') {
    if (function_exists('ob_clean')) { @ob_clean(); }
    header('Content-Type: application/json');
    
    global $drive; 
    $entidadeId = intval($_SESSION['SuserEnt'] ?? 0);
    $ordem = (isset($_POST['ordem']) && is_array($_POST['ordem'])) ? array_values($_POST['ordem']) : [];
    
    $erros = [];

    foreach ($ordem as $pos => $idDestaque) {
        $idDestaque = intval($idDestaque);
        if ($idDestaque > 0 && $entidadeId > 0) {
            $novaPosicao = $pos + 1;
            
            $sql = "UPDATE destaque_lateral 
                       SET destaque_lateral_posicao = {$novaPosicao} 
                     WHERE destaque_lateral_id = {$idDestaque} 
                       AND destaque_lateral_entidade_id = {$entidadeId}";
            
            $resultado = $drive->pedido($sql);
            if (!$resultado) {
                $erros[] = "Falha ao atualizar o ID {$idDestaque}";
            }
        }
    }
    
    if (count($erros) > 0) {
        echo json_encode(['status' => 'erro', 'mensagem' => 'Ocorreu um erro ao atualizar a posição no banco.']);
    } else {
        echo json_encode(['status' => 'sucesso']);
    }
    exit;
}

// URL da Imagem Placeholder padrão
$imgPlaceholder = "https://placehold.co/450x200?text=PMF";

// -------------------------------------------------------------------------
// 1. Processamento da Exclusão (RODA ANTES DO HTML)
// -------------------------------------------------------------------------
if (($_GET['ac'] ?? '') == "ex") {
    $excId = intval($_GET['exc'] ?? 0);
    $entidadeId = intval($_SESSION['SuserEnt'] ?? 0);
    
    $sqlCount = "SELECT COUNT(*) as quantidade 
                   FROM destaque_lateral 
                  WHERE destaque_lateral_entidade_id = {$entidadeId}";
    $TresultCount = $drive->pedido($sqlCount);
    $Ttotal = pg_fetch_object($TresultCount);
    
    $sqlExc = "SELECT * 
                 FROM destaque_lateral 
                WHERE destaque_lateral_id = {$excId}";
    $TresultSql = $drive->pedido($sqlExc);
    $TposDestaque = pg_fetch_object($TresultSql);
    
    if ($TposDestaque) {
        $Tatualiza = intval($Ttotal->quantidade) - intval($TposDestaque->destaque_lateral_posicao);
        $prox = intval($TposDestaque->destaque_lateral_posicao);
        
        // Remove arquivo físico se existir
        if (!empty($TposDestaque->destaque_lateral_img)) {
            @unlink(CAMINHO_SITE . "/" . UPLOAD_DESTAQUE . $TposDestaque->destaque_lateral_img);
        }
        
        // Reordena as posições subsequentes
        for ($i = 0; $i < $Tatualiza; $i++) {
            $prox++;
            $posic = $prox - 1;
            $sqlReorder = "UPDATE destaque_lateral SET destaque_lateral_posicao = {$posic} 
                           WHERE destaque_lateral_posicao = {$prox} AND destaque_lateral_entidade_id = {$entidadeId}";
            $drive->pedido($sqlReorder);
        }
        $Tdelete = $drive->deleta("destaque_lateral", "destaque_lateral_id", $excId);
    } else {
        $Tdelete = false;
    }
    
    $redirectUrl = "?pagina=" . htmlspecialchars($_GET['pagina'] ?? '') . "&menu=" . htmlspecialchars($_GET['menu'] ?? '');
    
    if ($Tdelete) {
        $Tmsg = "<div class='popup-resultadosucesso'>
                 <br/>Acesso excluído com Sucesso!<br/>
                 <br/><button onclick=\"document.getElementById('popup').style.display='none'; 
                              location.href='{$redirectUrl}';\" 
                              class='btn-acao btn-salvar'>
                        Voltar
                      </button></div>";
    } else {
        $Tmsg = "<div class='popup-resultadoerro'>
                 <br/>Não foi possível excluir o Acesso!<br/>
                 <br/><button onclick=\"document.getElementById('popup').style.display='none';\" class='btn-acao btn-excluir'>
                 Voltar</button></div>";
    }
    MsgSql($Tmsg, 100, 400);
}

// -------------------------------------------------------------------------
// 2. Inclusão / Edição (Processa envio do formulário)
// -------------------------------------------------------------------------
if (isset($_POST["btSalvar"]) || isset($_POST["btSalvar_x"])) {
    cmsSalvarDestaque($drive);
}

// -------------------------------------------------------------------------
// 3. Carregamento dos dados para o formulário
// -------------------------------------------------------------------------
if (!isset($_GET['destId'])) {
    $Ttitulo = "incluir Acesso Rápido";
    $Tdestaque = (object)[
        'destaque_lateral_titulo' => '',
        'destaque_lateral_link' => '',
        'destaque_lateral_img' => ''
    ];
} else {
    $Ttitulo = "editar Acesso Rápido";
    $sqlDest = "SELECT  * 
                FROM    destaque_lateral 
                WHERE   destaque_lateral_id = " . intval($_GET['destId']);
    $TbuscaDest = $drive->pedido($sqlDest);
    $Tdestaque = pg_fetch_object($TbuscaDest);
}

// Resolução recomendada conforme tipo da entidade
$Tlarg = (($_SESSION['SentTipo'] ?? 0) == 7) ? 120 : 190;
$Talt  = (($_SESSION['SentTipo'] ?? 0) == 7) ? 90 : 100;
$Tlimit = 7;

// Busca lista atualizada de Destaques
$query = "SELECT * FROM destaque_lateral WHERE destaque_lateral_entidade_id = " . intval($_SESSION['SuserEnt']) . " ORDER BY destaque_lateral_posicao ASC";
$rquery = $drive->pedido($query);

// Trata caminho base da pasta de upload removendo barras duplicadas no final
$caminhoUpload = rtrim("../" . UPLOAD_DESTAQUE, "/") . "/";
?>

<!-- Importação do SortableJS moderno para evitar conflitos de dependências antigas -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.2/Sortable.min.js"></script>

<style>
    .sortable-ghost { opacity: 0.4; background-color: #cbd5e1 !important; }
    .drag-handle { cursor: grab; }
    .drag-handle:active { cursor: grabbing; }
</style>

<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function() {
    let listaOrdenada = document.getElementById("lista_ordenada_ul");
    if (listaOrdenada && typeof Sortable !== 'undefined') {
        new Sortable(listaOrdenada, {
            handle: '.drag-handle',
            animation: 150,
            axis: 'y',
            ghostClass: 'sortable-ghost',
            onEnd: function(evt) {
                if (evt.oldIndex === evt.newIndex) return;

                let formData = new FormData();
                let itens = listaOrdenada.querySelectorAll("li.item-ordenavel");
                
                for (let i = 0; i < itens.length; i++) {
                    // Extrai o ID limpo do ID do elemento HTML (ex: "recordsArray_123" -> "123")
                    let itemId = itens[i].id.replace("recordsArray_", "");
                    formData.append("ordem[]", itemId);
                }

                var urlAjax = "?pagina=<?= htmlspecialchars($_GET['pagina'] ?? '') ?>&menu=<?= htmlspecialchars($_GET['menu'] ?? '') ?>&ajax=reordenar_destaques_laterais";

                fetch(urlAjax, {
                    method: "POST",
                    body: formData
                })
                .then(function(r) { return r.json(); })
                .then(function(data) {
                    if (data.status !== "sucesso") {
                        alert(data.mensagem || "Erro ao salvar nova ordenação.");
                    }
                })
                .catch(function(err) {
                    console.error("Erro na requisição de ordenação:", err);
                });
            }
        });
    }

    let inputFdestaque = $('#Fdestaque');
    if (inputFdestaque.length) {
        inputFdestaque.on('change', function() {
            var filename = $(this).val().split('\\').pop();
            $('#arquivo-selecionado-label').text(filename ? filename : "Nenhum arquivo selecionado");
        });
    }
});

function removerImagem() {
    if ($("#Fdestaque").val() || $("#Fdestaque-image").length > 0) {
        $("#Fdestaque").val("");
        $("#Fdestaque-image").remove();
        $("#arquivo-selecionado-label").text("Nenhum arquivo selecionado");
        $("#Ftitulo").parent().append("<input type='hidden' value='1' name='FremoveImg'/>");
    }
}

function del(valor) {
    if (confirm("Tem certeza que deseja EXCLUIR este destaque?")) {
        location.href = '?pagina=<?= urlencode($_GET['pagina'] ?? '') ?>&ac=ex&exc=' + valor + '&menu=<?= urlencode($_GET['menu'] ?? '') ?>';
    }
}
</script>
<script type="text/javascript" src="../scripts/js/wz_tooltip/wz_tooltip.js"></script>

<div class="centro">
    <div id="caminho_migalhas">atualização do portal > personalizar site</div>
    <div id="titulo_pagina">configurar Acessos Rápidos</div>
    
    <div id="margem_direita"><br>
        <div class="conteudo_abas">
            
            <div id="conteudo_dados" class="painel-formulario">
                <div class="conteudo-formulario">

                    <h2><?= htmlspecialchars(mb_strtoupper($Ttitulo, 'UTF-8')) ?></h2>
                    
                    <form   method  ="post" 
                            enctype ="multipart/form-data" 
                            action  ="?pagina=<?= htmlspecialchars($_GET['pagina'] ?? '') ?>&menu=<?= htmlspecialchars($_GET['menu'] ?? '') ?>
                                              <?= isset($_GET['destId']) ? '&destId='.intval($_GET['destId']) : '' ?>">
                        <div class="form-group">
                            <label class="form-label" for="Ftitulo">Título:</label>
                            <input  type        ="text" 
                                    name        ="Ftitulo" 
                                    id          ="Ftitulo" 
                                    class       ="form-control uppercase" 
                                    maxlength   ="50" 
                                    value       ="<?= htmlspecialchars($Tdestaque->destaque_lateral_titulo) ?>"/>
                            <script type="text/javascript">
                                var Ftitulo = new LiveValidation('Ftitulo');
                                Ftitulo.add(Validate.Presence, {failureMessage: "Obrigatório"});
                            </script>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="Flink">Link de Destino:</label>
                            <input  type        ="text" 
                                    name        ="Flink" 
                                    id          ="Flink" 
                                    class       ="form-control" 
                                    maxlength   ="500" 
                                    value       ="<?= htmlspecialchars($Tdestaque->destaque_lateral_link) ?>"/>
                            <script type="text/javascript">
                                var Flink = new LiveValidation('Flink');
                                Flink.add(Validate.Presence, {failureMessage: "Obrigatório"});
                            </script>
                        </div>

                        <div class="form-actions-alinhado" style="margin-top: 15px; display: flex; gap: 10px;">
                            <button type="submit" name="btSalvar" id="btSalvar" class="btn-acao btn-salvar im-btn-destaque" value="btSalvar">Salvar Destaque</button>
                        </div>
                    </form>
                    
                    <div class="form-divider" style="margin: 20px 0;"></div>
                </div>
            </div>

            <!-- LISTAGEM COM DRAG AND DROP VIA SORTABLEJS -->
            <div id="conteudo_listagem">
                <div class="alerta-informativo" style="margin-bottom: 15px; display: flex; align-items: center; gap: 10px;">
                    <img src="../layout/imagens/ico_mover.png" alt="Mover" />
                    <span>Para <b>ordenar</b> os Destaques, clique no indicador à esquerda, segure e arraste até a posição desejada.</span>
                </div>
                
                <ul id="lista_ordenada_ul" class="container-ordenacao painel-listagem" style="list-style: none; padding: 0; margin: 0;">
                    <?php 
                    $i = 0;
                    while ($oquery = pg_fetch_object($rquery)): 
                        $hasImgItem = !empty($oquery->destaque_lateral_img) && file_exists(CAMINHO_SITE . "/" . UPLOAD_DESTAQUE . $oquery->destaque_lateral_img);
                        $srcDestaqueHover = $hasImgItem ? $caminhoUpload . $oquery->destaque_lateral_img : $imgPlaceholder;
                    ?>
                        <li id="recordsArray_<?= $oquery->destaque_lateral_id ?>" class="item-registro item-ordenavel" style="display: flex !important; flex-direction: row !important; align-items: center !important; justify-content: space-between !important; padding: 12px 15px; border: 1px solid #e0e0e0; border-radius: 12px; margin-bottom: 8px; background-color: #fff;">
                            
                            <div style="display: flex !important; flex-direction: row !important; align-items: center !important; gap: 15px; flex: 1; text-align: left !important;">
                                
                                <div class="drag-handle" style="display: inline-flex; align-items: center; justify-content: center; flex-shrink: 0;" title="Clique e arraste para reordenar">
                                    <img src="../layout/imagens/ico_mover.png" alt="Arrastar" style="display: block; margin: 0;" />
                                </div>
                                
                                <span class="item-titulo" style="text-align: left !important;">
                                    <a href="javascript:void(0);"  onmouseout="UnTip()" style="text-decoration: none; color: #333; font-weight: 600;">
                                        <?= htmlspecialchars(mb_strtoupper($oquery->destaque_lateral_titulo, 'UTF-8')) ?>
                                    </a>
                                </span>

                            </div>
                            
                            <div class="item-acoes im-botoes-alinhados" style="display: flex !important; flex-direction: row !important; gap: 8px; align-items: center; flex-shrink: 0;">
                                <a href="inicio.php?pagina=<?= htmlspecialchars($_GET['pagina'] ?? '') ?>&menu=<?= htmlspecialchars($_GET['menu'] ?? '') ?>&destId=<?= $oquery->destaque_lateral_id ?>" class="btn-acao btn-editar toggleopacity">Editar</a>
                                <a href="javascript:del(<?= $oquery->destaque_lateral_id ?>);" class="btn-acao btn-excluir toggleopacity">Excluir</a>
                            </div>

                        </li>
                    <?php 
                        $i++;
                        if ($i == $Tlimit) {
                            echo '<div class="form-divider" style="margin: 10px 0;"></div>';
                        }
                    endwhile; 
                    ?>
                </ul>
            </div>

        </div>
    </div>
</div>

<?php
if (isset($drive) && method_exists($drive, 'close')) {
    $drive->close();
}
?>