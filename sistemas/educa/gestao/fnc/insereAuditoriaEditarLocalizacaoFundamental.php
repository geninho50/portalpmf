<?php

function insereAuditoriaEditarLocalizacaoFundamental($localizacao, $id_pessoa, $id_usuario) {

    include_once('connect.php');

    if(!isset($localizacao['cep'])){
        $localizacao['cep'] = 'null';
    } else {
        $localizacao['cep'] = str_replace('-', '', $localizacao['cep']);
        $localizacao['cep'] = str_replace('.', '', $localizacao['cep']);
    }    
    if(!isset($localizacao['logradouro'])){
        $localizacao['logradouro'] = 'null';
    }    
    if(!isset($localizacao['numero'])){
        $localizacao['numero'] = 'null';
    }    
    if(!isset($localizacao['complemento'])){
        $localizacao['complemento'] = 'null';
    }    
    if(!isset($localizacao['bairro'])){
        $localizacao['bairro'] = 'null';
    }    
    if(!isset($localizacao['estado'])){
        $localizacao['estado'] = 'null';
    }    
    if(!isset($localizacao['municipio'])){
        $localizacao['municipio'] = 'null';
    }    

    $sql = sprintf("INSERT INTO `matricula`.`auditoria_localizacao_fundamental`
        (`id_aluno`,
            `cep`,
            `logradouro`,
            `numero`,
            `complemento`,
            `bairro`,
            `estado`,
            `municipio`,
            `id_pessoa_alterou`,
            `dt_alteracao`)
    VALUES
    (%s,
        %s,
        '%s',
        %s,
        '%s',
        %s,
        %s,
        %s,
        %s,
        sysdate());"
    , mysql_real_escape_string($id_pessoa)
    , mysql_real_escape_string($localizacao['cep'])
    , mysql_real_escape_string($localizacao['logradouro'])
    , mysql_real_escape_string($localizacao['numero'])
    , mysql_real_escape_string($localizacao['complemento'])
    , mysql_real_escape_string($localizacao['bairro'])
    , mysql_real_escape_string($localizacao['estado'])
    , mysql_real_escape_string($localizacao['municipio'])
    , mysql_real_escape_string($id_usuario));

    $resultado = mysql_query($sql);

    $row = true;

    if(!isset($usuario)){
        return false;
    } else{
        return $usuario;
    }

}

?>