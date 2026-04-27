<?php
session_start();
$username = $_POST["username"];
$senha = $_POST["senha"];
$entsai = $_POST["entsai"];
$operacao = $_POST['operacao'];
//echo $username;
//echo $senha;
//echo $entsai;
//echo $operacao;
//exit;
if ($operacao != "ponto")
{
	if(isset($_SESSION['operacao']) && !empty($_SESSION['operacao']))
	{
		$operacao = $_SESSION['operacao'];
	}
	else
	{
		$operacao = $_POST['operacao'];
	}
}
echo $operacao;
//echo exit;
//criptografando a senha
//$senha_criptografada = md5($senha);
$senha_criptografada = $senha;
//echo $senha_criptografada;
// acesso ao banco de dados
include "conecta.php";
//include "conecta_usuarios.php";
//echo "01";
//exit;
$resultado = pg_query("SELECT * FROM usuarios where username='$username' or pnome='$username'");
//echo "02";
//exit;
//echo pg_result($resultado, 0, "usuario_id");
//echo pg_fetch_result($resultado, 0, "usuario_id");
//echo pg_num_rows($resultado);
if($resultado != FALSE)
{
	$linhas = pg_num_rows($resultado);
	if($linhas==0)  // testa se a consulta retornou algum registro
	{
		echo $linhas;
		session_start();
		$_SESSION['msg'] = "Usuário não cadastrado!";
		echo $_SESSION['msg'];
		if($operacao == "ponto")
		{
			header ("Location: pontologin.php");
		}
		else
		{
			header ("Location: consultalogin.php");
		}
//		echo "<html><body>";
//		echo "<p align=\"center\">Usuário não encontrado!</p>";
//		echo "<p align=\"center\"><a href=\"login.html\">Voltar</a></p>";
//		echo "</body></html>";
	}
	else
	{
//		if ($senha_criptografada != pg_result($resultado, 0, "senha"))  // confere senha
//		{
		$varsenha="N";
//			if ($linhas >= 1)
//			{
		for ($i=0;$i<$linhas;$i++)
		{
			$senha=pg_result($resultado, $i, "senha");
			$p4mat=pg_result($resultado, $i, "matricula");
			$p4mat=substr($p4mat,0,4);
			if (($senha_criptografada == $p4mat) || ($senha_criptografada == $username) || ($senha_criptografada == $senha))
			{
				$varsenha="S";
			}
		}
//			}
		if ($varsenha=="N")
		{
			session_start();
			$_SESSION['msg'] = "A senha está incorreta!";
			echo $_SESSION['msg'];
			if($operacao == "ponto")
			{
				header ("Location: pontologin.php");
			}
			else
			{
				header ("Location: consultalogin.php");
			}
		}	
		//			echo "<html><body>";
		//			echo "<p align=\"center\">A senha está incorreta!</p>";
		//			echo "<p align=\"center\"><a href=\"login.html\">Voltar</a></p>";
		//			echo "</body></html>";
//		}
//		else   // usuário e senha corretos. Vamos criar os cookies
//		{
//			$varsenha="S";
//		}
		else
		{
			session_start();
			$username = pg_result($resultado, 0, "username");
			$senha = pg_result($resultado, 0, "senha");
			$us_id = pg_result($resultado, 0, "usuario_id");
			$admin = pg_result($resultado, 0, "admin");
			$nome = pg_result($resultado, 0, "nome");
			$cadastro = pg_result($resultado, 0, "cadastro");
			//$usuario_id = pg_fetch_result($resultado, 0, "usuario_id");
			$_SESSION['matricula'] = $username;
			$_SESSION['nomeusuario'] = $nome;
		 // $_SESSION['senha_usuario'] = $senha_criptografada;
			$_SESSION['senhausuario'] = $senha;
			$_SESSION['usuarioid'] = $us_id;
			if ($admin=="A"){
			$_SESSION['admin'] = $admin;
			}
			else 
			{ $_SESSION['admin'] = "Z";
			}
			$_SESSION['cadastro'] = $cadastro;
			//setcookie("nome_usuario", $username);
			//setcookie("senha_usuario", $senha_criptografada);
			// direciona para a página inicial dos usuários cadastrados
			echo "usuario e senha conferem!";
			echo "Operação";
			echo $operacao;
			$ip=$_SERVER["REMOTE_ADDR"];
			$sql="INSERT INTO ponto (usuario_id, ipref, entsai) VALUES ('$us_id', '$ip', '$entsai')";
			$resultado=pg_query($sql);
			if($resultado != FALSE)
			{
				$nreg=pg_affected_rows($resultado);
				if($nreg != FALSE)
				{
					if($nreg == 1)
					{
						echo "Registro incluido com sucesso!";
					}
				}
				else
				{
					echo pg_result_error();
				}
			}
			if ($entsai=="E")
			{
			$_SESSION['msg'] = "Seu registro de ENTRADA foi efetuado com sucesso";
			}
			if ($entsai=="S")
			{
			$_SESSION['msg'] = utf8_encode("Seu registro de SAÍDA foi efetuado com sucesso");
			}
			if($operacao == "ponto")
			{
				header ("Location: pontologin.php");
			}
			if($operacao == "vistoria")
			{
				header ("Location: seleciona.php");
			}
			if($operacao == "comunica")
			{
				header ("Location: comunicainsform.php");
			}
			if($operacao == "validador")
			{
				header ("Location: validadorfiltro.php");
			}
			if($operacao == "outras")
			{
				header ("Location: outrasconsultas.php");
			}
		}
	}
}
else
{
	echo "Sem Conexão";
	echo pg_result_error();
}
pg_close($conecta);
?>($conecta);
?>