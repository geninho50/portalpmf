<?php
	$id = $_GET['id'];
	$login = $_GET['login'];
	$mes = $_GET['mes'];
	$ano = $_GET['ano'];

	require ("DB_mysql.php");
	$obj = new DB_mysql;

	if($mes==1){
		$valor=12;
	}if($mes==2){
		$valor=11;
	}if($mes==3){
		$valor=10;
	}if($mes==4){
		$valor=4;
	}if($mes==5){
		$valor=3;
	}if($mes==6){
		$valor=6;
	}if($mes==7){
		$valor=7;
	}if($mes==8){
		$valor=1;
	}if($mes==9){
		$valor=2;
	}if($mes==10){
		$valor=5;
	}if($mes==11){
		$valor=8;
	}if($mes==12){
		$valor=9;
	}
	
	$queryU = "select * from usuario where login='$login'";
	$resultadoU = $obj->executaQuery($queryU);
	if ($linhaU=mysql_fetch_array($resultadoU))
	{
		$grupo = $linhaU['grupo'];
		$soma = $linhaU['soma'];
		$somaTemp = $soma-$valor;

	}
	
	
	$query = "UPDATE usuario set soma=(soma-$valor),ordenar=$somaTemp where login='$login'";	
	$obj->executaQuery($query);
	$queryD = "delete from ferias where id=$id";
	$obj->executaQuery($queryD);
	echo "<script>alert('Deletado com sucesso!');</script>";
	echo "<script> window.location.href = '../controle/cadastro_ferias.php' </script>";
	
	// Fechando as variáveis
	$obj->closeVar($id);
	$obj->closeVar($query);		
	$obj->closeQuery();
	$obj->closeConexaoGeral();
?>