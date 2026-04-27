<?php
	$id = 0;
	$id = $_POST['id'];
	if( $id == 0 )
	{
		$id = $_GET['id'];
	}

	$posicao = 0;
	$posicao = $_POST['posicao'];
	if( $posicao == 0 )
	{
		$posicao = $_GET['posicao'];
	}

	require ("trataArquivo.php");
	$objT = new trataArquivo;

	if( $posicao > 0 )
	{
		$path = $objT->getPath(7).$id."/".$id."(".$posicao.").jpg";
		if( $objT->arquivoExiste($path) == true)
			unlink($path);
		$path = $objT->getPath(7).$id."/".$id."(".$posicao.")_1.jpg";
		if( $objT->arquivoExiste($path) == true)
			unlink($path);
		$path = $objT->getPath(7).$id."/".$id."(".$posicao.")_2.jpg";
		if( $objT->arquivoExiste($path) == true)
			unlink($path);
	}
	else
	{
		$path = $objT->getPath(7).$id."/".$id.".jpg";
		if( $objT->arquivoExiste($path) == true)
			unlink($path);
		$path = $objT->getPath(7).$id."/".$id."_1.jpg";
		if( $objT->arquivoExiste($path) == true)
			unlink($path);
		$path = $objT->getPath(7).$id."/".$id."_2.jpg";
		if( $objT->arquivoExiste($path) == true)
			unlink($path);
	}
	// Excluir arquivo(s)
	//$objT->rmdir_rf($path);	
	
	$objT->closeVar($path);
	// Redireciona a página de busca do funcionário
	header ("Location:../index.php?area=4444&idanuncio=".$id);
?>