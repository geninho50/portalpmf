<?php

function buscaSituacaoOcupacional($id) {

    include_once('connect.php');
    
    $sql = sprintf("select * from matricula.situacao_ocupacional t where t.id_situacao_ocupacional = %s", mysql_real_escape_string($id));

    $resultado = mysql_query($sql);

    $row = true;

    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $sitOcu[1] = $row[1];
        }
    }

    return $sitOcu;
}

?>