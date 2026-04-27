<?php

function inserirEmail($usuario, $email) {

    include_once('connect.php');

    $sql = sprintf("delete from `matricula`.`email`
                    WHERE `Pessoa_id_pessoa` = %s"
            , mysql_real_escape_string($usuario));

    $resultado = mysql_query($sql);
    

    $sql = sprintf("INSERT INTO `matricula`.`email`
                    (`Pessoa_id_pessoa`,
                    `ds_email`)
                    VALUES
                    (%s,
                    '%s')"
            , mysql_real_escape_string($usuario), mysql_real_escape_string($email));

    $resultado = mysql_query($sql);

    return $resultado;
}

?>