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
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-151895154-4"></script>
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



<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Suporte Nota Fiscal Eletrônica - Prefeitura de Florianópolis. Central de Tutoriais para Emissão, Cancelamento, Duplicação e Requerimento de Notas Fiscais Eletrônicas."/>
<meta name="keywords" content="Nota fiscal,nota fiscal eletrônica,nf, nota, florianópolis, prefeitura,floripa, nfps, nfps-e, como, emitir, transmitir,copiar, duplicar, emissão, criação, clonar,criar, requirir,baixar, pdf, celular, xml, tutorial, cnae, cfps, cst, autenticidade ."/>
<meta name="robots" content="max-snippet:-1, max-image-preview:large, max-video-preview:-1"/>
<link rel="canonical" href="http://www.pmf.sc.gov.br/tutorialnfps.php"/>
<meta property="og:locale" content="pt_BR"/>
<meta property="og:type" content="website"/>
<meta property="og:title" content="Suporte NFPS-e - Prefeitura de Florianópolis"/>
<meta property="og:description" content="Suporte Nota Fiscal Eletrônica - Prefeitura de Florianópolis. Central de Tutoriais para Emissão, Cancelamento, Duplicação e Requerimento de Notas Fiscais Eletrônicas."/>
<meta property="og:url" content="http://www.pmf.sc.gov.br/tutorialnfps.php"/>
<meta property="og:site_name" content="Prefeitura de Florianópolis"/>



  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>OLD NFPS</title>
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

	}

	a{
		font-weight: bold !important;
	}

.search-bar--home{
	margin: 25px auto !important;
}
	.category{
			border:1px solid #427988 !important;
		}
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
<!-- sistemas/rastreabilidade/imagens/novo.jpg -->
<div class="flex-container hero-wrapper" style="background-image: url(sistemas/rastreabilidade/imagens/novo.jpg);">


 		<div class="column4-lg column4-md column8-sm" >
				<div id="busca-home" class="search-bar search-bar--home column6-lg column8-sm column8-xs" align="justify">
			        <h1>NFPS - OLD</h1><br>
			       A Nota Fiscal de Prestação de Serviços (NFPS) é um documento fiscal instituído pela Legislação Tributária e que deve ser obrigatoriamente emitido por todos os prestadores de serviços estabelecidos no Município.<br>
			        A Nota Fiscal de Prestação de Serviço reúne uma série de informações sobre a prestação dos serviços, como os dados do prestador e do tomador, a descrição e valor dos serviços, além dos dados necessários à apuração e/ou lançamento do Imposto Sobre Serviços de Qualquer Natureza - ISSQN.<br>
			        A Nota Fiscal de Prestação de Serviços Eletrônica (NFPS-e) é um documento eletrônico que substitui a NFPS impressa. Da mesma forma que a nota impressa, a NFPS-e documenta a prestação de serviços e fornece todos os dados necessários à apuração e/ou lançamento do ISS. Por ser um documento eletrônico, a NFPS-e simplifica as rotinas dos prestadores de serviço, agregando agilidade e segurança para os cidadãos.<br>
			        <h3 onclick="exibeCaracteristicas();" style="color:#09a2d3 ;text-decoration:underline;cursor: pointer;text-align: center;">Caracteristicas da NFPS-e</h3>
			        <div id="caracteristicas" style="display: none">
			        <li>A NFPS-e poderá ser utilizada pelo contribuinte do ISS em sustituição à NFPS;</li>
			        <li>A NFPS-e é um documento eletrônico gerado e emitido pela Secretaria Municipal da Fazenda da Prefeitura de Florianópolis para documentar prestações de serviços;</li>
			        <li>A NFPS-e é de existência exclusivamente digital;</li>
			        <li>A NFPS-e só pode ser fornecida mediante requisição enviada pelo contribuinte, com validade jurídica garantida por assinatura digital (exceto Profissionais Autônomo e Micro Empreendedores Individuais);</li>
			        <li>A NFPS-e emitida deve ser mantida pelo contribuinte em arquivo digital pelo prazo estabelecido na legislação tributária (cinco anos);</li>
			        <li>O contribuinte que optar pelo uso da NFPS-e não poderá usar ou manter em seu estabelecimento qualquer outro tipo de documento fiscal;</li>
			        <li>Poderá utiliar da Nota Fiscal Simplificada (não necessita do preenchimento das informações do Tomador) para determinados Serviços previstos na legislação.</li>
			              <ul>
			        	<li><a href="http://portal.pmf.sc.gov.br/arquivos/arquivos/pdf/21_05_2010_13.21.31.2beef556918a41083730b6b60370c3ec.pdf" target="_blank"><span style="color:#09a2d3 ;text-decoration:underline;">Regulamento do ISS</span></a></li>
			        	<li><a href="http://portal.pmf.sc.gov.br/arquivos/arquivos/PDF/14_01_2011_18.05.46.3604cda8e2f94ec7190de52a6607a53e.PDF" target="_blank"><span style="color:#09a2d3 ;text-decoration:underline;">Decreto 8678 (10/01/2011)</span></a></li>
			        	<li><a title="Decreto 17753/2017" href="http://portal.pmf.sc.gov.br/arquivos/arquivos/PDF/dec17753_17.pdf" target="_blank"><span style="color:#09a2d3 ;text-decoration:underline;">Decreto 17753 (03/07/2017)</span></a></li>
			        </ul>
			    	</div>
			  
				</div>
		</div>
		


