<?php

function buscaRematriculadosIAF($id_escola, $ano, $fase, $curso) {

   	include_once('connect.php');


    $sql = sprintf("SELECT b.id_inscricao, 
            c.ds_nome, 
            DATE_FORMAT(c.dt_nascimento, '%s'), 
            if(a.Tipo_Vaga_id_tipo_vaga = 1, 'Novo Aluno', 'Rematrícula'),
                a.Aluno_Pessoa_Fisica_Pessoa_id_pessoa,
            a.id_efetivado,
            a.id_vaga,
            a.Fase_Periodo_Fase_id_ano_serie,
            a.dt_rematricula_realizada, a.Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa
            FROM matricula.vaga a, matricula.aluno b, matricula.pessoa_fisica c
            where a.Aluno_Pessoa_Fisica_Pessoa_id_pessoa is not null
            and a.Fase_Periodo_Fase_Curso_id_curso = %s
            and a.Fase_Periodo_Periodo_id_ano = %s
            and a.Fase_Periodo_Fase_id_ano_serie = %s            
            and a.Aluno_Pessoa_Fisica_Pessoa_id_pessoa = b.Pessoa_Fisica_Pessoa_id_pessoa
            and a.Aluno_Pessoa_Fisica_Pessoa_id_pessoa = c.Pessoa_id_pessoa
            and a.Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa = %s
            and a.id_rematricula_realizada = 1"
            , mysql_real_escape_string('%d/%m/%Y')
            , mysql_real_escape_string($curso)
            , mysql_real_escape_string($ano)
            , mysql_real_escape_string($fase)
            , mysql_real_escape_string($id_escola));
    
    $resultado = mysql_query($sql);

    var_dump($sql);

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


function buscaRematriculadosIA($id_escola, $ano, $fase, $curso) {


   	include_once('connect.php');


    $sql = sprintf("SELECT b.id_inscricao, 
            c.ds_nome, 
            DATE_FORMAT(c.dt_nascimento, '%s'), 
            if(a.Tipo_Vaga_id_tipo_vaga = 1, 'Novo Aluno', 'Rematrícula'),
                a.Aluno_Pessoa_Fisica_Pessoa_id_pessoa,
            a.id_efetivado,
            a.id_vaga,
            a.Fase_Periodo_Fase_id_ano_serie,
            a.dt_rematricula_realizada, a.Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa
            FROM matricula.vaga a, matricula.aluno b, matricula.pessoa_fisica c
            where a.Aluno_Pessoa_Fisica_Pessoa_id_pessoa is not null
            and a.Fase_Periodo_Fase_Curso_id_curso = %s
            and a.Fase_Periodo_Periodo_id_ano = %s
            and a.Aluno_Pessoa_Fisica_Pessoa_id_pessoa = b.Pessoa_Fisica_Pessoa_id_pessoa
            and a.Aluno_Pessoa_Fisica_Pessoa_id_pessoa = c.Pessoa_id_pessoa
            and a.Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa = %s
            and a.id_rematricula_realizada = 1"
            , mysql_real_escape_string('%d/%m/%Y')
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


function buscaRematriculadosAF($ano, $fase, $curso) {

 	include_once('connect.php');

    $sql = sprintf("SELECT b.id_inscricao, 
            c.ds_nome, 
            DATE_FORMAT(c.dt_nascimento, '%s'), 
            if(a.Tipo_Vaga_id_tipo_vaga = 1, 'Novo Aluno', 'Rematrícula'),
                a.Aluno_Pessoa_Fisica_Pessoa_id_pessoa,
            a.id_efetivado,
            a.id_vaga,
            a.Fase_Periodo_Fase_id_ano_serie,
            a.dt_rematricula_realizada, a.Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa
            FROM matricula.vaga a, matricula.aluno b, matricula.pessoa_fisica c
            where a.Aluno_Pessoa_Fisica_Pessoa_id_pessoa is not null
            and a.Fase_Periodo_Fase_Curso_id_curso = %s
            and a.Fase_Periodo_Periodo_id_ano = %s
            and a.Fase_Periodo_Fase_id_ano_serie = %s
            and a.Aluno_Pessoa_Fisica_Pessoa_id_pessoa = b.Pessoa_Fisica_Pessoa_id_pessoa
            and a.Aluno_Pessoa_Fisica_Pessoa_id_pessoa = c.Pessoa_id_pessoa
            and a.id_rematricula_realizada = 1"
            , mysql_real_escape_string('%d/%m/%Y')
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


function buscaRematriculadosIF($id_escola, $fase, $curso) {

  	include_once('connect.php');

    $sql = sprintf("SELECT b.id_inscricao, 
            c.ds_nome, 
            DATE_FORMAT(c.dt_nascimento, '%s'), 
            if(a.Tipo_Vaga_id_tipo_vaga = 1, 'Novo Aluno', 'Rematrícula'),
                a.Aluno_Pessoa_Fisica_Pessoa_id_pessoa,
            a.id_efetivado,
            a.id_vaga,
            a.Fase_Periodo_Fase_id_ano_serie,
            a.dt_rematricula_realizada, a.Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa
            FROM matricula.vaga a, matricula.aluno b, matricula.pessoa_fisica c
            where a.Aluno_Pessoa_Fisica_Pessoa_id_pessoa is not null
            and a.Fase_Periodo_Fase_Curso_id_curso = %s
            and a.Fase_Periodo_Fase_id_ano_serie = %s            
            and a.Aluno_Pessoa_Fisica_Pessoa_id_pessoa = b.Pessoa_Fisica_Pessoa_id_pessoa
            and a.Aluno_Pessoa_Fisica_Pessoa_id_pessoa = c.Pessoa_id_pessoa
            and a.Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa = %s
            and a.id_rematricula_realizada = 1"
            , mysql_real_escape_string('%d/%m/%Y')
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


function buscaRematriculadosI($id_escola, $curso) {

 	include_once('connect.php');
    
    $sql = sprintf("SELECT b.id_inscricao, 
            c.ds_nome, 
            DATE_FORMAT(c.dt_nascimento, '%s'), 
            if(a.Tipo_Vaga_id_tipo_vaga = 1, 'Novo Aluno', 'Rematrícula'),
                a.Aluno_Pessoa_Fisica_Pessoa_id_pessoa,
            a.id_efetivado,
            a.id_vaga,
            a.Fase_Periodo_Fase_id_ano_serie,
            a.dt_rematricula_realizada, a.Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa
            FROM matricula.vaga a, matricula.aluno b, matricula.pessoa_fisica c
            where a.Aluno_Pessoa_Fisica_Pessoa_id_pessoa is not null
            and a.Fase_Periodo_Fase_Curso_id_curso = %s            
            and a.Aluno_Pessoa_Fisica_Pessoa_id_pessoa = b.Pessoa_Fisica_Pessoa_id_pessoa
            and a.Aluno_Pessoa_Fisica_Pessoa_id_pessoa = c.Pessoa_id_pessoa
            and a.Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa = %s
            and a.id_rematricula_realizada = 1"
            , mysql_real_escape_string('%d/%m/%Y')
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


function buscaRematriculadosA($ano, $curso) {

  	include_once('connect.php');

    $sql = sprintf("SELECT b.id_inscricao, 
            c.ds_nome, 
            DATE_FORMAT(c.dt_nascimento, '%s'), 
            if(a.Tipo_Vaga_id_tipo_vaga = 1, 'Novo Aluno', 'Rematrícula'),
                a.Aluno_Pessoa_Fisica_Pessoa_id_pessoa,
            a.id_efetivado,
            a.id_vaga,
            a.Fase_Periodo_Fase_id_ano_serie,
            a.dt_rematricula_realizada, a.Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa
            FROM matricula.vaga a, matricula.aluno b, matricula.pessoa_fisica c
            where a.Aluno_Pessoa_Fisica_Pessoa_id_pessoa is not null
            and a.Fase_Periodo_Fase_Curso_id_curso = %s
            and a.Fase_Periodo_Periodo_id_ano = %s          
            and a.Aluno_Pessoa_Fisica_Pessoa_id_pessoa = b.Pessoa_Fisica_Pessoa_id_pessoa
            and a.Aluno_Pessoa_Fisica_Pessoa_id_pessoa = c.Pessoa_id_pessoa
            and a.id_rematricula_realizada = 1"
            , mysql_real_escape_string('%d/%m/%Y')
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


function buscaRematriculadosF($fase, $curso) {

  	include_once('connect.php');

    $sql = sprintf("SELECT b.id_inscricao, 
            c.ds_nome, 
            DATE_FORMAT(c.dt_nascimento, '%s'), 
            if(a.Tipo_Vaga_id_tipo_vaga = 1, 'Novo Aluno', 'Rematrícula'),
                a.Aluno_Pessoa_Fisica_Pessoa_id_pessoa,
            a.id_efetivado,
            a.id_vaga,
            a.Fase_Periodo_Fase_id_ano_serie,
            a.dt_rematricula_realizada, a.Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa
            FROM matricula.vaga a, matricula.aluno b, matricula.pessoa_fisica c
            where a.Aluno_Pessoa_Fisica_Pessoa_id_pessoa is not null
            and a.Fase_Periodo_Fase_Curso_id_curso = %s
            and a.Fase_Periodo_Fase_id_ano_serie = %s
            and a.Aluno_Pessoa_Fisica_Pessoa_id_pessoa = b.Pessoa_Fisica_Pessoa_id_pessoa
            and a.Aluno_Pessoa_Fisica_Pessoa_id_pessoa = c.Pessoa_id_pessoa
            and a.id_rematricula_realizada = 1"
            , mysql_real_escape_string('%d/%m/%Y')
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


function buscaRematriculados($curso) {

 	include_once('connect.php');


    $sql = sprintf("SELECT b.id_inscricao, 
            c.ds_nome, 
            DATE_FORMAT(c.dt_nascimento, '%s'), 
            if(a.Tipo_Vaga_id_tipo_vaga = 1, 'Novo Aluno', 'Rematrícula'),
                a.Aluno_Pessoa_Fisica_Pessoa_id_pessoa,
            a.id_efetivado,
            a.id_vaga,
            a.Fase_Periodo_Fase_id_ano_serie,
            a.dt_rematricula_realizada, a.Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa
            FROM matricula.vaga a, matricula.aluno b, matricula.pessoa_fisica c
            where a.Aluno_Pessoa_Fisica_Pessoa_id_pessoa is not null
            and a.Fase_Periodo_Fase_Curso_id_curso = %s
            and a.Aluno_Pessoa_Fisica_Pessoa_id_pessoa = b.Pessoa_Fisica_Pessoa_id_pessoa
            and a.Aluno_Pessoa_Fisica_Pessoa_id_pessoa = c.Pessoa_id_pessoa
            and a.id_rematricula_realizada = 1"
            , mysql_real_escape_string('%d/%m/%Y')
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

function buscaRematriculadosEJA($curso) {

  	include_once('connect.php');


    $sql = sprintf("SELECT b.id_inscricao, 
            c.ds_nome, 
            DATE_FORMAT(c.dt_nascimento, '%s'), 
            if(a.Tipo_Vaga_id_tipo_vaga = 1, 'Novo Aluno', 'Rematrícula'),
                a.Aluno_Pessoa_Fisica_Pessoa_id_pessoa,
            a.id_efetivado,
            a.id_vaga,
            a.Fase_Periodo_Fase_id_ano_serie,
            a.dt_rematricula_realizada, a.Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa
            FROM matricula.vaga a, matricula.aluno b, matricula.pessoa_fisica c
            where a.Aluno_Pessoa_Fisica_Pessoa_id_pessoa is not null
            and a.Fase_Periodo_Fase_Curso_id_curso = %s
            and a.Aluno_Pessoa_Fisica_Pessoa_id_pessoa = b.Pessoa_Fisica_Pessoa_id_pessoa
            and a.Aluno_Pessoa_Fisica_Pessoa_id_pessoa = c.Pessoa_id_pessoa
            and a.id_rematricula_realizada = 1"
            , mysql_real_escape_string('%d/%m/%Y')
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