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
$Ttiporel		= $_POST['Ftprel'];
$Tperiodo 		= explode("-", $_POST['Fperiodo']);
$Tperiodo1 		= explode("/", $Tperiodo[0]);
$Tperiodo2 		= explode("/", $Tperiodo[1]);
$TperiodoFinal 	= $Tperiodo1[0].$Tperiodo1[1].$Tperiodo1[2].$Tperiodo2[0].$Tperiodo2[1].$Tperiodo2[2];
$TperiodoFinal	= explode(" ", $TperiodoFinal);
$TperiodoFinal	= $TperiodoFinal[0].$TperiodoFinal[2];

//--------------------------------------------------------
// Verifica se o relatorio esta sendo incluido ou editado
//--------------------------------------------------------
if(!isset($_GET['relId'])){
	$Tmsg1		= "Relatório cadastrado com Sucesso!";	
	$Tmsg2		= "Não foi possível cadastrar o Relatório!";	
	$Tretorno 	= "?pagina=".$_GET['pagina']."&menu=".$_GET['menu']."";	
	$Tarq 		= $drive->upload(CAMINHO_SITE."/".UPLOAD_DOCUMENTOS,$_FILES["Farq"],"pdf#doc#xls#ppt#zip#rar#docx#xlsx#pps#pptx",50);
	
	//-----------------------------------------------------
	// Monta o sql para inserir os dados no banco de dados
	//-----------------------------------------------------
	$sql = " INSERT INTO 
				  arquivo_relatorio(
					  arqrel_id,					  
					  arqrel_tiporel_id,
					  arqrel_periodo,					  				  
					  arqrel_link
				)VALUES(
				  	 default,
					 $Ttiporel,
					'$TperiodoFinal',
					'$Tarq[6]')";
}else{
	$Tmsg1	  = " Relatório editado com Sucesso!";	
	$Tmsg2	  = "Não foi possível editar o Relatório!";
	$Tretorno = "?pagina=".$_GET['pagina']."&menu=".$_GET['menu']."&relId=".$_GET['relId']."&tp=".$_GET['tp'];	
	$sql = "UPDATE 
			  arquivo_relatorio  
			SET 
			  arqrel_tiporel_id = ".$Ttiporel.",
			  arqrel_periodo = '".$TperiodoFinal."'
			WHERE 
			  arqrel_id = ".$_GET['relId'];
}

//-----------------------------------
// Insere os dados no banco de dados
//-----------------------------------
$Tinsert = $drive->pedido($sql);
$drive->close();

//------------------------------------------------
// Imprime mensagem de de confirmação de inclusão
//------------------------------------------------	
if($Tinsert){
	$Tmsg = "
	<form method=\"post\" action=\"".$Tretorno."\">
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
	<form method=\"post\" action=\"".$Tretorno."\">
		<br />
		<br />
		".$Tmsg2."	
		<br />
		<br />
		<input type=\"submit\" onclick=\"document.getElementById('popup').style.display = 'none';\" value=\"Voltar\">			
	</form>";			
	MsgSql($Tmsg, 100, 400);	
}