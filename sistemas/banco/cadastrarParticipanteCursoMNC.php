<?php
include_once("gdb.php"); 

$gdb = new gdb(); 

$codigoTurma = $gdb->vargetpost('codigoTurma');
$codigoPessoa = $gdb->vargetpost('codigoPessoa');

if($gdb->open("INSERT INTO eventoInscricao (codigoInscricao, codigoTurma, codigoPessoa, tipo) VALUES (default, $codigoTurma, $codigoPessoa, 'P')")){
  echo json_encode(array('success' => 1));
} else {
  echo json_encode(array('error' => 0));
}