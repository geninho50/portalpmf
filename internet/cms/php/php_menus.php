<?php
//--------------------------------------------
// Scripts que serão utilizados para inclusão
//--------------------------------------------
require_once("../scripts/php/funcoes.php");
require_once("../scripts/php/funcoes_bd.php");
$drive->conecta();
//-------------------------------------------------------------
// Se o menu ainda não esta todo em MAIÚSCULO, coverte o titulo
//-------------------------------------------------------------
$convert_to = array(
	"a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u",
	"v", "w", "x", "y", "z", "à", "á", "â", "ã", "ä", "å", "æ", "ç", "è", "é", "ê", "ë", "ì", "í", "î", "ï",
	"ð", "ñ", "ò", "ó", "ô", "õ", "ö", "ø", "ù", "ú", "û", "ü", "ý", "а", "б", "в", "г", "д", "е", "ё", "ж",
	"з", "и", "й", "к", "л", "м", "н", "о", "п", "р", "с", "т", "у", "ф", "х", "ц", "ч", "ш", "щ", "ъ", "ы",
	"ь", "э", "ю", "я"
 );
 $convert_from = array(
	"A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U",
	"V", "W", "X", "Y", "Z", "À", "Á", "Â", "Ã", "Ä", "Å", "Æ", "Ç", "È", "É", "Ê", "Ë", "Ì", "Í", "Î", "Ï",
	"Ð", "Ñ", "Ò", "Ó", "Ô", "Õ", "Ö", "Ø", "Ù", "Ú", "Û", "Ü", "Ý", "А", "Б", "В", "Г", "Д", "Е", "Ё", "Ж",
	"З", "И", "Й", "К", "Л", "М", "Н", "О", "П", "Р", "С", "Т", "У", "Ф", "Х", "Ц", "Ч", "Ш", "Щ", "Ъ", "Ъ",
	"Ь", "Э", "Ю", "Я"
);
						
//----------------------------------------------------------
// Recebe os valores passados pelo formulário e pela sessão
//----------------------------------------------------------
$Tentidade		= (int)$_SESSION['SuserEnt'];
$Ttitulo		= strip_tags($_POST['Ftitulo']);
$Tacao			= $_POST['Facao'];
if(($Tacao == 3)or($Tacao == 1)){
	$TlinkInt   =  0;
}else{
	$TlinkInt	= $_POST['FlinkInt'];
}
$TlinkExt		= $_POST['FlinkExt'];
$Tlibera		= $_POST['Flibera'];

//---------------------------------------------------
// Verifica se o menu esta sendo incluido ou editado
//---------------------------------------------------
if(!isset($_GET['menuId'])){
	//----------------------
	// Busca ultima posição
	//---------------------
	$Ttitulo	= str_replace($convert_to, $convert_from, $Ttitulo);
	$sqlPosicao = "SELECT * FROM cms_menu WHERE cmsmenu_entidade_id = ".$Tentidade." ORDER BY cmsmenu_posicao DESC LIMIT 1";
	$Tresult	= $drive->pedido($sqlPosicao);
	$Tposicao 	= pg_fetch_object($Tresult);
	$TproxPosic = $Tposicao->cmsmenu_posicao + 1;
	$Tmsg1		= "Menu cadastrado com Sucesso!";	
	$Tmsg2		= "Não foi possível cadastrar o Menu!";
	$Tretorno	= "?pagina=".$_GET['pagina']."&menu=".$_GET['menu'];	
	
	//-----------------------------------------------------
	// Monta o sql para inseris os dados no banco de dados
	//-----------------------------------------------------
	$sql = "INSERT INTO 
				cms_menu(
					cmsmenu_id, 
					cmsmenu_titulo, 
					cmsmenu_link,
					cmsmenu_status, 
					cmsmenu_entidade_id,
					cmsmenu_tipo_menu,
					cmsmenu_pagina_id,
					cmsmenu_posicao
			)VALUES(
				default,
				'".$Ttitulo."',
				'".$TlinkExt."', 
				 ".$Tlibera.",
				 ".$Tentidade.",
				 ".$Tacao.",
				 ".$TlinkInt.",
				 ".$TproxPosic.")";		
}else{	
	//----------------------------------------------------------------------------------------------------------------
	//verifica se esta sendo alterado o tipo de ação do menu, para que não fique nenhum submenu sem ligação a um menu
	//----------------------------------------------------------------------------------------------------------------
	if(($Tacao == 2)or($Tacao == 3)){		
		$sqlVerifica = "SELECT COUNT(*) AS qtd FROM cms_submenu WHERE cmssubmenu_menu_id = ".$_GET['menuId'];
		$TretSqlver	 = $drive->pedido($sqlVerifica);
		$Tverifica   = pg_fetch_object($TretSqlver);
		$Tmsg1		 = "Não foi possível alterar a AÇÃO deste Menu!<br><br>Existem <font color=\"#FF0000\"><b>".$Tverifica->qtd."</b></font> sub-menu(s) associado(s) a ele!";	
		$Tretorno	 = "?pagina=".$_GET['pagina']."&menu=".$_GET['menu']."&menuId=".$_GET['menuId'];
		if($Tverifica->qtd > 0){
			$Tmsg = "
			<form method=\"post\" action=\"".$Tretorno."\" >
				<br />
				<br />
				".$Tmsg1."		
				<br />
				<br />
				<input type=\"submit\" onclick=\"document.getElementById('popup').style.display = 'none';\" value=\"Voltar\">			
			</form>";
			MsgSql($Tmsg, 130, 400);
			// break;			
		}
		
		$Tmsg1		= "Menu editado com Sucesso!";	
		$Tmsg2		= "Não foi possível editar o Menu!";
		$Tretorno	= "?pagina=".$_GET['pagina']."&menu=".$_GET['menu']."&menuId=".$_GET['menuId'];
		$sql		= "UPDATE cms_menu SET 
							cmsmenu_titulo = '".$Ttitulo."', 
							cmsmenu_link = '".$TlinkExt."',
							cmsmenu_status =".$Tlibera.", 
							cmsmenu_tipo_menu = ".$Tacao.",
							cmsmenu_pagina_id = ".$TlinkInt."
						WHERE cmsmenu_id =".$_GET['menuId']; 
	}else{
		$Tmsg1		= "Menu editado com Sucesso!";	
		$Tmsg2		= "Não foi possível editar o Menu!";
		$Tretorno	= "?pagina=".$_GET['pagina']."&menu=".$_GET['menu']."&menuId=".$_GET['menuId'];
		$sql		= "UPDATE cms_menu SET 
							cmsmenu_titulo = '".$Ttitulo."', 
							cmsmenu_link = '".$TlinkExt."',
							cmsmenu_status =".$Tlibera.", 
							cmsmenu_pagina_id = ".$TlinkInt."
						WHERE cmsmenu_id =".$_GET['menuId']; 
	}
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