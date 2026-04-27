<?php

function buscaEstadoCivil($id_aluno) {

    include_once('connect.php');

    $sql = sprintf("SELECT Estado_Civil_id_estado_civil  FROM matricula.pessoa_fisica
                    where Pessoa_id_pessoa = %s", mysql_real_escape_string($id_aluno));

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
        return null;
    }
}

?>