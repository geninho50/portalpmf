<?php

function buscaInscritosInfantilIAF($id_escola, $ano, $fase, $curso) {

    include_once('connect.php');


    $sql = sprintf("select id_aluno, id_escolha, Lista_Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa, Lista_Fase_Periodo_Fase_id_ano_serie, b.ds_nome, c.id_inscricao, b.dt_nascimento
                    from matricula.lista_aluno a, matricula.pessoa_fisica b, matricula.aluno c
                    where Lista_Fase_Periodo_Fase_Curso_id_curso = %s
                    and Lista_Fase_Periodo_Periodo_id_ano = %s
                    and Lista_Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa = %s
                    and Lista_Fase_Periodo_Fase_id_ano_serie = %s
                    and a.id_aluno = b.Pessoa_id_pessoa
                    and b.Pessoa_id_pessoa = c.Pessoa_Fisica_Pessoa_id_pessoa order by b.ds_nome"
            , mysql_real_escape_string($curso)
            , mysql_real_escape_string($ano)
            , mysql_real_escape_string($id_escola)
            , mysql_real_escape_string($fase));
    
    $resultado = mysql_query($sql);

    $row = true;

    $i = 0;
    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        $i++;
        if ($row[0] != '') {
            $matriculados[$i] = $row;
        }
    }

    if (!isset($matriculados)) {
        return FALSE;
    } else {
        return $matriculados;
    }
}


function buscaInscritosInfantilIA($id_escola, $ano, $curso) {

   	include_once('connect.php');


    $sql = sprintf("select id_aluno, id_escolha, Lista_Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa, Lista_Fase_Periodo_Fase_id_ano_serie, b.ds_nome, c.id_inscricao, b.dt_nascimento
                    from matricula.lista_aluno a, matricula.pessoa_fisica b, matricula.aluno c
                    where Lista_Fase_Periodo_Fase_Curso_id_curso = %s
                    and Lista_Fase_Periodo_Periodo_id_ano = %s
                    and Lista_Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa = %s
                    and a.id_aluno = b.Pessoa_id_pessoa
                    and b.Pessoa_id_pessoa = c.Pessoa_Fisica_Pessoa_id_pessoa order by b.ds_nome"
            , mysql_real_escape_string($curso)
            , mysql_real_escape_string($ano)
            , mysql_real_escape_string($id_escola));
    
    $resultado = mysql_query($sql);

    $row = true;

    $i = 0;
    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        $i++;
        if ($row[0] != '') {
            $matriculados[$i] = $row;
        }
    }

    if (!isset($matriculados)) {
        return FALSE;
    } else {
        return $matriculados;
    }
}


function buscaInscritosInfantilAF($ano, $fase, $curso) {

    include_once('connect.php');

    $sql = sprintf("select id_aluno, id_escolha, Lista_Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa, Lista_Fase_Periodo_Fase_id_ano_serie, b.ds_nome, c.id_inscricao, b.dt_nascimento
                    from matricula.lista_aluno a, matricula.pessoa_fisica b, matricula.aluno c
                    where Lista_Fase_Periodo_Fase_Curso_id_curso = %s
                    and Lista_Fase_Periodo_Periodo_id_ano = %s
                    and Lista_Fase_Periodo_Fase_id_ano_serie = %s
                    and a.id_aluno = b.Pessoa_id_pessoa
                    and b.Pessoa_id_pessoa = c.Pessoa_Fisica_Pessoa_id_pessoa order by b.ds_nome"
            , mysql_real_escape_string($curso)
            , mysql_real_escape_string($ano)
            , mysql_real_escape_string($fase));
    
    $resultado = mysql_query($sql);

    $row = true;

    $i = 0;
    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        $i++;
        if ($row[0] != '') {
            $matriculados[$i] = $row;
        }
    }

    if (!isset($matriculados)) {
        return FALSE;
    } else {
        return $matriculados;
    }
}


function buscaInscritosInfantilIF($id_escola, $fase, $curso) {

    include_once('connect.php');

    $sql = sprintf("select id_aluno, id_escolha, Lista_Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa, Lista_Fase_Periodo_Fase_id_ano_serie, b.ds_nome, c.id_inscricao, b.dt_nascimento
                    from matricula.lista_aluno a, matricula.pessoa_fisica b, matricula.aluno c
                    where Lista_Fase_Periodo_Fase_Curso_id_curso = %s
                    and Lista_Fase_Periodo_Fase_id_ano_serie = %s
                    and Lista_Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa = %s
                    and a.id_aluno = b.Pessoa_id_pessoa
                    and b.Pessoa_id_pessoa = c.Pessoa_Fisica_Pessoa_id_pessoa order by b.ds_nome"
            , mysql_real_escape_string($curso)
            , mysql_real_escape_string($fase)
            , mysql_real_escape_string($id_escola));
    
    $resultado = mysql_query($sql);

    $row = true;

    $i = 0;
    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        $i++;
        if ($row[0] != '') {
            $matriculados[$i] = $row;
        }
    }

    if (!isset($matriculados)) {
        return FALSE;
    } else {
        return $matriculados;
    }
}


