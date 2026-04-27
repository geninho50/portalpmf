<?php

include_once("gdb.php"); 

$gdb = new gdb();  

$faixaEtaria         = $gdb->vargetpost('faixaEtaria');
$modalidade          = $gdb->vargetpost('modalidade');
$genero              = $gdb->vargetpost('genero');
$idEscola     		 = $gdb->vargetpost('idEscola');

$gdb->open("SELECT modalidade, faixaEtaria, genero, idEscola FROM preEquipe WHERE idEscola = '$idEscola' AND  modalidade = '$modalidade' AND  genero = '$genero' AND  faixaEtaria = '$faixaEtaria'");


if ($gdb->linhas != 0){
	echo json_encode(array('error' => "Esta modalidade já está cadastrada!"));
	} else {

		if($gdb->open("INSERT INTO preEquipe ( faixaEtaria, 	
											 modalidade,								 
											 genero, 
											 idEscola)
											VALUES ( '$faixaEtaria',
													 '$modalidade',									  
													 '$genero',
													 '$idEscola' )")){
			
			echo json_encode(array('success' => 1));

		}else{

			echo json_encode(array('error' => 0));

		}
	 	
	}
					 
										 
?>