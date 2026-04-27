<?php

function listaDeEstadosCivis() {

    include_once('connect.php');

    $sql = "select * from matricula.estado_civil t";

    $resultado = mysql_query($sql);

    $row = true;

    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $estados_civis[$row[0]] = $row;
        }
    }

    return $estados_civis;
}

?>