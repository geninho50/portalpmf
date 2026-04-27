<?php
	$id = 0;
	$status = '';
	$id = $_POST['id'];
	$status = $_POST['status'];
	if( $id == 0 )
	{
		$id = $_GET['id'];
		$status = $_GET['status'];
	}
	$gmsolicitante = $_POST['gmsolicitante'];
	$matricula = $_POST['matricula'];
	$grupo = $_POST['ygrupo'];
	$datadoacao = $_POST['xdatadoacao'];
	$motivostatus = $_POST['xmotivostatus'];


	require ("DB_mysql.php");
	$obj = new DB_mysql;
	require ("trataArquivo.php");
	$oArquivo = new trataArquivo;
	$tamanho = strlen($gmsolicitante);
	$tamanhochefe = strlen($chefeoperacoes);
	
	//Pega a data atual
   $data_atual = date("Y-m-d");
	
	if( $status > 0 && $id > 0)
	{
		// alterar
		$query = "UPDATE doacaosangue set status='$status',motivostatus='$motivostatus' where id=$id";		
		$obj->executaQuery($query);
		echo "<script>alert('Doacao de sangue atualizado com sucesso!');</script>";
		echo "<script> window.location.href = '../controle/doacao_sangue.php' </script>";
	}
	else
	if( $id > 0 )
	{
		// excluir Categoria
		$query = "DELETE FROM doacaosangue where id=$id";
		$obj->closeVar($path);
		echo "<script>alert('Doacao de sangue deletado com sucesso!');</script>";
		echo "<script> window.location.href = '../controle/doacao_sangue.php' </script>";
	}
	else
	{
			$query = "INSERT INTO doacaosangue (gmsolicitante,matricula, data, grupo, datadoacao, status) values ('$gmsolicitante','$matricula','$data_atual','$grupo','$datadoacao',0)";
			$obj->executaQuery($query);
			echo "<script>alert('Doacao de sangue cadastrado com sucesso!');</script>";
			echo "<script> window.location.href = '../controle/cadastro_doacao_sangue.php' </script>";
	}
	// Excluir a Categoria
	
	// Fechando as variáveis
	$obj->closeVar($id);
	$obj->closeVar($oArquivo);
	$obj->closeVar($tamanho);
	$obj->closeVar($query);		
	$obj->closeQuery();
	$obj->closeConexaoGeral();
?>