<?php

include_once("gdb.php"); 

$gdb = new gdb();  


$motivo         	 = $gdb->vargetpost('motivo');
$horario			 = $gdb->vargetpost('horario');
$data				 = $gdb->vargetpost('dataEscolhida');


$gdb->open("SELECT data, codigoPessoa FROM Agenda WHERE data = '$data' AND  codigoPessoa = '1'");
$codigoPessoa =  $gdb->gs["CODIGOPESSOA"][0];

if($gdb->linhas == 18 AND $codigoPessoa == 1){	

	echo json_encode(array('error' => "Esta data já esta sendo usada"));
	
} else {

	if ($horario == 'inteiro') {
	
$gdb->open("INSERT INTO Agenda (codigoPessoa, data, horario, motivo) VALUES ('1', '$data', '09:00:00', '$motivo'), ('1', '$data', '09:30:00', '$motivo' ), 
('1', '$data', '10:00:00', '$motivo' ), ('1', '$data', '10:30:00', '$motivo' ), ('1', '$data', '11:00:00', '$motivo' ), 
('1', '$data', '11:30:00', '$motivo'), ('1', '$data', '12:00:00', '$motivo'), ('1', '$data', '12:30:00', '$motivo'), 
('1', '$data', '13:00:00', '$motivo'), ('1', '$data', '13:30:00', '$motivo'), ('1', '$data', '14:00:00', '$motivo'), 
('1', '$data', '14:30:00', '$motivo'), ('1', '$data', '15:00:00', '$motivo'), ('1', '$data', '15:30:00', '$motivo'), 
('1', '$data', '16:00:00', '$motivo'), ('1', '$data', '16:30:00', '$motivo'), ('1', '$data', '17:00:00', '$motivo'), 
('1', '$data', '17:30:00', '$motivo')");

echo json_encode(array('success' => 1));

	} else {


	$gdb->open("INSERT INTO Agenda ( codigoPessoa,
									  data,
									  horario,
									  motivo )
									VALUES ('1', 
											'$data',
											'$horario',
											'$motivo')");	

	echo json_encode(array('success' => 1));

		
	}

	
}
								 
										 
?>