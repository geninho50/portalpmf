<?php

function buscaPerfis() {

   	include_once('connect.php');

    $sql = sprintf("select * from matricula.perfil");

    $resultado = mysql_query($sql);
    
    $row = true;

    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $perfis[$row[0]] = $row;
        }
    }

    return $perfis;
}

?>