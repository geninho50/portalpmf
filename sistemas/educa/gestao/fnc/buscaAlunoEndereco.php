<?php

function buscaAlunoEndereco($id_aluno) {

    include_once('connect.php');

    $sql = sprintf("SELECT * FROM matricula.endereco
        where Pessoa_id_pessoa = %s
        and id_tipo_endereco = 1
        order by id_endereco desc limit 1", mysql_real_escape_string($id_aluno));

    $resultado = mysql_query($sql);

    $row = true;

    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $alunoEnd = $row;
        }
    }

    if(isset($alunoEnd)){
        return $alunoEnd;
    } else {
        return false;
    }
}

function buscaTrabalhoEndereco($id_aluno) {

  include_once('connect.php');

  $sql = sprintf("SELECT * FROM matricula.endereco
    where Pessoa_id_pessoa = %s
    and id_tipo_endereco = 2
    order by id_endereco desc limit 1", mysql_real_escape_string($id_aluno));

  $resultado = mysql_query($sql);

  $row = true;

  while ($row != FALSE) {
    $row = mysql_fetch_row($resultado);
    if ($row[0] != '') {
        $alunoEnd = $row;
    }
}

if (isset($alunoEnd)) {
    return $alunoEnd;
} else {
    return false;
}
}

?>