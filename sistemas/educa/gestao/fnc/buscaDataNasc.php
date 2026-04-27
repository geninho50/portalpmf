<?php

function buscaDataNasc($id) {

    include_once('connect.php');

    $sql = sprintf("select date_format(r.dt_nascimento, '%s') from matricula.pessoa_fisica r
        where r.Pessoa_id_pessoa = %s", mysql_real_escape_string('%d/%m/%Y'), 
        mysql_real_escape_string($id));

    $resultado = mysql_query($sql);

    $row = true;

    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $idade = $row;
        }
    }
    if (isset($idade)) {
        return $idade[0];
    }
    return false;
    
}

?>