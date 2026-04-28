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
$TLink			= $_POST['Flink'];

//-------------------------------------------------------
// Verifica se o destaque esta sendo incluido ou editado
//-------------------------------------------------------
if(!isset($_GET['destId'])){
	//----------------------
	// Busca ultima posição
	//---------------------
	$sqlPosicao = "SELECT * FROM destaque_lateral WHERE destaque_lateral_entidade_id = $Tentidade ORDER BY destaque_lateral_posicao DESC LIMIT 1";
	$Tresult	= $drive->pedido($sqlPosicao);
	$Tposicao 	= pg_fetch_object($Tresult);
	$TproxPosic = $Tposicao->destaque_lateral_posicao + 1;
	$Tdestaque 	= $drive->upload(CAMINHO_SITE."/".UPLOAD_DESTAQUE,$_FILES["Fdestaque"],"jpg#gif#png",1);
	$Tmsg1		= "Destaque cadastrado com Sucesso!";	
	$Tmsg2		= "Não foi possível cadastrar o Destaque!";
	$Tretorno	= "?pagina=".$_GET['pagina']."&menu=".$_GET['menu'];	
	
	//-----------------------------------------------------
	// Monta o sql para inseris os dados no banco de dados
	//-----------------------------------------------------
	$sql = "INSERT INTO 
				destaque_lateral(
					destaque_lateral_id, 
					destaque_lateral_titulo, 
					destaque_lateral_link,
					destaque_lateral_img, 
					destaque_lateral_posicao,
					destaque_lateral_entidade_id
			)VALUES(
				default,
				'".$Ttitulo."',
				'".$TLink."', 
				'".$Tdestaque[6]."',
				'".$TproxPosic."',
				'".$Tentidade."')";		
}else{
	$Tmsg1		= "Destaque editado com Sucesso!";	
	$Tmsg2		= "Não foi possível editar o Destaque!";
	$Tretorno	= "?pagina=".$_GET['pagina']."&menu=".$_GET['menu']."&destId=".$_GET['destId'];
	$Tdestaque 	= $drive->upload(CAMINHO_SITE."/".UPLOAD_DESTAQUE,$_FILES["Fdestaque"],"jpg#gif#png",1);
	$sql		= "UPDATE destaque_lateral SET destaque_lateral_titulo = '".$Ttitulo."', destaque_lateral_link = '".$TLink."'";
	if($_FILES["Fdestaque"]['size'] > 0){
		$sql .= ", destaque_lateral_img = '".$Tdestaque[6]."'";
	} else if($_POST['FremoveImg']){
		$sql .= ", destaque_lateral_img = ''";
	}
	 $sql .= " WHERE destaque_lateral_id =".$_GET['destId'];
	
	
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