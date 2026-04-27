<?php

	include_once("gdb.php"); 

	$gdb = new gdb();  

	$nome     		     = $gdb->vargetpost('nome');
	$matricula       	 = $gdb->vargetpost('matricula');
	$nascimento          = $gdb->vargetpost('nascimento');
	$idEscola 		     = $gdb->vargetpost('idEscola');
	$idpreEquipe 		 = $gdb->vargetpost('idpreEquipe');

	/* Verifica se o aluno já está cadastrado */
	$gdb->open("SELECT idAluno FROM aluno WHERE matricula = '$matricula' ");
	$codigoAluno =  $gdb->gs["IDALUNO"][0];

		if($gdb->linhas != 0){	
		
			/* Aqui limita 25 alunos por equipe */
			$gdb->open("SELECT modalidade, genero, faixaEtaria, idEscola FROM preEquipe WHERE idEscola = '$idEscola' AND idpreEquipe = '$idpreEquipe' ");
			$faixaEtaria = $gdb->gs["FAIXAETARIA"][0];
			if($gdb->linhas < 25){	

				/* Confere se esse aluno já nao está nessa equipe */
				$gdb->open("SELECT idAluno, idpreEquipe FROM preEquipeAluno WHERE idAluno = '$codigoAluno' AND idpreEquipe = '$idpreEquipe' ");

				if($gdb->linhas != 0){
					echo json_encode(array('error' => "Aluno já esta nessa equipe!"));

				} else { 
					verificaFaixaEtaria($nascimento, $faixaEtaria);
					/* Insere o aluno na equipe */
					$gdb->open("INSERT INTO preEquipeAluno ( idAluno, idpreEquipe) VALUES ( '$codigoAluno','$idpreEquipe') ");

					echo json_encode(array('success' => 1));
				}

			} else {
				echo json_encode(array('error' => "Equipe já possui 25 alunos cadastrados!"));
			}	

		} else {
		
			/* Insere o aluno no banco e na equipe */

			verificaFaixaEtaria($nascimento, 0);
			$gdb->open("INSERT INTO aluno (nome, matricula, nascimento) VALUES ( '$nome', '$matricula','$nascimento' ) ");

			$gdb->open("SELECT idAluno FROM aluno WHERE matricula = '$matricula' ");
			$codigoAluno =  $gdb->gs["IDALUNO"][0];

			$gdb->open("SELECT modalidade, genero, faixaEtaria, idEscola FROM preEquipe WHERE idEscola = '$idEscola' AND idpreEquipe = '$idpreEquipe' ");

			if($gdb->linhas < 25){	
				verificaFaixaEtaria($nascimento, $faixaEtaria);
				$gdb->open("INSERT INTO preEquipeAluno ( idAluno, idpreEquipe) VALUES ( '$codigoAluno','$idpreEquipe') ");
				echo json_encode(array('success' => 1));

			} else {

				echo json_encode(array('error' => "Equipe já possui 25 alunos cadastrados!"));

			}
		}

	function verificaFaixaEtaria($nasc, $faixaEtaria) {
	    list($ano, $mes, $dia) = explode('-', $nasc);

	    // data atual
	    $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
	    // Descobre a unix timestamp da data de nascimento do fulano
	    $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);

	    // cálculo
	    $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);

	    switch ($faixaEtaria)
	    {
	    	case 0:
	            if(!($ano >= 2003 && $ano <= 2008)) {
	                $erro = 'A idade (' . $idade . ') do participante não condiz com a faixa etária de nenhuma modalidade';
	                echo json_encode(array('sucess' => 0, 'error' => $erro, 'idErro' => 'dataNasc'));
	                die;
	            }
	            break;
	        case '11 a 13':
	            if(!($ano >= 2006 && $ano <= 2008)) {
	                $erro = 'A idade (' . $idade . ') do participante não condiz com a faixa etária (11-13) escolhida';
	                echo json_encode(array('sucess' => 0, 'error' => $erro, 'idErro' => 'dataNasc'));
	                die;
	            }
	            break;
	        case '14 a 16':
	            if(!($ano >= 2003 && $ano <= 2005 )) {
	                $erro = 'A idade (' . $idade . ') do participante não condiz com a faixa etária (14-16) escolhida';
	                echo json_encode(array('sucess' => 0, 'error' => $erro, 'idErro' => 'dataNasc'));
	                die;
	            }
	            break;
	    }
	}

?>