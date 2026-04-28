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
$Tentidade		= (int)$_SESSION['SuserEnt'];
$Ttitulo		= $_POST['Ftitulo'];
if($_SESSION['SentTipo'] == 7){
	$Tsubtitulo	= $_POST['FsubTitulo'];
}else{
	$Tsubtitulo	= "";
}
$TLink			= $_POST['Flink'];

//-------------------------------------------------------
// Verifica se o banner esta sendo incluido ou editado
//-------------------------------------------------------
if(!isset($_GET['bannerId'])){
	//----------------------
	// Busca ultima posição
	//---------------------
	$sqlPosicao = "SELECT * FROM cms_banner WHERE cms_banner_entidade_id = $Tentidade ORDER BY cms_banner_ordem DESC LIMIT 1";
	$Tresult	= $drive->pedido($sqlPosicao);
	$Tposicao 	= pg_fetch_object($Tresult);
	$TproxPosic = $Tposicao->cms_banner_ordem + 1;
	$Tbanner 	= $drive->upload(CAMINHO_SITE."/".UPLOAD_BANNER,$_FILES['Fbanner'],"jpg#png",5);
	$Tmsg1		= "Banner cadastrado com Sucesso!";	
	$Tmsg2		= "Não foi possível cadastrar o Banner!";
	$Tretorno	= "?pagina=".$_GET['pagina']."&menu=".$_GET['menu'];	
	
	//-----------------------------------------------------
	// Monta o sql para inserir os dados no banco de dados
	//-----------------------------------------------------
	$sql = "INSERT INTO 
				cms_banner(
					cms_banner_id, 
					cms_banner_titulo, 
					cms_banner_path,
					cms_banner_subtitulo, 
					cms_banner_link,
					cms_banner_entidade_id,
					cms_banner_ordem
			)VALUES(
				default,
				'".$Ttitulo."', 
				'".$Tbanner[6]."',
				'".$Tsubtitulo."',
				'".$TLink."',
				'".$Tentidade."',
				'".$TproxPosic."')";		
}else{
	$Tmsg1		= "Banner editado com Sucesso!";	
	$Tmsg2		= "Não foi possível editar o Banner!";
	$Tretorno	= "?pagina=".$_GET['pagina']."&menu=".$_GET['menu']."&bannerId=".$_GET['bannerId'];
	$sql		= "UPDATE cms_banner SET cms_banner_titulo = '".$Ttitulo."', cms_banner_subtitulo = '".$Tsubtitulo."', cms_banner_link = '".$TLink."' WHERE cms_banner_id =".$_GET['bannerId']; 
}
//------------------------------------------
// Insere/Altera os dados no banco de dados
//------------------------------------------
$Treturn = $drive->pedido($sql);
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