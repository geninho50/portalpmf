<?php
session_start();
require_once(CAMINHO_SITE . "/scripts/php/funcoes_bd.php");
require_once("../scripts/php/paginacao.php");
require_once("../scripts/php/funcoes.php");
$drive->conecta();

// Captura e higienização das variáveis de navegação
$menu = isset($_GET['menu']) ? htmlspecialchars($_GET['menu']) : '';
$pagina = isset($_GET['pagina']) ? htmlspecialchars($_GET['pagina']) : '';
$pg = isset($_GET['pg']) ? (int)$_GET['pg'] : 1;
if ($pg < 1) $pg = 1;
$inicio = ($pg * 10) - 10;

$userEntidade = isset($_SESSION['SuserEnt']) ? (int)$_SESSION['SuserEnt'] : 0;

// Botao "Nova Noticia": visivel so para perfis com o submenu "Incluir noticia" (atalho addnot, id 125)
$perfilIdBtn = isset($_SESSION['SuserPerfilId']) ? (int)$_SESSION['SuserPerfilId'] : 0;
$podeIncluirNoticia = false;
if ($perfilIdBtn > 0) {
    $rPerm = $drive->pedido("SELECT 1 FROM intranet_perfil_submenu ps INNER JOIN intranet_submenu s ON s.intranet_submenu_id = ps.intranet_perfil_submenu_submenu_id WHERE s.intranet_submenu_atalho = 'addnot' AND ps.intranet_perfil_submenu_perfil_id = $perfilIdBtn LIMIT 1");
    $podeIncluirNoticia = ($rPerm && pg_num_rows($rPerm) > 0);
}

/* ==========================================================================
   1. ROTINA DE EXCLUSÃO
   ========================================================================== */
if (isset($_GET['ac']) && $_GET['ac'] === "ex" && !empty($_GET['exc'])) {
    $idExcluir = (int)$_GET['exc'];
    
    $sql4 = "DELETE FROM noticias_midia WHERE nmidia_noti_id = $idExcluir";
    $sql3 = "DELETE FROM noticias_imagens WHERE nimg_noti_id = $idExcluir";
    $sql2 = "DELETE FROM noticias_arquivos WHERE narq_noti_id = $idExcluir";
    $sql  = "DELETE FROM noticias WHERE noti_id = $idExcluir";
    
    $drive->pedido($sql4);
    $drive->pedido($sql3);
    $drive->pedido($sql2);
    $resultado = $drive->pedido($sql);

    if ($resultado) {
        echo "<script>alert('Notícia excluída com sucesso!'); window.location.href='inicio.php?pagina=" . $pagina . "&menu=" . $menu . "&pg=" . $pg . "';</script>";
        exit;
    } else {
        echo "<script>alert('Não foi possível excluir a notícia!'); window.location.href='inicio.php?pagina=" . $pagina . "&menu=" . $menu . "&pg=" . $pg . "';</script>";
        exit;
    }
}

/* ==========================================================================
   2. PROCESSAMENTO DE PUBLICAÇÃO (POST)
   ========================================================================== */
if (isset($_POST['publicar']) || isset($_POST['publicar_x'])) {
    include("noticias/php/php_noticia_cons.php");
}

/* ==========================================================================
   3. CONSULTAS E PAGINAÇÃO
   ========================================================================== */
$sql = "SELECT * FROM noticias 
        WHERE noti_status = 'f' AND noti_exc = 'f' AND noti_entidade_id = $userEntidade 
        ORDER BY noti_data DESC, noti_hora DESC 
        LIMIT 10 OFFSET $inicio";

$sqlCount = "SELECT count(*) as total FROM noticias WHERE noti_status = 'f' AND noti_exc = 'f' AND noti_entidade_id = $userEntidade";

$TretNoti = $drive->pedido($sql);
$TretNum = $drive->pedido($sqlCount);

$numPagTotal = pg_fetch_object($TretNum);
$totalItens = (int)($numPagTotal->total ?? 0);
?>

<!-- ==========================================================================
     ESTRUTURA DE INTERFACE (HTML5)
     ========================================================================== -->
