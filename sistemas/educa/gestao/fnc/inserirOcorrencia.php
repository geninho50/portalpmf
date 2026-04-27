<?php

function inserirOcorrencia($id, $ocorrencia, $usuario) {

    include_once('connect.php');

    $sql = sprintf("INSERT INTO `matricula`.`ocorrencia`
                    (`id_pessoa`,
                    `ocorrencia`,
                    `data`,
                    `id_usuario`)
                    VALUES
                    (%s,
                    '%s',
                    sysdate(),
                    %s);"
            , mysql_real_escape_string($id)
            , mysql_real_escape_string($ocorrencia)
            , mysql_real_escape_string($usuario));

    $resultado = mysql_query($sql);

    var_dump(mysql_error());

    return $resultado;
}

?>