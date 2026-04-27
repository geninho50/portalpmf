<?php

function inserirRenda($renda, $id_aluno) {
    
    include_once('connect.php');

    foreach ($renda as $key => $value) {
        $sql = sprintf("INSERT INTO `matricula`.`renda`
                        (`Aluno_Pessoa_Fisica_Pessoa_id_pessoa`,
                        `Tipo_Renda_id_tipo_renda`,
                        `Comprovacao_Renda_id_comprovacao`,
                        `Situacao_Ocupacional_id_situacao_ocupacional`,
                        `qt_renda`,
                        `dt_nascimento`,
                        `ds_nome`,
                        `ds_parentesco`)
                        VALUES
                        (%s,
                        1,
                        %s,
                        %s,
                        %s,
                        str_to_date('%s','%s'),
                        '%s',
                        '%s')"
                , mysql_real_escape_string($id_aluno)
                , mysql_real_escape_string($value[5])
                , mysql_real_escape_string($value[1])
                , mysql_real_escape_string($value[2])
                , mysql_real_escape_string($value[3])
                , mysql_real_escape_string('%d/%m/%Y')
                , mysql_real_escape_string($value[0])
                , mysql_real_escape_string($value[4]));

        $renda = mysql_query($sql);
    }
}

function inserirOutraRenda($renda, $id, $tipo) {
        $sql = sprintf("INSERT INTO `matricula`.`renda`
                        (`Aluno_Pessoa_Fisica_Pessoa_id_pessoa`,
                        `Tipo_Renda_id_tipo_renda`,
                        `qt_renda`)
                        VALUES
                        (%s,
                        %s,
                        %s)"
                , mysql_real_escape_string($id)
                , mysql_real_escape_string($tipo)
                , mysql_real_escape_string($renda));

    $renda = mysql_query($sql);
}

?>
