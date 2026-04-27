<?php

session_name('ma');
session_start();
if (!isset($_SESSION['escola']['novaEscola']['vaga'])) {
    header('Location: dadosEscolares.php');
} else {
    
}

if (isset($_POST['novaEscola'])) {
    unset($_SESSION['escola']['novaEscola']['vaga']);
    $_SESSION['escola']['novaEscola']['id_escola'] = $_POST['novaEscola'];
    header("Location: verificaInscricao.php");
} else {
    header("Location: ".$_SERVER['HTTP_REFERER']);
}
?>