<?php

function buscaDadosEscolaresEJA($id) {

    include_once('connect.php');

	$sql = sprintf("SELECT Fase_periodo_fase_id_ano_serie, b.id_nucleo, b.ds_serie_parou_estudar FROM matricula.vaga a, matricula.aluno_eja b
					where Aluno_Pessoa_Fisica_Pessoa_id_pessoa = %s
					and a.Aluno_Pessoa_Fisica_Pessoa_id_pessoa = b.id_pessoa", mysql_real_escape_string($id));

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