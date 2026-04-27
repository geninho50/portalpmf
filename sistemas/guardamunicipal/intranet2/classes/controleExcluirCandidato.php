<?php
	$id = 0;
	$id = $_POST['id'];
	$idescala = $_POST['idescala'];
	if( $id == 0 )
	{
		$id = $_GET['id'];
		$idescala = $_GET['idescala'];
	}
	require ("DB_mysql.php");
	$obj = new DB_mysql;

	if( $id > 0 )
	{
		$query = "DELETE FROM listaescala where id='$id'";
		$obj->executaQuery($query);
		echo "<script>alert('Candidato excluso com sucesso!');</script>";                       
		echo "<script> window.location.href = '../controle/confirmar_escala_horaextra.php?idescala=$idescala' </script>";
	}else{
		echo "<script>alert('Problema para excluir o candidato!');</script>";                       
		echo "<script> window.location.href = '../controle/confirmar_escala_horaextra.php?idescala=$idescala' </script>";
	}
	// Fechando as variáveis
	$obj->closeVar($id);
	$obj->closeVar($nome);
	$obj->closeVar($query);		
	$obj->closeQuery();
	$obj->closeConexaoGeral();
?>