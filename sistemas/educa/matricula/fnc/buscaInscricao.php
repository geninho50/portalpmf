<?php

function buscaInscricao($id) {

    include_once('connect.php');

    $sql = sprintf("SELECT id_inscricao FROM matricula.aluno
                    where Pessoa_Fisica_Pessoa_id_pessoa = %s", mysql_real_escape_string($id));

    $resultado = mysql_query($sql);

    $row = true;

    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $email = $row;
        }
    }
    if (isset($email)) {
        return $email;
    } else {
        return false;
    }
}

?>