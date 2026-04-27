<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
require_once("../../scripts/php/config.php");
require_once("../../scripts/php/funcoes_bd.php");
require_once("../../scripts/php/funcoes.php");

require_once("banco/gdb.php");

$db = new gdb();

//suporteStm.bannerSuporte
$db->open("SELECT * FROM bannerSuporte WHERE ID_SISTEMA = 2 ORDER BY ID");

if(isset($_GET['aviso'])){
  $aviso=True;
}else{
  $aviso=False;
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml">
<head>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-155180755-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-155180755-1');
</script>


<!-- Hotjar Tracking Code for https://www.pmf.sc.gov.br/tutorialnfps.php -->
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



<meta name="viewport" content="width=device-width, initial-scale=1"/>
<meta name="google-site-verification" content="Qx1zaiHkwQ0877veQh-Z9OwI6pIgJ9wSXLj6_Q01Sbk" />
<meta name="application-name" content="Suporte Nota Fiscal Florianópoliss"/>
<meta name="description" content="Suporte Nota Fiscal Eletrônica - Prefeitura de Florianópolis. Como emitir nota fiscal, como solicitar nota fiscal, consultar nota fiscal."/>
<meta name="keywords" content="Nota fiscal,nota fiscal eletrônica,nf, nota, florianópolis, prefeitura,floripa, nfps, nfps-e, como, emitir, transmitir,copiar, duplicar, emissão, criação, clonar,criar, requirir,baixar, pdf, celular, xml, tutorial, cnae, cfps, cst, autenticidade ."/>
<!-- <meta name="robots" content="max-snippet:-1, max-image-preview:large, max-video-preview:-1"/> -->
<meta itemprop="description" content="Suporte Nota Fiscal Eletrônica - Prefeitura de Florianópolis. Como emitir nota fiscal, como solicitar nota fiscal, consultar nota fiscal."/> 
<meta itemprop="name" content="Suporte Nota Fiscal Florianópolis"/>
<meta name="robots" content="index,follow"/>
<meta name="googlebot" content="index,follow"/>
<link rel="canonical" href="https://www.pmf.sc.gov.br/tutorialnfps.php"/>
<meta property="og:locale" content="pt_BR"/>
<meta property="og:type" content="website"/>
<meta property="og:title" content="Suporte NFPS-e - Prefeitura de Florianópolis"/>
<meta property="og:description" content="Suporte Nota Fiscal Eletrônica - Prefeitura de Florianópolis. Como emitir nota fiscal, como solicitar nota fiscal, consultar nota fiscal."/>
<meta property="og:url" content="https://www.pmf.sc.gov.br/tutorialnfps.php"/>
<meta property="og:site_name" content="Prefeitura de Florianópolis"/>



  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Suporte Nota Fiscal Eletrônica - Prefeitura de Florianópolis</title>

  <link rel="stylesheet" href="https://www.pmf.sc.gov.br/layout/themePMF/css/style.css">
<!--Para autocomplete -->

  <link rel="stylesheet" href="https://www.pmf.sc.gov.br/layout/pmf-estilo.css" type="text/css">
  <link rel="stylesheet" href="https://www.pmf.sc.gov.br/layout/pmf-estilo-home-new-2.css" type="text/css">
  <link rel="stylesheet" href="https://www.pmf.sc.gov.br/scripts/slidesjs/css/global.css" type="text/css">
  <link rel="stylesheet" href="https://www.pmf.sc.gov.br/scripts/js/ui/jquery-ui.css" type="text/css">
  <link href="https://www.pmf.sc.gov.br/layout/imagens/brasao.gif" rel="shortcut icon" type="image/x-icon" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
</style>

</head>
<body onload="carregaPopup();">


<?php
    include("menu_geral.php");
	
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
<link rel="stylesheet" href="../../layout/themePMF/css/style.css">


 <input id="autocomplete" type="text" class="form-control" aria-label="Text input with dropdown button" placeholder = "Pesquisar por Página (Ex: como emitir..., como consultar...)" style="width: 50%; margin: auto;" onclick="uiMenu()">

<div class="flex-container hero-wrapper" style="background-image: url(sefinnetsuporte/imagens/floripamuseu.jpg);">

 <!--  style="background-color: #DADADC;" -->

 <div class="column4-lg column4-md column8-sm" >
 	<div id="busca-home" class="search-bar search-bar--home column6-lg column8-sm column8-xs" align="justify">
 		<h1>NFPS-e - O que é</h1><br>
 	A Nota Fiscal de Prestação de Serviços (NFPS) é um documento fiscal instituído pela Legislação Tributária e que deve ser obrigatoriamente emitido por todos os prestadores de serviços estabelecidos no Município.</li><br>
 	Ela reúne uma série de informações sobre a prestação dos serviços, como os dados do prestador e do tomador, a descrição e valor dos serviços, além dos dados necessários à apuração e/ou lançamento do Imposto Sobre Serviços de Qualquer Natureza - ISSQN.<br>
 	A NFPS-e é o documento eletrônico que substitui a NFPS impressa. Da mesma forma que a nota impressa, a NFPS-e documenta a prestação de serviços e fornece todos os dados necessários à apuração e/ou lançamento do ISS. Por ser um documento eletrônico, a NFPS-e simplifica as rotinas dos prestadores de serviço, agregando agilidade e segurança para os cidadãos.<br>
 	<h3 onclick="exibeCaracteristicas();" style="color:#09a2d3 ;text-decoration:underline;cursor: pointer; text-align: center;"><li>Caracteristicas e Legislação:</li></h3>
 	<div id="caracteristicas" style="display: none">
 		<li>A NFPS-e poderá ser utilizada pelo contribuinte do ISS em sustituição à NFPS;</li>
 		<li>A NFPS-e é um documento eletrônico gerado e emitido pela Secretaria Municipal da Fazenda da Prefeitura de Florianópolis para documentar prestações de serviços;</li>
 		<li>A NFPS-e é de existência exclusivamente digital;</li>
 		<li>A NFPS-e só pode ser fornecida mediante requisição enviada pelo contribuinte, com validade jurídica garantida por assinatura digital (exceto Profissionais Autônomo e Micro Empreendedores Individuais);</li>
 		<li>A NFPS-e emitida deve ser mantida pelo contribuinte em arquivo digital pelo prazo estabelecido na legislação tributária (cinco anos);</li>
 		<li>O contribuinte que optar pelo uso da NFPS-e não poderá usar ou manter em seu estabelecimento qualquer outro tipo de documento fiscal;</li>
 		<li>Poderá utiliar da Nota Fiscal Simplificada (não necessita do preenchimento das informações do Tomador) para determinados Serviços previstos na legislação.</li>
 		<ul>
 			<li><a href="https://www.pmf.sc.gov.br/arquivos/arquivos/pdf/21_05_2010_13.21.31.2beef556918a41083730b6b60370c3ec.pdf" target="_blank"><span style="color:#09a2d3 ;text-decoration:underline;">Regulamento do ISS</span></a></li>
 			<li><a href="https://www.pmf.sc.gov.br/arquivos/arquivos/PDF/14_01_2011_18.05.46.3604cda8e2f94ec7190de52a6607a53e.PDF" target="_blank"><span style="color:#09a2d3 ;text-decoration:underline;">Decreto 8678 (10/01/2011)</span></a></li>
 			<li><a title="Decreto 17753/2017" href="https://www.pmf.sc.gov.br/arquivos/arquivos/PDF/dec17753_17.pdf" target="_blank"><span style="color:#09a2d3 ;text-decoration:underline;">Decreto 17753 (03/07/2017)</span></a></li>
 		</ul>
 	</div>
 </div>
</div>
		


<div class="column4-lg column4-md column8-sm" style="padding-top: 15px; padding-right: 15px; ">
	<div class="category-list" >
		<div class="category-list">
			<div class="category-citizen active">
				<?php
				for($i = 0; $i < count($db->gs['ID']); $i++){ 
					?>

					<a class="category active"  href="<?=$db->gs['LINK_PAGINA'][$i];?>" style="<?=($db->gs["FL_MAIS_ACESSADOS"][$i] == '1') ? 'color:#DE8004' : ''?>" target="_blank"><?=$db->gs['TITULO_PAGINA'][$i];?></a>

					<?php
				}; 
				?> 
			</div>
		</div>

	</div>
</div>
</div>

<div class="flex-container hero-wrapper" style="background-color: #034154;">
	<div id="busca-home" class="search-bar search-bar--home column3-lg " style="background-color: #1c5f72;">
		<div class="row" align="center">


			<div class="col-md-4">
				<video width="320" height="240" poster="/nfpssuporte/imagens/thumbnail.png" controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #1A272B">
					<source src="nfpssuporte/imagens/nfpse_consultar.mp4" type="video/mp4">
								Seu navegador não suporta HTML5.
					</video>
					<a href="nfpssuporte/consultar.php" target="_blank"><h4 style="color:white">CONSULTAR NOTA CELULAR E PC 🔗</h4></a>
				</div>

			<div class="col-md-4">
				<video width="320" height="240" poster="/nfpssuporte/imagens/thumbnail.png" controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #1A272B">
					<source src="nfpssuporte/imagens/Emitir nota.mp4" type="video/mp4">
						Seu navegador não suporta HTML5.
					</video>
					<a href="nfpssuporte/emitirnota.php" target="_blank"><h4 style="color:white">EMITIR NOTA🔗</h4></a>
				</div> 

			<div class="col-md-4">
				<video width="320" height="240" poster="/nfpssuporte/imagens/thumbnail.png" controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #1A272B">
					<source src="nfpssuporte/imagens/Cancelar Nota.mp4" type="video/mp4">
								Seu navegador não suporta HTML5.
					</video>
						<a href="nfpssuporte/cancelarnota.php" target="_blank"><h4 style="color:white">CANCELAR NOTA 🔗</h4></a>
				</div>
			<div class="col-md-4">
				<video width="320" height="240" poster="/nfpssuporte/imagens/thumbnail.png" controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #1A272B">
					<source src="nfpssuporte/imagens/Emitir Nota Celular.mp4" type="video/mp4">
								Seu navegador não suporta HTML5.
					</video>
						<a href="nfpssuporte/emitirnotacelular.php" target="_blank"><h4 style="color:white">Emitir Nota no Celular 🔗</h4></a>
				</div>
			<div class="col-md-4">
				<video width="320" height="240" poster="/nfpssuporte/imagens/thumbnail.png" controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #1A272B">
					<source src="nfpssuporte/imagens/BaixarXmlPdf.mp4" type="video/mp4">
								Seu navegador não suporta HTML5.
					</video>
					<a href="nfpssuporte/baixarxmlpdf.php" target="_blank"><h4 style="color:white">BAIXAR XML E PDF DA NOTA 🔗</h4></a>
				</div>



			<div class="col-md-4">
				<video width="320" height="240" poster="/nfpssuporte/imagens/thumbnail.png" controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #1A272B">
					<source src="nfpssuporte/imagens/AdesaoPf.mp4" type="video/mp4">
							Seu navegador não suporta HTML5.
					</video>
					<a href="nfpssuporte/adesaopf.php" target="_blank"><h4 style="color:white">SOLICITAR NFPS PF E MEI 🔗</h4></a>
				</div>


						<a type="button" class="btn btn-primary botao" href="videosnfe.php" style="color: white;margin-top: 20px"><p>&#127909 Mais Vídeos Tutoriais</p></a>
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
		
<?php if($aviso){
	echo '<iframe src="https://sefinnetweb.pmf.sc.gov.br/Sefinnet/hotSite.vm?tela=AREA_WEB_CENTRAL_TUTORIAL_REDIRECIONAMENTO&sistema=3" width="0" height="0"></iframe>';

}else{
	echo'<iframe src="https://sefinnetweb.pmf.sc.gov.br/Sefinnet/hotSite.vm?tela=AREA_WEB_CENTRAL_TUTORIAL&sistema=3" width="0" height="0"></iframe>';

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
        left: (pos.left+(width/2)) +14+ "px"
    }).show();

	}

</script>

<script>
 $( function() {
    $( "#autocomplete" ).autocomplete({
      source: 'banco/getpagenfps.php',
      minLength: 1,
      select: function( event, ui ) {
        window.location.href = ui.item.link;
      }
    });
  });
</script>

<?php include_once('../../footerNfps.php'); ?>

</body>
</html>