function buscaInscritosInfantilI($id_escola, $curso) {

    include_once('connect.php');
    
    $sql = sprintf("select id_aluno, id_escolha, Lista_Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa, Lista_Fase_Periodo_Fase_id_ano_serie, b.ds_nome, c.id_inscricao, b.dt_nascimento
                    from matricula.lista_aluno a, matricula.pessoa_fisica b, matricula.aluno c
                    where Lista_Fase_Periodo_Fase_Curso_id_curso = %s
                    and Lista_Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa = %s
                    and a.id_aluno = b.Pessoa_id_pessoa
                    and b.Pessoa_id_pessoa = c.Pessoa_Fisica_Pessoa_id_pessoa order by b.ds_nome"
            , mysql_real_escape_string($curso)
            , mysql_real_escape_string($id_escola));
    
    $resultado = mysql_query($sql);

    $row = true;

    $i = 0;
    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        $i++;
        if ($row[0] != '') {
            $matriculados[$i] = $row;
        }
    }

    if (!isset($matriculados)) {
        return FALSE;
    } else {
        return $matriculados;
    }
}


function buscaInscritosInfantilA($ano, $curso) {

    include_once('connect.php');

    $sql = sprintf("select id_aluno, id_escolha, Lista_Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa, Lista_Fase_Periodo_Fase_id_ano_serie, b.ds_nome, c.id_inscricao, b.dt_nascimento
                    from matricula.lista_aluno a, matricula.pessoa_fisica b, matricula.aluno c
                    where Lista_Fase_Periodo_Fase_Curso_id_curso = %s
                    and Lista_Fase_Periodo_Periodo_id_ano = %s
                    and a.id_aluno = b.Pessoa_id_pessoa
                    and b.Pessoa_id_pessoa = c.Pessoa_Fisica_Pessoa_id_pessoa order by b.ds_nome"
            , mysql_real_escape_string($curso)
            , mysql_real_escape_string($ano));
    
    $resultado = mysql_query($sql);

    $row = true;

    $i = 0;
    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        $i++;
        if ($row[0] != '') {
            $matriculados[$i] = $row;
        }
    }

    if (!isset($matriculados)) {
        return FALSE;
    } else {
        return $matriculados;
    }
}


function buscaInscritosInfantilF($fase, $curso) {

    include_once('connect.php');

    $sql = sprintf("select id_aluno, id_escolha, Lista_Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa, Lista_Fase_Periodo_Fase_id_ano_serie, b.ds_nome, c.id_inscricao, b.dt_nascimento
                    from matricula.lista_aluno a, matricula.pessoa_fisica b, matricula.aluno c
                    where Lista_Fase_Periodo_Fase_Curso_id_curso = %s
                    and Lista_Fase_Periodo_Fase_id_ano_serie = %s
                    and a.id_aluno = b.Pessoa_id_pessoa
                    and b.Pessoa_id_pessoa = c.Pessoa_Fisica_Pessoa_id_pessoa order by b.ds_nome"
            , mysql_real_escape_string($curso)
            , mysql_real_escape_string($fase));
    
    $resultado = mysql_query($sql);

    $row = true;

    $i = 0;
    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        $i++;
        if ($row[0] != '') {
            $matriculados[$i] = $row;
        }
    }

    if (!isset($matriculados)) {
        return FALSE;
    } else {
        return $matriculados;
    }
}


function buscaInscritosInfantil($curso) {

   	include_once('connect.php');


    $sql = sprintf("select id_aluno, id_escolha, Lista_Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa, Lista_Fase_Periodo_Fase_id_ano_serie, b.ds_nome, c.id_inscricao, b.dt_nascimento
                    from matricula.lista_aluno a, matricula.pessoa_fisica b, matricula.aluno c
                    where Lista_Fase_Periodo_Fase_Curso_id_curso = %s
                    and a.id_aluno = b.Pessoa_id_pessoa
                    and b.Pessoa_id_pessoa = c.Pessoa_Fisica_Pessoa_id_pessoa order by b.ds_nome"
            , mysql_real_escape_string($curso));
    
    $resultado = mysql_query($sql);

    $row = true;

    $i = 0;
    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        $i++;
        if ($row[0] != '') {
            $matriculados[$i] = $row;
        }
    }

    if (!isset($matriculados)) {
        return FALSE;
    } else {
        return $matriculados;
    }
}

?>