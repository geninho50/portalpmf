<?php

function buscaIndividuoRenda($id_aluno) {

    include_once('connect.php');

    $sql = sprintf("select * from matricula.renda
where Aluno_Pessoa_Fisica_Pessoa_id_pessoa = %s
and Tipo_Renda_id_tipo_renda = 1", mysql_real_escape_string($id_aluno));

    $resultado = mysql_query($sql);

    $row = true;
    $i = 0;
    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $ind[$i] = $row;
        }
        $i++;
    }
    if (isset($ind)) {
        return $ind;
    }

    return false;
}

?>