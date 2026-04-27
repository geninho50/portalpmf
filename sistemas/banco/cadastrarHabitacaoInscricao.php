<?php

include_once("gdb.php"); 

$gdb = new gdb();  

$nome         		 = $gdb->vargetpost('nome');
$nascimento          = $gdb->vargetpost('nascimento');
$cpf         		 = $gdb->vargetpost('cpf');
$email     		     = $gdb->vargetpost('email');
$telefone     		 = $gdb->vargetpost('telefone');
$instituicao       	 = $gdb->vargetpost('instituicao');
$comunidade     	 = $gdb->vargetpost('comunidade');
$bairro              = $gdb->vargetpost('bairro');
$regiao         	 = $gdb->vargetpost('regiao');
$segmento         	 = $gdb->vargetpost('segmento');


$gdb->open("SELECT cpf FROM inscricaoHabitacao WHERE cpf = '$cpf'");

 if( $gdb->linhas == 0){

 	if ($gdb->open("INSERT INTO inscricaoHabitacao ( nome, 	
										 nascimento,								 
										 cpf, 
										 email,
										 telefone,
										 instituicao,
										 comunidade,
										 bairro,
										 regiao,
										 segmento )
									VALUES ( '$nome',	
											 '$nascimento',								  
											 '$cpf',
											 '$email', 
											 '$telefone',
											 '$instituicao',
											 '$comunidade',
											 '$bairro',
											 '$regiao',
											 '$segmento')")){



 			echo json_encode(array('success' => 1));

 		} else {

		echo json_encode(array('error' => "Erro no cadastro."));

		}		

 } else {

 	 echo json_encode(array('error' => "CPF já inscrito na Conferência!"));

 }
							 
										 
?>