<?php

include_once("gdb.php"); 

$gdb = new gdb();  

$curso = $gdb->vargetpost('codigoTurma');
$temVaga =$gdb->temVaga($curso);

$operacao = array( "TEMVAGA"=>"$temVaga ");
$retorno = json_encode( $operacao );
echo $retorno;

?>