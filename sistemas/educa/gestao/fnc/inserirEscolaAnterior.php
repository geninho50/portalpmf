<?php

function inserirEscolaAnterior($novaEscola, $ano, $id_pessoa) {

    include_once('connect.php');

        $sql = sprintf("INSERT INTO `matricula`.`escola_anterior`
                        (`Aluno_Pessoa_Fisica_Pessoa_id_pessoa`,
                        `id_ano`,
                        `Localidade_id_localidade`,
                        `Esfera_id_esfera`,
                        `ds_nome`,
                        `id_ano_serie`)
                        VALUES
                        (%s,
                        %s,
                        %s,
                        %s,
                        '%s',
                        %s);"
                , mysql_real_escape_string($id_pessoa)
                , mysql_real_escape_string($ano)
                , mysql_real_escape_string($novaEscola['municipio'])
                , mysql_real_escape_string($novaEscola['rede'])
                , mysql_real_escape_string($novaEscola['nome'])
                , mysql_real_escape_string($novaEscola['ano']));

        $resultado = mysql_query($sql);
        return $resultado;
    

    return true;
}

?>