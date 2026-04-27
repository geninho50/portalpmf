<?php
	SESSION_START();
	//DESTRÓI AS SESSOES
	unset($_SESSION["id"]);
	unset($_SESSION["nomeSESSION"]);
	session_destroy();
	// Redirecione a pag de login do site
	header ("Location:../controle/index.php");
?>