<div class="column4-lg column4-md column8-sm" style="padding-top: 15px; padding-right: 15px; ">
				<div class="category-list" >
					<div class="category-list">
						<div class="category-citizen active">
							<a class="category active" style="color:#DE8004" href="https://nfps-e.pmf.sc.gov.br/frontend/#!/login" target="_blank">Sistema WEB de emissão de Notas</a>
							<a class="category active" href="sistemas/nfpssuporte/emitirnota.php" target="_blank">Como Emitir Nota Fiscal Eletrônica</a>
							<a class="category active" style="color:#DE8004" href="sistemas/nfpssuporte/autenticidade.php" target="_blank">Consulta de Autenticidade de Nota Fiscal Produção</a>
							<a class="category active" href="sistemas/nfpssuporte/emitirnotacelular.php" target="_blank">&#x1F4F1 Como Emitir Nota Fiscal Eletrônica no Celular</a>
							<a class="category active" href="sistemas/nfpssuporte/cancelarnota.php" target="_blank">Como Cancelar Nota Fiscal Eletrônica</a>
							<a class="category active" href="sistemas/nfpssuporte/substituirnota.php" target="_blank">Como Substituir Nota Fiscal Eletrônica</a>
							<a class="category active" href="sistemas/nfpssuporte/clonarnota.php" target="_blank">Como Copiar Nota Fiscal Eletrônica</a>
							<a class="category active" href="sistemas/nfpssuporte/baixarxmlpdf.php" target="_blank">Como Baixar XML e PDF de uma Nota Fiscal Eletrônica</a>
							<a class="category active" href="sistemas/nfpssuporte/emitirnotasimplificada.php" target="_blank">Como Emitir Nota Simplificada</a>
							<a class="category active" href="sistemas/nfpssuporte/adesaopf.php" target="_blank">Como Solicitar a NFPS-e para MEIs e PFs</a>
							<a class="category active" href="sistemas/nfpssuporte/adesaopjsemmei.php" target="_blank">Como Solicitar a NFPS-e para PJs (exceto MEI)</a>
							<a class="category active" href="/videosnfe.php" target="_blank">&#127909 Vídeos Tutoriais</a>
							<a class="category active" href="sistemas/nfpssuporte/recuperarsenha.php" target="_blank">Recuperar Senha</a>
							<a class="category active" href="https://nfps-e-hml.pmf.sc.gov.br/" target="_blank">Perguntas Frequentes, Manuais e Downloads</a>
							<a class="category active" href="sistemas/nfpssuporte/autenticidadehomologacao.php" target="_blank">Consulta de Autenticidade de Nota Fiscal Homologação</a>
							<a class="category active" href="https://nfps-e-hml.pmf.sc.gov.br/frontend/#!/login" target="_blank">Sistema WEB de emissão de Notas Homologação</a>
							<a class="category active" href="https://cnae.ibge.gov.br/" target="_blank">Busca de CNAE (Sistema CONCLA IBGE)</a>
							<a class="category active" href="sistemas/nfpssuporte/codigos.php" target="_blank">CNAE, CFPS, CST e Grade Fiscal</a>
							<a class="category active" href="sistemas/nfpssuporte/consultar.php" target="_blank">Como Consultar uma Nota Fiscal</a>
							<a class="category active" href="sistemas/nfpssuporte/alterardados.php" target="_blank">Como alterar Senha e E-mail no Sistema Web</a>
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
				<video width="320" height="240" poster="/arquivos/imagensNFPSe/thumbnail.png" controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #1A272B">
					<source src="sistemas/nfpssuporte/imagens/Emitir nota.mp4" type="video/mp4">
						Seu navegador não suporta HTML5.
					</video>
					<a href="sistemas/nfpssuporte/emitirnota.php" target="_blank"><h4 style="color:white">EMITIR NOTA🔗</h4></a>
				</div> 

			<div class="col-md-4">
				<video width="320" height="240" poster="/arquivos/imagensNFPSe/thumbnail.png" controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #1A272B">
					<source src="sistemas/nfpssuporte/imagens/Substituir nota.mp4" type="video/mp4">
								Seu navegador não suporta HTML5.
					</video>
					<a href="sistemas/nfpssuporte/substituirnota.php" target="_blank"><h4 style="color:white">SUBSTITUIR NOTA 🔗</h4></a>
				</div>

			<div class="col-md-4">
				<video width="320" height="240" poster="/arquivos/imagensNFPSe/thumbnail.png" controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #1A272B">
					<source src="sistemas/nfpssuporte/imagens/Cancelar Nota.mp4" type="video/mp4">
								Seu navegador não suporta HTML5.
					</video>
						<a href="sistemas/nfpssuporte/cancelarnota.php" target="_blank"><h4 style="color:white">CANCELAR NOTA 🔗</h4></a>
				</div>
			<div class="col-md-4">
				<video width="320" height="240" poster="/arquivos/imagensNFPSe/thumbnail.png" controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #1A272B">
					<source src="sistemas/nfpssuporte/imagens/Emitir Nota Celular.mp4" type="video/mp4">
								Seu navegador não suporta HTML5.
					</video>
						<a href="sistemas/nfpssuporte/emitirnotacelular.php" target="_blank"><h4 style="color:white">Emitir Nota no Celular 🔗</h4></a>
				</div>
			<div class="col-md-4">
				<video width="320" height="240" poster="/arquivos/imagensNFPSe/thumbnail.png" controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #1A272B">
					<source src="sistemas/nfpssuporte/imagens/BaixarXmlPdf.mp4" type="video/mp4">
								Seu navegador não suporta HTML5.
					</video>
					<a href="sistemas/nfpssuporte/baixarxmlpdf.php" target="_blank"><h4 style="color:white">BAIXAR XML E PDF DA NOTA 🔗</h4></a>
				</div>
	



			<div class="col-md-4">
				<video width="320" height="240" poster="/arquivos/imagensNFPSe/thumbnail.png" controls="controls" style="border-bottom-style: solid;border-bottom-width: 4px;border-bottom-color: #1A272B">
					<source src="sistemas/nfpssuporte/imagens/AdesaoPf.mp4" type="video/mp4">
							Seu navegador não suporta HTML5.
					</video>
					<a href="sistemas/nfpssuporte/adesaopf.php" target="_blank"><h4 style="color:white">SOLICITAR NFPS PF E MEI 🔗</h4></a>
				</div>


						<a type="button" class="btn btn-primary botao" href="/videosnfe.php" style="color: white;margin-top: 20px"><p>&#127909 Mais Vídeos Tutoriais</p></a>
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


</script>

</body>
</html>
