<?php

function removeEnderecos($id_pessoa, $tipo_endereco) {

    include_once('connect.php');

    $sql = sprintf("delete from matricula.endereco where Pessoa_id_pessoa = %s and id_tipo_endereco = %s", mysql_real_escape_string($id_pessoa), mysql_real_escape_string($tipo_endereco));

    $resultado = mysql_query($sql);
    
    return $resultado;

}

?>