<?php

function verificaParaEnturmacao($id_aluno) {

    include_once('connect.php');

    $sql = sprintf("SELECT 1 FROM matricula.para_enturmacao where id_aluno = %s"
            , mysql_real_escape_string($id_aluno));

    $resultado = mysql_query($sql);
    
    $row = true;

    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $result = $row;
        }
    }

    if(!isset($result)){
        return false;
    }
    
    if ($result != false) {
        return true;
    } else {
        return false;
    }
}

?>
