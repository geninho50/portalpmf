<?php
	include_once("gdb.php"); 

	$gdb = new gdb();  

    $cpf = $gdb->vargetpost('cpf');
	$nome = $gdb->vargetpost('nome');
	$rg = $gdb->vargetpost('rg');
	$data_nascimento = $gdb->vargetpost('data_nascimento');
	$email = $gdb->vargetpost('email');
	$telefone = $gdb->vargetpost('telefone');
	$celular = $gdb->vargetpost('celular');
    $profissao = $gdb->vargetpost('profissao');
    $numero = $gdb->vargetpost('numero');
    $complemento = $gdb->vargetpost('complemento');
    $quantidade_pessoa = $gdb->vargetpost('quantidade_pessoa');
    $cep = $gdb->vargetpost('cep');
    $logradouro = $gdb->vargetpost('logradouro');
    $bairro = $gdb->vargetpost('bairro');
    $cidade = $gdb->vargetpost('cidade');
    $senha = $gdb->vargetpost('senha');
    $id_evento = $gdb->vargetpost('id_evento');

    
    $retorno = $gdb->cadastrarParticipante($cpf,$nome,$rg,$data_nascimento,$email,$telefone,$celular,$profissao,$numero,$complemento,$quantidade_pessoa,$cep,$logradouro,$bairro,$cidade,md5($senha),$id_evento);

    if( $retorno == 1 ) {
        echo json_encode(array('success' => '1'));    
    }else if( $retorno == 2 ){
        echo json_encode( array('error' => 'Já existe uma pessoa cadastrada com este CPF !') );    
    }else if( $retorno == 3 ){
        echo json_encode( array('error' => 'Já existe uma pessoa cadastrada com este EMAIL !') );    
    }else{
        echo json_encode( array('error' => 'Já existe uma pessoa cadastrada com esta Identidade !') );    
    } 
	
    
?>