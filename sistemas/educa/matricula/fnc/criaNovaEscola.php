<?php

function criaNovaEscola($nomeEscola, $tipo) {

	include_once('connect.php');

	$sql = sprintf("insert into matricula.pessoa (criado_em) values (sysdate())");

	$get = "select get_lock('pessoa', 10)";
	$release = "do release_lock('pessoa')";

	mysql_query($get);

	$resultado = mysql_query($sql);

	if (!$resultado) {
		mysql_query($release);
		return false;
	}

	$id = mysql_fetch_row(mysql_query("select last_insert_id()"))[0];

        //cria pessoa fisica
	$sql2 = sprintf("INSERT INTO `matricula`.`pessoa_juridica`
		(`Pessoa_id_pessoa`)
	VALUES
	(%s)"
	, mysql_real_escape_string($id));

	$resultado = mysql_query($sql2);

	if (!$resultado) {
		mysql_query($release);
		return false;
	}

    $sql3 = sprintf("INSERT INTO `matricula`.`escola`
(`Pessoa_Juridica_Pessoa_id_pessoa`,
`ds_nome`, `Tipo_Escola_id_tipo_escola`)
VALUES
(%s, '%s', %s)", mysql_real_escape_string($id), mysql_real_escape_string(($nomeEscola)), mysql_real_escape_string($tipo));

    $resultado = mysql_query($sql3);
    
    if (!$resultado) {
        mysql_query($release);
        return false;
    }
    mysql_query($release);

    return $id;
}

?>