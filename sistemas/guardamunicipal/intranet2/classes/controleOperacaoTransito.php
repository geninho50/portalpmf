<?php
	$idOcorrencia = 0;
	$idOcorrencia = (int)$_POST['idOcorrencia'];
	if( $idOcorrencia == 0 )
	{
		$idOcorrencia = (int)$_GET['idOcorrencia'];

	}
	$guarda = $_POST['guarda'];
	$responsavel = $_POST['xGM1_1'];
	$rua = $_POST['xrua'];
	$numero = $_POST['numero'];
	$referencia = $_POST['referencia'];
	$tipificacao = $_POST['xtipificacao'];
	$tamanho = strlen($descricao_ocorrrencia);

	require ("DB_mysql.php");
	$conexao = new DB_mysql ;
	$conexao->conectarConf();
	require ("trataData.php");
	$objD = new trataData;
	
	$queryS = "select * from endereco where rua='$rua'";
	$resultadoS = mysql_query($queryS) or die ("Não foi possível realizar a consulta ao banco de dados");
	$linhaS=mysql_fetch_array($resultadoS);	
	if($linhaS)
	{
		$setor = $linhaS['setor'];
		$idbairro = $linhaS['idbairro'];
		
		$queryB = "select * from bairro where id='$idbairro'";
		$resultadoB = mysql_query($queryB) or die ("Não foi possível realizar a consulta ao banco de dados");	
		$linhaB=mysql_fetch_array($resultadoB);
		if($linhaB)
		{
			$bairro = $linhaB['nome'];
		}
	}
	else{
		echo "<script>alert('Rua não cadastrada, efetue seu cadastro!');</script>";                       
		echo "<script> window.location.href = '../controle/cadastro_rua.php?rua=$rua' </script>";
	}
	
	//Pega a data atual
    $data_atual = date("Y-m-d");
	$hora_atual = date("H:i:s");
	
	if( $tamanho > 0 && $idOcorrencia > 0 )
	{
		// alterar dados
		$query = "UPDATE ocorrencia set texto='$texto' where id=$idOcorrencia";
		$conexao->executaQuery($query);	
		
		$queryA = "insert into atividade (hora,data,dados)values('$hora_atual','$data_atual','Informacao $texto adicionado a ocorrencia $idOcorrencia')";
		$conexao->executaQuery($queryA);
		
		echo "<script>alert('Dados da ocorrencia atualizado com sucesso!');</script>";                       
		echo "<script> window.location.href = '../controle/administrar_ocorrencia.php' </script>";	
	}
	else
	{
		// incluir
		$query = "insert into ocorrencia (guarda,responsavel,rua,numero,bairro,referencia,tipificacao,data_cadastro,hora_cadastro,status,chave) values ('$guarda','$responsavel','$rua','$numero','$bairro','$referencia','$tipificacao','$data_atual','$hora_atual',1,2)";
		$conexao->executaQuery($query);
		echo "<script>alert('Ocorrencia inserida com sucesso!');</script>";                       
		echo "<script> window.location.href = '../controle/administrar_ocorrencia.php' </script>";
		
		
		// Pega o ultimo id inserido e atualiza a variavel $idAnotacao
		$query = "select MAX(id) as id from ocorrencia";
		$resultado = mysql_query($query) or die ("Não foi possível realizar a consulta ao banco de dados");	
		while ($linha=mysql_fetch_array($resultado))
		{
			$idOcorrencia = $linha['id'];
		}
		
		$queryA = "insert into atividade (hora,data,dados)values('$hora_atual','$data_atual','Ocorrencia $idOcorrencia inserida no sistema pelo GM $guarda')";
		$conexao->executaQuery($queryA);
	}
?>