<?php
 require_once "Mobile_Detect.php";
 $urlHost = $_SERVER['HTTP_HOST'];
 $urlUri = $_SERVER['REQUEST_URI'];
?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700" rel="stylesheet">

<!-- Folha de Estilos do Tema e do Colorbox -->
<link rel="stylesheet" href="https://<?php echo($urlHost);?>/layout/themePMF/css/style.css?v=<?php echo @filemtime(dirname(dirname(__FILE__)).'/css/style.css'); ?>">
<link rel="stylesheet" href="https://<?php echo($urlHost);?>/scripts/colorbox/colorbox.css">

<script src="https://cdn.tailwindcss.com"></script>

<!-- 1. Biblioteca Principal do jQuery (baseada na estrutura de assets) -->
<?php if (!(isset($menu_principal) && $menu_principal === 'intranet')): ?>
<script src="https://<?php echo($urlHost);?>/assets/js/jquery.min.js"></script>

<!-- 2. Plugins de Interface e Efeitos -->
<script src="https://<?php echo($urlHost);?>/scripts/js/ui/jquery-ui.min.js"></script>
<script src="https://<?php echo($urlHost);?>/scripts/js/jquery/jquery.easing.min.js"></script>

<!-- 3. Plugin Colorbox (conforme directório de scripts) -->
<script src="https://<?php echo($urlHost);?>/scripts/colorbox/jquery.colorbox.js"></script>
<?php endif; ?>

<!-- 4. Google reCAPTCHA e outros componentes externos -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<!-- 5. Scripts Personalizados do Tema (por último) -->
<?php if (!(isset($menu_principal) && $menu_principal === 'intranet')): ?>
<script src="https://<?php echo($urlHost);?>/layout/themePMF/js/home.min.js"></script>
<?php endif; ?>
