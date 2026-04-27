<?php

function buscaComQuemMora($id_aluno) {

    include_once('connect.php');

    $sql = sprintf("select * from matricula.responsavel_aluno a
                    where a.Aluno_Pessoa_Fisica_Pessoa_id_pessoa = %s
                    and mora_com = 1", mysql_real_escape_string($id_aluno));

    $resultado = mysql_query($sql);

    $row = true;
    $i = 0;

    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $comQuemMora[$i] = $row;
        }
        $i++;
    }

    if (isset($comQuemMora)) {
        return $comQuemMora;
    } else {
        return false;
    }
}

?>