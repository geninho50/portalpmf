<?php

function trocarSenha($usuario, $senha) {

    include_once('connect.php');

    $sql = sprintf("UPDATE `matricula`.`login`
                    SET
                    `ds_senha` = '%s'
                    WHERE `Pessoa_Fisica_Pessoa_id_pessoa` = %s"
            , mysql_real_escape_string($senha)
            , mysql_real_escape_string($usuario));
    
    $resultado = mysql_query($sql);
    
    return $resultado;
}

?>