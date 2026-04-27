<?php

function inserirResponsavel($dados, $id, $parentesco, $aluno) {

    include_once('connect.php');

    //criar pessoa_fisica
    $get = "select get_lock('pessoa', 10)";
    $release = "do release_lock('pessoa')";

    mysql_query($get);

    if (!isset($id)) {

//cria pessoa
        $sql = "INSERT INTO `matricula`.`pessoa`
        (`criado_em`)
        VALUES
        (sysdate())";

        $resultado = mysql_query($sql);

        if (!$resultado) {
            mysql_query($release);
            return false;
        }
		$id_todos = mysql_fetch_row(mysql_query("select last_insert_id()"));
        $id = $id_todos[0];

        //cria pessoa fisica
        if ($dados['nacionalidade'] == 30) {
            $sql2 = sprintf("INSERT INTO `matricula`.`pessoa_fisica`
                (`Pessoa_id_pessoa`,
                    `Etnia_id_etnia`,
                    `Religiao_id_religiao`,
                    `Profissao_id_profissao`,
                    `Estado_Civil_id_estado_civil`,
                    `id_nacionalidade`,
                    `id_naturalidade`,
                    `Escolaridade_id_escolaridade`,
                    `ds_sexo`,
                    `ds_nome`,
                    `dt_nascimento`)
VALUES
(%s,
    %s,
    %s,
    %s,
    %s,
    %s,
    %s,
    %s,
    '%s',
    '%s',
    str_to_date('%s', '%s'))"
            , mysql_real_escape_string($id)
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
            , mysql_real_escape_string("%d/%m/%Y"));
} else {
    $sql2 = sprintf("INSERT INTO `matricula`.`pessoa_fisica`
        (`Pessoa_id_pessoa`,
            `Etnia_id_etnia`,
            `Religiao_id_religiao`,
            `Profissao_id_profissao`,
            `Estado_Civil_id_estado_civil`,
            `id_nacionalidade`,
            `Escolaridade_id_escolaridade`,
            `ds_sexo`,
            `ds_nome`,
            `dt_nascimento`)
VALUES
(%s,
    %s,
    %s,
    %s,
    %s,
    %s,
    %s,
    '%s',
    '%s',
    str_to_date('%s', '%s'))"
    , mysql_real_escape_string($id)
    , mysql_real_escape_string($dados['etnia'])
    , mysql_real_escape_string($dados['religiao'])
    , mysql_real_escape_string($dados['profissao'])
    , mysql_real_escape_string($dados['estado_civil'])
    , mysql_real_escape_string($dados['nacionalidade'])
    , mysql_real_escape_string($dados['escolaridade'])
    , mysql_real_escape_string($dados['sexo'])
    , mysql_real_escape_string($dados['nome'])
    , mysql_real_escape_string($dados['data_nascimento'])
    , mysql_real_escape_string("%d/%m/%Y"));
}

$resultado = mysql_query($sql2);

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
$sql3 = sprintf('INSERT INTO `matricula`.`responsavel`
    (`Pessoa_Fisica_Pessoa_id_pessoa`, `id_turno_matutino`, `id_turno_vespertino`, `id_turno_noturno`)
    VALUES
    (%s, %s, %s, %s)'
    , mysql_real_escape_string($id)
    , mysql_real_escape_string($mat)
    , mysql_real_escape_string($ves)
    , mysql_real_escape_string($not));

$resultado = mysql_query($sql3);

if (!$resultado) {
    mysql_query($release);
    return false;
}
mysql_query($release);
}

$_SESSION[$parentesco]['id'] = $id;

    //inserir telefones
if (($dados['celular'] != '') && (strlen($dados['celular']) > 2)) {
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
    if (($dados['telefone'] != '') && (strlen($dados['telefone']) > 2)) {
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
        if (($dados['comercial'] != '') && (strlen($dados['comercial']) > 2)) {
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
                %s)"
            , mysql_real_escape_string($aluno)
            , mysql_real_escape_string($id)
            , mysql_real_escape_string($id_parentesco)
            , mysql_real_escape_string($moraComAluno)
            , mysql_real_escape_string($quemAcompanha));

            $responsavel_aluno = mysql_query($sql);
            
            if (!$responsavel_aluno) {
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
            
            $sql = sprintf("INSERT INTO `matricula`.`documento`
                (`Pessoa_Fisica_Pessoa_id_pessoa`,
                    `Tipo_Documento_id_tipo_documento`,
                    `ds_valor`)
            VALUES
            (%s,
                3,
                '%s')"
            , mysql_real_escape_string($id)
            , mysql_real_escape_string($_SESSION[$parentesco]['cpf']));

            $rg = mysql_query($sql);

            return true;
        }


function inserirResponsavelEditar($dados, $id, $parentesco, $aluno) {

    include_once('connect.php');

    //criar pessoa_fisica
    $get = "select get_lock('pessoa', 10)";
    $release = "do release_lock('pessoa')";

    mysql_query($get);

    if (!isset($id)) {

//cria pessoa
        $sql = "INSERT INTO `matricula`.`pessoa`
        (`criado_em`)
        VALUES
        (sysdate())";

        $resultado = mysql_query($sql);

        if (!$resultado) {
            mysql_query($release);
            return false;
        }
		$id_todos = mysql_fetch_row(mysql_query("select last_insert_id()"));
        $id = $id_todos[0];

        //cria pessoa fisica
        if ($dados['nacionalidade'] == 30) {
            $sql2 = sprintf("INSERT INTO `matricula`.`pessoa_fisica`
                (`Pessoa_id_pessoa`,
                    `Etnia_id_etnia`,
                    `Religiao_id_religiao`,
                    `Profissao_id_profissao`,
                    `Estado_Civil_id_estado_civil`,
                    `id_nacionalidade`,
                    `id_naturalidade`,
                    `Escolaridade_id_escolaridade`,
                    `ds_sexo`,
                    `ds_nome`,
                    `dt_nascimento`)
VALUES
(%s,
    %s,
    %s,
    %s,
    %s,
    %s,
    %s,
    %s,
    '%s',
    '%s',
    str_to_date('%s', '%s'))"
            , mysql_real_escape_string($id)
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
            , mysql_real_escape_string("%d/%m/%Y"));
} else {
    $sql2 = sprintf("INSERT INTO `matricula`.`pessoa_fisica`
        (`Pessoa_id_pessoa`,
            `Etnia_id_etnia`,
            `Religiao_id_religiao`,
            `Profissao_id_profissao`,
            `Estado_Civil_id_estado_civil`,
            `id_nacionalidade`,
            `Escolaridade_id_escolaridade`,
            `ds_sexo`,
            `ds_nome`,
            `dt_nascimento`)
VALUES
(%s,
    %s,
    %s,
    %s,
    %s,
    %s,
    %s,
    '%s',
    '%s',
    str_to_date('%s', '%s'))"
    , mysql_real_escape_string($id)
    , mysql_real_escape_string($dados['etnia'])
    , mysql_real_escape_string($dados['religiao'])
    , mysql_real_escape_string($dados['profissao'])
    , mysql_real_escape_string($dados['estado_civil'])
    , mysql_real_escape_string($dados['nacionalidade'])
    , mysql_real_escape_string($dados['escolaridade'])
    , mysql_real_escape_string($dados['sexo'])
    , mysql_real_escape_string($dados['nome'])
    , mysql_real_escape_string($dados['data_nascimento'])
    , mysql_real_escape_string("%d/%m/%Y"));
}

$resultado = mysql_query($sql2);


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
$sql3 = sprintf('INSERT INTO `matricula`.`responsavel`
    (`Pessoa_Fisica_Pessoa_id_pessoa`, `id_turno_matutino`, `id_turno_vespertino`, `id_turno_noturno`)
    VALUES
    (%s, %s, %s, %s)'
    , mysql_real_escape_string($id)
    , mysql_real_escape_string($mat)
    , mysql_real_escape_string($ves)
    , mysql_real_escape_string($not));

$resultado = mysql_query($sql3);

if (!$resultado) {
    mysql_query($release);
    return false;
}
mysql_query($release);
}

$_SESSION[$parentesco]['id'] = $id;

    //inserir telefones
if (($dados['celular'] != '') && (strlen($dados['celular']) > 2)) {
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
    if (($dados['telefone'] != '') && (strlen($dados['telefone']) > 2)) {
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
        if (($dados['comercial'] != '') && (strlen($dados['comercial']) > 2)) {
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
                %s)"
            , mysql_real_escape_string($aluno)
            , mysql_real_escape_string($id)
            , mysql_real_escape_string($id_parentesco)
            , mysql_real_escape_string($moraComAluno)
            , mysql_real_escape_string($quemAcompanha));

            $responsavel_aluno = mysql_query($sql);
            
            if (!$responsavel_aluno) {
                return false;
            }

            include 'fnc/inserirEndereco.php';
            inserirEndereco($dados, $id, 1);

            if (isset($dados['cep_trabalho'])) {
                $enderecoTrabalho['cep'] = $dados['cep_trabalho'];
                $enderecoTrabalho['logradouro'] = $dados['logradouro_trabalho'];
                $enderecoTrabalho['numero'] = $dados['numero_trabalho'];
                $enderecoTrabalho['complemento'] = $dados['complemento_trabalho'];
                $enderecoTrabalho['bairro'] = $dados['bairro_trabalho'];
                $enderecoTrabalho['estado'] = $dados['estado_trabalho'];
                $enderecoTrabalho['municipio'] = $dados['municipio_trabalho'];

                inserirEndereco($enderecoTrabalho, $id, 2);
            }
            
            $dados['cpf'] = str_replace('-', '', $dados['cpf']);
            $dados['cpf'] = str_replace('.', '', $dados['cpf']);

            $sql = sprintf("INSERT INTO `matricula`.`documento`
                (`Pessoa_Fisica_Pessoa_id_pessoa`,
                    `Tipo_Documento_id_tipo_documento`,
                    `ds_valor`)
            VALUES
            (%s,
                3,
                '%s')"
            , mysql_real_escape_string($id)
            , mysql_real_escape_string($dados['cpf']));

            $rg = mysql_query($sql);

            return true;
        }

        ?>