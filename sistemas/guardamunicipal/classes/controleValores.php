<?php
	$matricula = $_POST['matricula'];
	$gratificacao = $_POST['gratificacao'];
	$incentivo = $_POST['incentivo'];
	$trienio = $_POST['trienio'];

	require ("DB_mysql.php");
	$obj = new DB_mysql;
	
	
		$query = "UPDATE institucional set gratificacao='$gratificacao',incentivo='$incentivo',trienio='$trienio' where matricula=$matricula";	
		$obj->executaQuery($query);
		echo "<script>alert('Atualizar com sucesso!');</script>";
		echo "<script> window.location.href = '../controle/busca_informacoes_valores.php' </script>";
	
	
	
	// Excluir a Categoria
	
	// Fechando as variáveis
	$obj->closeVar($id);
	$obj->closeVar($query);		
	$obj->closeQuery();
	$obj->closeConexaoGeral();
?>