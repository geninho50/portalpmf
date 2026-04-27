<?php
	require ("DB_mysql.php");
	$conexao = new DB_mysql ;
	$conexao->conectarConf();
	
	$id = 0;
	$id = (int)$_POST['id'];
	$chave = $_POST['chave'];
	if( $id == 0 )
	{
		$id = (int)$_GET['id'];
		$chave = $_GET['chave'];
	}
	
	$idguarnicao = (int)$_POST['yidguarnicao'];
	$escola = $_POST['xescola'];
	$guarda = $_POST['guarda'];	
	$descricao = $_POST['descricao'];
	$descricaoT = strtr(strtoupper($descricao),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß"); 

	$data_atual = date("Y-m-d");
	$hora_atual = date("H:i:s");

	$sql = "SELECT id FROM escolas where nome='$escola'";
	$resultado = $conexao->executaQuery($sql);
	$linha = mysql_fetch_array($resultado);
	if( $linha )
	{
		$idescola = $linha["id"];
	}

	if($chave == 1 && $id > 0){
		$query = "UPDATE atendimento_escola set hora_chegada='$hora_atual' where id=$id";
		$conexao->executaQuery($query);	
		echo "<script>alert('J10 com sucesso no colegio!');</script>"; 
		echo "<script> window.location.href = '../controle/administrar_ocorrencia.php' </script>";                      
	}	
	else{
		if($chave == 2 && $id > 0){
			$query = "UPDATE atendimento_escola set hora_saida='$hora_atual',status=0,encerramento_ocorrencia='$descricaoT' where id=$id";
			$conexao->executaQuery($query);	
			$queryG = "UPDATE guarnicao set status=1 where id=$idguarnicao";
			$conexao->executaQuery($queryG);	
			echo "<script>alert('Atendimento do colegio finalizada com sucesso!');</script>";
			echo "<script> window.location.href = '../controle/administrar_ocorrencia.php' </script>";
		}	
		else{
				$query = "insert into atendimento_escola(guarda,idescola,idguarnicao,data_empenho,hora_empenho,status) values('$guarda','$idescola','$idguarnicao','$data_atual','$hora_atual',1)";
				$conexao->executaQuery($query);	
				$queryG = "UPDATE guarnicao set status=9 where id='$idguarnicao' and status=1";
				$conexao->executaQuery($queryG);	
				echo "<script>alert('Guarnicao empenhada com sucesso!');</script>"; 
				echo "<script> window.location.href = '../controle/administrar_ocorrencia.php' </script>";
			}
	}
?>