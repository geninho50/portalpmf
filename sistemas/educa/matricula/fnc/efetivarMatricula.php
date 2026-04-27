<?php

function efetivarMatricula($id) {

    include_once('connect.php');

    $sql = sprintf("update matricula.vaga set id_efetivado = 1 where id_vaga = %s", mysql_real_escape_string($id));

    $resultado = mysql_query($sql);

    return $resultado;
}

?>