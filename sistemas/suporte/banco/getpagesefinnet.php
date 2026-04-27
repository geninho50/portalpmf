<?php

$term = $_GET["term"];

include_once("gdb.php");
$gdb = new gdb();

$gdb->open("SELECT TITULO_PAGINA, LINK_PAGINA FROM bannerSuporte WHERE ID_SISTEMA = '1' AND UPPER(TITULO_PAGINA) like UPPER('%".$term."%')");

$array = array();

for($i = 0; $i < count($gdb->gs['TITULO_PAGINA']); $i++){ 

	$item = array();
	$item["value"] = $gdb->gs["TITULO_PAGINA"][$i];
	$item["link"] = $gdb->gs["LINK_PAGINA"][$i];

	array_push($array, $item);
}

echo json_encode($array);

