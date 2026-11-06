<?php
require_once("../scripts/php/funcoes.php");
require_once("../scripts/php/twitter.php");

$TidNoticia = $_POST['FidNoticia'];
$sql 		= "UPDATE noticias SET noti_status = 't' WHERE noti_id = ".$TidNoticia;			
$Treturn 	= $drive->pedido($sql);

//--------------------------
// recupera chamada twitter
//--------------------------
$sqltwitter 	  = "SELECT noti_twitter FROM noticias WHERE noti_id = ".$TidNoticia;
$resultadotwitter = $drive->pedido($sqltwitter);
$obj 			  = pg_fetch_object($resultadotwitter);

$Ttwitter   = publicarTwitter($TidNoticia, stripcslashes( $obj->noti_twitter) );

if($Treturn){
	//------------------------------------------------
	// Imprime mensagem de de confirmação de inclusão
	//------------------------------------------------
	$Tmsg = "
	<form method=\"post\" action=\"?pagina=".$_GET['pagina']."&menu=".$_GET['menu']."\" >
		<br />
		<br />
		Notícia publicada com sucesso!		
		<br />
		<br />
		<input type=\"submit\" onclick=\"document.getElementById('popup').style.display = 'none';\" value=\"Voltar\">			
	</form>";			
	MsgSql($Tmsg, 100, 400);
}else{
	//------------------------------------------------
	// Imprime mensagem de de confirmação de inclusão
	//------------------------------------------------
	$Tmsg = "
	<form method=\"post\" >
		<br />
		<br />
		Não foi possível postar a Notícia!		
		<br />
		<br />
		<input type=\"submit\" onclick=\"document.getElementById('popup').style.display = 'none';\" value=\"Voltar\">			
	</form>";
	MsgSql($Tmsg, 130, 400);	
}
?>