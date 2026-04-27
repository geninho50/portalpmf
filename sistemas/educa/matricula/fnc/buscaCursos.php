<?php

function buscaCursos() {

    include_once('connect.php');

    $sql = sprintf("select id_curso, ds_nome from matricula.curso");

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