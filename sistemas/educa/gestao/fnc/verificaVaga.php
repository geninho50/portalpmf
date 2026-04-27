<?php

function verificaVaga($escola, $curso, $fase, $periodo_ano, $id_periodo) {

    include_once('connect.php');

    $sql = sprintf("select count(*) from matricula.vaga a
        where a.Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa = %s
        and a.Fase_Periodo_Fase_Curso_id_curso = %s
        and a.Fase_Periodo_Fase_id_ano_serie = %s
        and a.Fase_Periodo_Periodo_id_ano = %s
        and a.Fase_Periodo_Periodo_id_periodo = %s
        and a.Tipo_Vaga_id_tipo_vaga = 1
        and a.Aluno_Pessoa_Fisica_Pessoa_id_pessoa is null"
        , mysql_real_escape_string($escola)
        , mysql_real_escape_string($curso)
        , mysql_real_escape_string($fase)
        , mysql_real_escape_string($periodo_ano)
        , mysql_real_escape_string($id_periodo));

    $resultado = mysql_query($sql);
    
    $row = true;

    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $vagas = $row[0];
        }
    }
    
    return $vagas;
}

?>