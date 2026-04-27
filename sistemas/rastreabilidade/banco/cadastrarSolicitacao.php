<?php

include_once("gdb.php"); 

$gdb = new gdb();  

$nome         		 = $gdb->vargetpost('nome');
$cpf     		     = $gdb->vargetpost('cpf');
$email     		     = $gdb->vargetpost('email');
$telefone     		 = $gdb->vargetpost('telefone');
$secretaria     	 = $gdb->vargetpost('secretaria');
$setor     		 	 = $gdb->vargetpost('setor');
$participantes     	 = $gdb->vargetpost('participantes');
$horario			 = $gdb->vargetpost('horario');
$data				 = $gdb->vargetpost('dataEscolhida');


	if($gdb->open("INSERT INTO solicitacao_capacitacao ( nome,								 
										 				 cpf, 
														 email,
														 telefone,
														 secretaria,
														 setor,
														 participantes,
														 data,
														 horario)
										VALUES ( '$nome',									  
												 '$cpf',
												 '$email',
												 '$telefone',
												 '$secretaria',
												 '$setor',
												 '$participantes',
												 '$data',
												 '$horario')")){


		echo json_encode(array('success' => 1));


	} else {

		echo json_encode(array('error' => "Erro no cadastro"));

	}
 	
	
								 
										 
?>