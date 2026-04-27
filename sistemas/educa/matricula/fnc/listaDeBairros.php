<?php

function listaDeBairros($id_localidade) {

    include_once('connect.php');

    $sql = sprintf("select * from matricula.bairro t where t.Localidade_id_localidade = %s order by t.ds_nome", mysql_real_escape_string($id_localidade));

    $resultado = mysql_query($sql);

    $row = true;

    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $bairros[$row[0]] = $row;
        }
    }

    return $bairros;
}

?>