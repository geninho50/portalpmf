<?php

function buscaRede($rede) {

    include_once('connect.php');

    $sql = sprintf("SELECT * FROM matricula.esfera where id_redes_escolares = '%s'", mysql_real_escape_string($rede));

    $resultado = mysql_query($sql);

    $row = true;

    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $rede = $row;
        }
    }
    
    return $rede;
}


?>