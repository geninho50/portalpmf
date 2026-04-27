<?php
	session_start();	
	//Incluindo a conexão com banco de dados
	include_once("conexao.php");	
	//O campo usuário e senha preenchido entra no if para validar
	if((isset($_POST['email'])) && (isset($_POST['senha']))){
		$usuario = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
		$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
		$senha = md5($senha);


		$result_usuario = $conn->prepare("SELECT * FROM login.usuarios WHERE email = :usuario AND  senha = :senha LIMIT 1");
        $result_usuario->bindParam(':usuario', $usuario);
        $result_usuario->bindParam(':senha', $senha);
        $result_usuario->execute();
		$count = $result_usuario->rowCount();
		echo $count;
		/* Exercise PDOStatement::fetch styles */
		$resultado = $result_usuario->fetch(PDO::FETCH_ASSOC);
		
	//Encontrado um usuario na tabela usuário com os mesmos dados digitado no formulário
	if($count != 0){
		$_SESSION['usuarioId'] = $resultado['id'];
		$_SESSION['usuarioNome'] = $resultado['nome'];
		$_SESSION['usuarioNiveisAcessoId'] = $resultado['nivel_acesso'];
		$_SESSION['usuarioEmail'] = $resultado['email'];

		if($_SESSION['usuarioNiveisAcessoId'] == "1"){
			header("Location: administrativo.php");
		}elseif($_SESSION['usuarioNiveisAcessoId'] == "2"){
			header("Location: colaborador.php");
		}else{
			header("Location: cliente.php");
		}
	//Não foi encontrado um usuario na tabela usuário com os mesmos dados digitado no formulário
	//redireciona o usuario para a página de login
	}else{	
		//Váriavel global recebendo a mensagem de erro
        $_SESSION['loginErro'] = "Usuário ou senha Inválido -1 - ";
        $_SESSION['loginErro'] .= $count;
		header("Location: index.php");
			}
//O campo usuário e senha não preenchido entra no else e redireciona o usuário para a página de login
}else{
    $_SESSION['loginErro'] = "Usuário ou senha inválido - 2";
    header("Location: index.php");
}





	
?>