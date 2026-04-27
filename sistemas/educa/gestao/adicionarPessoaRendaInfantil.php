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

if (count($_POST) > 0) {

    $pessoa = array($_POST['nome'], $_POST['sitOcupacional'], str_replace(',', '.', $_POST['valor']), $_POST['dataNascimento'], $_POST['parentesco'], $_POST['comprovacao']);

    if (!isset($_SESSION['novo_aluno_infantil']['renda']['pessoas'])) {
        $_SESSION['novo_aluno_infantil']['renda']['pessoas'] = array();
    }
    array_push($_SESSION['novo_aluno_infantil']['renda']['pessoas'], $pessoa);

}

header('Location: dadosRendaInfantil.php');
?>
