<?php

function buscaVagasInfantil($ano) {

    include_once('connect.php');

    $sql = sprintf("SELECT 
        a.Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa as escola, 
        b.ds_nome,
        a.Tipo_Vaga_id_tipo_vaga as tipo, 
        a.Fase_Periodo_Fase_id_ano_serie as ano_serie,
        count(*) as qtd 
        FROM matricula.vaga a, matricula.escola b
        where a.Fase_Periodo_Periodo_id_ano = %s
        and a.Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa = b.Pessoa_Juridica_Pessoa_id_pessoa
        and a.Fase_Periodo_Fase_Curso_id_curso = 2
        group by a.Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa, a.Tipo_Vaga_id_tipo_vaga, a.Fase_Periodo_Fase_id_ano_serie",
        mysql_real_escape_string($ano));

    $resultado = mysql_query($sql);
    
    $row = true;
    $i = 0;

    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $vagas[$i] = $row;
        }
        $i++;
    }

    if(isset($vagas)){
        return $vagas;
    }

}

?>