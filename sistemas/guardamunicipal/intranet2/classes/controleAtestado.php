<?php
	$verIncluir = false;
	$verAtualizar = false;
	$verExcluir = false;
	$id = 0;
	
	$id = $_POST['id'];
	
	if( $id == 0 )
	{
		$id = $_GET['id'];
	}
	
	$data = $_POST['dataini'];
	$gm = $_POST['ygmsolicitante'];
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
		$query = "UPDATE atestado set data='$data',gm='$gm',turno='$turno' where id=$id";	
		$verAtualizar = true;	
	}
	else
	if( $id > 0 )
	{
		// excluir Categoria
		$query = "DELETE FROM atestado where id=$id";
		$obj->closeVar($path);
		$verExcluir = true;
	}
	else
	{
			$query = "INSERT INTO atestado (data,gm,turno) values ('$data','$gm','$turno')";
		$verIncluir = true;
	}
	
	
	// Excluir a Categoria
	$obj->executaQuery($query);
	// Fechando as variáveis
	$obj->closeVar($id);
	$obj->closeVar($query);		
	$obj->closeQuery();
	$obj->closeConexaoGeral();

	// Redireciona
	if( $verIncluir == true )
	{
		header ("Location:../adm/administrar_atestado.php");
	}
	else
	{
		if( $verAtualizar == true )
		{
			echo 'Atualizado com sucesso';
		}
		else{
			if( $verExcluir == true )
			{
				echo 'Excluído com sucesso';
			}
		}
	}
?>