<?php

include_once("gdb.php"); 

$gdb = new gdb();  

$nome         		 = $gdb->vargetpost('nome');
$cpf         		 = $gdb->vargetpost('cpf');
$email     		     = $gdb->vargetpost('email');
$telefone     		 = $gdb->vargetpost('telefone');
$empresa       	     = $gdb->vargetpost('empresa');
$cep            	 = $gdb->vargetpost('cep');
$logradouro          = $gdb->vargetpost('logradouro');
$numero      		 = $gdb->vargetpost('numero');
$bairro      		 = $gdb->vargetpost('bairro');
$municipio      	 = $gdb->vargetpost('municipio');
$anexo1      		 = $gdb->vargetpost('anexo1');
$anexo2      		 = $gdb->vargetpost('anexo2');
$anexo3      		 = $gdb->vargetpost('anexo3');



	if ($gdb->open("INSERT INTO audienciaJurere ( nome, 									 
										 cpf, 
										 email,
										 telefone,
										 empresa,
										 cep,
										 endereco,
										 numero,
										 bairro,
										 municipio,
										 anexo1,
										 anexo2,
										 anexo3 )
									VALUES ( '$nome',									  
											 '$cpf',
											 '$email', 
											 '$telefone',
											 '$empresa',
											 '$cep',
											 '$logradouro',
											 '$numero',
											 '$bairro',
											 '$municipio',
											 '$anexo1',
											 '$anexo2',
											 '$anexo3')")){



 	echo json_encode(array('success' => 1));

 		} else{

		echo json_encode(array('error' => "Erro na inclusão."));

		}		

								 
										 
?>