<?php
	
  	require ("DB_mysql.php");
	$obj = new DB_mysql;
	$conexao = $obj->conectarConf();
	require ("trataData.php");
	$objD = new trataData;
  
   $data_atual = date("Y-m-d");
    $hora_atual = date("H:i:s");
	
	$matricula = (int)$_POST['xmatriculaguarda'];
	$senha = $_POST['xsenha'];	
	$numeropagamento = (int)$_POST['numeropagamento'];	
	$senhaCorreta = md5($senha);
			
	$query = "SELECT * FROM guarda_gmf where matricula=$matricula";
	$resultadoC = $obj->executaQuery($query);	
	if($linha = mysql_fetch_array($resultadoC))
	{
		$senhaTemp = $linha['senha'];
	}
	if($senhaCorreta == $senhaTemp)
	{
		$query = "update pagamentodiario set status=1 where numpagamento=$numeropagamento";
		$obj->executaQuery($query);
		
		echo "<script>alert('Confirmacao efetuada com sucesso!');</script>"; 
		echo "<script> window.location.href = '../controle/pre_pagamento_diario.php' </script>";
	}
?>