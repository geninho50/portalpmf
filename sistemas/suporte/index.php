<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
require_once("../../scripts/php/config.php");
require_once("../../scripts/php/funcoes_bd.php");
require_once("../../scripts/php/funcoes.php");

$drive->conecta();
$menu_principal = "home";
$charset = "UTF-8";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Central de suporte</title>

  <meta charset="<?=$charset?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="http://www.pmf.sc.gov.br/layout/pmf-estilo.css" type="text/css">
  <link rel="stylesheet" href="http://www.pmf.sc.gov.br/layout/pmf-estilo-home-new-2.css" type="text/css">
  <link rel="stylesheet" href="http://www.pmf.sc.gov.br/scripts/slidesjs/css/global.css" type="text/css">
  <link rel="stylesheet" href="http://www.pmf.sc.gov.br/scripts/js/ui/jquery-ui.css" type="text/css">
  <link href="http://www.pmf.sc.gov.br/layout/imagens/brasao.gif" rel="shortcut icon" type="image/x-icon" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

</head>
<body style="height: 100%">

<?php
  include("menu_geral.php");
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>

<link href="https://fonts.googleapis.com/css?family=Montserrat:300??,400,500,600,700" rel="stylesheet">
<link rel="stylesheet" href="http://www.pmf.sc.gov.br/layout/themePMF/css/style.css">


<h3 style="text-align: center">Escolha o sistema para qual deseja suporte:</h3>
<div style="display: flex; justify-content: center; align-items: center; margin-bottom: 20px">
	<div class="category-list" >
		<div class="category-list">
			<div class="category-citizen active">
				<a class="category active" style="border: 1px solid;" title= "Suporte de Emissão, Requerimento e mais informações " href="tutorialnfps.php">Nota Fiscal Eletrônica de Prestação de Serviço</a>
				<a class="category active" style="border: 1px solid;" title= "Suporte de GIFs, DES e mais informações " href="tutorialsefinnet.php">Sistema Sefinnet</a>
			</div>
		</div>

	</div>
</div>


<?php include_once('../../footerNfps.php'); ?>
</body>
</html>