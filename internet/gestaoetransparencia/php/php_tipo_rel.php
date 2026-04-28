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
$Tnome			= $_POST['Fnome'];
$TpalavraChave	= $_POST['Ftags'];
$Tdescricao		= $_POST['Fdescricao'];

//------------------------------------------------------
// Verifica se o serviço esta sendo incluido ou editado
//------------------------------------------------------
if(!isset($_GET['tprelId'])){
	$Tmsg1		= "Tipo de Relatório cadastrado com Sucesso!";	
	$Tmsg2		= "Não foi possível cadastrar o Tipo de Relatório!";	
	$Tretorno 	= "?pagina=".$_GET['pagina']."&menu=".$_GET['menu']."";	
	//-----------------------------------------------------
	// Monta o sql para inserir os dados no banco de dados
	//-----------------------------------------------------
	$sql = " INSERT INTO 
				  tipo_relatorio(
					  tiporel_id,					  
					  tiporel_nome,
					  tiporel_descricao,					  				  
					  tiporel_palavra_chave,
					  tiporel_entidade_id					 					  
				)VALUES(
				  	 default,
					'$Tnome',
					'$Tdescricao',
					'$TpalavraChave',
					 $Tentidade)";
}else{
	$Tmsg1	  = "Tipo de Relatório editado com Sucesso!";	
	$Tmsg2	  = "Não foi possível editar o Tipo de Relatório!";
	$Tretorno = "?pagina=".$_GET['pagina']."&menu=".$_GET['menu']."&tprelId=".$_GET['tprelId'];	
	$sql = "UPDATE 
			  tipo_relatorio  
			SET 
			  tiporel_nome = '".$Tnome."',
			  tiporel_descricao = '".$Tdescricao."',
			  tiporel_palavra_chave = '".$TpalavraChave."'
			WHERE 
			  tiporel_id = ".$_GET['tprelId'];
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