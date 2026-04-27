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
		$queryC = "DELETE FROM candidatos where idescala='$id' and login='$login'";
		$obj->executaQuery($queryC);
		$queryC = "DELETE FROM tempcandidatos where idescala='$id' and login='$login'";
		$obj->executaQuery($queryC);
		echo "<script>alert('Nome deletado com sucesso!');</script>";                       
		echo "<script> window.location.href = '../controle/administrar_escala_horaextra.php' </script>";
	}
	// Fechando as variáveis
	$obj->closeVar($id);
	$obj->closeVar($nome);
	$obj->closeVar($query);		
	$obj->closeQuery();
	$obj->closeConexaoGeral();
?>