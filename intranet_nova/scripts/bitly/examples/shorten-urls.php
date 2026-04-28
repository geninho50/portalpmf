<?php

	include_once("../bitly.php");
	
	$bitly = new Bitly();
	$bitly->url = 'http://portal.pmf.sc.gov.br/noticias/index.php?pagina=notpagina&noti=2463';
	$bitly->shorten();
	echo $bitly->getData()->shortUrl . '<br />';
	echo $bitly->getData()->userHash;
	
?>