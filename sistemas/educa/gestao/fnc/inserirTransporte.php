<?php

function inserirTransporte($sessao, $id_pessoa) {

    include_once('connect.php');

    if ($sessao['outrosDados']['utilizou_transporte'] == 'sim') {
        $sql = sprintf("INSERT INTO `matricula`.`transporte`
                    (`Aluno_Pessoa_Fisica_Pessoa_id_pessoa`,
                    `Periodo_id_ano`,
                    `Periodo_id_periodo`,
                    `Esfera_id_redes_escolares`,
                    `Tipo_Transporte_id_tipo_transporte`)
                    VALUES
                    (%s,
                    %s,
                    %s,
                    %s,
                    %s)"
                , mysql_real_escape_string($id_pessoa)
                , mysql_real_escape_string($sessao['periodo_ano'])
                , mysql_real_escape_string($sessao['id_periodo'])
                , mysql_real_escape_string($sessao['outrosDados']['tipo_transporte'])
                , mysql_real_escape_string(1));

        $resultado = mysql_query($sql);
        return $resultado;
    }

    return true;
}

?>