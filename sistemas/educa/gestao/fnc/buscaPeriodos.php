<?php

function buscaPeriodos() {

    include_once('connect.php');

    $sql = sprintf("select id_ano from matricula.periodo");

    $resultado = mysql_query($sql);
    
    $row = true;

    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $papeis[$row[0]] = $row;
        }
    }

    return $papeis;
}

?>