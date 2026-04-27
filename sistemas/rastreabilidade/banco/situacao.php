<?php

include_once("gdb.php"); 

$gdb = new gdb();  

$idsolicitacao       = $gdb->vargetpost('idsolicitacao');
$situacao     		 = $gdb->vargetpost('situacao');


	if($gdb->open("UPDATE solicitacao_capacitacao 
			            SET situacao = '$situacao'
					 WHERE idsolicitacao = '$idsolicitacao' ")){ 

	echo json_encode(array('success' => 1));

	}	else  {

		echo json_encode(array('error' => "Erro no cadastro"));
	}
 	
	
								 
										 
?>