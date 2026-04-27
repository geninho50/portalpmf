<?php

function buscaAntoprometria($id_aluno) {

    include_once('connect.php');

    $sql = sprintf("SELECT * FROM matricula.antoprometria
                    where id_pessoa = %s order by dt_medidas_tomadas desc limit 1", mysql_real_escape_string($id_aluno));

    $resultado = mysql_query($sql);

    $row = true;

    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $aluno = $row;
        }
    }

    if (isset($aluno)) {
        return $aluno;
    } else {
        return false;
    }
}

?>