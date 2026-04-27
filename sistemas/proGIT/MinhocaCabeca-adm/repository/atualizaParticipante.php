<?php
include_once("../../banco/gdb.php");
include_once("participante.php");

$participante = new participante();

$codigoUsuario = base64_decode($participante->vargetpost('codigoUsuario'));

$nome = $participante->vargetpost('nome'); 
$cep = $participante->vargetpost('cep');
$logradouro = $participante->vargetpost('logradouro');
$bairro = $participante->vargetpost('bairro');
$numero = $participante->vargetpost('numero');
$telefone = $participante->vargetpost('telefone');
$celular = $participante->vargetpost('celular');
$email = $participante->vargetpost('email');

$codigoPessoa = $participante->buscaCodigoPessoa($codigoUsuario);
$documentoPessoa = $participante->buscaDocumentoPessoa($codigoPessoa);

if($participante->atualizaDadosPessoa($nome, $email, $telefone, $celular, $codigoPessoa)){
	if($participante->atualizaDadosPessoaEndereco($cep, $logradouro, $numero, $bairro, $codigoPessoa)){
		if($participante->atualizaUsuario($email, $codigoUsuario)){
			if(!is_dir("../documentosParticipantes/".$codigoPessoa)){
				mkdir("../documentosParticipantes/".$codigoPessoa);
			}

			if(!($_FILES['docIdentificacao']['name'] == '' || $_FILES['docIdentificacao']['name'] == null)) {
				$fileNameDocIdentificacao = $_FILES['docIdentificacao']['name'];
				$sourcePathDocIdentificacao = $_FILES['docIdentificacao']['tmp_name'];
			    $targetPathDocIdentificacao = "../documentosParticipantes/".$codigoPessoa."/".$fileNameDocIdentificacao;
			    if(!move_uploaded_file($sourcePathDocIdentificacao,$targetPathDocIdentificacao)){
			        echo json_encode(array('erro' => 'Ocorreu um erro ao realizar o upload do seu Documento de Identificação.'));
			        die();
			    }
			} else {
				if($documentoPessoa['DOCIDENTIFICACAO'][0] == '' || $documentoPessoa['DOCIDENTIFICACAO'][0] == null) {
					echo json_encode(array('erro' => 'Você deve incluir um Documento de Identificação.'));
			        die();
				}
			
			}

			if(!($_FILES['comprovanteResidencia']['name'] == '' || $_FILES['comprovanteResidencia']['name'] == null)) {
			    $fileNameComprovanteResidencia = $_FILES['comprovanteResidencia']['name'];
				$sourcePathComprovanteResidencia = $_FILES['comprovanteResidencia']['tmp_name'];
			    $targetPathComprovanteResidencia = "../documentosParticipantes/".$codigoPessoa."/".$fileNameComprovanteResidencia;
			    if(!move_uploaded_file($sourcePathComprovanteResidencia,$targetPathComprovanteResidencia)){
			        echo json_encode(array('erro' => 'Ocorreu um erro ao realizar o upload do seu Comprovante de Residência.'));
			        die();
			    }
			} else {
				if($documentoPessoa['COMPROVANTERESIDENCIA'][0] == '' || $documentoPessoa['COMPROVANTERESIDENCIA'][0] == null) {
					echo json_encode(array('erro' => 'Você deve incluir um Comprovante de Residência.'));
			        die();
				}
			
			}

			if(!($_FILES['comprovanteResidenciaComplementar']['name'] == '' || $_FILES['comprovanteResidenciaComplementar']['name'] == null)) {
			    $fileNameComprovanteResidenciaComplementar = $_FILES['comprovanteResidenciaComplementar']['name'];
				$sourcePathComprovanteResidenciaComplementar = $_FILES['comprovanteResidenciaComplementar']['tmp_name'];
			    $targetPathComprovanteResidenciaComplementar = "../documentosParticipantes/".$codigoPessoa."/".$fileNameComprovanteResidenciaComplementar;
			    if(!move_uploaded_file($sourcePathComprovanteResidenciaComplementar,$targetPathComprovanteResidenciaComplementar)){
			        echo json_encode(array('erro' => 'Ocorreu um erro ao realizar o upload do seu Comprovante de Residência Complementar.'));
			        die();
			    }
			}

			if($participante->insereAtualizaDocumentoPessoa($codigoPessoa, $fileNameDocIdentificacao, $fileNameComprovanteResidencia, $fileNameComprovanteResidenciaComplementar)) {
				echo json_encode(array('retorno' => 1));	
			} else {
				echo json_encode(array('erro' => 'Ocorreu um erro ao atualizar os anexos das suas documentações.'));
				die();			
			}
			
		} else {
			echo json_encode(array('erro' => 'Ocorreu um erro ao atualizar seu e-mail de usuário.'));
			die();		
		}
	} else {
		echo json_encode(array('erro' => 'Ocorreu um erro ao atualizar seu endereço.'));
		die();
	}
} else {
	echo json_encode(array('erro' => 'Ocorreu um erro ao atualizar seus dados pessoais.'));
	die();
}