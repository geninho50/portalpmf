<?php
	$verIncluir = false;
	$id = 0;
	$id = (int)$_POST['idescala'];
	$login =  mysql_escape_string($_POST['login']);
	if( $id == 0 )
	{
		$id = (int)$_GET['idescala'];
		$login =  mysql_escape_string($_GET['login']);
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
		header ("Location:../controle/administrar_escala_horaextra.php");
	}
?>