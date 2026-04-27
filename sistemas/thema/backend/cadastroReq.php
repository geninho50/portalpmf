<?php
include "db.php"; 
include "funcoes.php";

$nome          = $_POST['nome'];
$telefone      = $_POST['telefone'];
$cpf           = $_POST['cpf'];
$orgao         = $_POST['orgao'];
$movimentacao  = $_POST['movimentacao'];
$status        = 0; 

validateEmpty($nome, "NOME COMPLETO", "nome");
validateCPF($cpf, "CPF", "cpf");

$insertQuery = $db->prepare("INSERT INTO thema 
					(nome,telefone,cpf,orgao,movimentacao,status) 
				VALUES 
					(:nome,:telefone,:cpf,:orgao,:movimentacao,:status)");

$insertQuery->bindParam(':nome', $nome);
$insertQuery->bindParam(':telefone', $telefone);
$insertQuery->bindParam(':cpf', $cpf);
$insertQuery->bindParam(':orgao', $orgao);
$insertQuery->bindParam(':movimentacao', $movimentacao);
$insertQuery->bindParam(':status', $status);
$execute = $insertQuery->execute();

if($execute){
	session_start();
	echo json_encode(array('success' => 1));
	$_SESSION['id'] = $db->lastInsertId();
}else{
	echo json_encode(array('success' => 0, 'error' => 'Falha ao enviar', 'fieldProblem' => $fieldProblem));
}

?>