<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
require_once("scripts/php/config.php");
require_once("scripts/php/funcoes_bd.php");
require_once("scripts/php/funcoes.php");
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
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-151895154-5"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-151895154-5');

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

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Suporte Sefinnet - Prefeitura de Florianópolis. Central de Tutoriais o sistema Sefinnet, GIF, DAM, DES"/>
<meta name="keywords" content="Florianópolis, Sefinnet, suporte, gif, dam, des, ajuda"/>
<meta name="robots" content="max-snippet:-1, max-image-preview:large, max-video-preview:-1"/>
<link rel="canonical" href="http://www.pmf.sc.gov.br/tutorialsefinnet.php"/>
<meta property="og:locale" content="pt_BR"/>
<meta property="og:type" content="website"/>
<meta property="og:title" content="Suporte Sefinnet - Prefeitura de Florianópolis"/>
<meta property="og:description" content="Suporte Sefinnet - Prefeitura de Florianópolis. Central de Tutoriais o sistema Sefinnet, GIF, DAM, DES"/>
<meta property="og:url" content="http://www.pmf.sc.gov.br/tutorialsefinnet.php"/>
<meta property="og:site_name" content="Prefeitura de Florianópolis"/>



  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Suporte Sefinnet - Prefeitura de Florianópolis</title>
  <?php
      echo("<link rel=\"stylesheet\" href=\"http://".$_SERVER['HTTP_HOST']."/layout/pmf-estilo.css\">");
   ?>


  <link rel="stylesheet" href="layout/pmf-estilo-home-new-2.css" type="text/css">
  <link rel="stylesheet" href="scripts/slidesjs/css/global.css">
  <link rel="stylesheet" href="scripts/js/ui/jquery-ui.css">
  <link href="layout/imagens/brasao.gif" rel="shortcut icon" type="image/x-icon" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<style>
	@media (max-width: 960px) {
		.invisible{
			display: none !important;
		}

		video, .botao {
			width: 100% !important;
		}

		.active{
			padding-left: 10% !important;
		}

		#popup_novo_site{
      		width: 70% !important;
      		height: 20%;
    	}
		a p{
			word-wrap: break-word;
			font-size: 10px;
		}

		.hero-wrapper{
			background-image: none !important;
		}
	}
		
		.category{
			border:1px solid #427988 !important;
		}

		.category:hover{
			color: white !important;
		}
</style>

</head>
<body onload="carregaPopup();">
<?php
    include("layout/menus/menu_geral.php");
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
<link rel="stylesheet" href="layout/themePMF/css/style.css">
<!--
		<div class="mini-header">
	    <ul class="mini-header__items">
	      <li style="font-size: 13px;">Suporte Nota Fiscal Eletrônica</li>
	    </ul>
	  </div>
	-->
<!--
<div class="header">
  <div class="header__brand">
  	<a href="http://www.pmf.sc.gov.br">
  		<img src="images/marca-pmf.svg">
  	</a>
	</div>

		<ul class="header__nav">


	<li>
    	<a href="/tutorialNfps.php" style="font-size: 15px;">Home</a>
  	</li>

	<li>
		<a href="/videosNfe.php" style="font-size: 15px;">Vídeos</a>
	</li>
		
	  <li class="mini-header__social-mobile">
	    <ul>
	    	<li>Siga a prefeitura</li>
	      <li><a href="https://www.facebook.com/prefeituradeflorianopolis/" target="_blank" alt="Facebook"><i class="fa fa-facebook-square" aria-hidden="true"></i></a></li>
	      <li><a href="https://www.instagram.com/prefeituradeflorianopolis/" target="_blank" alt="Instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
	      <li><a href="https://twitter.com/scflorianopolis" target="_blank" alt="Twitter"><i class="fa fa-twitter-square" aria-hidden="true"></i></a></li>
	      <li><a href="https://www.youtube.com/playlist?list=PLtMqi7ZE12w5VwBgpFv4-CTL4GGqeC6uU" target="_blank" alt="Youtube"><i class="fa fa-youtube-square" aria-hidden="true"></i></a></li>
	    </ul>
	  </li>
	</ul>
