<?php

function verificaAtendidoFundamental($aluno, $escola, $etapa, $ano, $periodo, $curso) {

    include_once('connect.php');

    $sql = sprintf("select 1 from matricula.lista_aluno_atendidas
        where id_aluno = %s
        and Lista_Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa = %s
        and Lista_Fase_Periodo_Fase_id_ano_serie = %s
        and Lista_Fase_Periodo_Periodo_id_ano = %s
        and Lista_Fase_Periodo_Periodo_id_periodo = %s
        and Lista_Fase_Periodo_Fase_Curso_id_curso = %s"
        , mysql_real_escape_string($aluno), mysql_real_escape_string($escola), mysql_real_escape_string($etapa)
        , mysql_real_escape_string($ano), mysql_real_escape_string($periodo), mysql_real_escape_string($curso));
    
    $resultado = mysql_query($sql);
    
    $row = true;

    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $result = $row;
        }
    }

    if(isset($result)){
        if($result[0] == '1'){
            return true;
        } else {
            return false;
        }
    }
    return false;
}

?>
