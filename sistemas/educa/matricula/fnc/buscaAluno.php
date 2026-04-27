<?php

function buscaAluno($id_aluno) {

    include_once('connect.php');

    $sql = sprintf("select r.ds_nome, r.dt_nascimento, t.id_inscricao, r.Pessoa_id_pessoa from matricula.aluno t, matricula.pessoa_fisica r
                    where t.Pessoa_Fisica_Pessoa_id_pessoa = %s
                    and r.Pessoa_id_pessoa = t.Pessoa_Fisica_Pessoa_id_pessoa", mysql_real_escape_string($id_aluno));

    $resultado = mysql_query($sql);

    $row = true;

    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $aluno = $row;
        }
    }

    if (isset($aluno)) {
        return $aluno;
    }
    return null;
}

?>