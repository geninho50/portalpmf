<?php
	$verIncluir = false;

	$semanaano = $_POST['xsemanaano'];
	$semanames = $_POST['xsemanames'];
	$data = $_POST['dataini'];
	$diasemana = $_POST['ydiasemana'];

	require ("DB_mysql.php");
	$obj = new DB_mysql;


		$query = "INSERT INTO escalafinalsemana (semanaano,semanames,data,diasemana) values ('$semanaano','$semanames','$data','$diasemana')";
		$obj->executaQuery($query);

	
	// Fechando as variáveis
	$obj->closeVar($query);		
	$obj->closeQuery();
	$obj->closeConexaoGeral();

	header ("Location:../adm/cadastro_escala_finalsemana.php");

?>