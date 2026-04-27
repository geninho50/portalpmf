<?php

function buscaTiposEscolas() {

    include_once('connect.php');

    $sql = sprintf("select * from matricula.tipo_escola");

    $resultado = mysql_query($sql);
    
    $row = true;

    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $tipos[$row[0]] = $row;
        }
    }

    return $tipos;
}

?>