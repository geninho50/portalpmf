<?php

function consultaAluno($nome, $matricula){

	include_once('connect.php');

	$sql = sprintf("select distinct Pessoa_Fisica_Pessoa_id_pessoa, a.id_inscricao, e.ds_nome from matricula.aluno a, matricula.pessoa_fisica e
		where (a.Pessoa_Fisica_Pessoa_id_pessoa in (select b.Aluno_Pessoa_Fisica_Pessoa_id_pessoa from matricula.vaga b)
			or a.Pessoa_Fisica_Pessoa_id_pessoa in (select c.id_aluno from matricula.lista_aluno c)
			or a.Pessoa_Fisica_Pessoa_id_pessoa in (select d.id_pessoa from matricula.aluno_eja d))
	and e.Pessoa_id_pessoa = a.Pessoa_Fisica_Pessoa_id_pessoa
	and e.ds_nome like '%s'
	and a.id_inscricao like '%s'", mysql_real_escape_string('%'.strtoupper($nome).'%'), mysql_real_escape_string('%'.strtoupper($matricula).'%'));

	$resultado = mysql_query($sql);

	$row = true;
	$i = 0;

	while ($row != FALSE) {
		$row = mysql_fetch_row($resultado);
		if ($row[0] != '') {
			$alunos[$i++] = $row;
		}
	}

	if (isset ($alunos)){
		return $alunos;
	}else{
		return FALSE;
	}
}


function consultaAlunoInfantil($nome, $matricula){

	include_once('connect.php');

	$sql = sprintf("select distinct Pessoa_Fisica_Pessoa_id_pessoa, a.id_inscricao, e.ds_nome from matricula.aluno a, matricula.pessoa_fisica e
		where (a.Pessoa_Fisica_Pessoa_id_pessoa in (select b.Aluno_Pessoa_Fisica_Pessoa_id_pessoa from matricula.vaga b where b.Fase_Periodo_Fase_Curso_id_curso = 2)
			or a.Pessoa_Fisica_Pessoa_id_pessoa in (select c.id_aluno from matricula.lista_aluno c where c.Lista_Fase_Periodo_Fase_Curso_id_curso = 2))
	and e.Pessoa_id_pessoa = a.Pessoa_Fisica_Pessoa_id_pessoa
	and e.ds_nome like '%s'
	and a.id_inscricao like '%s'", mysql_real_escape_string('%'.strtoupper($nome).'%'), mysql_real_escape_string('%'.strtoupper($matricula).'%'));

	$resultado = mysql_query($sql);

	$row = true;
	$i = 0;

	while ($row != FALSE) {
		$row = mysql_fetch_row($resultado);
		if ($row[0] != '') {
			$alunos[$i++] = $row;
		}
	}

	if (isset ($alunos)){
		return $alunos;
	}else{
		return FALSE;
	}
}

function consultaAlunoFundamental($nome, $matricula){

	include_once('connect.php');

	$sql = sprintf("select distinct Pessoa_Fisica_Pessoa_id_pessoa, a.id_inscricao, e.ds_nome from matricula.aluno a, matricula.pessoa_fisica e
		where (a.Pessoa_Fisica_Pessoa_id_pessoa in (select b.Aluno_Pessoa_Fisica_Pessoa_id_pessoa from matricula.vaga b where b.Fase_Periodo_Fase_Curso_id_curso = 1)
			or a.Pessoa_Fisica_Pessoa_id_pessoa in (select c.id_aluno from matricula.lista_aluno c where c.Lista_Fase_Periodo_Fase_Curso_id_curso = 1))
	and e.Pessoa_id_pessoa = a.Pessoa_Fisica_Pessoa_id_pessoa
	and e.ds_nome like '%s'
	and a.id_inscricao like '%s'", mysql_real_escape_string('%'.strtoupper($nome).'%'), mysql_real_escape_string('%'.strtoupper($matricula).'%'));

	$resultado = mysql_query($sql);

	$row = true;
	$i = 0;

	while ($row != FALSE) {
		$row = mysql_fetch_row($resultado);
		if ($row[0] != '') {
			$alunos[$i++] = $row;
		}
	}

	if (isset ($alunos)){
		return $alunos;
	}else{
		return FALSE;
	}
}

function consultaAlunoEja($nome, $matricula){

	include_once('connect.php');

	$sql = sprintf("select distinct Pessoa_Fisica_Pessoa_id_pessoa, a.id_inscricao, e.ds_nome from matricula.aluno a, matricula.pessoa_fisica e
		where a.Pessoa_Fisica_Pessoa_id_pessoa in (select b.Aluno_Pessoa_Fisica_Pessoa_id_pessoa from matricula.vaga b where b.Fase_Periodo_Fase_Curso_id_curso = 3)
	and e.Pessoa_id_pessoa = a.Pessoa_Fisica_Pessoa_id_pessoa
	and e.ds_nome like '%s'
	and a.id_inscricao like '%s'", mysql_real_escape_string('%'.strtoupper($nome).'%'), mysql_real_escape_string('%'.strtoupper($matricula).'%'));

	$resultado = mysql_query($sql);

	$row = true;
	$i = 0;

	while ($row != FALSE) {
		$row = mysql_fetch_row($resultado);
		if ($row[0] != '') {
			$alunos[$i++] = $row;
		}
	}

	if (isset ($alunos)){
		return $alunos;
	}else{
		return FALSE;
	}
}

function consultaAlunoDesistenteIntencao($nome, $matricula){

	include_once('connect.php');

	$sql = sprintf("select distinct Pessoa_Fisica_Pessoa_id_pessoa, a.id_inscricao, e.ds_nome from matricula.aluno a, matricula.pessoa_fisica e
		where (a.Pessoa_Fisica_Pessoa_id_pessoa in (select b.id_aluno from matricula.`auditoria_intencao_infantil_remover` b))
	and e.Pessoa_id_pessoa = a.Pessoa_Fisica_Pessoa_id_pessoa
	and e.ds_nome like '%s'
	and a.id_inscricao like '%s'", mysql_real_escape_string('%'.strtoupper($nome).'%'), mysql_real_escape_string('%'.strtoupper($matricula).'%'));

	$resultado = mysql_query($sql);

	$row = true;
	$i = 0;

	while ($row != FALSE) {
		$row = mysql_fetch_row($resultado);
		if ($row[0] != '') {
			$alunos[$i++] = $row;
		}
	}

	if (isset ($alunos)){
		return $alunos;
	}else{
		return FALSE;
	}
}

?>