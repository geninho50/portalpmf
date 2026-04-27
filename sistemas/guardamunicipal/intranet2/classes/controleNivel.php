<?php
	$verIncluir = false;
	$id = 0;
	$id = $_POST['id'];
	if( $id == 0 )
	{
		$id = $_GET['id'];
	}
	$nome = $_POST['xnome'];
	$valor = $_POST['xvalor'];

	require ("DB_mysql.php");
	$obj = new DB_mysql;
	require ("trataArquivo.php");
	$oArquivo = new trataArquivo;
	$tamanho = strlen($nome);
	if( $tamanho > 0 && $id > 0 )
	{
		// alterar
		$query = "UPDATE nivel set nome='$nome',valor='$valor' where id=$id";		
	}
	else
	if( $id > 0 )
	{
		// excluir Categoria
		$query = "DELETE FROM nivel where id=$id";
		$obj->closeVar($path);
	}
	else
	{
		// incluir
		if( $tamanho > 0 )
			$query = "INSERT INTO nivel (nome,valor) values ('$nome','$valor')";
		$verIncluir = true;
	}
	// Excluir a Categoria
	$obj->executaQuery($query);
	// Fechando as variáveis
	$obj->closeVar($id);
	$obj->closeVar($nome);
	$obj->closeVar($oArquivo);
	$obj->closeVar($tamanho);
	$obj->closeVar($query);		
	$obj->closeQuery();
	$obj->closeConexaoGeral();

	// Redireciona
	if( $verIncluir == false )
	{
		header ("Location:../controles/busca_nivel.php");
	}
	else
	{
		header ("Location:../controle/cadastro_nivel.php");
	}
?>