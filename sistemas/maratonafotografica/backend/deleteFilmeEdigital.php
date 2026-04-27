<?php

require_once("db.php");
$id = $_POST['id'];

$deleteQuery = $db->prepare('DELETE FROM filmeEdigital WHERE id = ?');
$deleteQuery->bindParam(1, $id);
$execute = $deleteQuery->execute();

if($execute){
    echo json_encode(array('success' => 1));
}else{
    echo json_encode(array('success' => 0, 'error' => 'Falha ao enviar', 'fieldProblem' => $fieldProblem));
}
