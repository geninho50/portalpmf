<?php
	$idVtr = 0;
	$idVtr = (int)$_POST['idVtr'];
	if( $idVtr == 0 )
	{
		$idVtr = (int)$_GET['idVtr'];
	}
	
	$vtr = $_POST['xvtr'];
	$classe = $_POST['xclasse'];
	$tamanho = strlen($vtr);

	require ("DB_mysql.php");
	$conexao = new DB_mysql ;
	$conexao->conectarConf();
	
	if( $tamanho > 0 && $idVtr > 0 )
	{
		// alterar dados
		$query = "UPDATE vtr set vtr='$vtr',classe='$classe' where id=$idVtr";
		$conexao->executaQuery($query);		
	}
	else
	if( $idVtr > 0 )
	{
		// excluir envento
		$query = "delete from vtr where id=$idVtr";
		$conexao->executaQuery($query);
	}
	else
	{
		$query = "insert into vtr (vtr,classe) values ('$vtr','$classe')";
		$conexao->executaQuery($query);
		echo "<script>alert('Cadastro com sucesso!');</script>"; 
		echo "<script> window.location.href = '../controle/cadastro_viatura.php' </script>";  
	}
?>