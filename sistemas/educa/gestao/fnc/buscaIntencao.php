<?php

function buscaIntencao($curso, $ano, $fase, $escola) {

    include_once('connect.php');

    if($escola != '1422'){
        $sql = sprintf("SELECT qt_pontuacao, id_aluno, b.ds_nome, c.id_inscricao, NULL, date_format(d.dt_registro, '%s') as dataR
            FROM matricula.lista_aluno a, matricula.pessoa_fisica b, matricula.aluno c, matricula.log_intencao d
            where a.Lista_Fase_Periodo_Periodo_id_ano = %s
            and a.Lista_Fase_Periodo_Periodo_id_periodo = 1
            and a.Lista_Fase_Periodo_Fase_Curso_id_curso = %s
            and a.Lista_Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa = %s
            and a.Lista_Fase_Periodo_Fase_id_ano_serie = %s
            and a.Situacao_Lista_id_situacao_lista = 1
            and a.id_aluno = b.Pessoa_id_pessoa
            and c.Pessoa_Fisica_Pessoa_id_pessoa = b.Pessoa_id_pessoa
            and c.Pessoa_Fisica_Pessoa_id_pessoa = d.Lista_Aluno_id_aluno
            and d.Lista_Aluno_Lista_Fase_Periodo_Fase_Curso_id_curso = 1
            order by d.dt_registro asc, qt_pontuacao asc"
            , mysql_real_escape_string('%d/%m/%Y')
            , mysql_real_escape_string($ano)
            , mysql_real_escape_string($curso)
            , mysql_real_escape_string($escola)
            , mysql_real_escape_string($fase));
} else {

    $sql = sprintf("(select qt_pontuacao as posicao, a.id_aluno, 
        d.ds_nome, b.id_inscricao,  
        NULL,
        date_format(f.dt_registro, '%s')
        from matricula.lista_aluno a, matricula.aluno b, matricula.endereco c, matricula.pessoa_fisica d, matricula.bairro e, matricula.log_intencao f
        where a.id_aluno = b.Pessoa_Fisica_Pessoa_id_pessoa
        and a.id_aluno = c.Pessoa_id_pessoa
        and c.Bairro_id_bairro = e.id_bairro
        and a.id_aluno = d.Pessoa_id_pessoa
        and a.Lista_Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa = 1422
        and a.Lista_Fase_Periodo_Fase_id_ano_serie = %s
        and a.id_aluno = f.Lista_Aluno_id_aluno
        and e.ds_nome = 'Ribeirão da Ilha'
        order by dt_registro, qt_pontuacao)

    union 

    (select qt_pontuacao as posicao, a.id_aluno,
        d.ds_nome,  b.id_inscricao,
        NULL,
        date_format(f.dt_registro, '%s')
        from matricula.lista_aluno a, matricula.aluno b, matricula.endereco c, matricula.pessoa_fisica d, matricula.bairro e, matricula.log_intencao f
        where a.id_aluno = b.Pessoa_Fisica_Pessoa_id_pessoa
        and a.id_aluno = c.Pessoa_id_pessoa
        and c.Bairro_id_bairro = e.id_bairro
        and a.id_aluno = d.Pessoa_id_pessoa
        and a.Lista_Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa = 1422
        and a.Lista_Fase_Periodo_Fase_id_ano_serie = %s
        and a.id_aluno = f.Lista_Aluno_id_aluno
        and e.ds_nome != 'Ribeirão da Ilha'
        order by dt_registro, qt_pontuacao)"
, mysql_real_escape_string('%d/%m/%Y')
, mysql_real_escape_string($fase)
, mysql_real_escape_string('%d/%m/%Y')
, mysql_real_escape_string($fase));

}

$resultado = mysql_query($sql);

$row = true;
$i = 0;

while ($row != FALSE) {
    $row = mysql_fetch_row($resultado);
    if ($row[0] != '') {
        $intencao[$i++] = $row;
    }
}

if (isset($intencao)) {
    return $intencao;
}

return false;
}

function buscaIntencaoTodos($curso, $ano, $fase) {

    include_once('connect.php');

    $sql = sprintf("SELECT qt_pontuacao, id_aluno, b.ds_nome, c.id_inscricao, null, a.Lista_Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa
        FROM matricula.lista_aluno a, matricula.pessoa_fisica b, matricula.aluno c, matricula.motivo_escolha_escola d
        where a.Lista_Fase_Periodo_Periodo_id_ano = %s
        and a.Lista_Fase_Periodo_Periodo_id_periodo = 1
        and a.Lista_Fase_Periodo_Fase_Curso_id_curso = %s
        and a.Lista_Fase_Periodo_Fase_id_ano_serie = %s
        and a.Situacao_Lista_id_situacao_lista = 1
        and a.id_aluno = b.Pessoa_id_pessoa
        and c.Pessoa_Fisica_Pessoa_id_pessoa = b.Pessoa_id_pessoa
        order by qt_pontuacao asc"
        , mysql_real_escape_string($ano)
        , mysql_real_escape_string($curso)
        , mysql_real_escape_string($fase));

    $resultado = mysql_query($sql);
    
    $row = true;
    $i = 0;

    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $intencao[$i++] = $row;
        }
    }

    if (isset($intencao)) {
        return $intencao;
    }

    return false;
}

function buscaIntencaoTudo($curso, $ano) {

    include_once('connect.php');

    $sql = sprintf("SELECT qt_pontuacao, id_aluno, b.ds_nome, c.id_inscricao, null, 
        a.Lista_Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa, a.Lista_Fase_Periodo_Fase_id_ano_serie
        FROM matricula.lista_aluno a, matricula.pessoa_fisica b, matricula.aluno c, matricula.motivo_escolha_escola d
        where a.Lista_Fase_Periodo_Periodo_id_ano = %s
        and a.Lista_Fase_Periodo_Periodo_id_periodo = 1
        and a.Lista_Fase_Periodo_Fase_Curso_id_curso = %s
        and a.Situacao_Lista_id_situacao_lista = 1
        and a.id_aluno = b.Pessoa_id_pessoa
        and c.Pessoa_Fisica_Pessoa_id_pessoa = b.Pessoa_id_pessoa
        order by qt_pontuacao asc"
        , mysql_real_escape_string($ano)
        , mysql_real_escape_string($curso));

    $resultado = mysql_query($sql);
    
    $row = true;
    $i = 0;

    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $intencao[$i++] = $row;
        }
    }

    if (isset($intencao)) {
        return $intencao;
    }

    return false;
}

?>