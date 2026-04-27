<?php
	$matricula = 0;
	$matricula = $_GET['matricula'];
	$tipo = $_GET['tipo'];
	if( $matricula == 0 )
	{
		$matricula = $_POST['matricula'];
		$tipo = $_POST['tipo'];
		$idescolaridade = $_POST['idescolaridade'];
	}

	$grauinstrucao = $_POST['ygrauinstrucao'];
	$cursograduacao = $_POST['cursograduacao'];
	$ano = $_POST['ano'];
	$instensino = $_POST['instensino'];
	$cursoposgraduacao = $_POST['cursoposgraduacao'];
	$numhoras = $_POST['numhoras'];
	$nomecursos = $_POST['nomecursos'];
	
	require ("DB_mysql.php");	
	require ("trataArquivo.php");
	require ("trataData.php");
	$conexao = new DB_mysql;
	$conexao->conectarConf();
	$objD = new trataData;

	if($tipo == 'graduacao'){
		$queryE = "INSERT INTO graduacao (matricula,grauinstrucao,cursograducao,anoconclusao,instensino) values ('$matricula','$grauinstrucao','$cursograduacao',$ano,'$instensino')";		
		$conexao->executaQuery($queryE);
		header ("Location:../controle/escolaridade_graduacao.php?matricula=$matricula");
	}else{
		if($idescolaridade > 0 && $tipo=='graduacao'){
			$query = "DELETE FROM graduacao where id=$idescolaridade";
			$conexao->executaQuery($query);
			header ("Location:../controle/escolaridade_graduacao.php?matricula=$matricula");
		}
	}
	
	if($tipo == 'posgraduacao'){
		$queryE = "INSERT INTO posgraduacao (matricula,cursoposgraduacao,instensino,numhoras) values ('$matricula','$cursoposgraduacao','$instensino','$numhoras')";		
		$conexao->executaQuery($queryE);
		header ("Location:../controle/escolaridade_posgraduacao.php?matricula=$matricula");
	}else{
		if($idescolaridade > 0 && $tipo=='posgraduacao'){
			$query = "DELETE FROM posgraduacao where id=$idescolaridade";
			$conexao->executaQuery($query);
			header ("Location:../controle/escolaridade_posgraduacao.php?matricula=$matricula");
		}
	}
	
	if($tipo == 'cursos'){
		$queryE = "INSERT INTO cursos (matricula,nomecurso,instensino,numhoras) values ('$matricula','$nomecursos','$instensino','$numhoras')";		
		$conexao->executaQuery($queryE);
		header ("Location:../controle/escolaridade_cursos.php?matricula=$matricula");
	}else{
		if($idescolaridade > 0 && $tipo=='cursos'){
			$query = "DELETE FROM cursos where id=$idescolaridade";
			$conexao->executaQuery($query);
			header ("Location:../controle/escolaridade_cursos.php?matricula=$matricula");
		}
	}
?>