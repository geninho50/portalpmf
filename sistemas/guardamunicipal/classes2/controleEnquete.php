<?php
	require ("trataString.php");
	$objS = new trataString;

	$id = 0;
	$id = (int)$_POST['id'];
	if( $id == 0 )
	{
		$id = (int)$_GET['id'];
	}
	$nome = mysql_escape_string($_POST['xnome']);
	$tamanho = strlen($nome);
	$status = $_POST['status'];
	
	require ("DB_mysql.php");
	$conexao = new DB_mysql ;
	$conexao->conectarConf();
	require ("trataArquivo.php");
	$objT = new trataArquivo;
	require ("trataData.php");
	$objD = new trataData;

	if( $tamanho > 0 && $id > 0 )
	{
		// alterar dados
		$query = "UPDATE enquete set nome='$nome',status='$status' where id=$id";
		$conexao->executaQuery($query);		
	}
	else
	if( $id > 0 )
	{
		// excluir ítem extra
		$query = "delete from enquete where id=$id";
		$conexao->executaQuery($query);

		// exclui arquivos caso existirem
		$path = $objT->getPath(3)."$id/";
		if (is_dir($path) )
		{
			// Excluir arquivos antigos da pasta
			$objT->rmdir_rf($path);
			// Excluir pasta
			rmdir($path);
		}
	}
	else
	{
		// incluir
		//$data_texto = "";
		//$data_texto = $objD->getData();
		$query = "insert into enquete (nome,status,data) values ('$nome',0,CURRENT_DATE())";
		$conexao->executaQuery($query);

		// Pega o ultimo id inserido e atualiza a variavel $id
		//$query = "select MAX(id) as id from extra";
		//$resultado = mysql_query($query) or die ("Não foi possível realizar a consulta ao banco de dados");	
		//while ($linha=mysql_fetch_array($resultado))
		//{
		//	$id = $linha['id'];
		//}
		$id = mysql_insert_id();
	}

	// Upload de IMAGEM	
	// Prepara a variável do arquivo
	$arquivo = isset($_FILES["arquivo"]) ? $_FILES["arquivo"] : FALSE;	
	$tmp_name = $_FILES["arquivo"]["tmp_name"];
	
	$nomearquivo = $_FILES["arquivo"]["name"];
	$tipoarquivo = $_FILES["arquivo"]["type"];
	$tamanho_arquivo = $_FILES["arquivo"]["size"];

	$path = $objT->getPath(13)."$id/";
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
			$objT->rmdir_rf($path);
		}
		$path = $objT->getPath(13)."$id/".$nomearquivo;
		copy($tmp_name,$path);

		$query = "UPDATE enquete set nomearquivo='$nomearquivo',tipo='$tipoarquivo',tamanho='$tamanho_arquivo' where id=$id";
		$conexao->executaQuery($query);
	}
	// Redireciona
	header ("Location:../controle/cadastro_enquete.php");
?>