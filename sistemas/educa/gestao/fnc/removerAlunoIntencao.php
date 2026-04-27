<?php

function removerAlunoIntencao($id_aluno, $escola, $curso, $fase, $ano, $periodo) {

    include_once('connect.php');

    $sql = sprintf("delete from matricula.lista_aluno_atendidas
        where id_aluno = %s                                                                        
        and Lista_Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa = %s
        and Lista_Fase_Periodo_Fase_Curso_id_curso = %s
        and Lista_Fase_Periodo_Fase_id_ano_serie = %s
        and Lista_Fase_Periodo_Periodo_id_ano = %s
        and Lista_Fase_Periodo_Periodo_id_periodo = %s)",
    mysql_real_escape_string($id_aluno),  
    mysql_real_escape_string($escola),  
    mysql_real_escape_string($curso),  
    mysql_real_escape_string($fase),  
    mysql_real_escape_string($ano), 
    mysql_real_escape_string($periodo));
    $resultado = mysql_query($sql);

    $sql = sprintf("insert into matricula.lista_aluno_atendidas (select * from matricula.lista_aluno where id_aluno = %s                                                                        
        and Lista_Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa = %s
        and Lista_Fase_Periodo_Fase_Curso_id_curso = %s
        and Lista_Fase_Periodo_Fase_id_ano_serie = %s
        and Lista_Fase_Periodo_Periodo_id_ano = %s
        and Lista_Fase_Periodo_Periodo_id_periodo = %s)",
    mysql_real_escape_string($id_aluno),  
    mysql_real_escape_string($escola),  
    mysql_real_escape_string($curso),  
    mysql_real_escape_string($fase),  
    mysql_real_escape_string($ano), 
    mysql_real_escape_string($periodo));
    $resultado = mysql_query($sql);

    $sql = sprintf("delete FROM matricula.lista_aluno 
        where id_aluno = %s
        and Lista_Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa = %s
        and Lista_Fase_Periodo_Fase_Curso_id_curso = %s
        and Lista_Fase_Periodo_Fase_id_ano_serie = %s
        and Lista_Fase_Periodo_Periodo_id_ano = %s
        and Lista_Fase_Periodo_Periodo_id_periodo = %s", 
        mysql_real_escape_string($id_aluno),  
        mysql_real_escape_string($escola),  
        mysql_real_escape_string($curso),  
        mysql_real_escape_string($fase),  
        mysql_real_escape_string($ano), 
        mysql_real_escape_string($periodo));

    $resultado = mysql_query($sql);
    
    return $resultado;

}

function removerAlunoIntencaoTodas($id_aluno) {

    include_once('connect.php');

    $sql = sprintf("delete from matricula.lista_aluno_atendidas
        where id_aluno = %s
        and Lista_Fase_Periodo_Periodo_id_periodo in 
        (select Lista_Fase_Periodo_Periodo_id_periodo from matricula.lista_aluno where id_aluno = %s)
        and Lista_Fase_Periodo_Periodo_id_ano in 
        (select Lista_Fase_Periodo_Periodo_id_ano from matricula.lista_aluno where id_aluno = %s)
        and Lista_Fase_Periodo_Fase_id_ano_serie in 
        (select Lista_Fase_Periodo_Fase_id_ano_serie from matricula.lista_aluno where id_aluno = %s)
        and Lista_Fase_Periodo_Fase_Curso_id_curso in 
        (select Lista_Fase_Periodo_Fase_Curso_id_curso from matricula.lista_aluno where id_aluno = %s)
        and Lista_Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa in 
        (select Lista_Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa from matricula.lista_aluno where id_aluno = %s)"
        , mysql_real_escape_string($id_aluno)
        , mysql_real_escape_string($id_aluno)
        , mysql_real_escape_string($id_aluno)
        , mysql_real_escape_string($id_aluno)
        , mysql_real_escape_string($id_aluno)
        , mysql_real_escape_string($id_aluno));
$resultado = mysql_query($sql);

$sql = sprintf("insert into matricula.lista_aluno_atendidas (select * from matricula.lista_aluno where id_aluno = %s)"
    , mysql_real_escape_string($id_aluno));
$resultado = mysql_query($sql);

$sql = sprintf("delete FROM matricula.lista_aluno 
    where id_aluno = %s", 
    mysql_real_escape_string($id_aluno));

$resultado = mysql_query($sql);

return $resultado;

}

?>
