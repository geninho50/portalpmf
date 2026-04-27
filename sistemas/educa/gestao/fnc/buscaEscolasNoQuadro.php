<?php


function buscaEscolasNoQuadro($curso){

	include_once('connect.php');

	$sql = sprintf("select distinct(Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa) as escola from
		(SELECT count(*) as quantidade_vagas, 
			Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa, 
			Fase_Periodo_Fase_id_ano_serie, 
			Tipo_Vaga_id_tipo_vaga FROM matricula.vaga
			where Fase_Periodo_Fase_Curso_id_curso = %s
			group by Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa, Fase_Periodo_Fase_id_ano_serie, Tipo_Vaga_id_tipo_vaga) a, matricula.escola b
where a.Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa = b.Pessoa_Juridica_Pessoa_id_pessoa
	order by b.ds_nome", mysql_real_escape_string($curso));

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

function buscaEscolasNoQuadroEscola($curso, $escola){

	include_once('connect.php');

	$sql = sprintf("select distinct(Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa) as escola from
		(SELECT count(*) as quantidade_vagas, 
			Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa, 
			Fase_Periodo_Fase_id_ano_serie, 
			Tipo_Vaga_id_tipo_vaga FROM matricula.vaga
			where Fase_Periodo_Fase_Curso_id_curso = %s
			and Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa = %s
			group by Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa, Fase_Periodo_Fase_id_ano_serie, Tipo_Vaga_id_tipo_vaga) a
	order by Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa", mysql_real_escape_string($curso), mysql_real_escape_string($escola));

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