<?php

function buscaSituacaoVaga($id_aluno, $id_curso) {

    include_once('connect.php');

    $sql = sprintf("select a.Tipo_Vaga_id_tipo_vaga, a.Fase_Periodo_Fase_id_ano_serie, 
    a.Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa,
    a.id_efetivado,
    a.id_rematricula_realizada,
    date_format(a.dt_rematricula_realizada, '%s')
from matricula.vaga a
where a.Aluno_Pessoa_Fisica_Pessoa_id_pessoa = %s
and a.Fase_Periodo_Fase_Curso_id_curso = %s", mysql_real_escape_string('%d/%m/%Y %H:%i'), mysql_real_escape_string($id_aluno), mysql_real_escape_string($id_curso));

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