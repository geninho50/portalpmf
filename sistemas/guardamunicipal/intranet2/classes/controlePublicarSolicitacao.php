<?php
	require ("trataString.php");
	$objS = new trataString;

	$id = 0;
	$id = (int)$_POST['id'];
	$nome = $_POST['xnome'];
	if( $id == 0 )
	{
		$id = (int)$_GET['id'];
		$nome = $_GET['xnome'];
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

		$query = "SELECT * FROM solicitacaoescola where id=$id";
		$resultado = $conexao->executaQuery($query);
		$linha = mysql_fetch_array($resultado);
		if( $linha )
		{
			$data = $linha["data"];
			$escola = $linha["escola"];
		}		

	// Upload de IMAGEM	
	// Prepara a variável do arquivo
	$arquivo = isset($_FILES["arquivo"]) ? $_FILES["arquivo"] : FALSE;	
	$tmp_name = $_FILES["arquivo"]["tmp_name"];
	
	$nomearquivo = $_FILES["arquivo"]["name"];
	$tipoarquivo = $_FILES["arquivo"]["type"];
	$tamanho_arquivo = $_FILES["arquivo"]["size"];

	$path = $objT->getPath(10)."$id/";
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
		$path = $objT->getPath(10)."$id/".$nomearquivo;
		$tmp_name;
		copy($tmp_name,$path);
	}
	// Redireciona
	header ("Location:../controle/listar_solcitacao_escola.php?idEscola=$escola");
?>