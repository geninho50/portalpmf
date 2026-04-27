<?php

function buscaUtilizouTransporte($id_aluno) {

    include_once('connect.php');

    $sql = sprintf("select a.Esfera_id_redes_escolares from matricula.transporte a
                    where a.Aluno_Pessoa_Fisica_Pessoa_id_pessoa = %s", mysql_real_escape_string($id_aluno));

    $resultado = mysql_query($sql);

    $row = true;

    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $aluno = $row;
        }
    }

    if(isset($aluno)){
        return $aluno;
    } else { 
        return false; 
    }
}

?>