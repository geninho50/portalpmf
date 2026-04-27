<?php
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);


require_once("db.php"); 

$nome                = utf8_decode($_POST['nome']);
$email               = utf8_decode($_POST['email']);
$ocupacao            = utf8_decode($_POST['ocupacao']);
$sugestao            = utf8_decode($_POST['sugestao']);
$tema                = utf8_decode($_POST['tema']);

function verificaVazio($var, $campo, $campoClass) {	
	if(empty($var)){
		$erro = 'O Campo "'.$campo.'" não pode ficar em branco';
		echo json_encode(array('sucesso' => 0, 'erro' => $erro, 'idErro' => $campoClass));
		die;
	}
}


verificaVazio($nome, 'Nome', 'nome' );
verificaVazio($email, 'Email', 'email' );
verificaVazio($ocupacao, 'Profissão/Ocupação/Entidade', 'ocupacao' );
verificaVazio($sugestao, 'Sugestão', 'sugestao' );

$insertQuery = $db->prepare("INSERT INTO smdu 
							 (nome, email, ocupacao, sugestao, tema)
							 VALUES 
							 	(:nome, :email, :ocupacao, :sugestao, :tema)");

$insertQuery->bindParam(':nome', $nome);
$insertQuery->bindParam(':email', $email);
$insertQuery->bindParam(':ocupacao', $ocupacao);
$insertQuery->bindParam(':sugestao', $sugestao);
$insertQuery->bindParam(':tema', $tema);

$execute = $insertQuery->execute();

if($execute){
	session_start();
	$_SESSION['id'] = $db->lastInsertId();
	echo json_encode(array('sucesso' => 1));
}else{
	echo json_encode(array('sucesso' => 0, 'erro' => 'Falha ao enviar', 'classe' => 'geral'));
}

?>