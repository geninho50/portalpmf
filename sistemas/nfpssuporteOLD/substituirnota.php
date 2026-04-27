<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
require_once("../../scripts/php/config.php");
require_once("../../scripts/php/funcoes_bd.php");
require_once("../../scripts/php/funcoes.php");
$drive->conecta();
$menu_principal = "home";
$charset = $_GET["charset"];
if(isset($charset)) {
  header('Content-Type: text/html; charset='.$charset);
} else {
  $charset = "UTF-8";
}

if(isset($_GET['aviso'])){
  $aviso=True;
}else{
  $aviso=False;
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-151895154-4"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-151895154-4');
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
  <title>Substituir Nota Eletrônica</title>
     <?php
      echo("<link rel=\"stylesheet\" href=\"http://".$_SERVER['HTTP_HOST']."/../layout/pmf-estilo.css\">");
    ?>
  <br>



    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Suporte Nota Fiscal Eletrônica - Prefeitura de Florianópolis. Como Substituir uma Nota Fiscal Eletrônica."/>
    <meta name="keywords" content="Nota fiscal,nota fiscal eletrônica,nf, como substituir nota fiscal, como substituir, como trocar nota fiscal, como trocar nfps, como substituir nota fiscal eletrônica, trocar,nota fiscal pmf substituição, nota florianópolis substituir, florianópolis, nota fiscal eletrônica substituir, substituir, substituição de nota fiscal"/>
    <meta name="robots" content="max-snippet:-1, max-image-preview:large, max-video-preview:-1"/>
    <link rel="canonical" href="http://www.pmf.sc.gov.br/sistemas/nfpsSuporte/SubstituirNota.php"/>
    <meta property="og:locale" content="pt_BR"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="Substituir Nota Eletrônica"/>
    <meta property="og:description" content="Suporte Nota Fiscal Eletrônica - Prefeitura de Florianópolis. Como Substituir uma Nota Fiscal Eletrônica."/>
    <meta property="og:url" content="http://www.pmf.sc.gov.br/sistemas/nfpsSuporte/SubstituirNota.php"/>
    <meta property="og:site_name" content="Substituir Nota Eletrônica"/>

  <link rel="stylesheet" href="/../layout/pmf-estilo.css" type="text/css">
  <link rel="stylesheet" href="../../layout/pmf-estilo-home-new-2.css" type="text/css">
  <link rel="stylesheet" href="../../scripts/slidesjs/css/global.css">
  <link rel="stylesheet" href="../../scripts/js/ui/jquery-ui.css">
  <link href="../../layout/imagens/brasao.gif" rel="shortcut icon" type="image/x-icon" />
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
    include("../../layout/menus/menu_geral.php");
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

<div id="conteudo_pagina" class="column6-lg" align="justify" style="margin:auto">

  <a type="button" class="btn btn-primary botao" href="/tutorialnfps.php" style="color: white;margin-bottom:20px;margin-top: 20px">Home</a>
  <h2 align="center">Como Substituir uma Nota Fiscal Eletrônica</h2>

    <video poster="../../arquivos/imagensNFPSe/thumbnail.png" width="600"  height="360"controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #474747; margin-left: 20%;">
      <source src="imagens/Substituir nota.mp4" type="video/mp4">
        Seu navegador não suporta HTML5.
      </video>
<br><br>

  <p>Através da opção de Substituição será possível Substituir uma Nota Fiscal nos casos em que determinadas informações estão incorretas. <strong>Estão vedados</strong> os casos de substituição para informações que venham a alterar a apuração do Imposto, tais como códigos <strong>CFPS, CST, Valor Contábil e Base de Cálculo.</strong></p>

  <p>Ao acessar o Sistema de NFPS-e o Contribunte deverá consultar sua Nota Fiscal Eletrônica a ser substituida.</p>
  <img src="../../arquivos/imagensNFPSe/ProcurarNota.png" alt="" width="100%">
  <br>
  <hr style=" border-top: 1px solid black;">
  <p>Selecione o icone a direita para ter acesso as demais opções. Selecione a opção "Substituir".</p>
  <img src="../../arquivos/imagensNFPSe/OpcaoSubstituir.png" alt="" width="100%">
   <hr style=" border-top: 1px solid black;">
  <p>Edite as informações do Tomador que precisam e podem ser alteradas. Clique em "Prosseguir".</p>
  <img src="../../arquivos/imagensNFPSe/Tomador.png" alt="" width="100%">
   <hr style=" border-top: 1px solid black;">
  <p>Edite as informações do Serviço que precisam e podem ser alteradas. Clique em "Prosseguir".</p>
  <img src="../../arquivos/imagensNFPSe/Servicos.png" alt="" width="100%">
   <hr style=" border-top: 1px solid black;">
  <p>Visualize as informações, conferindo se os dados estão corretos e prossiga selecionando "Transmitir".</p>
  <img src="../../arquivos/imagensNFPSe/Fim.png" alt="" width="100%">
   <hr style=" border-top: 1px solid black;">
  <p>O sistema apresentará a mensagem de Nota Fiscal Transmitida com Sucesso e o envio da mesma por e-mail, estando também disponível para consulta.</p>
  <img src="../../arquivos/imagensNFPSe/Final.png" alt="" width="100%">                   
  <br>   
<hr style=" border-top: 1px solid black;">
  <a type="button" class="btn btn-primary botao" href="/tutorialnfps.php" style="color: white;margin-bottom:20px;margin-top: 20px">Retornar</a>              
</div>


<div id="popup_novo_site" align="center" style="display:none; position:fixed;bottom:20px;left:5%;width:360px;height: 80px;background-color: white;border: 2px solid #5A7696;color: #13A0DD">
 <button type="button" onclick="fechaPopup()" style="float:right;color: white;background-color: #F17446">X</button> 
 <br>
 Bem vindo(a) ao novo site de Suporte da Nota Eletrônica! <a href="/tutorialnfps.php" target="_blank" style="text-decoration: underline;">Clique aqui</a> para conhecer a Central.
</div>


<iframe src="https://sefinnetweb.pmf.sc.gov.br/Sefinnet/hotSite.vm?tela=AREA_WEB_COMO_SUBSTITUIR&sistema=3" width="0" height="0"></iframe>

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

  <script type="text/javascript" src="../sistemas/Biblioteca/js/validadores.js"></script>  
  <script src="../sistemas/MinhocaCabeca/assets/js/jquery.min.js"></script>
  <script src="../sistemas/MinhocaCabeca/assets/js/jquery.maskedinput.min.js" type="text/javascript"></script> 
  <script src='http://momentjs.com/downloads/moment.min.js'></script>
 
<script src="../../layout/themePMF/js/slick.min.js"></script>

<script src="../../layout/themePMF/js/main.min.js"></script>

<?php include_once('../../footerNfps.php'); ?>

<script src="layout/themePMF/js/home.min.js"></script>

<script>
  
  function carregaPopup(){
    
      var mostrarPopup = "<?php echo $aviso ?>";
       if(mostrarPopup==1){
           document.getElementById("popup_novo_site").style.display = "block";
        }
  }
  function fechaPopup(){
    document.getElementById("popup_novo_site").style.display = "none";
  }

</script>


</body>
</html>
