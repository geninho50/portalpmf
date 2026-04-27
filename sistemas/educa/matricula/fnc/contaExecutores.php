<?php

function contaExecutores($escola, $perfil) {

    include_once('connect.php');
    
    $sql = sprintf("SELECT count(*) FROM matricula.login
where Perfil_id_perfil = %s
and id_escola = %s", mysql_real_escape_string($perfil), mysql_real_escape_string($escola));

    $resultado = mysql_query($sql);
    
    $row = true;
    
    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $qtd = $row[0];
        }
    }

    return $qtd;
}

?>