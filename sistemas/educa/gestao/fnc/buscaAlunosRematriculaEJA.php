<?php

function buscaAlunosRematriculaEJA() {

    include_once('connect.php');

    $sql = sprintf("SELECT b.ds_nome, b.dt_nascimento, a.id_nucleo, c.id_inscricao FROM matricula.aluno_eja a, matricula.pessoa_fisica b, matricula.aluno c
        where a.id_pessoa = b.Pessoa_id_pessoa
        and a.id_pessoa = c.Pessoa_Fisica_Pessoa_id_pessoa");

    $resultado = mysql_query($sql);

    $row = true;
    $i = 0;

    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        if ($row[0] != '') {
            $aluno[$i++] = $row;
        }
    }
    if(isset($aluno)){
        return $aluno;
    }
    
    return false;    
}

?>