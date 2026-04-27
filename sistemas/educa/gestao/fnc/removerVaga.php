<?php

function removerVaga($curso, $ano, $fase, $escola) {

    include_once('connect.php');

    $sql = sprintf("DELETE FROM `matricula`.`vaga`
WHERE Aluno_Pessoa_Fisica_Pessoa_id_pessoa is null
and Tipo_Vaga_id_tipo_vaga != 2
and Fase_Periodo_Fase_Curso_id_curso = %s
and Fase_Periodo_Fase_id_ano_serie = %s
and Fase_Periodo_Periodo_id_ano = %s
and Fase_Periodo_Periodo_id_periodo = 1
and Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa = %s
limit 1"
    , mysql_real_escape_string($curso)
    , mysql_real_escape_string($fase)
    , mysql_real_escape_string($ano)
    , mysql_real_escape_string($escola));

    $resultado = mysql_query($sql);

    return $resultado;
}

?>