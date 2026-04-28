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
$Tdescricao		= $_POST['Fdescricao'];
$Tdata	 		= inverteDate($_POST['Fdata']);
$TpalavraChave	= $_POST['Ftags'];
$Tarquivo 		= $_FILES['Farquivo'];

//-----------------------------------------------------
// Verifica se o edital esta sendo incluido ou editado
//-----------------------------------------------------
if(!isset($_GET['edt'])){
	$Tmsg1		= "Edital cadastrado com Sucesso!";	
	$Tmsg2		= "Não foi possível cadastrar o Edital";	
	$Tretorno 	= "?pagina=".$_GET['pagina']."&menu=".$_GET['menu']."";	
	$Tarq 		= $drive->upload(CAMINHO_SITE."/".UPLOAD_EDITAL,$Tarquivo,"pdf",50);
	//-----------------------------------------------------
	// Monta o sql para inserir os dados no banco de dados
	//-----------------------------------------------------
	$sql = "INSERT INTO 
				arquivo_edital(
					arqedital_id, 
					arqedital_data, 
					arqedital_link, 
					arqedital_descricao, 
					arqedital_palavra_chave, 
					arqedital_nome, 
					arqedital_entidade_id) 
			VALUES(
				default, 
				'$Tdata', 
				'$Tarq[6]', 
				'$Tdescricao', 
				'$TpalavraChave', 
				'$Ttitulo', 
				 $Tentidade)";
}else{
	$Tmsg1	  = "Edital editado com Sucesso!";	
	$Tmsg2	  = "Não foi possível editar o Edital!";
	$Tretorno = "?pagina=".$_GET['pagina']."&menu=".$_GET['menu']."&edt=".$_GET['edt'];	
	$sql = "UPDATE 
			  arquivo_edital  
			SET 
			  arqedital_data 		  = '".$Tdata."',
			  arqedital_descricao 	  = '".$Tdescricao."',
			  arqedital_palavra_chave = '".$TpalavraChave."',
			  arqedital_nome		  = '".$Ttitulo."'
			WHERE 
			  arqedital_id = ".$_GET['edt'];
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