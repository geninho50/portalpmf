<?php

	require_once("../../valida_session.php");
	require_once("../../../scripts/php/funcoes_bd.php"); 
	require_once("../../../scripts/php/config.php");

	$titulo = $_POST['Ftitulo'];
	$ano = $_POST['Fano'];
	$id = intval( $_POST['id'] );
	$mes = $_POST['Fmes'];
	$anoAtual = intval( Date('Y') );

	if(trim($titulo) == ''){
		header("location: http://www.pmf.sc.gov.br/intranet/inicio.php?pagina=RelOuvCad&menu=13&msg=1&edit=$id"); 
		die;
	}

	if( intval( $ano ) > $anoAtual){
		header("location: http://www.pmf.sc.gov.br/intranet/inicio.php?pagina=RelOuvCad&menu=13&msg=2&edit=$id"); 
		die;
	}

	$drive->conecta();
	
	$sql = "UPDATE relatorios_ouvidoria SET  titulo = '$titulo', mes = '$mes', ano = '$ano' WHERE id = '$id'";

	$Tresult = $drive->pedido($sql);

	if($Tresult == true){
		header("location: http://www.pmf.sc.gov.br/intranet/inicio.php?pagina=ListOuvRelatorios&menu=13"); 
		die;
	} else {
	   header("location: http://www.pmf.sc.gov.br/intranet/inicio.php?pagina=RelOuvCad&menu=13&msg=404&edit=$id"); 
	}
?>