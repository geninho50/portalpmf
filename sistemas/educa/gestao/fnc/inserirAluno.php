<?php

function inserirAluno($sessao) {

    include_once('connect.php');

    if (isset($sessao['identificacao']['nome_aluno'])) {
        if ($sessao['identificacao']['nome_aluno'] != '') {
            $nomeAluno = $sessao['identificacao']['nome_aluno'];
        }
    }
    if (isset($sessao['novo_aluno_infantil']['dados_pessoais']['nome'])) {
        if ($sessao['novo_aluno_infantil']['dados_pessoais']['nome'] != '') {
            $nomeAluno = $sessao['novo_aluno_infantil']['dados_pessoais']['nome'];
        }
    }

    if (isset($sessao['identificacao']['data_nascimento'])) {
        if ($sessao['identificacao']['data_nascimento'] != '') {
            $dt_nasc = $sessao['identificacao']['data_nascimento'];
        }
    }
    if (isset($sessao['novo_aluno_infantil']['dados_pessoais']['data_nascimento'])) {
        if ($sessao['novo_aluno_infantil']['dados_pessoais']['data_nascimento'] != '') {
            $dt_nasc = $sessao['novo_aluno_infantil']['dados_pessoais']['data_nascimento'];
        }
    }
    
    $get = "select get_lock('pessoa', 10)";
    $release = "do release_lock('pessoa')";

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
    $sql2 = sprintf("INSERT INTO `matricula`.`pessoa_fisica`
                    (`Pessoa_id_pessoa`,
                    `ds_nome`,
                    `dt_nascimento`)
                    VALUES
                    (%s,
                    '%s', 
                    STR_TO_DATE('%s', '%s'))"
            , mysql_real_escape_string($id)
            , mysql_real_escape_string(strtoupper($nomeAluno))
            , mysql_real_escape_string($dt_nasc)
            , mysql_real_escape_string("%d/%m/%Y"));

    $resultado = mysql_query($sql2);

    if (!$resultado) {
        mysql_query($release);
        return false;
    }

//cria aluno
    $sql3 = sprintf('INSERT INTO `matricula`.`aluno`
(`Pessoa_Fisica_Pessoa_id_pessoa`)
VALUES
(%s)', mysql_real_escape_string($id));

    $resultado = mysql_query($sql3);
    
    if (!$resultado) {
        mysql_query($release);
        return false;
    }
    mysql_query($release);

    return $id;
}
?>