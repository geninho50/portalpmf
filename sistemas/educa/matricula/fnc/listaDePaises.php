<?php

function listaDePaises() {

    include_once('connect.php');

    $sql = "select * from matricula.pais t";

    $resultado = mysql_query($sql);

    $row = true;

    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $pais[$row[0]] = $row;
        }
    }

    return $pais;
}

?>