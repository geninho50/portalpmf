<?php 

function buscaAtendidosListaIntencaoInfantil($tipo, $escola, $grupo){

    include_once('connect.php');

    if($tipo == 'INFANTIL - 2013'){
    	$sql = sprintf("select b.id_inscricao, c.ds_nome, DATE_FORMAT(c.dt_nascimento, '%s') from matricula.vaga a, matricula.aluno b, matricula.pessoa_fisica c
            where a.Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa = %s
            and a.Fase_Periodo_Fase_id_ano_serie = %s
            and a.Aluno_Pessoa_Fisica_Pessoa_id_pessoa = b.Pessoa_Fisica_Pessoa_id_pessoa
            and c.Pessoa_id_pessoa = b.Pessoa_Fisica_Pessoa_id_pessoa"
            , mysql_real_escape_string('%m/%d/%Y')
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