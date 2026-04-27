<?php
include_once("gdb.php");          

$gdb = new gdb();

$cpf = $gdb->vargetpost('cpf');

$gdb->open("SELECT idcursos FROM inscritos WHERE cpf = '$cpf'");

if ($gdb->linhas != 0) {
	echo json_encode(array('success' => 1, 'idcurso' => $gdb->gs["IDCURSOS"][0]));
} else {
	echo json_encode(array('success' => 0));	  	
}

?>