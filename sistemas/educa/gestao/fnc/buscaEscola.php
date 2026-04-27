<?php

function buscaEscola($id_escola) {

    include_once('connect.php');

    $sql = sprintf("select * from matricula.escola a, matricula.tipo_escola b 
                    where Pessoa_Juridica_Pessoa_id_pessoa = %s
                    and a.Tipo_Escola_id_tipo_escola = b.id_tipo_escola", mysql_real_escape_string($id_escola));

    $resultado = mysql_query($sql);
    
    $row = true; 
    
    $i = 0;
    while ($row != false) {
        $row = mysql_fetch_row($resultado);
        $i++;
        if ($row[0] != '') {
            $escola[$i] = $row;
        }
    }

    if(!isset($escola)){
        return false;
    } else{
        return $escola;
    }

}

?>