<?php

require_once("../scripts/php/config.php");	
include "../scripts/php/funcoes_bd.php";
$drive->conecta();
$sqlUser				= "SELECT * FROM uni_usuarios ORDER BY user_nome";
$TreturnUser			= $drive->pedido($sqlUser);
$TuserDados				= pg_fetch_all($TreturnUser);
$TuserNome				= $TuserDados->user_nome;

foreach($TuserDados as $value ){

	//transforma em MD5 caso ainda nao esteja
	if(strlen($value["user_login"]) < 32 && $value["user_login"] != ''){
		$loginMD5 = md5($value["user_login"]);
		$userID = $value["user_id"];	
		$conexao = $drive->conecta();
		$insetQr = $drive->pedido( "UPDATE uni_usuarios SET user_login = '$loginMD5' WHERE user_id = '$userID';" );
		if($insetQr){echo "login <b>".$value["user_login"]."</b> alterado para <b>".$loginMD5."</b><br>";}
	}
}
