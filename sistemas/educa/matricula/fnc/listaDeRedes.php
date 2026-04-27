<?php

function listaDeRedes() {

    include_once('connect.php');

    $sql = "select * from matricula.esfera t";

    $resultado = mysql_query($sql);

    $row = true;

    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $redes[$row[0]] = $row;
        }
    }

    return $redes;
}

?>