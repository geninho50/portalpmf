<?php

function buscaMunicipio($id) {

    include_once('connect.php');

    $sql = sprintf("select * from matricula.localidade where id_localidade = %s", mysql_real_escape_string($id));

    $resultado = mysql_query($sql);
    $row = true;

    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $mun[1] = $row;
        }
    }

    return $mun;
}

?>