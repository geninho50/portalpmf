<?php

session_name('re_eja');
session_start();
ini_set('max_execution_time', 300);

include_once 'fnc/inserirEndereco.php';
include_once 'fnc/inserirTransporte.php';
include_once 'fnc/inserirOutrosDadosEJA.php';
include_once 'fnc/inserirDadosPessoais.php';
include_once 'fnc/removeEndereco.php';
include_once 'fnc/removeTransporte.php';
include_once 'fnc/inserirDadosAlunoEJA.php';
include_once 'fnc/atualizarEstadoCivil.php';

$_SESSION['id_periodo'] = 1;
$_SESSION['periodo_ano'] = 2014;

removeEndereco($_SESSION['id'], 1);
inserirEndereco($_SESSION['localizacao'], $_SESSION['id'], 1);
removeTransporte($_SESSION['id']);
(inserirTransporte($_SESSION, $_SESSION['id']));
(inserirOutrosDadosEJA($_SESSION['outrosDados'], $_SESSION['id']));
inserirDadosPessoais($_SESSION['dados_pessoais'], $_SESSION['id']);
inserirDadosAlunoEJA($_SESSION, $_SESSION['id']);
atualizarEstadoCivil($_SESSION['dados_pessoais']['estado_civil'], $_SESSION['id']);

$sql = sprintf("DELETE FROM `matricula`.`vaga` where Aluno_Pessoa_Fisica_Pessoa_id_pessoa = %s", mysql_real_escape_string($_SESSION['id']));
$resultado = mysql_query($sql);

    $sql = sprintf("INSERT INTO `matricula`.`vaga`
                        (`Aluno_Pessoa_Fisica_Pessoa_id_pessoa`,
                        `Tipo_Vaga_id_tipo_vaga`,
                        `Fase_Periodo_Periodo_id_ano`,
                        `Fase_Periodo_Periodo_id_periodo`,
                        `Fase_Periodo_Fase_id_ano_serie`,
                        `Fase_Periodo_Fase_Curso_id_curso`,
                        `Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa`,
                        id_rematricula_realizada,
                        dt_rematricula_realizada)
                        VALUES
                        (%s,
                        2,
                        2014,
                        1,
                        %s,
                        3,
                        702099,
                        1,
                        sysdate())"
            , mysql_real_escape_string($_SESSION['id'])
            , mysql_real_escape_string($_SESSION['dados_escolares']['segmento']));
    //A CORRIGIR -> PERIODO E CURSO COMO PARAMETROS

    $resultado = mysql_query($sql);

header('Location: confirmacaoRematriculaEJA.php');
?>