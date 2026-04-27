<?php

	$login = $_GET['login'];
	$status = $_GET['status'];
	$campo = $_GET['campo'];

	require ("DB_mysql.php");
	$conexao = new DB_mysql ;
	$conexao->conectarConf();
	require ("trataArquivo.php");
	$objT = new trataArquivo;
	require ("trataData.php");
	$objD = new trataData;

		// alterar dados
		$query = "UPDATE usuario set $campo='$status' where login='$login'";
		$conexao->executaQuery($query);
		echo "<script>alert('Permissao para area da $campo efetuada com sucesso!');</script>";                       
		echo "<script> window.location.href = '../controle/listar_permissao_servicoonline.php' </script>";
?>