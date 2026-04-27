<?php

function buscaAlunosExcluidosFund() {

  include_once('connect.php');


    $sql = ("select d.id_inscricao, 
if(a.id_ano_serie = 1, 'Primeiro Ano', if(a.id_ano_serie = 2, 'Segundo Ano', if(a.id_ano_serie= 3, 'Terceiro Ano', if(a.id_ano_serie= 4, 'Quarto Ano',  if(a.id_ano_serie= 5, 'Quinto Ano',  if(a.id_ano_serie= 6, 'Sexto Ano',  if(a.id_ano_serie= 7, 'Sétimo Ano',  if(a.id_ano_serie= 8, 'Oitavo Ano',  'Nono Ano')))))))) as Ano, 
e.ds_nome as nome_escola, 
if(a.id_motivo = 1, 'Aluno não compareceu na unidade até a data limite.', if(a.id_motivo = 2, 'Após 3 tentativas não foi possível contatar o aluno ou a família.', if(a.id_motivo = 3, 'Erro no cadastro.', 'Outros.'))) as motivo,
date_format(a.dt_alteracao, '%d/%m/%Y %H:%i'), 
b.ds_nome as nome_aluno, 
DATE_FORMAT(b.dt_nascimento, '%d/%m/%Y') as data_nascimento,
c.ds_nome as nome_atlerou
from matricula.auditoria_vaga_fund_remover a, matricula.pessoa_fisica b, matricula.pessoa_fisica c, matricula.aluno d, matricula.escola e
where a.id_aluno = b.Pessoa_id_pessoa
and a.id_aluno = d.Pessoa_Fisica_Pessoa_id_pessoa
and a.id_escola = e.Pessoa_Juridica_Pessoa_id_pessoa
and a.id_pessoa_alterou = c.Pessoa_id_pessoa
and id_curso = 1
and id_periodo = 1");
    
    $resultado = mysql_query($sql);

    $row = true;

    $i = 0;
    while ($row != FALSE) {
        $row = mysql_fetch_row($resultado);
        $i++;
        if ($row[0] != '') {
            $matriculados[$i] = $row;
        }
    }

    if (!isset($matriculados)) {
        return FALSE;
    } else {
        return $matriculados;
    }
}


?>