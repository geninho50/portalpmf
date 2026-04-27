<?php
	require ("trataString.php");
	$objS = new trataString;

	$id = 0;
	$id = $_POST['id'];
	if( $id == 0 )
	{
		$id = $_GET['id'];
	}
	$guarda = $_POST['xGM1_1'];
	$tamanho = strlen($guarda);
	$titulo = $_POST['xtitulo'];
	$ano = $_POST['xano'];
	
	require ("DB_mysql.php");
	$conexao = new DB_mysql ;
	$conexao->conectarConf();
	require ("trataArquivo.php");
	$objT = new trataArquivo;
	require ("trataData.php");
	$objD = new trataData;
	
	$queryG = "SELECT * from guarda_gmf where login='$guarda'";
	$resultadoG = $conexao->executaQuery($queryG);	
	$linhaG = mysql_fetch_array($resultadoG);
	if ( $linhaG )
	{
		$matricula = $linhaG['matricula'];
	}

	if( $tamanho > 0 && $id > 0 )
	{
		// alterar dados
		$query = "UPDATE digital set ano='$ano',titulo='$titulo' where id=$id";
		$conexao->executaQuery($query);		
	}
	else
	if( $id > 0 )
	{
		// excluir ítem extra
		$query = "delete from digital where id=$id";
		$conexao->executaQuery($query);

		// exclui arquivos caso existirem
		$path = $objT->getPath(6)."$id/";
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
		$query = "insert into digital (guarda,ano,titulo,data) values ('$guarda','$ano','$titulo',CURRENT_DATE())";
		$conexao->executaQuery($query);

		// Pega o ultimo id inserido e atualiza a variavel $id
		//$queryI = "select MAX(id) as id from digital";
		//$resultadoI = mysql_query($queryI) or die ("Não foi possível realizar a consulta ao banco de dados");	
		//while ($linhaI=mysql_fetch_array($resultadoI))
		//{
		//	$id = $linhaI['id'];
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

	$path = $objT->getPath(6)."$id/";
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
		$path = $objT->getPath(6)."$id/".$nomearquivo;
		copy($tmp_name,$path);

		$query = "UPDATE digital set nomearquivo='$nomearquivo',tamanho='$tamanho_arquivo' where id=$id";
		$conexao->executaQuery($query);
	}
	// Redireciona
	header ("Location:../controle/cadastro_digital.php");
?>