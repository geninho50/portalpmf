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

if (isset($_POST['escola'])) {
    if (isset($_POST['nomeDiretor'])) {
        if (isset($_POST['cpf'])) {
            if (isset($_POST['perfil'])) {
                $cpf = str_replace('-', '', $_POST['cpf']);
                $cpf = str_replace('.', '', $cpf);
                include 'fnc/removeDiretorExistente.php';
                removeDiretorExistente($_POST['escola'], $_POST['perfil']);
                include 'fnc/inserirUsuario.php';
                $resultado = inserirUsuario($_POST['nomeDiretor'], $_POST['perfil'], $_POST['escola'], $cpf, 'pmf');
                
                if ($resultado == false) {
                    header('Location: adicionarUsuario.php?sucesso=erro');
                }
                header('Location: adicionarUsuario.php?sucesso=true');
            }
        }
    }
}
?>
