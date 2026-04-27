<?php
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
		$queryC = "select * from controleatividadeextra where idatividade=$id AND login='$login'";
		$resultadoC = $obj->executaQuery($queryC);
		$linhaC = mysql_fetch_array($resultadoC);
		if($linhaC){
			echo "<script>alert('Nome ja cadastrado na atividade!');</script>";                       
			echo "<script> window.location.href = '../controle/listar_atividade_extra.php' </script>";
		}
		else{
			$query = "INSERT INTO controleatividadeextra(idatividade,login,data) values ('$id','$login','$data_atual')";
			$obj->executaQuery($query);
			echo "<script>alert('Nome incluso com sucesso!');</script>";                       
			echo "<script> window.location.href = '../controle/listar_atividade_extra.php' </script>";
		}
	}
	else
	{	
			$query = "DELETE FROM controleatividadeextra where idatividade=$id and login='$login'";
			$obj->executaQuery($query);
			echo "<script>alert(Excluído com sucesso!');</script>";                       
			echo "<script> window.location.href = '../controle/listar_atividade_extra.php' </script>";
	}
	$obj->closeVar($id);
	$obj->closeVar($oArquivo);
	$obj->closeVar($tamanho);
	$obj->closeVar($query);		
	$obj->closeQuery();
	$obj->closeConexaoGeral();

?>