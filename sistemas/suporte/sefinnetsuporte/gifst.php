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
  <title>GIF ST</title>


  <?php
  echo("<link rel=\"stylesheet\" href=\"http://".$_SERVER['HTTP_HOST']."/../layout/pmf-estilo.css\">");
  ?>
  <br>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Suporte Sefinnet - Prefeitura de Florianópolis. Central de Tutoriais o sistema Sefinnet, GIF, DAM, DES"/>
  <meta name="keywords" content="Florianópolis, Sefinnet, suporte, gif, dam, des, ajuda"/>
  <meta name="robots" content="max-snippet:-1, max-image-preview:large, max-video-preview:-1"/>
  <link rel="canonical" href="http://www.pmf.sc.gov.br/sistemas/suporte/sefinnetsuporte/gifst.php"/>
  <meta property="og:locale" content="pt_BR"/>
  <meta property="og:type" content="website"/>
  <meta property="og:title" content="GIF ST - Prefeitura de Florianópolis"/>
  <meta property="og:description" content="Suporte Sefinnet - Prefeitura de Florianópolis. Central de Tutoriais o sistema Sefinnet, GIF, DAM, DES"/>
  <meta property="og:url" content="http://www.pmf.sc.gov.br/sistemas/suporte/sefinnetsuporte/gifst.php"/>
  <meta property="og:site_name" content="Prefeitura de Florianópolis"/>


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
      font-size: 1.2rem !important;
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

  <div id="conteudo_pagina" class="column6-lg"  style="margin:auto">

    <a type="button" class="btn btn-primary botao" href="/tutorialsefinnet.php" style="color: white;margin-bottom:20px;margin-top: 20px">Home</a>

    <h2 align="center">GIF ST</h2>

    <video width="600"  height="360"controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #474747; margin-left: 20%">
      <source src="imagens/GIF ST.mp4" type="video/mp4">
        Seu navegador não suporta HTML5.
      </video>

      <h3 onclick="exibeCaracteristicas();" style="color:#09a2d3 ;text-decoration:underline;cursor: pointer;"><li>Quem deve realizar essa declaração? <small>(clique para expandir)</small></li></h3>

      <div id="caracteristicas" style="display: none">
        <p>Conforme o DECRETO MUNICIPAL Nº. 2.154/2003, Anexo IV , Art. 1: São responsáveis, por substituição tributária, pelo pagamento do imposto devido e acréscimos legais:</p>
