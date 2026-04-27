<?php

function buscaDadosMae($id) {

    include_once('connect.php');

    $sql = sprintf("SELECT q.*, t.ds_valor as cpf FROM matricula.pessoa_fisica q, matricula.responsavel_aluno r, matricula.documento t
                    where r.Aluno_Pessoa_Fisica_Pessoa_id_pessoa = %s
                    and r.Responsavel_Pessoa_Fisica_Pessoa_id_pessoa = q.Pessoa_id_pessoa
                    and r.Parentesco_id_parentesco = 1
                    and t.Tipo_Documento_id_tipo_documento = 3
                    and t.Pessoa_Fisica_Pessoa_id_pessoa = r.Responsavel_Pessoa_Fisica_Pessoa_id_pessoa", mysql_real_escape_string($id));

    $resultado = mysql_query($sql);

    $row = true;

    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $mae = $row;
        }
    }

    if (isset($mae)) {
        return $mae;
    } else {
        return false;
    }
}

?>