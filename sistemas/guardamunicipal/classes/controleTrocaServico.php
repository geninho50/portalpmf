<?php
	
	$id = (int)$_GET['id'];
	$status = mysql_escape_string($_GET['status']);
	$acao = mysql_escape_string($_GET['acao']);
	$gmsolicitante = mysql_escape_string($_GET['gmsolicitante']);
	$gmsolicitado = mysql_escape_string($_GET['ygmsolicitado']);
	$datatroca = mysql_escape_string($_GET['xdatatroca']);
	$turno = mysql_escape_string($_GET['yturno']);
	
	if( $id == 0 )
	{
		$id = (int)$_POST['id'];
		$status = mysql_escape_string($_POST['status']);
		$acao = mysql_escape_string($_POST['acao']);
		$gmsolicitante = mysql_escape_string($_POST['gmsolicitante']);
		$matricula = mysql_escape_string($_POST['matricula']);
		$gmsolicitado = mysql_escape_string($_POST['ygmsolicitado']);
		$datatroca = mysql_escape_string($_POST['xdatatroca']);
		$formareposicao = mysql_escape_string($_POST['xformareposicao']);
		$motivotroca = mysql_escape_string($_POST['motivo']);
		$motivostatus = mysql_escape_string($_POST['xmotivostatus']);
		$turno = mysql_escape_string($_POST['yturno']);
	}
	
	$tamanho = strlen($gmsolicitante);
	$tamanhogm = strlen($gmsolicitado);


	require ("DB_mysql.php");
	$obj = new DB_mysql;
	require ("trataArquivo.php");
	$oArquivo = new trataArquivo;
	
	//Pega a data atual
   $data_atual = date("Y-m-d");
	
	if( $status > 0 && $id > 0)
	{
		// alterar
		$query = "UPDATE trocaservico set status='$status',motivostatus='$motivostatus' where id=$id";
		$queryP = "INSERT INTO folgacalendario(idfolga,idpedido,data,gm,motivo,turno) values (0,'$id','$datatroca','$gmsolicitante','TROCA DE SERVICO COM O GM $gmsolicitado COM REPOSICAO PARA $formareposicao','$turno')";
		$obj->executaQuery($queryP);
		echo "<script>alert('Troca efetuada com sucesso!');</script>";             	
		echo "<script> window.location.href = '../controle/administrar_servicos_online.php' </script>";
	}
	else
	if( $id > 0 )
	{
		// excluir Categoria
		$query = "DELETE FROM trocaservico where id=$id";
		$obj->closeVar($path);
		echo "<script>alert('Exlusao efetuada com sucesso!');</script>";             	
		echo "<script> window.location.href = '../controle/cadastro_troca_servico.php' </script>";
	}
	else
	{
			$query = "INSERT INTO trocaservico (gmsolicitante,matricula, data, gmsolicitado, datatroca, formareposicao, motivotroca,turno,status) values ('$gmsolicitante','$matricula','$data_atual','$gmsolicitado','$datatroca','$formareposicao','$motivotroca','$turno',0)";
			echo "<script>alert('Cadastro efetuada com sucesso!');</script>";             	
			echo "<script> window.location.href = '../controle/cadastro_troca_servico.php' </script>";
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
?>