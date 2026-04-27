<?php

function insereAuditoriaEditarDadosMaeFundamental($dadosPessoais, $id_pessoa, $id_usuario) {

    include_once('connect.php');

    if(!isset($dadosPessoais['etnia'])){
        $dadosPessoais['etnia'] = 'null';
    }    
    if(!isset($dadosPessoais['sexo'])){
        $dadosPessoais['sexo'] = 'null';
    }


    if(!isset($dadosPessoais['religiao'])){
        $dadosPessoais['religiao'] = 'null';
    }

    if(!isset($dadosPessoais['profissao'])){
        $dadosPessoais['profissao'] = 'null';
    }

    if(!isset($dadosPessoais['estado_civil'])){
        $dadosPessoais['estado_civil'] = 'null';
    }

    if(!isset($dadosPessoais['nacionalidade'])){
        $dadosPessoais['nacionalidade'] = null;
    }

    if(!isset($dadosPessoais['escolaridade'])){
        $dadosPessoais['escolaridade'] = null;
    }

    if(!isset($dadosPessoais['naturalidade_municipio'])){
        $dadosPessoais['naturalidade_municipio'] = null;
    }

    if(!isset($dadosPessoais['nome'])){
        $dadosPessoais['nome'] = null;
    }

    if(!isset($dadosPessoais['data_nascimento'])){
        $dadosPessoais['data_nascimento'] = null;
    }

    if(!isset($dadosPessoais['email'])){
        $dadosPessoais['email'] = null;
    }

    if(!isset($dadosPessoais['celular'])){
        $dadosPessoais['celular'] = null;
    }else {
        if($dadosPessoais['celular'] == ''){
            $dadosPessoais['celular'] = 'null';
        }
    }
    if(!isset($dadosPessoais['telefone'])){
        $dadosPessoais['telefone'] = null;
    }else {
        if($dadosPessoais['telefone'] == ''){
            $dadosPessoais['telefone'] = 'null';
        }
    }

    if(!isset($dadosPessoais['comercial'])){
        $dadosPessoais['comercial'] = null;
    }else {
        if($dadosPessoais['comercial'] == ''){
            $dadosPessoais['comercial'] = 'null';
        }
    }

    if(!isset($dadosPessoais['bairro'])){
        $dadosPessoais['bairro'] = null;
    }

    if(!isset($dadosPessoais['cep'])){
        $dadosPessoais['cep'] = null;
    }

    if(!isset($dadosPessoais['logradouro'])){
        $dadosPessoais['logradouro'] = null;
    }

    if(!isset($dadosPessoais['municipio'])){
        $dadosPessoais['municipio'] = null;
    }

    if(!isset($dadosPessoais['estado'])){
        $dadosPessoais['estado'] = null;
    }

    if(!isset($dadosPessoais['numero'])){
        $dadosPessoais['numero'] = null;
    }

    if(!isset($dadosPessoais['complemento'])){
        $dadosPessoais['complemento'] = null;
    }

    if(!isset($dadosPessoais['bairro_trabalho'])){
        $dadosPessoais['bairro_trabalho'] = null;
    }

    if(!isset($dadosPessoais['cep_trabalho'])){
        $dadosPessoais['cep_trabalho'] = null;
    }

    if(!isset($dadosPessoais['logradouro_trabalho'])){
        $dadosPessoais['logradouro_trabalho'] = null;
    }

    if(!isset($dadosPessoais['municipio_trabalho'])){
        $dadosPessoais['municipio_trabalho'] = null;
    }

    if(!isset($dadosPessoais['estado_trabalho'])){
        $dadosPessoais['estado_trabalho'] = null;
    }

    if(!isset($dadosPessoais['numero_trabalho'])){
        $dadosPessoais['numero_trabalho'] = null;
    }

    if(!isset($dadosPessoais['complemento_trabalho'])){
        $dadosPessoais['complemento_trabalho'] = null;
    }

if(isset($dadosPessoais['turnos'])){
    if (in_array('mat', $dadosPessoais['turnos'])) {
        $mat = 1;
    } else {
        $mat = 0;
    }
    if (in_array('ves', $dadosPessoais['turnos'])) {
        $ves = 1;
    } else {
        $ves = 0;
    }
    if (in_array('not', $dadosPessoais['turnos'])) {
        $not = 1;
    } else {
        $not = 0;
    }
} else {
    $mat = 0;
    $ves = 0;
    $not = 0;
}


    $sql = sprintf("INSERT INTO `matricula`.`auditoria_dados_mae_fundamental`
(`id_aluno`,
`id_etnia`,
`id_religiao`,
`id_profissao`,
`id_estado_civil`,
`id_nacionalidade`,
`id_naturalidade`,
`id_escolaridade`,
`ds_sexo`,
`ds_nome`,
`dt_nascimento`,
`id_turno_mat`,
`id_turno_ves`,
`id_turno_not`,
`uf_cel`,
`cel`,
`uf_tel`,
`tel`,
`uf_com`,
`com`,
`email`,
`cpf`,
`cep`,
`logradouro`,
`numero`,
`complemento`,
`bairro`,
`estado`,
`municipio`,
`cep_trabalho`,
`logradouro_trabalho`,
`numero_trabalho`,
`complemento_trabalho`,
`bairro_trabalho`,
`estado_trabalho`,
`municipio_trabalho`,
`id_usuario_alterou`,
`dt_alteracao`)
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
 '%s',
 %s,
 %s,
 %s,
null,
 '%s',
null,
 '%s',
null,
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
 '%s',
 '%s',
 '%s',
 '%s',
 '%s',
 '%s',
 %s,
 sysdate());"
, mysql_real_escape_string($id_pessoa)
, mysql_real_escape_string($dadosPessoais['etnia'])
, mysql_real_escape_string($dadosPessoais['religiao'])
, mysql_real_escape_string($dadosPessoais['profissao'])
, mysql_real_escape_string($dadosPessoais['estado_civil'])
, mysql_real_escape_string($dadosPessoais['nacionalidade'])
, mysql_real_escape_string($dadosPessoais['naturalidade_municipio'])
, mysql_real_escape_string($dadosPessoais['escolaridade'])
, mysql_real_escape_string($dadosPessoais['sexo'])
, mysql_real_escape_string($dadosPessoais['nome'])
, mysql_real_escape_string($dadosPessoais['data_nascimento'])
, mysql_real_escape_string($mat)
, mysql_real_escape_string($ves)
, mysql_real_escape_string($not)
, mysql_real_escape_string($dadosPessoais['celular'])
, mysql_real_escape_string($dadosPessoais['telefone'])
, mysql_real_escape_string($dadosPessoais['comercial'])
, mysql_real_escape_string($dadosPessoais['email'])
, mysql_real_escape_string($dadosPessoais['cpf'])
, mysql_real_escape_string($dadosPessoais['cep'])
, mysql_real_escape_string($dadosPessoais['logradouro'])
, mysql_real_escape_string($dadosPessoais['numero'])
, mysql_real_escape_string($dadosPessoais['complemento'])
, mysql_real_escape_string($dadosPessoais['bairro'])
, mysql_real_escape_string($dadosPessoais['estado'])
, mysql_real_escape_string($dadosPessoais['municipio'])
, mysql_real_escape_string($dadosPessoais['cep_trabalho'])
, mysql_real_escape_string($dadosPessoais['logradouro_trabalho'])
, mysql_real_escape_string($dadosPessoais['numero_trabalho'])
, mysql_real_escape_string($dadosPessoais['complemento_trabalho'])
, mysql_real_escape_string($dadosPessoais['bairro_trabalho'])
, mysql_real_escape_string($dadosPessoais['estado_trabalho'])
, mysql_real_escape_string($dadosPessoais['municipio_trabalho'])
, mysql_real_escape_string($id_usuario));

$resultado = mysql_query($sql);

$row = true;

if(!isset($resultado)){
    return false;
} else{
    return $resultado;
}

}

?>