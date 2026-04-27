<?php

function listaDeParentescos() {

//	  include_once('connect.php');
//
//	$sql = "select * from localidades.estado t order by t.ds_sigla";
//
//	$resultado = mysql_query($sql);
//
//	$row = true;
//
//	while ($row != FALSE) {
//		$row = mysql_fetch_row($resultado);
//		if($row[0] != ''){
//			$estados[$row[0]] = $row;
//		}
//	}
    
    $parentescos = ['Pai', 'Mãe', 'Tio', 'Avô', 'Irmão', 'Filho', 'Primo', 'Madrasta', 'Padrasto', 'Outros'];

    return $parentescos;
}

?>