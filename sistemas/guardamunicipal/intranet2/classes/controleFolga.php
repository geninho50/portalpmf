<?php
	$verIncluir = false;
	$verAtualizar = false;
	$verExcluir = false;
	$id = 0;
	$qtadeatual = 0;
	
	$id = $_POST['id'];
	
	if( $id == 0 )
	{
		$id = $_GET['id'];
	}
	
	$gm = $_POST['xguarda'];
	$descricao = $_POST['xDescricao'];
	$qtade = $_POST['xQtade'];

	require ("DB_mysql.php");
	$obj = new DB_mysql;
	require ("trataArquivo.php");
	$oArquivo = new trataArquivo;
	$tamanho = strlen($gmsolicitante);
	
	$data_atual = date("Y-m-d");
	
	if( $status > 0 && $id > 0)
	{
		// alterar
		$query = "UPDATE folga set qtadeatual+qtadeatual='$qtadeatual' where id=$id";	
		$verAtualizar = true;	
	}
	else
	if( $id > 0 )
	{
		// excluir Categoria
		$query = "DELETE FROM folga where id=$id";
		$obj->closeVar($path);
		$verExcluir = true;
	}
	else
	{
			$query = "INSERT INTO folga (guarda,descricao, qtade, qtadeatual, data) values ('$gm','$descricao','$qtade',0,'$data_atual')";
		$verIncluir = true;
	}
	
	
	// Excluir a Categoria
	$obj->executaQuery($query);
	// Fechando as variáveis
	$obj->closeVar($id);
	$obj->closeVar($oArquivo);
	$obj->closeVar($tamanho);
	$obj->closeVar($query);		
	$obj->closeQuery();
	$obj->closeConexaoGeral();

	// Redireciona
	if( $verIncluir == true )
	{
		header ("Location:../adm/cadastro_folga.php");
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