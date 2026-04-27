<?php 
	include "conecta.php";
	if(isset($_POST["matricula"]) && !empty($_POST["matricula"]))
	{
		$matricula = $_POST["matricula"];
	}
	$nome=$_POST["nome"];
	$senha=$_POST["senha"];
	$confirmarsenha=$_POST["csenha"];
	$email=$_POST["email"];
//	$senha_crip = md5($senha);
	
	if ($senha !=  $confirmarsenha)
	{
		session_start();
		$_SESSION['msg'] = "* O campo Senha tem que ser igual ao Confirmar senha";
		header ("Location: cadastro.php");
		exit;
	}	
	$sql = "UPDATE usuarios SET nome = '$nome', senha = '$senha', email = '$email' ";
	$sql = $sql."WHERE username = '$matricula'";
	
	$resultado = pg_query ($sql); 

	if($resultado!=FALSE)
	{
		session_start();
		$_SESSION['msg'] = "Cadastro atualizado com sucesso";
		unset($_SESSION["senhausuario"]);
		header ("Location: pontologin.php");
	}	
	else
	{
		session_start();
		$_SESSION['msg'] = "Erro na atualizaחדo do cadastro";
		header ("Location: cadastro.php");
	}
	pg_close($conecta);
?>