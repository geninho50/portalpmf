<?php

function insereDistancia($id, $dist) {

    include_once('connect.php');    

    $sql = sprintf("update `matricula`.`aluno`
                    set ds_distancia = '%s'
                    where Pessoa_Fisica_Pessoa_id_pessoa = %s"
                    , mysql_real_escape_string($dist)
            , mysql_real_escape_string($id));

    $resultado = mysql_query($sql);

    return $resultado;
}

?>