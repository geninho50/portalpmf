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
  <title>Solicitar NFPS MEI e PF</title>
     <?php
      echo("<link rel=\"stylesheet\" href=\"http://".$_SERVER['HTTP_HOST']."/../layout/pmf-estilo.css\">");
    ?>


    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Suporte Nota Fiscal Eletrônica - Prefeitura de Florianópolis. Como Solicitar NFPS MEI e PF."/>
    <meta name="keywords" content="Nota fiscal,nota fiscal eletrônica,nf, como solicitar adesão, adesão, pf, mei, pessoa física, micro empreendedor individual,solicitar, solicitação"/>
    <meta name="robots" content="max-snippet:-1, max-image-preview:large, max-video-preview:-1"/>
    <link rel="canonical" href="http://www.pmf.sc.gov.br/sistemas/suporte/nfpssuporte/adesaopf.php"/>
    <meta property="og:locale" content="pt_BR"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="Solicitar NFPS MEI e PF"/>
    <meta property="og:description" content="Suporte Nota Fiscal Eletrônica - Prefeitura de Florianópolis. Como Solicitar NFPS MEI e PF."/>
    <meta property="og:url" content="http://www.pmf.sc.gov.br/sistemas/suporte/nfpssuporte/adesaopf.php"/>
    <meta property="og:site_name" content="Solicitar NFPS MEI e PF"/>
  
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
  <h2 align="center">Como Solicitar a NFPS-e para MEIs e Profissionais Autônomos</h2>
  

  <video poster="../../arquivos/imagensNFPSe/thumbnail.png" width="600"  height="360"controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #474747; margin-left: 20%">
      <source src="imagens/AdesaoPf.mp4" type="video/mp4">
        Seu navegador não suporta HTML5.
      </video><br><br>

  <p>Para prosseguir com cadastro para adesão ao regime de Nota Fiscal de Prestação de Serviços Eletrônica (NFPS-e), siga o passo a passo a seguir:</p>

  <p>1 - Acesse o Link da FIAC (<a href="https://sefinnetweb.pmf.sc.gov.br/Sefinnet/fiac/index.vm" mce_href="https://sefinnetweb.pmf.sc.gov.br/Sefinnet/fiac/index.vm" target="_blank">https://sefinnetweb.pmf.sc.gov.br/Sefinnet/fiac/index.vm</a>), tendo em mãos o seu <i>usuário</i> (CPF e CNPJ) e sua <i>senha</i>;</p>

  <a href="https://sefinnetweb.pmf.sc.gov.br/Sefinnet/fiac/index.vm" mce_href="https://sefinnetweb.pmf.sc.gov.br/Sefinnet/fiac/index.vm" target="_blank"><img src="http://www.pmf.sc.gov.br/arquivos/arquivos/png/sefinnet/tela%201%20-%20passo%201.png" mce_src="http://www.pmf.sc.gov.br/arquivos/arquivos/png/sefinnet/tela%201%20-%20passo%201.png" width="100%"></a>

<hr style=" border-top: 1px solid black;">
  <p>2 - Para confirmar seus dados cadastrais (e-mail e telefone), clique em <i>AEDF</i> e <i>Manutenção de AEDF</i>, após, caso esteja correto, em <i>CONFIRMO OS DADOS ACIMA E PROSSEGUIR</i>;</p>

  <img src="http://www.pmf.sc.gov.br/arquivos/arquivos/png/sefinnet/tela%202%20-%20passo%202.png" mce_src="http://www.pmf.sc.gov.br/arquivos/arquivos/png/sefinnet/tela%202%20-%20passo%202.png" width="100%"></p>

   <img src="http://www.pmf.sc.gov.br/arquivos/arquivos/png/sefinnet/tela%203%20-%20passo%202.png" mce_src="http://www.pmf.sc.gov.br/arquivos/arquivos/png/sefinnet/tela%203%20-%20passo%202.png" width="100%"></p>

<hr style=" border-top: 1px solid black;">
   <p>3 - Solicite a entrada em homologação clicando em <i>PROSSEGUIR</i>;</p>

   <img src="http://www.pmf.sc.gov.br/arquivos/arquivos/png/sefinnet/tela%204%20-%20passo%203.png" mce_src="http://www.pmf.sc.gov.br/arquivos/arquivos/png/sefinnet/tela%204%20-%20passo%203.png" width="100%">

<hr style=" border-top: 1px solid black;">
   <p>4 - Preencha o Termo de Compromisso, clicando em <i>Aceito</i> e <i>CONCLUIR SOLICITAÇÃO</i>, caso esteja de acordo;</p>

   <img src="http://www.pmf.sc.gov.br/arquivos/arquivos/png/sefinnet/tela%205%20-%20passo%204.png" mce_src="http://www.pmf.sc.gov.br/arquivos/arquivos/png/sefinnet/tela%205%20-%20passo%204.png" width="100%">
<hr style=" border-top: 1px solid black;">

   <p>5 - O termo será enviado a um auditor, o qual poderá deferir ou indeferir o mesmo. Acompanhe diariamente a definição, neste site, para assim que definido, prosseguir com o seu cadastro;</p>

   <p><img src="http://www.pmf.sc.gov.br/arquivos/arquivos/png/sefinnet/tela%206%20-%20passo%205.png" mce_src="http://www.pmf.sc.gov.br/arquivos/arquivos/png/sefinnet/tela%206%20-%20passo%205.png" width="100%"></p>
<hr style=" border-top: 1px solid black;">
   <p>6 - Após deferimento clicar em <i>CLIQUE AQUI PARA FINALIZAR SEU PERÍODO DE HOMOLOGAÇÃO</i>;</p>

   <img src="http://www.pmf.sc.gov.br/arquivos/arquivos/png/sefinnet/tela%207%20-%20passo%206.png" mce_src="http://www.pmf.sc.gov.br/arquivos/arquivos/png/sefinnet/tela%207%20-%20passo%206.png" width="100%">

   <hr style=" border-top: 1px solid black;">
   <p>7 - Será verificado se existe AIDF ativa, caso exista é necessário o preenchimento do termo de inutilização (informar número e data da última nota) e clica em <i>GRAVAR INFORMAÇÕES SOBRE AIDF(S) E ENCERRAR HOMOLOGAÇÃO</i>;

    <img src="http://www.pmf.sc.gov.br/arquivos/arquivos/png/sefinnet/tela%208%20-%20passo%207.png" mce_src="http://www.pmf.sc.gov.br/arquivos/arquivos/png/sefinnet/tela%208%20-%20passo%207.png" width="100%"></p>

    

      <img src="http://www.pmf.sc.gov.br/arquivos/arquivos/png/sefinnet/tela%209%20-%20passo%207.png" mce_src="http://www.pmf.sc.gov.br/arquivos/arquivos/png/sefinnet/tela%209%20-%20passo%207.png" width="100%">

      <img src="http://www.pmf.sc.gov.br/arquivos/arquivos/png/sefinnet/tela%2010%20-%20passo%207.png" mce_src="http://www.pmf.sc.gov.br/arquivos/arquivos/png/sefinnet/tela%2010%20-%20passo%207.png" width="100%">
<hr style=" border-top: 1px solid black;">

      <p>8 - Por fim, solicite a AEDFe que irá gerar um DAM (Documento de Arrecadação Municipal), clicando no ícone do PDF disponível ao final da primeira linha <i>CLIQUE AQUI PARA IMPRIMIR O DAM</i>;</p>

      <img src="http://www.pmf.sc.gov.br/arquivos/arquivos/png/sefinnet/tela%2011%20-%20passo%208.png" mce_src="http://www.pmf.sc.gov.br/arquivos/arquivos/png/sefinnet/tela%2011%20-%20passo%208.png" width="100%">        

      <img src="http://www.pmf.sc.gov.br/arquivos/arquivos/png/sefinnet/tela%2012%20-%20passo%208.png" mce_src="http://www.pmf.sc.gov.br/arquivos/arquivos/png/sefinnet/tela%2012%20-%20passo%208.png" width="100%">

<hr style=" border-top: 1px solid black;">
      <p>9 - Após o pagamento e a compensação do pagamento (até 72 horas), você já estará em regime de NFPS-e;</p>

      <p>10 - Acesse <a href="https://nfps-e.pmf.sc.gov.br/frontend/" mce_href="https://nfps-e.pmf.sc.gov.br/frontend/" target="_blank">https://nfps-e.pmf.sc.gov.br/frontend/</a> para gerar sua NFPS-e. Caso necessite de apoio para emissão de nota, <a href="emitirnota.php" style="text-decoration: underline;">Clique Aqui</a>.</p>

      <img src="http://www.pmf.sc.gov.br/arquivos/arquivos/png/sefinnet/tela%2013%20-%20passo%2010.png" mce_src="http://www.pmf.sc.gov.br/arquivos/arquivos/png/sefinnet/tela%2013%20-%20passo%2010.png" width="100%">

<hr style=" border-top: 1px solid black;">
<a type="button" class="btn btn-primary botao" href="/tutorialnfps.php" style="color: white;margin-bottom:20px;margin-top: 20px">Retornar</a>


    </div>

</div>
<iframe src="https://sefinnetweb.pmf.sc.gov.br/Sefinnet/hotSite.vm?tela=AREA_WEB_ADESAO_PF&sistema=3" width="0" height="0"></iframe>

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


</body>
</html>
