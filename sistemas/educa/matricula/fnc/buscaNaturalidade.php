<?php

function buscaNaturalidade($id) {

    include_once('connect.php');

    $sql = sprintf("SELECT b.id_localidade, b.Estado_id_estado FROM matricula.pessoa_fisica a, matricula.localidade b
                    where a.id_naturalidade = b.id_localidade
                    and a.Pessoa_id_pessoa = %s", mysql_real_escape_string($id));

    $resultado = mysql_query($sql);
    
    $row = true;

    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $nat = $row;
        }
    }

    if (isset($nat)) {
        return $nat;
    } else {
        return false;
    }
}

?>