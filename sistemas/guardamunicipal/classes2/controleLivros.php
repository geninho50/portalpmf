<?php
	$verIncluir = false;
	$verAtualizar = false;
	$verExcluir = false;
	
	$idLivro = 0;
	$idLivro = $_POST['idLivro'];
	if( $idLivro == 0 )
	{
		$idLivro = $_GET['idLivro'];
	}
	$codigo = $_POST['xcodigo'];
	echo 'codigo '.$codigo;
	$titulo = $_POST['xtitulo'];
	$subtitulo = $_POST['subtitulo'];
	$autor = $_POST['xautor'];
	$assunto = $_POST['xassunto'];
	$editora = $_POST['xeditora'];
	$anopublicacao = $_POST['xanopulicacao'];
	$edicao = $_POST['xedicao'];
	$paginas = $_POST['xpaginas'];
	$idiomas = $_POST['xidiomas'];
	$tipo = $_POST['ytipo'];
	
	require ("DB_mysql.php");	
	require ("trataArquivo.php");
	require ("trataData.php");
	$conexao = new DB_mysql;
	$conexao->conectarConf();
	$objT = new trataArquivo;
	$objD = new trataData;
	
	$data_atual = date("Y-m-d");
	
	// Variбveis com os tamanhos das previews
	$tamanhoPreview1 = 110;

	$tamanho = strlen($titulo);
	echo 'tamanho '.$tamanho;
	if( $tamanho > 0 && $idLivro > 0 )
	{
		// alterar
		$query = "UPDATE livros set codigo='$codigo',titulo='$titulo',subtitulo='$subtitulo',autor='$autor',assunto='$assunto',editora='$editora',anopublicacao='$anopublicacao',edicao='$edicao',paginas='$paginas',idiomas='$idiomas',tipo='$tipo' where id=$idLivro";		
		$verAtualizar = true;
		$conexao->executaQuery($query);
		
	}
	else
	if( $idLivro > 0 )
	{
		// excluir
		$query = "DELETE FROM livros where id=$idLivro";
		$conexao->executaQuery($query);	
		$verExcluir = true;
				
		// exclui arquivos caso existirem
		$path = $objT->getPath(17)."$idLivro/";
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
		$queryC = "select codigo from livros where codigo='$codigo'";
		$resultadoC = mysql_query($queryC) or die ("Nгo foi possнvel realizar a consulta ao banco de dados");	
		$linhaC = mysql_fetch_array($resultadoC);
		if($linhaC){		
			echo 'Cуdigo em uso por outro livro!';
		}else{
			// incluir
			$query = "INSERT INTO livros (codigo,titulo,subtitulo,autor,assunto,editora,anopublicacao,edicao,paginas,idiomas,tipo,data) values ('$codigo','$titulo','$subtitulo','$autor','$assunto','$editora',$anopublicacao,'$edicao',$paginas,'$idiomas','$tipo','$data_atual')";
			$conexao->executaQuery($query);
			$verIncluir = true;
			
			// Pega o ultimo id inserido e atualiza a variavel $idNoticia
			$query = "select MAX(id) as id from livros";
			$resultado = mysql_query($query) or die ("Nгo foi possнvel realizar a consulta ao banco de dados");	
			while ($linha=mysql_fetch_array($resultado))
			{
				$idLivro = $linha['id'];
			}
		}	
	}
	
	// Upload de IMAGEM
	
	// Prepara a variбvel do arquivo
	$arquivo = isset($_FILES["arquivo"]) ? $_FILES["arquivo"] : FALSE;	
	$tmp_name = $_FILES["arquivo"]["tmp_name"];
	$nome = $_FILES["arquivo"]["name"];
	$path = $objT->getPath(17)."$idLivro/";
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
		$path = $objT->getPath(17)."$idLivro/$idLivro".".jpg";
		copy($tmp_name,$path);

		
		// Tratamento de IMAGEM [ Cria as previews para 120, 270 e 800 px de comprimento ]
		try 
		{
			require ("Resize.php");
			$tmp = getimagesize($path);
            $width  = $tmp[0];
            $height  = $tmp[1];			
			// Criaзгo da Preview 1
			$path1 = $objT->getPath(17)."$idLivro/$idLivro"."_1.jpg";
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
		}
		catch (Exception $e)
		{
			die($e);
		}
	}

	// Redireciona
	
	// Redireciona
	if( $verIncluir == true )
	{
		header ("Location:../controle/cadastro_livro.php");
	}
	else
	{
		if( $verAtualizar == true )
		{
			echo 'Atualizado com sucesso';
		}
		else{
			if( $verExcluir == true )
			{
				echo 'Excluнdo com sucesso';
			}
		}
	}
?>