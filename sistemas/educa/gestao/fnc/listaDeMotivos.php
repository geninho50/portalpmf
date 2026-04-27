<?php

function listaDeMotivos() {

    include_once('connect.php');

    $sql = "select * from matricula.motivo_escolha_escola t";

    $resultado = mysql_query($sql);

    $row = true;

    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $motivos[$row[0]] = $row;
        }
    }

    return $motivos;
}

?>