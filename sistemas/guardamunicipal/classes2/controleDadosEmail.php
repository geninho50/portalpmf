<?php

	require ("DB_mysql.php");
	$conexao = new DB_mysql ;
	$conexao->conectarConf();
	
	$login = $_POST['login'];
	$cpf = $_POST['xcpf'];
	$telefone1 = $_POST['telefone1'];
	$telefone2 = $_POST['xtelefone2'];
	$telefone3 = $_POST['telefone3'];
	$email = $_POST['xemail'];
	$chave = $_POST['xchave'];
	$senhaCorreta = md5($chave);
	
	// incluir
	$query = "update guarda_gmf set cpf='$cpf', foneresid='$telefone1', fonecel1='$telefone2', fonecel2='$telefone3', email='$email', chave='$senhaCorreta' where login='$login'";
	$conexao->executaQuery($query);
	echo "<script>alert('Atualizacao realizada com sucesso!');</script>";                       
	echo "<script> window.location.href = '../controle/recado_principal.php' </script>";
?>