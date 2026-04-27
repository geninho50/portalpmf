<?php

$term = $_GET["term"];

include_once("gdb.php");
$gdb = new gdb();

$gdb->open("SELECT a.id_animal, a.nome_animal
FROM adoteDibea.animal a 
LEFT JOIN adoteDibea.galeria_animal ga ON a.id_animal = ga.id_animal
LEFT JOIN adoteDibea.galeria g ON g.id_galeria = ga.id_galeria
LEFT JOIN adoteDibea.interesse i ON i.id_animal = a.id_animal AND i.status = 1
WHERE a.ativo = 1 and a.nome_animal LIKE '%".$term."%'");

$array = array();

for($i = 0; $i < count($gdb->gs["NOME_ANIMAL"]); $i++) {

	$item = array();
	$id = array();
	$nome = array();

	$item["id"] = $gdb->gs["ID_ANIMAL"][$i];
	$item["value"] = $gdb->gs["NOME_ANIMAL"][$i];

	array_push($array, $item);
}

echo json_encode($array);

