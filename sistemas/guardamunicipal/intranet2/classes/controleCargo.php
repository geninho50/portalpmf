<?php
	$matricula = 0;
	$matricula = (int)$_POST['xmatricula'];
	if( $matricula == 0 )
	{
		$matricula = (int)$_GET['id'];
	}
	$cargo = $_POST['ycargo'];

	require ("DB_mysql.php");
	$obj = new DB_mysql;

	if( $matricula > 0 )
	{
		// alterar
		$query = "UPDATE guarda_gmf set cargo='$cargo' where matricula=$matricula";	
		$obj->executaQuery($query);	
		echo "<script>alert('Cargo alterado com sucesso!');</script>";                       
		echo "<script> window.location.href = '../controle/cadastro_cargo.php' </script>";	
	}
	else{
			echo "<script>alert('Problema para atualizar o cargo!');</script>";                       
			echo "<script> window.location.href = '../controle/cadastro_cargo.php' </script>";	
	}
?>