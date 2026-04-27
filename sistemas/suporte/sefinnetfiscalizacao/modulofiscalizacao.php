<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
require_once("/home/www/scripts/php/config.php");
require_once("/home/www/scripts/php/funcoes_bd.php");
require_once("/home/www/scripts/php/funcoes.php");
$drive->conecta();
$menu_principal = "home";
$charset = $_GET["charset"];
if(isset($charset)) {
  header('Content-Type: text/html; charset='.$charset);
} else {
  $charset = "UTF-8";
}

session_start();
 if ( !isset($_SESSION["usuario"])) {
  echo "<script>location.href='/tutorialfiscalizacao.php';</script>"; 
} 

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>


<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-155089928-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-155089928-1');
</script>

<!-- Hotjar Tracking Code for http://www.pmf.sc.gov.br/tutorialsefinnet.php -->
<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:1614853,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
</script>


  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Módulo Fiscalização</title>
     <?php
      echo("<link rel=\"stylesheet\" href=\"http://".$_SERVER['HTTP_HOST']."/home/www/layout/pmf-estilo.css\">");
    ?>
  <br>



  <link rel="stylesheet" href="/../layout/pmf-estilo.css" type="text/css">
  <link rel="stylesheet" href="/home/www/layout/pmf-estilo-home-new-2.css" type="text/css">
  <link rel="stylesheet" href="/home/www/scripts/slidesjs/css/global.css">
  <link rel="stylesheet" href="/home/www/scripts/js/ui/jquery-ui.css">
  <link href="../../../layout/imagens/brasao.gif" rel="shortcut icon" type="image/x-icon" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <style>
  @media (max-width: 960px) {
    video{
      width:100%;
      margin-left: 0% !important;
    }
    #conteudo_pagina{
      margin-left: 10px !important;
      margin-right: 10px !important;
    }

    #popup_novo_site{
      width: 70% !important;
    }
  }
  </style>

</head>
<body onload="carregaPopup()">

  <?php
    include("/home/www/layout/menus/menu_geral.php");
    echo("<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js\"></script>");
?>
<form name="formulario">

  <div style="display:none">
      <a href="mobile/" title="Link para o portal de acessibilidade">para acessar o portal no modulo de acessibilidade, acesse este link</a>
  </div>

    <script>

  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-54979843-1', 'auto');
  ga('send', 'pageview');

</script>


<link href="https://fonts.googleapis.com/css?family=Montserrat:300??,400,500,600,700" rel="stylesheet">
<link rel="stylesheet" href="/home/www/layout/themePMF/css/style.css">

<a type="button" class="btn btn-primary botao" href="/tutorialfiscalizacao.php" style="color: white;margin-left: 60px ;margin-top: 20px;margin-bottom: 10px">Retornar</a>
<br>

Seu progresso:
<div style="background:grey; width: 25%; margin-left: 10px;height:10px">
          <div style="width:0%;background:green;text-align:center; height:100%;" id="barra"></div>
 </div>

 <button type="button"  onclick= "mudaExibicao();" style="float:right; background: #bababa">Modo Exibição</button>




<div style="display: center">

 <div id= "videoContainer" style="grid-template-columns: auto auto auto;" align="center">


  <div>
    <video poster="videosrastreabilidade/thumbnail.png" width="320"  height="240"controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #474747">
      <source src="videosrastreabilidade/emitirordem.mp4" type="video/mp4">
        Seu navegador não suporta HTML5.
      </video>
    <h4 id="titulotest">Aula 01 - Emitir Ordem de Serviço</h4>
  </div>


  <div>
    <video poster="videosrastreabilidade/thumbnail.png" width="320"  height="240"controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #474747">
      <source src="videosrastreabilidade/solicitarordem.mp4" type="video/mp4">
        Seu navegador não suporta HTML5.
      </video>
    <h4>Aula 02 - Solicitar Ordem de Serviço</h4>
  </div>



   <div>
    <video poster="videosrastreabilidade/thumbnail.png" width="320"  height="240"controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #474747">
      <source src="videosrastreabilidade/termoinicio.mp4" type="video/mp4">
        Seu navegador não suporta HTML5.
      </video>
    <h4>Aula 03 - Emitir Termo de Inicio</h4>
  </div>


  <div>
    <video poster="videosrastreabilidade/thumbnail.png" width="320"  height="240"controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #474747">
      <source src="videosrastreabilidade/termoprorrog.mp4" type="video/mp4">
        Seu navegador não suporta HTML5.
      </video>
    <h4>Aula 04 - Emitir Termo de Prorrogação</h4>
  </div>

  <div>
    <video poster="videosrastreabilidade/thumbnail.png" width="320"  height="240"controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #474747">
      <source src="videosrastreabilidade/termoencerramento.mp4" type="video/mp4">
        Seu navegador não suporta HTML5.
      </video>
    <h4>Aula 05 - Emitir Termo de Encerramento</h4>
  </div>

  <div>
    <video poster="videosrastreabilidade/thumbnail.png" width="320"  height="240"controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #474747">
      <source src="videosrastreabilidade/quadrotermo.mp4" type="video/mp4">
        Seu navegador não suporta HTML5.
      </video>
    <h4>Aula 06 - Visualizar Quadro de Acompanhamento</h4>
  </div>

    <div>
    <video poster="videosrastreabilidade/thumbnail.png" width="320"  height="240"controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #474747">
      <source src="videosrastreabilidade/quadrotermo.mp4" type="video/mp4">
        Seu navegador não suporta HTML5.
      </video>
    <h4>Aula 07 - Como Emitir uma Intimação</h4>
  </div>

  <div>
    <video poster="videosrastreabilidade/thumbnail.png" width="320"  height="240"controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #474747">
      <source src="videosrastreabilidade/auto.mp4" type="video/mp4">
        Seu navegador não suporta HTML5.
      </video>
    <h4>Aula 08 - Como emitir um Auto de Infração</h4>
  </div>


   <div>
    <video poster="videosrastreabilidade/thumbnail.png" width="320"  height="240"controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #474747">
      <source src="videosrastreabilidade/circunstanciado.mp4" type="video/mp4">
        Seu navegador não suporta HTML5.
      </video>
    <h4>Aula 10 - Como Emitir Termo Circunstanciado</h4>
  </div>


   <div>
    <video poster="videosrastreabilidade/thumbnail.png" width="320"  height="240"controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #474747">
      <source src="videosrastreabilidade/papeis.mp4" type="video/mp4">
        Seu navegador não suporta HTML5.
      </video>
    <h4>Aula 15 - Anexar Papeis de trabalho</h4>
  </div>





</div>

</div>








<br>


<script src="/home/www/layout/themePMF/js/slick.min.js"></script>

<script src="/home/www/layout/themePMF/js/main.min.js"></script>

<?php include_once('/home/www/footerRastreabilidade.php'); ?>

<script src="layout/themePMF/js/home.min.js"></script>


<script>

var exibeComoLista = true;

var videoContainer = document.getElementById("videoContainer");

function mudaExibicao(){
  exibeComoLista = !exibeComoLista;


  if(!exibeComoLista){
      videoContainer.style.display = "grid";
  }else{
      videoContainer.style.display = "list-item";
  }
}



</script>

</body>
</html>
