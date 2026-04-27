<?php

function buscaEscolhaEscola($id, $idEscola) {

    include_once('connect.php');

    $sql = sprintf("select id_escolha 
        from matricula.lista_aluno a
        where a.id_aluno = %s and a.Lista_Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa = %s order by id_escolha", 
        mysql_real_escape_string($id), 
        mysql_real_escape_string($idEscola));

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