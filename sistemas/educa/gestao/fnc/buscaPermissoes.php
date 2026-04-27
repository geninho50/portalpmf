<?php

function buscaPermissoes($perfil) {

   	include_once('connect.php');

    $sql = sprintf("SELECT Papel_id_papel, id_habilitado FROM matricula.perfil_papel where Perfil_id_perfil = '%s'"
            , mysql_real_escape_string($perfil));

    $resultado = mysql_query($sql);
    
    $row = true;

    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $result[$row[0]] = $row;
        }
    }

    return $result;

}

?>
