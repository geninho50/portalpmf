<?php

function atualizarCqmQA($aluno, $parentesco, $cqm, $qa) {

    include_once('connect.php');

    $sql = sprintf("UPDATE matricula.responsavel_aluno a
	set mora_com = %s,
    acompanha = %s
	where a.Aluno_Pessoa_Fisica_Pessoa_id_pessoa = %s
	and a.Parentesco_id_parentesco = %s"
            , mysql_real_escape_string($cqm)
            , mysql_real_escape_string($qa)
            , mysql_real_escape_string($aluno)
            , mysql_real_escape_string($parentesco));

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