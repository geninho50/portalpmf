<?php

include_once("gdb.php"); 

$gdb = new gdb();  

$nome         		 = $gdb->vargetpost('nome');
$cpf           		 = $gdb->vargetpost('cpf');
$email     		     = $gdb->vargetpost('email');
$telefone     		 = $gdb->vargetpost('telefone');
$instituicao         = $gdb->vargetpost('instituicao');
$profissao           = $gdb->vargetpost('profissao');
$datanascimento      = $gdb->vargetpost('datanascimento');
$genero              = $gdb->vargetpost('genero');

$gdb->open("SELECT count(*) as total FROM pessoaAuxiliar WHERE codigoProjeto = 'CMESPORTE' ");

if ($gdb->gs["TOTAL"][0] < 120) {


		$gdb->open("SELECT codigoPessoa FROM pessoa WHERE cpf = '$cpf' ");


		if( $gdb->linhas != 0)  {

				 $codigoPessoa = $gdb->gs["CODIGOPESSOA"][0];
				    
				 $gdb->open("SELECT count(*) as auxiliar 
				 	         FROM pessoaAuxiliar 
				 	         WHERE codigoPessoa  = '$codigoPessoa' 
				 	         AND codigoProjeto = 'CMESPORTE' ");

				 if ($gdb->gs["AUXILIAR"][0] > 0) {
				 	$error = 'Consultamos que já existe um cadastro com esse CPF para a Confência!';
				    echo json_encode(array('success' => 0, 'error' => $error));   
				 }else {

				    $gdb->open("INSERT INTO pessoaAuxiliar (  	
				    									 codigoPessoa,
				    									 codigoprojeto,								 
														 instituicao, 
														 profissao,										
														 genero )
												VALUES  ( 		
														 '$codigoPessoa',							  
														 'CMESPORTE',	
														 '$instituicao',
														 '$profissao',
														 '$genero' )");	
														 
					$gdb->open("SELECT max(codigoPessoaAux) as codigo FROM pessoaAuxiliar");   				
					echo json_encode(array('success' => $gdb->gs["CODIGO"][0] ));													
				}
		}else{ 


			$gdb->open("INSERT INTO pessoa ( nome, 									 
											 cpf, 
											 email,
											 nascimento,
											 telefone )
										VALUES ( '$nome',									  
												 '$cpf', 
												 '$email', 
												 '$datanascimento',
												 '$telefone')");	


		   $gdb->open("SELECT codigoPessoa FROM pessoa WHERE cpf = '$cpf' ");


		   if( $gdb->linhas != 0){
		    
		       $codigoPessoa = $gdb->gs["CODIGOPESSOA"][0];

		       $gdb->open("INSERT INTO pessoaAuxiliar (  	
				    									 codigoPessoa,
				    									 codigoprojeto,								 
														 instituicao, 
														 profissao,										
														 genero )
												VALUES  ( 		
														 '$codigoPessoa',							  
														 'CMESPORTE',	
														 '$instituicao',
														 '$profissao',
														 '$genero' )");	
														 
				$gdb->open("SELECT max(codigoPessoaAux) as codigo FROM pessoaAuxiliar");   				
		    	echo json_encode(array('success' => $gdb->gs["CODIGO"][0] ));	
			} else {
				$error = 'Erro na gravação na tabela pessoa';
			    echo json_encode(array('success' => 0, 'error' => $error));   
			}

		}		

}else{
	$error = 'Vagas esgotadas!';
	echo json_encode(array('success' => 188, 'error' => $error));   
}							 
										 
?>