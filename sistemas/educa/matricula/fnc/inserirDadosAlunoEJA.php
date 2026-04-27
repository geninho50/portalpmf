<?php

function inserirDadosAlunoEJA($sessao, $id_pessoa) {

    include_once('connect.php');

var_dump($sessao['renda']);
    if(isset($sessao['renda']['empresa'])){
        $empresa = $sessao['renda']['empresa'];
    } else {
        $empresa = '';
    }

    if(isset($sessao['renda']['funcao'])){
        $funcao = $sessao['renda']['funcao'];
    } else {
        $funcao = '';
    }

    if ($sessao['renda']['carteira'] == 'sim') {
        $carteira = 1;
    } else {
        if ($sessao['renda']['carteira'] == 'nao') {
            $carteira = 0;
        } else {
            $carteira = 2;
        }
    }

    if ($sessao['renda']['jaCarteira'] == 'sim') {
        $jaCarteira = 1;
    } else {
        if ($sessao['renda']['jaCarteira'] == 'nao') {
            $jaCarteira = 0;
        } else {
            $jaCarteira = 2;
        }
    }

    if ($sessao['renda']['estagio'] == 'sim') {
        $estagio = 1;
    } else {
        if ($sessao['renda']['estagio'] == 'nao') {
            $estagio = 0;
        } else {
            $estagio = 2;
        }
    }

    if ($sessao['renda']['procuraEmprego'] == 'sim') {
        $procuraEmprego = 1;
    } else {
        if ($sessao['renda']['procuraEmprego'] == 'nao') {
            $procuraEmprego = 0;
        } else {
            $procuraEmprego = 2;
        }
    }

    if(isset($sessao['renda']['pretensao'])){
        $pretensao = $sessao['renda']['pretensao'];
    } else {
        $pretensao = '';
    }

    if ($sessao['renda']['voluntario'] == 'sim') {
        $voluntario = 1;
    } else {
        if ($sessao['renda']['voluntario'] == 'nao') {
            $voluntario = 0;
        } else {
            $voluntario = 2;
        }
    }

    if(isset($sessao['renda']['localVoluntario'])){
        $localVoluntario = $sessao['renda']['localVoluntario'];
    } else {
        $localVoluntario = '';
    }

    if ($sessao['renda']['recebeAjuda'] == 'sim') {
        $recebeAjuda = 1;
    } else {
        if ($sessao['renda']['recebeAjuda'] == 'nao') {
            $recebeAjuda = 0;
        } else {
            $recebeAjuda = 2;
        }
    }

    if(isset($sessao['pais']['nomeMae'])){
        $nomeMae = $sessao['pais']['nomeMae'];
        if($nomeMae != ''){
            $escolaridadeMae = $sessao['pais']['escolaridadeMae'];
        } else {
            $escolaridadeMae = 'null';
        }
    } else {
        $nomeMae = '';
        $escolaridadeMae = 'null';
    }

    if(isset($sessao['pais']['nomeResp'])){
        $nomeResp = $sessao['pais']['nomeResp'];
        if($nomeResp != ''){            
            $escolaridadeResp = $sessao['pais']['escolaridadeResp'];
        } else {
            $escolaridadeResp = 'null';
        }
    } else {
        $nomeResp = '';
        $escolaridadeResp = 'null';
    }

    if(isset($sessao['pais']['nomePai'])){
        $nomePai = $sessao['pais']['nomePai'];
        if($nomePai != ''){
            $escolaridadePai = $sessao['pais']['escolaridadePai'];
        } else {
            $escolaridadePai = 'null';
        }
    } else {
        $nomePai = '';
        $escolaridadePai = 'null';
    }

    $nr_filhos = $sessao['renda']['numeroFilhos'];
    $nr_dependentes = $sessao['renda']['numeroDependentes'];
    $nr_dependentes_trabalham = $sessao['renda']['numeroDependentesTrabalham'];

    if ($sessao['renda']['moraFamilia'] == 'sim') {
        $moraFamilia = 1;
    } else {
        if ($sessao['renda']['moraFamilia'] == 'nao') {
            $moraFamilia = 0;
        } else {
            $moraFamilia = 2;
        }
    }

    $nr_hab_casa = $sessao['renda']['numeroHabitantes'];
    $id_hab_motora = $sessao['renda']['habmot'];


    if(isset($sessao['renda']['comQuemDeixara'])){
        $comQuemDeixara = $sessao['renda']['comQuemDeixara'];
    } else {
        $comQuemDeixara = '';
    }

    $rendaPropria = $sessao['renda']['rendaPropria'];
    $rendaFamiliar = $sessao['renda']['rendaFamiliar'];

    $serieParou = $sessao['dados_escolares']['serie_parou'];
    $nucleo = $sessao['dados_escolares']['nucleo'];

    $sql = sprintf("UPDATE `matricula`.`aluno_eja`
        SET
        `ds_empresa_trabalho` = '%s',
        `ds_funcao` = '%s',
        `id_cart_assinada` = %s,
        `id_ja_cart_assinada` = %s,
        `id_ja_est_remunerado` = %s,
        `id_procura_emprego` = %s,
        `ds_pretensao_profissional` = '%s',
        `id_ja_trab_voluntario` = %s,
        `ds_local_trab_voluntario` = '%s',
        `id_alguem_recebe_ajuda_gov` = %s,
        `ds_nome_mae` = '%s',
        `id_escolaridade_mae` = %s,
        `ds_nome_pai` = '%s',
        `id_escolaridade_pai` = %s,
        `ds_nome_res` = '%s',
        `id_escolaridade_res` = %s,
        `nr_filhos` = %s,
        `nr_dependentes` = %s,
        `nr_dependentes_trabalham` = %s,
        `id_mora_com_familia` = %s,
        `nr_hab_casa` = %s,
        `id_hab_motora` = %s,
        `ds_com_quem_deixara_filhos` = '%s',
        `qt_renda_propria` = %s,
        `qt_renda_familiar` = %s,
        `ds_serie_parou_estudar` = '%s',
        `id_nucleo` = %s
        WHERE `id_pessoa` = %s;"
        , mysql_real_escape_string($empresa)
        , mysql_real_escape_string($funcao)
        , mysql_real_escape_string($carteira)
        , mysql_real_escape_string($jaCarteira)
        , mysql_real_escape_string($estagio)
        , mysql_real_escape_string($procuraEmprego)
        , mysql_real_escape_string($pretensao)
        , mysql_real_escape_string($voluntario)
        , mysql_real_escape_string($localVoluntario)
        , mysql_real_escape_string($recebeAjuda)
        , mysql_real_escape_string($nomeMae)
        , mysql_real_escape_string($escolaridadeMae)
        , mysql_real_escape_string($nomePai)
        , mysql_real_escape_string($escolaridadePai)
        , mysql_real_escape_string($nomeResp)
        , mysql_real_escape_string($escolaridadeResp)
        , mysql_real_escape_string($nr_filhos)
        , mysql_real_escape_string($nr_dependentes)
        , mysql_real_escape_string($nr_dependentes_trabalham)
        , mysql_real_escape_string($moraFamilia)
        , mysql_real_escape_string($nr_hab_casa)
        , mysql_real_escape_string($id_hab_motora)
        , mysql_real_escape_string($comQuemDeixara)
        , mysql_real_escape_string($rendaPropria)
        , mysql_real_escape_string($rendaFamiliar)
        , mysql_real_escape_string($serieParou)
        , mysql_real_escape_string($nucleo)
        , mysql_real_escape_string($id_pessoa));

$resultado = mysql_query($sql);

return $resultado;
}

?>