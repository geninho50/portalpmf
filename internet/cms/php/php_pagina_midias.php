<?php
//--------------------------------------------
// Scripts que serão utilizados para inclusão
//--------------------------------------------
require_once("../scripts/php/funcoes.php");
require_once("../scripts/php/funcoes_bd.php");
$drive->conecta();

//--------------------------------------------------------------
//verifica se esta sendo a mídia esta sendo incluida ou editada
//--------------------------------------------------------------
if(!isset($_GET['md'])){
	$TentidadeId = (int)$_SESSION['SuserEnt'];
	$TtipoMidia	 = (int)$_POST['Ftipo'];
	$Tdata		 = date("Y/m/d");
	$Tarquivo 	 = $_FILES['Farquivo'];
	$Tlegenda 	 = $_POST['Flegenda'];
	$Ttag		 = $_POST['Ftags'];
	
	//-------------------------------------------------
	// verifica qual tipo de mídia esta sendo incluída
	// 1 -> Áudio
	// 0 -> Vídeo
	//-------------------------------------------------
	if($_POST['Ftipo'] == 1){
		$Tdiretorio = CAMINHO_SITE."/".UPLOAD_AUDIO;  
		$Textensao  = "mp3";	
		$TretUpload = $drive->upload($Tdiretorio,$Tarquivo,$Textensao,30);	
		$Tcaminho 	= UPLOAD_AUDIO.$TretUpload[6];
		$Tmsg1	  	= "Áudio Incluido com Sucesso!";
		$Tmsg2	  	= "Não foi possível incluir o Áudio!";	
	}else{
		$Tdiretorio = CAMINHO_SITE."/".UPLOAD_VIDEOS; 
		$Textensao  = "flv";
		$TretUpload = $drive->upload($Tdiretorio,$Tarquivo,$Textensao,50);
		$Tcaminho 	= UPLOAD_VIDEOS.$TretUpload[6];
		$Tmsg1	  	= "Vídeo Incluido com Sucesso!";
		$Tmsg2	  	= "Não foi possível incluir o Vídeo!";	
	}
	$Tretorno	= "?pagina=".$_GET['pagina']."&menu=".$_GET['menu']."&p=".$_GET['p']."&midPg=".$_GET['midPg'];

	//------------------------------------------------------------------------------------
	// Verifica se a mídia foi  carregada com sucesso no servidor e insere os dados no bd
	//------------------------------------------------------------------------------------
	if($TretUpload[1] == true){
		$sql  = "INSERT INTO 
					midia(
						midia_id,
					 	midia_legenda, 
					 	midia_tipo, 
					 	midia_palavra_chave, 
					 	midia_link, 
					 	midia_data,
					 	midia_entidade_id
				)VALUES(
					  default, 
					 '$Tlegenda', 
					  $TtipoMidia, 
					 '$Ttag', 
					 '$Tcaminho', 
					 '$Tdata',
					  $TentidadeId)";
					  
		$Tresult = $drive->pedido($sql);
		
		//---------------------------------------
		// monta a relação da mídia com a página
		//---------------------------------------
		if($Tresult){			
			$Tpagina  = $_GET['p'];
			$sqlLoc   = "SELECT midia_id FROM midia ORDER BY midia_id DESC LIMIT 1";
			$TretMid  = $drive->pedido($sqlLoc);
			$Tmidia   = pg_fetch_object($TretMid);
			$TmidId   = $Tmidia->midia_id;
			$sql	  = "INSERT INTO 
							cms_pagina_midia(
								cmsmidia_id, 
								cmsmidia_tipo,
								cmsmidia_pagina_id,
								cmsmidia_legenda,
								cmsmidia_midia_id
						)VALUES(
							default, 
							$TtipoMidia,
							$Tpagina,
							'$Tlegenda',
							$TmidId)";			
		}
	}else{
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
}else{
	$Tmsg1	  	= "Mídia alterada com Sucesso!";
	$Tmsg2	  	= "Não foi possível alterar a Mídia!";	
	$Tretorno	= "?pagina=".$_GET['pagina']."&menu=".$_GET['menu']."&p=".$_GET['p']."&midPg=".$_GET['midPg']."&md=".$_GET['md'];
	//-------------------------
	// Edita os dados da mídia	
	//-------------------------
	$Ttitulo = $_POST['Flegenda'];
	$Tkeys	 = $_POST['Ftags'];
	$TmidId	 = $_POST['FmidId'];
	$sqlCms	 = "UPDATE cms_pagina_midia SET cmsmidia_legenda = '".$Ttitulo."' WHERE cmsmidia_midia_id = ".$TmidId." AND cmsmidia_pagina_id = ".$_GET['p'];
	var_dump($sqlCms);
	$Treturn = $drive->pedido($sqlCms);
	if($Treturn){
		$sql = "UPDATE midia SET midia_palavra_chave = '".$Tkeys."' WHERE midia_id = ".$TmidId;
	}
}

$Treturn = $drive->pedido($sql);
$drive->close();
//-------------------------------------------------------
// Imprime mensagem de de confirmação de inclusão/edição
//-------------------------------------------------------
if($Treturn){
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