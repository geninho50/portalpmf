<?php

include_once("gdb.php"); 

$gdb = new gdb();  

$nome         		 = $gdb->vargetpost('nome');
$cpf         		 = $gdb->vargetpost('cpf');
$email     		     = $gdb->vargetpost('email');
$telefone1     		 = $gdb->vargetpost('telefone1');
$telefone2     		 = $gdb->vargetpost('telefone2');
$email       	     = $gdb->vargetpost('email');
$dia      			 = $gdb->vargetpost('dia');
$horario      		 = $gdb->vargetpost('horario');
$protocolo      	 = $gdb->vargetpost('protocolo');
$logradouro          = $gdb->vargetpost('logradouro');
$numero      		 = $gdb->vargetpost('numero');
$bairro      		 = $gdb->vargetpost('bairro');
$cep            	 = $gdb->vargetpost('cep');
$municipio      	 = $gdb->vargetpost('municipio');
$complemento      	 = $gdb->vargetpost('complemento');

		if ($gdb->open("INSERT INTO seliganarede ( nome, 									 
											 cpf, 
											 email,
											 telefone1,
											 telefone2,
											 dia,
											 horario,
											 protocolo,
											 logradouro,
											 numero,
											 bairro,	
											 cep,
											 municipio,
											 complemento )
									VALUES ( '$nome',									  
											 '$cpf',
											 '$email', 
											 '$telefone1',
											 '$telefone2',
											 '$dia',									 
											 '$horario',
											 '$protocolo',
											 '$logradouro',
											 '$numero',
											 '$bairro',
											 '$cep',
											 '$municipio',
											 '$complemento')")){

			echo json_encode(array('success' => 1));

		} else{

		echo json_encode(array('error' => "CPF já cadastrado."));

		}								 
?>