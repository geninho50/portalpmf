<?php

function atualizarIntencaoInfantil($aluno, $escolha, $novaEscola) {

    include_once('connect.php');

    $sql = sprintf("update matricula.lista_aluno a
                    set a.Lista_Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa = %s
                    where a.id_aluno = %s
                    and a.id_escolha = %s"
            , mysql_real_escape_string($novaEscola)
            , mysql_real_escape_string($aluno)
            , mysql_real_escape_string($escolha));

    $resultado = mysql_query($sql);
    
    if($resultado){
        $linhas = mysql_affected_rows();
        if($linhas == 1){
            return true;
        }
    }
    
    return false;
}

?>