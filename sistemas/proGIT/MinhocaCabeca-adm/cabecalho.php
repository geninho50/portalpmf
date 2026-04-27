<?php
function cabecalho( $codigoUsuario ){ ?>
	<head>
		<title>Minhoca na Cabe&ccedil;a</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="assets/css/jquery-jvectormap-1.2.2.css">
        <link rel="stylesheet" href="assets/css/AdminLTE.min.css">
        <link rel="stylesheet" href="assets/css/_all-skins.min.css">	 
        <meta name="description" content=""> 
        <meta name="author" content=""> 
        <meta http-equiv="pragma" content="no-cahce" />
        <meta http-equiv="refresh" CONTENT="1080;URL=http://www.pmf.sc.gov.br/sistemas/MinhocaCabeca-adm/index.php?codigoUsuario=<?echo $codigoUsuario;?>" />     
	</head>
<?php } ?>