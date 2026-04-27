<?php

function removeDiretorExistente($escola, $perfil) {

    include_once('connect.php');

    $sql = sprintf("update matricula.login
        set id_escola = '',
        Perfil_id_perfil = 
where id_escola = %s
and Perfil_id_perfil = %s"
            , mysql_real_escape_string($escola)
            , mysql_real_escape_string($perfil));

    $resultado = mysql_query($sql);

    return $resultado;
}

?>