<?php

include_once("gdb.php"); 

$gdb = new gdb();  

$nome         		 = $gdb->vargetpost('nome');
$cpf         		 = $gdb->vargetpost('cpf');
$email     		     = $gdb->vargetpost('email');
$regiao     		 = $gdb->vargetpost('regiao');
$cep       	 		 = $gdb->vargetpost('cep');
$logradouro     	 = $gdb->vargetpost('logradouro');
$numero              = $gdb->vargetpost('numero');
$complemento         = $gdb->vargetpost('complemento');
$bairro         	 = $gdb->vargetpost('bairro');
$problema         	 = $gdb->vargetpost('problema');
$sugestao         	 = $gdb->vargetpost('sugestao');
$justificativa       = $gdb->vargetpost('justificativa');



	if ($gdb->open("INSERT INTO consultaSaneamento ( nome, 									 
										 cpf, 
										 email,
										 regiao,
										 cep,
										 logradouro,
										 numero,
										 complemento,
										 bairro,
										 problema,
										 sugestao,
										 justificativa )
									VALUES ( '$nome',									  
											 '$cpf',
											 '$email', 
											 '$regiao',
											 '$cep',
											 '$logradouro',
											 '$numero',
											 '$complemento',
											 '$bairro',
											 '$problema',
											 '$sugestao',
											 '$justificativa')")){



 	echo json_encode(array('success' => 1));

 		} else{

		echo json_encode(array('error' => "Erro no cadastro."));

		}		

								 
										 
?>