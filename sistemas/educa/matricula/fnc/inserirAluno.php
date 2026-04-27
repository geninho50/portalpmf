<?php

function inserirAluno($sessao) {

    include_once('connect.php');

    $nomeAluno = $sessao['identificacao']['nome_aluno'];

    $get = "select get_lock('pessoa', 10)";
    $release = "do release_lock('pessoa')";

    mysql_query($get);

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

    $id = mysql_fetch_row(mysql_query("select last_insert_id()"))[0];

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
            , mysql_real_escape_string($sessao['identificacao']['data_nascimento'])
            , mysql_real_escape_string("%d/%m/%Y"));

    $resultado = mysql_query($sql2);

    if (!$resultado) {
        mysql_query($release);
        return false;
    }

    if(!isset($_SESSION['identificacao']['nome_mae'])){
        $_SESSION['identificacao']['nome_mae'] = '';
    }    
    if(!isset($_SESSION['identificacao']['nome_pai'])){
        $_SESSION['identificacao']['nome_pai'] = '';
    }
    
    //cria aluno
    $sql3 = sprintf("INSERT INTO `matricula`.`aluno`
(`Pessoa_Fisica_Pessoa_id_pessoa`, `ds_nome_mae`, `ds_nome_pai`)
VALUES
(%s, '%s', '%s')", mysql_real_escape_string($id)
            , mysql_real_escape_string($_SESSION['identificacao']['nome_mae'])
            , mysql_real_escape_string($_SESSION['identificacao']['nome_pai']));

    $resultado = mysql_query($sql3);
    
    if (!$resultado) {
        mysql_query($release);
        return false;
    }
    mysql_query($release);

    return $id;
}

function inserirAlunoEJA($sessao) {

    include_once('connect.php');

    $nomeAluno = $sessao['identificacao']['nome_aluno'];

    $get = "select get_lock('pessoa', 10)";
    $release = "do release_lock('pessoa')";

    mysql_query($get);

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

    $id = mysql_fetch_row(mysql_query("select last_insert_id()"))[0];

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
            , mysql_real_escape_string($sessao['identificacao']['data_nascimento'])
            , mysql_real_escape_string("%d/%m/%Y"));

    $resultado = mysql_query($sql2);

    if (!$resultado) {
        mysql_query($release);
        return false;
    }

    $sql4 = sprintf("INSERT INTO `matricula`.`aluno`
                    (`Pessoa_Fisica_Pessoa_id_pessoa`)
                    VALUES
                    (%s)", mysql_real_escape_string($id));

    $resultado = mysql_query($sql4);

    $sql3 = sprintf('INSERT INTO `matricula`.`aluno_eja`
                    (`id_pessoa`)
                    VALUES
                    (%s)' , mysql_real_escape_string($id));

$resultado = mysql_query($sql3);

    mysql_query($release);

    return $id;
}

?>