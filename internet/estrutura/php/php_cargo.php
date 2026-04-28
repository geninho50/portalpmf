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
$TcargoUnico	= $_POST['FcargoUnico'];

//-----------------------------------------------------
// Verifica se um cargo esta sendo incluido ou editado
//-----------------------------------------------------
if($_GET['pagina'] == "cargoinclui"){
	//----------------------
	// Busca ultima posição
	//---------------------
	$sqlPosicao = "SELECT cargo_posicao FROM cargos WHERE cargo_entidade_id = $Tentidade ORDER BY cargo_posicao DESC LIMIT 1";
	$Tresult	= $drive->pedido($sqlPosicao);
	$Tposicao 	= pg_fetch_object($Tresult);
	$TproxPosic = $Tposicao->cargo_posicao + 1;
	$Tmsg1		= "Cargo cadastrado com Sucesso!";	
	$Tmsg2		= "Não foi possível cadastrar o Cargo!";
	$Tretorno	= "?pagina=cargoinclui&menu=".$_GET['menu'];	
	
	//-----------------------------------------------------
	// Monta o sql para inseris os dados no banco de dados
	//-----------------------------------------------------
	$sql = "INSERT INTO 
				cargos(
					cargo_id, 
					cargo_nome, 
					cargo_unico, 
					cargo_posicao,
					cargo_entidade_id
			)VALUES(
				default,
				'$Tnome',
				'$TcargoUnico', 
				'$TproxPosic',
				'$Tentidade')";		
}else{
	$sqlVerifica  = "SELECT COUNT(*) FROM uni_usuarios WHERE user_cargo_id = ".$_GET['cargoId'];
	$TretVerifica = $drive->pedido($sqlVerifica);
	$Tverifica 	  = pg_fetch_object($TretVerifica);
	if($Tverifica->count > 1){
		//------------------------------------------------------------------------------------------------------------
		// Em caso de alteração para cargo único, veirifica se há mais de um colaborador já cadastrado com este cargo
		//------------------------------------------------------------------------------------------------------------
		$Tmsg2		= "Não foi possível altetrar o cargo para Único!<br><br>Existem <font color=\"#FF0000\">".$Tverifica->count." colaboradores</font> associados a este cargo.";
		$Tretorno	= "?pagina=cargocad&menu=".$_GET['menu'];
	}else{	
		$Tmsg1		= "Cargo editado com Sucesso!";	
		$Tmsg2		= "Não foi possível editar o Cargo!";
		$Tretorno	= "?pagina=cargocad&menu=".$_GET['menu']."&cargoId=".$_GET['cargoId'];
		$sql		= "UPDATE cargos SET cargo_nome = '".utf8_decode($Tnome)."', cargo_unico = '".$TcargoUnico."' WHERE cargo_id =".$_GET['cargoId']; 
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