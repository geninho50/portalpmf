<?php

function atualizarEstadoCivil($estado, $usuario) {

    include_once('connect.php');    

    $sql = sprintf("update `matricula`.`pessoa_fisica`
                    set Estado_Civil_id_estado_civil = %s
                    where Pessoa_id_pessoa = %s"
                    , mysql_real_escape_string($estado)
            , mysql_real_escape_string($usuario));

    $resultado = mysql_query($sql);

    return $resultado;
}

?>