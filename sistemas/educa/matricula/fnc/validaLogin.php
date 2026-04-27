<?php

function validaLogin($usuario, $senha) {

    include_once('connect.php');

    $sql = sprintf("select * from matricula.login t where ds_usuario = %s limit 1", mysql_real_escape_string($usuario));

    $resultado = mysql_query($sql);

    $row = true;

    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $motivo[0] = $row;
        }
    }
    
    if(!isset($motivo)){
        return false;
    }
    
    if ($motivo[0][2] == $senha) {
        return $motivo;
    } else {
        return false;
    }
}

?>