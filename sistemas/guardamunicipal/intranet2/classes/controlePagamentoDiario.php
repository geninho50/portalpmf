<?php
	
   $data_atual = date("Y-m-d");
   $hora_atual = date("H:i:s");
	
	$matricula = 0;
	$matricula = (int)$_POST['xmatricula'];
	if( $matricula == 0 )
	{
		$matricula = (int)$_GET['matricula'];
	}
	$numeropagamento = (int)$_POST['numeropagamento'];
	$matricularetirada = (int)$_POST['xmatriculaguarda'];
	$matriculagm4retirada = (int)$_POST['xmatriculagm4'];
	$material = $_POST['xmaterial'];
	$qtdretirado = (int)$_POST['qtd'];

	require ("DB_mysql.php");
	$conexao = new DB_mysql ;
	$conexao->conectarConf();

	// incluir
		$query = "insert into pagamentodiario (numpagamento,matricularetirada,matriculagm4retirada,material,qtdretirado,dataretirada,horaretirada,status) values('$numeropagamento','$matricularetirada','$matriculagm4retirada','$material','$qtdretirado','$data_atual','$hora_atual',0)";
		$conexao->executaQuery($query);
		
		echo "<script> window.location.href = '../controle/cadastro_pagamento_diario.php?xmatricula=$matricularetirada&numeropagamento=$numeropagamento' </script>";
?>