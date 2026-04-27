<?php
$sqlconf  = "SELECT COUNT(*) FROM intranet_menu_relacionado WHERE intranet_menu_rel_menu_id = $submenuid";
$Tcompara = $drive->pedido($sqlconf);
$Tconf    = pg_fetch_object($Tcompara);
if($Tconf->count == 0){
	$sqlCount 		  = "SELECT count(intranet_submenu_id) as quantidade FROM intranet_submenu WHERE intranet_submenu_pai_id = $menuid";
	$RsqlCount 		  = $drive->pedido($sqlCount);
	$oSqlCount 		  = pg_fetch_object($RsqlCount); 	
	$PosicaoMenuAtual = $oQueryControl->intranet_submenu_posicao;
	if($PosicaoMenuAtual < $oSqlCount->quantidade){
		for($i = $PosicaoMenuAtual;$i < $oSqlCount->quantidade; $i++){
			$PosicaoOrdenada = (int)$i;
			$PosicaoAtual	 = (int)$i + 1;
			$sqlReordena   	 = "UPDATE intranet_submenu SET intranet_submenu_posicao = $PosicaoOrdenada 
							    WHERE intranet_submenu_posicao = $PosicaoAtual AND intranet_submenu_pai_id = $menuid";
			$rReordena 		 = $drive->pedido($sqlReordena);
		}
	}	
	$sqlDeleta  		  = "DELETE FROM intranet_submenu WHERE intranet_submenu_id = $submenuid";
	$rSqlDeleta 		  = $drive->pedido($sqlDeleta);
	$deletaPerfilSubMenu  = "DELETE FROM intranet_perfil_submenu WHERE intranet_perfil_submenu_submenu_id = $submenuid";
	$rdeletaPerfilSubmenu = $drive->pedido($deletaPerfilSubMenu);
	if($rSqlDeleta && $rdeletaPerfilSubmenu){
		$drive->mensagem("Submenu excluido com sucesso !!");
	}
}else{
	$drive->mensagem("Este submenu possui paginas associadas a ele.\\nPara exlcuir o submenu exclua antes as paginas associadas a ele.!!");
}
?>