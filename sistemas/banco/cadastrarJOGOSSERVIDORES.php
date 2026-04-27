<?php

include_once("gdb.php"); 

$gdb = new gdb();  
$gdb2 = new gdb(); 

$nome         		 = $gdb->vargetpost('nome');
$responsavel         = $gdb->vargetpost('responsavel');
$telefone     		 = $gdb->vargetpost('telefone');
$celular       	     = $gdb->vargetpost('celular');
$email     		     = $gdb->vargetpost('email');
$senha     		     = $gdb->vargetpost('senha');


$gdb->open("SELECT login FROM usuario WHERE UPPER(login) = UPPER('$email') ");

if ($gdb->linhas != 0) {
	echo json_encode(array('error' => "Este email já esta sendo usado!"));

} else {

	$gdb->open("SELECT nome FROM secretariaJISF WHERE nome = ('$nome') ");

	if ($gdb->linhas != 0) {

		echo json_encode(array('error' => "Sua Secretaria já está inscrita."));

	} else {

			if($gdb->open("INSERT INTO secretariaJISF ( nome,								 
														 responsavel, 
														 telefone,
														 celular,
														 email )
														VALUES ( '$nome',									  
																 '$responsavel',
																 '$telefone',
																 '$celular',
																 '$email')")){
				$senha = md5($senha);

				$gdb->open("INSERT INTO usuario ( login,
												  nome,
												  senha,
												  codigoProjeto,
												  status,
												  perfil )
												VALUES ('$email', 
														'$nome',
														'$senha',
														'JISF',
														'1',
														'P')");	

				echo json_encode(array('success' => 1));

			} else {

				echo json_encode(array('error' => 0));

			}
 	
		}
}
								 
										 
?>