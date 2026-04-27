<?php

include_once("gdb.php"); 

$gdb = new gdb(); 


$nome         		 = $gdb->vargetpost('nome');
$cpf     			 = $gdb->vargetpost('cpf');
$email     	 		 = $gdb->vargetpost('email');
$carga     	 		 = $gdb->vargetpost('carga');
$idCapacitacao     	 = $gdb->vargetpost('idCapacitacao');


/* $gdb->open("SELECT cpf FROM lista where cpf = '$cpf'");*/


	if($gdb->open("INSERT INTO lista (  nome,								 
						 				 cpf, 
										 email,
										 carga,
										 idCapacitacao )
									VALUES ( '$nome',									  
											 '$cpf',
											 '$email',
											 '$carga',
											 '$idCapacitacao' )")){

			echo json_encode(array('success' => 1)); 

	} else {

		echo json_encode(array('error' => "CPF já cadastrado"));

		}
									 
										 
?>