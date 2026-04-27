<?php
	include_once("gdb.php"); 

	$gdb = new gdb();  

    $id_pessoa = $gdb->vargetpost('id_pessoa');
	$email = $gdb->vargetpost('email');
	$telefone = $gdb->vargetpost('telefone');
	$celular = $gdb->vargetpost('celular');
    $profissao = $gdb->vargetpost('profissao');
    $numero = $gdb->vargetpost('numero');
    $complemento = $gdb->vargetpost('complemento');
    $quantidade_pessoa = $gdb->vargetpost('quantidade_pessoa');
    $id_endereco = $gdb->vargetpost('id_endereco');
    $cep = $gdb->vargetpost('cep');
    $logradouro = $gdb->vargetpost('logradouro');
    $bairro = $gdb->vargetpost('bairro');


    if($gdb->editarParticipante($id_pessoa,$email,$telefone,$celular,$profissao,$numero,$complemento,$quantidade_pessoa,$id_endereco,$cep,$logradouro,$bairro)) {
        echo json_encode(array('success' => '1'));    
    } else {
        echo json_encode(array('error' => 'Ocorreu algum problema ao editar.'));    
    }
	
    
?>