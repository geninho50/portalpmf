<?php

function verificaCPF($cpf){
	
	$cpf = str_replace('.', '', $cpf);
	$cpf = str_replace('-', '', $cpf);

	//Conta os digitos
	if(strlen($cpf) != 11){
		return false;
	}

	$somatorio = 0;
	//Obtem o primeiro somatorio
	for ($i=0; $i < 9; $i++) { 
		$somatorio = $somatorio + ((10-$i) * $cpf[$i]);
	}

	//Obtem o resto de MOD 11
	$resto = $somatorio % 11;

	//Se menor que 2, primeiro digito eh 1
	if($resto < 2){
		$digitoUm = 0;
	} else {
		$digitoUm = 11 - $resto;
	}

	$somatorio = 0;
	//Obtem o segundo somatorio
	for ($i=0; $i < 10; $i++) { 
		$somatorio = $somatorio + ((11-$i) * $cpf[$i]);
	}

	//Obtem o resto de MOD 11
	$resto = $somatorio % 11;

	//Se menor que 2, primeiro digito eh 1
	if($resto < 2){
		$digitoDois = 0;
	} else {
		$digitoDois = 11 - $resto;
	}

	if(substr($cpf, 9, 2) != $digitoUm.$digitoDois){
		return false;
	}

	for ($i=0; $i < 10; $i++) { 
		if(strlen(str_replace($i, '', $cpf)) == 0){
			return false;
		}
	}

	return true;
}

?>