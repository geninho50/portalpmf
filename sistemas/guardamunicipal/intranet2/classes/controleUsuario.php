<?php
	$matricula = 0;
	$matricula = $_GET['matricula'];
	if( $matricula == 0 )
	{
		$matricula = $_POST['matricula'];
	}
	$sexo = $_POST['ysexo'];
	$cpf = $_POST['xcpf'];
	$rg = $_POST['xrg'];
	$cathab = $_POST['xcathab'];
	$datavenchab = $_POST['xdatavenchab'];
	$datanasc = $_POST['xdatanasc'];
	$dataadmim = $_POST['xdataadmim'];
	$numseriefunc = $_POST['xnumseriefunc'];
	$numsinarm = $_POST['xnumsinarm'];
	$rua = $_POST['rua'];
	$complemento = $_POST['complemento'];
	$numero = $_POST['numero'];
	$bairro = $_POST['bairro'];
	$cep = $_POST['cep'];
	$referencia = $_POST['referencia'];
	$estado = $_POST['estado'];
	$cidade = $_POST['cidade'];
	$email = $_POST['xemail'];
	$foneresid = $_POST['foneresid'];
	$fonecel1 = $_POST['xfonecel1'];
	$fonecel2 = $_POST['fonecel2'];
	$nomepai = $_POST['nomepai'];
	$nomemae = $_POST['nomemae'];
	$estadocivil = $_POST['estadocivil'];
	$nomeconjuge = $_POST['nomeconjuge'];
	$filho1 = $_POST['filho1'];
	$filho2 = $_POST['filho2'];
	$filho3 = $_POST['filho3'];
	$filho4 = $_POST['filho4'];
	$filho5 = $_POST['filho5'];
	$data1 = $_POST['datanascfilho1'];
	$data2 = $_POST['datanascfilho2'];
	$data3 = $_POST['datanascfilho3'];
	$data4 = $_POST['datanascfilho4'];
	$data5 = $_POST['datanascfilho5'];
	

	
	require ("DB_mysql.php");	
	require ("trataArquivo.php");
	require ("trataData.php");
	$conexao = new DB_mysql;
	$conexao->conectarConf();
	$objT = new trataArquivo;
	$objD = new trataData;
	
	// Variáveis com os tamanhos das previews
	$tamanhoPreview1 = 120;

	$tamanho = strlen($nome);
	if( $matricula > 0 )
	{
		// alterar
		$query = "UPDATE guarda_gmf set sexo='$sexo',cpf='$cpf',rg='$rg',cathab='$cathab',datavenchab='$datavenchab',datanasc='$datanasc',dataadmim='$dataadmim',numseriefunc='$numseriefunc',numsinarm='$numsinarm',email='$email',foneresid='$foneresid',fonecel1='$fonecel1',fonecel2='$fonecel2',nomepai='$nomepai',nomemae='$nomemae',estadocivil='$estadocivil',nomeconj='$nomeconjuge' where matricula=$matricula";		
		$conexao->executaQuery($query);
		
		$queryC = "select * from endereco where matricula='$matricula'";
		$resultadoC = mysql_query($queryC) or die ("Não foi possível realizar a consulta ao banco de dados endereço");	
		$linhaC = mysql_fetch_array($resultadoC);
		if($linhaC){		
			$queryC = "UPDATE endereco set rua='$rua',complemento='$complemento',numero='$numero',cep='$cep',bairro='$bairro',referencia='$referencia',estado='$estado',cidade='$cidade' where matricula=$matricula";
			$conexao->executaQuery($queryC);
		}else{
			$queryE = "INSERT INTO endereco (matricula,rua,complemento,numero,cep,bairro,estado,cidade) values ('$matricula','$rua','$complemento','$numero','$cep','$bairro','$estado','$cidade')";		
			$conexao->executaQuery($queryE);
		}

		$queryF = "select * from filhos where matricula='$matricula'";
		$resultadoF = mysql_query($queryF) or die ("Não foi possível realizar a consulta ao banco de dados filhos");	
		$linhaF = mysql_fetch_array($resultadoF);
		if($linhaF){		
			$queryF = "UPDATE filhos set filho1='$filho1',data1='$data1',filho2='$filho2',data2='$data2',filho3='$filho3',data3='$data3',filho4='$filho4',data4='$data4',filho5='$filho5',data5='$data5' where matricula=$matricula";
			$conexao->executaQuery($queryF);
		}else{
			$queryD = "INSERT INTO filhos (matricula,filho1,filho2,filho3,filho4,filho5,data1,data2,data3,data4,data5) values ('$matricula','$filho1','$filho2','$filho3','$filho4','$filho5','$data1','$data2','$data3','$data4','$data5')";		
			$conexao->executaQuery($queryD);
		}
		
		// Pega o ultimo id inserido e atualiza a variavel $idNoticia
		$queryI = "select matricula from guarda_gmf where matricula='$matricula'";
		$resultadoI = mysql_query($queryI) or die ("Não foi possível realizar a consulta ao banco de dados usuario");	
		while ($linhaI=mysql_fetch_array($resultadoI))
		{
			$matricula = $linhaI['matricula'];
			$idFuncionario = $linhaI['id'];
		}
	}
	
	// Upload de IMAGEM
	
	// Prepara a variável do arquivo
	$arquivo = isset($_FILES["arquivo"]) ? $_FILES["arquivo"] : FALSE;	
	$tmp_name = $_FILES["arquivo"]["tmp_name"];
	$nome = $_FILES["arquivo"]["name"];
	$path = $objT->getPath(19)."$matricula/";
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
		$path = $objT->getPath(19)."$matricula/$matricula".".jpg";
		copy($tmp_name,$path);

		
		// Tratamento de IMAGEM [ Cria as previews para 120, 270 e 800 px de comprimento ]
		try 
		{
			require ("Resize.php");
			$tmp = getimagesize($path);
            $width  = $tmp[0];
            $height  = $tmp[1];			
			// Criação da Preview 1
			$path1 = $objT->getPath(19)."$matricula/$matricula"."_1.jpg";
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
	header ("Location:../controle/cadastro_usuario_recado.php?matricula=$matricula");
?>