<?php
	$verIncluir = false;
	$verAtualizar = false;
	$verExcluir = false;
	$id = 0;
	$id = (int)$_POST['id'];
	if( $id == 0 )
	{
		$id = (int)$_GET['id'];
	}
	$local = $_POST['xlocal'];
	$tempo = $_POST['tempo'];
	$complemento = $_POST['complemento'];
	$status = $_POST['status'];	

	require ("DB_mysql.php");
	$obj = new DB_mysql;
	$tamanho = strlen($local);
	
	$data_atual = date("Y-m-d");
	
	if( $tamanho > 0 && $id > 0 )
	{
		// alterar
		$query = "UPDATE atividadeextra set local='$local',complemento='$complemento',tempo='$tempo' where id=$id";
		$verAtualizar = true;
	}
	else
	if( $id > 0 )
	{
		// excluir
		$query = "DELETE FROM atividadeextra where id=$id";
		$verExcluir = true;
	}
	else
	{
		if( $tamanho > 0 )      
			$query = "INSERT INTO atividadeextra (data,local,complemento,tempo,status) values ('$data_atual','$local','$complemento','$tempo','S')";
		$verIncluir = true;
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

	// Redireciona
	if( $verIncluir == true )
	{
		header ("Location:../controle/listar_atividade_extra.php");
	}
	else
	{
		if( $verAtualizar == true )
		{
			header ("Location:../controle/listar_atividade_extra.php");
		}
		else{
			if( $verExcluir == true )
			{
				header ("Location:../acontrolem/listar_atividade_extra.php");
			}
		}
	}

?>