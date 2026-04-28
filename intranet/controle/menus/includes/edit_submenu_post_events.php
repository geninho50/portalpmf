<?php
if(isset($_POST['btn_editar_menu_x'])){
	$txtNomeMenu = $_POST['txtNomeMenu'];
	$txtEndereco = $_POST['txtEndereco'];
	$txtAtalho 	 = $_POST['txtAtalho'];
	$submenuid	 = (int)$_POST['txtsubmenuid']; 
	$menuid		 = (int)$_POST['txtmenuid'];	
	$queryEdit = "UPDATE intranet_submenu
				  SET intranet_submenu_titulo		 = '$txtNomeMenu',
					intranet_submenu_endereco_fisico = '$txtEndereco',
					intranet_submenu_atalho			 = '$txtAtalho'
					WHERE intranet_submenu_id		 = $submenuid";
	$queryResult = $drive->pedido($queryEdit);	
	if($queryResult)	{
		$drive->mensagem("Dados atualizados com sucesso !!");
	}
}	
?>