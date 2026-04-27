<?php

include_once("gdb.php"); 

$gdb = new gdb();  
$gdb2 = new gdb(); 

$nome         		 = $gdb->vargetpost('nome');
$nascimento          = $gdb->vargetpost('nascimento');
$telefone     		 = $gdb->vargetpost('telefone');
$genero       	     = $gdb->vargetpost('genero');
$estadoCivil     	 = $gdb->vargetpost('estadoCivil');
$cpf     		     = $gdb->vargetpost('cpf');
$rg     		     = $gdb->vargetpost('rg');
$outros     		 = $gdb->vargetpost('outros');
$outrosTipo     	 = $gdb->vargetpost('outrosTipo');
$cep     		     = $gdb->vargetpost('cep');
$logradouro     	 = $gdb->vargetpost('logradouro');
$numero     		 = $gdb->vargetpost('numero');
$complemento         = $gdb->vargetpost('complemento');
$bairro     		 = $gdb->vargetpost('bairro');
$municipio     		 = $gdb->vargetpost('municipio');
$email     		     = $gdb->vargetpost('email');
$gestante     		 = $gdb->vargetpost('gestante');
$especiais     		 = $gdb->vargetpost('especiais');
$horario			 = $gdb->vargetpost('horario');
$data				 = $gdb->vargetpost('dataEscolhida');


$gdb->open("SELECT codigoPessoa FROM procon WHERE cpf = '$cpf' ");
$codigoPessoa =  $gdb->gs["CODIGOPESSOA"][0];


if ($gdb->linhas != 0) {

	if ($gdb->open("INSERT INTO Agenda ( codigoPessoa,
									  data,
									  horario )
									VALUES ('$codigoPessoa', 
											'$data',
											'$horario')")){

		$gdb2->open("UPDATE procon 
			            SET gestante = '$gestante',
						    estadoCivil = '$estadoCivil',
						    especiais = '$especiais',
						    cep = '$cep',     		     
						    logradouro = '$logradouro',    	 
						    numero = '$numero',     		 
						    complemento = '$complemento',        
						    bairro = '$bairro',     		 
						    municipio = '$municipio',     		
						    telefone = '$telefone',
						    email = '$email'
					 WHERE codigoPessoa = '$codigoPessoa' "); 

				echo json_encode(array('success' => 1));

	}	else  {

		echo json_encode(array('error' => "Erro no cadastro"));
	}

	

} else {
			if($gdb->open("INSERT INTO procon ( nome,								 
								 				nascimento, 
												 telefone,
												 genero,
												 estadoCivil,
												 cpf,
												 rg,
												 outrosTipo,
												 outros,
												 cep,
												 logradouro,
												 numero,
												 complemento,
												 bairro,
												 municipio,
												 email,
												 gestante,
												 especiais )
												VALUES ( '$nome',									  
														 '$nascimento',
														 '$telefone',
														 '$genero',
														 '$estadoCivil',
														 '$cpf',
														 '$rg',
														 '$outrosTipo',
														 '$outros',
														 '$cep',
														 '$logradouro',
														 '$numero',
														 '$complemento',
														 '$bairro',
														 '$municipio',
														 '$email',
														 '$gestante',
														 '$especiais')")){

		$gdb->open("SELECT codigoPessoa FROM procon WHERE cpf = '$cpf' ");
		$codigoPessoa =  $gdb->gs["CODIGOPESSOA"][0];

				$gdb->open("INSERT INTO Agenda ( codigoPessoa,
												  data,
												  horario )
												VALUES ('$codigoPessoa', 
														'$data',
														'$horario')");	

				echo json_encode(array('success' => 1));


			} else {

				echo json_encode(array('error' => "Erro no cadastro"));

			}
 	
	}
								 
										 
?>