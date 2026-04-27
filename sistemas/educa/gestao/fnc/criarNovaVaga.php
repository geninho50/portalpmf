<?php

function criarNovaVaga($curso, $ano, $fase, $escola) {

    include_once('connect.php');

    $sql = sprintf("INSERT INTO `matricula`.`vaga`
        (`Aluno_Pessoa_Fisica_Pessoa_id_pessoa`,
            `Tipo_Vaga_id_tipo_vaga`,
            `Fase_Periodo_Periodo_id_ano`,
            `Fase_Periodo_Periodo_id_periodo`,
            `Fase_Periodo_Fase_id_ano_serie`,
            `Fase_Periodo_Fase_Curso_id_curso`,
            `Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa`)
    VALUES
    (null,
        1,
        %s,
        1,
        %s,
        %s,
        %s);
    "
    , mysql_real_escape_string($ano)
    , mysql_real_escape_string($fase)
    , mysql_real_escape_string($curso)
    , mysql_real_escape_string($escola));

    $resultado = mysql_query($sql);
    
    return $resultado;
}

?>