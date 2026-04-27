<?php
	$id = 0;
	$id = $_POST['id'];
	if( $id == 0 )
	{
		$id = $_GET['id'];
	}
	require ("trataArquivo.php");
	$oArquivo = new trataArquivo;
	$path = $oArquivo->getPath(2)."$id/";
	// Excluir arquivo(s)
	$oArquivo->rmdir_rf($path);
	// Excluir pasta
	rmdir($path);
	$oArquivo->closeVar($path);
	// Redireciona a página de busca do funcionário
	header ("Location:../adm/cadastro_produto.php?id=$id");
?>