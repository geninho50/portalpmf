<?php

include_once("gdb.php"); 

$gdb = new gdb();  

$cpf				 = $gdb->vargetpost('cpf');
$pergunta1         	 = $gdb->vargetpost('pergunta1');
$pergunta2			 = $gdb->vargetpost('pergunta2');
$pergunta3			 = $gdb->vargetpost('pergunta3');
$pergunta4			 = $gdb->vargetpost('pergunta4');
$pergunta5			 = $gdb->vargetpost('pergunta5');




	if ($cpf == '') {
	
		echo json_encode(array('error' => "Erro no cadastro"));

	} else {

		$gdb->open("SELECT cpf FROM avaliacao WHERE cpf = '$cpf' ");

		if ($gdb->linhas == '') {

			$gdb->open("INSERT INTO avaliacao (  cpf, 
												 pergunta1,
												 pergunta2,
												 pergunta3, 
												 pergunta4,
												 pergunta5 )
												VALUES ('$cpf',
														'$pergunta1',
														'$pergunta2',
														'$pergunta3',
														'$pergunta4',
														'$pergunta5')");	

			echo json_encode(array('success' => 1));

				
			} else {
				echo json_encode(array('error' => "Você já encaminhou a sua avaliação!"));
			}

	}
								 
										 
?>