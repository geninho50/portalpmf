<?php

function buscaFases($curso) {

    include_once('connect.php');

    $sql = sprintf("select id_ano_serie, ds_nome from matricula.fase where Curso_id_curso = %s", mysql_real_escape_string($curso));

    $resultado = mysql_query($sql);
    
    $row = true;
    
    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $fases[$row[0]] = $row;
        }
    }

    return $fases;
}

function buscaFasesCAE($curso, $ano, $escola) {

      include_once('connect.php');

    $sql = sprintf("SELECT Fase_id_ano_serie, ds_nome FROM matricula.fase_periodo a, matricula.fase b
        where Escola_Pessoa_Juridica_Pessoa_id_pessoa = %s
        and Periodo_id_ano = %s
        and Fase_Curso_id_curso = %s
        and a.Fase_id_ano_serie = b.id_ano_serie"
        , mysql_real_escape_string($escola)
        , mysql_real_escape_string($ano)
        , mysql_real_escape_string($curso));

    $resultado = mysql_query($sql);
    
    $row = true;
    
    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $fases[$row[0]] = $row;
        }
    }
    if(isset($fases)){
        return $fases;
    }

    return false;
}



?>