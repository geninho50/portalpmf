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
  <title>Emitir Nota Simplificada</title>
     <?php
      echo("<link rel=\"stylesheet\" href=\"http://".$_SERVER['HTTP_HOST']."/../layout/pmf-estilo.css\">");
    ?>


    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Suporte Nota Fiscal Eletrônica - Prefeitura de Florianópolis. Como Emitir uma Nota Fiscal Eletrônica Simplificada."/>
    <meta name="keyword" content="Nota fiscal,nota fiscal eletrônica simples,nf, simples, simplificada,como emitir nota fiscal simplificada, como emitir, como transmitir nota fiscal, como criar nfps, como criar nota fiscal eletrônica, nota fiscal pmf emissão, nota florianópolis, florianópolis, nota fiscal eletrônica transmissão, transmissão simplificada, criação de nota fiscal simples, nota sem identificação, sem identificação"/>
    <meta name="robots" content="max-snippet:-1, max-image-preview:large, max-video-preview:-1"/>
    <link rel="canonical" href="http://www.pmf.sc.gov.br/sistemas/suporte/nfpssuporte/emitirnotasimplificada.php"/>
    <meta property="og:locale" content="pt_BR"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="Emitir Nota Simplificada"/>
    <meta property="og:description" content="Suporte Nota Fiscal Eletrônica - Prefeitura de Florianópolis. Como Emitir uma Nota Fiscal Eletrônica Simplificada."/>
    <meta property="og:url" content="http://www.pmf.sc.gov.br/sistemas/suporte/nfpssuporte/emitirnotasimplificada.php"/>
    <meta property="og:site_name" content="Emitir Nota Eletrônica Simplificada"/>

  
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
  <h2 align="center">Como Emitir uma Nota Fiscal Eletrônica Simplificada</h2>

  <video poster="imagens/thumbnail.png" width="600"  height="360"controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #474747; margin-left: 20%">
      <source src="imagens/Emitir nota simplificada.mp4" type="video/mp4">
        Seu navegador não suporta HTML5.
      </video>

  <br><br>
  <p>A Nota Fiscal de Prestação de Serviços Eletrônica Simplificada, está prevista no art. 25-A, § 2º, do Anexo III do Decreto nº 2.154/2003, com redação dada pelo Decreto 17.753/2017 que prescreve:<br>
  "Atendidas determinadas condições, poderá a Secretaria Municipal da Fazenda disponibilizar uma versão da nota fiscal de que trata este artigo em modelo simplificado, sem a identificação do tomador dos serviços."<br><br>

    Caso deseje ver o decreto 17.753 <a href="https://leismunicipais.com.br/a1/sc/f/florianopolis/decreto/2017/1776/17753/decreto-n-17753-2017-introduz-as-alteracoes-n-56-e-57-no-regulamento-do-imposto-sobre-servicos-de-qualquer-natureza-risqn-aprovado-pelo-decreto-n-2154-de-2003-e-da-outras-providencias?q=17753" style="color:blue" target ="_blank">clique aqui</a>.
  </p>
  
<p>Esta funcionalidade está disponível apenas na <a href="https://nfps-e.pmf.sc.gov.br/frontend/#!/login" target="_blank" style="color:blue">Versão Web</a>  para os seguintes Códigos de Atividade Econômica (CNAE):</p>

  <ul style="font-size: smaller;">
