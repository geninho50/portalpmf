<?php

function buscaEtnia($id) {

    include_once('connect.php');
    
    $sql = sprintf("select * from matricula.etnia t where t.id_etnia = %s", mysql_real_escape_string($id));

    $resultado = mysql_query($sql);

    $row = true;

    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $etnia[1] = $row[1];
        }
    }

    return $etnia;
}

?>