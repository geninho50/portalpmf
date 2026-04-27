<?php
	$id = 0;
	$id = (int)$_POST['idescala'];
	if( $id == 0 )
	{
		$id = (int)$_GET['idescala'];
	}
	$nome = mysql_escape_string($_POST['ychefe']);

	require ("DB_mysql.php");
	$obj = new DB_mysql;
	$tamanho = strlen($nome);
	if( $tamanho > 0 && $id > 0 )
	{
		// alterar
		$query = "UPDATE listaescala set chefe='$nome' where idescala=$id";
		$obj->executaQuery($query);
		echo "<script>alert('Efetuado a troca do chefe com sucesso!');</script>";                       
		echo "<script> window.location.href = '../controle/administrar_escala_horaextra.php' </script>";
	}
	// Fechando as variáveis
	$obj->closeVar($id);
	$obj->closeVar($nome);
	$obj->closeVar($tamanho);
	$obj->closeVar($query);		
	$obj->closeQuery();
	$obj->closeConexaoGeral();

?>