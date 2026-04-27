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
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-151895154-5"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-151895154-5');
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
  <title>Vídeos Sefinnet</title>
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



<div style="margin-left: 60px">
  <a type="button" class="btn btn-primary botao" href="/tutorialsefinnet.php" style="color: white;margin-bottom:20px;margin-top: 20px">Home</a>
  <br>
  <b>Filtros de vídeos:</b>

  <select onchange = "changeStatus(this.value)" id="filtro" class="busca-home-field">
  <option value="0" >Envio</option> 
  <option value="1" >GIF</option>
  <option value="2" >DES</option>
  <option value="3" >Impressões</option>
  </select>

</div>

<div id="envioVideos"  style="display:flex;">

 <div class="col-md-12" align="center">
   <div class="col-md-4">
    <video width="320"  height="240"controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #474747">
      <source src="sistemas/suporte/sefinnetsuporte/imagens/Envio.mp4" type="video/mp4">
        Seu navegador não suporta HTML5.
      </video>
    <h4>Envio Declarações</h4>
  </div>

   <div class="col-md-4">
    <video width="320"  height="240"controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #474747">
      <source src="sistemas/suporte/sefinnetsuporte/imagens/Checklist.mp4" type="video/mp4">
        Seu navegador não suporta HTML5.
      </video>
    <h4>Executar Checklist</h4>
  </div>

  <div class="col-md-4">
    <video width="320"  height="240"controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #474747">
      <source src="sistemas/suporte/sefinnetsuporte/imagens/Importacao.mp4" type="video/mp4">
        Seu navegador não suporta HTML5.
      </video>
    <h4>Importação</h4>
  </div>

</div>

</div>




<div id="gifVideos"  style="display:none;">

 <div class="col-md-12" align="center">
  <div class="col-md-4">
    <video   width="320" height="240" controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #474747">
      <source src="sistemas/suporte/sefinnetsuporte/imagens/GIF PF.mp4" type="video/mp4">
        Seu navegador não suporta HTML5.
      </video>
       <a href="sistemas/suporte/sefinnetsuporte/gifpf.php"><h4>GIF PF🔗</h4></a>
  </div>

  <div class="col-md-4">
    
    <video width="320" height="240" controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #474747">
      <source src="sistemas/suporte/sefinnetsuporte/imagens/GIF PJ.mp4" type="video/mp4">
        Seu navegador não suporta HTML5.
      </video>
   <a href="sistemas/suporte/sefinnetsuporte/gifpj.php"><h4>GIF PJ🔗</h4></a>
  </div>

  <div class="col-md-4">

    <video width="320"  height="240"controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #474747">
      <source src="sistemas/suporte/sefinnetsuporte/imagens/GIF SS.mp4" type="video/mp4">
        Seu navegador não suporta HTML5.
      </video>
    <a href="sistemas/suporte/sefinnetsuporte/gifss.php"><h4>GIF SS🔗</h4></a>
  </div>

  <div class="col-md-4">
    <video width="320" height="240" controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #474747"> 
      <source src="sistemas/suporte/sefinnetsuporte/imagens/GIF ST.mp4" type="video/mp4">
        Seu navegador não suporta HTML5.
      </video>
      <a href="sistemas/suporte/sefinnetsuporte/gifst.php"><h4>GIF ST🔗</h4></a>
  </div>


    <div class="col-md-4">
      <video width="320" height="240" controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #474747"> 
        <source src="sistemas/suporte/sefinnetsuporte/imagens/GIF IF MENSAL.mp4" type="video/mp4">
          Seu navegador não suporta HTML5.
        </video>
      <h4>GIF IF Mensal</h4>
   </div>

  <div class="col-md-4">
    <video width="320" height="240" controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #474747"> 
      <source src="sistemas/suporte/sefinnetsuporte/imagens/Balancete.mp4" type="video/mp4">
        Seu navegador não suporta HTML5.
      </video>
      <h4>Balancete Analítico Anual</h4>
  </div>


  <div class="col-md-4">
    <video width="320" height="240" controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #474747"> 
      <source src="sistemas/suporte/sefinnetsuporte/imagens/Plano Geral.mp4" type="video/mp4">
        Seu navegador não suporta HTML5.
      </video>
      <h4>Plano Geral de Contas Comentado</h4>
  </div>
</div>

