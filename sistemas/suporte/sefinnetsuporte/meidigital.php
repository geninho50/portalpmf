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
  <title>MEI Digital</title>
     <?php
      echo("<link rel=\"stylesheet\" href=\"http://".$_SERVER['HTTP_HOST']."/../layout/pmf-estilo.css\">");
    ?>
  <br>

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Suporte Sefinnet - Prefeitura de Florianópolis. Central de Tutoriais o sistema Sefinnet, GIF, DAM, DES"/>
<meta name="keywords" content="Florianópolis, Sefinnet, suporte, gif, dam, des, ajuda"/>
<meta name="robots" content="max-snippet:-1, max-image-preview:large, max-video-preview:-1"/>
<link rel="canonical" href="http://www.pmf.sc.gov.br/sistemas/suporte/sefinnetsuporte/meidigital.php"/>
<meta property="og:locale" content="pt_BR"/>
<meta property="og:type" content="website"/>
<meta property="og:title" content="MEI digital Sefinnet - Prefeitura de Florianópolis"/>
<meta property="og:description" content="Suporte Sefinnet - Prefeitura de Florianópolis. Central de Tutoriais o sistema Sefinnet, GIF, DAM, DES"/>
<meta property="og:url" content="http://www.pmf.sc.gov.br/sistemas/suporte/sefinnetsuporte/meidigital.php"/>
<meta property="og:site_name" content="Prefeitura de Florianópolis"/>

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

<div id="conteudo_pagina" class="column6-lg" align="justify" style="margin:auto">

  <a type="button" class="btn btn-primary botao" href="/tutorialsefinnet.php" style="color: white;margin-bottom:20px;margin-top: 20px">Home</a>
  <h2 align="center">MEI Digital</h2>
<div>
  <p>Atualmente os Micros Empreendedores Individuais – MEI (Prestadores de Serviço) do Município de Florianópolis recebem sua inscrição e acesso ao sistema de emissão de Notas Fiscais de Prestação Serviço Eletrônica - NFPS-e de forma automática por E-mail ou Carta sem a necessidade de se dirigir a uma unidade do Pró-Cidadão.</p>
  <p>Este processo automático ocorre em até 12 dias corridos após a inscrição do MEI no Portal de Empreendedor, após a identificação do novo CNPJ é gerado um novo Código Municipal de Contribuinte – CMC, Alvará de Licença e Funcionamento Provisório (180 dias) e a Autorização Eletrônica de Documento Fiscal – AEDF, sendo encaminhado ao Contribuinte via Correios e E-mail cadastrado caso houver.</p>

  <h4>Dúvidas Gerais:</h4>
  <h5>Não recebi o E-mail em 12 dias após minha inscrição, o que devo fazer?</h5>
  <p>Se dirigir a uma unidade do Pró-Cidadão;</p>

  <h5>Quando realizar a Baixa do CNPJ do MEI o CMC também será baixado de forma automática?</h5>
  <p>Atualmente não.</p>

  <h5>Pergunta: Quando realizar a Alteração de Atividades do CNPJ do MEI será forma automática na PMF?</h5>
  <p>Atualmente não, somente presencial.</p>

        </div>
</div>

<iframe src="https://sefinnetweb.pmf.sc.gov.br/Sefinnet/hotSite.vm?tela=AREA_MEI_DIGITAL&sistema=1" width="0" height="0"></iframe>

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
 
<script src="/home/www/layout/themePMF/js/slick.min.js"></script>

<script src="/home/www/layout/themePMF/js/main.min.js"></script>

<?php include_once('/home/www/footerNfps.php'); ?>

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
