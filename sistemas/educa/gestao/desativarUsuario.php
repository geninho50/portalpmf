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

if (isset($_GET['idPessoa'])) {
    include 'fnc/desativarUsuario.php';
    $resultado = desativarUsuario($_GET['idPessoa']);
    if($resultado == false){
        header('Location: listaDeUsuarios.php?desativado=erro');
    } else {
        header('Location: listaDeUsuarios.php?desativado=true');
    }
}

?>
