<?php
	$verIncluir = false;
	$id = 0;
	$id = $_POST['id'];
	if( $id == 0 )
	{
		$id = $_GET['id'];
	}
	$nome = $_POST['xnome'];
	$descricao = $_POST['xdescricao'];
	$local = $_POST['xlocal'];
	$horario = $_POST['xhora'];
	$data = $_POST['dataini'];

	require ("DB_mysql.php");
	$obj = new DB_mysql;
	require ("trataArquivo.php");
	$oArquivo = new trataArquivo;

	$tamanho = strlen($nome);
	if( $tamanho > 0 && $id > 0 )
	{
		// alterar
		$query = "UPDATE agenda set data='$data',nome='$nome',horario='$horario',local='$local',descricao='$descricao' where id=$id";		
	}
	else
	if( $id > 0 )
	{
		// excluir Categoria
		$query = "DELETE FROM agenda where id=$id";
		$obj->closeVar($path);
	}
	else
	{
		// incluir
		if( $tamanho > 0 )
			$query = "INSERT INTO agenda (nome,descricao,local,horario,data) values ('$nome','$descricao','$local','$horario','$data')";
		$verIncluir = true;
	}
	// Excluir a Categoria
	$obj->executaQuery($query);
	// Fechando as variáveis
	$obj->closeVar($id);
	$obj->closeVar($nome);
	$obj->closeVar($local);
	$obj->closeVar($horario);
	$obj->closeVar($descricao);
	$obj->closeVar($oArquivo);
	$obj->closeVar($tamanho);
	$obj->closeVar($query);		
	$obj->closeQuery();
	$obj->closeConexaoGeral();

	// Redireciona
	if( $verIncluir == false )
	{
		header ("Location:../adm/busca_agenda.php");
	}
	else
	{
		header ("Location:../adm/cadastro_agenda.php");
	}
?>