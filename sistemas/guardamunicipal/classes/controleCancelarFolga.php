<?php
	include("incValidaSessao.php");
    $idsession = $_SESSION['idSESSION'];
	
	
	$id = 0;
	$id = (int)$_POST['idtemp'];
	if( $id == 0 )
	{
		$id = (int)$_GET['idtemp'];
	}
	$idfolga = $_POST['idfolga'];

	require ("DB_mysql.php");
	$obj = new DB_mysql;
	require ("trataArquivo.php");
	$oArquivo = new trataArquivo;
	$tamanho = strlen($gmsolicitante);
	
	
	$query = "delete from pedidofolga where id=$id";
		$obj->executaQuery($query);
		echo "<script>alert('Folga cancelada com sucesso!');</script>";             	
		echo "<script> window.location.href = '../controle/listar_pedido_folga.php' </script>";

	// Fechando as variáveis
	$obj->closeVar($id);
	$obj->closeVar($oArquivo);
	$obj->closeVar($tamanho);
	$obj->closeVar($query);		
	$obj->closeQuery();
	$obj->closeConexaoGeral();
?>