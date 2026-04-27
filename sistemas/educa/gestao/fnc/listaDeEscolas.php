<?php

function listaDeEscolas($curso, $id_periodo, $periodo_ano) {

include_once('connect.php');

    $sql = sprintf("select Pessoa_Juridica_Pessoa_id_pessoa, a.ds_nome from matricula.escola a, matricula.fase_periodo b, matricula.fase c
where a.Pessoa_Juridica_Pessoa_id_pessoa = b.Escola_Pessoa_Juridica_Pessoa_id_pessoa
and b.Fase_id_ano_serie = c.id_ano_serie
and b.Periodo_id_ano = %s
and b.Periodo_id_periodo = %s
and b.Fase_Curso_id_curso = c.Curso_id_curso
and c.Curso_id_curso = %s
group by a.Pessoa_Juridica_Pessoa_id_pessoa, a.ds_nome
order by a.ds_nome", mysql_real_escape_string($periodo_ano), mysql_real_escape_string($id_periodo), mysql_real_escape_string($curso));

    $resultado = mysql_query($sql);

    $row = true;

    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $escolas[$row[0]] = $row;
        }
    }

    return $escolas;
}

?>