<?php

function buscaDadosPaisEJA($id) {

    include_once('connect.php');

	$sql = sprintf("SELECT ds_nome_mae, id_escolaridade_mae, ds_nome_pai, id_escolaridade_pai, ds_nome_res, id_escolaridade_res FROM matricula.aluno_eja
					where id_pessoa = %s", mysql_real_escape_string($id));

    $resultado = mysql_query($sql);

    $row = true;
    
    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $qtd = $row;
        }
    }

    if(isset($qtd)){
        return $qtd;
    }

    return 0;
}

?>