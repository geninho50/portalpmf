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
	$senha = $_POST['xconfirmarsenha'];
	$senhaCorreta = md5($senha);
	$chave = $_POST['xchave'];
	$chaveCorreta = md5($chave);
	
	$query = "SELECT * FROM guarda_gmf where login='$login'";
	$resultado = $conexao->executaQuery($query);
	$linha = mysql_fetch_array($resultado);
	if ($linha)
	{
		// incluir
		$query = "update guarda_gmf set cpf='$cpf', foneresid='$telefone1', fonecel1='$telefone2', fonecel2='$telefone3', email='$email', senha='$senhaCorreta', chave='$chaveCorreta' where login='$login'";
		$conexao->executaQuery($query);
		echo "<script>alert('Atualizacao realizada com sucesso!');</script>";                       
		echo "<script> window.location.href = '../controle/index.php' </script>";	
	}
	else{
		echo "<script>alert('Guarda nao econtrado! Entre em contato com o ADM do SIGA');</script>";                       
		echo "<script> window.location.href = '../controle/index.php' </script>";
	}
	

?>