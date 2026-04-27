<?php

include_once("gdb.php"); 

$gdb = new gdb();  


$motivo         	 = $gdb->vargetpost('motivo');
$horario			 = $gdb->vargetpost('horarioOFF');
$data				 = $gdb->vargetpost('dataOFF');


	if ($horario == 'inteiro') {
	
$gdb->open("INSERT INTO agenda (idCapacitacao, data, horario, descricao) VALUES ('0', '$data', '08:00:00', '$motivo'), ('0', '$data', '09:00:00', '$motivo'), 
('0', '$data', '10:00:00', '$motivo' ), ('0', '$data', '11:00:00', '$motivo' ), ('0', '$data', '12:00:00', '$motivo'), 
('0', '$data', '13:00:00', '$motivo'),  ('0', '$data', '14:00:00', '$motivo'), ('0', '$data', '15:00:00', '$motivo'), 
('0', '$data', '16:00:00', '$motivo'),  ('0', '$data', '17:00:00', '$motivo'), ('0', '$data', '18:00:00', '$motivo')");

echo json_encode(array('success' => 1));

	} else {


	$gdb->open("INSERT INTO agenda ( idCapacitacao,
									  data,
									  horario,
									  descricao )
									VALUES ('0', 
											'$data',
											'$horario',
											'$motivo')");	

	echo json_encode(array('success' => 1));

		
	}

								 
										 
?>