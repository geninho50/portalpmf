<?php

include_once("gdb.php"); 

$gdb = new gdb();  


$nome         	 = $gdb->vargetpost('nomeD');
$email			 = $gdb->vargetpost('emailD');
$duvida			 = $gdb->vargetpost('duvida');


	if ($email == '') {
	
		echo json_encode(array('error' => "Erro no cadastro"));

	} else {


	$gdb->open("INSERT INTO duvida ( nome,
									 email,
									 duvida, 
									 situacao )
									VALUES ('$nome',
											'$email',
											'$duvida',
											'não respondido')");	

	echo json_encode(array('success' => 1));

		
	}

								 
										 
?>