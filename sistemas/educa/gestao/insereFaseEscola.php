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
if (isset($_POST['curso'])) {
    if (isset($_POST['ano'])) {
        if (isset($_POST['fase'])) {
            if (isset($_POST['id'])) {

                $curso = $_POST['curso'];
                $ano = $_POST['ano'];
                $fase = $_POST['fase'];
                $escola = $_POST['id'];

                include 'fnc/inserirFase.php';
                $resultado = inserirFase($curso, $ano, 1, $fase, $escola);

                if ($resultado) {
                    include 'fnc/inserirLista.php';
                    inserirLista($curso, $ano, 1, $fase, $escola, 1);
                    header("Location: adicionarFaseEscola.php?idEscola=" . $_POST['id'] . "&sucesso=true");
                } else {
                    header("Location: adicionarFaseEscola.php?idEscola=" . $_POST['id'] . "&sucesso=false");
                }
            }
        }
    }
}
?>