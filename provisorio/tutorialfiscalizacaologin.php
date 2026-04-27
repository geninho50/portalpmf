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
<meta name="description" content="Suporte Rastreabilidade - Prefeitura de Florianópolis."/>
<meta name="keywords" content="Nota fiscal,nota fiscal eletrônica,nf, nota, florianópolis, prefeitura,floripa, nfps, nfps-e, como, emitir, transmitir,copiar, duplicar, emissão, criação, clonar,criar, requirir,baixar, pdf, celular, xml, tutorial, cnae, cfps, cst, autenticidade ."/>
<meta name="robots" content="max-snippet:-1, max-image-preview:large, max-video-preview:-1"/>
<link rel="canonical" href="http://www.pmf.sc.gov.br/tutorialnfps.php"/>
<meta property="og:locale" content="pt_BR"/>
<meta property="og:type" content="website"/>
<meta property="og:title" content="Suporte Rastreabilidade - Prefeitura de Florianópolis"/>
<meta property="og:description" content="Suporte Nota Fiscal Rastreabilidade"/>
<meta property="og:url" content="http://www.pmf.sc.gov.br/tutorialnfps.php"/>
<meta property="og:site_name" content="Prefeitura de Florianópolis"/>



  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Fiscalizacao Login</title>
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
    //include("layout/menus/menu_geral.php");
   // echo("<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js\"></script>");
     ?>


<form action="action_page.php" method="post">
 
  <div class="container">
    <label for="uname"><b>Usuário</b></label>
    <input type="text" placeholder="Enter Username" name="uname" id="usuario" >

    <label for="psw"><b>Senha</b></label>
    <input type="password" placeholder="Enter Password" name="psw" id="senha">

    <button type="button" onclick="entrar();">Login</button>

  </div>
</form>




<script>

var usuario = document.getElementById("usuario");
var senha = document.getElementById("senha");

function entrar(){

	if(usuario.value == "fiscalizacao" && senha.value=="fiscalizacao"){
		
		location.href = "/tutorialfiscalizacao.php";
	}else{
		alert("Credencial incorreta!");
	}
}
</script>

</body>
</html>
