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
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-155180755-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-155180755-1');
</script>


<!-- Hotjar Tracking Code for http://www.pmf.sc.gov.br/tutorialnfps.php -->
<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:1578584,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
</script>


  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Solicitar NFPS PJ (sem MEI)</title>
     <?php
      echo("<link rel=\"stylesheet\" href=\"http://".$_SERVER['HTTP_HOST']."/../layout/pmf-estilo.css\">");
    ?>
  


    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Suporte Nota Fiscal Eletrônica - Prefeitura de Florianópolis. Como Solicitar NFPS PJ (sem MEI)."/>
    <meta name="keywords" content="Nota fiscal,nota fiscal eletrônica,nf, como solicitar Adesão, adesão, pj, pessoa juridica, juridica, solicitação, solicitar"/>
    <meta name="robots" content="max-snippet:-1, max-image-preview:large, max-video-preview:-1"/>
    <link rel="canonical" href="http://www.pmf.sc.gov.br/sistemas/suporte/nfpssuporte/adesaopjsemmei.php"/>
    <meta property="og:locale" content="pt_BR"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="Solicitar NFPS PJ (sem MEI)"/>
    <meta property="og:description" content="Suporte Nota Fiscal Eletrônica - Prefeitura de Florianópolis. Como Solicitar NFPS PJ (sem MEI)."/>
    <meta property="og:url" content="http://www.pmf.sc.gov.br/sistemas/suporte/nfpssuporte/adesaopjsemmei.php"/>
    <meta property="og:site_name" content="Solicitar NFPS PJ (sem MEI)"/>

  <link rel="stylesheet" href="../../scripts/slidesjs/css/global.css">
  <link rel="stylesheet" href="../../scripts/js/ui/jquery-ui.css">
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
<body>

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
<link rel="stylesheet" href="../../layout/themePMF/css/style.css">


<div id="conteudo_pagina" class="column6-lg" align="justify" style="margin:auto;">
 
  <a type="button" class="btn btn-primary botao" href="/tutorialnfps.php" style="color: white;margin-bottom:20px;margin-top: 20px">Home</a>
<h2 align="center">Como Solicitar Adesão ao Regime Eletrônico para Pessoa Jurídica (Exceto MEI)</h2>

<p>A Adesão ao Regime Eletrônico de Notas Fiscais para Pessoa Jurídica (Exceto Micro Empreendedor Individual) deverá ser realizada via Ficha de Inclusão e Alteração Cadastral - FIAC.</p>
<p>Para Escritórios Contábeis selecione o respectivo Contribuinte na opção Lista de Contribuintes vinculados.</p>
<br>
<hr style=" border-top: 1px solid black;">
<p>Acesse a FIAC - <a href="https://sefinnet3.pmf.sc.gov.br/fiac/" target="_blank">Clique Aqui</a>;</p>
<p>Selecione o Escritório Contábil;</p>

<img src="https://sefinnetweb.pmf.sc.gov.br/nfpse/fiac_solicitar_aedf_escritorio_0.png" width="100%"alt="">
<hr style=" border-top: 1px solid black;">
<p>Selecione a opção Lista de Contribuintes;</p>

<img src="https://sefinnetweb.pmf.sc.gov.br/nfpse/fiac_solicitar_aedf_escritorio_1.png" width="100%"alt="">
<hr style=" border-top: 1px solid black;">
<p>Selecione o Contribuinte, através do icone da Coluna AEDF;</p>

<img src="https://sefinnetweb.pmf.sc.gov.br/nfpse/fiac_solicitar_aedf_escritorio_2.png" width="100%"alt="">
<hr style=" border-top: 1px solid black;">
<p>Informe os dados de Telefone e E-mail caso necessário;</p>

<img src="https://sefinnetweb.pmf.sc.gov.br/nfpse/fiac_solicitar_aedf_escritorio_3.png" width="100%"alt="">
<hr style=" border-top: 1px solid black;">
<p>Selecionar a opção Solicitar no quadro de NFPS-e;</p>

<img src="https://sefinnetweb.pmf.sc.gov.br/nfpse/fiac_solicitar_aedf_escritorio_4.png" width="100%"alt="">
<hr style=" border-top: 1px solid black;">
<p>Selecionar a opção Aceito para finalizar o processo de Adesão do Regime Eletrônico.</p>

<img src="https://sefinnetweb.pmf.sc.gov.br/nfpse/fiac_solicitar_aedf_escritorio_5.png" width="100%"alt="">
<hr style=" border-top: 1px solid black;">
<p>Para Prepostos selecione a Opção AEDF.</p>

<p>Acesse a FIAC - <a href="https://sefinnet3.pmf.sc.gov.br/fiac/" target="_blank">Clique Aqui</a>;</p>
<p>Selecione a opção AEDF;</li>

<img src="https://sefinnetweb.pmf.sc.gov.br/nfpse/fiac_solicitar_aedf_preposto_0.png" width="100%" alt=""></p>
<hr style=" border-top: 1px solid black;">
<p>Informe os dados de Telefone e E-mail caso necessário;</p>

<img src="https://sefinnetweb.pmf.sc.gov.br/nfpse/fiac_solicitar_aedf_preposto_1.png" width="100%" alt="">
<hr style=" border-top: 1px solid black;">
<p>Selecionar a opção Solicitar no quadro de NFPS-e;</p>

<img src="https://sefinnetweb.pmf.sc.gov.br/nfpse/fiac_solicitar_aedf_preposto_2.png" width="100%" alt="">
<hr style=" border-top: 1px solid black;">
<p>Selecionar a opção Aceito para finalizar o processo de Adesão do Regime Eletrônico.</p>


<img src="https://sefinnetweb.pmf.sc.gov.br/nfpse/fiac_solicitar_aedf_preposto_3.png" width="100%" alt="">
 <hr style=" border-top: 1px solid black;">                  
       
<a type="button" class="btn btn-primary botao" href="/tutorialnfps.php" style="color: white;margin-bottom:20px;margin-top: 20px">Retornar</a>

</div>


</div>

<iframe src="https://sefinnetweb.pmf.sc.gov.br/Sefinnet/hotSite.vm?tela=AREA_WEB_ADESAO_PJ&sistema=3" width="0" height="0"></iframe>

  <div class="flex-container">
    <div class="column4-lg column4-md column8-sm">
      <div id="fb-root"></div>
<script>
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.10&appId=150853192172803";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>


   <!-- <a class="btn-block btn-primary btn-sm" href="../calendario.php">Ver calend&aacute;rio completo</span></a>
-->
    </div>
  </div>

<script src="/home/www/layout/themePMF/js/slick.min.js"></script>

<script src="/home/www/layout/themePMF/js/main.min.js"></script>

<?php include_once('/home/www/footerNfps.php'); ?>

<script src="layout/themePMF/js/home.min.js"></script>


</body>
</html>
