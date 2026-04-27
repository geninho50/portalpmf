<?php

class trataArquivo
{ 
	// Exclui todos arquivo que estiverem numa determinada pasta cujo path $dirname
	function rmdir_rf($dirname)
	{
		if ($dirHandle = opendir($dirname))
		{
			chdir($dirname);
			while ($file = readdir($dirHandle))
			{
				if ($file == '.' || $file == '..') continue;
				if (is_dir($file)) rmdir_rf($file);
				else unlink($file);
			}
			chdir('..');
			//rmdir($dirname);
			//mkdir ($dirname, 0777);
			closedir($dirHandle);
		}
	}

	function retornaArquivo($diretorio)
	{
		$nomearquivo = "";
		if (is_dir($diretorio))
		{	
			// abre o diretório
			$ponteiro  = opendir($diretorio);
			// monta os vetores com os itens encontrados na pasta
			while ($nome_itens = readdir($ponteiro))
			{
				$nomearquivo = $nome_itens;
			}
		}
		return $nomearquivo;
	}

	function arquivoExiste($diretorio)
	{
		$ver = false;
		if( file_exists($diretorio) )
		{
			$ver = true;
		}
		return $ver;
	}
	
	function closeVar($var)
	{
		if( !empty($var))
		{
			unset($var);
		}
	}

	function byteConverter($size, $type='B')
	{
		switch($type)
		{
			case 'b':
			case 'bits':
				return round($size*8, 0).' '.$type;
			case 'B':
			case 'bytes':
				return round($size, 0).' '.$type;
			case 'KB':
			case 'kilobytes':
				return round($size/1024, 0).' '.$type;
			case 'MB':
			case 'megabytes':
				return round($size/(1048576), 1).' '.$type;
			case 'GB':
			case 'gigabytes':
				return round($size/(1073741824), 3).' '.$type;
			case 'TB':
			case 'terabytes':
				return round($size/(1099511627776), 6).' '.$type;
			default;
		}
		return $size.' bytes';
	}

	function converteUnidade($filesize,$opcao)
	{
		$tamanho = 0;
		if( $opcao == 1 ) 
		{
			$tamanho = $this->byteConverter($filesize, 'bits');
		}
		else
		if( $opcao == 2 ) 
		{
			$tamanho = $this->
			byteConverter($filesize, 'bytes');
		}
		else
		if( $opcao == 3 ) 
		{
			$tamanho = $this->byteConverter($filesize, 'kilobytes');
		}
		else
		if( $opcao == 4 ) 
		{
			$tamanho = $this->byteConverter($filesize, 'megabytes');
		}
		else
		if( $opcao == 5 ) 
		{
			$tamanho = $this->byteConverter($filesize, 'gigabytes');
		}
		else
		if( $opcao == 6 ) 
		{
			$tamanho = $this->byteConverter($filesize, 'terabytes');
		}
		return $tamanho;
	}

