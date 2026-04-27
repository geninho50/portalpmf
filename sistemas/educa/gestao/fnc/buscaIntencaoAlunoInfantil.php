<?php

function buscaIntencaoAlunoInfantil($id) {

    include_once('connect.php');

    $sql = sprintf("SELECT Lista_Fase_Periodo_Fase_id_ano_serie, Lista_Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa, id_escolha, id_local_documentacao from matricula.lista_aluno
where id_aluno = %s order by id_escolha asc", mysql_real_escape_string($id));

    $resultado = mysql_query($sql);

    $row = true;
    $i = 0;

    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $intencao[$i++] = $row;
        }
    }

    if (isset($intencao)) {
        return $intencao;
    } else {
        return false;
    }
}

?>