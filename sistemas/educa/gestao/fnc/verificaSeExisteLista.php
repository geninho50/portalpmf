<?php

function verificaSeExisteLista($id_vaga) {

    include_once('connect.php');

    $sql = sprintf("SELECT 1 FROM matricula.vaga a, matricula.lista_aluno b
                    where a.Fase_Periodo_Periodo_id_periodo = b.Lista_Fase_Periodo_Periodo_id_periodo
                    and a.Fase_Periodo_Periodo_id_ano = b.Lista_Fase_Periodo_Periodo_id_ano
                    and a.Fase_Periodo_Fase_Curso_id_curso = b.Lista_Fase_Periodo_Fase_Curso_id_curso
                    and a.Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa = b.Lista_Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa
                    and a.Fase_Periodo_Fase_id_ano_serie = b.Lista_Fase_Periodo_Fase_id_ano_serie
                    and a.id_vaga = %s
                    limit 1"
            , mysql_real_escape_string($id_vaga));

    $resultado = mysql_query($sql);
    
    $row = true;

    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $result = $row;
        }
    }

    if(!isset($result)){
        return false;
    }
    
    if ($result != false) {
        return true;
    } else {
        return false;
    }
}

?>
