<?php
	include_once("gdb.php"); 

	$gdb = new gdb();  

    $id_pessoa = $gdb->vargetpost('id_pessoa');
    $senha = $gdb->vargetpost('senha');


    if($gdb->editarSenha($id_pessoa,md5($senha))) {
        echo json_encode(array('success' => '1'));    
    } else {
        echo json_encode(array('error' => 'Ocorreu algum problema ao editar a senha.'));    
    }
	
    
?>