<?php

function inserirFase($curso, $ano, $periodo, $fase, $escola) {

    include_once('connect.php');

    $sql = sprintf("INSERT INTO `matricula`.`fase_periodo`
                    (`Periodo_id_ano`,
                    `Periodo_id_periodo`,
                    `Fase_id_ano_serie`,
                    `Fase_Curso_id_curso`,
                    `Escola_Pessoa_Juridica_Pessoa_id_pessoa`)
                    VALUES
                    (%s,
                    %s,
                    %s,
                    %s,
                    %s);"
            , mysql_real_escape_string($ano)
            , mysql_real_escape_string($periodo)
            , mysql_real_escape_string($fase)
            , mysql_real_escape_string($curso)
            , mysql_real_escape_string($escola));

    $resultado = mysql_query($sql);

    return $resultado;
}

?>