<p>I. o tomador ou intermediário de serviço proveniente do exterior do País ou cuja prestação se tenha iniciado no exterior do País;</p>
<p>II. a pessoa jurídica, ainda que imune ou isenta, tomadora ou intermediária:</p>
<p>II. as pessoas físicas e jurídicas, tomadoras ou intermediárias: (Redação dada pelo Decreto n° 8076, de 14/04/2010 – Alteração n° 040)</p>
<p>a) de serviço prestado por contribuinte que não esteja regularmente cadastrado como contribuinte do Município ou não tenha emitido nota fiscal de prestação de serviço;</p>
<p>b) dos serviços descritos nos subitens 3.05, 7.02, 7.04, 7.05, 7.09, 7.10, 7.12, 7.16, 7.17, 7.19, 11.02, 17.05 e 17.10 da lista de serviços constante do Anexo I.</p>
<p>III. as empresas públicas e sociedades de economia mista, quando contratarem a prestação de serviços sujeitos à incidência do imposto;</p>
<p>IV. os administradores de bens e negócios de terceiros, em relação aos serviços de venda de bilhetes e demais produtos de loteria, bingos, cartões, pules ou cupons de apostas, sorteios e prêmios, realizados em casas de jogos e bingos eletrônicos ou permanente;</p>
<p>V. as empresas prestadoras dos serviços de planos de medicina de grupo ou individual e planos de saúde, em relação aos serviços de saúde e assistência médica, descritos no item 4 da lista de serviços constante do Anexo I;</p>
<p>VI. as agências de propaganda, em relação aos serviços prestados por terceiros, quando contratados por conta e ordem de seus clientes;</p>
<p>VII. as empresas incorporadoras e construtoras, em relação aos serviços de agenciamento, corretagem ou intermediação de bens imóveis, descritos no subitem 10.05 da lista de serviços constante do Anexo I;</p>
<p>VIII. as empresas seguradoras, em relação aos serviços dos quais resultem:</p>
<p>a) remunerações a título de pagamentos em razão do conserto, restauração ou recuperação de bens sinistrados;</p>
<p>b) remunerações a título de comissões pagas a seus agentes, corretores ou intermediários, pela venda de seus planos;</p>
<p>c) remunerações a título de pagamentos em razão de inspeções e avaliações de risco para cobertura de contrato de seguros e de prevenção e gerência de riscos seguráveis.</p>
<p>IX. os condomínios em edifícios residenciais e comerciais, quando contratarem prestações de serviços sujeitas à incidência do imposto. (Acrescido pelo Decreto n° 8076, de 14/04/2010 – Alteração n° 040)</p>
<p>§ 1º. O disposto nos incisos II “b”, III, IV, V, VI, VII e VIII não se aplica quando o contribuinte</p>
<p>prestador do serviço sujeitar-se a pagamento do imposto em base fixa ou por estimativa,</p>
<p>devendo esta condição ser comprovada.</p>
<p>§ 2º. O disposto no inciso III não se aplica aos serviços descritos nos subitens 4.22 e 4.23 da</p>
<p>lista de serviços constante do Anexo I.</p>
<p>§ 3º. O disposto no inciso II “b” não se aplica:</p>
<p>I. quando o contratante ou intermediário não estiver estabelecido ou domiciliado no Município;</p>
<p>II. quando o contratante for o promitente comprador, em relação aos serviços prestados pelo incorporador-construtor;</p>
<p>III. quando o contratante ou intermediário for pessoa física, em relação aos serviços descritos nos subitens 3.05; 7.09; 7.10; 7.12; 7.16; 7.17; 11.02; 17.05 e 17.10. (Acrescido pelo Decreto n° 8076, de 14/04/2010 – Alteração n° 040)</p>
<p>§ 4º. A responsabilidade a que se refere este artigo somente será elidida nos seguintes casos:</p>
<p>I. quando o prestador dos serviços, agindo com o propósito de impedir ou retardar, total ou parcialmente, a ocorrência do fato gerador da obrigação tributária principal, ou excluir ou modificar as suas características essenciais, de modo a reduzir o montante do imposto devido, ou de evitar ou deferir o seu pagamento, prestar informações falsas ao responsável induzindo-o a erro na apuração do imposto devido;</p>
<p>II. na concessão de medida liminar ou tutela antecipada, em qualquer espécie de ação judicial</p>
<p>§ 5º. A responsabilidade prevista no inciso II, alínea ‘b’, alcança todas as pessoas, ainda que isentas ou imunes.</p>
<p>§ 6º. Por opção da pessoa física, o imposto devido em razão do disposto no inciso II, alínea ‘b’, poderá ser calculado e recolhido sob a forma de estima fiscal, como prevê o § 4º, do art. 16 do RISQN. (Acrescido pelo Decreto n° 8076, de 14/04/2010 – Alteração n° 040)</p>

      </div>

      <h3>Segue abaixo passo a passo como Realizar uma Nova Declaração GIF ST:</h3>

      <li>Selecione a opção "Novo" no menu Superior a Esquerda para criar uma Nova Declaração.</li>


      <img src="imagens/stnova.png" width="70%"alt="">

      <hr style=" border-top: 1px solid black;">

      <li>Escolha o período de apuração</li>

     <img src="https://sefinnetweb.pmf.sc.gov.br/nfpse/sefin_gifpj_1.png" width="50%" alt="">

      <hr style=" border-top: 1px solid black;">

      <li>Na aba "Apuração" preencha as informações de acordo com os campos e clique em "Salvar".</li>

      <img src="imagens/stapuracao.png" width="100%" alt="">
      
      <hr style=" border-top: 1px solid black;">

      <li>Caso deseje imprimir o boleto, na aba "DAM" clique no ícone de impressora na coluna "Boleto".</li>
      <img src="imagens/stdam.png" width="100%" alt="">

      <br> <br>  

       <a type="button" class="btn btn-primary botao" href="/tutorialsefinnet.php" style="color: white;margin-bottom:20px;margin-top: 20px">Home</a>                 

    </div>

<iframe src="https://sefinnetweb.pmf.sc.gov.br/Sefinnet/hotSite.vm?tela=AREA_MANUAL_GIFST&sistema=1" width="0" height="0"></iframe>

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

<script>
  
  var caracteristicasLigado = false;

  function exibeCaracteristicas(){
    if(caracteristicasLigado==false){
     document.getElementById("caracteristicas").style.display = "block";
     caracteristicasLigado =true;
    }else{
      document.getElementById("caracteristicas").style.display = "none";
      caracteristicasLigado =false;
    }
  }

</script>

</body>
</html>
