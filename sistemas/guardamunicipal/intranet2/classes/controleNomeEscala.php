<?php
	$verIncluir = false;
	$id = 0;
	$login = '';
	$chave = '';
	$id = $_POST['id'];
	$login = $_POST['login'];
	$chave = $_POST['chave'];
	
	if( $id == 0 )
	{
		$id = $_GET['id'];
		$login = $_GET['login'];
		$chave = $_GET['chave'];
	}

	require ("DB_mysql.php");
	$obj = new DB_mysql;
	$conexao = $obj->conectarConf();

	if($chave == 1){
	
		$sql = "select login from candidatos where idescala=$id and login='$login'";
		$resultado = $obj->executaQuery($sql);	
		if ( $linhaCa = mysql_fetch_array($resultado) )
		{
			echo 'Olá '.$login.', você já adicionou seu nome na lista para esta escala!';
		}else{
			$query = "INSERT INTO candidatos (idescala,login) values ('$id','$login')";
			$queryTemp = "INSERT INTO tempcandidatos (idescala,login) values ('$id','$login')";
			echo 'Seu nome foi inserido com sucesso!';
		}
	}
	else{
		$query = "DELETE FROM candidatos where idescala=$id and login='$login'";
		$queryTemp = "DELETE FROM tempcandidatos where idescala=$id and login='$login'";
		echo 'Seu nome foi removido com sucesso!';
	}

	// Excluir a Categoria
	$obj->executaQuery($query);
	$obj->executaQuery($queryTemp);
	// Fechando as variáveis
	$obj->closeVar($id);
	$obj->closeVar($login);
	$obj->closeVar($tamanho);
	$obj->closeVar($query);		
	$obj->closeQuery();
	$obj->closeConexaoGeral();

?>