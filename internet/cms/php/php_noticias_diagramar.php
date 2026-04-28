<?php
//--------------------------------------------
// Scripts que serão utilizados para inclusão
//--------------------------------------------
require_once("../scripts/php/funcoes.php");
require_once("../scripts/php/funcoes_bd.php");
$drive->conecta();

//-------------------------------------------------------------------------
// Verifica se esta sendo alterada uma notícia ou o formato da diagramação
//-------------------------------------------------------------------------
if(isset($_POST["btLiberar_x"])){
	$sql 	  = "UPDATE config_manchetes SET man_tipo = ".$_POST['Flibera']." WHERE man_entidade_id = ".$_SESSION['SuserEnt']; 	
	$Tmsg1	  = "Tipo de diagramação alterada com Sucesso!";	
	$Tmsg2	  = "Não foi possível alterar o tipo de Diagramção!";
	$Tretorno = "?pagina=".$_GET['pagina']."&menu=".$_GET['menu'];	
}else{
	$sql 	  = "UPDATE config_manchetes SET man_noti_".$_GET['p']." = ".$_POST['FidNoti']." WHERE man_entidade_id = ".$_SESSION['SuserEnt']; 
	$Tmsg1	  = "Notícia Diagramada Sucesso!";	
	$Tmsg2	  = "Não foi possível Diagramar a Notícia!";
	$Tretorno = "?pagina=notdiagram&menu=".$_GET['menu'];	
}

//----------------------------------
//Altera os dados no banco de dados
//----------------------------------
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
		".'SQL :'.$sql."
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