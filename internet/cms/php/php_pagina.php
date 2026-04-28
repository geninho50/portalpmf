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
if( $_POST['Fentidade'] == '' ){
	$Tentidade	= (int)$_SESSION['SuserEnt'];
}else{
	$Tentidade	= (int)$_POST['Fentidade'];
}

$Ttitulo	= strip_tags(trim($_POST['Ftitulo']));
$Tconteudo	= $_POST['Fconteudo'];
$Ttags		= $_POST['Ftags'];
$Tiframe	= strip_tags(trim($_POST['Fiframe']));
$TaltIframe	= $_POST['FaltIframe'];
$TlarIframe	= $_POST['FlarIframe'];
print "Largura: ".$TlarIframe;


//-------------------
//configura o iframe
//-------------------
if(!empty($Tiframe)){
	$Tiframe = "<iframe width=\"".$TlarIframe."\" height=\"".$TaltIframe."\" src=\"".$Tiframe."\" scrolling=\"yes\" frameborder=\"0\" allow=\"camera; microphone; fullscreen; display-capture; autoplay\"  ></iframe>";	
}

//-------------------------------------------
// faz o tratamento para o titulo de chamada
//-------------------------------------------
$Tacentos = array(
	'A' => '/&Agrave;|&Aacute;|&Acirc;|&Atilde;|&Auml;|&Aring;/',
	'a' => '/&agrave;|&aacute;|&acirc;|&atilde;|&auml;|&aring;/',
	'C' => '/&Ccedil;/',
	'c' => '/&ccedil;/',
	'E' => '/&Egrave;|&Eacute;|&Ecirc;|&Euml;/',
	'e' => '/&egrave;|&eacute;|&ecirc;|&euml;/',
	'I' => '/&Igrave;|&Iacute;|&Icirc;|&Iuml;/',
	'i' => '/&igrave;|&iacute;|&icirc;|&iuml;/',
	'N' => '/&Ntilde;/',
	'n' => '/&ntilde;/',
	'O' => '/&Ograve;|&Oacute;|&Ocirc;|&Otilde;|&Ouml;/',
	'o' => '/&ograve;|&oacute;|&ocirc;|&otilde;|&ouml;/',
	'U' => '/&Ugrave;|&Uacute;|&Ucirc;|&Uuml;/',
	'u' => '/&ugrave;|&uacute;|&ucirc;|&uuml;/',
	'Y' => '/&Yacute;/',
	'y' => '/&yacute;|&yuml;/',
	'a.' => '/&ordf;/',
	'o.' => '/&ordm;/',
	'+'  => '/&nbsp;/'
);
$Tabbr 		 	= preg_replace($Tacentos, array_keys($Tacentos), htmlentities($Ttitulo,ENT_NOQUOTES, 'UTF-8'));
$Tcaracteres 	= array("+", "-", "!", "_", " ", "?", "[", "]", "(", ")", "{", "}", "@", "#", "\\", "/", ";", ":", ".", ",", "<", ">", "^", "|");
$TcaracteresAlt = str_replace($Tcaracteres, "+", $Tabbr);
$Tabbr 			= strtolower($TcaracteresAlt);

//-----------------------------------------------------
// Verifica se a pagina esta sendo incluida ou editada
//-----------------------------------------------------
if(!isset($_GET['p'])){
	$Tmsg1	  = "Página Cadastrada com Sucesso!";	
	$Tmsg2	  = "Não foi possível cadastrar a Página!";	
	$sql = "INSERT INTO 
				cms_pagina(
					cmspagina_id, 
					cmspagina_titulo, 
					cmspagina_texto, 
					cmspagina_entidade_id, 
					cmspagina_palavra_chave,
					cmspagina_abbr, 
					cmspagina_iframe, 
					cmspagina_estilo_galeria
			)VALUES(
				default, 
				'".$Ttitulo."', 
				'".$Tconteudo."', 
				 ".$Tentidade.", 
				'".$Ttags."', 
				'".$Tabbr."', 
				'".$Tiframe."', 
				 0)";
}else{
	$Tmsg1	  = "Página Alterada com Sucesso!";	
	$Tmsg2	  = "Não foi possível Alterar a Página!";	
	$Tretorno = "?pagina=pedit&menu=".$_GET['menu']."&p=".$_GET['p'];	
	$sql = "UPDATE 
				cms_pagina 
			SET 
				cmspagina_titulo 		 = '".$Ttitulo."',
				cmspagina_texto 		 = '".$Tconteudo."',
				cmspagina_entidade_id    =  '".$Tentidade."', 
				cmspagina_palavra_chave  = '".$Ttags."',
				cmspagina_abbr 			 = '".$Tabbr."',
				cmspagina_iframe 		 = '".$Tiframe."'
			WHERE 
				cmspagina_id = ".$_GET['p'];	
			 
			 echo "<script> console.log ('PHP: ".$sql."' ); </script>";  
}

//------------------------------------------
// Insere/Altera os dados no banco de dados
//------------------------------------------
$Treturn = $drive->pedido($sql);

if( $Tentidade != (int)$_SESSION['SuserEnt'] ){
	transportar($Tentidade, $_GET['p'], $drive );
}

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

//------------------------------------------------
// Function atualizar a entidade em setor
//------------------------------------------------	
function transportar($TentidadeID,$TpaginaID, $drive ){

	// Transportar Item do Menu
	$sqlSetor = "UPDATE cms_menu 
	                SET cmsmenu_entidade_id = '$TentidadeID' 
				  WHERE cmsmenu_pagina_id   = '$TpaginaID' ";
		  
	$Tupdate = $drive->pedido( $sqlSetor );


}
?>