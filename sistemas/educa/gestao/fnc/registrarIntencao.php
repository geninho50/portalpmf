<?php

function registrarIntencao($aluno, $escola, $curso, $ano_serie, $ano, $periodo, $motivo, $opcao, $ueDocumentacao) {

    include_once('connect.php');

    include_once 'calculaPontuacao.php';
    $pontuacao = calculaPontuacao($aluno, $escola, $curso, $ano_serie, $ano, $periodo, 1);

    if(!isset($ueDocumentacao)){
        $ueDocumentacao = 'null';
    } else {
        if($ueDocumentacao == ''){
            $ueDocumentacao = 'null';
        }
    }

    $sql = sprintf("INSERT INTO `matricula`.`lista_aluno`
        (`qt_pontuacao`,
            `Motivo_Escolha_Escola_id_motivo`,
            `Situacao_Lista_id_situacao_lista`,
            `id_aluno`,
            `Lista_Fase_Periodo_Periodo_id_ano`,
            `Lista_Fase_Periodo_Periodo_id_periodo`,
            `Lista_Fase_Periodo_Fase_id_ano_serie`,
            `Lista_Fase_Periodo_Fase_Curso_id_curso`,
            `Lista_Fase_Periodo_Escola_Pessoa_Juridica_Pessoa_id_pessoa`,
            id_escolha,
            id_local_documentacao)
    VALUES
    (%s,
        %s,
        %s,
        %s,
        %s,
        %s,
        %s,
        %s,
        %s,
        %s,
        %s)"
    , mysql_real_escape_string($pontuacao)
    , mysql_real_escape_string($motivo)
    , mysql_real_escape_string(1)
    , mysql_real_escape_string($aluno)
    , mysql_real_escape_string($ano)
    , mysql_real_escape_string($periodo)
    , mysql_real_escape_string($ano_serie)
    , mysql_real_escape_string($curso)
    , mysql_real_escape_string($escola)
    , mysql_real_escape_string($opcao)
    , mysql_real_escape_string($ueDocumentacao));

$resultado = mysql_query($sql);

print_r($sql);
var_dump(mysql_error());

$sql = sprintf("INSERT INTO `matricula`.`log_intencao`
    (`Lista_Aluno_id_aluno`,
        `Lista_Aluno_Lista_Fase_Periodo_Periodo_id_ano`,
        `Lista_Aluno_Lista_Fase_Periodo_Periodo_id_periodo`,
        `Lista_Aluno_Lista_Fase_Periodo_Fase_id_ano_serie`,
        `Lista_Aluno_Lista_Fase_Periodo_Fase_Curso_id_curso`,
        `Lista_Aluno_Lista_Fase_Periodo_Escola_id_pessoa`,
        `dt_registro`,
        `ds_observacao`)
VALUES
(%s,
    %s,
    %s,
    %s,
    %s,
    %s,
    sysdate(),
    'Intenção Realizada - %s')"
, mysql_real_escape_string($aluno)
, mysql_real_escape_string($ano)
, mysql_real_escape_string($periodo)
, mysql_real_escape_string($ano_serie)
, mysql_real_escape_string($curso)
, mysql_real_escape_string($escola)
, mysql_real_escape_string($opcao));
$resultado = mysql_query($sql);

return $resultado;
}

?>