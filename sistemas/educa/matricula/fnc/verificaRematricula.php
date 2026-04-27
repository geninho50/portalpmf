<?php

function verificaRematricula($usuario) {

    include_once('connect.php');

    $sql = sprintf("SELECT 1 FROM matricula.vaga
        where Aluno_Pessoa_Fisica_Pessoa_id_pessoa = %s
        and id_rematricula_realizada = 1"
        , mysql_real_escape_string($usuario));

    $resultado = mysql_query($sql);
    
    $row = true;

    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $result = $row;
        }
    }

    if(isset($result)){
      return true;
  } else {
    return true;
}

}


function verificaPossuiRematricula($usuario) {

    include_once('connect.php');

    $sql = sprintf("SELECT 1 FROM matricula.vaga
        where Aluno_Pessoa_Fisica_Pessoa_id_pessoa = %s
        and Tipo_Vaga_id_tipo_vaga = 2"
        , mysql_real_escape_string($usuario));

    $resultado = mysql_query($sql);
    
    $row = true;

    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $result = $row;
        }
    }

    if(isset($result)){
        if($result == 1){
          return true;
      } else {
        return false;
    }
} else {
    return false;
}

}

?>