<div class="conteudo-formulario im-lista-noticias">
    
    <div id="caminho_migalhas">atualização do portal &gt; notícias e eventos</div>
    <div class="im-titulo-acoes">
        <h1 id="titulo_pagina">Consultar Notícias</h1>
        <?php if ($podeIncluirNoticia) { ?>
            <a href="inicio.php?pagina=addnot&amp;menu=<?= urlencode($menu) ?>&amp;modal=1" id="btnNovaNoticia" class="im-btn-nova-noticia" title="Incluir uma nova notícia">
                <i class="fa-solid fa-plus"></i> Nova Notícia
            </a>
        <?php } ?>
    </div>

    <?php include("noticias/formularios/abas_noticia_geral.php"); ?>

    <div class="painel-formulario">
        
        <h2 class="form-section-title" style="font-size: 16px; font-weight: 500; margin-bottom: 5px;">
            <?= $totalItens ?> Notícia(s) em Edição
        </h2>

        <div class="painel-listagem">
            
            <?php if ($totalItens === 0) { ?>
                <div class="alerta-informativo" style="border-left: 4px solid var(--im-bg-hover); margin-top: 15px;">
                    <i class="fa-solid fa-folder-open"></i>
                    <span>Nenhuma notícia em edição encontrada.</span>
                </div>
            <?php } else { ?>

                <!-- Tabela Alinhada Conforme o Print das Publicadas -->
                <table class="im-tabela-listagem">
                    <tbody>
                        <?php 
                        while ($Tnoticia = pg_fetch_object($TretNoti)) { 
                            $dates = explode("-", $Tnoticia->noti_data);
                            $formattedDate = "{$dates[2]}/{$dates[1]}/{$dates[0]}";
                            $tituloLimpo = htmlspecialchars(strip_tags(html_entity_decode(stripcslashes($Tnoticia->noti_titulo))));
                            $Tlink = "http://www.pmf.sc.gov.br/noticias/index.php?pagina=notpagina&noti=" . $Tnoticia->noti_id;
                            ?>
                            
                            <tr>
                                <!-- Dados da Notícia -->
                                <td>
                                    <span class="item-titulo-link">
                                        <?= $formattedDate ?> - <?= $tituloLimpo ?>
                                    </span>
                                    <small class="form-text-sub" style="word-break: break-all;">
                                        Link Externo: <a href="<?= $Tlink ?>" target="_blank" class="link-externo-ancora"><?= htmlspecialchars($Tlink) ?></a>
                                    </small>
                                </td>

                                <!-- Botões de Ação Perfeitamente Alinhados na Tabela -->
                                <td>
                                    <div class="item-acoes im-botoes-alinhados">
                                        <a href="inicio.php?pagina=notedit&menu=<?= urlencode($menu) ?>&n=<?= $Tnoticia->noti_id ?>" class="btn-acao btn-editar">
                                            <i class="fa-solid fa-pen-to-square"></i> Editar
                                        </a>
                                        
                                        <a href="javascript:confirmaExclusao(<?= $Tnoticia->noti_id ?>);" class="btn-acao btn-excluir">
                                            <i class="fa-solid fa-trash-can"></i> Excluir
                                        </a>

                                        <!-- Form em linha isolado para o disparo de POST do botão Publicar -->
                                        <form method="post" class="form-publicar-inline">
                                            <input type="hidden" name="FidNoticia" value="<?= $Tnoticia->noti_id ?>" />
                                            <button type="submit" name="publicar" value="1" class="btn-salvar btn-mini-acao">
                                                <i class="fa-solid fa-globe"></i> Publicar
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                        <?php } ?>
                    </tbody>
                </table>

                <!-- Sistema de Paginação -->
                <div class="im-paginacao-container">
                    <?php 
                    $Tcaminho = "inicio.php?pagina=" . $pagina . "&menu=" . $menu;
                    $TnumPag = $totalItens < 10 ? 10 : $totalItens;
                    mostra_paginas($TnumPag, $pg, $Tcaminho, 10); 
                    ?>
                </div>

            <?php } ?>

        </div>
    </div>
</div>

<style>
.im-titulo-acoes { display:flex; align-items:center; justify-content:space-between; gap:12px; flex-wrap:wrap; margin-bottom:10px; }
.im-titulo-acoes #titulo_pagina { margin:0; }
.im-btn-nova-noticia { display:inline-flex; align-items:center; gap:8px; padding:10px 20px; background:#0ea5e9; color:#fff !important; font-weight:700; font-size:14px; border-radius:8px; text-decoration:none !important; box-shadow:0 2px 6px rgba(14,165,233,.35); transition:background .2s, transform .1s; }
.im-btn-nova-noticia:hover { background:#003063; }
.im-btn-nova-noticia:active { transform:translateY(1px); }
#cboxOverlay.im-modal-overlay { background:#0f172a; }
#colorbox.im-modal-noticia #cboxContent { border-radius:10px; overflow:hidden; }
#colorbox.im-modal-noticia #cboxTitle { top:0; bottom:auto; left:0; width:100%; height:44px; line-height:44px; padding:0 52px 0 18px; box-sizing:border-box; text-align:left; background:#003063; color:#fff; font-weight:700; font-size:16px; }
#colorbox.im-modal-noticia #cboxLoadedContent { margin-top:44px; margin-bottom:0; }
#colorbox.im-modal-noticia #cboxClose { top:6px; bottom:auto; right:8px; width:32px; height:32px; background:none; text-indent:0; color:#fff; font-size:0; border:0; }
#colorbox.im-modal-noticia #cboxClose::before { content:"\00d7"; font-size:28px; line-height:32px; color:#fff; }
#colorbox.im-modal-noticia #cboxCurrent, #colorbox.im-modal-noticia #cboxPrevious, #colorbox.im-modal-noticia #cboxNext { display:none !important; }
</style>
<script type="text/javascript">
(function ($) {
    if (!$ || !$.colorbox) return;
    $(document).on("click", "#btnNovaNoticia", function (e) {
        e.preventDefault();
        window.imModalSalvou = false;
        $.colorbox({
            href: this.href, iframe: true, title: "Nova Notícia",
            width: "92%", maxWidth: "1100px", height: "92%",
            overlayClose: true, escKey: true, fixed: true, scrolling: true, className: "im-modal-noticia",
            onOpen: function () { $("#cboxOverlay").addClass("im-modal-overlay"); },
            onClosed: function () { $("#cboxOverlay").removeClass("im-modal-overlay"); if (window.imModalSalvou) { window.location.reload(); } }
        });
    });
})(window.jQuery);
</script>

<script type="text/javascript">
function confirmaExclusao(valor) {
    if (confirm("Tem certeza que deseja EXCLUIR permanentemente esta notícia e seus anexos?")) {
        window.location.href = '?pagina=<?= $pagina ?>&menu=<?= $menu ?>&ac=ex&exc=' + valor + '&pg=<?= $pg ?>';
    }
}
</script>

<?php 
$drive->close(); 
?>