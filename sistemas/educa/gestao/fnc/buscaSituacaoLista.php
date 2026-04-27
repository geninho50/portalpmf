<?php

function buscaSituacaoLista($id_aluno, $id_curso) {

    include_once('connect.php');

    $sql = sprintf("select a.Lista_Fase_Periodo_Fase_id_ano_serie, 
    a.Lista_Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa,
    a.id_escolha
from matricula.lista_aluno a
where a.id_aluno = %s
and a.Lista_Fase_Periodo_Fase_Curso_id_curso = %s
order by id_escolha asc", mysql_real_escape_string($id_aluno), mysql_real_escape_string($id_curso));

    $resultado = mysql_query($sql);

    $row = true;

    $i = 0;

    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $aluno[$i++] = $row;
        }
    }
    
    if(isset($aluno)){
        return $aluno;
    }
    
    return false;    
}

?>