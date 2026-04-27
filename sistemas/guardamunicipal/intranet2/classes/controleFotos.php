<?php
	$id = 0;
	$id = $_POST['id'];
	if( $id == 0 )
	{
		$id = $_GET['id'];
	}
	
	$nome = $_POST['xnome'];
	$tamanho = strlen($nome);
	$descricao = $_POST['descricao'];

	$ygaleria = $_POST['ygaleria'];
	if( $ygaleria == 0 )
	{
		$ygaleria = $_GET['ygaleria'];
	}
	

	require ("DB_mysql.php");
	$conexao = new DB_mysql ;
	$conexao->conectarConf();
	require ("trataArquivo.php");
	$objT = new trataArquivo;
	require ("trataData.php");
	$objD = new trataData;

	// Variбveis com os tamanhos das previews
	$tamanhoPreview1 = 100;
	$tamanhoPreview2 = 500;

	$verIncluir = false;

	if( $tamanho > 0 && $id > 0 )
	{
		// alterar
		$query = "UPDATE fotos set nome='$nome',idgaleria=$ygaleria,descricao='$descricao' where id=$id";
		$conexao->executaQuery($query);		
	}
	else
	if( $id > 0 )
	{
		// excluir
		$query = "delete from fotos where id=$id";
		$conexao->executaQuery($query);

		// exclui arquivos caso existirem
		$path = $objT->getPath(8)."$id/";
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
		$data_texto = "";
		$data_texto = $objD->getData();
		$query = "insert into fotos (idgaleria,nome,descricao,data,data_texto) values ($ygaleria,'$nome','$descricao',CURRENT_DATE(),'$data_texto')";
		$conexao->executaQuery($query);

		// Pega o ultimo id inserido e atualiza a variavel $id
		$query = "select MAX(id) as id from fotos";
		$resultado = mysql_query($query) or die ("Nгo foi possнvel realizar a consulta ao banco de dados");	
		while ($linha=mysql_fetch_array($resultado))
		{
			$id = $linha['id'];
		}
		$verIncluir = true;
	}

	// Upload de IMAGEM	
	// Prepara a variбvel do arquivo
	$arquivo = isset($_FILES["arquivo"]) ? $_FILES["arquivo"] : FALSE;	
	$tmp_name = $_FILES["arquivo"]["tmp_name"];
	$nome = $_FILES["arquivo"]["name"];
	$path = $objT->getPath(8)."$id/";
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
		$path = $objT->getPath(8)."$id/$id".".jpg";
		copy($tmp_name,$path);
		
		// Tratamento de IMAGEM [ Cria as previews para 120 e 500 px de comprimento ]
		try 
		{
			require ("Resize.php");
			$tmp = getimagesize($path);
            $width  = $tmp[0];
            $height  = $tmp[1];			
			// Criaзгo da Preview 1
			$path1 = $objT->getPath(8)."$id/$id"."_1.jpg";
			if( $width > $tamanhoPreview1 )
			{					
				$tI = new Resize($path);
				$tI->setNewImage($path1);
				$tI->setProportionalFlag('H');
				$tI->setProportional(1);
				$tI->setNewSize($tamanhoPreview1,$tamanhoPreview1);
				$tI->make();
			}
			else
			{
				copy($tmp_name,$path1);
			}			
			// Criaзгo da Preview 2
			$path2 = $objT->getPath(8)."$id/$id"."_2.jpg";
			if( $width > $tamanhoPreview2 )
			{					
				$tI2 = new Resize($path);
				$tI2->setNewImage($path2);
				$tI2->setProportionalFlag('H');
				$tI2->setProportional(1);
				$tI2->setNewSize($tamanhoPreview2,$tamanhoPreview2);
				$tI2->make();
			}
			else
			{
				copy($tmp_name,$path2);
			}
		}
		catch (Exception $e)
		{
			die($e);
		}
	}
	header ("Location:../adm/cadastro_foto.php?idgaleria=".$ygaleria);
?>