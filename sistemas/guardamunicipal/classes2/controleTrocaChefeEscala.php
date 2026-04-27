<?php
	$verIncluir = false;
	$id = 0;
	$id = (int)$_POST['idescala'];
	if( $id == 0 )
	{
		$id = (int)$_GET['idescala'];
	}
	$nome = mysql_escape_string($_POST['xchefe']);

	require ("DB_mysql.php");
	$obj = new DB_mysql;
	$tamanho = strlen($nome);
	if( $tamanho > 0 && $id > 0 )
	{
		// alterar
		$query = "UPDATE listaescala set chefe='$nome' where idescala=$id";
		$verIncluir = true;		
	}

	// Excluir a Categoria
	$obj->executaQuery($query);
	// Fechando as variáveis
	$obj->closeVar($id);
	$obj->closeVar($nome);

	$obj->closeVar($tamanho);
	$obj->closeVar($query);		
	$obj->closeQuery();
	$obj->closeConexaoGeral();

	// Redireciona
	if( $verIncluir == false )
	{
		header ("Location:../controle/administrar_escala_horaextra.php");
	}
	else
	{
		header ("Location:../adm/busca_escala_horaextra.php");
	}
?>