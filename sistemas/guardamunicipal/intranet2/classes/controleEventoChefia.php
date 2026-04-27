<?php
	$idEvento = 0;
	$idEvento = $_POST['idEvento'];
	if( $idEvento == 0 )
	{
		$idEvento = $_GET['idEvento'];
	}
	
	$chefe = $_POST['ychefe'];

	require ("DB_mysql.php");
	$conexao = new DB_mysql ;
	$conexao->conectarConf();
	
		// alterar dados
		$query = "insert into chefes_evento (idevento,nome) values ($idEvento,'$chefe')";
		$conexao->executaQuery($query);		

	header ("Location:../adm/busca_evento.php");
?>