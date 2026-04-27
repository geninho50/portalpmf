<?php
	$id = 0;
	$id = $_POST['id'];
	if( $id == 0 )
	{
		$id = $_GET['id'];
	}
	$atividade = $_POST['xatividade'];
	$data = $_POST['dataini'];
	$complemento = $_POST['complemento'];
	$status = $_POST['status'];	

	require ("DB_mysql.php");
	$obj = new DB_mysql;
	$tamanho = strlen($atividade);
	
	$data_atual = date("Y-m-d");
	
	if( $tamanho > 0 && $id > 0 )
	{
		// alterar
		$query = "UPDATE atividadeextra set local='$local',complemento='$complemento',data='$data' where id=$id";
		echo "<script>alert('Atividade atualizada com sucesso!');</script>";                       
		echo "<script> window.location.href = '../controle/busca_atividade_extra.php' </script>";
	}
	else
	if( $id > 0 )
	{
		// excluir
		$query = "DELETE FROM atividadeextra where id=$id";
		echo "<script>alert('Atividade deletada com sucesso!');</script>";                       
		echo "<script> window.location.href = '../controle/busca_atividade_extra.php' </script>";
	}
	else
	{
		if( $tamanho > 0 )      
			$query = "INSERT INTO atividadeextra (data_cadastro,atividade,complemento,data,status) values ('$data_atual','$atividade','$complemento','$data','S')";
			echo "<script>alert('Atividade inserida com sucesso!');</script>";                       
			echo "<script> window.location.href = '../controle/busca_atividade_extra.php' </script>";
	}
	// Excluir a Categoria
	$obj->executaQuery($query);
	// Fechando as variáveis
	$obj->closeVar($id);
	$obj->closeVar($local);
	$obj->closeVar($complemento);
	$obj->closeVar($tamanho);
	$obj->closeVar($query);		
	$obj->closeQuery();
	$obj->closeConexaoGeral();
?>