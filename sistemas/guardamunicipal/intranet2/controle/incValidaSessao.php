<?php
if (!isset($_SESSION))
{
	//SESSION_START();
	session_start('nomeSESSION');
	session_start('idSESSION');
}

if( isset ($_SESSION["nomeSESSION"])?$_SESSION["nomeSESSION"]:"" )
{
	// logado
}
else
{
	// deslogado, redirecionar para página Expirou.php
	header ("Location:paginaExpirou.php");
}
?>