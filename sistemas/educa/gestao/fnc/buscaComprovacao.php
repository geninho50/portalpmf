<?php

function buscaComprovacao($id) {

    include_once('connect.php');

    $sql = sprintf("select * from matricula.comprovacao_renda t where t.id_comprovacao = %s", mysql_real_escape_string($id));

    $resultado = mysql_query($sql);
    
    $row = true;

    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $comp[1] = $row[1];
        }
    }
    
    return $comp;
}

?>