<?php

function verificaNovaCertidao($certidao){
	
	$temp = str_replace('.', '', $certidao);
	$temp = str_replace('-', '', $temp);

	if(strlen($temp) != 32){
		return false;
	}

	if(!ctype_digit($temp)){
		return false;
	}

	$numero = substr($temp, 0, 30);
	$multiplicadores = [2, 3, 4, 5, 6, 7, 8, 9, 0, 0, 1, 2, 3, 4, 0, 6, 7, 8, 9, 10, 0, 1, 2, 3, 4, 5, 6, 7, 8, 9];

	$soma = 0;

	for ($i=0; $i < 30; $i++) { 
		$soma = $soma + ($numero[$i] * $multiplicadores[$i]);
	}

	$resto = $soma % 11;

	if($resto == 10){
		$digitoUm = 1;
	} else {
		$digitoUm = $resto;
	}

	$multiplicadores = [1, 2, 3, 4, 5, 6, 7, 8, 0, 0, 0, 1, 2, 3, 0, 5, 6, 7, 8, 9, 10, 0, 1, 2, 3, 4, 5, 6, 7, 8, 9];

	$soma = 0;
	$numero = $numero.$digitoUm;

	for ($i=0; $i < 31; $i++) { 
		$soma = $soma + ($numero[$i] * $multiplicadores[$i]);
	}

	$resto = $soma % 11;

	if($resto == 10){
		$digitoDois = 1;
	} else {
		$digitoDois = $resto;
	}

	$numero = $numero.$digitoDois;

	if ($numero != $temp){
		return false;
	}

	return true;
}

?>