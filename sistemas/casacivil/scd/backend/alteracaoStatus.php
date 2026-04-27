<?php

include "db.php"; 
include "funcoes.php";

$id= $_POST['id'];
$ip= $_POST['ip'];
$acao= $_POST['acao'];
$data = date('Y-m-d');

if($acao == 3){
	$insetQr = $db->prepare("UPDATE scd.liberacaoip SET liberacao = $acao, ip = '$ip' WHERE id = $id;");
	$execute = $insetQr->execute();
}else{
	$insetQr = $db->prepare("UPDATE scd.liberacaoip SET liberacao = $acao, dataLiberacao = '$data', ip = '$ip' WHERE id = $id;");
	$execute = $insetQr->execute();
}

if($execute){
	session_start();
	$_SESSION['id'] = $db->lastInsertId();
	echo json_encode(array('success' => 1));
	
}else{
	echo json_encode(array('success' => 0, 'error' => 'Falha ao alterar', 'fieldProblem' => $fieldProblem));
}

