<?php

include_once("gdb.php"); 

$gdb = new gdb();  

$p1     			= $gdb->vargetpost('p1');
$p2       	 		= $gdb->vargetpost('p2');
$p3          		= $gdb->vargetpost('p3');
$situacao    		= $gdb->vargetpost('situacao');
$bairro      		= $gdb->vargetpost('bairro');
$p6          		= $gdb->vargetpost('p6');
$p7					= $gdb->vargetpost('p7');
$p8					= $gdb->vargetpost('p8');
$email				= $gdb->vargetpost('email');
$receberEmailSim	= $gdb->vargetpost('receberEmailSim');
$percepcao1			= $gdb->vargetpost('percepcao1');
$percepcao2			= $gdb->vargetpost('percepcao2');
$percepcao3			= $gdb->vargetpost('percepcao3');
$percepcao4			= $gdb->vargetpost('percepcao4');
$percepcao5			= $gdb->vargetpost('percepcao5');
$percepcao6			= $gdb->vargetpost('percepcao6');
$percepcao7			= $gdb->vargetpost('percepcao7');
$percepcao8			= $gdb->vargetpost('percepcao8');
$percepcao9			= $gdb->vargetpost('percepcao9');
$percepcao10		= $gdb->vargetpost('percepcao10');
$percepcao11		= $gdb->vargetpost('percepcao11');
$percepcao12		= $gdb->vargetpost('percepcao12');
$percepcao13		= $gdb->vargetpost('percepcao13');
$percepcao14		= $gdb->vargetpost('percepcao14');
$percepcao15		= $gdb->vargetpost('percepcao15');



if($gdb->open("INSERT INTO pmma (p1,								 
								 p2, 
								 p3,
								 situacao,
								 bairro,
								 p6,
								 p7,
								 p8, 
								 email,
								 receberEmailSim,
								 percepcao1,
								 percepcao2,
								 percepcao3,
								 percepcao4,
								 percepcao5,
								 percepcao6,
								 percepcao7,
								 percepcao8,
								 percepcao9,
								 percepcao10,
								 percepcao11,
								 percepcao12,
								 percepcao13,
								 percepcao14,
								 percepcao15)
								VALUES ( '$p1',									  
										 '$p2',
										 '$p3',
										 '$situacao',
										 '$bairro',
										 '$p6',
										 '$p7',
										 '$p8',
										 '$email',
										 '$receberEmailSim',
										 '$percepcao1',
										 '$percepcao2',
										 '$percepcao3',
										 '$percepcao4',
										 '$percepcao5',
										 '$percepcao6',
										 '$percepcao7',
										 '$percepcao8',
										 '$percepcao9',
										 '$percepcao10',
										 '$percepcao11',
										 '$percepcao12',
										 '$percepcao13',
										 '$percepcao14',
										 '$percepcao15')")){
		
				echo json_encode(array('success' => 1));

			} else {

				echo json_encode(array('error' => 0));

			}

?>