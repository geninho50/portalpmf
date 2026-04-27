<?php
	$verIncluir = false;
	$id = 0;
	$id = $_POST['idFolga'];
	if( $id == 0 )
	{
		$id = $_GET['idFolga'];
	}

	require ("DB_mysql.php");
	$obj = new DB_mysql;
	require ("trataArquivo.php");
	$oArquivo = new trataArquivo;

	if( $id > 0 )
	{
		// excluir Categoria
		$query = "DELETE FROM folgacalendario where id=$id";
		$obj->closeVar($path);
		$verIncluir = true;
	}

	// Excluir a Categoria
	$obj->executaQuery($query);
	// Redireciona
	if( $verIncluir == true )
	{
		header ("Location:../adm/listar_servicos_online.php");
	}
	else
	{
		header ("Location:../adm/listar_servicos_online.php");
	}
?>