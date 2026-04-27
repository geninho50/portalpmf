<?php
//--------------------------------------------
// Scripts que serão utilizados para inclusão
//--------------------------------------------
require_once("../scripts/php/funcoes.php");
require_once("../scripts/php/funcoes_bd.php");
include ("../scripts/php/wideimage/WideImage.inc.php");
$drive->conecta();
						
//----------------------------------------------------------
// Recebe os valores passados pelo formulário e pela sessão
//----------------------------------------------------------
$Tentidade	= (int)$_SESSION['SuserEnt'];
$Ttitulo	= strip_tags($_POST['Flegenda']);
$Ttags		= $_POST['Ftags'];
$Tautor		= $_POST['Fautor'];
$Tdata 		= date('Y/m/d');
$Tprincipal = $_POST['Fprincipal'];

//----------------------------------------------------------
// verifica se já existe uma imagem definida como principal
//----------------------------------------------------------
if ($Tprincipal == 1){
	$sqlImg    = "SELECT cmsimg_id FROM cms_pagina_imagens WHERE cmsimg_pagina_id = ".$_GET['p']." AND cmsimg_principal = 't'";
	$TretPrinc = $drive->pedido($sqlImg);
	$Tprinc    = pg_fetch_object($TretPrinc);
	if($Tprinc){
		$sqlImgAlt = "UPDATE cms_pagina_imagens SET cmsimg_principal = 'f' WHERE cmsimg_id = ".$Tprinc->cmsimg_id;
		$drive->pedido($sqlImgAlt);
	}
}

//-----------------------------------------------------
// Verifica se a pagina esta sendo incluida ou editada
//-----------------------------------------------------
if($_GET['imgPg'] == "imgNew" ){
	$Tmsg1	   = "Imagem Cadastrada com Sucesso!";	
	$Tmsg2	   = "Não foi possível cadastrar a Imagem!";	
	$Tretorno  = "?pagina=".$_GET['pagina']."&menu=".$_GET['menu']."&p=".$_GET['p']."&imgPg=".$_GET['imgPg'];	
	$TpaginaId = $_GET['p'];
	//-------------------------------------------
	// Dados a serem inseridos no banco de dados
	//-------------------------------------------
	$sizes['x1'] = $_POST['x1'];
	$sizes['y1'] = $_POST['y1'];
	$sizes['x2'] = $_POST['x2'];
	$sizes['y2'] = $_POST['y2'];
	$sizes['w']  = $_POST['w'];
	$sizes['h']  = $_POST['h'];	

	$TnomeImg 	 = $_POST['FnomeImg'];
	$TimagemTemp = $_POST['FimagemTemp'];
	$TimagemReal = $_POST['FimagemReal'];
	$Tmedia 	 = "../arquivos/imagens/$TnomeImg"."MEDIA.jpg";
	$Tpequena 	 = "../arquivos/imagens/$TnomeImg"."PEQUENA.jpg";
	$Tpreview 	 = "../arquivos/imagens/$TnomeImg"."PREVIEW.jpg";
	
	//-------------------------------------------------------
	//redimensiona as imagens => pequena => preview => media
	//-------------------------------------------------------		
	if(!$sizes['x1']==0 or !$sizes['y1']==0){
	
		$img = wiImage::load($TimagemTemp);
		$res = $img->crop($sizes['x1'],$sizes['y1'],$sizes['w'],$sizes['h']);
		$imgCrop = '../arquivos/imagens/cropada.jpg';
		$res->saveToFile($imgCrop , null, 40);
	
		reduz_imagem($imgCrop ,115, 89, $Tpreview);
		reduz_imagem($imgCrop ,172, 129, $Tpequena);
		reduz_imagem($imgCrop ,260, 195, $Tmedia);
	
		@unlink($imgCrop);
		@unlink($TimagemTemp);
	
	}else{
	
		reduz_imagem($imagemReal,115, 89, $Tpreview);
		reduz_imagem($imagemReal,172, 129, $Tpequena);
		reduz_imagem($imagemReal ,260, 195, $Tmedia);
	
	}
		
	//-----------------------------------
	// insere os dados no banco de dados
	//-----------------------------------	

	$sql = "INSERT INTO 
				imagens(
					img_id,
					img_legenda,
					img_palavra_chave,
					img_link_v_alta,
					img_link_v_media, 
					img_link_v_preview, 
					img_link_v_pequena, 
					img_data,
					img_entidade_id,
					img_autor
			)VALUES(
					default, 
					'$Ttitulo',
					'$Ttags', 
					'$TimagemReal', 
					'$Tmedia', 
					'$Tpreview', 
					'$Tpequena', 
					'$Tdata',
					 $Tentidade,
					'$Tautor')";

	$Tresult = $drive->pedido($sql);
	
	if($Tresult){
		//----------------------------------------
		// Verifica id da imagem que foi inserida
		//----------------------------------------
		$Tpagina  = $_GET['p'];
		$sqlLoc   = "SELECT img_id FROM imagens ORDER BY img_id DESC LIMIT 1";
		$TretImg  = $drive->pedido($sqlLoc);
		$Timagem  = pg_fetch_object($TretImg);
		$TimgId   = $Timagem->img_id;
		$Tprinc	  = 0;
		$sql	  = "INSERT INTO 
						cms_pagina_imagens(
							cmsimg_id, 
							cmsimg_img_id,
							cmsimg_pagina_id,
							cmsimg_legenda,
							cmsimg_principal
					)VALUES(
						default, 
						$TimgId,
						$TpaginaId,
						'$Ttitulo',
						'$Tprincipal')";
	}
}else{
	//---------------------------
	// altera os dados sa imagem
	//---------------------------
	$Tmsg1	  = "Imagem Alterada com Sucesso!";	
	$Tmsg2	  = "Não foi possível Alterar a Imagem!";	
	$Tretorno = "?pagina=".$_GET['pagina']."&menu=".$_GET['menu']."&p=".$_GET['p']."&imgPg=imgEdit&img=".$_GET['img'];	
	$sql	  = "UPDATE 
					imagens 
				SET 
					img_legenda 		= '$Ttitulo',
					img_palavra_chave	= '$Ttags',
					img_autor			= '$Tautor' 
				WHERE
					img_id = ".$_GET['img'];
					
	$sqlCms	  = "UPDATE 
					cms_pagina_imagens
				SET
					cmsimg_legenda   = '$Ttitulo',
					cmsimg_principal = '$Tprincipal'
				WHERE
					cmsimg_img_id = ".$_GET['img']."
				AND
					cmsimg_pagina_id = ".$_GET['p'];
	$drive->pedido($sqlCms);				 
}

//------------------------------------------
// Insere/Altera os dados no banco de dados
//------------------------------------------
$Treturn = $drive->pedido($sql);

//------------------------------------------------------------------------------------------
// Se novo cadastro, busca id do serviço cadastrado para retornar a continuação do cadastro
//------------------------------------------------------------------------------------------
if($Treturn){
	if(!isset($_GET['p'])){
		$sql 	 = "SELECT cmspagina_id FROM cms_pagina ORDER BY cmspagina_id DESC LIMIT 1";
		$Tbusca  = $drive->pedido($sql);
		$TpagId  = pg_fetch_object($Tbusca);
		$Tretorno	= "?pagina=pedit&menu=".$_GET['menu']."&p=".$TpagId->cmspagina_id;	
	}
}

$drive->close();

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
