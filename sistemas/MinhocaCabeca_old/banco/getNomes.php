<?php

$term = $_GET["term"];

include_once("gdb.php");
$gdb = new gdb();

$gdb->open("SELECT p.id_pessoa, p.nome FROM pessoa p
WHERE p.nome LIKE '%".$term."%'");

$array = array();

for($i = 0; $i < count($gdb->gs["NOME"]); $i++) {

	$item = array();
	$id = array();
	$nome = array();

	$item["id"] = $gdb->gs["ID_PESSOA"][$i];
	$item["value"] = $gdb->gs["NOME"][$i];

	array_push($array, $item);
}

echo json_encode($array);

