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

if (isset($_POST['escolaE'])) {
    if (isset($_POST['nomeE'])) {
        if (isset($_POST['cpfE'])) {
            if (isset($_POST['perfilE'])) {
                $cpf = str_replace('-', '', $_POST['cpfE']);
                $cpf = str_replace('.', '', $cpf);
                include 'fnc/contaExecutores.php';
                $numero = contaExecutores($_POST['escolaE'], $_POST['perfilE']);
                include 'fnc/inserirUsuario.php';
                if ($numero < 2) {
                    $resultado = inserirUsuario($_POST['nomeE'], $_POST['perfilE'], $_POST['escolaE'], $cpf, 'pmf');
                    if($resultado == false){
                        header('Location: adicionarUsuario.php?sucesso=erro');
                    }
                    header('Location: adicionarUsuario.php?sucesso=true');
                } else {
                    header('Location: adicionarUsuario.php?sucesso=lim');
                }
            }
        }
    }
}
?>
