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
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

  <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-151895154-3"></script>
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
  <title>Como Emitir Nota Eletrônica no Celular</title>
     <?php
      echo("<link rel=\"stylesheet\" href=\"http://".$_SERVER['HTTP_HOST']."/../layout/pmf-estilo.css\">");
    ?>

 <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Suporte Nota Fiscal Eletrônica - Prefeitura de Florianópolis. Como Emitir uma Nota Fiscal Eletrônica no Celular."/>
    <meta name="keywords" content="Nota fiscal,nota fiscal eletrônica,nf, Celular, dispositivo móvel,como emitir nota fiscal no celular, como emitir no celular, como transmitir nota fiscal no celular, como criar nfps no celular, como criar nota fiscal eletrônica no celular, nota fiscal pmf emissão celular, nota florianópolis celular, florianópolis celular, nota fiscal eletrônica transmissão celular, transmissão celular, criação de nota fiscal celular"/>
    <meta name="robots" content="max-snippet:-1, max-image-preview:large, max-video-preview:-1"/>
    <link rel="canonical" href="http://www.pmf.sc.gov.br/sistemas/nfpsSuporte/EmitirNotaCelular.php"/>
    <meta property="og:locale" content="pt_BR"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="Como Emitir Nota Eletrônica no Celular"/>
    <meta property="og:description" content="Suporte Nota Fiscal Eletrônica - Prefeitura de Florianópolis. Como Emitir uma Nota Fiscal Eletrônica no Celular"/>
    <meta property="og:url" content="http://www.pmf.sc.gov.br/sistemas/nfpsSuporte/EmitirNotaCelular.php"/>
    <meta property="og:site_name" content="Como Emitir Nota Eletrônica no Celular"/>

  
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
  }
  </style>

</head>
<body>

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


<div id="conteudo_pagina" class="column6-lg" align="justify" style="margin:auto;">

    <a type="button" class="btn btn-primary botao" href="/tutorialnfps.php" style="color: white;margin-bottom:20px;margin-top: 20px">Home</a>
  <h2 align="center">Como Emitir uma Nota Fiscal Eletrônica no Celular</h2>

  <video poster="../../arquivos/imagensNFPSe/thumbnail.png" width="600"  height="360"controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #474747; margin-left: 20%">
      <source src="imagens/Emitir Nota Celular.mp4" type="video/mp4">
        Seu navegador não suporta HTML5.
      </video>
      <br><br>
  <p>Em dispositivos móveis, o Sistema de Nota Fiscal de Prestação de Serviço Eletrônica está disponível <b>apenas</b> para MEIs e Autônomos, pois não necessitam de certificado digital. Utilize o descritivo abaixo para lhe auxiliar na emissão da Nota Fiscal de Prestação de Serviços Eletrônica.</p>

  <p>Ao acessar o Sistema de NFPS-e <a href="https://nfps-e.pmf.sc.gov.br/frontend/#!/login" target="_blank" style="color:blue">(aqui)</a>  o Contribunte Micro Empreendedor Individual - MEI ou Profissional Autônomo deverá selecionar a opção "Realizar login sem certificado digital" munido de  seu Usuário, E-mail e Senha.</p>
  <img src="../../arquivos/imagensNFPSe/login.png" alt="" width="100%">

  <hr style=" border-top: 1px solid black;">
  
  <p>Selecione a opção "Criar Nova Nota" no canto superior da tela. As caixas de texto "Documento do tomador", "Nome do tomador", "Período inicio emissão" e "Período fim emissão" servem <b>apenas</b> para pesquisar notas fiscais.</p>
  <img style="border: 1px solid grey;" src="../../arquivos/imagensNFPSe/CriarNotaCelular.png" alt="" width="100%">

  <hr style=" border-top: 1px solid black;">

  <p>Selecione o número da Autorização Eletrônica de Documento Fiscal - AEDF e informe a data da Prestação de Serviço.</p>
  <img src="../../arquivos/imagensNFPSe/2 - Data.png" alt="" width="100%">

  <hr style=" border-top: 1px solid black;">

  <p>Preencha os dados do Tomador do Serviço.</p>
  <img src="../../arquivos/imagensNFPSe/3 - Tomador.png" alt="" width="100%">

  <hr style=" border-top: 1px solid black;">
  <p>Informe o Código Fiscal de Prestação de Serviços - CFPS.</p>
  <img src="../../arquivos/imagensNFPSe/4 - CFPS.png" alt="" width="100%">

  <hr style=" border-top: 1px solid black;">
  <p>Selecione o icone com o sinal de "+" para adicionar o serviço.</p>
  <img style="border: 1px solid grey;" src="../../arquivos/imagensNFPSe/AdicionarServicoCelular.png" alt="" width="100%">

  <hr style=" border-top: 1px solid black;">
  <ul>
    <li><p>Escolha o seu código de CNAE(Código Nacional de Atividade Econômica) e CST (Código de Situação Tributária)</p></li>
    <li><p>No campo “Valor unitário” informe o valor que deseja para o serviço. </p></li>
    <li><p>No campo “Quantidade” informe a quantidade de vezes que você deseja que o valor unitário seja multiplicado, informando quantas vezes o serviço informado foi realizado.</p></li>
    <li><p>Caso necessite de ajuda com os códigos <a href="codigos.php" target="_blank" style="text-decoration: underline;">clique aqui</a></li></p>
  </ul>
  <img src="../../arquivos/imagensNFPSe/6 - CNAE e Valor.png" alt="" width="100%">

  <hr style=" border-top: 1px solid black;">
  <p>O campo de “Informações adicionais”, são as informações que irão constar na parte inferior da Nota Fiscal, preencha com as informações que você achar necessárias.</p>
  <img src="../../arquivos/imagensNFPSe/6.5 - InformacoesAdicionais.png" alt="" width="100%">

  <hr style=" border-top: 1px solid black;">
  <p>Confira as informações que você forneceu e verifique se as mesmas conferem com o desejado, o valor total na qual a Nota Fiscal sairá estará destacado na cor verde. Se estiver de acordo, basta clicar em no icone azul que possui um avião de papel.</p>
  <img style="border: 1px solid grey;" src="../../arquivos/imagensNFPSe/TransmitirCelular.png" alt="" width="100%">

  <hr style=" border-top: 1px solid black;">
  <p>Após o processo de Transmissão a Nota Fiscal estará disponivel para: Consulta, Cancelamento, Clonagem ou Envio de Email de uma determinada Nota Fiscal.</p>
  <img style="border: 1px solid grey;" src="../../arquivos/imagensNFPSe/FimCelular.png" alt="" width="100%">        
<hr style=" border-top: 1px solid black;">
<a type="button" class="btn btn-primary botao" href="/tutorialnfps.php" style="color: white;margin-bottom:20px;margin-top: 20px">Retornar</a>

</div>

<iframe src="https://sefinnetweb.pmf.sc.gov.br/Sefinnet/hotSite.vm?tela=AREA_WEB_COMO_EMITIR_CELULAR&sistema=3" width="0" height="0"></iframe>

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


</body>
</html>
