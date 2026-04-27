<?php
	$verIncluir = false;
	$id = 0;
	$login = '';
	$chave = '';
	$id = (int)$_POST['id'];
	$login =  mysql_escape_string($_POST['login']);
	$chave = (int)$_POST['chave'];
	
	if( $id == 0 )
	{
		$id = (int)$_GET['id'];
		$login =  mysql_escape_string($_GET['login']);
		$chave = (int)$_GET['chave'];
	}

	require ("DB_mysql.php");
	$obj = new DB_mysql;
	$conexao = $obj->conectarConf();
	
	$data_atual = date("Y-m-d");
    $hora_atual = date("H:i:s");

	if($chave == 1){
	
		$sql = "select login from candidatos where idescala=$id and login='$login'";
		$resultado = $obj->executaQuery($sql);	
		if ( $linhaCa = mysql_fetch_array($resultado) )
		{
			echo '<font color=#006699 face=Verdana, Arial, Helvetica, sans-serif size=2>Olá '.$login.', você já adicionou seu nome na lista para esta escala!</font>'.'<br>';
			echo "<b><a href='../controle/listar_escala_horaextra.php'><font color=#006699 face=verdana, Helvetica, sans-serif size=2>Voltar</font></a></b>";
		}else{
			$query = "INSERT INTO candidatos (idescala,login,data,hora) values ('$id','$login','$data_atual','$hora_atual')";
			$queryTemp = "INSERT INTO tempcandidatos (idescala,login,data,hora) values ('$id','$login','$data_atual','$hora_atual')";
			echo '<font color=#006699 face=Verdana, Arial, Helvetica, sans-serif size=2>Seu nome foi inserido com sucesso!</font>'.'<br>';
			echo "<b><a href='../controle/listar_escala_horaextra.php'><font color=#006699 face=Verdana, Arial, Helvetica, sans-serif size=2>Voltar</font></a></b>";
		}
	}
	else{
		$query = "DELETE FROM candidatos where idescala=$id and login='$login'";
		$queryTemp = "DELETE FROM tempcandidatos where idescala=$id and login='$login'";
		echo '<font color=#006699 face=Verdana, Arial, Helvetica, sans-serif size=2>Seu nome foi removido com sucesso!</font>'.'<br>';
		echo "<b><a href='../controle/listar_escala_horaextra.php'><font color=#006699 face=Verdana, Arial, Helvetica, sans-serif size=2>Voltar</font></a></b>";
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