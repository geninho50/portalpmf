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

if(isset($_GET['idAluno'])){
	if(isset($_GET['ocorrencia'])){
		include 'fnc/inserirOcorrencia.php';
		$resultado = inserirOcorrencia($_GET['idAluno'], $_GET['ocorrencia'], $_SESSION['usuario']['id']);
		if($resultado == true){
			header("Location: ocorrencias.php?idAluno=".$_GET['idAluno']."&sucesso=true");
		}
	}
}

?>