<?php

function listaDeSituacoesOcupacionais() {

	include_once('connect.php');

	$sql = "select * from matricula.situacao_ocupacional";

	$resultado = mysql_query($sql);

	$row = true;

	while ($row != FALSE) {
		$row = mysql_fetch_row($resultado);
		if($row[0] != ''){
			$situacoes[$row[0]] = $row;
		}
	}
    
    return $situacoes;
}

?>