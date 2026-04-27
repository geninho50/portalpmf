<?php
	
   $data_atual = date("Y-m-d");
   $hora_atual = date("H:i:s");
	
	$matricula = 0;
	$matricula = (int)$_POST['xmatricula'];
	if( $matricula == 0 )
	{
		$matricula = (int)$_GET['matricula'];
	}

	require ("DB_mysql.php");
	$conexao = new DB_mysql ;
	$conexao->conectarConf();

	// incluir
		$query = "insert into pre_cautela (matricula,hora,data,status) values('$matricula','$hora_atual','$data_atual',0)";
		$conexao->executaQuery($query);
		echo "<script> window.location.href = '../controle/cautela_material.php' </script>";
?>