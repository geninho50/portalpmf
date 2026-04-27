<?php
	include_once("gdb.php"); 

	$gdb = new gdb(); 

	$id_pessoa= $gdb->vargetpost('id_pessoa');
	$id_evento = $gdb->vargetpost('id_evento');
	


	if($gdb->inscricaoEvento($id_pessoa,$id_evento)) {
        echo json_encode(array('success' => '1'));    
    } else {
        echo json_encode(array('error' => 'Ocorreu algum problema ao concluir seu cadastro.'));    
    }
	
    
?>