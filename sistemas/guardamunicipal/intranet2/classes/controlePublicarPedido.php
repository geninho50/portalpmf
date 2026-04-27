<?php
	require ("trataString.php");
	$objS = new trataString;

	$id = 0;
	echo $id = (int)$_POST['id'];
	if( $id == 0 )
	{
		$id = (int)$_GET['id'];
		$chave = $_GET['chave'];
	}
	/*$nome = mysql_escape_string($_POST['xnome']);
	$tamanho = strlen($nome);
	$descricao = $_POST['descricao'];*/
	
	require ("DB_mysql.php");
	$conexao = new DB_mysql ;
	$conexao->conectarConf();
	require ("trataArquivo.php");
	$objT = new trataArquivo;
	require ("trataData.php");
	$objD = new trataData;


		$query = "SELECT * FROM evento where id=$id";
		$resultado = $conexao->executaQuery($query);
		$linha = mysql_fetch_array($resultado);
		if( $linha )
		{
			$data = $linha["data"];
			$nome = $linha["nome"];
		}		

	$arquivo = isset($_FILES["arquivo"]) ? $_FILES["arquivo"] : FALSE;	
	$tmp_name = $_FILES["arquivo"]["tmp_name"];
	
	$nomearquivo = $_FILES["arquivo"]["name"];
	$tipoarquivo = $_FILES["arquivo"]["type"];
	$tamanho_arquivo = $_FILES["arquivo"]["size"];

	$path = $objT->getPath(15)."$id/";
	$tamanhoNomeArquivoEnviado = strlen($nomearquivo);

	// Verifica se algum arquivo foi enviado...
	if( $tamanhoNomeArquivoEnviado > 0 )
	{
		if (!is_dir($path) )
		{
			mkdir ($path, 0777); // rmdir($_GET['rem'])
		}
		else
		{
			// Excluir arquivos antigos da pasta
			//$objT->rmdir_rf($path);
		}
		$path = $objT->getPath(15)."$id/".$nomearquivo;
		copy($tmp_name,$path);
	}
	// Redireciona
	header ("Location:../controle/listar_evento.php?idEvento=$id");
?>