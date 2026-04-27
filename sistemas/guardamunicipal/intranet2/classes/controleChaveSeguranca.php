<?php
	require ("DB_mysql.php");
	$obj = new DB_mysql;
	
	$cpf = $_POST['xcpf'];
	$novachave = $_POST['xnovachave'];
	$matricula = $_POST['xmatricula'];
	
	$tamanho = strlen($novachave);
	if($tamanho==4){
		
		$novachave = md5($novachave);
		$query = "UPDATE guarda_gmf set chave='$novachave', cpf='$cpf' where matricula=$matricula";		
		$obj->executaQuery($query);
		echo "<script>alert('Chave alterada com sucesso!');</script>";                       
		echo "<script> window.location.href = '../controle/listar_guarda_chave.php' </script>";

	}else{
		echo "<script>alert('Chaves tem que ter 4 caracteres!');</script>";                       
		echo "<script> window.location.href = '../controle/listar_guarda_chave.php' </script>";
	}
	
	// Excluir a Categoria
	$obj->executaQuery($query);
	// Fechando as variáveis
	$obj->closeVar($id);
	$obj->closeVar($nome);
	$obj->closeVar($query);		
	$obj->closeQuery();
	$obj->closeConexaoGeral();

?>