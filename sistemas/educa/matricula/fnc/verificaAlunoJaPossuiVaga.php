<?php

function verificaAlunoJaPossuiVaga($nome, $dt_nasc, $nm_mae){

	include_once('connect.php');

	$sql = sprintf("SELECT b.Pessoa_id_pessoa FROM matricula.vaga a, matricula.pessoa_fisica b, matricula.aluno c
		where a.Aluno_Pessoa_Fisica_Pessoa_id_pessoa = b.Pessoa_id_pessoa
		and c.Pessoa_Fisica_Pessoa_id_pessoa = a.Aluno_Pessoa_Fisica_Pessoa_id_pessoa
		
		and b.dt_nascimento = '%s'
		and b.ds_nome = '%s'", mysql_real_escape_string($dt_nasc), mysql_real_escape_string($nome));	

	$resultado = mysql_query($sql);

	if($resultado != false){
		$row = true;

		while ($row != FALSE) {
			$row = mysql_fetch_row($resultado);
			if ($row[0] != '') {
				$aluno = $row;
			}
		}
		if(isset($aluno)){
			return $aluno;
		} else {
			return false;
		}
	} else {
		return false;
	}

}

?>