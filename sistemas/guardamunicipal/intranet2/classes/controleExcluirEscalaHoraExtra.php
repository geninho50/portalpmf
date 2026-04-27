<?php
	$verIncluir = false;
	$id = 0;
	$id = $_POST['idescala'];
	$status = $_POST['status'];
	if( $id == 0 )
	{
		$id = $_GET['idescala'];
		$status = $_GET['status'];
	}
	require ("DB_mysql.php");
	$obj = new DB_mysql;

	if( $id > 0 )
	{
		
		$queryE = "update escalahoraextra set status='N' where id='$id'";
		$obj->executaQuery($queryE);
		// excluir candidatos
		$query = "DELETE FROM candidatos where idescala='$id'";
		$obj->executaQuery($query);
		$verIncluir = true;
	}
	// Fechando as variáveis
	$obj->closeVar($id);
	$obj->closeVar($nome);
	$obj->closeVar($query);		
	$obj->closeQuery();
	$obj->closeConexaoGeral();

	// Redireciona
	if( $verIncluir == false )
	{
		header ("Location:../adm/busca_escala_horaextra.php");
	}
	else
	{
		header ("Location:../adm/busca_escala_horaextra.php");
	}
?>