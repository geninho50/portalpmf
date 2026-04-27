<?php

function verificaLogin($usuario, $senha) {

    include_once('connect.php');

    $sql = sprintf("select Pessoa_Fisica_Pessoa_id_pessoa, ds_usuario, Perfil_id_perfil, id_escola from matricula.login
            where ds_usuario = '%s' and ds_senha = '%s' LIMIT 1"
            , mysql_real_escape_string($usuario)
            , mysql_real_escape_string($senha));

    $resultado = mysql_query($sql);
    
    $row = true;

    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $result = $row;
        }
    }

    if(!isset($result)){
        return -1;
    }
    
    if (count($result) == 4) {
        return $result;
    } else {
        return -1;
    }
}

?>
