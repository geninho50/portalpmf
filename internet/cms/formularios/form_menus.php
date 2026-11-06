<?php
require_once __DIR__ . '/../php/acoes.php';
// ------------------------------------------------------------------------------------------
// INTERCEPTACAO AJAX PARA REORDENACAO
// ------------------------------------------------------------------------------------------
if (isset($_REQUEST['ajax']) && $_REQUEST['ajax'] === 'reordenar_menus') {
    if (function_exists('ob_clean')) { @ob_clean(); }
    header('Content-Type: application/json');
    
    $ent   = intval($_SESSION['SuserEnt']);
    $ordem = (isset($_POST['ordem']) && is_array($_POST['ordem'])) ? array_values($_POST['ordem']) : [];

    foreach ($ordem as $pos => $idMenu) {
        $idMenu = intval($idMenu);
        if ($idMenu > 0) {
            $n = $pos + 1;
            $drive->pedido("UPDATE cms_menu SET cmsmenu_posicao = {$n}
                            WHERE cmsmenu_id = {$idMenu} AND cmsmenu_entidade_id = {$ent}");
        }
    }
    
    echo json_encode(['status' => 'sucesso']);
    exit;
}

if (isset($_POST["btSalvar_x"]) || isset($_POST["btSalvar"])) {
    cmsSalvarMenu($drive);
}

// --------------------------
// Busca lista de menus Pai
// --------------------------
$query = "SELECT * FROM cms_menu WHERE cmsmenu_entidade_id = " . intval($_SESSION['SuserEnt']) . " ORDER BY cmsmenu_posicao ASC";
$rquery = $drive->pedido($query);

// ---------------------------------------------------
// Verifica se o menu esta sendo incluido ou editado
// ---------------------------------------------------
$TblockInt = "none";
$TblockExt = "none";

if (!isset($_GET['menuId'])) {
    $Ttitulo = "incluir menu";
} else {
    $Ttitulo = "editar menu";
    $sqlMenu = "SELECT * FROM cms_menu WHERE cmsmenu_id = " . intval($_GET['menuId']);
    $TbuscaMenu = $drive->pedido($sqlMenu);
    $Tmenu = pg_fetch_object($TbuscaMenu);
    
    switch ($Tmenu->cmsmenu_tipo_menu ?? 0) {
        case 2: $TblockInt = "block"; break;
        case 3: $TblockExt = "block"; break;
    }
}
?>

<!-- Importação do SortableJS -->
<!-- NOTA: Caso haja firewall bloqueando o carregamento, baixe o arquivo e aponte localmente (ex: src="../scripts/js/Sortable.min.js") -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.2/Sortable.min.js"></script>

<style>
    .handle-drag { cursor: grab; padding: 0 12px; font-size: 18px; color: #64748b; }
    .handle-drag:active { cursor: grabbing; }
    .sortable-ghost { opacity: 0.4; background-color: #cbd5e1 !important; }
</style>

<script type="text/javascript">
// RESTAURADO: Patch legado para jQuery (essencial para não quebrar abas ou outras funções globais do painel)
(function() {
    var jQ = window.jQuery || window.$;
    if (jQ) {
        if (!jQ.curCSS) {
            jQ.curCSS = function(elem, prop) {
                return jQ(elem).css(prop);
            };
        }
        if (!jQ.browser) {
            var ua = (navigator.userAgent || '').toLowerCase();
            jQ.browser = {
                version: (ua.match(/.+(?:rv|it|ra|ie)[\/: ]([\d.]+)/) || [0, '0'])[1],
                safari: /webkit/.test(ua),
                opera: /opera/.test(ua),
                msie: /msie/.test(ua) || /trident/.test(ua),
                mozilla: /mozilla/.test(ua) && !/(compatible|webkit)/.test(ua)
            };
        }
    }
})();

function MostraPaineis() {
    if (document.getElementById("Fint").checked) {
        document.getElementById('Dexterno').style.display = 'none';
        document.getElementById('Dinterno').style.display = 'block';
    } else if (document.getElementById("Fext").checked) {
        document.getElementById('Dexterno').style.display = 'block';
        document.getElementById('Dinterno').style.display = 'none';
    } else if (document.getElementById("Fsub").checked) {
        document.getElementById('Dexterno').style.display = 'none';
        document.getElementById('Dinterno').style.display = 'none';
    }
}

function del(valor) {
    if (confirm("Tem certeza que deseja EXCLUIR?")) {
        location.href = '?pagina=<?= urlencode($_GET['pagina'] ?? '') ?>&ac=ex&exc=' + valor + '&menu=<?= urlencode($_GET['menu'] ?? '') ?>';
    }
}
</script>

<div class="centro">
    <div id="caminho_migalhas">atualização do portal > personalizar site</div>
    <div id="titulo_pagina">Montar Menu</div>
    
    <div id="margem_direita">
        <div class="abas-navegacao">
            <?php renderAbasMenus(); ?>
        </div>
        
        <div class="conteudo_abas">
            <div id="conteudo_dados" class="painel-formulario">
                <h2><?= htmlspecialchars($Ttitulo) ?></h2>
                
                <form method="post">
                    <div class="form-group">
                        <label class="form-label" for="Ftitulo">Título:</label>
                        <input type="text" name="Ftitulo" id="Ftitulo" class="form-control uppercase" maxlength="100" value="<?= htmlspecialchars($Tmenu->cmsmenu_titulo ?? '') ?>"/>
                    </div>
                    
                    <script type="text/javascript">
                        var Ftitulo = new LiveValidation('Ftitulo');
                        Ftitulo.add(Validate.Presence, {failureMessage: "Obrigatório"});
                    </script>
                    
                    <div class="form-group">
                        <label class="form-label">Ação quando menu for clicado:</label>
                        <div class="radio-group">
                            <label class="radio-option">
                                <input type="radio" name="Facao" id="Fsub" value="1" onchange="MostraPaineis()" <?= (($Tmenu->cmsmenu_tipo_menu ?? 1) == 1) ? 'checked="checked"' : '' ?> /> Abrir Sub-Menu
                            </label>
                            <label class="radio-option">
                                <input type="radio" name="Facao" id="Fint" value="2" onchange="MostraPaineis()" <?= (($Tmenu->cmsmenu_tipo_menu ?? 0) == 2) ? 'checked="checked"' : '' ?> /> Abrir Link Interno
                            </label>
                            <label class="radio-option">
                                <input type="radio" name="Facao" id="Fext" value="3" onchange="MostraPaineis()" <?= (($Tmenu->cmsmenu_tipo_menu ?? 0) == 3) ? 'checked="checked"' : '' ?> /> Abrir Link Externo
                            </label>
                        </div>
                    </div>
                    
                    <div id="Dinterno" class="form-group" style="display: <?= $TblockInt ?>;">
                        <select name="FlinkInt" id="FlinkInt" class="form-control form-select">
                            <option value="0">Em construção...</option>
                            <?php
                            $sql = "SELECT * FROM cms_pagina WHERE cmspagina_entidade_id = " . intval($_SESSION['SuserEnt']) . " ORDER BY cmspagina_titulo ASC";
                            $TreturnSql = $drive->pedido($sql);
                            while ($Tpagina = pg_fetch_object($TreturnSql)) {
                                $selected = (($Tmenu->cmsmenu_pagina_id ?? 0) == $Tpagina->cmspagina_id) ? 'selected="selected"' : '';
                                echo "<option value=\"{$Tpagina->cmspagina_id}\" {$selected}>" . htmlspecialchars($Tpagina->cmspagina_titulo) . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    
                    <div id="Dexterno" class="form-group" style="display: <?= $TblockExt ?>;">
                        <input type="text" name="FlinkExt" id="FlinkExt" class="form-control" value="<?= (($Tmenu->cmsmenu_tipo_menu ?? 0) == 3) ? htmlspecialchars($Tmenu->cmsmenu_link ?? '') : 'http://' ?>" maxlength="150"/>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Liberar na Internet?</label>
                        <div class="radio-group">
                            <label class="radio-option">
                                <input name="Flibera" type="radio" value="0" <?= (($Tmenu->cmsmenu_status ?? 0) == 0) ? 'checked="checked"' : '' ?> /> Sim
                            </label>
                            <label class="radio-option">
                                <input name="Flibera" type="radio" value="1" <?= (($Tmenu->cmsmenu_status ?? 0) == 1) ? 'checked="checked"' : '' ?> /> Não
                            </label>
                        </div>
                    </div>
                    
                    <div class="form-actions-alinhado">
                        <button type="submit" name="btSalvar" id="btSalvar" class="btn-acao btn-salvar im-btn-destaque" value="btSalvar">Salvar</button>
                        <?php if (isset($_GET['menuId'])): ?>
                            <a href="inicio.php?pagina=<?= htmlspecialchars($_GET['pagina'] ?? '') ?>&menu=<?= htmlspecialchars($_GET['menu'] ?? '') ?>" class="btn-acao btn-cancelar">Novo Menu</a>
                        <?php endif; ?>
                    </div>
                    
                    <div class="form-divider"></div>
                </form>
                
                <div id="conteudo_listagem">
                    <div class="alerta-informativo">
                        Para ordenar os Menus, clique no ícone indicador à esquerda de cada item, segure e arraste para cima ou para baixo até a posição desejada.
                    </div>
                    
                    <ul id="lista_ordenada" class="container-ordenacao" style="list-style-type: none; padding: 0;">
                        <?php
                        while ($oquery = pg_fetch_object($rquery)) {
                            $TtituloItem = mb_strtoupper($oquery->cmsmenu_titulo, 'UTF-8');
                            $classeStatusVazio = ($oquery->cmsmenu_status == 1) ? " item-vazio" : "";
                            
                            if ($oquery->cmsmenu_tipo_menu == 1) {
                                $linkEditar = "inicio.php?pagina=addSubmenu&menu=" . htmlspecialchars($_GET['menu'] ?? '') . "&menuId=" . $oquery->cmsmenu_id;
                            } else {
                                $linkEditar = "inicio.php?pagina=" . htmlspecialchars($_GET['pagina'] ?? '') . "&menu=" . htmlspecialchars($_GET['menu'] ?? '') . "&menuId=" . $oquery->cmsmenu_id;
                            }
                        ?>
                            <!-- Item base -->
                            <li data-id="<?= $oquery->cmsmenu_id ?>" class="item-registro item-ordenavel<?= $classeStatusVazio ?>" style="display: flex; align-items: center; justify-content: space-between; width: 100%; margin-bottom: 5px;">
                                
                                <span class="handle-drag" title="Clique e arraste para reordenar">&#9776;</span>
                                
                                <div class="item-dados" style="margin-right: auto; text-align: left; padding-left: 15px;">
                                    <span class="item-titulo"><?= htmlspecialchars($TtituloItem) ?></span>
                                </div>
                                
                                <div class="item-acoes im-botoes-alinhados" style="display: flex; gap: 8px; flex-shrink: 0; align-items: center;">
                                    <?php if ($oquery->cmsmenu_tipo_menu == 1): ?>
                                        <a href="<?= $linkEditar ?>" class="btn-acao">Submenus</a>
                                    <?php endif; ?>
                                    
                                    <a href="<?= $linkEditar ?>" class="btn-acao btn-editar">Editar</a>
                                    <a href="javascript:del(<?= $oquery->cmsmenu_id ?>);" class="btn-acao btn-excluir">Excluir</a>
                                </div>
                            </li>
                        <?php } ?>
                    </ul>
                    
                    <script type="text/javascript">
                    // Executado logo apos renderizar a lista (previne falhas em caso de injecao AJAX)
                    (function() {
                        var lista = document.getElementById("lista_ordenada");
                        if (lista && typeof Sortable !== 'undefined') {
                            new Sortable(lista, {
                                handle: ".handle-drag",
                                animation: 150,
                                axis: "y",
                                ghostClass: "sortable-ghost",
                                onEnd: function (evt) {
                                    if (evt.oldIndex === evt.newIndex) return;

                                    var formData = new FormData();
                                    var itens = lista.querySelectorAll("li.item-registro");
                                    for (var i = 0; i < itens.length; i++) {
                                        formData.append("ordem[]", itens[i].getAttribute("data-id"));
                                    }

                                    fetch("?pagina=<?= urlencode($_GET['pagina'] ?? '') ?>&menu=<?= urlencode($_GET['menu'] ?? '') ?>&ajax=reordenar_menus", {
                                        method: "POST",
                                        body: formData
                                    })
                                    .then(function(r) { return r.json(); })
                                    .then(function(data) {
                                        if (data.status !== "sucesso") alert(data.mensagem || "Erro ao atualizar no banco de dados.");
                                    })
                                    .catch(function(err) { console.error("Falha na requisicao Fetch:", err); });
                                }
                            });
                        }
                    })();
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// ------------------
// Exclui o menu
// ------------------
if (isset($_GET['ac']) && $_GET['ac'] == "ex") {
    $drive->conecta();
    $idExcluir = intval($_GET['exc']);
    $sql = "SELECT cmsmenu_tipo_menu FROM cms_menu WHERE cmsmenu_id = " . $idExcluir;
    $TretSql = $drive->pedido($sql);
    $Tmenu = pg_fetch_object($TretSql);
    $Texc = true;
    
    if ($Tmenu && $Tmenu->cmsmenu_tipo_menu == 1) {
        $sqlVerifica = "SELECT COUNT(*) AS qtd FROM cms_submenu WHERE cmssubmenu_menu_id = " . $idExcluir;
        $TretSqlver = $drive->pedido($sqlVerifica);
        $Tverifica = pg_fetch_object($TretSqlver);
        $Tretorno = "?pagina=" . htmlspecialchars($_GET['pagina'] ?? '') . "&menu=" . htmlspecialchars($_GET['menu'] ?? '');
        
        if ($Tverifica->qtd > 0) {
            $Tmsg1 = "Não foi possível excluir este Menu!<br><br>Existem <b>" . $Tverifica->qtd . "</b> sub-menu(s) associado(s) a ele!";
            $Tmsg = "<div class=\"popup-resultadoerro\"><form method=\"post\" action=\"{$Tretorno}\"><br/>{$Tmsg1}<br/><br/><input type=\"submit\" onclick=\"document.getElementById('popup').style.display='none';\" value=\"Voltar\" class=\"btn-acao btn-cancelar\"></form></div>";
            MsgSql($Tmsg, 130, 400);
            $Texc = false;
        }
    }
    
    if ($Texc == true) {
        $sqlCount = "SELECT COUNT(*) as quantidade FROM cms_menu WHERE cmsmenu_entidade_id = " . intval($_SESSION['SuserEnt']);
        $TresultCount = $drive->pedido($sqlCount);
        $Ttotal = pg_fetch_object($TresultCount);
        
        $sqlExc = "SELECT * FROM cms_menu WHERE cmsmenu_id = " . $idExcluir;
        $TresultSql = $drive->pedido($sqlExc);
        $TposMenu = pg_fetch_object($TresultSql);
        
        if ($TposMenu) {
            $Tatualiza = $Ttotal->quantidade - $TposMenu->cmsmenu_posicao;
            $prox = $TposMenu->cmsmenu_posicao;
            
            for ($i = 0; $i < $Tatualiza; $i++) {
                $prox = $prox + 1;
                $posic = $prox - 1;
                $sql = "UPDATE cms_menu SET cmsmenu_posicao = " . $posic . " WHERE cmsmenu_posicao = " . $prox . " AND cmsmenu_entidade_id = " . intval($_SESSION['SuserEnt']);
                $drive->pedido($sql);
            }
        }
        
        $Tdelete = $drive->deleta("cms_menu", "cmsmenu_id", $idExcluir);
        $drive->close();
        
        $paginaParam = htmlspecialchars($_GET['pagina'] ?? '');
        $menuParam = htmlspecialchars($_GET['menu'] ?? '');
        
        if ($Tdelete) {
            $Tmsg = "<div class=\"popup-resultadosucesso\"><form method=\"post\" action=\"?pagina={$paginaParam}&menu={$menuParam}\"><br/>Menu excluído com Sucesso!<br/><br/><input type=\"submit\" onclick=\"document.getElementById('popup').style.display='none';\" value=\"Voltar\" class=\"btn-acao btn-cancelar\"></form></div>";
            MsgSql($Tmsg, 100, 400);
        } else {
            $Tmsg = "<div class=\"popup-resultadoerro\"><form method=\"post\" action=\"?pagina={$paginaParam}&menu={$menuParam}\"><br/>Não foi possível excluir o Menu!<br/><br/><input type=\"submit\" onclick=\"document.getElementById('popup').style.display='none';\" value=\"Voltar\" class=\"btn-acao btn-cancelar\"></form></div>";
            MsgSql($Tmsg, 100, 400);
        }
    }
}
?>