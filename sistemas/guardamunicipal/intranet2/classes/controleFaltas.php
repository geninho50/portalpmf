<?php
	$id = 0;
	$qtadeatual = 0;
	
	$id = (int)$_POST['id'];
	
	if( $id == 0 )
	{
		$id = (int)$_GET['id'];
	}
	
	$gm = $_POST['xguarda'];
	$descricao = $_POST['xdescricao'];
	$data = $_POST['xdataini'];

	require ("DB_mysql.php");
	$obj = new DB_mysql;
	require ("trataArquivo.php");
	$oArquivo = new trataArquivo;
	$tamanho = strlen($gm);
	
	$data_atual = date("Y-m-d");
	
	$data_temp = date("Y-m-d", strtotime("$data +30 days"));
	
	if( $tamanho > 0 && $id > 0)
	{
		// alterar
		$query = "UPDATE falta set data='$data',datafim='$data_temp', descricao='$descricao' where id=$id";	
		$obj->executaQuery($query);
		echo "<script>alert('Falta atualizada com sucesso!');</script>";                       
		echo "<script> window.location.href = '../controle/buscar_faltas.php' </script>";	
	}
	else
	if( $id > 0 )
	{
		// excluir Categoria
		$query = "DELETE FROM falta where id=$id";
		$obj->executaQuery($query);
		echo "<script>alert('Falta deletada com sucesso!');</script>";                       
		echo "<script> window.location.href = '../controle/buscar_faltas.php' </script>";	
	}
	else
	{
			$query = "INSERT INTO falta (guarda,descricao, data,datafim) values ('$gm','$descricao','$data','$data_temp')";
			$obj->executaQuery($query);
			echo "<script>alert('Falta cadastrada com sucesso!');</script>";                       
			echo "<script> window.location.href = '../controle/cadastro_faltas.php' </script>";	
	}

	// Fechando as variáveis
	$obj->closeVar($id);
	$obj->closeVar($oArquivo);
	$obj->closeVar($tamanho);
	$obj->closeVar($query);		
	$obj->closeQuery();
	$obj->closeConexaoGeral();

?>