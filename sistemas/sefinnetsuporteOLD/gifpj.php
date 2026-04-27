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
  <title>GIF PJ</title>


  <?php
  echo("<link rel=\"stylesheet\" href=\"http://".$_SERVER['HTTP_HOST']."/../layout/pmf-estilo.css\">");
  ?>
  <br>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Suporte Sefinnet - Prefeitura de Florianópolis. Central de Tutoriais o sistema Sefinnet, GIF, DAM, DES"/>
  <meta name="keywords" content="Florianópolis, Sefinnet, suporte, gif, dam,PF des, ajuda"/>
  <meta name="robots" content="max-snippet:-1, max-image-preview:large, max-video-preview:-1"/>
  <link rel="canonical" href="http://www.pmf.sc.gov.br/sistemas/sefinnetsuporte/gifpj.php"/>
  <meta property="og:locale" content="pt_BR"/>
  <meta property="og:type" content="website"/>
  <meta property="og:title" content="GIF PJ - Prefeitura de Florianópolis"/>
  <meta property="og:description" content="Suporte Sefinnet - Prefeitura de Florianópolis. Central de Tutoriais o sistema Sefinnet, GIF, DAM, DES"/>
  <meta property="og:url" content="http://www.pmf.sc.gov.br/sistemas/sefinnetsuporte/gifpj.php"/>
  <meta property="og:site_name" content="Prefeitura de Florianópolis"/>


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
      h2{
        text-align:left;
      }
    }


    p{
      font-size: 1.2rem !important;
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

  <div id="conteudo_pagina" class="column6-lg"  style="margin:auto">

    <a type="button" class="btn btn-primary botao" href="/tutorialsefinnet.php" style="color: white;margin-bottom:20px;margin-top: 20px">Home</a>
    <a type="button" class="btn btn-primary botao" href="https://sefinnetweb.pmf.sc.gov.br/Sefinnet/index.vm" target="_blank" style="color: white;margin-bottom:20px;margin-top: 20px">Sistema Sefinnet Web</a>

    <h2 align="center">GIF PJ</h2>

    <video width="600"  height="360"controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #474747; margin-left: 20%">
      <source src="imagens/GIF PJ.mp4" type="video/mp4">
        Seu navegador não suporta HTML5.
      </video>


      <br><br>
      <p>A Guia de Informação Fiscal - Pessoa Jurídica é uma declaração eletrônica referente ao Imposto sobre Serviços de Qualquer Natureza - ISSQN realizada pelos contribuintes registrados (<em>Processo de Registro do Cadastro Municipal do Contribuinte - CMC concluído</em>) no município de Florianópolis.<br></p>
      <h3>Quem deve realizar esta declaração?</h3>
      <p>Os contribuintes Pessoa Jurídica do Regime Normal e os contribuintes do regime do Simples Nacional¹ que ultrapassaram o limite referente de faturamento do ISSQN.<br>¹ Neste caso não está incluso os Micro Empreendedores Individuais - MEI e os contribuintes do regime do Simples Nacional que não tiveram alcançado este limite.<br></p>
      <h3>Quando devo realizar esta declaração?</h3>
      <p>Esta declaração deverá ser obrigatoriamente¹ transmitida mensalmente até o dia 10 do mês atual, referente às informações dos documentos fiscais emitidos pelo prestador no mês anterior. Caso não o contribuinte não tenha realizado a emissão de nenhum documento fiscal a declaração deverá ser enviada como SEM MOVIMENTO, isto é, em branco.<br><br>Somente após a emissão do primeiro documento fiscal a declaração GIF PJ torna-se obrigatória, e a falta da entrega desta obrigação acessória esta prevista a aplicação de multa por declaração não realizada.</p>

      <p><em>Vale reforçar que sempre que uma GIF PJ COM MOVIMENTO for transmitida, o contribuinte deverá também realizar a respectiva DES-SP detalhando as informações de cada nota fiscal que compõe a GIF PJ.</em></p>

      <h3>Onde devo realizar esta declaração?</h3>
      <p>Através do SefinnetWeb (Clique Aqui), no Menu GIF (Guia de Informação Fiscal), opção GIF PJ. Utilizando um Certificado Digital E-CNPJ (Escritório Contábil ou Contribuinte) ou E-CPF (Contador Responsável Técnico ou Preposto).</p>

      <h3>Segue abaixo passo a passo como Realizar uma Nova Declaração GIF PJ:</h3>

      <li>Selecione a opção Novo no menu Superior a Esquerda para criar uma Nova Declaração.</li>


      <img src="https://sefinnetweb.pmf.sc.gov.br/nfpse/sefin_gifpj_0.png" width="100%"alt="">

      <hr style=" border-top: 1px solid black;">

      <li>No campo "Período de Apuração" informe a competência e selecione.</li>

      <img src="https://sefinnetweb.pmf.sc.gov.br/nfpse/sefin_gifpj_1.png" width="65%" alt="">

      <hr style=" border-top: 1px solid black;">

      <li>Na aba Apuração o sistema irá carregar automaticamente as informações referente as notas fiscais eletrônicas prestadas nesta competência e caso seja necessário será possível altera-las.</li>

      <img src="https://sefinnetweb.pmf.sc.gov.br/nfpse/sefin_gifpj_2.png" width="100%" alt="">
      <p><em>* Vale lembrar que o campo de Relação das Notas Fiscais aceita apenas Caracteres Númericos, Ponto e Hifen, desta forma a relação das Notas Fiscais poderá ser apresentada da seguinte forma: 1,2,4-10 (O Sistema irá entender as seguintes notas fiscais, 1, 2, 4, 5, 6, 7, 8, 9, 10).</em></p>
      <hr style=" border-top: 1px solid black;">

      <li>Na aba Quadro de Ajustes o usuário poderá informar as Notas Fiscais Canceladas e deduzir¹ valores referentes a Compensação ou Renteção na Fonte².</li>
      <img src="https://sefinnetweb.pmf.sc.gov.br/nfpse/sefin_gifpj_3.png" width="100%" alt="">

      <p>¹ O sistema não permitirá dedução de valores acima de 20% do Total do   ISSQN Apurado ou que o Total do ISSQN da declaração seja inferior ao  Total do ISSQN aplicado  uma aliquota média de 2% do Total da Base de  Cálculo informada na aba de  Apuração.</p>
      <p>² A Retenção deverá sempre ser um Serviço Prestado a um Órgão Público (CST 2) domiciliado em Florianópolis (CFPS 9201).</p>

      <hr style=" border-top: 1px solid black;">

      <li>Na aba Projeto de Incentivo Fiscal o usuário poderá deduzir valores¹ referente a Projetos de Incentivo Fiscal com saldo positivo, vinculados ao contribuinte</li>

      <img src="https://sefinnetweb.pmf.sc.gov.br/nfpse/sefin_gifpj_4.png" width="100%" alt="">

      <p>¹ O sistema não permitirá dedução de valores acima de 20% do Total do  ISSQN Apurado ou que o Total do ISSQN da declaração seja inferior ao Total do ISSQN aplicado  uma aliquota média de 2% do Total da Base de Cálculo informada na aba de  Apuração.</p>                    
      <br><br>                

      <a type="button" class="btn btn-primary botao" href="/tutorialsefinnet.php" style="color: white;margin-bottom:20px;margin-top: 20px">Home</a>                 

    </div>


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
