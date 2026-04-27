<?php

//---------------------------------------------------------------------
// busca as configurações e funções para mostrar corretamento o portal
//---------------------------------------------------------------------
require_once("scripts/php/config.php");
require_once("scripts/php/funcoes_bd.php");
require_once("scripts/php/funcoes.php");
$drive->conecta();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Prefeitura de Florianópolis</title>

  <link rel="stylesheet" href="layout/pmf-estilo.css" type="text/css">
  <link rel="stylesheet" href="layout/pmf-estilo-home-new-2.css" type="text/css">
  <link rel="stylesheet" href="scripts/slidesjs/css/global.css">
  <link rel="stylesheet" href="scripts/js/ui/jquery-ui.css">
  <link href="layout/imagens/brasao.gif" rel="shortcut icon" type="image/x-icon" />


	<!--	
	Pop up
	<script language="javascript">window.open('http://transparenciacovid.pmf.sc.gov.br/');</script>
	<script language="javascript">window.open('http://www.pmf.sc.gov.br/coronavirus/');</script>
	-->

</head>
<body>

  <div style="display:none">
	    <a href="mobile/" title="Link para o portal de acessibilidade">para acessar o portal no modulo de acessibilidade, acesse este link</a>
  </div>

  <?php
  	$menu_principal = "home";
  	include("layout/menus/menu_geral.php");
	?>

  <?php
    //home background Image
    $pathToFolder = CAMINHO_SITE."/layout/imagens/home-background";

    if(glob($pathToFolder.'/home.*')){
      $files = glob($pathToFolder . '/home.*');
    }else{
      $files = glob($pathToFolder . '/*.*');
    }

    $file = array_rand($files);
    $style="/layout/imagens/home-background/".basename($files[$file]);
  ?>
  <div class="flex-container hero-wrapper" style="background-image: url('<?=$style;?>')">
    <?php
       $buscaServicoTitle = "Encontre os serviços da Prefeitura de Florianópolis";
       $class = "search-bar--home";
       include(CAMINHO_SITE."/layout/themePMF/includes/buscaServicos.php");
   
       include(CAMINHO_SITE."/layout/themePMF/includes/servicosMaisAcessados.php");
       $carouselColumn = 4;
       $IdEntidade = 0;
       $noti_id = 0;
       $pageIsHome = true;
       $only2 = true;
       include(CAMINHO_SITE."/layout/themePMF/includes/home/noticias.php");
    ?>
  </div>

  <div class="flex-container services-and-news">
    <?php
    $only2 = false;
    $start = 2;
    include(CAMINHO_SITE."/layout/themePMF/includes/servicosCategorias.php");
    include(CAMINHO_SITE."/layout/themePMF/includes/home/noticias.php");
    ?>
  </div>

  <div class="flex-container blocks--home">
    <?php
      $bannerEntityId = 0;
      $bannersColumn = 8;
      include("layout/themePMF/includes/banners.php");
    ?>
  </div>

  <div class="flex-container">
	  <?php
      include(CAMINHO_SITE."/layout/themePMF/includes/consultaProcesso.php");
      include(CAMINHO_SITE."/layout/themePMF/includes/home/youtube.php");
    ?>
  </div>

  <div class="flex-container">
    <div class="column4-lg column4-md column8-sm">
      <?php
        include(CAMINHO_SITE."/layout/themePMF/includes/home/facebook.php");
      ?>
    </div>
    <div class="column4-lg column4-md column8-sm">
      <?php
        include(CAMINHO_SITE."/layout/themePMF/includes/home/instagram.php");
        $mostraTodosCalendario = true;
        $calendarioNumeroResult = 4;
        include(CAMINHO_SITE."/layout/themePMF/includes/home/calendario.php");
      ?>
    </div>
  </div>

  
  <script src="https://www.youtube.com/iframe_api"></script>
  <script src="/scripts/js/maskinput/inputmask.dependencyLib.min.js"></script>
  <script src="/scripts/js/maskinput/inputmask.min.js"></script>

  <script type="text/javascript">
      function loadScript( url, callback ) {
        var script = document.createElement( "script" )
        script.type = "text/javascript";
        if(script.readyState) {  //IE
          script.onreadystatechange = function() {
            if ( script.readyState === "loaded" || script.readyState === "complete" ) {
              script.onreadystatechange = null;
              callback();
            }
          };
        } else {  //Others
          script.onload = function() {
            callback();
          };
        }
        script.src = url;
        document.getElementsByTagName( "head" )[0].appendChild( script );
      }
  </script>

  <?php
    include("layout/rodape/rodape.php");
      $minJs = "/layout/themePMF/js/home.min.js";
      if (file_exists(CAMINHO_SITE.$minJs)){
      echo "<script src=\"$minJs\"></script>";
    }
  ?>


</body>
</html>