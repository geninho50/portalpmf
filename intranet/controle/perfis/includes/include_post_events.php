<?php
$txtPerfil 	= $_POST['txtPerfil'];	
$query		= "SELECT intranet_perfil_id FROM intranet_perfil WHERE intranet_perfil_nome = '$txtPerfil'";
$result		= $drive->pedido($query);
$rows		= pg_num_rows($result);
If($rows == 0){
	$query 			= "INSERT INTO intranet_perfil VALUES(default, '$txtPerfil')";
	$drive->pedido($query);
	$query =		 "SELECT MAX(intranet_perfil_id) FROM intranet_perfil";
	$result 		= $drive->pedido($query);
	$oquery 		= pg_fetch_object($result);
	$ultimoregistro = (int)$oquery->max;
	$query 			= "DELETE FROM intranet_perfil_menu WHERE intranet_perfil_menu_perfil_id = $ultimoregistro";
	$result 		= $drive->pedido($query);
	$query  		= "DELETE FROM intranet_perfil_submenu WHERE intranet_perfil_submenu_perfil_id = $ultimoregistro";
	$result 		= $drive->pedido($query);
	$chave 			= false;
	
	//--------------------------------------------------------------------------------
	// Lista todos os menus da tabela e verifica se bate com os checkbox selecionados
	//--------------------------------------------------------------------------------
	$querymenus 	= "SELECT intranet_menu_id FROM intranet_menu";
	$rquerymenus	= $drive->pedido($querymenus);
	while($oquerymenus = pg_fetch_object($rquerymenus)){
		$temp_name = 'M' . $oquerymenus->intranet_menu_id;
		$menuid    = (int)$oquerymenus->intranet_menu_id;
		if(isset($_POST[$temp_name])){
			$query 	= "INSERT INTO intranet_perfil_menu VALUES (default,$menuid,$ultimoregistro)";
			$result = $drive->pedido($query);
			if($result){
				$chave = true;
			}else{
				$chave = false;
			}				
		}
	}

	//-----------------------------------------------------------------------------------	
	// lista todos os submenus da tabela e verifica se bate com os checkbox selecionados
	//-----------------------------------------------------------------------------------
	$querysubmenus 	= "SELECT intranet_submenu_id FROM intranet_submenu";
	$rquerysubmenus	= $drive->pedido($querysubmenus);
	while($oquerysubmenus = pg_fetch_object($rquerysubmenus)){
		$temp_name 	  = 'SM' . $oquerysubmenus->intranet_submenu_id;
		$submenuid    = (int)$oquerysubmenus->intranet_submenu_id;
		if(isset($_POST[$temp_name])){
			$query  = "INSERT INTO intranet_perfil_submenu VALUES (default,$submenuid,$ultimoregistro)";
			$result = $drive->pedido($query);
			if($result){
				$chave = true;
			}else{
				$chave = false;
			}
		}
	}
	
	if($chave){
		$drive->mensagem("Sucesso !");
	}else{
		$drive->mensagem("Erro ao criar as permissoes !!");	
	}	

}else{
	$drive->mensagem("Já existe um perfil com este nome !");
	$drive->redirect("?pagina=perfilinclui&menu=".$_GET['menu']."");
}
?>