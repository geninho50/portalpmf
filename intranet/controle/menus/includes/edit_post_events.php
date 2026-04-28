<?php
if(isset($_POST['btn_editar_menu_x'])){
	$txtNomeMenu = $_POST['txtNomeMenu'];
	$rbAcaoMenu	 = $_POST['rbAcaoMenu'];
	$txtEndereco = $_POST['txtEndereco'];
	$txtAtalho 	 = $_POST['txtAtalho'];
	$txtSistema  = $_POST['txtSistema'];
	$menuid		 = $_POST['menuid']; 
	switch($txtSistema){
		case "internet" : $txtSistema = "internet"; break;
		case "intranet"	: $txtSistema = "intranet"; break;
		default 		: $txtSistema = "intranet"; break;
	}
	$chaveTipoMenu = false;
	switch($rbAcaoMenu){
		case "pai"   : $chaveTipoMenu = 't'; break;
		case "filho" : $chaveTipoMenu = 'f'; break;
	}
	$queryEdit = "UPDATE intranet_menu
				  SET intranet_menu_titulo 			= '$txtNomeMenu',
					intranet_menu_tipo_pai			= '$chaveTipoMenu',
					intranet_menu_endereco_fisico	= '$txtEndereco',
					intranet_menu_atalho			= '$txtAtalho',
					intranet_menu_tipo				= '$txtSistema'
					WHERE intranet_menu_id			= $menuid";
	$queryResult = $drive->pedido($queryEdit);
	if($queryResult){
		$drive->mensagem("Dados atualizados com sucesso !!");
	}
}
?>