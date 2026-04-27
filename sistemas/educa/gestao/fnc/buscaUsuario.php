<?php

function buscaUsuario($id_pessoa) {

    include_once('connect.php');

    $sql = sprintf("SELECT * FROM matricula.login
        where Pessoa_Fisica_Pessoa_id_pessoa = %s
        limit 1", mysql_real_escape_string($id_pessoa));

    $resultado = mysql_query($sql);

    $row = true;
    
    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $pessoa = $row;
        }
    }
    return $pessoa;
}

?>