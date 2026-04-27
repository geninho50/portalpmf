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

if (isset($_POST['matricula'])) {
    if (isset($_POST['escola'])) {
        if (isset($_POST['fase'])) {
            if (isset($_POST['ano'])) {
                ini_set('max_execution_time', 300);
                include 'fnc/buscaQtdMatricula.php';
                $qtdJaExisteMatricula = buscaQtdMatricula(1, $_POST['ano'], $_POST['fase'], $_POST['escola']);
                include 'fnc/buscaQtdReserva.php';
                $qtdJaExisteReserva = buscaQtdReserva(1, $_POST['ano'], $_POST['fase'], $_POST['escola']);
                $qtdJaExiste = $qtdJaExisteMatricula + $qtdJaExisteReserva;
                if ($qtdJaExiste < $_POST['matricula']) {
                    include 'fnc/criarNovaVaga.php';
                    $aInserir = $_POST['matricula'] - $qtdJaExiste;
                    for ($i = 0; $i < $aInserir; $i++) {
                        criarNovaVaga(1, $_POST['ano'], $_POST['fase'], $_POST['escola']);
                    }
                } else {
                    include 'fnc/removerVaga.php';
                    $aRemover = $qtdJaExiste - $_POST['matricula'];
                    for ($i = 0; $i < $aRemover; $i++) {
                        $resultado = removerVaga(1, $_POST['ano'], $_POST['fase'], $_POST['escola']);
                        if ($resultado == false) {
                            break;
                        }
                    }
                }
                header("Location: definirVagas.php?sucesso=true");
            }
        }
    }
}
?>