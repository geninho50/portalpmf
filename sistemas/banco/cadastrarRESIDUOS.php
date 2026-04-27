<?php

include_once("gdb.php"); 

$gdb = new gdb();  
 

$nome         		 = $gdb->vargetpost('nome');
$cpf         		 = $gdb->vargetpost('cpf');
$nascimento          = $gdb->vargetpost('nascimento');
$telefone     		 = $gdb->vargetpost('telefone');
$email     		     = $gdb->vargetpost('email');
$instituicao       	 = $gdb->vargetpost('instituicao');


	$gdb->open("SELECT codigoPessoa FROM pessoa WHERE cpf = '$cpf'");



if ($gdb->linhas != 0) {
	
	$codigoPessoa = $gdb->gs['CODIGOPESSOA'][0];	

	$gdb->open("SELECT * from pessoa whre cpf = '$cpf'
				AND nascimento is null");

	if ($gdb->linhas != 0) {
		$gdb->open("UPDATE pessoa set nascimento = '$nascimento' where cpf = '$cpf'");
	}

	$gdb->open("INSERT INTO pessoaAuxiliar ( codigoProjeto,
										  codigoPessoa,	
										  instituicao )
										VALUES ('RESIDUO', 
												'$codigoPessoa',
												'$instituicao')");	

		echo json_encode(array('success' => 1));

} else {

	if($gdb->open("INSERT INTO pessoa (	 nome,								 
										 cpf, 
										 nascimento,
										 telefone,
										 email )
										VALUES ( '$nome',
												 '$cpf',									  
												 '$nascimento',
												 '$telefone',
												 '$email')") ) {



		$gdb->open("SELECT codigoPessoa FROM pessoa WHERE cpf = '$cpf' ");
		$codigoPessoa = $gdb->gs['CODIGOPESSOA'][0];	
		

		$gdb->open("INSERT INTO pessoaAuxiliar ( codigoProjeto,
										  codigoPessoa,	
										  instituicao )
										VALUES ('RESIDUO', 
												'$codigoPessoa',
												'$instituicao')");	

		echo json_encode(array('success' => 1));

	} else {

		echo json_encode(array('error' => 0));

	}
 	
}
							 
										 
?>