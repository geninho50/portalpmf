<?php
	include_once("gdb.php"); 

    $gdb = new gdb();  
    
    $nome = $gdb->vargetpost('nome');
    $cpf = $gdb->vargetpost('cpf');
    $email_admin = $gdb->vargetpost('email_admin');
    $telefone = $gdb->vargetpost('telefone');
    $celular = $gdb->vargetpost('celular');
    $cargo = $gdb->vargetpost('cargo');
    $setor = $gdb->vargetpost('setor');
    $senha = $gdb->vargetpost('senha');

    if($gdb->cadastrarAdmin($nome,$cpf,$email_admin,$telefone,$celular,$cargo,$setor,md5($senha))) {
        echo json_encode(array('success' => '1'));    
    } else {
        echo json_encode(array('error' => 'Ocorreu algum problema ao concluir seu cadastro.'));    
    }
	
    
?>