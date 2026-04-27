<?php

function inserirLogin($id, $usuario, $senha, $perfil) {

    include_once('connect.php');

    $sql3 = sprintf("INSERT INTO `matricula`.`login`
                    (`Pessoa_Fisica_Pessoa_id_pessoa`,
                    `ds_usuario`,
                    `ds_senha`,
                    `Perfil_id_perfil`)
                    VALUES
                    (%s,
                    '%s',
                    '%s',
                    %s)"
            , mysql_real_escape_string($id)
            , mysql_real_escape_string($usuario)
            , mysql_real_escape_string($senha)
            , mysql_real_escape_string($perfil));

    $resultado = mysql_query($sql3);

    if (!$resultado) {
        return false;
    }

    return $id;
}

?>