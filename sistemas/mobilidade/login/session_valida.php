<?php
	session_start();	
	//Incluindo a conexão com banco de dados
	include_once("../user/conexao.php");	
	//O campo usuário e senha preenchido entra no if para validar
	if((isset($_POST['email'])) && (isset($_POST['senha']))){
		$usuario = $_POST['email'];
		$senha = $_POST['senha'];
		$senha = md5($senha);

		$result_usuario = $conn->prepare("SELECT * FROM login.usuarios WHERE email = :usuario AND  senha = :senha LIMIT 1");
        $result_usuario->bindParam(':usuario', $usuario);
        $result_usuario->bindParam(':senha', $senha);
        $result_usuario->execute();
		$count = $result_usuario->rowCount();
		/* Exercise PDOStatement::fetch styles */
		$resultado = $result_usuario->fetch(PDO::FETCH_ASSOC);
		
	//Encontrado um usuario na tabela usuário com os mesmos dados digitado no formulário

	if($count != 0){
		$_SESSION['usuarioId'] = $resultado['id'];
		$_SESSION['usuarioNome'] = $resultado['nome'];
		$_SESSION['usuarioNivelacesso'] = $resultado['nivel_acesso'];
		$_SESSION['usuarioEmail'] = $resultado['email'];
		$_SESSION['cpf'] = strval($resultado['cpf']);

	if($_SESSION['usuarioNivelacesso'] == "9"){
		header("Location: painel_administrativo.php");
	}

	else{
			header("Location: painel_usuario.php");
			}
	//Não foi encontrado um usuario na tabela usuário com os mesmos dados digitado no formulário
	//redireciona o usuario para a página de login
	}else{	
		//Váriavel global recebendo a mensagem de erro
        $_SESSION['loginErro'] = "Usuário ou senha Inválido";
        $_SESSION['loginErro'] .= $count;
		header("Location: index.php");
			}
//O campo usuário e senha não preenchido entra no else e redireciona o usuário para a página de login
}else{
    $_SESSION['loginErro'] = "Usuário ou senha inválido";
    header("Location: index.php");
}





	
?>