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

if (isset($_POST['nomeEscola'])) {
    if (isset($_POST['tipoEscola'])) {
        include 'fnc/criaNovaEscola.php';
        $id = criaNovaEscola($_POST['nomeEscola'], $_POST['tipoEscola']);
        if ($id != false) {
            header("Location: novaEscola.php?sucesso=true");
        } else {
            header("Location: novaEscola.php?sucesso=false");
        }
    }
}
?>