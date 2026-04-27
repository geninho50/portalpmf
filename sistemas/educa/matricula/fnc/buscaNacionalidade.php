<?php

function buscaNacionalidade($id_pais) {

    include_once('connect.php');

    $sql = sprintf("select * from matricula.pais where id_pais = %s", mysql_real_escape_string($id_pais));

    $resultado = mysql_query($sql);

    $row = true;

    if ($resultado != false) {
        while ($row != FALSE) {
            $row = mysql_fetch_row($resultado);
            if ($row[0] != '') {
                $pais[1] = $row;
            }
        }
    }

    if (isset($pais)) {
        return $pais;
    } else {
        return false;
    }
}

?>