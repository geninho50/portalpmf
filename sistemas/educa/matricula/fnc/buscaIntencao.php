<?php

function buscaIntencao($curso, $ano, $fase, $escola) {

    include_once('connect.php');

    $sql = sprintf("SELECT qt_pontuacao, id_aluno, b.ds_nome, c.id_inscricao, d.ds_motivo 
                    FROM matricula.lista_aluno a, matricula.pessoa_fisica b, matricula.aluno c, matricula.motivo_escolha_escola d
                    where a.Lista_Fase_Periodo_Periodo_id_ano = %s
                    and a.Lista_Fase_Periodo_Periodo_id_periodo = 1
                    and d.id_motivo = a.Motivo_Escolha_Escola_id_motivo
                    and a.Lista_Fase_Periodo_Fase_Curso_id_curso = %s
                    and a.Lista_Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa = %s
                    and a.Lista_Fase_Periodo_Fase_id_ano_serie = %s
                    and a.Situacao_Lista_id_situacao_lista = 1
                    and a.id_aluno = b.Pessoa_id_pessoa
                    and c.Pessoa_Fisica_Pessoa_id_pessoa = b.Pessoa_id_pessoa
                    order by qt_pontuacao asc"
            , mysql_real_escape_string($ano)
            , mysql_real_escape_string($curso)
            , mysql_real_escape_string($escola)
            , mysql_real_escape_string($fase));

    $resultado = mysql_query($sql);
    
    $row = true;

    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $intencao[$row[0]] = $row;
        }
    }

    if (isset($intencao)) {
        return $intencao;
    }

    return false;
}

?>