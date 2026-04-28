<?php

include("funcoes_bd.php"); 
include("config.php");	

$entidade_id = $_POST['entidade_id'];
$drive->conecta();

$sqlSetor	= "SELECT * FROM setores WHERE setor_entidade_id = $entidade_id ORDER BY setor_nome";
$TresultSet  	= $drive->pedido($sqlSetor);
$Setor 	 	= pg_fetch_all($TresultSet);

$setor_option = "";
if($Setor){
	foreach($Setor as $value ){
		$setor_option .=  "<option value='".$value['setor_id']."'>".$value['setor_nome']."</option>";
	}
}

$sqlCargo	= "SELECT * FROM cargos WHERE cargo_entidade_id = $entidade_id ORDER BY cargo_nome";
$TresultCargo  	= $drive->pedido($sqlCargo);
$Cargo 	 	= pg_fetch_all($TresultCargo);	

$cargo_option = "";
if($Cargo){
	foreach($Cargo  as $value ){
		$cargo_option .=  "<option value='".$value['cargo_id']."'>".$value['cargo_nome']."</option>";
	}
}

echo json_encode(array('setor' => $setor_option, 'cargo' => $cargo_option));