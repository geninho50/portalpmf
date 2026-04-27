<?php

function insereAuditoriaEditarDadosPessoaisFundamental($dadosPessoais, $id_pessoa, $id_usuario) {

    include_once('connect.php');

    if(!isset($dadosPessoais['etnia'])){
        $dadosPessoais['etnia'] = 'null';
    }    

    if(!isset($dadosPessoais['naturalidade']['municipio'])){
        $dadosPessoais['naturalidade']['municipio'] = 'null';
    }

    if(!isset($dadosPessoais['sexo'])){
        $dadosPessoais['sexo'] = 'null';
    }

    if(!isset($dadosPessoais['rg']['numero'])){
        $dadosPessoais['rg']['numero'] = null;
    }

    if(!isset($dadosPessoais['rg']['orgao_rg'])){
        $dadosPessoais['rg']['orgao_rg'] = null;
    }

    if(!isset($dadosPessoais['rg']['uf_rg'])){
        $dadosPessoais['rg']['uf_rg'] = null;
    }

    if(!isset($dadosPessoais['rg']['data_rg'])){
        $dadosPessoais['rg']['data_rg'] = null;
    }

    if(!isset($dadosPessoais['certidao']['numero'])){
        $dadosPessoais['certidao']['numero'] = null;
    }

    if(!isset($dadosPessoais['certidao']['termo'])){
        $dadosPessoais['certidao']['termo'] = null;
    }

    if(!isset($dadosPessoais['certidao']['folha'])){
        $dadosPessoais['certidao']['folha'] = null;
    }

    if(!isset($dadosPessoais['certidao']['livro'])){
        $dadosPessoais['certidao']['livro'] = null;
    }

    if(!isset($dadosPessoais['certidao']['cartorio'])){
        $dadosPessoais['certidao']['cartorio'] = null;
    }

    if(!isset($dadosPessoais['certidao']['uf_cart'])){
        $dadosPessoais['certidao']['uf_cart'] = null;
    }

    if(!isset($dadosPessoais['telefones']['celular'])){
        $dadosPessoais['telefones']['celular'] = null;
    }else {
        if($dadosPessoais['telefones']['celular'] == ''){
            $dadosPessoais['telefones']['celular'] = 'null';
        }
    }

    if(!isset($dadosPessoais['telefones']['ufCelular'])){
        $dadosPessoais['telefones']['ufCelular'] = null;
    }

    if(!isset($dadosPessoais['telefones']['residencial'])){
        $dadosPessoais['telefones']['residencial'] = null;
    } else {
        if($dadosPessoais['telefones']['residencial'] == ''){
            $dadosPessoais['telefones']['residencial'] = 'null';
        }
    }

    if(!isset($dadosPessoais['telefones']['ufResidencial'])){
        $dadosPessoais['telefones']['ufResidencial'] = null;
    }

    if(!isset($dadosPessoais['telefones']['ufComercial'])){
        $dadosPessoais['telefones']['ufComercial'] = null;
    }

    if(!isset($dadosPessoais['telefones']['comercial'])){
        $dadosPessoais['telefones']['comercial'] = null;
    } else {
        if($dadosPessoais['telefones']['comercial'] == ''){
            $dadosPessoais['telefones']['comercial'] = 'null';
        }
    }

    if(!isset($dadosPessoais['nacionalidade'])){
        $dadosPessoais['nacionalidade'] = null;
    }

    $sql = sprintf("INSERT INTO `matricula`.`auditoria_dados_pessoais_fundamental`
        (`id_aluno`,
            `id_etnia`,
            `id_naturalidade`,
            `ds_sexo`,
            `id_numero_rg`,
            `ds_orgao_rg`,
            `id_uf_rg`,
            `dt_rg`,
            `cert_novo`,
            `cert_termo`,
            `cert_folha`,
            `cert_livro`,
            `cert_cart`,
            `cert_uf`,
            `telefone_r`,
            `uf_telefone_r`,
            `telefone_co`,
            `uf_telefone_co`,
            `telefone_cel`,
            `uf_telefone_cel`,
            `id_pessoa`,
            `dt_alteracao`,
            `id_nacionalidade`)
VALUES
(%s,
    %s,
    %s,
    '%s',
    '%s',
    '%s',
    '%s',
    '%s',
    '%s',
    '%s',
    '%s',
    '%s',
    '%s',
    '%s',
    %s,
    %s,
    %s,
    %s,
    %s,
    %s,
    %s,
    sysdate(),
    %s);"
, mysql_real_escape_string($id_pessoa)
, mysql_real_escape_string($dadosPessoais['etnia'])
, mysql_real_escape_string($dadosPessoais['naturalidade']['municipio'])
, mysql_real_escape_string(strtoupper($dadosPessoais['sexo']))
, mysql_real_escape_string($dadosPessoais['rg']['numero'])
, mysql_real_escape_string($dadosPessoais['rg']['orgao_rg'])
, mysql_real_escape_string($dadosPessoais['rg']['uf_rg'])
, mysql_real_escape_string($dadosPessoais['rg']['data_rg'])
, mysql_real_escape_string($dadosPessoais['certidao']['numero'])
, mysql_real_escape_string($dadosPessoais['certidao']['termo'])
, mysql_real_escape_string($dadosPessoais['certidao']['folha'])
, mysql_real_escape_string($dadosPessoais['certidao']['livro'])
, mysql_real_escape_string($dadosPessoais['certidao']['cartorio'])
, mysql_real_escape_string($dadosPessoais['certidao']['uf_cart'])
, mysql_real_escape_string($dadosPessoais['telefones']['residencial'])
, mysql_real_escape_string($dadosPessoais['telefones']['ufResidencial'])
, mysql_real_escape_string($dadosPessoais['telefones']['comercial'])
, mysql_real_escape_string($dadosPessoais['telefones']['ufComercial'])
, mysql_real_escape_string($dadosPessoais['telefones']['celular'])
, mysql_real_escape_string($dadosPessoais['telefones']['ufCelular'])
, mysql_real_escape_string($id_usuario)
, mysql_real_escape_string($dadosPessoais['nacionalidade']));

$resultado = mysql_query($sql);

$row = true;

if(!isset($usuario)){
    return false;
} else{
    return $usuario;
}

}

?>