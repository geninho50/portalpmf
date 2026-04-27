<?php

function buscaQuemAcompanha($id_aluno) {

    include_once('connect.php');
	
    $sql = sprintf("select * from matricula.responsavel_aluno a
                    where a.Aluno_Pessoa_Fisica_Pessoa_id_pessoa = %s
                    and acompanha = 1", mysql_real_escape_string($id_aluno));

    $resultado = mysql_query($sql);

    $row = true;
    $i = 0;

    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $quemAcompanha[$i] = $row;
        }
        $i++;
    }
    if (isset($quemAcompanha)) {
        return $quemAcompanha;
    }

    return false;
}

function buscaQuemAcompanhaParentesco($id_aluno, $parentesco) {

    include_once('connect.php');

    $sql = sprintf("select 1 from matricula.responsavel_aluno a
                    where a.Aluno_Pessoa_Fisica_Pessoa_id_pessoa = %s
                    and acompanha = 1
                    and Parentesco_id_parentesco = %s", mysql_real_escape_string($id_aluno), mysql_real_escape_string($parentesco));

    $resultado = mysql_query($sql);

    $row = true;
    $i = 0;

    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $quemAcompanha[$i] = $row;
        }
        $i++;
    }
    if (isset($quemAcompanha)) {
        return true;
    }

    return false;
}

?>