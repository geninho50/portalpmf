<?php 

function buscaClassificacaoListaIntencaoInfantil($tipo, $escola, $grupo){

    include_once('connect.php');

    if($tipo == 'INFANTIL - 2013'){
    	$sql = sprintf("select j.id_aluno, id_inscricao, ds_nome, id_bolsa_familia, mora, ifnull(per_capita, 0) as per_capita from
                        (select a.id_aluno, b.id_inscricao, c.ds_nome, b.id_bolsa_familia, if(b.Tempo_Residencia_id_tempo_residencia = 5, 1, 0) as mora
                        from matricula.lista_aluno a, 
                        matricula.aluno b,
                        matricula.pessoa_fisica c
                        where Lista_Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa = %s
                        and Lista_Fase_Periodo_Fase_id_ano_serie = %s
                        and a.id_aluno = b.Pessoa_Fisica_Pessoa_id_pessoa
                        and c.Pessoa_id_pessoa = a.id_aluno
                        order by b.id_bolsa_familia desc, mora desc) j left join 
                        (select q.id_pessoa as id_aluno, num_hab, renda, truncate(renda/num_hab, 4) as per_capita from
                            (select count(*)+1 as num_hab, Aluno_Pessoa_Fisica_Pessoa_id_pessoa as id_pessoa from matricula.renda
                            where Tipo_Renda_id_tipo_renda = 1
                            group by Aluno_Pessoa_Fisica_Pessoa_id_pessoa) q,
                            (select sum(qt_renda) as renda, Aluno_Pessoa_Fisica_Pessoa_id_pessoa as id_pessoa from matricula.renda
                            group by Aluno_Pessoa_Fisica_Pessoa_id_pessoa) r
                            where q.id_pessoa = r.id_pessoa)  z
                        on z.id_aluno = j.id_aluno
                        order by id_bolsa_familia desc, mora desc, per_capita asc"
    		, mysql_real_escape_string($escola)
    		, mysql_real_escape_string($grupo));
        
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

}

?>