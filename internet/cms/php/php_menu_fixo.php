<title></title>
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
$Tentidade		= $_SESSION['SuserEnt'];
$TmenuFixoId	= $_POST['Ffixo'];
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
if(!isset($_GET['menuFixId'])){
	//----------------------
	// Busca ultima posição
	//---------------------
	$sqlPosicao = "SELECT * FROM cms_smenu_fixo WHERE menu_fixo_id = ".$_POST['Ffixo']." AND entidade_id = ".$_SESSION['SuserEnt']." ORDER BY ordem DESC LIMIT 1";
	$Tresult	= $drive->pedido($sqlPosicao);
	$Tposicao 	= pg_fetch_object($Tresult);
	$TproxPosic = $Tposicao->ordem + 1;
	$Tmsg1		= "Sub-Menu cadastrado com Sucesso!";	
	$Tmsg2		= "Não foi possível cadastrar o Sub-Menu!";
	$Tretorno	= "?pagina=".$_GET['pagina']."&menu=".$_GET['menu'];	
	
	//-----------------------------------------------------
	// Monta o sql para inseris os dados no banco de dados
	//-----------------------------------------------------
	$sql = "INSERT INTO 
				cms_smenu_fixo(
					id, 
					titulo, 
					menu_fixo_id,
					tipo_link, 
					link,
					status,
					ordem,
					pagina_id,
					entidade_id
			)VALUES(
				default,
				'".$Ttitulo."',
				 ".$TmenuFixoId.", 
				 ".$Tacao.",
				'".$TlinkExt."',
				 ".$Tlibera.",
				 ".$TproxPosic.",
				 ".$TlinkInt.",
				 ".$Tentidade.")";		
}else{
	$Tmsg1		= "Sub-Menu editado com Sucesso!";	
	$Tmsg2		= "Não foi possível editar o Sub-Menu!";
	$Tretorno	= "?pagina=".$_GET['pagina']."&menu=".$_GET['menu']."&menuFixId=".$_GET['menuFixId'];
	$sql		= "UPDATE cms_smenu_fixo SET 
						titulo = '".$Ttitulo."', 
						link = '".$TlinkExt."',
						status = ".$Tlibera.", 
						tipo_link = ".$Tacao.",
						pagina_id = ".$TlinkInt."
					WHERE id =".$_GET['menuFixId']; 
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