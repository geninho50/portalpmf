<?php
include_once("/home/www/sistemas/banco/gdb.php"); 

class participante extends gdb {

	function buscaDadosParticipante($codigoUsuario64) {
		$this->open("SELECT p.nome, p.cpf, p.identidade, e.cep, e.logradouro, e.numero, e.bairro, p.telefone, p.celular, p.email, d.docIdentificacao, d.comprovanteResidencia, d.comprovanteResidenciaComplementar
					FROM backend.pessoa p
					LEFT JOIN backend.pessoaEndereco e ON e.codigoPessoa = p.codigoPessoa
					LEFT JOIN backend.usuario u ON u.login = p.email
					LEFT JOIN backend.documentoPessoaMNC d ON d.codigoPessoa = p.codigoPessoa
					WHERE u.codigoUsuario = '$codigoUsuario64'");
		return $this->gs;
	}

	function buscaCodigoPessoa($codigoUsuario) {
		$this->open("SELECT p.codigoPessoa FROM pessoa p JOIN usuario u ON p.email = u.login WHERE u.codigoUsuario = '$codigoUsuario'");
		return $this->gs["CODIGOPESSOA"][0];
	}

	function atualizaDadosPessoa($nome, $email, $telefone, $celular, $codigoPessoa) {
		return $this->open("UPDATE pessoa SET nome = '$nome', email = '$email', telefone = '$telefone', celular = '$celular' WHERE codigoPessoa = '$codigoPessoa'");
	}

	function atualizaDadosPessoaEndereco($cep, $logradouro, $numero, $bairro, $codigoPessoa) {
		return $this->open("UPDATE pessoaEndereco SET cep = '$cep', logradouro = '$logradouro', numero = '$numero', bairro = '$bairro' WHERE codigoPessoa = '$codigoPessoa'");
	}
	
	function atualizaUsuario($email, $codigoUsuario) {
		return $this->open("UPDATE usuario SET login = '$email' WHERE codigoUsuario = '$codigoUsuario'");
	}

	function insereDocumentoPessoa($codigoPessoa, $docIdentificacao, $comprovanteResidencia, $comprovanteResidenciaComplementar) {
		return $this->open("INSERT INTO documentoPessoaMNC (codigoPessoa, docIdentificacao, comprovanteResidencia, comprovanteResidenciaComplementar) VALUES ($codigoPessoa, $docIdentificacao, $comprovanteResidencia, $comprovanteResidenciaComplementar)");
	}

	function insereAtualizaDocumentoPessoa($codigoPessoa, $docIdentificacao = '', $comprovanteResidencia = '', $comprovanteResidenciaComplementar = '') {
		$documentoPessoa = $this->buscaDocumentoPessoa($codigoPessoa);

		if(empty($documentoPessoa)){
			return $this->insereDocumentoPessoa($codigoPessoa, $docIdentificacao, $comprovanteResidencia, $comprovanteResidenciaComplementar);		
		} else {
			if(empty($docIdentificacao)) {
				$docIdentificacao = $documentoPessoa['DOCIDENTIFICACAO'][0];
			} 

			if(empty($comprovanteResidencia)) {
				$comprovanteResidencia = $documentoPessoa['COMPROVANTERESIDENCIA'][0];
			}

			if(empty($comprovanteResidenciaComplementar)) {
				$comprovanteResidenciaComplementar = $documentoPessoa['COMPROVANTERESIDENCIACOMPLEMENTAR'][0];
			}

			return $this->open("UPDATE documentoPessoaMNC SET docIdentificacao = '$docIdentificacao', comprovanteResidencia = '$comprovanteResidencia', comprovanteResidenciaComplementar = '$comprovanteResidenciaComplementar' WHERE codigoPessoa = '$codigoPessoa'");
		}
	}

	function buscaDocumentoPessoa($codigoPessoa) {
		$this->open("SELECT docIdentificacao, comprovanteResidencia, comprovanteResidenciaComplementar FROM documentoPessoaMNC WHERE codigoPessoa = '$codigoPessoa'");
		return $this->gs;
	}
}