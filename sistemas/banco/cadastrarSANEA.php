<?php

include_once("gdb.php"); 

$gdb = new gdb();  

$nome         		 = $gdb->vargetpost('nome');
$cpf           		 = $gdb->vargetpost('cpf');
$email     		     = $gdb->vargetpost('email');
$telefone     		 = $gdb->vargetpost('telefone');
$municipio       	 = $gdb->vargetpost('municipio');
$instituicao         = $gdb->vargetpost('instituicao');
$segmento            = $gdb->vargetpost('segmento');
$telefone2           = $gdb->vargetpost('telefone2');
$outros              = $gdb->vargetpost('outros');
$nascimento          = $gdb->vargetpost('nascimento');


$gdb->open("SELECT codigoPessoa FROM pessoa WHERE cpf = '$cpf' ");


if( $gdb->linhas != 0)  {

		 $codigoPessoa = $gdb->gs["CODIGOPESSOA"][0];
		    
		 $gdb->open("SELECT count(*) as auxiliar 
		 	         FROM pessoaAuxiliar 
		 	         WHERE codigoPessoa  = '$codigoPessoa' 
		 	         AND codigoProjeto = 'SANEA' ");

		 if ($gdb->gs["AUXILIAR"][0] > 0) {
		 	$gdb->open("UPDATE pessoa SET nascimento='$nascimento' WHERE  codigoPessoa  = '$codigoPessoa' ");
		 	$error = 'Consultamos que já existe um cadastro com esse CPF para a Confência!';
		    echo json_encode(array('success' => 0, 'error' => $error));   
		 }else {

		    $gdb->open("INSERT INTO pessoaAuxiliar (  	
		    									 codigoPessoa,
		    									 codigoprojeto,								 
												 instituicao, 
												 municipio2, 
												 segmento,
												 telefone2,
												 email2,
												 outros )
										VALUES  ( 		
												 '$codigoPessoa',							  
												 'SANEA',	
												 '$instituicao',
												 '$municipio',
												 '$segmento',
												 '$telefone2',
												 '$email2',
												 '$outros' )");	
										
			echo json_encode(array('success' => 1));
		}
}else{ 


	$gdb->open("INSERT INTO pessoa ( nome, 									 
									 cpf, 
									 email,
									 telefone,
									 nascimento )
								VALUES ( '$nome',									  
										 '$cpf', 
										 '$email', 
										 '$telefone',
										 '$nascimento')");	


   $gdb->open("SELECT codigoPessoa FROM pessoa WHERE cpf = '$cpf' ");


   if( $gdb->linhas != 0){
    
       $codigoPessoa = $gdb->gs["CODIGOPESSOA"][0];

       $gdb->open("INSERT INTO pessoaAuxiliar ( codigoPessoa,
												codigoprojeto,								 
												instituicao, 
												municipio2, 
												segmento,
												telefone2,
												outros )
									   VALUES  ('$codigoPessoa',							  
												'SANEA',	
												'$instituicao',
												'$municipio',
												'$segmento',
												'$telefone2',
												'$outros' )");	
    	echo json_encode(array('success' => 1));	
	} else {
		$error = 'Erro na gravação na tabela pessoa';
	    echo json_encode(array('success' => 0, 'error' => $error));   
	}

}									 
										 
?>