<?php

function buscaVagasEscolaFundamental($escola){

    include_once('connect.php');

	$sql = sprintf("select * from
(SELECT count(*) as quantidade_vagas, 
	Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa, 
	Fase_Periodo_Fase_id_ano_serie, 
	Tipo_Vaga_id_tipo_vaga FROM matricula.vaga
	where Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa = %s
	and Fase_Periodo_Fase_Curso_id_curso = 1
	group by Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa, Fase_Periodo_Fase_id_ano_serie, Tipo_Vaga_id_tipo_vaga

	union all

	SELECT count(*) as quantidade_vagas, 
	Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa, 
	Fase_Periodo_Fase_id_ano_serie, 
	4 FROM matricula.vaga
	where Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa = %s
	and Fase_Periodo_Fase_Curso_id_curso = 1
	group by Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa, Fase_Periodo_Fase_id_ano_serie) z
	order by Fase_Periodo_Fase_id_ano_serie"
	, mysql_real_escape_string($escola)
	, mysql_real_escape_string($escola));

	  $resultado = mysql_query($sql);

    $row = true;
    $i = 0;

    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $aluno[$i++] = $row;
        }
    }
    if(isset($aluno)){
        return $aluno;
    }
    
    return false;

}

function buscaVagasEscolaFundamentalTudo($escola){

    include_once('connect.php');

	$sql = sprintf("select * from
(SELECT count(*) as quantidade_vagas, Fase_Periodo_Fase_id_ano_serie,
	Tipo_Vaga_id_tipo_vaga FROM matricula.vaga
	where Fase_Periodo_Fase_Curso_id_curso = 1
and Tipo_Vaga_id_tipo_vaga != 3
	group by Fase_Periodo_fase_id_ano_serie, Tipo_Vaga_id_tipo_vaga

	union all

	SELECT count(*) as quantidade_vagas, Fase_Periodo_Fase_id_ano_serie,
	4 FROM matricula.vaga
	where Fase_Periodo_Fase_Curso_id_curso = 1
and Tipo_Vaga_id_tipo_vaga != 3
group by Fase_Periodo_fase_id_ano_serie) z
order by Fase_Periodo_Fase_id_ano_serie");

	  $resultado = mysql_query($sql);

    $row = true;
    $i = 0;

    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $aluno[$i++] = $row;
        }
    }
    if(isset($aluno)){
        return $aluno;
    }
    
    return false;

}

function buscaVagasEscolaFundamentalNovo($escola){

    include_once('connect.php');

	$sql = sprintf("select * from
	(SELECT count(*) as quantidade_vagas, 
	Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa, 
	Fase_Periodo_Fase_id_ano_serie, 
	Tipo_Vaga_id_tipo_vaga FROM matricula.vaga
	where Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa = %s
	and Fase_Periodo_Fase_Curso_id_curso = 1
	and Tipo_Vaga_id_tipo_vaga = 1
	and Aluno_Pessoa_Fisica_Pessoa_id_pessoa is not null
	group by Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa, Fase_Periodo_Fase_id_ano_serie, Tipo_Vaga_id_tipo_vaga

	union all

	SELECT count(*) as quantidade_vagas, 
	Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa, 
	Fase_Periodo_Fase_id_ano_serie, 
	3 FROM matricula.vaga
	where Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa = %s
	and Fase_Periodo_Fase_Curso_id_curso = 1
	and Tipo_Vaga_id_tipo_vaga = 1
	group by Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa, Fase_Periodo_Fase_id_ano_serie) z
	order by Fase_Periodo_Fase_id_ano_serie"
	, mysql_real_escape_string($escola)
	, mysql_real_escape_string($escola));

	  $resultado = mysql_query($sql);

    $row = true;
    $i = 0;

    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $aluno[$i++] = $row;
        }
    }
    if(isset($aluno)){
        return $aluno;
    }
    
    return false;

}

function buscaVagasEscolaFundamentalReserva($escola){

    include_once('connect.php');

	$sql = sprintf("select * from
	(SELECT count(*) as quantidade_vagas, 
	Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa, 
	Fase_Periodo_Fase_id_ano_serie, 
	Tipo_Vaga_id_tipo_vaga FROM matricula.vaga
	where Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa = %s
	and Fase_Periodo_Fase_Curso_id_curso = 1
	and Tipo_Vaga_id_tipo_vaga = 3
	and Aluno_Pessoa_Fisica_Pessoa_id_pessoa is not null
	group by Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa, Fase_Periodo_Fase_id_ano_serie, Tipo_Vaga_id_tipo_vaga

	union all

	SELECT count(*) as quantidade_vagas, 
	Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa, 
	Fase_Periodo_Fase_id_ano_serie, 
	4 FROM matricula.vaga
	where Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa = %s
	and Fase_Periodo_Fase_Curso_id_curso = 1
	and Tipo_Vaga_id_tipo_vaga = 3
	group by Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa, Fase_Periodo_Fase_id_ano_serie) z
	order by Fase_Periodo_Fase_id_ano_serie"
	, mysql_real_escape_string($escola)
	, mysql_real_escape_string($escola));

	  $resultado = mysql_query($sql);

    $row = true;
    $i = 0;

    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $aluno[$i++] = $row;
        }
    }
    if(isset($aluno)){
        return $aluno;
    }
    
    return false;

}


?>