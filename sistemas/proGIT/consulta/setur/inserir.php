<?php

require_once("db.php"); 

$nome                = utf8_decode($_POST['nome']);
$email               = utf8_decode($_POST['email']);
$cpf                 = utf8_decode($_POST['cpf']);
$sugestao            = utf8_decode($_POST['sugestao']);
$projeto             = utf8_decode($_POST['projeto']);

function verificaVazio($var, $campo, $campoClass) {	
	if(empty($var)){
		$erro = 'O Campo "'.$campo.'" não pode ficar em branco';
		echo json_encode(array('sucesso' => 0, 'erro' => $erro, 'idErro' => $campoClass));
		die;
	}
}


verificaVazio($nome, 'Nome', 'nome' );
verificaVazio($email, 'Email', 'email' );
verificaVazio($cpf, 'CPF', 'cpf' );
verificaVazio($sugestao, 'Considerações', 'sugestao' );

$insertQuery = $db->prepare("INSERT INTO setur 
							 (nome, email, cpf, sugestao, projeto)
							 VALUES 
							 	(:nome, :email, :cpf, :sugestao, :projeto)");

$insertQuery->bindParam(':nome', $nome);
$insertQuery->bindParam(':email', $email);
$insertQuery->bindParam(':cpf', $cpf);
$insertQuery->bindParam(':sugestao', $sugestao);
$insertQuery->bindParam(':projeto', $projeto);

$execute = $insertQuery->execute();

if($execute){
	session_start();
	$_SESSION['id'] = $db->lastInsertId();
	echo json_encode(array('sucesso' => 1));
}else{
	echo json_encode(array('sucesso' => 0, 'erro' => 'Falha ao enviar', 'classe' => 'geral'));
}

?>