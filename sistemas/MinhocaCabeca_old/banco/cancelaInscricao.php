<?php
	include_once("gdb.php"); 

	$gdb = new gdb(); 

	$id_pessoa= $gdb->vargetpost('id_pessoa');
	$id_evento_pessoa = $gdb->vargetpost('id_evento');

	if($gdb->cancelarEvento($id_pessoa,$id_evento_pessoa)) {
        echo json_encode(array('success' => '1'));    
    } else {
        echo json_encode(array('error' => 'Ocorreu algum problema ao cancelar a inscrição.'));    
    }
	
    
?>