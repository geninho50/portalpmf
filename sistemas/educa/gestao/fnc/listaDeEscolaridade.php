<?php

function listaDeEscolaridade() {

	include_once('connect.php');

	$sql = "select * from matricula.escolaridade t";

	$resultado = mysql_query($sql);

	$row = true;

	while ($row != FALSE) {
		$row = mysql_fetch_row($resultado);
		if($row[0] != ''){
			$escolaridade[$row[0]] = $row;
		}
	}

    return $escolaridade;
}

?>