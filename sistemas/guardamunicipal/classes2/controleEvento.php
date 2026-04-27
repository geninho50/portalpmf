<?php
	$idEvento = 0;
	$idEvento = (int)$_POST['idEvento'];
	if( $idEvento == 0 )
	{
		$idEvento = (int)$_GET['idEvento'];
	}
	
	$nome = $_POST['xnome'];
	$numdocumento = $_POST['xnumdocumento'];
	$data = $_POST['xdataini'];
	$horainicial = $_POST['xhorainicial'];
	$horafinal = $_POST['xhorafinal'];
	$responsavel = $_POST['xresponsavel'];
	$telefone = $_POST['xtelefone'];
	$rua = $_POST['rua'];
	$bairro = $_POST['xbairro'];
	$descricao = $_POST['xdescricao'];
	$tamanho = strlen($nome);

	require ("DB_mysql.php");
	$conexao = new DB_mysql ;
	$conexao->conectarConf();
	require ("trataData.php");
	$objD = new trataData;
	require ("trataArquivo.php");
	$objT = new trataArquivo;
	
	$tamanhoPreview1 = 800;
	
	if( $tamanho > 0 && $idEvento > 0 )
	{
		// alterar dados
		$query = "UPDATE evento set nome='$nome',numdocumento='$numdocumento',data='$data',horainicial='$horainicial',horafinal='$horafinal',responsavel='$responsavel',telefone=$'telefone',rua='$rua',bairro='$bairro',descricao='$descricao' where id=$idEvento";
		$conexao->executaQuery($query);		
	}
	else
	if( $idEvento > 0 )
	{
		// excluir envento
		$query = "delete from evento where id=$idEvento";
		$conexao->executaQuery($query);
		
		$query2 = "delete from chefes_evento where idevento=$idEvento";
		$conexao->executaQuery($query2);
		
		// exclui arquivos caso existirem
		$path = $objT->getPath(16)."$idEvento/";
		if (is_dir($path) )
		{
			// Excluir arquivos antigos da pasta
			$objT->rmdir_rf($path);
			// Excluir pasta
			rmdir($path);
		}
		
		// exclui arquivos caso existirem
		$path1 = $objT->getPath(15)."$idEvento/";
		if (is_dir($path1) )
		{
			// Excluir arquivos antigos da pasta
			$objT->rmdir_rf($path1);
			// Excluir pasta
			rmdir($path1);
		}
		// exclui arquivos caso existirem
		$path2 = $objT->getPath(18)."$idEvento/";
		if (is_dir($path2) )
		{
			// Excluir arquivos antigos da pasta
			$objT->rmdir_rf($path2);
			// Excluir pasta
			rmdir($path2);
		}
	}
	else
	{
		// incluir
		$data_texto = "";
		$data_texto = $objD->getData();
		$query = "insert into evento (nome,numdocumento,data,horainicial,horafinal,responsavel,telefone,rua,bairro,descricao,data_texto) values ('$nome','$numdocumento','$data','$horainicial','$horafinal','$responsavel','$telefone','$rua','$bairro','$descricao','$data_texto')";
		$conexao->executaQuery($query);
		
		// Pega o ultimo id inserido e atualiza a variavel $idNoticia
		$query = "select MAX(id) as id from evento";
		$resultado = mysql_query($query) or die ("Nгo foi possнvel realizar a consulta ao banco de dados");	
		while ($linha=mysql_fetch_array($resultado))
		{
			$idEvento = $linha['id'];
		}
	}
	
	// Upload de IMAGEM
	
	// Prepara a variбvel do arquivo
	$arquivo = isset($_FILES["arquivo"]) ? $_FILES["arquivo"] : FALSE;	
	$tmp_name = $_FILES["arquivo"]["tmp_name"];
	$nome = $_FILES["arquivo"]["name"];
	$path = $objT->getPath(16)."$idEvento/";
	$tamanhoNomeArquivoEnviado = strlen($nome);

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
		$path = $objT->getPath(16)."$idEvento/$idEvento".".jpg";
		copy($tmp_name,$path);

		
		// Tratamento de IMAGEM [ Cria as previews para 120, 270 e 800 px de comprimento ]
		try 
		{
			require ("Resize.php");
			$tmp = getimagesize($path);
            $width  = $tmp[0];
            $height  = $tmp[1];			
			// Criaзгo da Preview 1
			$path1 = $objT->getPath(16)."$idEvento/$idEvento"."_1.jpg";
			if( $width > $tamanhoPreview1 )
			{					
				$tI2 = new Resize($path);
				$tI2->setNewImage($path1);
				$tI2->setProportionalFlag('H');
				$tI2->setProportional(1);
				$tI2->setNewSize($tamanhoPreview1,$tamanhoPreview1);
				$tI2->make();
			}
			else
			{
				copy($tmp_name,$path1);
			}
		}
		catch (Exception $e)
		{
			die($e);
		}
	}
	
	header ("Location:../controle/busca_evento.php");
?>