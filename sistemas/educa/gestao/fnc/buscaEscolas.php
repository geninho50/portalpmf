<?php

function buscaEscolas() {

    include_once('connect.php');

    $sql = sprintf("select * from matricula.escola a, matricula.tipo_escola b where a.Tipo_Escola_id_tipo_escola = b.id_tipo_escola order by a.ds_nome");

    $resultado = mysql_query($sql);

    $row = true;

    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $escolas[$row[0]] = $row;
        }
    }

    return $escolas;
}

function buscaEscolasFundamental() {

    include_once('connect.php');

    $sql = sprintf("SELECT * FROM matricula.escola a, matricula.lista b
where b.Fase_Periodo_Fase_Curso_id_curso = 1
and a.Pessoa_Juridica_Pessoa_id_pessoa = b.Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa
order by a.ds_nome");

    $resultado = mysql_query($sql);

    $row = true;

    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $escolas[$row[0]] = $row;
        }
    }

    return $escolas;
}

function buscaEscolasInfantil() {

    include_once('connect.php');

   $sql = sprintf("SELECT * FROM matricula.escola a
where a.Tipo_Escola_id_tipo_escola in(3,4,7) order by a.ds_nome");

    $resultado = mysql_query($sql);

    $row = true;

    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $escolas[$row[0]] = $row;
        }
    }

    return $escolas;
}

?>