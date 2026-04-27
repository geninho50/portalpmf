<?php
	$idEvento = 0;
	$idEvento = (int)$_POST['idEvento'];
	if( $idEvento == 0 )
	{
		$idEvento = (int)$_GET['idEvento'];
	}
	
	$tipo = $_POST['tipo'];
	$nome = $_POST['xnome'];
	$numdocumento = $_POST['numdocumento'];
	$data = $_POST['xdataini'];
	$hora = $_POST['hora'];
	$solicitante = $_POST['xsolicitante'];
	$telefone = $_POST['telefone'];
	$rua = $_POST['xrua'];
	$bairro = $_POST['xbairro'];
	$descricao = $_POST['descricao'];
	$descricaoT = strtr(strtoupper($descricao),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß"); 
	$tamanho2 = strlen($nome);
	
	$horainicial = $_POST['xhorainicial'];
	$horafinal = $_POST['xhorafinal'];
	$co = $_POST['xchefe'];
	$qtdguarda = $_POST['xqtdguardas'];
	$tipoescala = $_POST['xtipoescala'];
	$hora100 = $_POST['xhora100'];
	$hora200 = $_POST['xhora200'];
	$material = $_POST['xmaterial'];
	$materialR = strtr(strtoupper($material),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß"); 
	$descricaofinal = $_POST['xdescricaofinal'];
	$descricaofinalR = strtr(strtoupper($descricaofinal),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß"); 
	$tamanho = strlen($co);

	require ("DB_mysql.php");
	$conexao = new DB_mysql ;
	$conexao->conectarConf();
	require ("trataData.php");
	$objD = new trataData;
	require ("trataArquivo.php");
	$objT = new trataArquivo;
	
	$tamanhoPreview1 = 800;
	
	if( $tamanho2 > 0 && $idEvento > 0 )
	{
		// alterar dados
		$query = "UPDATE evento set tipo='$tipo', nome='$nome',numdocumento='$numdocumento',data='$data',hora='$hora',solicitante='$solicitante',telefone='$telefone',rua='$rua',bairro='$bairro',descricao='$descricaoT' where id=$idEvento";
		$conexao->executaQuery($query);		
		echo "<script>alert('Atualizado com sucesso!');</script>";                       
		echo "<script> window.location.href = '../controle/adm_evento.php' </script>";	
	}
	else{
		if($tamanho > 0 && $idEvento > 0 )
		{
			// alterar dados
			$query = "UPDATE evento set status=2,horainicial='$horainicial',horafinal='$horafinal',co='$co',qtdguarda='$qtdguarda',tipoescala='$tipoescala',hora100='$hora100',hora200='$hora200',material='$materialR',relatoriofinal='$descricaofinalR' where id=$idEvento";
			$conexao->executaQuery($query);		
			echo "<script>alert('Atualizado com sucesso!');</script>";                       
			echo "<script> window.location.href = '../controle/adm_evento.php' </script>";	
		}
		else{
			if( $idEvento > 0 )
			{
				// excluir envento
				$query = "delete from evento where id=$idEvento";
				$conexao->executaQuery($query);
				
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
				echo "<script>alert('Deletado com sucesso!');</script>";                       
				echo "<script> window.location.href = '../controle/adm_evento.php' </script>";
			}
			else
			{
				// incluir
				$data_texto = "";
				$data_texto = $objD->getData();
				$query = "insert into evento (tipo,nome,numdocumento,data,hora,solicitante,telefone,rua,bairro,descricao,status) values ('$tipo','$nome','$numdocumento','$data','$hora','$solicitante','$telefone','$rua','$bairro','$descricaoT',0)";
				$conexao->executaQuery($query);
				
				echo "<script>alert('Inserido com sucesso!');</script>";                       
				echo "<script> window.location.href = '../controle/adm_evento.php' </script>";
			}
		}
	}
?>