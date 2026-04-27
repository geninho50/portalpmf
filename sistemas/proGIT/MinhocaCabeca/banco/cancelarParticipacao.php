<?php
	include_once("gdb.php"); 

	$gdb = new gdb();  

    $id_usuario = $gdb->vargetpost('id_usuario');


    if($gdb->cancelarParticipacao($id_usuario)) {
        echo json_encode(array('success' => '1'));    
    } else {
        echo json_encode(array('error' => 'Ocorreu algum problema ao tentar cancelar sua participação.'));    
    }
	
    
?>