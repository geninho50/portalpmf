<?php

function buscaOcorrencias($id) {

    include_once('connect.php');

    $sql = sprintf("select id, id_pessoa, ocorrencia, date_format(data, '%s') as data, id_usuario from matricula.ocorrencia a
                    where a.id_pessoa = %s
                    order by data desc", mysql_real_escape_string('%d/%m/%Y %h:%i %p'), mysql_real_escape_string($id));

    $resultado = mysql_query($sql);
    
    $row = true; 
    
    $i = 0;
    while ($row != false) {
        $row = mysql_fetch_row($resultado);
        $i++;
        if ($row[0] != '') {
            $ocorrencia[$i] = $row;
        }
    }

    if(!isset($ocorrencia)){
        return false;
    } else{
        return $ocorrencia;
    }

}

?>