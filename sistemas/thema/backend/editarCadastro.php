<?php
include "db.php"; 
include "funcoes.php";
$nome          = $_POST['nome'];
$telefone      = $_POST['telefone'];
$cpf           = $_POST['cpf'];
$orgao         = $_POST['orgao'];
$movimentacao  = $_POST['movimentacao'];
$status        = $_POST['status'];
$id            = $_POST['id'];

$insertQuery = $db->prepare("UPDATE thema SET nome = :nome, telefone = :telefone, cpf = :cpf,
						  orgao = :orgao, movimentacao = :movimentacao, status = :status WHERE id = :id" );

$insertQuery->bindParam(':id', $id);
$insertQuery->bindParam(':nome', $nome);
$insertQuery->bindParam(':telefone', $telefone);
$insertQuery->bindParam(':cpf', $cpf);
$insertQuery->bindParam(':orgao', $orgao);
$insertQuery->bindParam(':movimentacao', $movimentacao);
$insertQuery->bindParam(':status', $status);

$execute = $insertQuery->execute();

if($execute){
	echo json_encode(array('success' => 1));
	
}else{
	echo json_encode(array('success' => 0, 'error' => 'Falha ao enviar', 'fieldProblem' => $fieldProblem));
}

?>