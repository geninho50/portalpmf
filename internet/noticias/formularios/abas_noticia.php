<?php
// Captura e higienização segura das variáveis de navegação
$noticiaId = isset($_GET['n']) ? (int)$_GET['n'] : 0;
$menuId = isset($_GET['menu']) ? htmlspecialchars($_GET['menu']) : '';
$paginaAtual = isset($_GET['pagina']) ? htmlspecialchars($_GET['pagina']) : '';

// Definição dos estados com base estrita no seu painel CSS
$abaDados   = ($paginaAtual === "notedit" || $paginaAtual === "addedit") ? "aba-ativa" : "aba-inativa";
$abaImg     = ($paginaAtual === "nimg") ? "aba-ativa" : "aba-inativa";
$abaMidia   = ($paginaAtual === "nmidia") ? "aba-ativa" : "aba-inativa";
$abaDoc     = ($paginaAtual === "ndoc") ? "aba-ativa" : "aba-inativa";
$abaViz     = ($paginaAtual === "nview") ? "aba-ativa" : "aba-inativa";
?>

<!-- Estilos para layout responsivo das abas de navegação -->
<style>
    .im-abas-container {
        display: flex !important;
        flex-direction: row !important;
        flex-wrap: nowrap !important;
        width: 100% !important;
        gap: 6px !important;
        box-sizing: border-box !important;
    }

    .im-abas-container .aba-item {
        flex: 1 !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 8px !important;
        padding: 10px !important;
        text-align: center !important;
        text-decoration: none !important;
        box-sizing: border-box !important;
        white-space: nowrap !important;
    }

    .im-abas-container .aba-item i {
        font-size: 1rem;
    }

    /* Ajuste para telas menores (Mobile) */
    @media (max-width: 768px) {
        .im-abas-container {
            padding: 0px !important;
            gap: 4px !important;
        }

        .im-abas-container .aba-item {
            padding: 8px 1px !important;
            justify-content: center !important;
        }

        /* Oculta o texto no mobile */
        .im-abas-container .aba-texto {
            display: none !important;
        }

        /* Aumenta o tamanho do ícone no mobile */
        .im-abas-container .aba-item i {
            font-size: 1.25rem !important;
            margin: 0 !important;
        }
         .im-abas-container .aba-item{
            margin:0px !important;
         }
    }
</style>

<script type="text/javascript">
    // Controla o tamanho do modal em visualizar
$(document).ready(function(){
    $(".view_noticia").colorbox({
        iframe: true,
        width: "800",
        height: "90%"
    });
});
</script>

<div class="abas-navegacao im-abas-container">
    <?php if ($noticiaId === 0) { ?>
        
        <!-- MODO INCLUSÃO: Apenas a primeira ativa, demais sem href -->
        <a class="aba-item aba-ativa im-aba-primeira" title="Dados">
            <i class="fa-solid fa-pen-to-square"></i>
            <span class="aba-texto">Dados</span>
        </a>
        <a class="aba-item aba-inativa" style="opacity: 0.6; cursor: not-allowed;" title="Imagens">
            <i class="fa-solid fa-images"></i>
            <span class="aba-texto">Imagens</span>
        </a>
        <a class="aba-item aba-inativa" style="opacity: 0.6; cursor: not-allowed;" title="Mídias">
            <i class="fa-solid fa-photo-film"></i>
            <span class="aba-texto">Mídias</span>
        </a>
        <a class="aba-item aba-inativa" style="opacity: 0.6; cursor: not-allowed;" title="Arquivos">
            <i class="fa-solid fa-folder-open"></i>
            <span class="aba-texto">Arquivos</span>
        </a>
        <a class="aba-item aba-inativa" style="opacity: 0.6; cursor: not-allowed;" title="Visualizar">
            <i class="fa-solid fa-eye"></i>
            <span class="aba-texto">Visualizar</span>
        </a>

    <?php } else { ?>
        
        <!-- MODO EDIÇÃO: Links estruturados diretamente na tag <a> -->
        <a class="aba-item <?= $abaDados ?> im-aba-primeira" href="inicio.php?pagina=notedit&menu=<?= $menuId ?>&n=<?= $noticiaId ?>" title="Dados">
            <i class="fa-solid fa-pen-to-square"></i>
            <span class="aba-texto">Dados</span>
        </a>
        <a class="aba-item <?= $abaImg ?>" href="inicio.php?pagina=nimg&menu=<?= $menuId ?>&n=<?= $noticiaId ?>" title="Imagens">
            <i class="fa-solid fa-images"></i>
            <span class="aba-texto">Imagens</span>
        </a>
        <a class="aba-item <?= $abaMidia ?>" href="inicio.php?pagina=nmidia&menu=<?= $menuId ?>&n=<?= $noticiaId ?>" title="Mídias">
            <i class="fa-solid fa-photo-film"></i>
            <span class="aba-texto">Mídias</span>
        </a>
        <a class="aba-item <?= $abaDoc ?>" href="inicio.php?pagina=ndoc&menu=<?= $menuId ?>&n=<?= $noticiaId ?>" title="Arquivos">
            <i class="fa-solid fa-folder-open"></i>
            <span class="aba-texto">Arquivos</span>
        </a>
        <a class="aba-item <?= $abaViz ?> view_noticia" href="noticias/view/view_noticia.php?n=<?= $noticiaId ?>" title="Visualizar">
            <i class="fa-solid fa-eye"></i>
            <span class="aba-texto">Visualizar</span>
        </a>

    <?php } ?>
</div>