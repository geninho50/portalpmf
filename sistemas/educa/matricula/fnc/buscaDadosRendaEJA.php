<?php

function buscaDadosRendaEJA($id) {

    include_once('connect.php');

	$sql = sprintf("SELECT `aluno_eja`.`id_pessoa`,
                    `aluno_eja`.`ds_empresa_trabalho`,
                    `aluno_eja`.`ds_funcao`,
                    `aluno_eja`.`id_cart_assinada`,
                    `aluno_eja`.`id_ja_cart_assinada`,
                    `aluno_eja`.`id_ja_est_remunerado`,
                    `aluno_eja`.`id_procura_emprego`,
                    `aluno_eja`.`ds_pretensao_profissional`,
                    `aluno_eja`.`id_ja_trab_voluntario`,
                    `aluno_eja`.`ds_local_trab_voluntario`,
                    `aluno_eja`.`id_alguem_recebe_ajuda_gov`,
                    `aluno_eja`.`nr_filhos`,
                    `aluno_eja`.`nr_dependentes`,
                    `aluno_eja`.`nr_dependentes_trabalham`,
                    `aluno_eja`.`id_mora_com_familia`,
                    `aluno_eja`.`nr_hab_casa`,
                    `aluno_eja`.`id_hab_motora`,
                    `aluno_eja`.`ds_com_quem_deixara_filhos`,
                    `aluno_eja`.`qt_renda_propria`,
                    `aluno_eja`.`qt_renda_familiar`
                    FROM `matricula`.`aluno_eja`
                    where id_pessoa = %s", mysql_real_escape_string($id));

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