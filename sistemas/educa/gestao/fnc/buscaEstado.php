<?php

function buscaEstado($estado) {

    include_once('connect.php');

    $sql = sprintf("SELECT * FROM matricula.estado where sg_estado = '%s'", mysql_real_escape_string($estado));

    $resultado = mysql_query($sql);

    $row = true;

    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $estado = $row;
        }
    }
    
    return $estado;
}

function buscaNomeEstado($estado) {

    include_once('connect.php');

    $sql = sprintf("SELECT * FROM matricula.estado where id_estado = '%s'", mysql_real_escape_string($estado));

    $resultado = mysql_query($sql);

    $row = true;

    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $estado = $row;
        }
    }
    
    return $estado;
}

?>