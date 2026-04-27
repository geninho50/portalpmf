<?php

function confirmaMatricula($id_aluno) {

    include_once('connect.php');

    $sql = sprintf("UPDATE `matricula`.`vaga`
                    SET
                    `id_rematricula_realizada` = 1,
                    `dt_rematricula_realizada` = sysdate()
                    WHERE `Fase_Periodo_Periodo_id_ano` = 2014 
                    AND `Fase_Periodo_Periodo_id_periodo` = 1 
                    AND `Fase_Periodo_Fase_Curso_id_curso` = 1
                    AND `Aluno_Pessoa_Fisica_Pessoa_id_pessoa` = %s"
            , mysql_real_escape_string($id_aluno));

    $resultado = mysql_query($sql);
    
    return $resultado;
}
?>
