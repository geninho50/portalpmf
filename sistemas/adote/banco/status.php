<?php
	include_once("gdb.php"); 

	$gdb = new gdb();  
	
    $status = $gdb->vargetpost('status');
    $idInteresse = $gdb->vargetpost('idInteresse');

    $sql = "UPDATE adoteDibea.interesse SET status = $status WHERE id_interesse = $idInteresse";

    if($gdb->open($sql)){
		echo json_encode(array('success' => '1'));
	} else {
		echo json_encode(array('error' => 'Erro ao mudar status!'));
	}

?>