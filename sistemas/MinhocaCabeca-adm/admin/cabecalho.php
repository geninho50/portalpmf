<?php
function cabecalho( $codigoUsuario ){ ?>
	<head>
		<title>Minhoca na Cabe&ccedil;a</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="../assets/css/main.css" />
		<link rel="stylesheet" href="http://www.nffacademia.com.br/biblioteca/dashboard/jquery-jvectormap-1.2.2.css">
        <link rel="stylesheet" href="http://www.nffacademia.com.br/biblioteca/dashboard/AdminLTE.min.css">
        <link rel="stylesheet" href="http://www.nffacademia.com.br/biblioteca/dashboard/_all-skins.min.css">	 
        <meta name="description" content=""> 
        <meta name="author" content=""> 
        <meta http-equiv="pragma" content="no-cahce" />
        <meta http-equiv="refresh" CONTENT="1080;URL=http://www.pmf.sc.gov.br/sistemas/MinhocaCabeca/index.php?codigoUsuario=<?echo $codigoUsuario;?>" />     
	</head>
<?php } ?>