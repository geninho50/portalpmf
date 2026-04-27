<?php

function inserirEndereco($localizacao, $id_pessoa, $tipo_endereco) {

    include_once('connect.php');
    
    $cep = str_replace('.', '', $localizacao['cep']);
    $cep = str_replace('-', '', $cep);

    $sql = sprintf("INSERT INTO `matricula`.`endereco`
                    (`Pessoa_id_pessoa`,
                    `Bairro_id_bairro`,
                    `Localidade_id_localidade`,
                    `Estado_id_estado`,
                    `ds_logradouro`,
                    `ds_numero`,
                    `ds_complemento`,
                    `cd_cep`,
                    `id_tipo_endereco`)
                    VALUES
                    (%s,
                    %s,
                    %s,
                    %s,
                    '%s',
                    %s,
                    '%s',
                    '%s',
                    %s)"
            , mysql_real_escape_string($id_pessoa)
            , mysql_real_escape_string($localizacao['bairro'])
            , mysql_real_escape_string($localizacao['municipio'])
            , mysql_real_escape_string($localizacao['estado'])
            , mysql_real_escape_string($localizacao['logradouro'])
            , mysql_real_escape_string($localizacao['numero'])
            , mysql_real_escape_string($localizacao['complemento'])
            , mysql_real_escape_string($cep)
            , mysql_real_escape_string($tipo_endereco));

    $resultado = mysql_query($sql);

    return $resultado;
}

?>