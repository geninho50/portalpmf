<?
include "db.php"; 
$id     = $_POST['id'];
$status = 0;

$insertQuery = $db->prepare("UPDATE thema SET status = :status WHERE id = :id" );

$insertQuery->bindParam(':id', $id);
$insertQuery->bindParam(':status', $status);

$execute = $insertQuery->execute();

if($execute){
	echo json_encode(array('success' => 1));
	
}else{
	echo json_encode(array('success' => 0, 'error' => 'Falha ao enviar', 'fieldProblem' => $fieldProblem));
}

?>