<?php

function buscaPessoaFisica($id_pessoa) {

    include_once('connect.php');

    $sql = sprintf("SELECT ds_nome, dt_nascimento, dS_sexo FROM matricula.pessoa_fisica
        where Pessoa_id_pessoa = %s
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

function buscaPessoaFisicaTotal($id_pessoa) {

   	include_once('connect.php');

    $sql = sprintf("SELECT * FROM matricula.pessoa_fisica
        where Pessoa_id_pessoa = %s
        limit 1", mysql_real_escape_string($id_pessoa));

    $resultado = mysql_query($sql);

    $row = true;
    
    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $pessoa = $row;
        }
    }

    if(isset($pessoa)){
        return $pessoa;
    }
    else return false;
}

?>