</div>
-->

<div class="flex-container hero-wrapper" style="background-image: url(sistemas/sefinnetsuporte/imagens/floripamuseu.jpg);">
 		<div class="column4-lg column4-md column8-sm" >
				<div id="busca-home" class="search-bar search-bar--home column6-lg column8-sm column8-xs" align="justify">
			        <h1>O que é o SefinnetWeb</h1><br>
			        É um sistema Eletrônico de Declaração do Imposto sobre Serviços de Qualquer Natureza (ISQN) do Município de Florianópolis, onde todos os contribuintes estabelecidos na Capital devem declarar seu ISS, sejam empresas prestadoras ou tomadoras de serviços.
					O SefinNet tem por finalidade oferecer aos contribuintes do ISS, ainda que isentos ou imunes, as condições necessárias para o cumprimento da obrigação de apresentar a Declaração Eletrônica de ISS junto ao fisco municipal. Utilizando tecnologia de certificação digital, garante a privacidade, procedência e integridade nas informações prestadas de forma segura e online.<br>
					<a href="/videossefinnet.php" style="color:#57C1DF">Clique aqui</a> para conhecer a central de vídeos tutoriais &#127909.

				</div>
		</div>
		


<div class="column4-lg column4-md column8-sm" style="padding-top: 15px; padding-right: 15px; ">
				<div class="category-list" >
					<div class="category-list">
						<div class="category-citizen active">
							<a class="category active invisible" style="background-color: transparent;"></a>
							<a class="category active invisible" style="background-color: transparent;"></a>
							<a class="category active invisible" style="background-color: transparent;"></a>
							<a class="category active" style="color:#FD9812" href="https://sefinnetweb.pmf.sc.gov.br/Sefinnet/index.vm">Sistema SefinNet Pessoa Jurídica</a>
							<a class="category active" style="color:#FD9812" href="https://sefinnetweb.pmf.sc.gov.br/Sefinnet/pessoafisica/index.vm">Sistema SefinNet Pessoa Física</a>
							<a class="category active" style="color:#FD9812" href="https://sefinnetweb.pmf.sc.gov.br/Sefinnet/fiac/index.vm">Sistema SefinNet MEI</a>
							<a class="category active" href="/videossefinnet.php">&#127909 Vídeos Tutoriais</a>
							<a class="category active" href="sistemas/sefinnetsuporte/comoacessar.php">Como acessar</a>
							<a class="category active" href="sistemas/sefinnetsuporte/codigos.php">CNAE, CFPS, CST e Grade Fiscal</a>
							<a class="category active" href="sistemas/sefinnetsuporte/recolhimento.php">Recolhimento ISSQN</a>
							<a class="category active" href="sistemas/sefinnetsuporte/meidigital.php">MEI Digital</a>
							<a class="category active" href="sistemas/sefinnetsuporte/alertapendencia.php">Alerta de Pendência Fiscal</a>
							<a class="category active" href="sistemas/sefinnetsuporte/arquivosimportacao.php">Arquivos de Importação</a>
							<a class="category active" href="sistemas/sefinnetsuporte/manualimportacao.php">Manuais de Importação</a>
							<a class="category active" href="sistemas/sefinnetsuporte/listagematalhos.php">Lista de Atalhos do Sistema</a>
							<a class="category active" href="sistemas/sefinnetsuporte/gifpj.php">GIF PJ</a>
							<a class="category active" href="sistemas/sefinnetsuporte/gifpf.php">GIF PF</a>
							<a class="category active" href="sistemas/sefinnetsuporte/gifst.php">GIF ST</a>
							<a class="category active" href="sistemas/sefinnetsuporte/gifss.php">GIF SS</a>
							<a class="category active" href="sistemas/sefinnetsuporte/desst.php">DES ST</a>
							<a class="category active" href="sistemas/sefinnetsuporte/demonstrativodebito.php">Demonstrativo de Débitos</a>
							<a class="category active" href="sistemas/sefinnetsuporte/segundaviadam.php">Segunda Via DAM</a>
							<a class="category active invisible" style="background-color: transparent;"></a>
							<a class="category active invisible" style="background-color: transparent;"></a>

							
						</div>
					</div>

				</div>
		 </div>


