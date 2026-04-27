<?php

function buscaEscolasComVaga($id_ano, $id_periodo, $id_fase) {

    include_once('connect.php');

    $sql = sprintf("SELECT a.Pessoa_Juridica_Pessoa_id_pessoa, a.ds_nome FROM matricula.escola a, matricula.vaga b
        where a.Pessoa_Juridica_Pessoa_id_pessoa = b.Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa
        and b.Fase_Periodo_Fase_id_ano_serie = %s
        and b.Fase_Periodo_Periodo_id_ano = %s
        and b.Fase_Periodo_Periodo_id_periodo = %s
        and b.Aluno_Pessoa_Fisica_Pessoa_id_pessoa is null
        and b.Tipo_Vaga_id_tipo_vaga != 2
        and b.Tipo_Vaga_id_tipo_vaga != 3
        group by a.Pessoa_Juridica_Pessoa_id_pessoa, a.ds_nome
        order by ds_nome"
        , mysql_real_escape_string($id_fase)
        , mysql_real_escape_string($id_ano)
        , mysql_real_escape_string($id_periodo));

    $resultado = mysql_query($sql);
    
    $row = true;

    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $escola[$row[0]] = $row;
        }
    }

    if(isset($escola)){
        return $escola;
    } else {
        return false;
    }
}

?>