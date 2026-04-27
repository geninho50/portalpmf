<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
require_once("scripts/php/config.php");
require_once("scripts/php/funcoes_bd.php");
require_once("scripts/php/funcoes.php");

require_once("sistemas/banco/gdb.php");

$db = new gdb();

$db->open("SELECT * FROM suporteStm.bannerSuporte WHERE ID_SISTEMA = 1 ORDER BY ID ");

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

<meta name="viewport" content="width=device-width, initial-scale=1"/>
<meta name="google-site-verification" content="Qx1zaiHkwQ0877veQh-Z9OwI6pIgJ9wSXLj6_Q01Sbk" />
<meta name="application-name" content="Suporte Sefinnet"/>
<meta name="description" content="Suporte Sefinnet - Prefeitura de Florianópolis. Central de Tutoriais o sistema Sefinnet, GIF, DAM, DES"/>
<meta name="keywords" content="Florianópolis, Sefinnet, suporte, gif, dam, des, ajuda"/>
<meta name="robots" content="index,follow"/>
<meta name="googlebot" content="index,follow"/>
<link rel="canonical" href="http://www.pmf.sc.gov.br/tutorialsefinnet.php"/>
<meta itemprop="description"  content="Suporte Sefinnet - Prefeitura de Florianópolis. Central de Tutoriais o sistema Sefinnet, GIF, DAM, DES"/> 
<meta itemprop="name" content="Suporte Sefinnet/">
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

<!--Para autocomplete -->
  <link rel="stylesheet" href="layout/pmf-estilo-home-new-2.css" type="text/css">
  <link rel="stylesheet" href="scripts/slidesjs/css/global.css">
  <link rel="stylesheet" href="scripts/js/ui/jquery-ui.css">
  <link href="layout/imagens/brasao.gif" rel="shortcut icon" type="image/x-icon" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


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

	.active:hover{
		color: white !important;
	}
	.search-bar--home{
		margin: 25px auto !important;
	}

		::-webkit-input-placeholder {
		color: orange !important;
		font-weight: 800;
	}
	:-moz-placeholder { /* Firefox 18- */
		color: orange !important;  
		font-weight: 800;
	}

	::-moz-placeholder {  /* Firefox 19+ */
		color: orange !important;  
		font-weight: 800;
	}

	:-ms-input-placeholder {  
		color: orange !important;  
		font-weight: 800;
	}
		
		.category{
			border:1px solid #427988 !important;
			font-weight: bold !important;
		}

		.category:hover{
			color: white !important;
		}
</style>

</head>
<body onload="carregaPopup();">
<?php
    include("layout/menus/menu_geral.php");
     ?>


<form name="formulario">

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


 <input id="autocomplete" type="text" class="form-control" aria-label="Text input with dropdown button" placeholder = "Pesquisar por Página (Ex: Como acessar..., gif...)" style="width: 50%; margin: auto;" onclick="uiMenu()">

<div class="flex-container hero-wrapper" style="background-image: url(sistemas/suporte/sefinnetsuporte/imagens/floripamuseu.jpg);">
 		<div class="column4-lg column4-md column8-sm" >
				<div id="busca-home" class="search-bar search-bar--home column6-lg column8-sm column8-xs" align="justify">
			        <h1>O que é o SefinnetWeb</h1><br>
			        É um sistema Eletrônico de Declaração do Imposto sobre Serviços de Qualquer Natureza (ISQN) do Município de Florianópolis, onde todos os contribuintes estabelecidos na Capital devem declarar seu ISS, sejam empresas prestadoras ou tomadoras de serviços.
					O SefinNet tem por finalidade oferecer aos contribuintes do ISS, ainda que isentos ou imunes, as condições necessárias para o cumprimento da obrigação de apresentar a Declaração Eletrônica de ISS junto ao fisco municipal. Utilizando tecnologia de certificação digital, garante a privacidade, procedência e integridade nas informações prestadas de forma segura e online.<br>
					<a href="/videossefinnet.php" style="color:#57C1DF">Clique aqui</a> para conhecer a central de vídeos tutoriais &#127909.
				</div>
				<br><br>
				<div id="busca-home" class="search-bar search-bar--home column6-lg column8-sm column8-xs" align="justify">
			        <h1>FAQ</h1><br>
			        O Sefinnet agora est&aacute; integrado com o novo Sistema de Tributos Municipais. Estamos avaliando e atuando nas demandas do sistema e da integra&ccedil;&atilde;o e, 
					para agilizar a resposta &agrave;s suas d&uacute;vidas, criamos uma FAQ com as principais d&uacute;vidas: 
					<a href="https://iss.pmf.sc.gov.br/faq_sefinnet" style="color:#57C1DF" target="blank">FAQ</a>
				</div>				
		</div>
		


