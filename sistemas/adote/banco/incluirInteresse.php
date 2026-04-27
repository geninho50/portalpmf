<?php
	include_once("gdb.php"); 

	$gdb = new gdb();  

    $idAnimal = $gdb->vargetpost('id_animal');
	$nome_pessoa = $gdb->vargetpost('nome_pessoa');
	$cpf = $gdb->vargetpost('cpf');
	$telefone = $gdb->vargetpost('telefone');
	$celular = $gdb->vargetpost('celular');
	$email = $gdb->vargetpost('email');
	$cep = $gdb->vargetpost('cep');
    $endereco = $gdb->vargetpost('endereco');
    $bairro = $gdb->vargetpost('bairro');
    $numero = $gdb->vargetpost('numero');
    $complemento = $gdb->vargetpost('complemento');
    $ip_interesse = $gdb->vargetpost('ip_interesse');
    $aceite = $gdb->vargetpost('aceite');

    if($gdb->incluirInteresse($idAnimal, $nome_pessoa, $cpf, $telefone, $celular, $email, $cep, $endereco, $bairro, $numero, $complemento, $ip_interesse, $aceite)) {
        echo json_encode(array('success' => '1'));    
    } else {
        echo json_encode(array('error' => 'Ocorreu algum problema ao incluir seu interesse de adoção.'));    
    }
	
    
?>