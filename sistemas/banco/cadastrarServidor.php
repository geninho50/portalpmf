<?php

include_once("gdb.php"); 

$gdb = new gdb();  

$nome     		     = $gdb->vargetpost('nome');
$matricula       	 = $gdb->vargetpost('matricula');
$cpf       	 		 = $gdb->vargetpost('cpf');
$secAtua			 = $gdb->vargetpost('secAtua');
$situacao			 = $gdb->vargetpost('situacao');
$idSecretaria 		 = $gdb->vargetpost('idSecretaria');
$idpreEquipeJISF     = $gdb->vargetpost('idpreEquipeJISF');

if ($matricula == '' AND $cpf == '') {
	echo json_encode(array('error' => "Preencha a Matrícula ou CPF"));
} else {

if($situacao == 'efetivo') {
	$cpfmatritula = $matricula;
} else {
	$cpfmatritula = $cpf;
}


	$gdb->open("SELECT idServidor FROM servidorJISF WHERE matricula = '$cpfmatritula'");
	$codigoServidor =  $gdb->gs["IDSERVIDOR"][0];


		if($gdb->linhas != 0){	

		$gdb->open("SELECT idSecretaria FROM servidorJISF WHERE idServidor = '$codigoServidor'");
		$codigoScretaria =  $gdb->gs["IDSECRETARIA"][0];

			if ($codigoScretaria == $idSecretaria) {
				/* Aqui limita 15 alunos por equipe */
			$gdb->open("SELECT idpreEquipeJISF FROM preEquipeServidor WHERE idpreEquipeJISF = '$idpreEquipeJISF' ");

				if($gdb->linhas < 15) {	

					/* Confere se esse servidor já nao está nessa equipe */
					$gdb->open("SELECT idServidor, idpreEquipeJISF FROM preEquipeServidor WHERE idServidor = '$codigoServidor' AND idpreEquipeJISF = '$idpreEquipeJISF' ");

							if($gdb->linhas != 0){
								echo json_encode(array('error' => "Servidor já esta nessa equipe!"));

							} else { 

								$gdb->open("INSERT INTO preEquipeServidor ( idServidor, idpreEquipeJISF) VALUES ( '$codigoServidor','$idpreEquipeJISF') ");

								echo json_encode(array('success' => 1));	

								}

				} else {
					echo json_encode(array('error' => "Equipe já possui 15 servidores cadastrados nessa equipe!"));
				}	

			} else {
				echo json_encode(array('error' => "Servidor já pertence a outra Secretaria!"));
			}
		
			
		} else {

			$gdb->open("SELECT nome FROM secretariaJISF WHERE idSecretaria = '$idSecretaria' ");
			$nomeSec =  $gdb->gs["NOME"][0];
		
		    /*Confere se já possui 2 servidores de outra secretaria */

			$gdb->open("SELECT secAtua from servidorJISF where secAtua != '$nomeSec' AND idSecretaria = '$idSecretaria'");

				if($gdb->linhas > 1 AND $nomeSec != $secAtua){

				echo json_encode(array('error' => "Essa secretaria já possue 2 servidores emprestado de outra secretaria"));

				} else {
				/* Insere o servidor*/
				$gdb->open("INSERT INTO servidorJISF (nome, matricula, situacao, secAtua, idSecretaria) VALUES ( '$nome', '$cpfmatritula','$situacao', '$secAtua', '$idSecretaria')");

				/* Pega o id do servidor*/
				$gdb->open("SELECT idServidor FROM servidorJISF WHERE matricula = '$cpfmatritula' ");
				$codigoServidor =  $gdb->gs["IDSERVIDOR"][0];

				
				$gdb->open("SELECT idpreEquipeJISF FROM preEquipeServidor WHERE idpreEquipeJISF = '$idpreEquipeJISF' ");

				/* Confere se já tem 15 na modalidade*/
				 if($gdb->linhas < 15){	
					$gdb->open("INSERT INTO preEquipeServidor ( idServidor, idpreEquipeJISF) VALUES ( '$codigoServidor','$idpreEquipeJISF') ");
					echo json_encode(array('success' => 1));

				} else {
					echo json_encode(array('error' => "Equipe já possui 15 servidores cadastrados!"));

				}
			}
		}
 }
?>