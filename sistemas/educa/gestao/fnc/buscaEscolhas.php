<?php

function buscaEscolhas($id) {

    include_once('connect.php');

    $sql = sprintf("select Lista_Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa, id_escolha 
        from matricula.lista_aluno a
        where a.id_aluno = %s order by id_escolha", mysql_real_escape_string($id));

    $resultado = mysql_query($sql);

    $row = true;

    $i = 0;
    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $escolhas[$i] = $row;
        }
        $i++;
    }
    if (isset($escolhas)) {
        return $escolhas;
    }

    return false;

}

?>