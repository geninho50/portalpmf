<?php

function buscaTurnos($id) {

    include_once('connect.php');

    $sql = sprintf("SELECT id_turno_matutino, id_turno_vespertino, id_turno_noturno 
                    FROM matricula.responsavel
                    where Pessoa_Fisica_Pessoa_id_pessoa = %s", mysql_real_escape_string($id));

    $resultado = mysql_query($sql);

    $row = true;

    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $turnos = $row;
        }
    }
    if (isset($turnos)) {
        return $turnos;
    } else {
        return false;
    }
}

?>