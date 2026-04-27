<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
require_once("scripts/php/config.php");
require_once("scripts/php/funcoes_bd.php");
require_once("scripts/php/funcoes.php");
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
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-151895154-2"></script>
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
  <title>Prefeitura de Florianópolis</title>
     <?php
      echo("<link rel=\"stylesheet\" href=\"http://".$_SERVER['HTTP_HOST']."/layout/pmf-estilo.css\">");
    ?>
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
  

</head>
<body>
<?php
    include("layout/menus/menu_geral.php");
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

<a type="button" class="btn btn-primary botao" href="/tutorialnfps.php" style="color: white;margin-left: 60px ;margin-top: 20px;margin-bottom: 10px">Retornar</a>

<div style="display:flex;">

 <div class="col-md-12" align="center">
   <div class="col-md-4">
    <video poster="sistemas/suporte/nfpssuporte/imagens/thumbnail.png" width="320"  height="240"controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #474747">
      <source src="sistemas/suporte/nfpssuporte/imagens/Emitir nota.mp4" type="video/mp4">
        Seu navegador não suporta HTML5.
      </video>
    <a href="sistemas/suporte/nfpssuporte/emitirnota.php" target="_blank"><h4>Emitir Nota Eletrônica 🔗</h4></a>
  </div>


 <div class="col-md-4">
    <video poster="sistemas/suporte/nfpssuporte/imagens/thumbnail.png" width="320"  height="240"controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #474747">
      <source src="sistemas/suporte/nfpssuporte/imagens/Emitir nota simplificada.mp4" type="video/mp4">
        Seu navegador não suporta HTML5.
      </video>
    <a href="sistemas/suporte/nfpssuporte/emitirnotasimplificada.php" target="_blank"><h4>Emitir Nota Simplificada 🔗</h4></a>
  </div>

 <div class="col-md-4">
    <video poster="sistemas/suporte/nfpssuporte/imagens/thumbnail.png" width="320"  height="240"controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #474747">
      <source src="sistemas/suporte/nfpssuporte/imagens/Emitir Nota Celular.mp4" type="video/mp4">
        Seu navegador não suporta HTML5.
      </video>
     <a href="sistemas/suporte/nfpssuporte/emitirnotacelular.php" target="_blank"><h4>Emitir Nota no Celular 🔗</h4></a>
  </div>

  <div class="col-md-4">
    <video poster="sistemas/suporte/nfpssuporte/imagens/thumbnail.png" width="320"  height="240"controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #474747">
      <source src="sistemas/suporte/nfpssuporte/imagens/Substituir nota.mp4" type="video/mp4">
        Seu navegador não suporta HTML5.
      </video>
     <a href="sistemas/suporte/nfpssuporte/substituirnota.php" target="_blank"><h4>Substituir Nota 🔗</h4></a>
  </div>

  <div class="col-md-4">
    <video poster="sistemas/suporte/nfpssuporte/imagens/thumbnail.png" width="320"  height="240"controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #474747">
      <source src="sistemas/suporte/nfpssuporte/imagens/Clonar Nota.mp4" type="video/mp4">
        Seu navegador não suporta HTML5.
      </video>
    <a href="sistemas/suporte/nfpssuporte/clonarnota.php" target="_blank"><h4>Copiar Nota 🔗</h4></a>
  </div>


  <div class="col-md-4">
    <video poster="sistemas/suporte/nfpssuporte/imagens/thumbnail.png" width="320"  height="240"controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #474747">
      <source src="sistemas/suporte/nfpssuporte/imagens/Cancelar Nota.mp4" type="video/mp4">
        Seu navegador não suporta HTML5.
      </video>
    <a href="sistemas/suporte/nfpssuporte/cancelarnota.php" target="_blank"><h4>Cancelar Nota 🔗</h4></a>
  </div>

    <div class="col-md-4">
    <video poster="sistemas/suporte/nfpssuporte/imagens/thumbnail.png" width="320"  height="240"controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #474747">
      <source src="sistemas/suporte/nfpssuporte/imagens/BaixarXmlPdf.mp4" type="video/mp4">
        Seu navegador não suporta HTML5.
      </video>
    <a href="sistemas/suporte/nfpssuporte/baixarxmlpdf.php" target="_blank"><h4>Baixar XML e PDF da Nota 🔗</h4></a>
  </div>

    <div class="col-md-4">
    <video poster="sistemas/suporte/nfpssuporte/imagens/thumbnail.png" width="320"  height="240"controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #474747">
      <source src="sistemas/suporte/nfpssuporte/imagens/Trocar Senha.mp4" type="video/mp4">
        Seu navegador não suporta HTML5.
      </video>
    <a href="sistemas/suporte/nfpssuporte/recuperarsenha.php" target="_blank"><h4>Recuperar/Trocar Senha 🔗</h4></a>
  </div>


 <div class="col-md-4">
    <video poster="sistemas/suporte/nfpssuporte/imagens/thumbnail.png" width="320"  height="240"controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #474747">
      <source src="sistemas/suporte/nfpssuporte/imagens/AdesaoPf.mp4" type="video/mp4">
        Seu navegador não suporta HTML5.
      </video>
    <a href="sistemas/suporte/nfpssuporte/adesaopf.php" target="_blank"><h4>Adesão Pessoa Física 🔗</h4></a>
  </div>
 

  <div class="col-md-4">
    <video poster="sistemas/suporte/nfpssuporte/imagens/thumbnail.png" width="320"  height="240"controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #474747">
      <source src="sistemas/suporte/nfpssuporte/imagens/nfpse_consultar.mp4" type="video/mp4">
        Seu navegador não suporta HTML5.
      </video>
    <a href="sistemas/suporte/nfpssuporte/consultar.php" target="_blank"><h4>Consultar Nota 🔗</h4></a>
  </div>

  <div class="col-md-4">
    <video poster="sistemas/suporte/nfpssuporte/imagens/thumbnail.png" width="320"  height="240"controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #474747">
      <source src="sistemas/suporte/nfpssuporte/imagens/nfpse_limitesn.mp4" type="video/mp4">
        Seu navegador não suporta HTML5.
      </video>
    <a href="sistemas/suporte/nfpssuporte/limitesn.php" target="_blank"><h4>Limite Simples Nacional 🔗</h4></a>
  </div>

</div>

</div>



<a type="button" class="btn btn-primary botao" href="/tutorialnfps.php" style="color: white;margin-left: 60px ;margin-top: 20px;margin-bottom: 10px">Retornar</a>


<iframe src="https://sefinnetweb.pmf.sc.gov.br/Sefinnet/hotSite.vm?tela=AREA_WEB_CENTRAL_VIDEOS&sistema=3" width="0" height="0"></iframe>

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

 
<script src="../../layout/themePMF/js/slick.min.js"></script>

<script src="../../layout/themePMF/js/main.min.js"></script>

<?php include_once('footerNfps.php'); ?>

<script src="layout/themePMF/js/home.min.js"></script>

</body>
</html>
