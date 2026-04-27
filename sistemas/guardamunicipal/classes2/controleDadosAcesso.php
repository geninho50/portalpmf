<?php
	session_start();
	require ("DB_mysql.php");
	$obj = new DB_mysql;
	$conexao = $obj->conectarConf();

	$matricula = (int)$_POST['xmatricula'];
	$login = mysql_escape_string($_POST['xlogin']);
	$email = mysql_escape_string($_POST['xemail']);
	$dataini = mysql_escape_string($_POST['dataini']);
	if ($_POST["xpalavra"] == $_SESSION["palavra"])
	{
		$sql = "SELECT * FROM guarda_gmf where matricula=$matricula";
		$resultado = $obj->executaQuery($sql);
		$linha = mysql_fetch_array($resultado);
		if( $linha )
		{
			$query = "UPDATE guarda_gmf set login_usuario='$login',email='$email',datanasc='$dataini' where matricula='$matricula'";	
			$obj->executaQuery($query);
			echo "<script>alert('Login alterada com sucesso!');</script>";                       
			echo "<script> window.location.href = '../controle/recado_principal.php' </script>";
		}else{
		 	echo "<script>alert('Matricula inexistente!');</script>";                
			echo "<script> window.location.href = '../controle/cadastro_usuario_acesso.php' </script>";
		}
	}else{
        echo "<script>alert('Letras não confere!');</script>";                
		echo "<script> window.location.href = '../controle/cadastro_usuario_acesso.php' </script>";
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