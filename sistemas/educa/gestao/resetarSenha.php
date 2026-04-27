<?php

session_name('ga');
session_start();

if(isset($_GET['idUsuario'])){

	include 'fnc/trocarSenha.php';
	$resultado = trocarSenha($_GET['idUsuario'], 'pmf');
	header('Location: listaDeUsuarios.php?alterado='.$_GET['idUsuario']);

} else {
	header('Location: listaDeUsuarios.php');
}

?>