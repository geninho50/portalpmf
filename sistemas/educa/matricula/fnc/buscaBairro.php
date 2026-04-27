<?php

function buscaBairro($id) {

    include_once('connect.php');

    $sql = sprintf("select * from matricula.bairro where id_bairro = %s", mysql_real_escape_string($id));

    $resultado = mysql_query($sql);

    $row = true;

    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $bairro[$row[0]] = $row;
        }
    }
    if (isset($bairro)) {
        return $bairro;
    }
    return false;
}

?>