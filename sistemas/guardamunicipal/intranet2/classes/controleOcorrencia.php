<?php
	$idOcorrencia = 0;
	$idOcorrencia = (int)$_POST['idOcorrencia'];
	if( $idOcorrencia == 0 )
	{
		$idOcorrencia = (int)$_GET['idOcorrencia'];

	}
	$guarda = $_POST['guarda'];
	$telefone = $_POST['xtelefone'];
	$gerado = $_POST['gerado'];
	$comunicante = $_POST['comunicante'];
	$rua = $_POST['xrua'];
	$rua = strtr(strtoupper($rua),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß"); 
	$numero = $_POST['numero'];
	//$bairro = $_POST['bairro'];
	$referencia = $_POST['referencia'];
	$descricao = $_POST['descricao'];
	$descricaoT = strtr(strtoupper($descricao),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß"); 
	$tipificacao = $_POST['xtipificacao'];
	$infracao = $_POST['xait'];
	//$data_cadastro = $_POST['data_cadastro'];
	//$horacadastro = $_POST['hora_cadastro'];

	require ("DB_mysql.php");
	$conexao = new DB_mysql ;
	$conexao->conectarConf();
	require ("trataData.php");
	$objD = new trataData;
	
	//Pega a data atual
    $data_atual = date("Y-m-d");
	$hora_atual = date("H:i:s");
	
	//verefica se a rua está cadastrada
	$queryS = "select * from endereco where rua='$rua'";
	$resultadoS = mysql_query($queryS) or die ("Não foi possível realizar a consulta ao banco de dados");
	$linhaS=mysql_fetch_array($resultadoS);	
	if($linhaS)
	{
		$setor = $linhaS['setor'];
		$idbairro = $linhaS['idbairro'];
		
		//busca na tabela o bairro para realizar o cadastro do bairro
		$queryB = "select * from bairro where id='$idbairro'";
		$resultadoB = mysql_query($queryB) or die ("Não foi possível realizar a consulta ao banco de dados");	
		$linhaB=mysql_fetch_array($resultadoB);
		if($linhaB)
		{
			$bairro = $linhaB['nome'];
		}
		
		//gerado por solicitante
		if($gerado==1){
			
		$query = "insert into ocorrencia (guarda,gerado,telefone,comunicante,rua,numero,bairro,setor,referencia,descricao_ocorrencia,tipificacao,infracao,data_cadastro,hora_cadastro,status,chave) values ('$guarda','$gerado','$telefone','$comunicante','$rua','$numero','$bairro',$setor,'$referencia','$descricaoT','$tipificacao','$infracao','$data_atual','$hora_atual',0,1)";
		$conexao->executaQuery($query);
		
		// Pega o ultimo id inserido e atualiza a variavel $idOcorrencia
		$query = "select MAX(id) as id from ocorrencia";
		$resultado = mysql_query($query) or die ("Não foi possível realizar a consulta ao banco de dados");	
		while ($linha=mysql_fetch_array($resultado))
		{
			$idOcorrencia = $linha['id'];
		}
		
		$queryOA = "insert into ocorrencia_atendida (hora_cadastro,data_cadastro,gerado,valor,idocorrencia)values('$hora_atual','$data_atual',1,1,$idOcorrencia)";
		$conexao->executaQuery($queryOA);
		
		$queryA = "insert into atividade (hora,data,dados)values('$hora_atual','$data_atual','Ocorrencia $idOcorrencia inserida no sistema pelo GM $guarda')";
		$conexao->executaQuery($queryA);
		
		echo "<script>alert('Ocorrencia inserida com sucesso!');</script>";                       
		echo "<script> window.location.href = '../controle/administrar_ocorrencia.php' </script>";
		
		}else{
			//gerado por guarda
			$query = "insert into ocorrencia (guarda,gerado,telefone,comunicante,rua,numero,bairro,setor,referencia,descricao_ocorrencia,tipificacao,infracao,data_cadastro,hora_cadastro,hora_empenho,hora_chegada,status,chave) values ('$guarda','$gerado','$telefone','$comunicante','$rua','$numero','$bairro',$setor,'$referencia','$descricaoT','$tipificacao','$infracao','$data_atual','$hora_atual','$hora_atual','$hora_atual',1,1)";
			$conexao->executaQuery($query);
				
			$queryG = "UPDATE guarnicao set status=2 where id='$gerado'";
			$conexao->executaQuery($queryG);
			
			$query = "select MAX(id) as id from ocorrencia";
			$resultado = mysql_query($query) or die ("Não foi possível realizar a consulta ao banco de dados");	
			while ($linha=mysql_fetch_array($resultado))
			{
				$idOcorrencia = $linha['id'];
			}
			
			$queryOA = "insert into ocorrencia_atendida (hora_cadastro,data_cadastro,valor,gerado,visivel,idguarnicao,idocorrencia)values('$hora_atual','$data_atual',1,2,2,$gerado,$idOcorrencia)";
			$conexao->executaQuery($queryOA);
			
			//$queryI = "insert into ocorrencia_guarnicao (idocorrencia,idguarnicao,data,hora)values('$idOcorrencia','$gerado','$data_atual','$hora_atual')";
			//$conexao->executaQuery($queryI);	
				
			$queryA = "insert into atividade (hora,data,dados)values('$hora_atual','$data_atual','Ocorrencia $idOcorrencia empenhada a guarnicao $gerado')";
			$conexao->executaQuery($queryA);
				
			$queryA = "insert into atividade (hora,data,dados)values('$hora_atual','$data_atual','Ocorrencia $idOcorrencia inserida no sistema pelo GM $guarda')";
			$conexao->executaQuery($queryA);
				
			echo "<script>alert('Ocorrencia inserida com sucesso!');</script>";                       
			echo "<script> window.location.href = '../controle/administrar_ocorrencia.php' </script>";
				
		}
		
	}
	//se não houver rua cadastrada
	else{
		echo "<script>alert('Rua não cadastrada, efetue seu cadastro!');</script>";                       
		echo "<script> window.location.href = '../controle/cadastro_rua.php?rua=$rua' </script>";
	}
	
	
	

?>