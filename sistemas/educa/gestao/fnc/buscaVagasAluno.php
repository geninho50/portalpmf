<?php

function buscaVagasAluno($id_aluno) {

    include_once('connect.php');

    $sql = sprintf("select Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa, Fase_Periodo_Fase_id_ano_serie from matricula.vaga a
        where a.Aluno_Pessoa_Fisica_Pessoa_id_pessoa = %s", mysql_real_escape_string($id_aluno));

    $resultado = mysql_query($sql);
    
    $row = true;
    $i = 0;

    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $papeis[$i++] = $row;
        }
    }

    if(isset($papeis)){
        return $papeis;
    } else {
        return false;
    }
}

?>