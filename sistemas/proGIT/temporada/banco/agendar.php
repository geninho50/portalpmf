<?php

  error_reporting(E_ALL);
  ini_set('display_errors', '0');

  include_once("gdb.php");          
		
  $gdb    = new gdb();
  $gdb1   = new gdb();
  $gdb2   = new gdb();
   
  $idcursos    = $gdb->vargetpost('idcursos');
  $cpf         = $gdb->vargetpost('cpf');


$gdb1->open("SELECT vagas FROM cursos WHERE idcursos = '$idcursos' ");
$numeroVagas =  $gdb1->gs["VAGAS"][0];


$gdb2->open("SELECT NUM FROM login WHERE documento = '$cpf' ");
$idPessoa =  $gdb2->gs["NUM"][0];
  

$gdb->open("SELECT count(idcursos) FROM inscritos WHERE idcursos = '$idcursos' ");
 		
 		if($gdb->linhas < $numeroVagas) {	

	 			if($gdb->open("SELECT cpf FROM inscritos WHERE cpf = '$cpf' ") ){

	 				if($gdb->linhas == 0) {

	 				$gdb->open("INSERT INTO inscritos (cpf, idcursos) 
	 								              VALUES ('$cpf', '$idcursos') "); 

	 					echo json_encode(array('success' => 1, 'cpf' => $cpf, 'idcurso' => $idcursos));	

		 			} else {
		 				echo json_encode(array('error' => "CPF já inscrito na oficina."));
		 			}

	 			} else {
	 				echo json_encode(array('error' => "Erro no cadastro."));
	 			}

	 	} else {
	 		echo json_encode(array('error' => "Vagas Esgotadas para este dia!"));
	 	}

?>