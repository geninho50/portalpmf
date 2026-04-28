<?php
$delperfil 			= "DELETE FROM intranet_perfil WHERE intranet_perfil_id = $perfilid";
$delperfilmenu  	= "DELETE FROM intranet_perfil_menu WHERE intranet_perfil_menu_perfil_id = $perfilid";
$delperfilsubmenu	= "DELETE FROM intranet_perfil_submenu WHERE intranet_perfil_submenu_perfil_id = $perfilid";
		
$result1 = $drive->pedido($delperfil);
$result2 = $drive->pedido($delperfilmenu);
$result3 = $drive->pedido($delperfilsubmenu);
		
if($result1 && $result2 && $result3){
	$drive->mensagem("Sucesso !!");
}else{
	$drive->mensagem("Erro !!");	
}
?>