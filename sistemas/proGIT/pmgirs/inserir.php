<?php

require_once("db.php"); 

$sugestao          = utf8_decode($_POST['sugestao']);
$justificativa     = utf8_decode($_POST['justificativa']);
$metodologia       = utf8_decode($_POST['metodologia']);
$representante     = utf8_decode($_POST['representante']);
$documento         = utf8_decode($_POST['documento']);
$email             = utf8_decode($_POST['email']);

function verificaVazio($var, $campo, $campoClass) {	
	if(empty($var)){
		$erro = 'O Campo "'.$campo.'" não pode ficar em branco';
		echo json_encode(array('sucesso' => 0, 'erro' => $erro, 'idErro' => $campoClass));
		die;
	}
}


/*verificaVazio($sugestao, 'sugestao', 'sugestao');
verificaVazio($justificativa, 'justificativa', 'justificativa');
verificaVazio($metodologia, 'metodologia', 'metodologia' );
verificaVazio($representante, 'representante', 'representante');
verificaVazio($documento, 'documento', 'documento');
verificaVazio($email, 'email', 'email'); */

$insertQuery = $db->prepare("INSERT INTO dados 
							 (sugestao, justificativa, metodologia, representante, documento, email)
							 VALUES 
							 	(:sugestao, :justificativa, :metodologia, :representante, :documento, :email)");

$insertQuery->bindParam(':sugestao', $sugestao);
$insertQuery->bindParam(':justificativa', $justificativa);
$insertQuery->bindParam(':metodologia', $metodologia);
$insertQuery->bindParam(':representante', $representante);
$insertQuery->bindParam(':documento', $documento);
$insertQuery->bindParam(':email', $email);

$execute = $insertQuery->execute();

if($execute){
	session_start();
	$_SESSION['id'] = $db->lastInsertId();
	echo json_encode(array('sucesso' => 1));
}else{
	echo json_encode(array('sucesso' => 0, 'erro' => 'Falha ao enviar', 'classe' => 'geral'));
}

?>