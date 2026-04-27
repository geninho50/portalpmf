<?php

function buscaMotivo($id_motivo) {

    include_once('connect.php');

    $sql = sprintf("select * from matricula.motivo_escolha_escola t", mysql_real_escape_string($id_motivo));

    $resultado = mysql_query($sql);

    $row = true;

    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $motivo[$row[0]] = $row;
        }
    }

    return $motivo;
}

?>