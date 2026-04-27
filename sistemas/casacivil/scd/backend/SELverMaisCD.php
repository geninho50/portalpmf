<?php

include "db.php"; 
include "funcoes.php";

$id = $_POST['id'];
$sql = $db->prepare("SELECT * FROM scd.certificacaodigital where id = $id");
$sql->execute();
$data = $sql->fetch(PDO::FETCH_ASSOC);


if($data != ''){
	session_start();
	$_SESSION['id'] = $id;
	echo json_encode(array('success' => 1));
	
}else{
	echo json_encode(array('success' => 0, 'error' => 'Falha'));
}

?>