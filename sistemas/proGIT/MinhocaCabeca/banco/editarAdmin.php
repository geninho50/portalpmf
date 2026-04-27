<?php
	include_once("gdb.php"); 

	$gdb = new gdb();  

	$id_usuario_admin = $gdb->vargetpost('id_usuario_admin');
    $email_admin = $gdb->vargetpost('email_admin');
	$telefone = $gdb->vargetpost('telefone');
	$celular = $gdb->vargetpost('celular');
	$cargo = $gdb->vargetpost('cargo');
	$setor = $gdb->vargetpost('setor');

    if($gdb->editarAdmin($id_usuario_admin,$email_admin,$telefone,$celular,$cargo,$setor)) {
        echo json_encode(array('success' => '1'));    
    } else {
        echo json_encode(array('error' => 'Ocorreu algum problema ao editar seus dados.'));    
    }
	
    
?>