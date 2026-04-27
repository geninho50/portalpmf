<?php

include_once("gdb.php"); 

$gdb = new gdb();  

$nome         		 = $gdb->vargetpost('nome');
$cpf         		 = $gdb->vargetpost('cpf');
$email     		     = $gdb->vargetpost('email');
$telefone     		 = $gdb->vargetpost('telefone');
$entidade       	 = $gdb->vargetpost('entidade');
$artigo     	     = $gdb->vargetpost('artigo');
$sugestao            = $gdb->vargetpost('sugestao');
$justificativa       = $gdb->vargetpost('justificativa');



	if ($gdb->open("INSERT INTO consultaPublica ( nome, 									 
										 cpf, 
										 email,
										 telefone,
										 entidade,
										 artigo,
										 sugestao,
										 justificativa )
									VALUES ( '$nome',									  
											 '$cpf',
											 '$email', 
											 '$telefone',
											 '$entidade',
											 '$artigo',
											 '$sugestao',
											 '$justificativa')")){



 	echo json_encode(array('success' => 1));

 		} else{

		echo json_encode(array('error' => "Erro no cadastro."));

		}		

								 
										 
?>