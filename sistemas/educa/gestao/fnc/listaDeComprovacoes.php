<?php

function listaDeComprovacoes() {

    include_once('connect.php');

    $sql = "SELECT * FROM matricula.comprovacao_renda";

    $resultado = mysql_query($sql);

    $row = true;

    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $comprovacoes[$row[0]] = $row;
        }
    }

    return $comprovacoes;
}

?>