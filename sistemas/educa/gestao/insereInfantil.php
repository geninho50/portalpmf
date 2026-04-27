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

unset($_SESSION['novo_aluno_infantil']['inserido']);

if (!isset($_SESSION['novo_aluno_infantil']['inserido'])) {
    if (isset($_SESSION['novo_aluno_infantil']['renda']['inserido'])) {
        include 'fnc/inserirAluno.php';
        $id = inserirAluno($_SESSION);
        $_SESSION['novo_aluno_infantil']['dados_pessoais']['id'] = $id;
        include 'fnc/inserirEndereco.php';
        inserirEndereco($_SESSION['novo_aluno_infantil']['localizacao'], $id, 1);
        include 'fnc/inserirDadosPessoais.php';
        inserirDadosPessoais($_SESSION['novo_aluno_infantil']['dados_pessoais'], $id);

        include 'fnc/registrarIntencao.php';
        if (isset($_SESSION['novo_aluno_infantil']['escola']['primeira_opcao'])) {
            (registrarIntencao($id, $_SESSION['novo_aluno_infantil']['escola']['primeira_opcao'], 2, $_SESSION['novo_aluno_infantil']['escola']['grupo'], 2014, 1, 'null', 1, $_SESSION['usuario']['escola']));
        }
        if (isset($_SESSION['novo_aluno_infantil']['escola']['segunda_opcao'])) {
            (registrarIntencao($id, $_SESSION['novo_aluno_infantil']['escola']['segunda_opcao'], 2, $_SESSION['novo_aluno_infantil']['escola']['grupo'], 2014, 1, 'null', 2, $_SESSION['usuario']['escola']));
        }
        $_SESSION['novo_aluno_infantil']['inserido'] = true;

        include 'fnc/inserirOutrosDados.php';
        (inserirOutrosDados($_SESSION['novo_aluno_infantil']['outrosDados'], $id));

        include 'fnc/inserirDadosSaude.php';
        (inserirDadosSaude($_SESSION['novo_aluno_infantil']['saude'], $id));

        include 'fnc/inserirResponsavelInfantil.php';
        if (isset($_SESSION['novo_aluno_infantil']['mae'])) {
            inserirResponsavelInfantil($_SESSION['novo_aluno_infantil']['mae'], null, 'mae', $id);
        }        
        if (isset($_SESSION['novo_aluno_infantil']['pai'])) {
            inserirResponsavelInfantil($_SESSION['novo_aluno_infantil']['pai'], null, 'pai', $id);
        }        
        if (isset($_SESSION['novo_aluno_infantil']['responsavel'])) {
            inserirResponsavelInfantil($_SESSION['novo_aluno_infantil']['responsavel'], null, 'responsavel', $id);
        }

        include 'fnc/inserirRenda.php';
        (inserirRenda($_SESSION['novo_aluno_infantil']['renda']['pessoas'], $id));
        inserirOutraRenda($_SESSION['novo_aluno_infantil']['renda']['pensao'], $id, 2);
        inserirOutraRenda($_SESSION['novo_aluno_infantil']['renda']['bolsa'], $id, 3);

       header("Location: confirmacaoInfantil.php");
    }
}
?> 
