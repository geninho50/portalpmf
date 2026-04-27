<?php
	$idOcorrencia = 0;
	$idOcorrencia = (int)$_POST['idOcorrencia'];
	if( $idOcorrencia == 0 )
	{
		$idOcorrencia = (int)$_GET['idOcorrencia'];
	}

	require ("DB_mysql.php");
	$conexao = new DB_mysql ;
	$conexao->conectarConf();
	require ("trataData.php");
	$objD = new trataData;

	$data_atual = date("Y-m-d");
	$hora_atual = date("H:i:s");
	
	$sqlOG = "SELECT * FROM ocorrencia_guarnicao_j10 where idocorrencia=$idOcorrencia";
	$resultadoOG = $conexao->executaQuery($sqlOG);
	while( $linhaOG = mysql_fetch_array($resultadoOG))
	{
		$idguarnicao = $linhaOG["idguarnicao"];
	}
	/*$sqlG = "SELECT * FROM guarnicao where id=$idguarnicao";
	$resultadoG = $conexao->executaQuery($sqlG);
	while( $linhaG = mysql_fetch_array($resultadoG))
	{
		$vtr = $linhaG["vtr"];
	}*/
	

	if( $idOcorrencia > 0 )
	{
		// alterar dados
		$query = "UPDATE ocorrencia set hora_chegada='$hora_atual' where id=$idOcorrencia";
		$conexao->executaQuery($query);
		
		$queryA = "insert into atividade (hora,data,dados)values('$hora_atual','$data_atual','Guarnicao $idguarnicao J10 na Ocorrencia $idOcorrencia')";
		$conexao->executaQuery($queryA);
			
		echo "<script>alert('J10 com sucesso!');</script>";                       
		echo "<script> window.location.href = '../controle/controle_ocorrencias_andamento.php' </script>";	
	}
	else
	{
		echo "<script>alert('Problema no cadastro!');</script>";                       
	}
?>