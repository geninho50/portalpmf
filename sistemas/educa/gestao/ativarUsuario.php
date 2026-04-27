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
    include 'fnc/contaExecutores.php';
    include 'fnc/buscaUsuario.php';
    $usuario = buscaUsuario($_GET['idPessoa']);
    $escola = $usuario[4];
    $perfil = $usuario[3];
    $numero = contaExecutores($escola, $perfil);
    include 'fnc/ativarUsuario.php';
    if ($numero < 2) {
        $resultado = ativarUsuario($_GET['idPessoa']);
        if($resultado == false){
            header('Location: listaDeUsuarios.php?ativado=erro');
        }
        header('Location: listaDeUsuarios.php?ativado=true');
    } else {
        header('Location: listaDeUsuarios.php?ativado=lim');
    }
}
?>
