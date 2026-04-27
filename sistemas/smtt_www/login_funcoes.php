<?php
/*----------------Função cadastrar-------------------------------------------*/
function cadastrar($username, $senha, $nome, $email)
{	
	$status=0;
//	$senha_crip = md5($senha);
	$senha_crip = $senha;
	$sql = "INSERT INTO usuarios VALUES ";
	$sql .= "('$username','$senha_crip','$nome','$email')";
	$resultado = pg_query ($sql); 

	if($resultado!=FALSE)
	{
		$status = 0;
		echo "<html><body>";
		echo "<p align=\"center\">Cadastro realizado com sucesso!</p>";
		echo "</body></html>";			
	}	
	else
	{
		$status = 1;
		echo pg_error();
		echo "<p align=\"center\"><a href=\"cadastro.php\">Voltar para o cadastro</a></p>";
		echo "<br>";
	}
	return $status;
}
/*----------------Função mostrar-------------------------------------------*/
function mostrar($username, $status)
{
	if($status!=1)
	{	
		$resultado = pg_query ("SELECT * FROM usuarios WHERE username='$username'");
		
		if($resultado!=FALSE)
		{
			$linhas = pg_num_rows ($resultado);
			
			if($linhas==0)
			{
				echo "<p><a class='smt'>Não tem nada para ser mostrado</a></p>";
			}
			else
			{			
				$reg = pg_fetch_row($resultado);
				echo "<a class='smt'>Usuário</a>: ". $reg[0] . "<br>";
				//echo "<a class='smt'>Senha</a>: ". $reg[1] . "<br>";
				echo "<a class='smt'>Nome</a>: ". $reg[2] . "<br>";
				echo "<a class='smt'>Email</a>: ". $reg[3] . "<br>";
				echo "<p align=\"center\"><font face='verdana'><a href=\"login.html\">Faça seu login</a></font></p>";			
			}
		}	
		else
		{
			echo pg_error();
			echo "<br>";
		}		
	}
	else
	{
		echo "<p align=\"center\">Usuário já cadastrado</p>";
		echo "<p align=\"center\"><a href=\"login.html\">Teste seu login</a></p>";
	}	
}
?>