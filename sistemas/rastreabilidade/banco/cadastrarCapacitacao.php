<?php

include_once("gdb.php"); 

$gdb = new gdb(); 


$tipo         		 = $gdb->vargetpost('tipo');
$assunto     		 = $gdb->vargetpost('assunto');
$secretaria     	 = $gdb->vargetpost('secretaria');
$setor     		     = $gdb->vargetpost('setor');
$solicitante     	 = $gdb->vargetpost('solicitante');
$telefone     		 = $gdb->vargetpost('telefone');
$email     			 = $gdb->vargetpost('email');
$participantes     	 = $gdb->vargetpost('participantes');
$ministrante     	 = $gdb->vargetpost('ministrante');
$local     		     = $gdb->vargetpost('local');
$data				 = $gdb->vargetpost('dataEscolhida');
$horario			 = $gdb->vargetpost('horario');


 if ($data == '') {
 	echo json_encode(array('error' => "Data Inválida"));
 } else {
	if($gdb->open("INSERT INTO capacitacao ( tipo,								 
							 				 assunto, 
											 secretaria,
											 setor,
											 solicitante,
											 telefone,
											 email,
											 participantes,
											 local,
											 ministrante)
										VALUES ( '$tipo',									  
												 '$assunto',
												 '$secretaria',
												 '$setor',
												 '$solicitante',
												 '$telefone',
												 '$email',
												 '$participantes',
												 '$local',
												 '$ministrante')")){
		

		$gdb->open("SELECT max(id) FROM capacitacao");
		$idCapacitacao =  $gdb->gs["MAX(ID)"][0];

		if($gdb->open("INSERT INTO agenda ( idCapacitacao,								 
						 				 data, 
										 horario,
										 descricao)
										VALUES ( '$idCapacitacao',									  
												 '$data',
												 '$horario',
												 '$tipo')")){

	/*	$horario + '01:00' = $horarioDois;	
		if($gdb->open("INSERT INTO agenda ( idCapacitacao,								 
						 				 data, 
										 horario,
										 descricao)
										VALUES ( '$idCapacitacao',									  
												 '$data',
												 '$horarioDois',
												 '$tipo')")){	*/


		echo json_encode(array('success' => 1)); 
	}else {
			echo json_encode(array('error' => "Erro no cadastro"));
		}


	} else {

		echo json_encode(array('error' => "Erro no cadastro"));

	}
 	
}
								 
										 
?>