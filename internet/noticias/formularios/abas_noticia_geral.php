<?php
// Captura e higienização das variáveis de URL
$menuId = isset($_GET['menu']) ? htmlspecialchars($_GET['menu']) : '';
$paginaAtual = isset($_GET['pagina']) ? htmlspecialchars($_GET['pagina']) : '';

// Definição exata dos modificadores de estado baseados nas imagens do inspetor
$abaEdicao    = ($paginaAtual === "notcons") ? "aba-ativa" : "aba-inativa";
$abaPublicada = ($paginaAtual === "notipub") ? "aba-ativa" : "aba-inativa";
$abaLocalizar = ($paginaAtual === "noticons") ? "aba-ativa" : "aba-inativa";
?>

<div class="abas-navegacao im-abas-container">
    <a class="aba-item <?= $abaEdicao ?> im-aba-primeira" href="inicio.php?pagina=notcons&menu=<?= urlencode($menuId) ?>">Em Edição</a>
    <a class="aba-item <?= $abaPublicada ?>" href="inicio.php?pagina=notipub&menu=<?= urlencode($menuId) ?>">Publicadas</a>
    <a class="aba-item <?= $abaLocalizar ?>" href="inicio.php?pagina=noticons&menu=<?= urlencode($menuId) ?>">Localizar</a>
</div>