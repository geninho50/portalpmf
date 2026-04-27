<?php

function buscaEndereco($id_pessoa) {

    include_once('connect.php');

    $sql = sprintf("select * from matricula.endereco where Pessoa_id_pessoa = %s", mysql_real_escape_string($id_pessoa));

    $resultado = mysql_query($sql);
    
    $row = true;

    $i = 0;
    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        $i++;
        if ($row[0] != '') {
            $endereco[$i] = $row;
        }
    }

    if(!isset($endereco)){
        return FALSE;
    } else{
        return $endereco;
    }

}

function buscaEnderecoTrabalho($id_pessoa) {

    include_once('connect.php');

    $sql = sprintf("SELECT * FROM matricula.endereco
                    where Pessoa_id_pessoa = %s
                    and id_tipo_endereco = 2", mysql_real_escape_string($id_pessoa));

    $resultado = mysql_query($sql);
    
    $row = true;

    $i = 0;
    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        $i++;
        if ($row[0] != '') {
            $endereco[$i] = $row;
        }
    }

    if(!isset($endereco)){
        return FALSE;
    } else{
        return $endereco;
    }

}

function buscaEnderecoResidencial($id_pessoa) {

    include_once('connect.php');

    $sql = sprintf("SELECT * FROM matricula.endereco
                    where Pessoa_id_pessoa = %s
                    and id_tipo_endereco = 1", mysql_real_escape_string($id_pessoa));

    $resultado = mysql_query($sql);
    
    $row = true;

    $i = 0;
    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        $i++;
        if ($row[0] != '') {
            $endereco[$i] = $row;
        }
    }

    if(!isset($endereco)){
        return FALSE;
    } else{
        return $endereco;
    }

}

?>