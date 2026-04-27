<?php
	include_once("gdb.php"); 

	$gdb = new gdb();  

    $id_evento = $gdb->vargetpost('id_evento');

    if($gdb->excluirEvento($id_evento)) {
        echo json_encode(array('success' => '1'));    
    } else {
        echo json_encode(array('error' => 'Ocorreu algum problema ao excluir o evento.'));    
    }
    
?>