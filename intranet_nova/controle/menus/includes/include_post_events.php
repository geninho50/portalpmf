<?php
$txtNomeMenu = $_POST['txtNomeMenu'];
$rbAcaoMenu	 = $_POST['rbAcaoMenu'];
$txtEndereco = $_POST['txtEndereco'];
$txtAtalho 	 = $_POST['txtAtalho'];
$txtSistema  = $_POST['txtSistema'];	
switch($txtSistema){
	case "internet" : $txtSistema = "internet";	break;
	case "intranet" : $txtSistema = "intranet";	break;
	default 		: $txtSistema = "intranet";	break;
}
$chaveTipoMenu = false;
switch($rbAcaoMenu){
	case "pai"   : $chaveTipoMenu = 't'; break;
	case "filho" : $chaveTipoMenu = 'f'; break;
}
$ultimaPosicao  = "SELECT 
					count(intranet_menu_posicao) as posicao 
					FROM intranet_menu 
					WHERE intranet_menu_tipo_pai = '$chaveTipoMenu' AND intranet_menu_tipo = '$txtSistema'";
$qUltimaPosicao = $drive->pedido($ultimaPosicao);
$oUltimaPosicao = pg_fetch_object($qUltimaPosicao);
$proximaPosicao = (int)$oUltimaPosicao->posicao + 1;
$queryInsert 	= "INSERT INTO 
					intranet_menu 
					VALUES (default,'$txtNomeMenu','$chaveTipoMenu','$txtEndereco','$txtAtalho',$proximaPosicao,'$txtSistema')";
$queryResult 	= $drive->pedido($queryInsert);
if($queryResult){
	$drive->mensagem("Menu incluido com sucesso !!");
}
?>