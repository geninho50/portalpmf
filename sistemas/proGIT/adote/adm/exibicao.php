<?php
	include_once("../banco/gdb.php"); 

	$gdb = new gdb();  
	
	$idAnimal = $gdb->vargetpost('idAnimal');

	$sql = "UPDATE adoteDibea.animal SET ativo = 1 WHERE id_animal = '$idAnimal'";
	

	if($gdb->open($sql)) {
		echo json_encode(array('success' => '1'));
	} else {
		echo json_encode(array('error' => 'Erro ao excluir o animal!'));
	}