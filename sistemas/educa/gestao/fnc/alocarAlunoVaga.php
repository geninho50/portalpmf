<?php

function alocarAlunoVaga($aluno, $escola, $curso, $ano_serie, $ano, $periodo) {

	include_once('connect.php');

    $sql = sprintf("UPDATE matricula.vaga a
	set Aluno_Pessoa_Fisica_Pessoa_id_pessoa = %s
	where a.Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa = %s
	and a.Fase_Periodo_Fase_Curso_id_curso = %s
	and a.Fase_Periodo_Fase_id_ano_serie = %s
	and a.Fase_Periodo_Periodo_id_ano = %s
	and a.Fase_Periodo_Periodo_id_periodo = %s
	and (a.Tipo_Vaga_id_tipo_vaga = 1 or a.Tipo_Vaga_id_tipo_vaga = 3)
	and a.Aluno_Pessoa_Fisica_Pessoa_id_pessoa is null
	order by a.id_vaga asc limit 1"
            , mysql_real_escape_string($aluno)
            , mysql_real_escape_string($escola)
            , mysql_real_escape_string($curso)
            , mysql_real_escape_string($ano_serie)
            , mysql_real_escape_string($ano)
            , mysql_real_escape_string($periodo));

    $resultado = mysql_query($sql);
    
    if($resultado){
        $linhas = mysql_affected_rows();
        if($linhas == 1){
            return true;
        }
    }
    
    return false;
}

?>