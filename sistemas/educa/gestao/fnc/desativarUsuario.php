<?php

function desativarUsuario($usuario) {

    include_once('connect.php');

    $sql = sprintf("update matricula.login a
                    set a.id_ativo = 0
                    where a.Pessoa_Fisica_Pessoa_id_pessoa = %s"
            , mysql_real_escape_string($usuario));

    $resultado = mysql_query($sql);
    
    if($resultado){
        $linhas = mysql_affected_rows();
        if($linhas == 1){
            return true;
        }
    }
    
    return false;
}