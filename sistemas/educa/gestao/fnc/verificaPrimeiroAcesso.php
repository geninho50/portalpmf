<?php

function verificaPrimeiroAcessoDiretor($usuario) {

    include_once('connect.php');

    $sql = sprintf("select Pessoa_Fisica_Pessoa_id_pessoa, ds_usuario, Perfil_id_perfil, id_escola, ds_senha from matricula.login
            where ds_usuario = '%s' LIMIT 1"
            , mysql_real_escape_string($usuario));

    var_dump($sql);
    var_dump(mysql_error());
    
    $resultado = mysql_query($sql);
    
    $row = true;

    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $result = $row;
        }
    }
    
    if($result[4] == 'pmf'){
        return true;
    }
    return false;
}

?>
