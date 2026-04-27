<?php

function buscaEscola($id_escola) {

    include_once('connect.php');

    $sql = sprintf("select * from matricula.escola t where t.Pessoa_Juridica_Pessoa_id_pessoa = %s", mysql_real_escape_string($id_escola));

    $resultado = mysql_query($sql);

    $row = true;

    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $escola[$row[0]] = $row;
        }
    }

    return $escola;
}

?>