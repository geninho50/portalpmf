<?php

function buscaInfoAluno($id_aluno) {

    include_once('connect.php');

    $sql = sprintf("select r.ds_sexo, r.Etnia_id_etnia, r.id_nacionalidade, r.id_naturalidade, l.Estado_id_estado, l.cd_ibge from matricula.pessoa_fisica r, matricula.localidade l
                    where r.Pessoa_id_pessoa = %s
                    and r.id_naturalidade = l.id_localidade", mysql_real_escape_string($id_aluno));

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
    } else {

        $sql = sprintf("select r.ds_sexo, r.Etnia_id_etnia, r.id_nacionalidade from matricula.pessoa_fisica r
                    where r.Pessoa_id_pessoa = %s", mysql_real_escape_string($id_aluno));

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
        return false;
    }
}

?>