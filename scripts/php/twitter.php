<?php
function publicarTwitter($idNoti, $tweet){
	//--------------------------------------------
	//monta a URL e o texto para acesso a notícia 
	//--------------------------------------------
	$url = "http://portal.pmf.sc.gov.br/noticias/index.php?pagina=notpagina&noti=".$idNoti;
	$msg = $tweet . " ";
	
	//-------------------------------------------------------------
	//encurta a URL original da notíca para ser postado no TWITTER
	//-------------------------------------------------------------
	include_once("../scripts/bitly/bitly.php");
	$bitly = new Bitly();
	$bitly->url = $url;
	$bitly->shorten();
	$final = $msg.$bitly->getData()->shortUrl;
	
	//---------------------
	//publica o novo tweet
	//---------------------
	require_once('../scripts/twitteroauth/twitteroauth.php');  
	  
	$consumer_key 	 	= "WtZR7o7v7n9o5SeKrjRA4A";  
	$consumer_secret 	= "1FOIcY8YRGvk0DPisnS7qvOQCvROhkcijAMVm1k33Q";  
	$oauth_token 		= "92527636-l6leB2qZxCUgc84xcTwTaTebpTiJPTd3xUHKNv91d";  
	$oauth_token_secret = "QQCPqrmBJPJN7cIx59MzF7qBAoYDtgdpfFNCX9armM";  
	
	$connection 		= new TwitterOAuth($consumer_key, $consumer_secret, $oauth_token, $oauth_token_secret);
	$result 			= $connection->post('statuses/update', array('status' => $final));
}

?>