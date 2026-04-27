<?php

function buscaAnoRematricula($id_usuario) {
    $sql = sprintf('SELECT Fase_Periodo_Fase_id_ano_serie FROM matricula.vaga
    where Aluno_Pessoa_Fisica_Pessoa_id_pessoa = %s
    order by Fase_Periodo_Fase_id_ano_serie desc
    limit 1', mysql_real_escape_string($id_usuario));

    $resultado = mysql_query($sql);

    $row = true;

    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $escola = $row;
        }
    }

    if (isset($escola)) {
        return $escola;
    }
    return false;
}
?>
