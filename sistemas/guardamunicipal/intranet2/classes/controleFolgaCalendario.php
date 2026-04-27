
<?php

	$id = 0;
	
	$id = $_POST['id'];
	
	if( $id == 0 )
	{
		$id = $_GET['id'];
	}
	
	$data = $_POST['dataini'];
	$gm = $_POST['ygmsolicitante'];
	$motivo = $_POST['motivo'];
	$turno = $_POST['yturno'];

	require ("DB_mysql.php");
	$obj = new DB_mysql;
	require ("trataArquivo.php");
	$oArquivo = new trataArquivo;
	$tamanho = strlen($gm);
	
	$data_atual = date("Y-m-d");
	
	if( $status > 0 && $id > 0)
	{
		// alterar
		$query = "UPDATE folgacalendario set data='$data',gm='$gm',motivo='$motivo',turno='$turno' where id=$id";	
		echo "<script>alert('Atualizado com sucesso!');</script>";	
		echo "<script> window.location.href = '../controle/pedido_folga.php' </script>";
	}
	else
	if( $id > 0 )
	{
		// excluir Categoria
		$query = "DELETE FROM folgacalendario where id=$id";
		$obj->closeVar($path);
		echo "<script>alert('Deletado com sucesso!');</script>";
		echo "<script> window.location.href = '../controle/pedido_folga.php' </script>";
	}
	else
	{
			$query = "INSERT INTO folgacalendario (data,gm,motivo,turno) values ('$data','$gm','$motivo','$turno')";
			echo "<script>alert('Inserido com sucesso!');</script>";
			echo "<script> window.location.href = '../controle/pedido_folga.php' </script>";
	}
	
	
	// Excluir a Categoria
	$obj->executaQuery($query);
	// Fechando as variáveis
	$obj->closeVar($id);
	$obj->closeVar($query);		
	$obj->closeQuery();
	$obj->closeConexaoGeral();
?>