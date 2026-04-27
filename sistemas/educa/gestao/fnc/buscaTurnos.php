<?php

function buscaTurnos($id_aluno) {

    include_once('connect.php');

    $sql = sprintf("SELECT id_turno_matutino, id_turno_vespertino, id_turno_noturno from matricula.responsavel where Pessoa_Fisica_Pessoa_id_pessoa = %s"
        , mysql_real_escape_string($id_aluno));

    $resultado = mysql_query($sql);

    $row = true;

    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $resp = $row;
        }
    }

    if(isset($resp)){
        return $resp;
    }
    else return false;
}


?>