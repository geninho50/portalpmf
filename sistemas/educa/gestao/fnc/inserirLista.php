<?php

function inserirLista($curso, $ano, $periodo, $fase, $escola, $tipo_ranking) {

    include_once('connect.php');

    $sql = sprintf("INSERT INTO `matricula`.`lista`
                    (`Tipo_Ranking_id_tipo_ranking`,
                    `Fase_Periodo_Periodo_id_ano`,
                    `Fase_Periodo_Periodo_id_periodo`,
                    `Fase_Periodo_Fase_id_ano_serie`,
                    `Fase_Periodo_Fase_Curso_id_curso`,
                    `Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa`)
                    VALUES
                    (%s,
                    %s,
                    %s,
                    %s,
                    %s,
                    %s)"
            , mysql_real_escape_string($tipo_ranking)
            , mysql_real_escape_string($ano)
            , mysql_real_escape_string($periodo)
            , mysql_real_escape_string($fase)
            , mysql_real_escape_string($curso)
            , mysql_real_escape_string($escola));

    $resultado = mysql_query($sql);

    return $resultado;
}

?>