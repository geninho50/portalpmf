<?php
	include_once("gdb.php"); 

	$gdb = new gdb();  

	$id_usuario_admin = $gdb->vargetpost('id_usuario_admin');
	$senha = $gdb->vargetpost('senha');

    if($gdb->editarAdminSenha($id_usuario_admin,md5($senha))) {
        echo json_encode(array('success' => '1'));    
    } else {
        echo json_encode(array('error' => 'Ocorreu algum problema ao editar seus dados.'));    
    }
	
    
?>