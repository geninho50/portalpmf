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
  <title>Agendar Compromisso</title>


     <?php
      echo("<link rel=\"stylesheet\" href=\"http://".$_SERVER['HTTP_HOST']."/../layout/pmf-estilo.css\">");
    ?>
  <br>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Suporte Sefinnet - Prefeitura de Florianópolis. Central de Tutoriais o sistema Sefinnet, GIF, DAM, DES"/>
<meta name="keywords" content="Florianópolis, Sefinnet, suporte, gif, dam, des, ajuda"/>
<meta name="robots" content="max-snippet:-1, max-image-preview:large, max-video-preview:-1"/>
<link rel="canonical" href="http://www.pmf.sc.gov.br/sistemas/suporte/sefinnetsuporte/agendarcompromisso.php"/>
<meta property="og:locale" content="pt_BR"/>
<meta property="og:type" content="website"/>
<meta property="og:title" content="Alerta de Pendência Fiscal - Prefeitura de Florianópolis"/>
<meta property="og:description" content="Suporte Sefinnet - Prefeitura de Florianópolis. Central de Tutoriais o sistema Sefinnet, GIF, DAM, DES"/>
<meta property="og:url" content="http://www.pmf.sc.gov.br/sistemas/suporte/sefinnetsuporte/agendarcompromisso.php"/>
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
    h2{
      text-align:left;
    }
  }

  p{
    font-size: 1.4rem !important;
  }

  #conteudo_pagina li a{
      color: blue !important;
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

<div id="conteudo_pagina" class="column6-lg" align="justify"  style="margin:auto">

  <a type="button" class="btn btn-primary botao" href="/tutorialsefinnet.php" style="color: white;margin-bottom:20px;margin-top: 20px">Home</a>

<h2 align="center">Agendar um Compromisso na Agenda Fiscal</h2>

<p>Todo Contribuinte poderá solicitar um agendamento de um compromisso com sua dupla de Auditores Fiscais de Tributos Municipais - AFTM através do SefinnetWeb.<br><br></p>
<h3>Onde posso realizar este Agendamento?</h3>
<p>Na tela Principal do SefinnetWeb ou no Menu Suporte opção Agenda Fiscal, para maiores informações <a href="https://sefinnetweb.pmf.sc.gov.br/passo_a_passo/fiscalizacaoAgendamentoFiscal.pdf" target="_blank">Clique Aqui.</a></p>

<h3>O que significa as Cores nos horários disponíveis de Compromisso?</h3>
<p>Cada cor é uma categoria de Compromisso, para que de uma forma mais intuitiva o usuário possa identificar quais horários estão disponíveis para uso e quais não.</p>

<h3>Não existem horários disponíveis para Agendamento3</h3>
<p>Nestes caso a sugestão é entrar em contato telefônico ou verificar quando seu Auditor Fiscal Vinculado estarão no Plantão Fiscal.</p>

<h3>Quais assuntos poderão ser tratados neste compromisso?</h3>
<p>O Contribuinte ou seu Representante Legal poderá tratar de diversos assuntos como Baixa de CMC, Intimações, Notificações, Legislação entre outros.</p>                 
</div>


<div id="popup_novo_site" align="center" style="display:none; position:fixed;bottom:20px;left:5%;width:400px;height: 80px;background-color: white;border: 2px solid #5A7696;color: #13A0DD">
 <button type="button" onclick="fechaPopup()" style="float:right;color: white;background-color: #F17446">X</button> 
 <br>
 <div style="margin: 0px 5px 2px 5px;">
 Bem vindo(a) ao novo Suporte da Sefinnet! <a href="/tutorialsefinnet.php" target="_blank" style="text-decoration: underline;">Clique aqui</a> para conhecer a Central.
 </div>
</div>

<iframe src="https://sefinnetweb.pmf.sc.gov.br/Sefinnet/hotSite.vm?tela=AREA_AGENDAMENTO_FISCAL&sistema=1" width="0" height="0"></iframe>

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


    </div>
  </div>

 
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
