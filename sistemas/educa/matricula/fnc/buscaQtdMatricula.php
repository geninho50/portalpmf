<?php

function buscaQtdMatricula($curso, $ano, $fase, $escola) {

    include_once('connect.php');

    $sql = sprintf("SELECT 
        count(*) as qtd 
        FROM matricula.vaga a, matricula.escola b
        where a.Fase_Periodo_Periodo_id_ano = %s
        and a.Tipo_Vaga_id_tipo_vaga = 1
        and a.Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa = b.Pessoa_Juridica_Pessoa_id_pessoa
        and b.Pessoa_Juridica_Pessoa_id_pessoa = %s
        and a.Fase_Periodo_Fase_id_ano_serie = %s
        and a.Fase_Periodo_Fase_Curso_id_curso = %s
        group by a.Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa, a.Tipo_Vaga_id_tipo_vaga"
        , mysql_real_escape_string($ano)
        , mysql_real_escape_string($escola)
        , mysql_real_escape_string($fase)
        , mysql_real_escape_string($curso));

    $resultado = mysql_query($sql);
    
    $row = true;
    
    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $qtd = $row[0];
        }
    }

    if(isset($qtd)){
        return (int) $qtd;
    }

    return 0;
}

?>