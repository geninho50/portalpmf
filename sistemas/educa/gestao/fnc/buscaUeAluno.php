<?php

function buscaUeAluno($id_usuario) {
    $sql = sprintf('SELECT Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa FROM matricula.vaga
    where Aluno_Pessoa_Fisica_Pessoa_id_pessoa = %s
    order by Fase_Periodo_Fase_id_ano_serie desc
    limit 2', mysql_real_escape_string($id_usuario));

    $resultado = mysql_query($sql);

    $row = true;
    $i = 0;

    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $escola[$i++] = $row;
        }
    }

    if (isset($escola)) {
        return $escola;
    }
    return false;
}

function buscaUeAlunoIntencao($id_usuario) {
    $sql = sprintf('SELECT Lista_Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa, Lista_Fase_Periodo_Fase_id_ano_serie FROM matricula.lista_aluno
            where id_aluno = %s
            limit 1', mysql_real_escape_string($id_usuario));

    $resultado = mysql_query($sql);

    $row = true;
    $i = 0;

    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $escola[$i++] = $row;
        }
    }

    if (isset($escola)) {
        return $escola;
    }
    return false;
}

?>
