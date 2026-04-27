<?php
include_once("gdb.php"); 

$gdb = new gdb();  

$id_pessoa = $gdb->vargetpost('id_pessoa');

$status_minhocario = $gdb->vargetpost('status_minhocario');

if($gdb->statusMinhocario($id_pessoa,$status_minhocario)) {
	echo json_encode(array('success' => '1'));
} else {
	echo json_encode(array('error' => 'Erro ao cadastrar o status!'));
}

?>