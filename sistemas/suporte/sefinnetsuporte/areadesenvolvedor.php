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
  <title>Área do Desenvolvedor</title>


     <?php
      echo("<link rel=\"stylesheet\" href=\"http://".$_SERVER['HTTP_HOST']."/../layout/pmf-estilo.css\">");
    ?>
  <br>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Suporte Sefinnet - Prefeitura de Florianópolis. Central de Tutoriais o sistema Sefinnet, GIF, DAM, DES"/>
<meta name="keywords" content="Florianópolis, Sefinnet, suporte, gif, dam, des, ajuda"/>
<meta name="robots" content="max-snippet:-1, max-image-preview:large, max-video-preview:-1"/>
<link rel="canonical" href="http://www.pmf.sc.gov.br/sistemas/suporte/sefinnetsuporte/areadesenvolvedor.php"/>
<meta property="og:locale" content="pt_BR"/>
<meta property="og:type" content="website"/>
<meta property="og:title" content="Area Desenvolvedor - Prefeitura de Florianópolis"/>
<meta property="og:description" content="Suporte Sefinnet - Prefeitura de Florianópolis. Central de Tutoriais o sistema Sefinnet, GIF, DAM, DES"/>
<meta property="og:url" content="http://www.pmf.sc.gov.br/sistemas/suporte/sefinnetsuporte/areadesenvolvedor.php"/>
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
  </style>

</head>
<body onload="carregaPopup();">

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
  
  <br>
  Filtros de pesquisa: 

  <select onchange = "changeStatus(this.value)" id="filtro" class="busca-home-field">
  <option value="0" >Certificado Digital</option> 
  <option value="1" >Plataforma Java</option>
  <option value="3" >Arquivos de Importação</option>
  <option value="4" >Manuais de Importação</option>
</select>
  <br>
<div id="certificadoDigital"  style="display:block;">
<h2>Sobre a Certificação Digital</h2>
<p>O Certificado Digital é uma assinatura com validade jurídica que garante proteção às transações eletrônicas e outros serviços via internet, permitindo que pessoas e empresas se identifiquem e assinem digitalmente de qualquer lugar do mundo com mais segurança e agilidade.</p>
<br>
<h5>Sua aplicações:</h5>
<ol>
<li>Assinar e enviar documentos pela internet;</li>
<li>Logar-se em ambientes seguros;</li>
<li>Realizar transações bancárias;</li>
<li>Assinar escriturações contábeis e fiscais, etc;</li>
<li>Enviar as declarações de sua empresa;</li>
</ol>
<h5>Seus Benefícios:</h5>
<ol>
<li>Validade jurídica nos documentos eletrônicos;</li>
<li>Desburocratiza processos, pois não necessita de reconhecimento de firma;</li>
<li>Economiza tempo, pois os serviços são realizados pela internet;</li>
</ol>
<br>
</div>

<div id="java"  style="display:none;">
  <h2>Sobre a Plataforma Java</h2>
<p>
Java é uma linguagem de programação e plataforma computacional lançada  pela primeira vez pela Sun Microsystems em 1995. Existem muitas  aplicações e sites que não funcionarão, a menos que você tenha o Java  instalado, e mais desses são criados todos os dias. O Java é rápido,  seguro e confiável. De laptops a datacenters, consoles de games a  supercomputadores científicos, telefones celulares à Internet, o Java  está em todos os lugares!</p>
<h5>O download do Java é gratuito?</h5>
<li>Sim, o download do Java é gratuito. Obtenha a última versão no site <a href="http://www.java.com/" target="_blank">java.com</a></li>
<br>
</div>

<div id="arquivosImportacao"  style="display:none;">
  <h2>Arquivos de importação</h2>
<p>
Nos Modelos de Arquivos de Importação, por se tratarem de arquivos de exemplo, os campos CMC e CNPJ foram alterados pelos caracteres '@' e '#' respectivamente, desta forma ao realizar um teste estes campos devem ser alterados pelo CMC e CNPJ do Contribuinte a ter sua declaração importada.</p>

