<?php

include "db.php"; 
include "funcoes.php";

$id= $_POST['id'];
$acao= $_POST['acao'];
$data = $_POST['data'];
$data = explode('/', $data);
$data = $data[2].'-'.$data[1].'-'.$data[0];
$ano = $_POST['ano'];



	$insetQr = $db->prepare("UPDATE scd.certificacaodigital SET liberacao = $acao, dataLiberacao = '$data', QtdAnoExpiracao = $ano WHERE id = $id;");
	$execute = $insetQr->execute();

if($execute){
	session_start();
	$_SESSION['id'] = $db->lastInsertId();
	echo json_encode(array('success' => 1));
	
}else{
	echo json_encode(array('success' => 0, 'error' => 'Falha ao alterar', 'fieldProblem' => $fieldProblem));
}

