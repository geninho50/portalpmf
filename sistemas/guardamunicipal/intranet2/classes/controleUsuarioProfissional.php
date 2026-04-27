<?php
	$matricula = 0;
	$matricula = $_GET['matricula'];
	$tipo = $_GET['tipo'];
	if( $matricula == 0 )
	{
		$matricula = $_POST['matricula'];
		$tipo = $_POST['tipo'];
		$idconhecimento = $_POST['idconhecimento'];
	}

	$conhecimento = $_POST['conhecimento'];
	$experiencia = $_POST['experiencia'];
	$empresa = $_POST['empresa'];
	$tempo = $_POST['tempo'];
	
	require ("DB_mysql.php");	
	require ("trataArquivo.php");
	require ("trataData.php");
	$conexao = new DB_mysql;
	$conexao->conectarConf();
	$objD = new trataData;
	
	if($tipo == 'conhecimento'){
		$queryE = "INSERT INTO conhecimento (matricula,conhecimento) values ('$matricula','$conhecimento')";		
		$conexao->executaQuery($queryE);
		header ("Location:../controle/profisional_conhecimento_especifico.php?matricula=$matricula");
	}else{
		if($idconhecimento > 0 && $tipo=='conhecimento'){
			$query = "DELETE FROM conhecimento where id=$idconhecimento";
			$conexao->executaQuery($query);
			header ("Location:../controle/profissional_conhecimento_especifico.php?matricula=$matricula");
		}
	}
	
	if($tipo == 'experiencia'){
		$queryE = "INSERT INTO experiencia (matricula,experiencia,empresa,tempo) values ('$matricula','$experiencia','$empresa',$tempo)";		
		$conexao->executaQuery($queryE);
		header ("Location:../controle/profissional_experiencia.php?matricula=$matricula");
	}else{
		if($idconhecimento > 0 && $tipo=='experiencia'){
			$query = "DELETE FROM experiencia where id=$idexperiencia";
			$conexao->executaQuery($query);
			header ("Location:../controle/profissional_experiencia.php?matricula=$matricula");
		}
	}
?>