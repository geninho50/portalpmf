<?php
class trataCookies
{ 
	function setCookies($nome,$string_valor,$tempo)
	{
		// setcookie("".$nome,$string_valor,time()+3600); #Este cookie expira em 1 hora
		@setcookie($nome,$string_valor,$tempo);
	}
	function getCookies($nome)
	{
		$nomecookies = $_COOCKIE[$nome];
		$tamanho = strlen($nomecookies);
		if( $tamanho == 0 )
		{
			$nomecookies = $HTTP_COOKIE_VARS[$nome];
		}
		return $nomecookies;
	}
}

?>