</div>


 <div id="desVideos"  style="display:none;">

  <div class="col-md-12" align="center">
  <div class="col-md-4">
    <video   width="320" height="240" controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #474747">
      <source src="sistemas/suporte/sefinnetsuporte/imagens/Prestador-Tomador.mp4" type="video/mp4">
        Seu navegador não suporta HTML5.
      </video>
       <h4>Prestador-Tomador</h4>
  </div>

  <div class="col-md-4">
    
    <video width="320" height="240" controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #474747">
      <source src="sistemas/suporte/sefinnetsuporte/imagens/Documentos Fiscais.mp4" type="video/mp4">
        Seu navegador não suporta HTML5.
      </video>
   <h4>Documentos Fiscais</h4>
  </div>

  <div class="col-md-4">

    <video width="320"  height="240"controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #474747">
      <source src="sistemas/suporte/sefinnetsuporte/imagens/DES SP.mp4" type="video/mp4">
        Seu navegador não suporta HTML5.
      </video>
    <a href="sistemas/suporte/sefinnetsuporte/dessp.php"><h4>DES SP (Serviços Prestados)🔗</h4></a>
  </div>

  <div class="col-md-4">
    <video width="320" height="240" controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #474747">
      <source src="sistemas/suporte/sefinnetsuporte/imagens/DES ST.mp4" type="video/mp4">
        Seu navegador não suporta HTML5.
      </video>
      <a href="sistemas/suporte/sefinnetsuporte/desst.php"><h4>DES ST (Serviços Tomados)🔗</h4></a>
  </div>
</div>

</div>


 <div id="impressoesVideos" style="display:none;">

 <div class="col-md-12" align="center">
  <div class="col-md-4">
    <video   width="320" height="240" controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #474747">
      <source src="sistemas/suporte/sefinnetsuporte/imagens/Demonstrativo de debito.mp4" type="video/mp4">
        Seu navegador não suporta HTML5.
      </video>
       <a href="/sistemas/suporte/sefinnetsuporte/demonstrativodebito.php"><h4>Demonstrativo de Débitos🔗</h4></a>
  </div>

  <div class="col-md-4">
    <video   width="320" height="240" controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #474747">
      <source src="sistemas/suporte/sefinnetsuporte/imagens/Demonstrativo pagamento.mp4" type="video/mp4">
        Seu navegador não suporta HTML5.
      </video>
       <a href="/sistemas/suporte/sefinnetsuporte/demonstrativopagamento.php"><h4>Demonstrativo de Pagamentos🔗</h4></a>
  </div>

  <div class="col-md-4">
    
    <video width="320" height="240" controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #474747">
      <source src="sistemas/suporte/sefinnetsuporte/imagens/Impressao DAM.mp4" type="video/mp4">
        Seu navegador não suporta HTML5.
      </video>
   <a href="/sistemas/suporte/sefinnetsuporte/consultardam.php"><h4>Impressão/Consulta DAM🔗</h4></a>
  </div>

  <div class="col-md-4">
    
    <video width="320" height="240" controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #474747">
      <source src="sistemas/suporte/sefinnetsuporte/imagens/Recibos de Envio.mp4" type="video/mp4">
        Seu navegador não suporta HTML5.
      </video>
   <h4>Recibos de Envio</h4>
  </div>

    <div class="col-md-4">
    
    <video width="320" height="240" controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #474747">
      <source src="sistemas/suporte/sefinnetsuporte/imagens/Segunda Via DAM.mp4" type="video/mp4">
        Seu navegador não suporta HTML5.
      </video>
   <a href="/sistemas/suporte/sefinnetsuporte/segundaviadam.php"><h4>Segunda Via DAM🔗</h4></a>
  </div>

</div>

</div>



<iframe src="https://sefinnetweb.pmf.sc.gov.br/Sefinnet/hotSite.vm?tela=AREA_WEB_CENTRAL_VIDEOS_SEFINNET&sistema=3" width="0" height="0"></iframe>

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

<script>
            function changeStatus(status) {
                switch (status) {
                    case "0":
                        document.getElementById("envioVideos").style = "display: flex";
                        document.getElementById("gifVideos").style = "display: none";
                        document.getElementById("desVideos").style = "display: none";
                        document.getElementById("impressoesVideos").style = "display: none";
                        break;
                    case "1":
                        document.getElementById("envioVideos").style = "display: none";
                        document.getElementById("gifVideos").style = "display: flex";
                        document.getElementById("desVideos").style = "display: none";
                        document.getElementById("impressoesVideos").style = "display: none";
                        break;
                    case "2":
                        document.getElementById("envioVideos").style = "display: none";
                        document.getElementById("gifVideos").style = "display: none";
                        document.getElementById("desVideos").style = "display: flex";
                        document.getElementById("impressoesVideos").style = "display: none";
                        break;
                    case "3":
                        document.getElementById("envioVideos").style = "display: none";
                        document.getElementById("gifVideos").style = "display: none";
                        document.getElementById("desVideos").style = "display: none";
                        document.getElementById("impressoesVideos").style = "display: flex";
                        break;
                    default:
                        document.getElementById("envioVideos").style = "display: flex";
                        document.getElementById("gifVideos").style = "display: none";
                        document.getElementById("desVideos").style = "display: none";
                        document.getElementById("impressoesVideos").style = "display: none";
                }
            }
        </script>

</body>
</html>
