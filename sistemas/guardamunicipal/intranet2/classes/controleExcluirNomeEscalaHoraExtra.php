<?php
	$verIncluir = false;
	$id = 0;
	$id = $_POST['idescala'];
	$login = $_POST['login'];
	if( $id == 0 )
	{
		$id = $_GET['idescala'];
		$login = $_GET['login'];
	}
	require ("DB_mysql.php");
	$obj = new DB_mysql;

	if( $id > 0 )
	{
		// excluir Categoria
		$query = "DELETE FROM listaescala where idescala='$id' and login='$login'";
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
		echo 'Exclusão não permitida';
	}
	else
	{
		header ("Location:../adm/busca_escala_horaextra.php");
	}
?>