<?php

function buscaEscolasComLista() {

    include_once('connect.php');

    $sql = sprintf("select a.Pessoa_Juridica_Pessoa_id_pessoa, a.ds_nome from matricula.escola a, matricula.tipo_escola b, matricula.lista c
                    where a.Tipo_Escola_id_tipo_escola = b.id_tipo_escola
                    and c.Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa = a.Pessoa_Juridica_Pessoa_id_pessoa
                    group by a.Pessoa_Juridica_Pessoa_id_pessoa, a.ds_nome
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

?>