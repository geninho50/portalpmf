<?php

function verificaAlunoPossuiRematriculaEJA($usuario) {

    include_once('connect.php');

    $sql = sprintf("SELECT 1 FROM matricula.aluno_eja
        where id_pessoa = %s"
        , mysql_real_escape_string($usuario));

    $resultado = mysql_query($sql);
    
    $row = true;

    if($resultado == false){
        return false;
    }

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

?>
