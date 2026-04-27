<?php
include "db.php"; 
$porta        = $_POST['porta'];
$servidor_id  = $_POST['id_servidor'];

if($porta == 0){
	echo json_encode(array('success' => 0, 'error' => 'Porta não informada'));
	die;
}
$insertQuery  = $db->prepare("INSERT INTO portaslinux 
					(porta, servidor_id) 
				VALUES 
					(:porta, :servidor_id)");

$insertQuery->bindParam(':porta', $porta);
$insertQuery->bindParam(':servidor_id', $servidor_id);
$execute = $insertQuery->execute();

if($execute){
	echo json_encode(array('success' => 1));
}else{
	echo json_encode(array('success' => 0, 'error' => 'Falha ao enviar', 'fieldProblem' => $fieldProblem));
}

?>