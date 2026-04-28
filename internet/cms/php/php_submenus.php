<?php
//--------------------------------------------
// Scripts que serão utilizados para inclusão
//--------------------------------------------
require_once("../scripts/php/funcoes.php");
require_once("../scripts/php/funcoes_bd.php");
$drive->conecta();
						
//----------------------------------------------------------
// Recebe os valores passados pelo formulário e pela sessão
//----------------------------------------------------------
$TmenuId		= $_GET['menuId'];
$Ttitulo		= strip_tags($_POST['Ftitulo']);
$Tacao			= $_POST['Facao'];
if($Tacao == 1){
	$TlinkInt   =  0;
}else{
	$TlinkInt	= $_POST['FlinkInt'];
}
$TlinkExt		= $_POST['FlinkExt'];
$Tlibera		= $_POST['Flibera'];

//---------------------------------------------------
// Verifica se o menu esta sendo incluido ou editado
//---------------------------------------------------
if(!isset($_GET['menuIdS'])){
	//----------------------
	// Busca ultima posição
	//---------------------
	$sqlPosicao = "SELECT * FROM cms_submenu WHERE cmssubmenu_menu_id = ".$_GET['menuId']." ORDER BY cmssubmenu_ordem DESC LIMIT 1";
	$Tresult	= $drive->pedido($sqlPosicao);
	$Tposicao 	= pg_fetch_object($Tresult);
	$TproxPosic = $Tposicao->cmssubmenu_ordem + 1;
	$Tmsg1		= "Sub-Menu cadastrado com Sucesso!";	
	$Tmsg2		= "Não foi possível cadastrar o Sub-Menu!";
	$Tretorno	= "?pagina=".$_GET['pagina']."&menu=".$_GET['menu']."&menuId=".$_GET['menuId'];	
	
	//-----------------------------------------------------
	// Monta o sql para inseris os dados no banco de dados
	//-----------------------------------------------------
	$sql = "INSERT INTO 
				cms_submenu(
					cmssubmenu_id, 
					cmssubmenu_titulo, 
					cmssubmenu_menu_id,
					cmssubmenu_tipo_link, 
					cmssubmenu_link,
					cmssubmenu_status,
					cmssubmenu_ordem,
					cmssubmenu_pagina_id
			)VALUES(
				default,
				'".$Ttitulo."',
				 ".$TmenuId.", 
				 ".$Tacao.",
				'".$TlinkExt."',
				 ".$Tlibera.",
				 ".$TproxPosic.",
				 ".$TlinkInt.")";		
}else{
	$Tmsg1		= "Sub-Menu editado com Sucesso!";	
	$Tmsg2		= "Não foi possível editar o Sub-Menu!";
	$Tretorno	= "?pagina=".$_GET['pagina']."&menu=".$_GET['menu']."&menuId=".$_GET['menuId']."&menuIdS=".$_GET['menuIdS'];
	$sql		= "UPDATE cms_submenu SET 
						cmssubmenu_titulo = '".$Ttitulo."', 
						cmssubmenu_link = '".$TlinkExt."',
						cmssubmenu_status = ".$Tlibera.", 
						cmssubmenu_tipo_link = ".$Tacao.",
						cmssubmenu_pagina_id = ".$TlinkInt."
					WHERE cmssubmenu_id =".$_GET['menuIdS']; 
}
//------------------------------------------
// Insere/Altera os dados no banco de dados
//------------------------------------------
$Treturn = $drive->pedido($sql);
$drive->close();
var_dump($sql);

if($Treturn){
	//------------------------------------------------
	// Imprime mensagem de de confirmação de inclusão
	//------------------------------------------------
	$Tmsg = "
	<form method=\"post\" action=\"".$Tretorno."\" >
		<br />
		<br />
		".$Tmsg1."		
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
		".$Tmsg2."		
		<br />
		<br />
		<input type=\"submit\" onclick=\"document.getElementById('popup').style.display = 'none';\" value=\"Voltar\">			
	</form>";
	MsgSql($Tmsg, 130, 400);	
}
?>