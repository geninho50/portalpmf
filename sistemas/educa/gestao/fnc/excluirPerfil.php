<?php

function excluirPerfil($id) {

      include_once('connect.php');

    $sql = sprintf("delete from matricula.perfil where id_perfil = %s", mysql_real_escape_string($id));

    $resultado = mysql_query($sql);

    return $resultado;
}

?>