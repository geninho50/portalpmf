<?php

function listaDeEtnias() {

    include_once('connect.php');

    $sql = "select * from matricula.etnia t";

    $resultado = mysql_query($sql);

    $row = true;

    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $etnias[$row[0]] = $row;
        }
    }

    return $etnias;}


?>