<div class="column4-lg column4-md column8-sm" style="padding-top: 15px; padding-right: 15px; ">
				<div class="category-list" >
					<div class="category-list">
						<div class="category-citizen active">
							<?php
							for($i = 0; $i < count($db->gs['ID']); $i++){ 
								?>
								<a class="category active"  href="<?=$db->gs['LINK_PAGINA'][$i];?>" style="<?=($db->gs["FL_MAIS_ACESSADOS"][$i] == '1') ? 'color:#FD9812' : ''?>"><?=$db->gs['TITULO_PAGINA'][$i];?></a>

								<?php
							}; 
							?> 
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
					<source src="sistemas/suporte/sefinnetsuporte/imagens/Envio.mp4" type="video/mp4">
						Seu navegador não suporta HTML5.
					</video>
					<h4 style="color:white">ENVIO DECLARAÇÕES</h4>
				</div> 

			<div class="col-md-4">
				<video width="320" height="240" controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #1A272B">
					<source src="sistemas/suporte/sefinnetsuporte/imagens/GIF PF.mp4" type="video/mp4">
								Seu navegador não suporta HTML5.
					</video>
					<a href="sistemas/suporte/sefinnetsuporte/gifpf.php"><h4 style="color:white">GIF PF 🔗</h4></a>
				</div>

			<div class="col-md-4">
				<video width="320" height="240"  controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #1A272B">
					<source src="sistemas/suporte/sefinnetsuporte/imagens/GIF PJ.mp4" type="video/mp4">
								Seu navegador não suporta HTML5.
					</video>
					<a href="sistemas/suporte/sefinnetsuporte/gifpj.php"><h4 style="color:white">GIF PJ 🔗</h4></a>
				</div>
			<div class="col-md-4">
				<video width="320" height="240"  controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #1A272B">
					<source src="sistemas/suporte/sefinnetsuporte/imagens/DES SP.mp4" type="video/mp4">
								Seu navegador não suporta HTML5.
					</video>
					<a href="sistemas/suporte/sefinnetsuporte/gifpj.php">	<h4 style="color:white">DES SP 🔗</h4></a>
				</div>
			<div class="col-md-4">
				<video width="320" height="240"  controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #1A272B">
					<source src="sistemas/suporte/sefinnetsuporte/imagens/DES ST.mp4" type="video/mp4">
								Seu navegador não suporta HTML5.
					</video>
					<a href="sistemas/suporte/sefinnetsuporte/gifpj.php"><h4 style="color:white">DES ST 🔗</h4></a>
				</div>
	

			<div class="col-md-4">
				<video width="320" height="240"  controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #1A272B">
					<source src="sistemas/suporte/sefinnetsuporte/imagens/Impressao DAM.mp4" type="video/mp4">
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
 Bem vindo(a) ao novo Suporte Sefinnet! <a href="/videossefinnet.php" target="_blank" style="text-decoration: underline;">Clique aqui</a> para conhecer a Central de Vídeos.
 </div>
</div>
		


 <?php if($aviso){
	echo'<iframe src="https://sefinnetweb.pmf.sc.gov.br/Sefinnet/hotSite.vm?tela=AREA_WEB_CENTRAL_TUTORIAL_SEFINNET_REDIRECIONAMENTO&sistema=1" width="0" height="0"></iframe>';
}else{
	echo'<iframe src="https://sefinnetweb.pmf.sc.gov.br/Sefinnet/hotSite.vm?tela=AREA_WEB_CENTRAL_TUTORIAL_SEFINNET&sistema=1" width="0" height="0"></iframe>';
}
?>

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


  

<?php include_once('footerNfps.php'); ?>



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

	function uiMenu(){
    var pos = $("#autocomplete").position();
    var width = $("#autocomplete").width();

    $(".ui-corner-all").css({
        position: "absolute",
        top: pos.top +34+ "px",
        left: (pos.left+(width/2))+14 + "px"
    }).show();

	}



</script>

<script >
	$( function() {
		$( "#autocomplete" ).autocomplete({
			source: 'sistemas/suporte/banco/getpagesefinnet.php',
			minLength: 1,
			select: function( event, ui ) {
				window.location.href = ui.item.link;
			}
		});
	});
</script>

</body>
</html>
