<?php
session_start();
$nome_usuario = "";
$senha_usuario ="";
if(isset($_SESSION['nomeusuario']))
{
    $nome_usuario = $_SESSION['matricula'];
}	
if(isset($_SESSION['senhausuario']))
{
    $senha_usuario = $_SESSION['senhausuario'];
}
if(!(empty($nome_usuario) OR empty($senha_usuario)))
{
    include "conecta.php";
	$resultado = pg_query("SELECT * FROM usuarios WHERE username='$nome_usuario'");
	
	if($resultado != FALSE)
	{
		if(pg_num_rows($resultado)==1)
		{
			if($senha_usuario != pg_result($resultado,0,"senha"))
			{
				unset($_SESSION["nomeusuario"]);
				unset($_SESSION["senhausuario"]);
				//setcookie("nome_usuario");
				//setcookie("senha_usuario");
				echo "Você não efetuou o LOGIN!";
				session_start();
				$_SESSION['msg'] = "Favor efetuar o LOGIN";
				header ("Location: index.html");
				exit;
			}
		}
		else
		{
			unset($_SESSION["nomeusuario"]);
			unset($_SESSION["senhausuario"]);
			//setcookie("nome_usuario");
			//setcookie("senha_usuario");
			echo "Você não efetuou o LOGIN!";
			session_start();
			$_SESSION['msg'] = "Favor efetuar o LOGIN!";
			header ("Location: index.html");
			exit;
		}
	}
	else
	{	
		echo pg_error();
	}
}
else
{
    echo "Você não efetuou o LOGIN!";
	session_start();
	$_SESSION['msg'] = "Favor efetuar o LOGIN!";
	header ("Location: index.html");
    exit;
}
//pg_close($conecta);
//header ("Location: seleciona.php");
?>