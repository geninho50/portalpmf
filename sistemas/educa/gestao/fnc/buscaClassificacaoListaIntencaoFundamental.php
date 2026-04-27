<?php 

function buscaClassificacaoListaIntencaoFundamental($tipo, $escola, $grupo){

    include_once('connect.php');

    if($tipo == 'FUNDAMENTAL - 2013'){
    	$sql = sprintf("select a.id_aluno, b.id_inscricao, qt_pontuacao as posicao, 
            d.ds_nome, 
            date_format(d.dt_nascimento, '%s') as dt_nasc,
            e.ds_nome,
            b.ds_distancia
            from matricula.lista_aluno a, matricula.aluno b, matricula.endereco c, matricula.pessoa_fisica d, matricula.bairro e, matricula.log_intencao f
            where a.id_aluno = b.Pessoa_Fisica_Pessoa_id_pessoa
            and a.id_aluno = c.Pessoa_id_pessoa
            and c.Bairro_id_bairro = e.id_bairro
            and a.id_aluno = d.Pessoa_id_pessoa
            and a.Lista_Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa = %s
            and a.Lista_Fase_Periodo_Fase_id_ano_serie = %s
            and a.id_aluno = f.Lista_Aluno_id_aluno
            order by dt_registro, qt_pontuacao"
            , mysql_real_escape_string('%d/%m/%Y')
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
    } else {
        if($tipo == 'BATISTA PEREIRA'){
            $sql = sprintf('(select a.id_aluno, b.id_inscricao, qt_pontuacao as posicao, 
                d.ds_nome, 
                date_format(d.dt_nascimento, "%s") as dt_nasc,
                e.ds_nome,
                b.ds_distancia,
                f.dt_registro
                from matricula.lista_aluno a, matricula.aluno b, matricula.endereco c, matricula.pessoa_fisica d, matricula.bairro e, matricula.log_intencao f
                where a.id_aluno = b.Pessoa_Fisica_Pessoa_id_pessoa
                and a.id_aluno = c.Pessoa_id_pessoa
                and c.Bairro_id_bairro = e.id_bairro
                and a.id_aluno = d.Pessoa_id_pessoa
                and a.Lista_Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa = 1422
                and a.Lista_Fase_Periodo_Fase_id_ano_serie = %s
                and a.id_aluno = f.Lista_Aluno_id_aluno
                and e.ds_nome = "Ribeirão da Ilha"
                order by dt_registro, qt_pontuacao)

union 

(select a.id_aluno, b.id_inscricao, qt_pontuacao as posicao, 
    d.ds_nome, 
    date_format(d.dt_nascimento, "%s") as dt_nasc,
    e.ds_nome,
    b.ds_distancia,
    f.dt_registro
    from matricula.lista_aluno a, matricula.aluno b, matricula.endereco c, matricula.pessoa_fisica d, matricula.bairro e, matricula.log_intencao f
    where a.id_aluno = b.Pessoa_Fisica_Pessoa_id_pessoa
    and a.id_aluno = c.Pessoa_id_pessoa
    and c.Bairro_id_bairro = e.id_bairro
    and a.id_aluno = d.Pessoa_id_pessoa
    and a.Lista_Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa = 1422
    and a.Lista_Fase_Periodo_Fase_id_ano_serie = %s
    and a.id_aluno = f.Lista_Aluno_id_aluno
    and e.ds_nome != "Ribeirão da Ilha"
    order by dt_registro, qt_pontuacao)'
, mysql_real_escape_string('%d/%m/%Y')
, mysql_real_escape_string($grupo)
, mysql_real_escape_string('%d/%m/%Y')
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

}

?>