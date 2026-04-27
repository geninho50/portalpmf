<?php

function buscaResponsaveisAluno($id_aluno) {

    include_once('connect.php');
    
    $sql = sprintf("SELECT r.ds_nome, q.Parentesco_id_parentesco, y.ds_valor, q.Responsavel_Pessoa_Fisica_Pessoa_id_pessoa FROM matricula.responsavel_aluno q, matricula.pessoa_fisica r, matricula.documento y
                    where q.Aluno_Pessoa_Fisica_Pessoa_id_pessoa = %s
                    and r.Pessoa_id_pessoa = q.Responsavel_Pessoa_Fisica_Pessoa_id_pessoa
                    and y.Pessoa_Fisica_Pessoa_id_pessoa = q.Responsavel_Pessoa_Fisica_Pessoa_id_pessoa
                    and y.Tipo_Documento_id_tipo_documento = 3", mysql_real_escape_string($id_aluno));

    $resultado = mysql_query($sql);

    $row = true;
    $i = 0;

    if($resultado != false)
    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $resp[$i++] = $row;
        }
    }
    
    if (isset($resp)) {
        return $resp;
    }
    return null;
}

?>