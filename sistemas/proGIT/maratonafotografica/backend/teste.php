<?php 
	include "db.php";


ini_set('display_errors', 1);
error_reporting(E_ALL);

		
	
	$sql = $db->prepare("SELECT count(*) as qtd FROM infantoJuvenil");
	$sql->execute();
	$data = $sql->fetch(PDO::FETCH_ASSOC);
	var_dump($data);

	$sql = $db->prepare("SELECT count(*) as qtd FROM filmeEdigital");
	$sql->execute();
	$data2 = $sql->fetch(PDO::FETCH_ASSOC);

	
	var_dump($data2);
