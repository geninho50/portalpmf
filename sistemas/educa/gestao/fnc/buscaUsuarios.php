<?php

function buscaUsuarios() {

    include_once('connect.php');

    $sql = sprintf("select z.*, y.ds_nome, id_ativo from (SELECT a.Pessoa_Fisica_Pessoa_id_pessoa as id, a.ds_usuario, b.ds_nome as nome, c.ds_nome as nome_perfil, a.id_escola, a.id_ativo
        FROM matricula.login a, matricula.pessoa_fisica b, matricula.perfil c
where a.Pessoa_Fisica_Pessoa_id_pessoa = b.Pessoa_id_pessoa
and c.id_perfil != 2
and c.id_perfil = a.Perfil_id_perfil) z left join matricula.escola y
on z.id_escola = y.Pessoa_Juridica_Pessoa_id_pessoa");

    $resultado = mysql_query($sql);
    
    $row = true; 
    
    $i = 0;
    while ($row != false) {
        $row = mysql_fetch_row($resultado);
        $i++;
        if ($row[0] != '') {
            $usuario[$i] = $row;
        }
    }

    if(!isset($usuario)){
        return false;
    } else{
        return $usuario;
    }

}

?>