<?php

function verificaQuantidadeEnderecos($id_pessoa, $tipo_endereco) {

    include_once('connect.php');

    $sql = sprintf("select count(*) from matricula.endereco where Pessoa_id_pessoa = %s and id_tipo_endereco = %s", mysql_real_escape_string($id_pessoa), mysql_real_escape_string($tipo_endereco));

    $resultado = mysql_query($sql);
    
    $row = true;

    $i = 0;
    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        $i++;
        if ($row[0] != '') {
            $qtd[$i] = $row;
        }
    }

    if(!isset($qtd)){
        return FALSE;
    } else{
        return $qtd;
    }

}

?>