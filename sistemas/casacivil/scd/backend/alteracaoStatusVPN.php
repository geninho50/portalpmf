<?php

include "db.php"; 
include "funcoes.php";

$id= $_POST['id'];
$acao= $_POST['acao'];
$observacao = $_POST['observacao'];
$data = date('Y-m-d');


if($acao == 3){
	$insetQr = $db->prepare("UPDATE scd.liberacaovpn SET liberacao = $acao, observacao = '$observacao' WHERE id = $id;");
	$execute = $insetQr->execute();
}else{
	$insetQr = $db->prepare("UPDATE scd.liberacaovpn SET liberacao = $acao, dataLiberacao = '$data' WHERE id = $id;");
	$execute = $insetQr->execute();
}

if($execute){
	session_start();
	$_SESSION['id'] = $db->lastInsertId();
	echo json_encode(array('success' => 1));
	
}else{
	echo json_encode(array('success' => 0, 'error' => 'Falha ao alterar', 'fieldProblem' => $fieldProblem));
}

