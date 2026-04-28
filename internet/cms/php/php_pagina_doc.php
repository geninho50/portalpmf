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
$Tentidade	= (int)$_SESSION['SuserEnt'];
$Ttitulo	= strip_tags($_POST['Ftitulo']);
$Tdescricao	= $_POST['Fdescricao'];
$Ttags		= $_POST['Ftags'];
$Tdata 		= date('Y/m/d');

//------------------------------------------------------
// Verifica se o arquivo esta sendo incluido ou editado
//------------------------------------------------------
if(!isset($_GET['doc'])){
	$Tdir		= CAMINHO_SITE."/".UPLOAD_ARQUIVOS;
	$Textensao	= "pdf#doc#rtf#zip#rar#ppt#pps#txt#xls#docx#xlsx";
	$Tarquivo 	= $drive->upload($Tdir,$_FILES['Farquivo'],$Textensao,50);
	if($Tarquivo[1]==true){
		$Tlink 		= UPLOAD_ARQUIVOS.$Tarquivo[6];
		$Tmsg1	  = "Documento Incluido com Sucesso!";	
		$Tmsg2	  = "Não foi possível cadastrar incluir o Documento!";	
		$sqlDoc   = "INSERT INTO 
						arquivos(
							arq_id, 
							arq_nome, 
							arq_palavra_chave, 
							arq_link, 
							arq_data,
							arq_descricao, 
							arq_entidade_id
					)VALUES(
						default, 
						'".$Ttitulo."', 
						'".$Ttags."',
						'".$Tlink."', 
						'".$Tdata."', 
						'".$Tdescricao."', 
						".$Tentidade.")";
		$drive->pedido($sqlDoc);
		//-----------------------------------------------------------------
		// monta a relação da tabela Arquivos com a tabela Página_Arquivos	
		//-----------------------------------------------------------------
		$sqlId	 = "SELECT arq_id FROM arquivos WHERE arq_entidade_id = ".$Tentidade." ORDER BY arq_id DESC LIMIT 1";
		$TdocId  = pg_fetch_object($drive->pedido($sqlId));
		$sqlPos  = "SELECT cmsarq_posicao FROM cms_pagina_arquivos WHERE cmsarq_pagina_id = ".$_GET['p']." ORDER BY cmsarq_posicao DESC LIMIT 1";		
		$TretPos = pg_fetch_object($drive->pedido($sqlPos));
		$Tposic  = $TretPos->cmsarq_posicao + 1;
		$sql	 = "INSERT INTO 
						cms_pagina_arquivos(
				   			cmsarq_id,
							cmsarq_pagina_id,
							cmsarq_arq_id,
							cmsarq_legenda,
							cmsarq_posicao
				   )VALUES(
				   		 default,
						 ".$_GET['p'].",
						 ".$TdocId->arq_id.",
						'".$Ttitulo."',
						 ".$Tposic.")";
	}else{
		$Tmsg2	  = "Não foi possível incluir o Arquivo (tipo não permitido)!";	
	}
}else{
	//----------------------------
	// altera os dados do arquivo
	//----------------------------
	$Tmsg1	  = "Arquivo Alterado com Sucesso!";	
	$Tmsg2	  = "Não foi possível Alterar o Arquvio!";	
	$Tretorno = "?pagina=".$_GET['pagina']."&menu=".$_GET['menu']."&p=".$_GET['p']."&docPg=docEdit&doc=".$_GET['doc'];
	$sql	  = "UPDATE 
					arquivos 
				SET 
					arq_nome 		  = '$Ttitulo',
					arq_palavra_chave = '$Ttags',
					arq_descricao	  = '$Tdescricao' 
				WHERE
					arq_id = ".$_GET['doc'];
					
	$sqlCms	  = "UPDATE 
					cms_pagina_arquivos
				SET
					cmsarq_legenda   = '$Ttitulo'
				WHERE
					cmsarq_arq_id = ".$_GET['doc']."
				AND
					cmsarq_pagina_id = ".$_GET['p'];
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
