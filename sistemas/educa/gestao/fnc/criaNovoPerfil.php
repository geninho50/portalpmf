<?php

function criaNovoPerfil($nomePerfil) {

    include_once('connect.php');

    $sql = sprintf("insert into matricula.perfil (ds_nome) values ('%s')", mysql_real_escape_string($nomePerfil));

    $resultado = mysql_query($sql);

    return $resultado;
}

?>