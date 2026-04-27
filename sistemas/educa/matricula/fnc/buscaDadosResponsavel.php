<?php

function buscaDadosResponsavel($id) {

    include_once('connect.php');

    $sql = sprintf("SELECT q.*, t.ds_valor as cpf, y.Estado_id_estado FROM matricula.pessoa_fisica q, matricula.responsavel_aluno r, matricula.documento t, matricula.localidade y
                    where r.Aluno_Pessoa_Fisica_Pessoa_id_pessoa = %s
                    and r.Responsavel_Pessoa_Fisica_Pessoa_id_pessoa = q.Pessoa_id_pessoa
                    and r.Parentesco_id_parentesco = 3
                    and t.Tipo_Documento_id_tipo_documento = 3
                    and t.Pessoa_Fisica_Pessoa_id_pessoa = r.Responsavel_Pessoa_Fisica_Pessoa_id_pessoa
                    and y.id_localidade = q.id_naturalidade", mysql_real_escape_string($id));

    $resultado = mysql_query($sql);

    $row = true;

    $row = mysql_fetch_row($resultado);
    if ($row[0] != '') {
        $mae = $row;
    }

    if (isset($mae)) {
        return $mae;
    } else {
        return false;
    }
}

?>