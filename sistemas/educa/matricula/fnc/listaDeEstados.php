<?php

function listaDeEstados(){

	include_once('connect.php');

	$sql = "select * from matricula.estado t order by t.sg_estado";

	$resultado = mysql_query($sql);

	$row = true;

	while ($row != FALSE) {
		$row = mysql_fetch_row($resultado);
		if($row[0] != ''){
			$estados[$row[0]] = $row;
		}
	}

	return $estados;
}

?>