<?php

function listaDeProfissoes() {

    include_once('connect.php');

    $sql = "select * from matricula.profissao order by ds_profissao asc";

    $resultado = mysql_query($sql);

    $row = true;

    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $profissoes[$row[0]] = $row;
        }
    }

    return $profissoes;
}

?>