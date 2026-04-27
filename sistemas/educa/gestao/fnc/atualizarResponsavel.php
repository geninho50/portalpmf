<?php

function atualizarResponsavel($dados, $id, $parentesco, $aluno) {

   	include_once('connect.php');

    //criar pessoa_fisica
    $get = "select get_lock('pessoa', 10)";
    $release = "do release_lock('pessoa')";

    mysql_query($get);

    if ($dados['nacionalidade'] == 30) {
        $sql2 = sprintf("update `matricula`.`pessoa_fisica`
            set `Etnia_id_etnia` = %s,
            `Religiao_id_religiao` = %s,
            `Profissao_id_profissao` = %s,
            `Estado_Civil_id_estado_civil` = %s,
            `id_nacionalidade` = %s,
            `id_naturalidade` = %s,
            `Escolaridade_id_escolaridade` = %s,
            `ds_sexo` = '%s',
            `ds_nome` = '%s',
            `dt_nascimento` = str_to_date('%s', '%s')
            WHERE `Pessoa_id_pessoa` = %s"
            , mysql_real_escape_string($dados['etnia'])
            , mysql_real_escape_string($dados['religiao'])
            , mysql_real_escape_string($dados['profissao'])
            , mysql_real_escape_string($dados['estado_civil'])
            , mysql_real_escape_string($dados['nacionalidade'])
            , mysql_real_escape_string($dados['naturalidade_municipio'])
            , mysql_real_escape_string($dados['escolaridade'])
            , mysql_real_escape_string($dados['sexo'])
            , mysql_real_escape_string($dados['nome'])
            , mysql_real_escape_string($dados['data_nascimento'])
            , mysql_real_escape_string("%d/%m/%Y")
            , mysql_real_escape_string($id));
} else {
    $sql2 = sprintf("update `matricula`.`pessoa_fisica`
        set `Etnia_id_etnia` = %s,
        `Religiao_id_religiao` = %s,
        `Profissao_id_profissao` = %s,
        `Estado_Civil_id_estado_civil` = %s,
        `id_nacionalidade` = %s,
        `Escolaridade_id_escolaridade` = %s,
        `ds_sexo` = '%s',
        `ds_nome` = '%s',
        `dt_nascimento` = str_to_date('%s', '%s')
        WHERE `Pessoa_id_pessoa` = %s"
        , mysql_real_escape_string($dados['etnia'])
        , mysql_real_escape_string($dados['religiao'])
        , mysql_real_escape_string($dados['profissao'])
        , mysql_real_escape_string($dados['estado_civil'])
        , mysql_real_escape_string($dados['nacionalidade'])
        , mysql_real_escape_string($dados['escolaridade'])
        , mysql_real_escape_string($dados['sexo'])
        , mysql_real_escape_string($dados['nome'])
        , mysql_real_escape_string($dados['data_nascimento'])
        , mysql_real_escape_string("%d/%m/%Y")
        , mysql_real_escape_string($id));
}

$resultado = mysql_query($sql2);    

if (!$resultado) {
    mysql_query($release);
    return false;
}
mysql_query($release);


$_SESSION[$parentesco]['id'] = $id;

$sql = sprintf('delete from `matricula`.`telefone` where `Pessoa_id_pessoa` = %s', mysql_real_escape_string($id));
$telefone = mysql_query($sql);
if (!$telefone) {
    return false;
}

    //inserir telefones
if (($dados['celular'] != '') && strlen($dados['celular']) > 2) {
    $telTemp = str_replace('(', '', $dados['celular']);
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
        , mysql_real_escape_string($id)
        , mysql_real_escape_string(substr($telTemp, 0, 2))
        , mysql_real_escape_string(substr($telTemp, 2)));

        $telefone = mysql_query($sql);
        if (!$telefone) {
            return false;
        }
    }
    if (($dados['telefone'] != '') && strlen($dados['telefone']) > 2) {
        $telTemp = str_replace('(', '', $dados['telefone']);
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
            , mysql_real_escape_string($id)
            , mysql_real_escape_string(substr($telTemp, 0, 2))
            , mysql_real_escape_string(substr($telTemp, 2)));

            $telefone = mysql_query($sql);
            if (!$telefone) {
                return false;
            }
        }
        if (($dados['comercial'] != '') && strlen($dados['comercial']) > 2) {
            $telTemp = str_replace('(', '', $dados['comercial']);
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
                , mysql_real_escape_string($id)
                , mysql_real_escape_string(substr($telTemp, 0, 2))
                , mysql_real_escape_string(substr($telTemp, 2)));

                $telefone = mysql_query($sql);
                if (!$telefone) {
                    return false;
                }
            }

            if (!$resultado) {
                mysql_query($release);
                return false;
            }

            if (in_array('mat', $dados['turnos'])) {
                $mat = 1;
            } else {
                $mat = 0;
            }
            if (in_array('ves', $dados['turnos'])) {
                $ves = 1;
            } else {
                $ves = 0;
            }
            if (in_array('not', $dados['turnos'])) {
                $not = 1;
            } else {
                $not = 0;
            }

    //cria responsavel
            $sql3 = sprintf('UPDATE `matricula`.`responsavel` set `id_turno_matutino` = %s, `id_turno_vespertino` = %s, `id_turno_noturno` = %s
             WHERE `Pessoa_Fisica_Pessoa_id_pessoa` = %s'
             , mysql_real_escape_string($mat)
             , mysql_real_escape_string($ves)
             , mysql_real_escape_string($not)
             , mysql_real_escape_string($id));

            $resultado = mysql_query($sql3);

            if (!$resultado) {
                return false;
            }

            $sql = sprintf('delete from `matricula`.`email` where `Pessoa_id_pessoa` = %s', mysql_real_escape_string($id));
            $email = mysql_query($sql);
            if (!$email) {
                return false;
            }

            if ($dados['email'] != '') {
                $sql = sprintf("INSERT INTO `matricula`.`email`
                    (`Pessoa_id_pessoa`,
                        `ds_email`)
                VALUES
                (%s,
                    '%s')"
                , mysql_real_escape_string($id)
                , mysql_real_escape_string($dados['email']));
                $email = mysql_query($sql);
                if (!$email) {
                    return false;
                }
            }

            if ($parentesco == 'mae') {
                $id_parentesco = 1;
            } else {
                if ($parentesco == 'pai') {
                    $id_parentesco = 2;
                } else {
                    $id_parentesco = 3;
                }
            }

            if (isset($dados['mora_aluno'])) {
                if ($dados['mora_aluno']) {
                    $moraComAluno = 1;
                } else {
                    $moraComAluno = 0;
                }
            } else {
                $moraComAluno = 0;
            }

            if (isset($dados['quem_acompanha'])) {
                if ($dados['quem_acompanha']) {
                    $quemAcompanha = 1;
                } else {
                    $quemAcompanha = 0;
                }
            } else {
                $quemAcompanha = 0;
            }

            $sql = sprintf("INSERT INTO `matricula`.`responsavel_aluno`
                (`Aluno_Pessoa_Fisica_Pessoa_id_pessoa`,
                    `Responsavel_Pessoa_Fisica_Pessoa_id_pessoa`,
                    `Parentesco_id_parentesco`,
                    `mora_com`,
                    `acompanha`)
            VALUES
            (%s,
                %s,
                %s,
                %s,
                %s) ON DUPLICATE KEY UPDATE 
            `Parentesco_id_parentesco` = %s,
            `mora_com` = %s,
            `acompanha` = %s"
            , mysql_real_escape_string($aluno)
            , mysql_real_escape_string($id)
            , mysql_real_escape_string($id_parentesco)
            , mysql_real_escape_string($moraComAluno)
            , mysql_real_escape_string($quemAcompanha)
            , mysql_real_escape_string($id_parentesco)
            , mysql_real_escape_string($moraComAluno)
            , mysql_real_escape_string($quemAcompanha));
            $responsavel_aluno = mysql_query($sql);

            if (!$responsavel_aluno) {
                return false;
            }


            $sql = sprintf('delete from `matricula`.`endereco` where `Pessoa_id_pessoa` = %s', mysql_real_escape_string($id));
            $end = mysql_query($sql);
            if (!$end) {
                return false;
            }

            include 'fnc/inserirEndereco.php';
            inserirEndereco($dados, $id, 1);

            if (isset($_SESSION[$parentesco]['cep_trabalho'])) {
                $enderecoTrabalho['cep'] = $dados['cep_trabalho'];
                $enderecoTrabalho['logradouro'] = $dados['logradouro_trabalho'];
                $enderecoTrabalho['numero'] = $dados['numero_trabalho'];
                $enderecoTrabalho['complemento'] = $dados['complemento_trabalho'];
                $enderecoTrabalho['bairro'] = $dados['bairro_trabalho'];
                $enderecoTrabalho['estado'] = $dados['estado_trabalho'];
                $enderecoTrabalho['municipio'] = $dados['municipio_trabalho'];

                inserirEndereco($enderecoTrabalho, $id, 2);
            }

            $sql = sprintf('delete from `matricula`.`documento` where `Pessoa_Fisica_Pessoa_id_pessoa` = %s', mysql_real_escape_string($id));
            $doc = mysql_query($sql);
            if (!$doc) {
                return false;
            }

            $cpf = str_replace('.', '', $_SESSION[$parentesco]['cpf']);
            $cpf = str_replace('-', '', $cpf);

            $sql = sprintf("INSERT INTO `matricula`.`documento`
                (`Pessoa_Fisica_Pessoa_id_pessoa`,
                    `Tipo_Documento_id_tipo_documento`,
                    `ds_valor`)
            VALUES
            (%s,
                3,
                '%s')"
            , mysql_real_escape_string($id)
            , mysql_real_escape_string($cpf));

            $rg = mysql_query($sql);

            return true;
        }

        function atualizarResponsavelEditar($dados, $id, $parentesco, $aluno) {

            include_once('connect.php');

    //criar pessoa_fisica
            $get = "select get_lock('pessoa', 10)";
            $release = "do release_lock('pessoa')";

            mysql_query($get);

            if ($dados['nacionalidade'] == 30) {
                $sql2 = sprintf("update `matricula`.`pessoa_fisica`
                    set `Etnia_id_etnia` = %s,
                    `Religiao_id_religiao` = %s,
                    `Profissao_id_profissao` = %s,
                    `Estado_Civil_id_estado_civil` = %s,
                    `id_nacionalidade` = %s,
                    `id_naturalidade` = %s,
                    `Escolaridade_id_escolaridade` = %s,
                    `ds_sexo` = '%s',
                    `ds_nome` = '%s',
                    `dt_nascimento` = str_to_date('%s', '%s')
                    WHERE `Pessoa_id_pessoa` = %s"
                    , mysql_real_escape_string($dados['etnia'])
                    , mysql_real_escape_string($dados['religiao'])
                    , mysql_real_escape_string($dados['profissao'])
                    , mysql_real_escape_string($dados['estado_civil'])
                    , mysql_real_escape_string($dados['nacionalidade'])
                    , mysql_real_escape_string($dados['naturalidade_municipio'])
                    , mysql_real_escape_string($dados['escolaridade'])
                    , mysql_real_escape_string($dados['sexo'])
                    , mysql_real_escape_string($dados['nome'])
                    , mysql_real_escape_string($dados['data_nascimento'])
                    , mysql_real_escape_string("%d/%m/%Y")
                    , mysql_real_escape_string($id));
} else {
    $sql2 = sprintf("update `matricula`.`pessoa_fisica`
        set `Etnia_id_etnia` = %s,
        `Religiao_id_religiao` = %s,
        `Profissao_id_profissao` = %s,
        `Estado_Civil_id_estado_civil` = %s,
        `id_nacionalidade` = %s,
        `Escolaridade_id_escolaridade` = %s,
        `ds_sexo` = '%s',
        `ds_nome` = '%s',
        `dt_nascimento` = str_to_date('%s', '%s')
        WHERE `Pessoa_id_pessoa` = %s"
        , mysql_real_escape_string($dados['etnia'])
        , mysql_real_escape_string($dados['religiao'])
        , mysql_real_escape_string($dados['profissao'])
        , mysql_real_escape_string($dados['estado_civil'])
        , mysql_real_escape_string($dados['nacionalidade'])
        , mysql_real_escape_string($dados['escolaridade'])
        , mysql_real_escape_string($dados['sexo'])
        , mysql_real_escape_string($dados['nome'])
        , mysql_real_escape_string($dados['data_nascimento'])
        , mysql_real_escape_string("%d/%m/%Y")
        , mysql_real_escape_string($id));
}

$resultado = mysql_query($sql2);    

if (!$resultado) {
    mysql_query($release);
    return false;
}
mysql_query($release);


$dados['id'] = $id;

$sql = sprintf('delete from `matricula`.`telefone` where `Pessoa_id_pessoa` = %s', mysql_real_escape_string($id));
$telefone = mysql_query($sql);
if (!$telefone) {
    return false;
}

    //inserir telefones
if (($dados['celular'] != '') && strlen($dados['celular']) > 2) {
    $telTemp = str_replace('(', '', $dados['celular']);
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
        , mysql_real_escape_string($id)
        , mysql_real_escape_string(substr($telTemp, 0, 2))
        , mysql_real_escape_string(substr($telTemp, 2)));

        $telefone = mysql_query($sql);
        if (!$telefone) {
            return false;
        }
    }
    if (($dados['telefone'] != '') && strlen($dados['telefone']) > 2) {
        $telTemp = str_replace('(', '', $dados['telefone']);
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
            , mysql_real_escape_string($id)
            , mysql_real_escape_string(substr($telTemp, 0, 2))
            , mysql_real_escape_string(substr($telTemp, 2)));

            $telefone = mysql_query($sql);
            if (!$telefone) {
                return false;
            }
        }
        if (($dados['comercial'] != '') && strlen($dados['comercial']) > 2) {
            $telTemp = str_replace('(', '', $dados['comercial']);
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
                , mysql_real_escape_string($id)
                , mysql_real_escape_string(substr($telTemp, 0, 2))
                , mysql_real_escape_string(substr($telTemp, 2)));

                $telefone = mysql_query($sql);
                if (!$telefone) {
                    return false;
                }
            }

            if (!$resultado) {
                mysql_query($release);
                return false;
            }

            if(isset($dados['turnos'])){
                if (in_array('mat', $dados['turnos'])) {
                    $mat = 1;
                } else {
                    $mat = 0;
                }
                if (in_array('ves', $dados['turnos'])) {
                    $ves = 1;
                } else {
                    $ves = 0;
                }
                if (in_array('not', $dados['turnos'])) {
                    $not = 1;
                } else {
                    $not = 0;
                }
            } else {
                $mat = 0;
                $ves = 0;
                $not = 0;
            }

    //cria responsavel
            $sql3 = sprintf('UPDATE `matricula`.`responsavel` set `id_turno_matutino` = %s, `id_turno_vespertino` = %s, `id_turno_noturno` = %s
             WHERE `Pessoa_Fisica_Pessoa_id_pessoa` = %s'
             , mysql_real_escape_string($mat)
             , mysql_real_escape_string($ves)
             , mysql_real_escape_string($not)
             , mysql_real_escape_string($id));

            $resultado = mysql_query($sql3);

            if (!$resultado) {
                return false;
            }

            $sql = sprintf('delete from `matricula`.`email` where `Pessoa_id_pessoa` = %s', mysql_real_escape_string($id));
            $email = mysql_query($sql);
            if (!$email) {
                return false;
            }

            if ($dados['email'] != '') {
                $sql = sprintf("INSERT INTO `matricula`.`email`
                    (`Pessoa_id_pessoa`,
                        `ds_email`)
                VALUES
                (%s,
                    '%s')"
                , mysql_real_escape_string($id)
                , mysql_real_escape_string($dados['email']));
                $email = mysql_query($sql);
                if (!$email) {
                    return false;
                }
            }

            if ($parentesco == 'mae') {
                $id_parentesco = 1;
            } else {
                if ($parentesco == 'pai') {
                    $id_parentesco = 2;
                } else {
                    $id_parentesco = 3;
                }
            }

            if (isset($dados['mora_aluno'])) {
                if ($dados['mora_aluno']) {
                    $moraComAluno = 1;
                } else {
                    $moraComAluno = 0;
                }
            } else {
                $moraComAluno = 0;
            }

            if (isset($dados['quem_acompanha'])) {
                if ($dados['quem_acompanha']) {
                    $quemAcompanha = 1;
                } else {
                    $quemAcompanha = 0;
                }
            } else {
                $quemAcompanha = 0;
            }

            $sql = sprintf("INSERT INTO `matricula`.`responsavel_aluno`
                (`Aluno_Pessoa_Fisica_Pessoa_id_pessoa`,
                    `Responsavel_Pessoa_Fisica_Pessoa_id_pessoa`,
                    `Parentesco_id_parentesco`,
                    `mora_com`,
                    `acompanha`)
            VALUES
            (%s,
                %s,
                %s,
                %s,
                %s) ON DUPLICATE KEY UPDATE 
            `Parentesco_id_parentesco` = %s,
            `mora_com` = %s,
            `acompanha` = %s"
            , mysql_real_escape_string($aluno)
            , mysql_real_escape_string($id)
            , mysql_real_escape_string($id_parentesco)
            , mysql_real_escape_string($moraComAluno)
            , mysql_real_escape_string($quemAcompanha)
            , mysql_real_escape_string($id_parentesco)
            , mysql_real_escape_string($moraComAluno)
            , mysql_real_escape_string($quemAcompanha));
            $responsavel_aluno = mysql_query($sql);

            if (!$responsavel_aluno) {
                return false;
            }


            $sql = sprintf('delete from `matricula`.`endereco` where `Pessoa_id_pessoa` = %s', mysql_real_escape_string($id));
            $end = mysql_query($sql);
            if (!$end) {
                return false;
            }

            include 'fnc/inserirEndereco.php';
            inserirEndereco($dados, $id, 1);

            if (isset($dados['cep_trabalho'])) {
                if($dados['cep_trabalho'] != ''){
                    $enderecoTrabalho['cep'] = $dados['cep_trabalho'];
                    $enderecoTrabalho['logradouro'] = $dados['logradouro_trabalho'];
                    $enderecoTrabalho['numero'] = $dados['numero_trabalho'];
                    $enderecoTrabalho['complemento'] = $dados['complemento_trabalho'];
                    $enderecoTrabalho['bairro'] = $dados['bairro_trabalho'];
                    $enderecoTrabalho['estado'] = $dados['estado_trabalho'];
                    $enderecoTrabalho['municipio'] = $dados['municipio_trabalho'];

                    inserirEndereco($enderecoTrabalho, $id, 2);
                }
            }

            $sql = sprintf('delete from `matricula`.`documento` where `Pessoa_Fisica_Pessoa_id_pessoa` = %s', mysql_real_escape_string($id));
            $doc = mysql_query($sql);
            if (!$doc) {
                return false;
            }

            $cpf = str_replace('.', '', $dados['cpf']);
            $cpf = str_replace('-', '', $cpf);

            $sql = sprintf("INSERT INTO `matricula`.`documento`
                (`Pessoa_Fisica_Pessoa_id_pessoa`,
                    `Tipo_Documento_id_tipo_documento`,
                    `ds_valor`)
            VALUES
            (%s,
                3,
                '%s')"
            , mysql_real_escape_string($id)
            , mysql_real_escape_string($cpf));

            $rg = mysql_query($sql);

            return true;
        }

        ?>