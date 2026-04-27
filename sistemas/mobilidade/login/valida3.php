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
		//$count = $result_usuario->rowCount();
		/* Exercise PDOStatement::fetch styles */
		
        
        $res = $result_usuario->get_result();

// Verifica se encontrou o usuário
if ($res->num_rows){
    $resultado = $result_usuario->fetch(PDO::FETCH_ASSOC);
    $_SESSION['user'] = $row['usuarioId']; // Marca a global para verificar se o usuário está logado.
    header('Location: http://localhost/sitema/inicio.php'); // Página do sistema
    exit; // Encerra a execução do script
} else {
   // Se não encontrou o usuário, manda de volta para o form de login
   header('Location: http://localhost/sitema/login.php'); // Página do sistema
   exit; // Encerra a execução do script
}




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
        $_SESSION['loginErro'] = "Usuário ou senha Inválido";
        $_SESSION['loginErro'] .= $count;
		header("Location: index.php");
			}
//O campo usuário e senha não preenchido entra no else e redireciona o usuário para a página de login
}else{
    $_SESSION['loginErro'] = "Usuário ou senha inválido - 2";
    header("Location: index.php");
}





	
?>