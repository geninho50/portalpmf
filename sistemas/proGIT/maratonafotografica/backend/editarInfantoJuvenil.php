<?php
ini_set('display_errors', 1);
ini_set('log_errors', 1);
error_reporting(E_ALL);
require_once("db.php");

$nome                = utf8_decode($_POST['nome']); 
$dataNasc            = utf8_decode($_POST['dataNasc']);
$nacionalidade       = utf8_decode($_POST['nacionalidade']);
$faixaEtaria         = utf8_decode($_POST['faixaEtaria']);
$email               = utf8_decode($_POST['email']);
$telefone            = utf8_decode($_POST['telefone']);
$celular             = utf8_decode($_POST['celular']);
$equipamento         = utf8_decode($_POST['equipamento']);
$endereco            = utf8_decode($_POST['endereco']);
$bairro              = utf8_decode($_POST['bairro']);
$cidade              = utf8_decode($_POST['cidade']);
$cep                 = utf8_decode($_POST['cep']);
$instituicaoEnsino   = utf8_decode($_POST['instituicaoEnsino']);
$instituicaoTelefone = utf8_decode($_POST['instituicaoTelefone']);
$responsavelNome     = utf8_decode($_POST['responsavelNome']);
$responsavelProfissao= utf8_decode($_POST['responsavelProfissao']);
$responsavelRG       = utf8_decode($_POST['responsavelRG']);
$responsavelCPF      = utf8_decode($_POST['responsavelCPF']);
$banco               = utf8_decode($_POST['banco']);
$agencia             = utf8_decode($_POST['agencia']);
$bancoNum            = utf8_decode($_POST['bancoNum']);
$contaNum            = utf8_decode($_POST['contaNum']);
$parentesco          = utf8_decode($_POST['parentesco']);
$cpf                 = utf8_decode($_POST['cpf']);
$id                  = utf8_decode($_POST['id']);

verificaVazio($nome, 'nome', 'nome' );
verificaVazio($nome, 'Data de Nascimento', 'dataNasc' );
verificaVazio($nacionalidade, 'Nacionalidade', 'nacionalidade' );
verificaVazio($faixaEtaria, 'Faixa Etaria', 'faixaEtaria' );
verificaVazio($email, 'Email', 'email' );
verificaVazio($telefone, 'Telefone', 'telefone' );
verificaVazio($celular, 'celular', 'celular' );
verificaVazio($equipamento, 'Equipamento', 'equipamento' );
verificaVazio($endereco, 'Endereço', 'endereco' );
verificaVazio($bairro, 'Bairro', 'bairro' );
verificaVazio($cidade, 'Cidade', 'cidade' );
verificaVazio($cep, 'CEP', 'cep' );
verificaVazio($instituicaoEnsino, 'Instituição de Ensino', 'instituicaoEnsino' );
verificaVazio($instituicaoTelefone, 'Telefone da Instituição', 'instituicaoTelefone' );
verificaVazio($responsavelNome, 'Nome do Responsável', 'responsavelNome' );
verificaVazio($responsavelRG, 'RG do responsável', 'responsavelRG' );
verificaVazio($responsavelCPF, 'CPF do Responsável', 'responsavelCPF' );
verificaVazio($banco, 'Banco', 'banco' );
verificaVazio($agencia, 'Agencia', 'agencia' );
verificaVazio($bancoNum, 'N° do Banco', 'bancoNum' );
verificaVazio($contaNum, 'N° da Conta', 'contaNum' );
verificaVazio($responsavelProfissao, 'Profissão do Responsável', 'responsavelProfissao' );
verificaVazio($parentesco, 'Parentesco', 'parentesco' );

$dataNasc = explode('/', $dataNasc);
$dataNasc = $dataNasc[2]  . "-" . $dataNasc[1] . "-" . $dataNasc[0];

function verificaVazio($var, $campo, $campoClass) {
	if(empty($var)){
		$erro = 'O Campo "'.$campo.'" não pode ficar em branco';
		echo json_encode(array('sucesso' => 0, 'erro' => $erro, 'idErro' => $campoClass));
		die;
	}
}

$insertQuery = $db->prepare("UPDATE infantoJuvenil 
                                      SET nome = ?, dataNasc = ?, faixaEtaria = ?,
                                      email = ?, telefone = ?, celular = ?, 
                                      equipamento = ?, endereco = ?, bairro = ?, 
                                      cidade = ?, cep = ?, instituicaoEnsino = ?, 
                                      responsavelNome = ?, responsavelRG  = ?, 
                                      responsavelCPF = ?, banco = ?, agencia = ?, cpf = ?,
                                      bancoNum = ?, ContaNum = ?, instituicaoTelefone = ?, 
                                      nacionalidade = ?, responsavelProfissao = ?, parentesco = ?
                                      WHERE id = ?");

$insertQuery->bindParam(1, $nome);
$insertQuery->bindParam(2, $dataNasc);
$insertQuery->bindParam(3, $faixaEtaria);
$insertQuery->bindParam(4, $email);
$insertQuery->bindParam(5, $telefone);
$insertQuery->bindParam(6, $celular);
$insertQuery->bindParam(7, $equipamento);
$insertQuery->bindParam(8, $endereco);
$insertQuery->bindParam(9, $bairro);
$insertQuery->bindParam(10, $cidade);
$insertQuery->bindParam(11, $cep);
$insertQuery->bindParam(12, $instituicaoEnsino);
$insertQuery->bindParam(13, $responsavelNome);
$insertQuery->bindParam(14, $responsavelRG);
$insertQuery->bindParam(15, $responsavelCPF);
$insertQuery->bindParam(16, $banco);
$insertQuery->bindParam(17, $agencia);
$insertQuery->bindParam(18, $cpf);
$insertQuery->bindParam(19, $bancoNum);
$insertQuery->bindParam(20, $contaNum);
$insertQuery->bindParam(21, $instituicaoTelefone);
$insertQuery->bindParam(22, $nacionalidade);
$insertQuery->bindParam(23, $responsavelProfissao);
$insertQuery->bindParam(24, $parentesco);
$insertQuery->bindParam(25, $id);

$execute = $insertQuery->execute();

if($execute) {
	session_start();
	$_SESSION['id'] = $db->lastInsertId();
	echo json_encode(array('sucesso' => 1));
} else {
	echo json_encode(array('sucesso' => 0, 'erro' => 'Falha ao enviar', 'classe' => 'geral'));
} 

?>