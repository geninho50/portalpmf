<?php
	$verIncluir = false;
	$verAtualizar = false;
	$verExcluir = false;
	$id = 0;
	$login = '';
	$status = '';
	$id = $_POST['id '];
	$login = $_POST['login '];
	$status = $_POST['status '];
	if( $id == 0 )
	{
		$id = $_GET['id'];
		$login = $_GET['login'];
		$status = $_GET['status'];
	}

	require ("DB_mysql.php");
	$obj = new DB_mysql;
	require ("trataArquivo.php");
	$oArquivo = new trataArquivo;
	$tamanho = strlen($login);
	
	$data_atual = date("Y-m-d");
	
	if( $status == 'add')
	{
		/*$queryC = "select * from controleatividadeextra where login=$login and idatividade=$id";
		$resultadoC = $obj->executaQuery($queryC);
		$linhaC = mysql_fetch_array($resultadoC)
		if($linha){
			echo'Nome já cadastrado!'
		}
		else		*/
			$query = "INSERT INTO controleatividadeextra(idatividade,login,data) values ('$id','$login','$data_atual')";
			$obj->executaQuery($query);
			$verIncluir = true;
		//}
	}
	else
	{	
			$query = "DELETE FROM controleatividadeextra where idatividade=$id and login='$login'";
			$obj->executaQuery($query);
			$verExcluir = true;
	}
	
	// Excluir a Categoria
	//$obj->executaQuery($query);
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
		echo 'Incluso com sucesso';
	}
	else
	{
		if( $verAtualizar == true )
		{
			header ("Location:../adm/listar_atividade_extra.php");
		}
		else{
			if( $verExcluir == true )
			{
				echo 'Excluído com sucesso';
			}
		}
	}
?>