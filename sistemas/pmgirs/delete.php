<?php
include "db.php"; 

$aprovado      = $_POST['aprovado'];
$id            = $_POST['id'];

$insertQuery = $db->prepare("UPDATE setur SET aprovado = 0 WHERE id = :id" );

$insertQuery->bindParam(':id', $id);
$insertQuery->bindParam(':aprovado', $aprovado);
$execute = $insertQuery->execute();

if($execute){
	echo json_encode(array('success' => 1));
	
}else{
	echo json_encode(array('success' => 0, 'error' => 'Falha ao enviar', 'fieldProblem' => $fieldProblem));
}

?>