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

if (isset($_POST['id_aluno'])) {
    if (isset($_POST['escola'])) {
        if (isset($_POST['ano'])) {
            if (isset($_POST['fase'])) {
                if (isset($_POST['opcao'])) {
                    include_once 'fnc/verificaVaga.php';
                    $vagas = verificaVaga($_POST['escola'], 2, $_POST['fase'], $_POST['ano'], 1);
                    if($vagas == 0){
                        include_once 'fnc/criarNovaVaga.php';
                        criarNovaVaga(2, $_POST['ano'], $_POST['fase'], $_POST['escola']);
                    }
                    if($_POST['opcao'] == 1){
                        $sql = "delete from matricula.vaga where Aluno_Pessoa_Fisica_Pessoa_id_pessoa = ".$_POST['id_aluno'];
                        $resultado = mysql_query($sql);
                        var_dump(mysql_error());
                        include 'fnc/alocarAlunoVaga.php';
                        $resultado = alocarAlunoVaga($_POST['id_aluno'], $_POST['escola'], 2, $_POST['fase'], $_POST['ano'], 1);
                        if ($resultado == true) {
                            include 'fnc/removerAlunoIntencao.php';
                            $resultado = removerAlunoIntencaoTodas($_POST['id_aluno']);
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
                                    'A')"
, mysql_real_escape_string($_POST['id_aluno'])
, mysql_real_escape_string($_POST['ano'])
, mysql_real_escape_string(1)
, mysql_real_escape_string($_POST['fase'])
, mysql_real_escape_string(2)
, mysql_real_escape_string($_POST['escola'])
, mysql_real_escape_string('Atendido em primeira opção.'));
$resultado = mysql_query($sql);
$sql = sprintf("INSERT INTO `matricula`.`auditoria_intencao_infantil_atender`
    (`id_aluno`,
        `dt_alteracao`,
        `id_usuario`,
        `id_escola`,
        `id_grupo`,
        `id_ano`,
        `id_opcao`)
VALUES
(%s,
    sysdate(),
    %s,
    %s,
    %s,
    %s,
    %s)"
, mysql_real_escape_string($_POST['id_aluno'])
, $_SESSION['usuario']['id']
, mysql_real_escape_string($_POST['escola'])
, mysql_real_escape_string($_POST['fase'])
, mysql_real_escape_string($_POST['ano'])
, mysql_real_escape_string($_POST['opcao']));
$resultado = mysql_query($sql);
header('Location: listaDeIntencaoInfantil.php?sucessoA=true&escola=' . $_POST['escola'] . '&ano=' . $_POST['ano'] . '&fase=' . $_POST['fase']);
}
} else {
    header('Location: listaDeIntencaoInfantil.php?sucessoA=false&escola=' . $_POST['escola'] . '&ano=' . $_POST['ano'] . '&fase=' . $_POST['fase']);
}

} else {
    include_once 'fnc/buscaVagasAluno.php';
    $result = buscaVagasAluno($_POST['id_aluno']);
    if($result == false){
        include 'fnc/alocarAlunoVaga.php';
        $resultado = alocarAlunoVaga($_POST['id_aluno'], $_POST['escola'], 2, $_POST['fase'], $_POST['ano'], 1);
        if ($resultado == true) {
            include 'fnc/removerAlunoIntencao.php';
            $resultado = removerAlunoIntencao($_POST['id_aluno'], $_POST['escola'], 2, $_POST['fase'], $_POST['ano'], 1);
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
                    'A')"
                , mysql_real_escape_string($_POST['id_aluno'])
                , mysql_real_escape_string($_POST['ano'])
                , mysql_real_escape_string(1)
                , mysql_real_escape_string($_POST['fase'])
                , mysql_real_escape_string(2)
                , mysql_real_escape_string($_POST['escola'])
                , mysql_real_escape_string('Atendido em segunda opção.'));
$resultado = mysql_query($sql);
$sql = sprintf("INSERT INTO `matricula`.`auditoria_intencao_infantil_atender`
    (`id_aluno`,
        `dt_alteracao`,
        `id_usuario`,
        `id_escola`,
        `id_grupo`,
        `id_ano`,
        `id_opcao`)
VALUES
(%s,
    sysdate(),
    %s,
    %s,
    %s,
    %s,
    %s)"
, mysql_real_escape_string($_POST['id_aluno'])
, $_SESSION['usuario']['id']
, mysql_real_escape_string($_POST['escola'])
, mysql_real_escape_string($_POST['fase'])
, mysql_real_escape_string($_POST['ano'])
, mysql_real_escape_string($_POST['opcao']));
$resultado = mysql_query($sql);
header('Location: listaDeIntencaoInfantil.php?sucessoA=true&escola=' . $_POST['escola'] . '&ano=' . $_POST['ano'] . '&fase=' . $_POST['fase']);
}
} else {
    header('Location: listaDeIntencaoInfantil.php?sucessoA=false&escola=' . $_POST['escola'] . '&ano=' . $_POST['ano'] . '&fase=' . $_POST['fase']);
}
} else {
    header('Location: listaDeIntencaoInfantil.php?sucessoA=false&escola=' . $_POST['escola'] . '&ano=' . $_POST['ano'] . '&fase=' . $_POST['fase']);
}

}
}
}
}
}
}
?>
