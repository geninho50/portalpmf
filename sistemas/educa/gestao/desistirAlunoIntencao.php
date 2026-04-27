<?php
session_name('ga');
session_start();

//EXPIRA A SESSAO SE NAO HOUVE ATIVIDADE NOS ULTIMOS 30 MINUTOS
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    session_unset(); 
    session_destroy();
    header("Location: index.php");
}
$_SESSION['LAST_ACTIVITY'] = time();

if (isset($_SESSION['aut_gm'])) {
    if ($_SESSION['aut_gm'] != true) {
        header('Location: index.php');
    }
} else {
    header('Location: index.php');
}

if (isset($_GET['id_aluno'])) {
    if (isset($_GET['motivo'])) {
        if (isset($_GET['escola'])) {
            if (isset($_GET['ano'])) {
                if (isset($_GET['fase'])) {
                    include 'fnc/removerAlunoIntencao.php';
                    $resultado = removerAlunoIntencao($_GET['id_aluno'], $_GET['escola'], 1, $_GET['fase'], $_GET['ano'], 1);
                    if ($resultado) {
                        $sql = sprintf("INSERT INTO `matricula`.`log_intencao`
                            (`Lista_Aluno_id_aluno`,
                                `Lista_Aluno_Lista_Fase_Periodo_Periodo_id_ano`,
                                `Lista_Aluno_Lista_Fase_Periodo_Periodo_id_periodo`,
                                `Lista_Aluno_Lista_Fase_Periodo_Fase_id_ano_serie`,
                                `Lista_Aluno_Lista_Fase_Periodo_Fase_Curso_id_curso`,
                                `Lista_Aluno_Lista_Fase_Periodo_Escola_id_pessoa`,
                                `dt_registro`,
                                `ds_observacao`,
                                `tp_registro`)
                        VALUES
                        (%s,
                            %s,
                            %s,
                            %s,
                            %s,
                            %s,
                            sysdate(),
                            '%s',
                            'E')"
                        , mysql_real_escape_string($_GET['id_aluno'])
                        , mysql_real_escape_string($_GET['ano'])
                        , mysql_real_escape_string(1)
                        , mysql_real_escape_string($_GET['fase'])
                        , mysql_real_escape_string(1)
                        , mysql_real_escape_string($_GET['escola'])
                        , mysql_real_escape_string($_GET['motivo']));
$resultado = mysql_query($sql);

$sql = sprintf("INSERT INTO `matricula`.`auditoria_intencao_fundamental_remover`
    (`id_aluno`,
        `id_motivo`,
        `dt_alteracao`,
        `id_usuario`,
        `id_escola`,
        `id_grupo`,
        `id_ano`)
VALUES
(%s,
    %s,
    sysdate(),
    %s,
    %s,
    %s,
    %s)"
, mysql_real_escape_string($_GET['id_aluno'])
, mysql_real_escape_string($_GET['motivo'])
, mysql_real_escape_string($_SESSION['usuario']['id'])
, mysql_real_escape_string($_GET['escola'])
, mysql_real_escape_string($_GET['fase'])              
, mysql_real_escape_string($_GET['ano']));
$resultado = mysql_query($sql);
header('Location: listaDeIntencao.php?sucesso=true&escola=' . $_GET['escola'] . '&ano=' . $_GET['ano'] . '&fase=' . $_GET['fase']);
} else {
    header('Location: listaDeIntencao.php?sucesso=false&escola=' . $_GET['escola'] . '&ano=' . $_GET['ano'] . '&fase=' . $_GET['fase']);
}
}
}
}
}
}
?>
