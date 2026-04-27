<?php
	session_start();
	require ("DB_mysql.php");
	$obj = new DB_mysql;
	$conexao = $obj->conectarConf();
	require ("trataData.php");
	$objD = new trataData;

	$data = $objD->getData();
	$hora = date("H:i:s");
	$dataHora = $data.' - '.$hora;

	$remetente = mysql_escape_string($_POST['xnomeremetente']);
	$email = mysql_escape_string($_POST['xemailremetente']);
	if ($_POST["xpalavra"] == $_SESSION["palavra"])
	{
			$query = "insert into senha_usuario(login,email,data)values('$remetente','$email','$dataHora')";	
			$obj->executaQuery($query);
			echo "<script>alert('Dados enviados com sucesso, aguarde contato!');</script>";                       
			echo "<script> window.location.href = '../controle/login.php' </script>";
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