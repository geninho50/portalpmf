<?php
$txtNomeMenu = $_POST['txtNomeMenu'];
$txtEndereco = $_POST['txtEndereco'];
$txtAtalho 	 = $_POST['txtAtalho'];
$menuid  	 = (int)$_POST['txtmenupai'];
$ultimaPosicao  = "SELECT 
					count(intranet_submenu_posicao) as posicao 
					FROM intranet_submenu 
					WHERE intranet_submenu_pai_id = $menuid";
$qUltimaPosicao = $drive->pedido($ultimaPosicao);
$oUltimaPosicao = pg_fetch_object($qUltimaPosicao);
$proximaPosicao = (int)$oUltimaPosicao->posicao + 1;
$queryInsert = "INSERT INTO 
				intranet_submenu 
				VALUES (default,$menuid,$proximaPosicao,'$txtNomeMenu','$txtEndereco','$txtAtalho')";
$queryResult = $drive->pedido($queryInsert);
if($queryResult){
	$drive->mensagem("Submenu incluido com sucesso !!");
}
?>