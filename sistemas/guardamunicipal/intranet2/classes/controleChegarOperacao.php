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

	if( $idOcorrencia > 0 )
	{
		// alterar dados
		$query = "UPDATE ocorrencia set hora_chegada='$hora_atual' where id=$idOcorrencia";
		$conexao->executaQuery($query);
		
		$queryA = "insert into atividade (hora,data,dados)values('$hora_atual','$data_atual','J10 na Ocorrencia $idOcorrencia')";
		$conexao->executaQuery($queryA);
			
		echo "<script>alert('J10 com sucesso!');</script>";                       
		echo "<script> window.location.href = '../controle/administrar_ocorrencia.php' </script>";	
	}
	else
	{
		echo "<script>alert('Problema no cadastro!');</script>";                       
	}
?>