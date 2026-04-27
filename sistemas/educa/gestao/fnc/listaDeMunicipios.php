<?php

function listaDeMunicipios($id_estado){

	include_once('connect.php');

	if($id_estado != 99){
		$sql = sprintf("select * from matricula.localidade t where t.Estado_id_estado = %s", mysql_real_escape_string($id_estado));
	} else {
		$sql = "select * from matricula.localidade t";
	}

	$resultado = mysql_query($sql);
	$row = true;

	while ($row != FALSE) {
		$row = mysql_fetch_row($resultado);
		if($row[0] != ''){
			$municipios[$row[0]] = $row;
		}
	}

	return $municipios;
}

?>