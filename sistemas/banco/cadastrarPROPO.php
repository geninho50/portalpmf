<?php

include_once("gdb.php"); 

$gdb = new gdb();  

$nome         		 = $gdb->vargetpost('nome');
$instituicao         = $gdb->vargetpost('instituicao');
$email     		     = $gdb->vargetpost('email');
$telefone     		 = $gdb->vargetpost('telefone');
$divisao       	     = $gdb->vargetpost('divisao');
$proposta            = $gdb->vargetpost('proposta');
$descricao           = $gdb->vargetpost('descricao');
$justificativa       = $gdb->vargetpost('justificativa');



	$gdb->open("INSERT INTO saneamento ( nome, 									 
										 instituicao, 
										 email,
										 telefone,
										 divisao,
										 proposta,
										 descricao,
										 justificativa )
									VALUES ( '$nome',									  
											 '$instituicao',
											 '$email', 
											 '$telefone',
											 '$divisao',
											 '$proposta',
											 '$descricao',
											 '$justificativa')");	



 	echo json_encode(array('success' => 1));

								 
										 
?>