<?php

function calculaPontuacao($aluno, $escola, $curso, $ano_serie, $ano, $periodo) {

    include_once('connect.php');

    $sql = sprintf("SELECT Tipo_Ranking_id_tipo_ranking FROM matricula.lista
                    where Fase_Periodo_Periodo_id_periodo = %s
                    and Fase_Periodo_Periodo_id_ano = %s
                    and Fase_Periodo_Fase_Curso_id_curso = %s
                    and Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa = %s
                    and Fase_Periodo_Fase_id_ano_serie = %s"
            , mysql_real_escape_string($periodo)
            , mysql_real_escape_string($ano)
            , mysql_real_escape_string($curso)
            , mysql_real_escape_string($escola)
            , mysql_real_escape_string($ano_serie));

    $ranking = mysql_query($sql);
    $ranking = mysql_fetch_row($ranking)[0];
    
    //Ordem de Chegada
    if ($ranking == 1) {
        $sql = sprintf("SELECT count(*) FROM matricula.lista_aluno
                        where Lista_Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa = %s
                        and Lista_Fase_Periodo_Fase_Curso_id_curso = %s
                        and Lista_Fase_Periodo_Fase_id_ano_serie = %s
                        and Lista_Fase_Periodo_Periodo_id_ano = %s
                        and Lista_Fase_Periodo_Periodo_id_periodo = %s"
                , mysql_real_escape_string($escola)
                , mysql_real_escape_string($curso)
                , mysql_real_escape_string($ano_serie)
                , mysql_real_escape_string($ano)
                , mysql_real_escape_string($periodo));

        $pontuacao = mysql_query($sql);
        $pontuacao = mysql_fetch_row($pontuacao)[0];
        if (is_numeric($pontuacao)) {
            return $pontuacao;
        }
    }
}

?>