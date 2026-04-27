<?php

function removerDadosSaude($id_pessoa) {

    include_once('connect.php');

    $sql = sprintf("delete from `matricula`.`dados_saude`
                    where `Pessoa_Fisica_Pessoa_id_pessoa` = %s"
            , mysql_real_escape_string($id_pessoa));

    $resultado = mysql_query($sql);

    return $resultado;
}

?>