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
$Tsigla			= strtoupper($_POST['Fsigla']);
$Tlocal			= (int)$_POST['Flocal'];

//-----------------------------------------------------
// Verifica se um setor esta sendo incluido ou editado
//-----------------------------------------------------
if($_GET['pagina'] == "setinclui"){
	//----------------------
	// Busca ultima posição
	//---------------------
	$sqlPosicao = "SELECT setor_posicao FROM setores WHERE setor_entidade_id = $Tentidade ORDER BY setor_posicao DESC LIMIT 1";
	$Tresult	= $drive->pedido($sqlPosicao);
	$Tposicao 	= pg_fetch_object($Tresult);
	$TproxPosic = $Tposicao->setor_posicao + 1;
	$Tmsg1		= "Setor cadastrado com Sucesso!";	
	$Tmsg2		= "Não foi possível cadastrar o Setor!";
	$Tretorno	= "?pagina=setinclui&menu=".$_GET['menu'];
				
	//-----------------------------------------------------
	// Monta o sql para inseris os dados no banco de dados
	//-----------------------------------------------------
	$sql = "INSERT INTO 
				setores(
					setor_id, 
					setor_sigla, 
					setor_nome, 
					setor_entidade_id, 
					setor_local_id,
					setor_posicao) 
			VALUES(
				default,
				'$Tsigla', 
				'$Tnome',						
				 $Tentidade, 						
				 $Tlocal,
				 $TproxPosic)";
}else{
	$Tmsg1	  = "Setor editado com Sucesso!";	
	$Tmsg2	  = "Não foi possível editar o Setor!";
	$Tretorno = "?pagina=setcad&menu=".$_GET['menu'];
	$sql	  = "UPDATE setores SET setor_nome = '".$Tnome."', setor_sigla = '".$Tsigla."', setor_local_id = ".$Tlocal." WHERE setor_id =".$_GET['setorId']; 
}

//-----------------------------------
// Insere os dados no banco de dados
//-----------------------------------
$Tinsert = $drive->pedido($sql);
$drive->close();

if($Tinsert){
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
	MsgSql($Tmsg, 100, 400);	
}
?>