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
  <title>CNAEs MEI</title>
     <?php
      echo("<link rel=\"stylesheet\" href=\"http://".$_SERVER['HTTP_HOST']."/../layout/pmf-estilo.css\">");
    ?>
  <br>



    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Suporte Nota Fiscal Eletrônica - Prefeitura de Florianópolis. CNAEs MEI."/>
    <meta name="keywords" content="Nota fiscal,nota fiscal eletrônica,nf, como substituir nota fiscal, códigos, cfps, cnae, cst, grade fiscal"/>
    <meta name="robots" content="max-snippet:-1, max-image-preview:large, max-video-preview:-1"/>
    <link rel="canonical" href="http://www.pmf.sc.gov.br/sistemas/suporte/nfpssuporte/cnaesmei.php"/>
    <meta property="og:locale" content="pt_BR"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="CNAEs MEI"/>
    <meta property="og:description" content="Suporte Nota Fiscal Eletrônica - Prefeitura de Florianópolis. Códigos relativos a nota."/>
    <meta property="og:url" content="http://www.pmf.sc.gov.br/sistemas/suporte/nfpssuporte/cnaesmei.php"/>
    <meta property="og:site_name" content="CNAEs MEI"/>

  <link rel="stylesheet" href="/../layout/pmf-estilo.css" type="text/css">
  <link rel="stylesheet" href="../../layout/pmf-estilo-home-new-2.css" type="text/css">
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

  table,td,tr,th{
    border: 1px solid black;
  }
  td,th{
    padding: 0 15px !important;
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
<link rel="stylesheet" href="../../layout/themePMF/css/style.css">

<div id="conteudo_pagina" class="column6-lg" align="justify" style="margin:auto">

  <a type="button" class="btn btn-primary botao" href="/tutorialnfps.php" style="color: white;margin-bottom:20px;margin-top: 20px">Home</a>
  <h2 align="center">Lista de CNAEs permitidos para o mei</h2>

    <div>

      <table style='font-family: "Courier New",Courier, monospace;'>
        <tr>
          <th>CNAE</th>
          <th>Descrição do CNAE</th>
        </tr>
        <tr>
        <td>0121-1/01</td>   <td>Horticultura, exceto morango</td>
        </tr>
        <tr><td>0159-8/01</td>    <td> Apicultura</td></tr>
        <tr><td>0162-8/02</td>    <td> Serviço de tosquiamento de ovinos</td></tr>
        <tr><td>1099-6/01</td>    <td> Fabricação de vinagres</td></tr>
      <tr><td>1340-5/99</td><td>    Outros serviços de acabamento em fios, tecidos, artefatos têxteis e peças do vestuário</td></tr>
      <tr><td>1412-6/02</td><td>    Confecção, sob medida, de peças do vestuário, exceto roupas íntimas</td></tr>
      <tr><td>1531-9/02</td><td>    Acabamento de calçados de couro sob contrato</td></tr>
      <tr><td>1813-0/01</td><td>    Impressão de material para uso publicitário</td></tr>
      <tr><td>1813-0/99</td><td>    Impressão de material para outros usos</td></tr>
      <tr><td>1821-1/00</td><td>    Serviços de pré impressão</td></tr>
      <tr><td>2391-5/03</td><td>    Aparelhamento de placas e execução de trabalhos em mármore, granito, ardósia e outras pedras</td></tr>
      <tr><td>2399-1/01</td><td>    Decoração, lapidação, gravação, vitrificação e outros trabalhos em cerâmica, louça, vidro e cristal</td></tr>
      <tr><td>2539-0/01</td><td>    Serviços de usinagem, tornearia e solda</td></tr>
      <tr><td>2542-0/00</td><td>    Fabricação de artigos de serralheria, exceto esquadrias</td></tr>
      <tr><td>2599-3/01</td><td>    Serviços de confecção de armações metálicas para a construção</td></tr>
      <tr><td>2950-6/00</td><td>    Recondicionamento e recuperação de motores para veículos automotores</td></tr>
      <tr><td>3311-2/00</td><td>    Manutenção e reparação de tanques, reservatórios metálicos e caldeiras, exceto para veículos</td></tr>
      <tr><td>3313-9/01</td><td>    Manutenção e reparação de geradores, transformadores e motores elétricos</td></tr>
      <tr><td>3313-9/02</td><td>    Manutenção e reparação de baterias e acumuladores elétricos, exceto para veículos</td></tr>
      <tr><td>3314-7/01</td><td>    Manutenção e reparação de máquinas motrizes não elétricas</td></tr>
      <tr><td>3314-7/02</td><td>    Manutenção e reparação de equipamentos hidráulicos e pneumáticos, exceto válvulas</td></tr>
      <tr><td>3314-7/06</td><td>    Manutenção e reparação de máquinas, aparelhos e equipamentos para instalações térmicas</td></tr>
      <tr><td>3314-7/07</td><td>    Manutenção e reparação de máquinas e aparelhos de refrigeração e ventilação para uso industrial e comercial</td></tr>
      <tr><td>3314-7/09</td><td>    Manutenção e reparação de máquinas de escrever, calcular e de outros equipamentos não eletrônicos para escritório</td></tr>
      <tr><td>3314-7/10</td><td>    Manutenção e reparação de máquinas e equipamentos para uso geral não especificados anteriormente</td></tr>
      <tr><td>3314-7/11</td><td>    Manutenção e reparação de máquinas e equipamentos para agricultura e pecuária</td></tr>
      <tr><td>3314-7/12</td><td>    Manutenção e reparação de tratores agrícolas</td></tr>
      <tr><td>3314-7/19</td><td>    Manutenção e reparação de máquinas e equipamentos para as indústrias de alimentos, bebidas e fumo</td></tr>
      <tr><td>3314-7/20</td><td>    Manutenção e reparação de máquinas e equipamentos para a indústria têxtil, do vestuário, do couro e calçados</td></tr>
      <tr><td>3314-7/99</td><td>    Manutenção e reparação de outras máquinas e equipamentos para usos industriais não especificados anteriormente</td></tr>
      <tr><td>3317-1/02</td><td>    Manutenção e reparação de embarcações para esporte e lazer</td></tr>
      <tr><td>3319-8/00</td><td>    Manutenção e reparação de equipamentos e produtos não especificados anteriormente</td></tr>
      <tr><td>3811-4/00</td><td>    Coleta de resíduos não perigosos</td></tr>
      <tr><td>4322-3/01</td><td>    Instalações hidráulicas, sanitárias e de gás</td></tr>
      <tr><td>4330-4/02</td><td>    Instalação de portas, janelas, tetos, divisórias e armários embutidos de qualquer material</td></tr>
      <tr><td>4330-4/05</td><td>    Aplicação de revestimentos e de resinas em interiores e exteriores</td></tr>
      <tr><td>4330-4/99</td><td>    Outras obras de acabamento da construção</td></tr>
      <tr><td>4399-1/99</td><td>    Serviços especializados para construção não especificados anteriormente</td></tr>
      <tr><td>4520-0/01</td><td>    Serviços de manutenção e reparação mecânica de veículos automotores</td></tr>
      <tr><td>4520-0/06</td><td>    Serviços de borracharia para veículos automotores</td></tr>
      <tr><td>4520-0/08</td><td>    Serviços de capotaria</td></tr>
      <tr><td>4923-0/01</td><td>    Serviço de táxi</td></tr>
      <tr><td>4924-8/00</td><td>    Transporte escolar</td></tr>
      <tr><td>4929-9/01</td><td>    Transporte rodoviário coletivo de passageiros, sob regime de fretamento, municipal</td></tr>
      <tr><td>4930-2/01</td><td>    Transporte rodoviário de carga, exceto produtos perigosos e mudanças, municipal</td></tr>
      <tr><td>4930-2/04</td><td>    Transporte rodoviário de mudanças</td></tr>
      <tr><td>5021-1/01</td><td>    Transporte por navegação interior de carga, municipal, exceto travessia</td></tr>
      <tr><td>5091-2/01</td><td>    Transporte por navegação de travessia, municipal</td></tr>
      <tr><td>5099-8/01</td><td>    Transporte aquaviário para passeios turísticos</td></tr>
      <tr><td>5099-8/99</td><td>    Outros transportes aquaviários não especificados anteriormente</td></tr>
      <tr><td>5212-5/00</td><td>    Carga e descarga</td></tr>
      <tr><td>5310-5/02</td><td>    Atividades de franqueadas do correio nacional</td></tr>
      <tr><td>5320-2/02</td><td>    Serviços de entrega rápida</td></tr>
      <tr><td>5620-1/02</td><td>    Serviços de alimentação para eventos e recepções - bufê</td></tr>
      <tr><td>6399-2/00</td><td>    Outras atividades de prestação de serviços de informação não especificadas anteriormente</td></tr>
      <tr><td>7319-0/99</td><td>    Outras atividades de publicidade não especificadas anteriormente</td></tr>
      <tr><td>7420-0/03</td><td>    Laboratórios fotográficos</td></tr>
      <tr><td>7911-2/00</td><td>    Agências de viagens</td></tr>
      <tr><td>8011-1/02</td><td>    Serviços de adestramento de cães de guarda</td></tr>
      <tr><td>8291-1/00</td><td>    Atividades de cobranças e informações cadastrais</td></tr>
      <tr><td>8299-7/99</td><td>    Outras atividades de serviços prestados principalmente às empresas não especificadas anteriormente</td></tr>
      <tr><td>9001-9/02</td><td>    Produção musical</td></tr>
      <tr><td>9001-9/06</td><td>    Atividades de sonorização e de iluminação</td></tr>
      <tr><td>9002-7/02</td><td>    Restauração de obras de arte</td></tr>
      <tr><td>9329-8/99</td><td>    Outras atividades de recreação e lazer não especificadas anteriormente</td></tr>
      <tr><td>9511-8/00</td><td>    Reparação e manutenção de computadores e de equipamentos periféricos</td></tr>
      <tr><td>9512-6/00</td><td>    Reparação e manutenção de equipamentos de comunicação</td></tr>
      <tr><td>9521-5/00</td><td>    Reparação e manutenção de equipamentos eletroeletrônicos de uso pessoal e doméstico</td></tr>
      <tr><td>9529-1/01</td><td>    Reparação de calçados, de bolsas e artigos de viagem</td></tr>
      <tr><td>9529-1/02</td><td>    Chaveiros</td></tr>
      <tr><td>9529-1/04</td><td>    Reparação de bicicletas, triciclos e outros veículos não motorizados</td></tr>
      <tr><td>9529-1/05</td><td>    Reparação de artigos do mobiliário</td></tr>
      <tr><td>9529-1/99</td><td>    Reparação e manutenção de outros objetos e equipamentos pessoais e domésticos não especificados anteriormente</td></tr>
      <tr><td>9601-7/02</td><td>    Tinturarias</td></tr>
      <tr><td>9602-5/01</td><td>    Cabeleireiros, manicure e pedicure</td></tr>
      <tr><td>9603-3/04</td><td>    Serviços de funerárias</td></tr>
      <tr><td>9609-2/02</td><td>    Agências matrimoniais</td></tr>
      <tr><td>9609-2/06</td><td>    Serviços de tatuagem e colocação de piercing</td></tr>
      <tr><td>9609-2/07</td><td>    Alojamento de animais domésticos</td></tr>
      <tr><td>9609-2/08</td><td>    Higiene e embelezamento de animais domésticos</td></tr>
      <tr><td>9609-2/99</td><td>    Outras atividades de serviços pessoais não especificadas anteriormente</td></tr>

       </table>
      <br>
    
        </div>
</div>


<iframe src="https://sefinnetweb.pmf.sc.gov.br/Sefinnet/hotSite.vm?tela=AREA_WEB_CODIGOS&sistema=3" width="0" height="0"></iframe>

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
