<?php
	$idEvento = 0;
	$idEvento = $_POST['idEvento'];
	if( $idEvento == 0 )
	{
		$idEvento = $_GET['idEvento'];
	}
	$chave = $_POST['chave'];
	
	require ("DB_mysql.php");
	$conexao = new DB_mysql ;
	$conexao->conectarConf();
	require ("trataData.php");
	$objD = new trataData;
	require ("trataArquivo.php");
	$objT = new trataArquivo;
	
	if($chave == 1){
	
			$tamanhoPreview1 = 800;
			
			// Prepara a variсvel do arquivo
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
					// Criaчуo da Preview 1
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
	
	}
	else{
		if($chave==2){
			// Prepara a variсvel do arquivo
			$arquivo = isset($_FILES["arquivo"]) ? $_FILES["arquivo"] : FALSE;	
			$tmp_name = $_FILES["arquivo"]["tmp_name"];
			
			$nomearquivo = $_FILES["arquivo"]["name"];
			$tipoarquivo = $_FILES["arquivo"]["type"];
			$tamanho_arquivo = $_FILES["arquivo"]["size"];
		
			$path = $objT->getPath(18)."$idEvento/";
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
				$path = $objT->getPath(18)."$idEvento/".$nomearquivo;
				copy($tmp_name,$path);
		
				$query = "UPDATE evento set nomearquivoautorizacao='$nomearquivo',tipoautorizacao='$tipoarquivo',tamanhoautorizacao='$tamanho_arquivo' where id=$idEvento";
				$conexao->executaQuery($query);
			}
			
		}else{
			if($chave==3){
				// Prepara a variсvel do arquivo
				$arquivo = isset($_FILES["arquivo"]) ? $_FILES["arquivo"] : FALSE;	
				$tmp_name = $_FILES["arquivo"]["tmp_name"];
				
				$nomearquivo = $_FILES["arquivo"]["name"];
				$tipoarquivo = $_FILES["arquivo"]["type"];
				$tamanho_arquivo = $_FILES["arquivo"]["size"];
			
				$path = $objT->getPath(15)."$idEvento/";
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
					$path = $objT->getPath(15)."$idEvento/".$nomearquivo;
					copy($tmp_name,$path);
			
					$query = "UPDATE evento set nomearquivoordem='$nomearquivo',tipoordem='$tipoarquivo',tamanhoordem='$tamanho_arquivo' where id=$idEvento";
					$conexao->executaQuery($query);
				}
			
			}
		}
	}
	header ("Location:../adm/busca_evento.php");
?>