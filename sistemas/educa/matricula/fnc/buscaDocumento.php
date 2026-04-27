<?php

function buscaDocumento($id, $tipo) {

    include_once('connect.php');

    $sql = sprintf("SELECT * FROM matricula.documento
                    where Pessoa_Fisica_Pessoa_id_pessoa = %s
                    and Tipo_Documento_id_tipo_documento = %s
                    limit 1", mysql_real_escape_string($id), mysql_real_escape_string($tipo));

    $resultado = mysql_query($sql);

    $row = true;

    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $doc = $row;
        }
    }

    if(isset($doc)){
        return $doc;
    } else {
        return false;
    }
}

?>