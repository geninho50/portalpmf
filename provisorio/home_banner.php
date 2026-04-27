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

  <link rel="stylesheet" type="text/css" href="scripts/js/livevalidation/livevalidation13.css" />
  <link rel="stylesheet" href="scripts/colorbox/colorbox.css" type="text/css" media="screen"/>

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
      // include(CAMINHO_SITE."/layout/themePMF/includes/consultaProcessoProvisorio.php");
      include(CAMINHO_SITE."/layout/themePMF/includes/consultaProcessoProvisorio.php");
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
 
 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

<!--
-->  
<style>
    .float{ 
            right:80px; 
            position:fixed; 
            width:80px; 
            height:110px; 
            bottom:30px;
            border-radius:10px;
            box-shadow: 2px 2px 3px #999;
            background-image:url(sistemas/tainha/logoComFundoA.png); 
            background-size:100%; 
            text-align:center;
            font-size:30px; 
            z-index:100;} 

    .floatDiretor{ 
            right:200px; 
            position:fixed; 
            width:80px; 
            height:110px; 
            bottom:30px;
            border-radius:10px;
            box-shadow: 2px 2px 3px #999;
            background-image:url(sistemas/tainha/logoPlanoDiretor.png); 
            background-size:100%; 
            text-align:center;
            font-size:30px; 
            z-index:100;} 	

	.estiloTotal{ 
			font-size:15px;
			line-height:70px;
			color:#FFFFFF;}
						
  .estiloTotalDiretor{ 
			font-size:15px;
			line-height:70px;
			color:#FFFFFF;}

    .my-float{  margin-top:80px;
                font-size:15px;
                color:black;  }
</style> 

<a href="https://www.pmf.sc.gov.br/sistemas/tainha/" class="float"  target="_blank">
  <b class= "estiloTotal">132.423</b>
</a>

<a href="http://ipuf.pmf.sc.gov.br/pd2022/" class="floatDiretor"  target="_blank">
  <b class= "estiloTotalDiretor"></b>
</a>

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

<!-- show Modal -->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" charset="utf-8"></script>
<script type="text/javascript" src="scripts/js/livevalidation/livevalidation13.js"></script>
<script type="text/javascript" src="scripts/js/jmask/jquery.maskedinput.js" ></script>
<script type="text/javascript" src="scripts/js/jdrag-n-drop/jquery-ui-1.7.1.custom.min.js"></script>
<script type="text/javascript" src="scripts/colorbox/jquery.colorbox.js"></script>
<script type="text/javascript" src="scripts/js/tiny_mce/tiny_mce_src.js"></script>
<script type="text/javascript" src="scripts/js/funcoes.js" ></script>

<script src="/layout/themePMF/js/slick.min.js"></script>

<script src="/layout/themePMF/js/main.min.js"></script>
<div id="abas_img" style="display:none" ><a class="view_noticia" href="http://ipuf.pmf.sc.gov.br/pd2022/"></a></div>

<script>
	$(".view_noticia").colorbox({iframe:true, width:"850", height:"80%"});
  $("#bannerAbertura").trigger('click');
</script>

</body>
</html>