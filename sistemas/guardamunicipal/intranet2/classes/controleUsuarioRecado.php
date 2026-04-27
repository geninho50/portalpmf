<?php
	$matricula = 0;
	$matricula = $_GET['matricula'];
	if( $matricula == 0 )
	{
		$matricula = $_POST['matricula'];
	}


	$nomerecado = $_POST['xnomerecado'];
	$nomeemergencia = $_POST['xnomeemergencia'];
	$fonerecado = $_POST['xfonerecado'];
	$foneemergencia = $_POST['xfoneemergencia'];
	$parentescorecado = $_POST['xparentescorecado'];
	$parentescoemergencia = $_POST['xparentescoemergencia'];
	
	require ("DB_mysql.php");	
	require ("trataArquivo.php");
	require ("trataData.php");
	$conexao = new DB_mysql;
	$conexao->conectarConf();
	$objT = new trataArquivo;
	$objD = new trataData;

	if( $matricula > 0 )
	{
		
		$queryC = "select * from recado_usuario where matricula='$matricula'";
		$resultadoC = mysql_query($queryC) or die ("Não foi possível realizar a consulta ao banco de dados endereço");	
		$linhaC = mysql_fetch_array($resultadoC);
		if($linhaC){		
			$queryC = "UPDATE recado_usuario set nomerecado='$nomerecado',nomeemergencia='$nomeemergencia',fonerecado='$fonerecado',foneemergencia='$foneemergencia',parentescorecado='$parentescorecado',parentescoemergencia='$parentescoemergencia' where matricula=$matricula";
			$conexao->executaQuery($queryC);
		}else{
			$queryE = "INSERT INTO recado_usuario (matricula,nomerecado,nomeemergencia,fonerecado,foneemergencia,parentescorecado,parentescoemergencia) values ('$matricula','$nomerecado','$nomeemergencia','$fonerecado','$foneemergencia','$parentescorecado','$parentescoemergencia')";		
			$conexao->executaQuery($queryE);
		}
	}
	
	// Redireciona

	header ("Location:../controle/cadastro_usuario_saude.php?matricula=$matricula");
?>