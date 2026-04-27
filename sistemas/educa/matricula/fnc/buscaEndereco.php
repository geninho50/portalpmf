<?php

function buscaEndereco($cep) {

    include_once('connect.php');

    $cep = str_replace("-", "", $cep);
    $cep = str_replace(".", "", $cep);

    $sql = sprintf("select null as id_logradouro, null as ds_logradouro_abreviado, null as id_logradouro, null as id_logradouro, t.id_localidade, t.ds_nome, q.id_estado, q.sg_estado from matricula.localidade t, matricula.estado q where t.cd_cep = %s and q.id_estado = t.Estado_id_estado union select t.id_logradouro, t.ds_logradouro_abreviado, q.id_bairro, q.ds_nome, r.id_localidade, r.ds_nome, e.id_estado, e.sg_estado from matricula.logradouro t, matricula.bairro q, matricula.localidade r, matricula.estado e where t.cd_cep = %s and t.Bairro_id_bairro_inicial = q.id_bairro and r.id_localidade = q.Localidade_id_localidade and r.Estado_id_estado = e.id_estado", mysql_real_escape_string($cep), mysql_real_escape_string($cep));

    $resultado = mysql_query($sql);

    $row = true;
    
    if ($resultado != FALSE) {
        while ($row != FALSE) {
            $row = mysql_fetch_row($resultado);
            if (count($row) > 1) {
                $endereco = $row;
            }
        }
    }

    if (!isset($endereco)) {
        return $endereco[0] = "CEP n&atilde;o encontrado!";
    } else {
        foreach ($endereco as $key => $value) {
            $temp[$key] = ($value);
        }
        $endereco = $temp;
    }

    return $endereco;
}

?>