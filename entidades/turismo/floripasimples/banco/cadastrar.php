<?php

include_once("gdb.php"); 

$gdb = new gdb(); 


$nome         		 = $gdb->vargetpost('nome');
$cpf     		     = $gdb->vargetpost('cpf');
$cnpj     	 		 = $gdb->vargetpost('cnpj');
$empresa     		 = $gdb->vargetpost('empresa');
$telefone     		 = $gdb->vargetpost('telefone');
$email     	         = $gdb->vargetpost('email');
$pais     		     = $gdb->vargetpost('pais');
$assunto     	     = $gdb->vargetpost('assunto');
$sugestao     	     = $gdb->vargetpost('sugestao');


 if ($sugestao == '' OR $email == '' OR $pais == '') {

 	echo json_encode(array('error' => "Campo em branco!"));

 } else {

	if($gdb->open("INSERT INTO consulta ( nome,								 
						 				  cpf, 
										  cnpj,
										  empresa,
										  email,
										  pais,
										  assunto,
										  sugestao,
										  telefone)
										VALUES ( '$nome',									  
												 '$cpf',
												 '$cnpj',
												 '$empresa',
												 '$email',
												 '$pais',
												 '$assunto',
												 '$sugestao',
												 '$telefone')")){
		

		echo json_encode(array('success' => 1)); 

	}	else {

			echo json_encode(array('error' => "Erro no cadastro"));
		}


	} 
 									 
										 
?>