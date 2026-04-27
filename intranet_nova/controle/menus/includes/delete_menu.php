<?php
$sqlCount  		  = "SELECT count(intranet_menu_id) as quantidade FROM intranet_menu WHERE intranet_menu_tipo = '$get_sistema'";
$RsqlCount 		  = $drive->pedido($sqlCount);
$oSqlCount 		  = pg_fetch_object($RsqlCount); 	
$PosicaoMenuAtual = $oQueryControl->intranet_menu_posicao;
if($PosicaoMenuAtual < $oSqlCount->quantidade){
	for($i = $PosicaoMenuAtual;$i < $oSqlCount->quantidade; $i++){
		$PosicaoOrdenada = (int)$i;
		$PosicaoAtual	 = (int)$i + 1;
		$sqlReordena 	 = "UPDATE intranet_menu SET intranet_menu_posicao = $PosicaoOrdenada 
							WHERE intranet_menu_posicao = $PosicaoAtual AND intranet_menu_tipo = '$get_sistema'";
		$rReordena 		 = $drive->pedido($sqlReordena);
	}
}
$sqlDeleta  	   = "DELETE FROM intranet_menu WHERE intranet_menu_id = $menuid";
$rSqlDeleta 	   = $drive->pedido($sqlDeleta); 
$deletaPerfilMenu  = "DELETE FROM intranet_perfil_menu WHERE intranet_perfil_menu_menu_id = $menuid";
$rdeletaPerfilMenu = $drive->pedido($deletaPerfilMenu);
if($rSqlDeleta && $rdeletaPerfilMenu){
	$drive->mensagem("Menu excluido com sucesso !!");
}
?>