<?php

function buscaPais($id_pais) {

    include_once('connect.php');

    $sql = sprintf("select * from matricula.pais
        where id_pais = %s", mysql_real_escape_string($id_pais));

    $resultado = mysql_query($sql);

    $row = true;
    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $ind = $row;
        }
    }

    if (isset($ind)) {
        mysql_close();
        return $ind;
    }
    mysql_close();
    return false;
}

?>