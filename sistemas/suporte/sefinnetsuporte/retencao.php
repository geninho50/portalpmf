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
  <title>Retenção do ISSQN na Fonte</title>
     <?php
      echo("<link rel=\"stylesheet\" href=\"http://".$_SERVER['HTTP_HOST']."/../layout/pmf-estilo.css\">");
    ?>
  <br>

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Suporte Sefinnet - Prefeitura de Florianópolis. Central de Tutoriais o sistema Sefinnet, GIF, DAM, DES"/>
<meta name="keywords" content="Florianópolis, Sefinnet, suporte, gif, dam, des, ajuda"/>
<meta name="robots" content="max-snippet:-1, max-image-preview:large, max-video-preview:-1"/>
<link rel="canonical" href="http://www.pmf.sc.gov.br/sistemas/suporte/sefinnetsuporte/retencao.php"/>
<meta property="og:locale" content="pt_BR"/>
<meta property="og:type" content="website"/>
<meta property="og:title" content="Recolhimento Sefinnet - Prefeitura de Florianópolis"/>
<meta property="og:description" content="Suporte Sefinnet - Prefeitura de Florianópolis. Central de Tutoriais o sistema Sefinnet, GIF, DAM, DES"/>
<meta property="og:url" content="http://www.pmf.sc.gov.br/sistemas/suporte/sefinnetsuporte/retencao.php"/>
<meta property="og:site_name" content="Prefeitura de Florianópolis"/>

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

   p{
    font-size: 1.4rem !important;
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
  <h2 align="center">Retenção do ISSQN na Fonte (para orgãos públicos)</h2>
  <p>A Retenção do Imposto na Fonte está prevista no Decreto Municipal Nº 2.154/2003 (Página 11), conforme descrito abaixo:<br>  <br>Art. 25. Estão sujeitos à retenção do imposto na fonte os serviços prestados aos órgãos da administração pública da União, do Estado e do Município, inclusive suas autarquias e fundações.<br>   <br> § 1º. O disposto neste artigo não se aplica:   <br>   I. aos contribuintes prestadores dos serviços descritos nos subitens 4.22 e 4.23 da lista de serviços constante do Anexo I;  <br>  II. aos contribuintes prestadores de serviço sujeitos ao pagamento do imposto em base fixa ou por estimativa, devendo esta condição ser comprovada no momento do pagamento.<br>   <br>  § 2º. Os valores descontados na forma deste artigo serão deduzidos pelos prestadores dos serviços no momento da apuração do imposto.<br>   <br>Art. 26. As entidades mencionadas no artigo anterior deverão:<br>   <br>    I. fornecer, em duas vias, aos prestadores dos serviços o Comprovante de Retenção do Imposto na Fonte - CRIF, em modelo aprovado pelo Diretor do Departamento de Tributos da Secretaria Municipal da Receita – SMR;   <br>    II. recolher à Prefeitura Municipal de Florianópolis, até o 5º (quinto) dia do mês subseqüente ao do pagamento dos serviços, o valor do imposto retido.<br>   <br>  Parágrafo único – O comprovante a que se refere o inciso I deverá ser fornecido ao prestador no momento do pagamento do serviço.<br><br></p>
<p>Os Órgãos Públicos poderão ser identificado através da sua Natureza Jurídica, conforme listagem abaixo:</p>
<ul>
<li>101-5 Órgão Público do Poder Executivo Federal </li>
<li>102-3 Órgão Público do Poder Executivo Estadual ou do Distrito Federal</li>
<li>103-1 Órgão Público do Poder Executivo Municipal</li>
<li>104-0 Órgão Público do Poder Legislativo Federal</li>
<li>105-8 Órgão Público do Poder Legislativo Estadual ou do Distrito Federal</li>
<li>106-6 Órgão Público do Poder Legislativo Municipal</li>
<li>107-4 Órgão Público do Poder Judiciário Federal</li>
<li>108-2 Órgão Público do Poder Judiciário Estadual</li>
<li>110-4 Autarquia Federal</li>
<li>111-2 Autarquia Estadual ou do Distrito Federal</li>
<li>112-0 Autarquia Municipal</li>
<li>113-9 Fundação Pública de Direito Público Federal</li>
<li>114-7 Fundação Pública de Direito Público Estadual ou do Distrito Federal</li>
<li>115-5 Fundação Pública de Direito Público Municipal</li>
<li>116-3 Órgão Público Autônomo Federal</li>
<li>117-1 Órgão Público Autônomo Estadual ou do Distrito Federal</li>
<li>118-0 Órgão Público Autônomo Municipal</li>
<li>119-8 Comissão Polinacional</li>
<li>120-1 Fundo Público</li>
<li>121-0 Consórcio Público de Direito Público (Associação Pública)</li>
<li>122-8 Consórcio Público de Direito Privado</li>
<li>123-6 Estado ou Distrito Federal</li>
<li>124-4 Município</li>
<li>125-2 Fundação Pública de Direito Privado Federal</li>
<li>126-0 Fundação Pública de Direito Privado Estadual ou do Distrito Federal</li>
<li>127-9 Fundação Pública de Direito Privado Municipal</li>
<li>128-7 - Fundo Público da Administração Indireta Federal</li>
<li>129-5 - Fundo Público da Administração Indireta Estadual ou do Distrito Federal</li>
<li>130-9 - Fundo Público da Administração Indireta Municipal</li>
<li>131-7 - Fundo Público da Administração Direta Federal</li>
<li>132-5 - Fundo Público da Administração Direta Estadual ou do Distrito Federal</li>
<li>133-3 - Fundo Público da Administração Direta Municipal</li>
<li>134-1 - União</li>
</ul>
<p>Sobre a utilização do Campo Retenção no Quadro de Ajustes da Guia de Informação Fiscal - Pessoa Juridíca - GIF PJ no sistema SefinnetWeb, somente notas fiscais que utilizarem o CFPS 9201 (Para Tomador ou Destinatário estabelecido ou domiciliado no Município) combinado com os CST 2 (Tributada integralmente e com ISQN retido na fonte) ou 3 (Tributada integralmente, sujeita ao regime do Simples Nacional e com o ISQN retido na fonte), verificando ainda informações sobre a Data de Emissão e Valor do ISSQN.<br><br></p> 

</div>

<iframe src="https://sefinnetweb.pmf.sc.gov.br/Sefinnet/hotSite.vm?tela=AREA_RETENCAO_ISSQN&sistema=1" width="0" height="0"></iframe>

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
