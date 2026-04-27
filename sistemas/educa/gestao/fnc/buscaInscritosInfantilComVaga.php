<?php

function buscaInscritosInfantilComVagaIAF($id_escola, $ano, $fase, $curso) {

   include_once('connect.php');


    $sql = sprintf("select Aluno_Pessoa_Fisica_Pessoa_id_pessoa, null, a.Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa, a.Fase_Periodo_Fase_id_ano_serie, b.ds_nome, c.id_inscricao, b.dt_nascimento
                    , a.id_vaga
                    from matricula.vaga a, matricula.pessoa_fisica b, matricula.aluno c
                    where Fase_Periodo_Fase_Curso_id_curso = %s
                    and Fase_Periodo_Periodo_id_ano = %s
                    and Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa = %s
                    and Fase_Periodo_Fase_id_ano_serie = %s
                    and a.Aluno_Pessoa_Fisica_Pessoa_id_pessoa = b.Pessoa_id_pessoa
                    and b.Pessoa_id_pessoa = c.Pessoa_Fisica_Pessoa_id_pessoa
                    and b.Pessoa_id_pessoa in (select Aluno_Pessoa_Fisica_Pessoa_id_pessoa from matricula.vaga where Fase_Periodo_Fase_Curso_id_curso = %s)"
            , mysql_real_escape_string($curso)
            , mysql_real_escape_string($ano)
            , mysql_real_escape_string($id_escola)
            , mysql_real_escape_string($fase)
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


function buscaInscritosInfantilComVagaIA($id_escola, $ano, $curso) {

    include_once('connect.php');


    $sql = sprintf("select Aluno_Pessoa_Fisica_Pessoa_id_pessoa, null, a.Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa, a.Fase_Periodo_Fase_id_ano_serie, b.ds_nome, c.id_inscricao, b.dt_nascimento
                    , a.id_vaga
                    from matricula.vaga a, matricula.pessoa_fisica b, matricula.aluno c
                    where Fase_Periodo_Fase_Curso_id_curso = %s
                    and Fase_Periodo_Periodo_id_ano = %s
                    and Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa = %s
                    and a.Aluno_Pessoa_Fisica_Pessoa_id_pessoa = b.Pessoa_id_pessoa
                    and b.Pessoa_id_pessoa = c.Pessoa_Fisica_Pessoa_id_pessoa
                    and b.Pessoa_id_pessoa in (select Aluno_Pessoa_Fisica_Pessoa_id_pessoa from matricula.vaga where Fase_Periodo_Fase_Curso_id_curso = %s)"
            , mysql_real_escape_string($curso)
            , mysql_real_escape_string($ano)
            , mysql_real_escape_string($id_escola)
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


function buscaInscritosInfantilComVagaAF($ano, $fase, $curso) {

    include_once('connect.php');

    $sql = sprintf("select Aluno_Pessoa_Fisica_Pessoa_id_pessoa, null, a.Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa, a.Fase_Periodo_Fase_id_ano_serie, b.ds_nome, c.id_inscricao, b.dt_nascimento
                    , a.id_vaga
                    from matricula.vaga a, matricula.pessoa_fisica b, matricula.aluno c
                    where Fase_Periodo_Fase_Curso_id_curso = %s
                    and Fase_Periodo_Periodo_id_ano = %s
                    and Fase_Periodo_Fase_id_ano_serie = %s
                    and a.Aluno_Pessoa_Fisica_Pessoa_id_pessoa = b.Pessoa_id_pessoa
                    and b.Pessoa_id_pessoa = c.Pessoa_Fisica_Pessoa_id_pessoa
                    and b.Pessoa_id_pessoa in (select Aluno_Pessoa_Fisica_Pessoa_id_pessoa from matricula.vaga where Fase_Periodo_Fase_Curso_id_curso = %s)"
            , mysql_real_escape_string($curso)
            , mysql_real_escape_string($ano)
            , mysql_real_escape_string($fase)
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


function buscaInscritosInfantilComVagaIF($id_escola, $fase, $curso) {

   	include_once('connect.php');

    $sql = sprintf("select Aluno_Pessoa_Fisica_Pessoa_id_pessoa, null, a.Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa, a.Fase_Periodo_Fase_id_ano_serie, b.ds_nome, c.id_inscricao, b.dt_nascimento
                    , a.id_vaga
                    from matricula.vaga a, matricula.pessoa_fisica b, matricula.aluno c
                    where Fase_Periodo_Fase_Curso_id_curso = %s
                    and Fase_Periodo_Fase_id_ano_serie = %s
                    and Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa = %s
                    and a.Aluno_Pessoa_Fisica_Pessoa_id_pessoa = b.Pessoa_id_pessoa
                    and b.Pessoa_id_pessoa = c.Pessoa_Fisica_Pessoa_id_pessoa
                    and b.Pessoa_id_pessoa in (select Aluno_Pessoa_Fisica_Pessoa_id_pessoa from matricula.vaga where Fase_Periodo_Fase_Curso_id_curso = %s)"
            , mysql_real_escape_string($curso)
            , mysql_real_escape_string($fase)
            , mysql_real_escape_string($id_escola)
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


function buscaInscritosInfantilComVagaI($id_escola, $curso) {

    include_once('connect.php');
    
    $sql = sprintf("select Aluno_Pessoa_Fisica_Pessoa_id_pessoa, null, a.Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa, a.Fase_Periodo_Fase_id_ano_serie, b.ds_nome, c.id_inscricao, b.dt_nascimento
                    , a.id_vaga
                    from matricula.vaga a, matricula.pessoa_fisica b, matricula.aluno c
                    where Fase_Periodo_Fase_Curso_id_curso = %s
                    and Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa = %s
                    and a.Aluno_Pessoa_Fisica_Pessoa_id_pessoa = b.Pessoa_id_pessoa
                    and b.Pessoa_id_pessoa = c.Pessoa_Fisica_Pessoa_id_pessoa
                    and b.Pessoa_id_pessoa in (select Aluno_Pessoa_Fisica_Pessoa_id_pessoa from matricula.vaga where Fase_Periodo_Fase_Curso_id_curso = %s)"
            , mysql_real_escape_string($curso)
            , mysql_real_escape_string($id_escola)
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


function buscaInscritosInfantilComVagaA($ano, $curso) {

    include_once('connect.php');

    $sql = sprintf("select Aluno_Pessoa_Fisica_Pessoa_id_pessoa, null, a.Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa, a.Fase_Periodo_Fase_id_ano_serie, b.ds_nome, c.id_inscricao, b.dt_nascimento
                    , a.id_vaga
                    from matricula.vaga a, matricula.pessoa_fisica b, matricula.aluno c
                    where Fase_Periodo_Fase_Curso_id_curso = %s
                    and Fase_Periodo_Periodo_id_ano = %s
                    and a.Aluno_Pessoa_Fisica_Pessoa_id_pessoa = b.Pessoa_id_pessoa
                    and b.Pessoa_id_pessoa = c.Pessoa_Fisica_Pessoa_id_pessoa
                    and b.Pessoa_id_pessoa in (select Aluno_Pessoa_Fisica_Pessoa_id_pessoa from matricula.vaga where Fase_Periodo_Fase_Curso_id_curso = %s)"
            , mysql_real_escape_string($curso)
            , mysql_real_escape_string($ano)
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


function buscaInscritosInfantilComVagaF($fase, $curso) {

    include_once('connect.php');

    $sql = sprintf("select Aluno_Pessoa_Fisica_Pessoa_id_pessoa, null, a.Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa, a.Fase_Periodo_Fase_id_ano_serie, b.ds_nome, c.id_inscricao, b.dt_nascimento
                    , a.id_vaga
                    from matricula.vaga a, matricula.pessoa_fisica b, matricula.aluno c
                    where Fase_Periodo_Fase_Curso_id_curso = %s
                    and Fase_Periodo_Fase_id_ano_serie = %s
                    and a.Aluno_Pessoa_Fisica_Pessoa_id_pessoa = b.Pessoa_id_pessoa
                    and b.Pessoa_id_pessoa = c.Pessoa_Fisica_Pessoa_id_pessoa
                    and b.Pessoa_id_pessoa in (select Aluno_Pessoa_Fisica_Pessoa_id_pessoa from matricula.vaga where Fase_Periodo_Fase_Curso_id_curso = %s)"
            , mysql_real_escape_string($curso)
            , mysql_real_escape_string($fase)
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


function buscaInscritosInfantilComVaga($curso) {

    include_once('connect.php');


    $sql = sprintf("select Aluno_Pessoa_Fisica_Pessoa_id_pessoa, null, a.Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa, a.Fase_Periodo_Fase_id_ano_serie, b.ds_nome, c.id_inscricao, b.dt_nascimento
                    , a.id_vaga
                    from matricula.vaga a, matricula.pessoa_fisica b, matricula.aluno c
                    where Fase_Periodo_Fase_Curso_id_curso = %s
                    and a.Aluno_Pessoa_Fisica_Pessoa_id_pessoa = b.Pessoa_id_pessoa
                    and b.Pessoa_id_pessoa = c.Pessoa_Fisica_Pessoa_id_pessoa
                    and b.Pessoa_id_pessoa in (select Aluno_Pessoa_Fisica_Pessoa_id_pessoa from matricula.vaga where Fase_Periodo_Fase_Curso_id_curso = %s)"
            , mysql_real_escape_string($curso)
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