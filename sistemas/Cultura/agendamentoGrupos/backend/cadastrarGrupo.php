<?php
require_once("db.php"); 

$nome                 = utf8_decode($_POST['nome']);
$logradouro           = utf8_decode($_POST['logradouro']);
$numero  		 	  = utf8_decode($_POST['numero']);
$complemento  		  = utf8_decode($_POST['complemento']);
$municipio  		  = utf8_decode($_POST['municipio']);
$bairro               = utf8_decode($_POST['bairro']);
$cep                  = utf8_decode($_POST['cep']);
$telefone             = utf8_decode($_POST['telefone']);
$celular              = utf8_decode($_POST['celular']);
$email1               = utf8_decode($_POST['email1']);
$email2               = utf8_decode($_POST['email2']);
$turma                = utf8_decode($_POST['turma']);
$faixaEtaria          = utf8_decode($_POST['faixaEtaria']);
$titulo               = utf8_decode($_POST['titulo']);
$data      		      = utf8_decode($_POST['data']);
$horario              = utf8_decode($_POST['horario']);
$local                = utf8_decode($_POST['local']);
$ingressosEstudantes 	 = utf8_decode($_POST['ingressosEstudantes']);
$ingressosProfissionais  = utf8_decode($_POST['ingressosProfissionais']);
$nomeResponsavel         = utf8_decode($_POST['nomeResponsavel']);
$foneResponsa    		 = utf8_decode($_POST['foneResponsa']);
$emailResponsa     		 = utf8_decode($_POST['emailResponsa']);



function verificaVazio($var, $campo, $campoClass) {
	if(empty($var)){
		$erro = 'O Campo "'.$campo.'" não pode ficar em branco';
		echo json_encode(array('sucesso' => 0, 'erro' => $erro, 'idErro' => $campoClass));
		die;
	}
}


verificaVazio($nome, 'nome', 'nome' );
verificaVazio($logradouro, 'Endereço', 'logradouro' );
verificaVazio($numero, 'numero', 'numero' );
verificaVazio($complemento, 'complemento', 'complemento' );
verificaVazio($municipio, 'Municipio', 'municipio' );
verificaVazio($bairro, 'Bairro', 'bairro' );
verificaVazio($cep, 'CEP', 'cep' );
verificaVazio($telefone, 'Telefone', 'telefone' );
verificaVazio($celular, 'celular', 'celular' );
verificaVazio($email1, 'Email 1', 'email1' );
verificaVazio($email2, 'Email 2', 'email2' );
verificaVazio($turma, 'turma', 'turma' );
verificaVazio($faixaEtaria, 'faixaEtaria', 'faixaEtaria' );
verificaVazio($titulo, 'Título', 'titulo' );
verificaVazio($data, 'data', 'data' );
verificaVazio($horario, 'horario', 'horario' );
verificaVazio($local, 'local', 'local' );
verificaVazio($ingressosEstudantes, 'Ingressos Estudantes', 'ingressosEstudantes' );
verificaVazio($ingressosProfissionais, 'Ingressos Profissionais', 'ingressosProfissionais' );
verificaVazio($nomeResponsavel, 'Nome do Responsavel', 'nomeResponsavel' );
verificaVazio($foneResponsa, 'Telefone do Responsavel', 'foneResponsa' );
verificaVazio($emailResponsa, 'Email do Responsavel', 'emailResponsa' );


$insertQuery = $db->prepare("INSERT INTO agendamentoGrupos 
							 (nome, logradouro, numero, complemento, municipio, bairro, cep, telefone, celular, email1, email2, turma, faixaEtaria, titulo, data, horario,  local, ingressosEstudantes, ingressosProfissionais, nomeResponsavel, foneResponsa, emailResponsa)
							 VALUES 
							 	(:nome, :logradouro, :numero, :complemento, :municipio, :bairro, :cep, :telefone, :celular, :email1, :email2, :turma, :faixaEtaria, :titulo, :data, :horario, :local, :ingressosEstudantes, :ingressosProfissionais, :nomeResponsavel, :foneResponsa, :emailResponsa)");

$insertQuery->bindParam(':nome', $nome);
$insertQuery->bindParam(':logradouro', $logradouro);
$insertQuery->bindParam(':numero', $numero);
$insertQuery->bindParam(':complemento', $complemento);
$insertQuery->bindParam(':municipio', $municipio);
$insertQuery->bindParam(':bairro', $bairro);
$insertQuery->bindParam(':cep', $cep);
$insertQuery->bindParam(':telefone', $telefone);
$insertQuery->bindParam(':celular', $celular);
$insertQuery->bindParam(':email1', $email1);
$insertQuery->bindParam(':email2', $email2);
$insertQuery->bindParam(':turma', $turma);
$insertQuery->bindParam(':faixaEtaria', $faixaEtaria);
$insertQuery->bindParam(':titulo', $titulo);
$insertQuery->bindParam(':data', $data);
$insertQuery->bindParam(':horario', $horario);
$insertQuery->bindParam(':local', $local);
$insertQuery->bindParam(':ingressosEstudantes', $ingressosEstudantes);
$insertQuery->bindParam(':ingressosProfissionais', $ingressosProfissionais);
$insertQuery->bindParam(':nomeResponsavel', $nomeResponsavel);
$insertQuery->bindParam(':foneResponsa', $foneResponsa);
$insertQuery->bindParam(':emailResponsa', $emailResponsa);

$execute = $insertQuery->execute();

		if($execute){
			session_start();
			$_SESSION['id'] = $db->lastInsertId();
			echo json_encode(array('sucesso' => 1));
		}else{
			echo json_encode(array('sucesso' => 0, 'erro' => 'Falha ao enviar', 'classe' => 'geral'));
		}


?>