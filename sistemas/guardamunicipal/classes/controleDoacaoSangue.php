<?php
	$id = (int)$_GET['id'];
	$status = $_GET['status'];
	$gmsolicitante = $_GET['gmsolicitante'];
	$datadoacao = $_GET['xdatadoacao'];
	$turno = $_GET['yturno'];
	
	if( $id == 0 )
	{
		$id = (int)$_POST['id'];
		$status = $_POST['status'];
		$gmsolicitante = $_POST['gmsolicitante'];
		$matricula = $_POST['matricula'];
		$turno = $_POST['yturno'];
		$datadoacao = $_POST['xdatadoacao'];
		$motivostatus = $_POST['xmotivostatus'];
	}

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
		$queryP = "INSERT INTO folgacalendario(idpedido,data,gm,motivo,turno) values ('$id','$datadoacao','$gmsolicitante','DOACAO SANGUE','$turno')";
		$obj->executaQuery($queryP);
		echo "<script>alert('Doacao cadastrada com sucesso!');</script>";             	
		echo "<script> window.location.href = '../controle/administrar_servicos_online.php' </script>";
	}
	else
	if( $id > 0 )
	{
		// excluir Categoria
		$query = "DELETE FROM doacaosangue where id=$id";
		$obj->executaQuery($query);
		$obj->closeVar($path);
		echo "<script>alert('Deletado com sucesso!');</script>";             	
		echo "<script> window.location.href = '../controle/cadastro_doacao_sangue.php' </script>";
	}
	else
	{
		$query = "INSERT INTO doacaosangue (gmsolicitante,matricula, data, turno, datadoacao, status) values ('$gmsolicitante','$matricula','$data_atual','$turno','$datadoacao',0)";
		$obj->executaQuery($query);
		echo "<script>alert('Cadastro realizado com sucesso!');</script>";             	
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