<li>
<p>GIF PJ - <a href="https://sefinnetweb.pmf.sc.gov.br/modelos_importacao/GIF_PJ.txt" target="_blank" style="color:blue">Clique Aqui</a></p>
</li>
<li>
<p>GIF PJ - Sem Movimento - <a href="https://sefinnetweb.pmf.sc.gov.br/modelos_importacao/GIF_PJ_SEM_MOVIMENTO.txt" target="_blank" style="color:blue">Clique Aqui</a></p>
</li>
<li>
<p>GIF ST - <a href="https://sefinnetweb.pmf.sc.gov.br/modelos_importacao/GIF_ST.txt" target="_blank" style="color:blue">Clique Aqui</a></p>
</li>
<li>
<p>GIF ST - Sem Movimento - <a href="https://sefinnetweb.pmf.sc.gov.br/modelos_importacao/GIF_ST_SEM_MOVIMENTO.txt" target="_blank" style="color:blue">Clique Aqui</a></p>
</li>
<li>b
<p>DES ST - <a href="https://sefinnetweb.pmf.sc.gov.br/modelos_importacao/DES_ST.txt" target="_blank" style="color:blue">Clique Aqui</a></p>
</li>
<li>
<p>DES SP - <a href="https://sefinnetweb.pmf.sc.gov.br/modelos_importacao/DES_SP.txt" target="_blank" style="color:blue">Clique Aqui</a></p>
</li>
<li>
<p>GIF IF Mensal - <a href="https://sefinnetweb.pmf.sc.gov.br/modelos_importacao/GIF_IF_MENSAL.txt" target="_blank" style="color:blue">Clique Aqui</a></p>
</li>
<li>
<p>GIF IF Anual - <a href="https://sefinnetweb.pmf.sc.gov.br/modelos_importacao/GIF_IF_ANUAL.txt" target="_blank" style="color:blue">Clique Aqui</a></p>
</li>
<li>
<p>PGCC - <a href="https://sefinnetweb.pmf.sc.gov.br/modelos_importacao/GIF_IF_PGCC.txt" target="_blank" style="color:blue">Clique Aqui</a></p>
</li>


</div>


<div id="manuaisImportacao"  style="display:none;">
  <h2>Lista dos Manuais de Importação utilizados no SefinnetWeb</h2>
<br>
<p><strong>1. Manual de Importação DES\GIF - <a href="https://sefinnetweb.pmf.sc.gov.br/arquivos/arquivo_de_importacao_sefinnet.pdf" style="color:blue;" target="_blank">Clique Aqui</a><br></strong></p>
<p>Este manual contém informações de layout para o desenvolvimento de arquivos de importação com as declarações GIF Pessoa Jurídica, GIF Substituto Tributário, GIF Ajuste, DES Serviços Prestados e DES Serviços Tomados.</p>
<p></p>
<ol> </ol>
<p><strong>2. Manual de Importação GIF Instituição Financeira - <a href="https://sefinnetweb.pmf.sc.gov.br/arquivos/modelo_conceitual_des_if_versao_2_0_0.pdf" style="color:blue;" target="_blank">Clique Aqui</a><br></strong></p>
<p>Este manual contém informações de layout para o desenvolvimento de arquivos de importação com as declarações GIF Instituição Financeira Mensal, Balancete Analítico Anual e o Plano Geral de Contas Comentado, este documento foi desenvolvido pela ABRASF viabilizando o sincronismo de informações entre contribuintes e municípios, e desses com outros órgãos de governo das esferas federal e estaduais, para implementação em Secretarias Municipais de Fazenda.</p>
<p></p>
<p><strong>3. Manual de Importação GIF SS - <a href="https://sefinnetweb.pmf.sc.gov.br/arquivos/layout_importacao_gif_ss.pdf" style="color:blue;" target="_blank">Clique Aqui</a><br></strong></p>
<p>Este manual contém informações de layout para o desenvolvimento  de arquivos de importação com as declarações GIF Sociedade Simples.</p>         
<br>




</div>


</div>

<iframe src="https://sefinnetweb.pmf.sc.gov.br/Sefinnet/hotSite.vm?tela=AREA_DESENVOLVEDOR&sistema=1" width="0" height="0"></iframe>

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

<script>

            function changeStatus(status) {
              
              
                switch (status) {
                    case "0":
                        document.getElementById("java").style = "display: none";
                        document.getElementById("certificadoDigital").style = "display: block";
                        document.getElementById("arquivosImportacao").style = "display: none";
                        document.getElementById("manuaisImportacao").style = "display: none";
                        break;
                    case "1":
                       document.getElementById("java").style = "display: block";
                        document.getElementById("certificadoDigital").style = "display: none";
                        document.getElementById("arquivosImportacao").style = "display: none";
                        document.getElementById("manuaisImportacao").style = "display: none";
                        break;
                    case "3":
                        document.getElementById("java").style = "display: none";
                        document.getElementById("certificadoDigital").style = "display: none";
                        document.getElementById("arquivosImportacao").style = "display: block";
                        document.getElementById("manuaisImportacao").style = "display: none";
                        break;
                     case "4":
                        document.getElementById("java").style = "display: none";
                        document.getElementById("certificadoDigital").style = "display: none";
                        document.getElementById("arquivosImportacao").style = "display: none";
                        document.getElementById("manuaisImportacao").style = "display: block";
                        break;   
                    default:
                        document.getElementById("java").style = "display: none";
                        document.getElementById("certificadoDigital").style = "display: block";
                        document.getElementById("arquivosImportacao").style = "display: none";
                        document.getElementById("manuaisImportacao").style = "display: none";
                        break;
                }
            }
        </script>

</body>
</html>
