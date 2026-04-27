<?php

function inserirUsuario($nome, $perfil, $escola, $usuario, $senha) {

    include_once('connect.php');
    
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
	$id_todos = mysql_fetch_row(mysql_query("select last_insert_id()"));
    $id = $id_todos[0];

//cria pessoa fisica
    $sql2 = sprintf("INSERT INTO `matricula`.`pessoa_fisica`
                    (`Pessoa_id_pessoa`,
                    `ds_nome`)
                    VALUES
                    (%s,
                    '%s')"
            , mysql_real_escape_string($id)
            , mysql_real_escape_string(strtoupper($nome)));

    $resultado = mysql_query($sql2);

    if (!$resultado) {
        mysql_query($release);
        return false;
    }

//cria aluno
    $sql3 = sprintf("INSERT INTO `matricula`.`login`
                    (`Pessoa_Fisica_Pessoa_id_pessoa`,
                    `ds_usuario`,
                    `ds_senha`,
                    `Perfil_id_perfil`,
                    `id_escola`)
                    VALUES
                    (%s,
                    '%s',
                    '%s',
                    %s,
                    %s);"
            , mysql_real_escape_string($id)
            , mysql_real_escape_string($usuario)
            , mysql_real_escape_string($senha)
            , mysql_real_escape_string($perfil)
            , mysql_real_escape_string($escola));

    $resultado = mysql_query($sql3);
    var_dump($resultado);
    if (!$resultado) {
        $sql = sprintf("DELETE FROM `matricula`.`pessoa_fisica` WHERE `Pessoa_id_pessoa = %s", mysql_real_escape_string($id));
        mysql_query($sql);
        $sql = sprintf("DELETE FROM `matricula`.`pessoa` WHERE `id_pessoa = %s", mysql_real_escape_string($id));
        mysql_query($sql);
        mysql_query($release);
        return false;
    }
    mysql_query($release);

    return $id;
}
?>