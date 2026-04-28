<?php
	
		ini_set('display_errors', 1);
ini_set('log_errors', 1);
error_reporting(E_ALL);
	require_once("../../valida_session.php");
	require_once("../../../scripts/php/funcoes_bd.php"); 
	require_once("../../../scripts/php/config.php");
	$drive->conecta();

	$id = intval( $_GET['del'] );

	$sql = "SELECT * FROM relatorios_ouvidoria WHERE id =". intval($_GET['del']) . ";"; 
	$result		= $drive->pedido($sql);
	$rel 	= pg_fetch_object($result);


	$sql = "DELETE FROM relatorios_ouvidoria WHERE id = '$rel->id'";

	$Tresult = $drive->pedido($sql);

	if($Tresult == true){
			unlink("../../../ouvidoria/pdf/".$rel->arquivo);
			header("location: http://www.pmf.sc.gov.br/intranet/inicio.php?pagina=ListOuvRelatorios&menu=13"); 
			die;
	} else {
		  header("location: http://www.pmf.sc.gov.br/intranet/inicio.php?pagina=ListOuvRelatorios&menu=13"); 
		  die;
	}
?>