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

if ( $_POST['Fentidade'] == '' ){
	$Tentidade		= (int)$_SESSION['SuserEnt'];
}else{
	$Tentidade		= (int)$_POST['Fentidade'];
}

$Tnome			= $_POST['Fnome'];
$Tlogradouro	= $_POST['Frua'];
$Tnumero		= (int)$_POST['Fnum'];
$Tcomplemento	= $_POST['Fcomplemento'];
$Tbairro		= $_POST['Fbairro'];
$Tcep			= $_POST['Fcep'];
$ThoraInicio	= $_POST['Fhinicio'];
$ThoraFinal		= $_POST['Fhfinal'];
$ThoraInicio2	= $_POST['Fhinicio2'];
$ThoraFinal2	= $_POST['Fhfinal2'];
//$Temail			= explode("@", $_POST['Femail']);
$Temail			= $_POST['Femail'];
$Tchars 		= array(')','(',' ','-');
$Tsubs 			= array ('','','','');
$Tfone			= $_POST['Ffone'];
$Tfax			= $_POST['Ffax'];
//$Tfone			= "48".str_replace($Tchars,$Tsubs,$_POST['Ffone']);
//$Tfax			= "48".str_replace($Tchars,$Tsubs,$_POST['Ffax']);

//----------------------------------------------------
// Verifica se o local esta sendo incluido ou editado
//----------------------------------------------------
if($_GET['pagina'] == "locinclui"){
	$Tmsg1		= "Local cadastrado com Sucesso!";	
	$Tmsg2		= "Não foi possível cadastrar o Local!";
	$Tretorno	= "?pagina=locinclui&menu=".$_GET['menu'];
	//-----------------------------------------------------
	// Monta o sql para inseris os dados no banco de dados
	//-----------------------------------------------------
	$sql = "INSERT INTO
				locais(
					loc_id,
					loc_nome,
					loc_rua,
					loc_cep,
					loc_num,
					loc_horario,
					loc_email,
					loc_fone,
					loc_fax,
					loc_horario2,
					loc_entidade_id,
					loc_complemento,
					loc_horario3,
					loc_horario4,
					loc_bairro
			)VALUES(
				default,
				'$Tnome',
				'$Tlogradouro',
				'$Tcep',
				 $Tnumero,
				'$ThoraInicio',
				'$Temail[0]',
				'$Tfone',
				'$Tfax',
				'$ThoraFinal',
				 $Tentidade,
				'$Tcomplemento',
				'$ThoraInicio2',
				'$ThoraFinal2',
				$Tbairro)";
}else{
	$Tmsg1	  = "Local editado com Sucesso!";	
	$Tmsg2	  = "Não foi possível editar o Local!";
	$Tretorno = "?pagina=loccad&menu=".$_GET['menu'];
	$sql	  = "UPDATE 
					locais 
				SET 
					loc_nome = '".$Tnome."',
					loc_rua = '".$Tlogradouro."',
					loc_cep = '".$Tcep."',
					loc_num = ".$Tnumero.", 
					loc_horario = '".$ThoraInicio."',
					loc_email = '".$Temail."',
					loc_fone = '".$Tfone."',
					loc_fax = '".$Tfax."',
					loc_horario2 = '".$ThoraFinal."',
					loc_complemento = '".$Tcomplemento."',
					loc_horario3 = '".$ThoraInicio2."',
					loc_horario4 = '".$ThoraFinal2."',
					loc_bairro = '".$Tbairro."',
					loc_entidade_id = '".$Tentidade."' 					
				WHERE 
					loc_id =".$_GET['locId'];
}
//-----------------------------------
// Insere os dados no banco de dados
//-----------------------------------
$Tinsert = $drive->pedido($sql);

if( $_GET['pagina'] != "locinclui" ){
	if( $Tentidade != (int)$_SESSION['SuserEnt'] ){
		transportar($Tentidade,$_GET['locId'], $drive );
	}
}


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
	<form method=\"post\" action=\"?pagina=loccad&menu=".$_GET['menu']."\">
		<br />
		<br />
		".$Tmsg2."	
		<br />
		<br />
		<input type=\"submit\" onclick=\"document.getElementById('popup').style.display = 'none';\" value=\"Voltar\">			
	</form>";			
	MsgSql($Tmsg, 100, 400);	
}

//------------------------------------------------
// Function atualizar a entidade em setor
//------------------------------------------------	
function transportar($TentidadeID,$TlocalID, $drive ){

	// Transportar Setores
	$sqlSetor = "UPDATE setores 
	                SET setor_entidade_id = '$TentidadeID' 
				  WHERE setor_local_id  = '$TlocalID' ";
	$Tupdate = $drive->pedido( $sqlSetor );

	// Transportar Colaboradores
	$sqlSetor = "UPDATE uni_usuarios 
	               SET user_entidade_id = '$TentidadeID' 
				 WHERE user_setor_id  in ( select setor_id From setores where setor_local_id = '$TlocalID' ) ";
	$Tupdate = $drive->pedido( $sqlSetor );

	// Transportar Cargos	
	$sqlSetor = "UPDATE cargos 
	               SET cargo_entidade_id = '$TentidadeID' 
				 WHERE cargo_id  in ( select user_cargo_id 
				                        From uni_usuarios 
									   where user_setor_id in ( select setor_id From setores where setor_local_id = '$TlocalID' )  ) ";
	$Tupdate = $drive->pedido( $sqlSetor );

}