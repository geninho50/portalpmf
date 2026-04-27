<?php

function buscaAno($id_fase, $curso, $escola, $id_periodo, $periodo_ano) {

    include_once('connect.php');

    $sql = sprintf("select b.Fase_id_ano_serie, c.ds_nome from matricula.fase_periodo b, matricula.fase c
                    where b.Fase_id_ano_serie = %s
                    and b.Fase_id_ano_serie = c.id_ano_serie
                    and b.Fase_Curso_id_curso = c.Curso_id_curso
                    and c.Curso_id_curso = %s
                    and b.Escola_Pessoa_Juridica_Pessoa_id_pessoa = %s
                    and b.Periodo_id_ano = %s
                    and b.Periodo_id_periodo = %s"
            , mysql_real_escape_string($id_fase)
            , mysql_real_escape_string($curso)
            , mysql_real_escape_string($escola)
            , mysql_real_escape_string($periodo_ano)
            , mysql_real_escape_string($id_periodo));

    $resultado = mysql_query($sql);

    $row = true;

    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $escola = $row;
        }
    }
    
    return $escola;
}

?>