<li>5099-8/01 PASSEIO DE ESCUNA</li>
<li>5223-1/00 ESTACIONAMENTO DE VEÍCULOS</li>
<li>5510-8/03 MOTÉIS</li>
<li>5914-6/00 ATIVIDADES DE EXIBIÇÃO CINEMATOGRÁFICA</li>
<li>6912-5/00 CARTÓRIOS</li>
<li>8030-7/00 INVESTIGAÇÃO PARTICULAR</li>
<li>8219-9/01 FOTOCÓPIAS</li>
<li>8299-7/03 SERVIÇOS DE GRAVAÇÃO DE CARIMBOS, EXCETO CONFECÇÃO</li>
<li>9313-1/00 ATIVIDADES DE CONDICIONAMENTO FÍSICO</li>
<li>9321-2/00 PARQUES DE DIVERSÃO E PARQUES TEMÁTICOS</li>
<li>9529-1/01 REPARAÇÃO DE CALÇADOS, DE BOLSAS E ARTIGOS DE VIAGEM</li>
<li>9529-1/02 CHAVEIROS</li>
<li>9529-1/03 REPARAÇÃO DE RELÓGIOS</li>
<li>9529-1/04 REPARAÇÃO DE BICICLETAS, TRICICLOS E OUTROS VEÍCULOS NÃO MOTORIZADOS</li>
<li>9529-1/05 REPARAÇÃO DE ARTIGOS DO MOBILIÁRIO</li>
<li>9529-1/06 REPARAÇÃO DE JÓIAS</li>
<li>9529-1/99 REPARAÇÃO E MANUTENÇÃO DE OUTROS OBJETOS E EQUIPAMENTOS PESSOAIS E DOMÉSTICOS NÃO ESPECIFICADOS ANTERIORMENTE</li>
<li>9601-7/01 LAVANDERIAS</li>
<li>9601-7/02 TINTURARIAS</li>
<li>9602-5/01 CABELEIREIRO, MANICURE E PEDICURE</li>
<li>9609-2/05 ATIVIDADES DE SAUNA E BANHOS</li>
</ul>

  <hr style=" border-top: 1px solid black;">

  <p>Ao acessar o Sistema de NFPS-e, caso você seja uma Pessoa Jurídica (exceto MEI) escolha "Realizar Login com certificado digital". Para Micro empreendedores Individuais e Autônomos escolha "Realizar Login sem Certificado Digital". </p>
  <img src="imagens/TELALOGIN.png" alt="" width="100%"> <br>

  <hr style=" border-top: 1px solid black;">


  <p>Ao acessar o Sistema de NFPS-e o Contribunte Pessoa Jurídica munido de seu Certificado Digital e CNPJ deverá informar sua senha de acesso.</p>
  <img src="imagens/0 - LoginCertificado.png" alt="" width="100%"> <br>
  <hr style=" border-top: 1px solid black;">

  <p>Ao acessar o Sistema de NFPS-e o Contribunte Micro Empreendedor Individual - MEI ou Profissional Autônomo deverá selecionar a opção "Realizar login sem certificado digital" munido de  seu Usuário, E-mail e Senha.</p>
  <img src="imagens/login.png" alt="" width="100%">

  <hr style=" border-top: 1px solid black;">
  
  <p>Selecione a opção Criar Nova Nota Simplificada.</p>
  <img style="border: 1px solid grey;" src="imagens/CriarSimplificada.png" alt="" width="100%">

  <hr style=" border-top: 1px solid black;">

  <p>Selecione o número da Autorização Eletrônica de Documento Fiscal - AEDF e informe a data da Prestação de Serviço.</p>
  <img src="imagens/2 - Data.png" alt="" width="100%">

  <hr style=" border-top: 1px solid black;">

  <p>Caso deseje informar a identificação do tomador (CPF) clique em "Sim" e informe o CPF apropriado. Observe que este passo não é obrigatório. (O tomador é a pessoa ou entidade a quem você prestou o serviço)</p>
  <img src="imagens/IdTomador.png" alt="" width="100%" style="margin-bottom: 10px">
  <img src="imagens/CPFTomador.png" alt="" width="100%">

  <hr style=" border-top: 1px solid black;">
  <p>Informe o Código Fiscal de Prestação de Serviços - CFPS.</p>
  <img src="imagens/4 - CFPS.png" alt="" width="100%">

  <hr style=" border-top: 1px solid black;">
  <p>Selecione a opção Adicionar Serviço para informar os dados do serviço prestado.</p>
  <img src="imagens/5 - Add Serviço.png" alt="" width="100%">

  <hr style=" border-top: 1px solid black;">
  <ul>
    <li><p>Escolha o seu código de CNAE(Código Nacional de Atividade Econômica) e CST (Código de Situação Tributária)</p></li>
    <li><p>No campo “Valor unitário” informe o valor que deseja para o serviço. </p></li>
    <li><p>No campo “Quantidade” informe a quantidade de vezes que você deseja que o valor unitário seja multiplicado, informando quantas vezes o serviço informado foi realizado.</p></li>
    <li><p>Caso necessite de ajuda com os códigos <a href="codigos.php" target="_blank" style="text-decoration: underline;">clique aqui</a></li></p>
  </ul>
  <img src="imagens/6 - CNAE e Valor.png" alt="" width="100%">

  <hr style=" border-top: 1px solid black;">
  <p>O campo de “Informações adicionais”, são as informações que irão constar na parte inferior da Nota Fiscal, preencha com as informações que você achar necessárias.</p>
  <img src="imagens/6.5 - InformacoesAdicionais.png" alt="" width="100%">

  <hr style=" border-top: 1px solid black;">
  <p>Confira as informações que você forneceu e verifique se as mesmas conferem com o desejado, o valor total na qual a Nota Fiscal sairá, estará destacado na cor verde, se estiver de acordo, basta clicar em “Transmitir”.</p>
  <img src="imagens/7 - Checagem Final.png" alt="" width="100%">

  <hr style=" border-top: 1px solid black;">
  <p>Após o processo de Transmissão a Nota Fiscal estará disponivel para: Consulta, Cancelamento, Clonagem ou Envio de Email de uma determinada Nota Fiscal.</p>
  <img style="border: 1px solid grey;" src="imagens/8 - Final.png" alt="" width="100%">        
<hr style=" border-top: 1px solid black;">
<a type="button" class="btn btn-primary botao" href="/tutorialnfps.php" style="color: white;margin-bottom:20px;margin-top: 20px">Retornar</a>

</div>


<iframe src="https://sefinnetweb.pmf.sc.gov.br/Sefinnet/hotSite.vm?tela=AREA_WEB_COMO_EMITIR_SIMPLIFICADA&sistema=3" width="0" height="0"></iframe>

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