</div>

<div class="flex-container hero-wrapper" style="background-color: #034154;">
	<div id="busca-home" class="search-bar search-bar--home column3-lg " style="background-color: #1c5f72;">
		<div class="row" align="center">

			<div class="col-md-4">
				<video width="320" height="240" controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #1A272B">
					<source src="sistemas/sefinnetsuporte/imagens/Envio.mp4" type="video/mp4">
						Seu navegador não suporta HTML5.
					</video>
					<h4 style="color:white">ENVIO DECLARAÇÕES</h4>
				</div> 

			<div class="col-md-4">
				<video width="320" height="240" controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #1A272B">
					<source src="sistemas/sefinnetsuporte/imagens/GIF PF.mp4" type="video/mp4">
								Seu navegador não suporta HTML5.
					</video>
					<h4 style="color:white">GIF PF</h4>
				</div>

			<div class="col-md-4">
				<video width="320" height="240"  controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #1A272B">
					<source src="sistemas/sefinnetsuporte/imagens/GIF PJ.mp4" type="video/mp4">
								Seu navegador não suporta HTML5.
					</video>
						<h4 style="color:white">GIF PJ</h4>
				</div>
			<div class="col-md-4">
				<video width="320" height="240"  controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #1A272B">
					<source src="sistemas/sefinnetsuporte/imagens/DES SP.mp4" type="video/mp4">
								Seu navegador não suporta HTML5.
					</video>
						<h4 style="color:white">DES SP</h4>
				</div>
			<div class="col-md-4">
				<video width="320" height="240"  controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #1A272B">
					<source src="sistemas/sefinnetsuporte/imagens/DES ST.mp4" type="video/mp4">
								Seu navegador não suporta HTML5.
					</video>
					<h4 style="color:white">DES ST</h4>
				</div>
	

			<div class="col-md-4">
				<video width="320" height="240"  controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #1A272B">
					<source src="sistemas/sefinnetsuporte/imagens/Impressao DAM.mp4" type="video/mp4">
							Seu navegador não suporta HTML5.
					</video>
					<h4 style="color:white">IMPRESSÃO DAM</h4>
				</div>


						<a type="button" class="btn btn-primary botao" href="/videossefinnet.php" style="color: white;margin-top: 20px"><p>&#127909 Mais Vídeos Tutoriais</p></a>
					</div>
				</div>
			</div>

		</div>
</div>
</div>
</div>

<div id="popup_novo_site" align="center" style="display:none; position:fixed;bottom:20px;left:5%;width:400px;height: 80px;background-color: white;border: 2px solid #5A7696;color: #13A0DD">
 <button type="button" onclick="fechaPopup()" style="float:right;color: white;background-color: #F17446">X</button> 
 <br>
 <div style="margin: 0px 5px 2px 5px;">
 Bem vindo(a) ao novo Suporte da Nota Eletrônica! <a href="/videosnfe.php" target="_blank" style="text-decoration: underline;">Clique aqui</a> para conhecer a Central de Vídeos.
 </div>
</div>
		
<iframe src="https://sefinnetweb.pmf.sc.gov.br/Sefinnet/hotSite.vm?tela=AREA_WEB_CENTRAL_TUTORIAL&sistema=3" width="0" height="0"></iframe>

 

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

  <script type="text/javascript" src="sistemas/Biblioteca/js/validadores.js"></script>  
  <script src="sistemas/MinhocaCabeca/assets/js/jquery.min.js"></script>
  <script src="sistemas/MinhocaCabeca/assets/js/jquery.maskedinput.min.js" type="text/javascript"></script> 
  <script src='http://momentjs.com/downloads/moment.min.js'></script>
  <script type="text/javascript">
  
  $("#telefone").mask("(99) 99999999?9");
  $("#cpf").mask("999.999.999-99");

  
	

</script>

<script src="layout/themePMF/js/slick.min.js"></script>

<script src="layout/themePMF/js/main.min.js"></script>

<?php include_once('footerNfps.php'); ?>

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
