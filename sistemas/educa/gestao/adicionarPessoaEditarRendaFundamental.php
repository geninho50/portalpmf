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
	$nome = $_POST['nome'];
	$sitOcupacional = $_POST['sitOcupacional'];
    $pessoa = array($nome, $sitOcupacional, str_replace(',', '.', $_POST['valor']), $_POST['dataNascimento'], $_POST['parentesco'], $_POST['comprovacao']);
    if (!isset($_SESSION['renda']['pessoasFund'])) {
        $_SESSION['renda']['pessoasFund'] = array();
    }
    array_push($_SESSION['renda']['pessoasFund'], $pessoa);
}

header('Location: editarRendaFundamental.php?idAluno='.$_GET['idAluno']);
?>