	// Configuracão Imagem Download & Mural
	function getImagemDownloadMural($tipo)
	{
		$imagem = "";
		if( $tipo == "application/msword" || $tipo == "application/vnd.openxmlformats-officedocument.wordprocessingml.document" ) 
		{
			$imagem = "formatos/doc.gif";
		}
		else
		if( $tipo == "application/pdf" ) 
		{
			$imagem = "formatos/pdf.jpg";
		}
		else
		if( $tipo == "application/vnd.ms-powerpoint" || $tipo == "application/vnd.openxmlformats-officedocument.presentationml.presentation" ) 
		{
			$imagem = "formatos/ppt.jpg";
		}
		else
		if( $tipo == "image/jpeg" || $tipo == "image/gif" ) 
		{
			$imagem = "formatos/imagem.jpg";
		}
		else
		if( $tipo == "text/plain" ) 
		{
			$imagem = "formatos/txt.gif";
		}
		else
		if( $tipo == "application/x-zip-compressed" ) 
		{
			$imagem = "formatos/zip.gif";
		}
		else
		if( $tipo == "application/x-rar-compressed" ) 
		{
			$imagem = "formatos/rar.gif";
		}
		else
		if( $tipo == "text/htm" || $tipo == "text/html" ) 
		{
			$imagem = "formatos/htm_html.gif";
		}
		else
		if( $tipo == "text/sql" ) 
		{
			$imagem = "formatos/sql.gif";
		}
		else
		if( $tipo == "text/xml" ) 
		{
			$imagem = "formatos/xml.gif";
		}
		else
		if( $tipo == "text/bat" ) 
		{
			$imagem = "formatos/bat.gif";
		}
		else
		if( $tipo == "application/x-shockwave-flash" ) 
		{
			$imagem = "formatos/swf.jpg";
		}
		else
		if( $tipo == "application/vnd.ms-excel" || $tipo == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" ) 
		{
			$imagem = "formatos/excel.jpg";
		}
		else
		if( $tipo == "text/css" ) 
		{
			$imagem = "formatos/css.gif";
		}
		else
		if( $tipo == "text/php" ) 
		{
			$imagem = "formatos/php.gif";
		}
		else
		if( $tipo == "text/jsp" || $tipo == "text/java" ) 
		{
			$imagem = "formatos/java_jsp.jpg";
		}
		else
		{
			$imagem = "links.gif";
		}
		return $imagem;
	}

	function getPath($opcao)
	{
		$path = "";
		//$principal = "C:/Apache/htdocs/intranet";
		
		$principal = "/home/www/sistemas/guardamunicipal";
		if( $opcao == 1 ) 
		{
			$path = $principal."/controle/fotos/noticia/";			
		}
		else
		if( $opcao == 2 ) 
		{
			$path = $principal."/controle/fotos/monografia/";
		}
		else
		if( $opcao == 3 ) 
		{
			$path = $principal."/controle/fotos/extras/";
		}
		else
		if( $opcao == 4 ) 
		{
			$path = $principal."/controle/fotos/download/";
		}
		else
		if( $opcao == 5 ) 
		{
			$path = $principal."/controle/fotos/noticiaimagem/";
		}
		else
		if( $opcao == 6 ) 
		{
			$path = $principal."/controle/fotos/videoimagem/";
		}
		else
		if( $opcao == 7 ) 
		{
			$path = $principal."/controle/fotos/anuncioimagem/";
		}
		else
		if( $opcao == 8 ) 
		{
			$path = $principal."/controle/galeria_fotos/";
		}
		else
		if( $opcao == 9 ) 
		{
			$path = $principal."/controle/fotos/outro/";
		}
		else
		if( $opcao == 10 ) 
		{
			$path = $principal."/controle/fotos/esportes/";
   		}
		else
		if( $opcao == 11 ) 
		{
			$path = $principal."/controle/fotos/anunciantes/";
		}
		else
		if( $opcao == 12 ) 
		{
			$path = $principal."/controle/fotos/anunciantesanuncio/";
		}
		else
		if( $opcao == 13 ) 
		{
			$path = $principal."/controle/fotos/enquete/";
		}
		else
		if( $opcao == 14 ) 
		{
			$path = $principal."/controle/fotos/comentaristas/";
		}
		else
		if( $opcao == 15 ) 
		{
			$path = $principal."/controle/fotos/ordemservico/";
		}
		else
		if( $opcao == 16 ) 
		{
			$path = $principal."/controle/fotos/eventogratis/";
		}
		else
		if( $opcao == 17 ) 
		{
			$path = $principal."/controle/fotos/biblioteca/";
		}
		else
		if( $opcao == 18 ) 
		{
			$path = $principal."/controle/fotos/autorizacao/";
		}
		else
		if( $opcao == 19 ) 
		{
			$path = $principal."/controle/fotos/funcionario/";
		}
		return $path;
	}
}