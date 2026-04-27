<?php

function buscaTel($id_aluno) {

    include_once('connect.php');

    $sql = sprintf("SELECT * FROM matricula.telefone
                    where Pessoa_id_pessoa = %s
                    and Tipo_Telefone_id_tipo_telefone = 1 
                    limit 1", mysql_real_escape_string($id_aluno));

    $resultado = mysql_query($sql);

    $row = true;

    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $aluno[1] = $row;
        }
    }

    $sql = sprintf("SELECT * FROM matricula.telefone
                    where Pessoa_id_pessoa = %s
                    and Tipo_Telefone_id_tipo_telefone = 2 
                    limit 1", mysql_real_escape_string($id_aluno));

    $resultado = mysql_query($sql);

    $row = true;

    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $aluno[2] = $row;
        }
    }

    $sql = sprintf("SELECT * FROM matricula.telefone
                    where Pessoa_id_pessoa = %s
                    and Tipo_Telefone_id_tipo_telefone = 3 
                    limit 1", mysql_real_escape_string($id_aluno));

    $resultado = mysql_query($sql);

    $row = true;

    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $aluno[3] = $row;
        }
    }
    if (isset($aluno)) {
        return $aluno;
    }

    return false;
}

?>