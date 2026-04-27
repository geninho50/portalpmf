<?php
	session_start();	
	//Incluindo a conexão com banco de dados
	include_once("../src/conexao.php");	

	//O campo usuário e senha preenchido entra no if para validar
	if((isset($_POST['email'])) && (isset($_POST['senha']))){
		$email = $_POST['email'];
		$senha = $_POST['senha'];
		$senha = (md5($senha));
		$result_usuario = $conn->prepare("SELECT * FROM turismo.operadores WHERE operador_email = :operador_email AND  senha = :senha LIMIT 1");

        $result_usuario->bindParam(':operador_email', $email);
        $result_usuario->bindParam(':senha', $senha);
        $result_usuario->execute();
		$count = $result_usuario->rowCount();
		/* Exercise PDOStatement::fetch styles */
		$resultado = $result_usuario->fetch(PDO::FETCH_ASSOC);
		
	
	//Encontrado um usuario na tabela usuário com os mesmos dados digitado no formulário

	if($count != 0){
		$_SESSION['usuarioId'] = $resultado['id_operador'];
		$_SESSION['usuarioNome'] = $resultado['operador_nome'];
		$_SESSION['usuarioNivelacesso'] = $resultado['nivel_acesso'];
		$_SESSION['usuarioEmail'] = $resultado['operador_email'];
		echo "achou usuário no banco <br>";
	if($_SESSION['usuarioNivelacesso'] == "1"){ echo "o nivel de acesso e 1";
		header("Location: ../minhas_viagens.php");
	}

	else{
			header("Location: painel_usuario.php");
			}
	//Não foi encontrado um usuario na tabela usuário com os mesmos dados digitado no formulário
	//redireciona o usuario para a página de login
	}else{	
		//Váriavel global recebendo a mensagem de erro
     	 $_SESSION['loginErro'] = "Usuário ou senha Inválido";
		header("Location: ../login.php");
			}
//O campo usuário e senha não preenchido entra no else e redireciona o usuário para a página de login
}else{ echo "invalido2";
    $_SESSION['loginErro'] = "Usuário ou senha inválido";
   	header("Location: ../login.php");
}
