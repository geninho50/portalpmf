<?php
	include_once("gdb.php"); 

	$gdb = new gdb();  
	
	$nome = $gdb->vargetpost('nome');
	$secretaria = $gdb->vargetpost('secretaria');
	$identificacao = $gdb->vargetpost('identificacao');

	$palestras = $gdb->vargetpost('palestras');

	/* Verifica se o funcionario já está cadastrado */
	$gdb->open("SELECT identificacao FROM funcionario WHERE identificacao = '$identificacao' ");

	if($gdb->linhas < 500){	
		
		$gdb->open("INSERT INTO funcionario (nome, secretaria, identificacao) VALUES ('$nome', '$secretaria', '$identificacao')");
		
		//pegar id funcionario
		$gdb->open("SELECT idfuncionario FROM funcionario WHERE identificacao = '$identificacao' ");

		$idfuncionario = $gdb->gs['IDFUNCIONARIO'][0];

		//foreach no palestras inserindo no inscricao
		foreach($palestras as $palestra){
			$gdb->open("INSERT INTO inscricao (idfuncionario, idpalestra) VALUES ('$idfuncionario', '$palestra')");
		}
		echo json_encode(array('success' => 1));
	} else {
		echo json_encode(array('error' => "Funcionario já foi cadastrado!".$gdb->linhas));
	}

?>