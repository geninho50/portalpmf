<?php
	$matricula = $_GET['matricula'];
	$tipo = $_GET['tipo'];
	$idsaude = $_GET['id'];
	if( $matricula == 0 )
	{
		$matricula = $_POST['matricula'];
		$tipo = $_POST['tipo'];
		$idsaude = $_POST['id'];
	}
	
	$doencas = $_POST['xrespostadoenca'];
	$tratamentosaude = $_POST['xrespostatratamento'];
	$alergia = $_POST['xrespostaalergia'];
	$medicamento = $_POST['xrespostamedicamento'];
	$planosaude = $_POST['xrespostaplanosaude'];
	$tiposang = $_POST['tiposang'];
	$doador = $_POST['doador'];
	
	require ("DB_mysql.php");	
	require ("trataArquivo.php");
	require ("trataData.php");
	$conexao = new DB_mysql;
	$conexao->conectarConf();
	$objD = new trataData;

	if($tipo == 'saude'){
		$queryE = "INSERT INTO doencas (matricula,doencas) values ('$matricula','$doencas')";		
		$conexao->executaQuery($queryE);
		header ("Location:../controle/pop_historico_doenca.php?matricula=$matricula");
	}else{
		if($idsaude > 0 && $tipo=='saude'){
			$query = "DELETE FROM doencas where id=$id";
			$conexao->executaQuery($query);
			header ("Location:../controle/pop_historico_doenca.php?matricula=$matricula");
		}
	}
	
	
	if($tipo == 'tratamento'){
		$queryE = "INSERT INTO tratamento (matricula,tratamento) values ('$matricula','$tratamentosaude')";		
		$conexao->executaQuery($queryE);
		header ("Location:../controle/pop_tratamento.php?matricula=$matricula");
	}else{
		if($idsaude > 0 && $tipo=='tratamento'){
			$query = "DELETE FROM tratamento where id=$id";
			$conexao->executaQuery($query);
			header ("Location:../controle/pop_tratamento.php?matricula=$matricula");
		}
	}
	
	if($tipo == 'alergia'){
		$queryE = "INSERT INTO alergia (matricula,alergia) values ('$matricula','$alergia')";		
		$conexao->executaQuery($queryE);
		header ("Location:../controle/pop_alergia.php?matricula=$matricula");
	}else{
		if($idsaude > 0 && $tipo=='alergia'){
			$query = "DELETE FROM alergia where id=$id";
			$conexao->executaQuery($query);
			header ("Location:../controle/pop_alergia.php?matricula=$matricula");
		}
	}
	
	if($tipo == 'medicamento'){
		$queryE = "INSERT INTO medicamento (matricula,medicamento) values ('$matricula','$medicamento')";		
		$conexao->executaQuery($queryE);
		header ("Location:../controle/pop_medicamento.php?matricula=$matricula");
	}else{
		if($idsaude > 0 && $tipo=='medicamento'){
			$query = "DELETE FROM alergia where id=$id";
			$conexao->executaQuery($query);
			header ("Location:../controle/pop_medicamento.php?matricula=$matricula");
		}
	}
	
	if($tipo == 'planosaude'){
		$queryE = "INSERT INTO planosaude (matricula,planosaude) values ('$matricula','$planosaude')";		
		$conexao->executaQuery($queryE);
		header ("Location:../controle/pop_plano_saude.php?matricula=$matricula");
	}else{
		if($idsaude > 0 && $tipo=='planosaude'){
			$query = "DELETE FROM planosaude where id=$id";
			$conexao->executaQuery($query);
			header ("Location:../controle/pop_plano_saude.php?matricula=$matricula");
		}
	}
	
	if($tipo == 'fator'){
		$queryB= "select * from tiposang where matricula=$matricula";
		$resultadoB = $conexao->executaQuery($queryB);
		$linhaB = mysql_fetch_array($resultadoB);
		if( $linhaB )
		{
			$queryE = "update tiposang set tiposang='$tiposang',chavedoador=$doador where matricula=$matricula";
			$conexao->executaQuery($queryE);
			header ("Location:../controle/pop_tipo_sanguinio.php?matricula=$matricula");
		}else{
			$queryE = "INSERT INTO tiposang (matricula,tiposang,chavedoador) values ('$matricula','$tiposang','doador')";		
			$conexao->executaQuery($queryE);
			header ("Location:../controle/pop_tipo_sanguinio.php?matricula=$matricula");
		}
	}else{
		if($idsaude > 0 && $tipo=='fator'){
			$query = "DELETE FROM tiposang where id=$id";
			$conexao->executaQuery($query);
			header ("Location:../controle/pop_tipo_sanguinio.php?matricula=$matricula");
		}
	}
	// Redireciona
	
?>