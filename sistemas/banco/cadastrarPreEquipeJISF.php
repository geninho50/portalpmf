<?php

include_once("gdb.php"); 

$gdb = new gdb();  

$modalidade          = $gdb->vargetpost('modalidade');
$genero              = $gdb->vargetpost('genero');
$equipe              = $gdb->vargetpost('equipe');
$idSecretaria     	 = $gdb->vargetpost('idSecretaria');

$gdb->open("SELECT modalidade, genero, equipe, idSecretaria FROM preEquipeJISF WHERE idSecretaria = '$idSecretaria' AND  modalidade = '$modalidade' AND  genero = '$genero' AND equipe = '$equipe'");

if ($gdb->linhas != 0){
	echo json_encode(array('error' => "Esta modalidade ja esta cadastrada!"));
	} else {

		if($gdb->open("INSERT INTO preEquipeJISF (modalidade,								 
											 genero, 
											 equipe,
											 idSecretaria)
											VALUES ( '$modalidade',									  
													 '$genero',
													 '$equipe',
													 '$idSecretaria' )")){
			
			echo json_encode(array('success' => 1));

		}else{

			echo json_encode(array('error' => 0));

		}
	 	
	}
					 
										 
?>