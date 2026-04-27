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

if (isset($_GET['id'])) {
    include 'fnc/efetivarMatricula.php';
    $resultado = efetivarMatricula($_GET['id']);
    if ($resultado != false) {
        header('Location: '.$_SERVER['HTTP_REFERER'].'&efetivacao=true');
    }
    header('Location: '.$_SERVER['HTTP_REFERER'].'&efetivacao=false');
}
?>