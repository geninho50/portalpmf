<?php

function inserirDadosPessoais($dadosPessoais, $id_pessoa) {

    include_once('connect.php');

    //atualizar pessoa_fisica
    if ($dadosPessoais['nacionalidade'] == 30) {
        $sql = sprintf("UPDATE `matricula`.`pessoa_fisica`
            SET
            `Etnia_id_etnia` = %s,
            `id_nacionalidade` = %s,
            `id_naturalidade` = %s,
            `ds_sexo` = '%s'z
            WHERE `Pessoa_id_pessoa` = %s"
            , mysql_real_escape_string($dadosPessoais['etnia'])
            , mysql_real_escape_string($dadosPessoais['nacionalidade'])
            , mysql_real_escape_string($dadosPessoais['naturalidade']['municipio'])
            , mysql_real_escape_string(strtoupper($dadosPessoais['sexo']))
            , mysql_real_escape_string($id_pessoa)
            );
    } else {
        $sql = sprintf("UPDATE `matricula`.`pessoa_fisica`
            SET
            `Etnia_id_etnia` = %s,
            `id_nacionalidade` = %s,
            `ds_sexo` = '%s'
            WHERE `Pessoa_id_pessoa` = %s"
            , mysql_real_escape_string($dadosPessoais['etnia'])
            , mysql_real_escape_string($dadosPessoais['nacionalidade'])
            , mysql_real_escape_string(strtoupper($dadosPessoais['sexo']))
            , mysql_real_escape_string($id_pessoa)
            );
    }
    
    $pessoais = mysql_query($sql);

    if (!$pessoais) {
        return false;
    }


    $sql = sprintf('delete from `matricula`.`documento` 
        where `Pessoa_Fisica_Pessoa_id_pessoa` = %s
        and (`Tipo_Documento_id_tipo_documento` = 1 
            or `Tipo_Documento_id_tipo_documento` = 2 
            or `Tipo_Documento_id_tipo_documento` = 4)'
    , mysql_real_escape_string($id_pessoa));
    $telefone = mysql_query($sql);
    if (!$telefone) {
        return false;
    }
    //inserir documentos
    if (isset($dadosPessoais['rg']['possui'])) {
        if ($dadosPessoais['rg']['possui'] == 'sim') {
            $sql = sprintf("INSERT INTO `matricula`.`documento`
                (`Pessoa_Fisica_Pessoa_id_pessoa`,
                    `Tipo_Documento_id_tipo_documento`,
                    `ds_valor`,
                    `ds_orgao_emissor`,
                    `dt_emissao`)
            VALUES
            (%s,
                1,
                '%s',
                '%s',
                str_to_date('%s', '%s'))"
            , mysql_real_escape_string($id_pessoa)
            , mysql_real_escape_string($dadosPessoais['rg']['numero'])
            , mysql_real_escape_string($dadosPessoais['rg']['orgao_rg'] . '/' . $dadosPessoais['rg']['uf_rg'])
            , mysql_real_escape_string($dadosPessoais['rg']['data_rg'])
            , mysql_real_escape_string('%d/%m/%Y'));

            $rg = mysql_query($sql);

            if (!$rg) {
                return false;
            }
        }
        if (isset($dadosPessoais['certidao']['tipo_certidao'])) {
            if ($dadosPessoais['certidao']['tipo_certidao'] == 'novo') {
                $sql = sprintf("INSERT INTO `matricula`.`documento`
                    (`Pessoa_Fisica_Pessoa_id_pessoa`,
                        `Tipo_Documento_id_tipo_documento`,
                        `ds_valor`)
                VALUES
                (%s,
                    2,
                    '%s')"
                , mysql_real_escape_string($id_pessoa)
                , mysql_real_escape_string($dadosPessoais['certidao']['numero']));
            } else {
                if ($dadosPessoais['certidao']['tipo_certidao'] == 'antigo') {
                    $sql = sprintf("INSERT INTO `matricula`.`documento`
                        (`Pessoa_Fisica_Pessoa_id_pessoa`,
                            `Tipo_Documento_id_tipo_documento`,
                            `ds_valor`,
                            `ds_folha`,
                            `ds_livro`,
                            `ds_cartorio`,
                            `ds_uf_cartorio`)
                    VALUES
                    (%s,
                        4,
                        '%s',
                        '%s',
                        '%s',
                        '%s',
                        '%s')"
                    , mysql_real_escape_string($id_pessoa)
                    , mysql_real_escape_string($dadosPessoais['certidao']['termo'])
                    , mysql_real_escape_string($dadosPessoais['certidao']['folha'])
                    , mysql_real_escape_string($dadosPessoais['certidao']['livro'])
                    , mysql_real_escape_string($dadosPessoais['certidao']['cartorio'])
                    , mysql_real_escape_string($dadosPessoais['certidao']['uf_cart']));
}
}

if ($dadosPessoais['certidao']['tipo_certidao'] != 'naoPossui') {
    $certidao = mysql_query($sql);
    if (!$certidao) {
        return false;
    }
}
}
}

$sql = sprintf('delete from `matricula`.`telefone` where `Pessoa_id_pessoa` = %s', mysql_real_escape_string($id_pessoa));
$telefone = mysql_query($sql);
if (!$telefone) {
    return false;
}
    //inserir telefones
if (isset($dadosPessoais['telefones']['celular'])) {
    if ($dadosPessoais['telefones']['celular'] != '') {
        $telTemp = str_replace('(', '', $dadosPessoais['telefones']['celular']);
            $telTemp = str_replace(')', '', $telTemp);
            $telTemp = str_replace('-', '', $telTemp);

            $sql = sprintf('INSERT INTO `matricula`.`telefone`
                (`Pessoa_id_pessoa`,
                    `ddd`,
                    `telefone`,
                    `Tipo_Telefone_id_tipo_telefone`)
            VALUES
            (%s,
                %s,
                %s,
                1)'
            , mysql_real_escape_string($id_pessoa)
            , mysql_real_escape_string(substr($telTemp, 0, 2))
            , mysql_real_escape_string(substr($telTemp, 2)));

            $telefone = mysql_query($sql);
            if (!$telefone) {
                return false;
            }
        }
    }
    if (isset($dadosPessoais['telefones']['residencial'])) {
        if ($dadosPessoais['telefones']['residencial'] != '') {
            $telTemp = str_replace('(', '', $dadosPessoais['telefones']['residencial']);
                $telTemp = str_replace(')', '', $telTemp);
                $telTemp = str_replace('-', '', $telTemp);

                $sql = sprintf('INSERT INTO `matricula`.`telefone`
                    (`Pessoa_id_pessoa`,
                        `ddd`,
                        `telefone`,
                        `Tipo_Telefone_id_tipo_telefone`)
                VALUES
                (%s,
                    %s,
                    %s,
                    2)'
                , mysql_real_escape_string($id_pessoa)
                , mysql_real_escape_string(substr($telTemp, 0, 2))
                , mysql_real_escape_string(substr($telTemp, 2)));

                $telefone = mysql_query($sql);
                if (!$telefone) {
                    return false;
                }
            }
        }
        if (isset($dadosPessoais['telefones']['comercial'])) {
            if ($dadosPessoais['telefones']['comercial'] != '') {
                $telTemp = str_replace('(', '', $dadosPessoais['telefones']['comercial']);
                    $telTemp = str_replace(')', '', $telTemp);
                    $telTemp = str_replace('-', '', $telTemp);

                    $sql = sprintf('INSERT INTO `matricula`.`telefone`
                        (`Pessoa_id_pessoa`,
                            `ddd`,
                            `telefone`,
                            `Tipo_Telefone_id_tipo_telefone`)
                    VALUES
                    (%s,
                        %s,
                        %s,
                        3)'
                    , mysql_real_escape_string($id_pessoa)
                    , mysql_real_escape_string(substr($telTemp, 0, 2))
                    , mysql_real_escape_string(substr($telTemp, 2)));

                    $telefone = mysql_query($sql);
                    if (!$telefone) {
                        return false;
                    }
                }
            }

            return true;
        }

        function inserirDadosPessoaisEditar($dadosPessoais, $id_pessoa) {

            include_once('connect.php');

            $data = explode('/', $dadosPessoais['data_nascimento']);
            $data = $data[2] . '-' . $data[1] . '-' . $data[0];

            $birthday = new DateTime($data);
            $diff = $birthday->diff(new DateTime("2014-03-31"));
            $months = $diff->format('%m') + 12 * $diff->format('%y');
            $years = floor($months / 12);
            $resto = $months % 12;
            if ($years == 0) {
                if ($resto < 1) {
                    $grupo = 10;
                    $textoGrupo = 'Idade Mínina não atingida.';
                } else {
                    $grupo = 10;
                    $textoGrupo = 'Grupo: 1';
                }
            } else {
                if ($years >= 1 && $years < 2) {
                    $grupo = 11;
                    $textoGrupo = 'Grupo: 2';
                } else {
                    if ($years >= 2 && $years < 3) {
                        $grupo = 12;
                        $textoGrupo = 'Grupo: 3';
                    } else {
                        if ($years >= 3 && $years < 4) {
                            $grupo = 13;
                            $textoGrupo = 'Grupo: 4';
                        } else {
                            if ($years >= 4 && $years < 5) {
                                $grupo = 14;
                                $textoGrupo = 'Grupo: 5';
                            } else {
                                if ($years >= 5 && $years < 6) {
                                    $grupo = 15;
                                    $textoGrupo = 'Grupo: 6';
                                } else {
                                    $grupo = -1;
                                    $textoGrupo = 'Idade Máxima Atingida.';
                                }
                            }
                        }
                    }
                }
            }

            if($grupo < 0){
                include_once 'buscaDataNasc.php';
                $dadosPessoais['data_nascimento'] = buscaDataNasc($id_pessoa);
            } else {
                $sql = sprintf("UPDATE `matricula`.`lista_aluno`
                    SET `Lista_Fase_Periodo_Fase_id_ano_serie` = %s
                    WHERE `id_aluno` = %s", 
                    mysql_real_escape_string($grupo), 
                    mysql_real_escape_string($id_pessoa));

                $correcao = mysql_query($sql); 

                $sql = sprintf("UPDATE `matricula`.`vaga`
                    SET `Fase_Periodo_Fase_id_ano_serie` = %s
                    WHERE `Aluno_Pessoa_Fisica_Pessoa_id_pessoa` = %s", 
                    mysql_real_escape_string($grupo), 
                    mysql_real_escape_string($id_pessoa));

                $correcao = mysql_query($sql);
            }

    //atualizar pessoa_fisica
            if ($dadosPessoais['nacionalidade'] == 30) {
                $sql = sprintf("UPDATE `matricula`.`pessoa_fisica`
                    SET
                    `Etnia_id_etnia` = %s,
                    `id_nacionalidade` = %s,
                    `id_naturalidade` = %s,
                    `ds_sexo` = '%s',
                    `ds_nome` = '%s',
                    `dt_nascimento` = str_to_date('%s', '%s') 
                    WHERE `Pessoa_id_pessoa` = %s"
                    , mysql_real_escape_string($dadosPessoais['etnia'])
                    , mysql_real_escape_string($dadosPessoais['nacionalidade'])
                    , mysql_real_escape_string($dadosPessoais['naturalidade']['municipio'])
                    , mysql_real_escape_string(strtoupper($dadosPessoais['sexo']))
                    , mysql_real_escape_string($dadosPessoais['nome_aluno'])
                    , mysql_real_escape_string($dadosPessoais['data_nascimento'])
                    , mysql_real_escape_string('%d/%m/%Y')
                    , mysql_real_escape_string($id_pessoa)
                    );
} else {
    $sql = sprintf("UPDATE `matricula`.`pessoa_fisica`
        SET
        `Etnia_id_etnia` = %s,
        `id_nacionalidade` = %s,
        `ds_sexo` = '%s',
        `ds_nome` = '%s',
        `dt_nascimento` = str_to_date('%s', '%s') 
        WHERE `Pessoa_id_pessoa` = %s"
        , mysql_real_escape_string($dadosPessoais['etnia'])
        , mysql_real_escape_string($dadosPessoais['nacionalidade'])
        , mysql_real_escape_string(strtoupper($dadosPessoais['sexo']))
        , mysql_real_escape_string($dadosPessoais['nome_aluno'])
        , mysql_real_escape_string($dadosPessoais['data_nascimento'])
        , mysql_real_escape_string('%d/%m/%Y')
        , mysql_real_escape_string($id_pessoa)
        );
}

$pessoais = mysql_query($sql);

if (!$pessoais) {
    return false;
}


$sql = sprintf('delete from `matricula`.`documento` 
    where `Pessoa_Fisica_Pessoa_id_pessoa` = %s
    and (`Tipo_Documento_id_tipo_documento` = 1 
        or `Tipo_Documento_id_tipo_documento` = 2 
        or `Tipo_Documento_id_tipo_documento` = 4)'
, mysql_real_escape_string($id_pessoa));
$telefone = mysql_query($sql);
if (!$telefone) {
    return false;
}
    //inserir documentos
if (isset($dadosPessoais['rg']['possui'])) {
    if ($dadosPessoais['rg']['possui'] == 'sim') {
        $sql = sprintf("INSERT INTO `matricula`.`documento`
            (`Pessoa_Fisica_Pessoa_id_pessoa`,
                `Tipo_Documento_id_tipo_documento`,
                `ds_valor`,
                `ds_orgao_emissor`,
                `dt_emissao`)
        VALUES
        (%s,
            1,
            '%s',
            '%s',
            str_to_date('%s', '%s'))"
        , mysql_real_escape_string($id_pessoa)
        , mysql_real_escape_string($dadosPessoais['rg']['numero'])
        , mysql_real_escape_string($dadosPessoais['rg']['orgao_rg'] . '/' . $dadosPessoais['rg']['uf_rg'])
        , mysql_real_escape_string($dadosPessoais['rg']['data_rg'])
        , mysql_real_escape_string('%d/%m/%Y'));

        $rg = mysql_query($sql);

        if (!$rg) {
            return false;
        }
    }
    if (isset($dadosPessoais['certidao']['tipo_certidao'])) {
        if ($dadosPessoais['certidao']['tipo_certidao'] == 'novo') {
            $sql = sprintf("INSERT INTO `matricula`.`documento`
                (`Pessoa_Fisica_Pessoa_id_pessoa`,
                    `Tipo_Documento_id_tipo_documento`,
                    `ds_valor`)
            VALUES
            (%s,
                2,
                '%s')"
            , mysql_real_escape_string($id_pessoa)
            , mysql_real_escape_string($dadosPessoais['certidao']['numero']));
        } else {
            if ($dadosPessoais['certidao']['tipo_certidao'] == 'antigo') {
                $sql = sprintf("INSERT INTO `matricula`.`documento`
                    (`Pessoa_Fisica_Pessoa_id_pessoa`,
                        `Tipo_Documento_id_tipo_documento`,
                        `ds_valor`,
                        `ds_folha`,
                        `ds_livro`,
                        `ds_cartorio`,
                        `ds_uf_cartorio`)
                VALUES
                (%s,
                    4,
                    '%s',
                    '%s',
                    '%s',
                    '%s',
                    '%s')"
                , mysql_real_escape_string($id_pessoa)
                , mysql_real_escape_string($dadosPessoais['certidao']['termo'])
                , mysql_real_escape_string($dadosPessoais['certidao']['folha'])
                , mysql_real_escape_string($dadosPessoais['certidao']['livro'])
                , mysql_real_escape_string($dadosPessoais['certidao']['cartorio'])
                , mysql_real_escape_string($dadosPessoais['certidao']['uf_cart']));
            }
        }

        if ($dadosPessoais['certidao']['tipo_certidao'] != 'naoPossui') {
            $certidao = mysql_query($sql);
            if (!$certidao) {
                return false;
            }
        }
    }
}

$sql = sprintf('delete from `matricula`.`telefone` where `Pessoa_id_pessoa` = %s', mysql_real_escape_string($id_pessoa));
$telefone = mysql_query($sql);
if (!$telefone) {
    return false;
}
    //inserir telefones
if (isset($dadosPessoais['telefones']['celular'])) {
    if ($dadosPessoais['telefones']['celular'] != '') {
        $telTemp = str_replace('(', '', $dadosPessoais['telefones']['celular']);
            $telTemp = str_replace(')', '', $telTemp);
            $telTemp = str_replace('-', '', $telTemp);

            $sql = sprintf('INSERT INTO `matricula`.`telefone`
                (`Pessoa_id_pessoa`,
                    `ddd`,
                    `telefone`,
                    `Tipo_Telefone_id_tipo_telefone`)
            VALUES
            (%s,
                %s,
                %s,
                1)'
            , mysql_real_escape_string($id_pessoa)
            , mysql_real_escape_string($dadosPessoais['telefones']['ufCelular'])
            , mysql_real_escape_string($dadosPessoais['telefones']['celular']));

            $telefone = mysql_query($sql);
            if (!$telefone) {
                return false;
            }
        }
    }
    if (isset($dadosPessoais['telefones']['residencial'])) {
        if ($dadosPessoais['telefones']['residencial'] != '') {
            $telTemp = str_replace('(', '', $dadosPessoais['telefones']['residencial']);
                $telTemp = str_replace(')', '', $telTemp);
                $telTemp = str_replace('-', '', $telTemp);

                $sql = sprintf('INSERT INTO `matricula`.`telefone`
                    (`Pessoa_id_pessoa`,
                        `ddd`,
                        `telefone`,
                        `Tipo_Telefone_id_tipo_telefone`)
                VALUES
                (%s,
                    %s,
                    %s,
                    2)'
                , mysql_real_escape_string($id_pessoa)
                , mysql_real_escape_string($dadosPessoais['telefones']['ufResidencial'])
                , mysql_real_escape_string($telTemp));

                $telefone = mysql_query($sql);
                if (!$telefone) {
                    return false;
                }
            }
        }
        if (isset($dadosPessoais['telefones']['comercial'])) {
            if ($dadosPessoais['telefones']['comercial'] != '') {
                $telTemp = str_replace('(', '', $dadosPessoais['telefones']['comercial']);
                    $telTemp = str_replace(')', '', $telTemp);
                    $telTemp = str_replace('-', '', $telTemp);

                    $sql = sprintf('INSERT INTO `matricula`.`telefone`
                        (`Pessoa_id_pessoa`,
                            `ddd`,
                            `telefone`,
                            `Tipo_Telefone_id_tipo_telefone`)
                    VALUES
                    (%s,
                        %s,
                        %s,
                        3)'
                    , mysql_real_escape_string($id_pessoa)
                    , mysql_real_escape_string($dadosPessoais['telefones']['ufComercial'])
                    , mysql_real_escape_string($telTemp));

                    $telefone = mysql_query($sql);
                    if (!$telefone) {
                        return false;
                    }
                }
            }

            return true;
        }

        ?>