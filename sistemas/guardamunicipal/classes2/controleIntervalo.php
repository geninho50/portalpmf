<?php
	$chave = $_POST['chave'];
	$data = $_POST['dataini'];

	require ("DB_mysql.php");
	$obj = new DB_mysql;

	$query = "select MAX(id) as id from intervalo";
	$resultado = $obj->executaQuery($query);
	if ($linha=mysql_fetch_array($resultado))
	{
		$id = $linha['id'];
	}
	
	
	if( $chave == 1 )
	{
		// alterar
		$query = "UPDATE intervalo set chave='$chave',data='$data' where id=$id";	
		$obj->executaQuery($query);
		echo "<script>alert('Habilitado com sucesso!');</script>";
		echo "<script> window.location.href = '../controle/cadastro_intervalo.php' </script>";
	}else{
		if( $chave == 2 )
		{
			// alterar
			$query = "UPDATE intervalo set chave='$chave',data='$data' where id=$id";	
			$obj->executaQuery($query);
			echo "<script>alert('Desabilitado com sucesso!');</script>";
			echo "<script> window.location.href = '../controle/cadastro_intervalo.php' </script>";
		}
		else{
			echo "<script>alert('Problema para atualizar!');</script>";
			echo "<script> window.location.href = '../controle/cadastro_intervalo.php' </script>";
		}
	}
	
	
	
	// Excluir a Categoria
	
	// Fechando as variáveis
	$obj->closeVar($id);
	$obj->closeVar($query);		
	$obj->closeQuery();
	$obj->closeConexaoGeral();
?>