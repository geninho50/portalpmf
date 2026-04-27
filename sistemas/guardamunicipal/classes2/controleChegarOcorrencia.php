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

	$hora_atual = date("H:i:s");

	if( $idOcorrencia > 0 )
	{
		// alterar dados
		$query = "UPDATE ocorrencia set hora_chegada1='$hora_atual' where id=$idOcorrencia";
		$conexao->executaQuery($query);	
		echo "<script>alert('J10 com sucesso!');</script>";                       
		echo "<script> window.location.href = '../controle/administrar_ocorrencia.php' </script>";	
	}
	else
	{
		echo "<script>alert('Problema no cadastro!');</script>";                       
		echo "<script> window.location.href = '../controle/administrar_ocorrencia.php' </script>";
		
		
		/*// Pega o ultimo id inserido e atualiza a variavel $idAnotacao
		$query = "select MAX(id) as id from recado_agente";
		$resultado = mysql_query($query) or die ("Não foi possível realizar a consulta ao banco de dados");	
		while ($linha=mysql_fetch_array($resultado))
		{
			$idAnotacao = $linha['id'];
		}*/
	}
?>