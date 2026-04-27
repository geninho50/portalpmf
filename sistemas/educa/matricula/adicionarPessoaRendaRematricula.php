<?php

session_name('re');
session_start();

if (count($_POST) > 0) {

    $pessoa = [$_POST['nome'], $_POST['sitOcupacional'], str_replace(',', '.', $_POST['valor']), $_POST['dataNascimento'], $_POST['parentesco'], $_POST['comprovacao']];

    if (!isset($_SESSION['renda']['pessoas'])) {
        $_SESSION['renda']['pessoas'] = array();
    }
    array_push($_SESSION['renda']['pessoas'], $pessoa);
}

header('Location: dadosRendaRematricula.php');
?>
