<?php

include "db.php"; 
include "funcoes.php";

$id = $_POST['id'];

$deleteQuery = $db->prepare('DELETE FROM servidoreswindows WHERE id = :id');
$deleteQuery->bindParam(':id', $id);
$execute = $deleteQuery->execute();

if($execute){
	echo json_encode(array('success' => 1));
}else{
	echo json_encode(array('success' => 0, 'error' => 'Falha ao enviar', 'fieldProblem' => $fieldProblem));
}
?>