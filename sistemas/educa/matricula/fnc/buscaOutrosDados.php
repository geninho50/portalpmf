<?php

function buscaOutrosDados($id_aluno) {

    include_once('connect.php');

    $sql = sprintf("SELECT a.nr_cartao_transporte, 
                    a.id_precisa_transporte_proximo_periodo, 
                    a.en_zona_moradia, 
                    a.id_autoriza_uso, 
                    a.id_bolsa_familia,
                    a.ds_local_permanencia,
                    a.id_possui_computador,
                    a.en_local_acesso_internet,
                    a.Tempo_Residencia_id_tempo_residencia,
                    a.id_possui_carro,
                    a.en_tipo_moradia,
                    a.id_pensao
                    FROM matricula.aluno a
                    where a.Pessoa_Fisica_Pessoa_id_pessoa = %s"
            , mysql_real_escape_string($id_aluno));

    $resultado = mysql_query($sql);

    $row = true;

    $row = mysql_fetch_row($resultado);
    if (isset($row)) {
            $outros = $row;
        }


    if (isset($outros)) {
        return $outros;
    } else {
        return false;
    }
}

?>