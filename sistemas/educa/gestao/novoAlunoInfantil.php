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

unset($_SESSION['novo_aluno_infantil']);


if($_SESSION['usuario']['permissoes'][3][1] != 1){
	header('Location: index.php');
}

header("Location: dadosPessoaisInfantil.php");
?>
