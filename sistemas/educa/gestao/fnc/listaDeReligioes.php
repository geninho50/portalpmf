<?php

function listaDeReligioes() {

	include_once('connect.php');

	$sql = "select * from matricula.religiao t";

	$resultado = mysql_query($sql);

	$row = true;

	while ($row != FALSE) {
		$row = mysql_fetch_row($resultado);
		if($row[0] != ''){
			$religiao[$row[0]] = $row;
		}
	}
    

    return $religiao;
}

?>
