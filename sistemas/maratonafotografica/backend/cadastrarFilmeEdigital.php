<?php
require_once("db-comum.php"); 

$modalidade  = utf8_decode($_POST['modalidade']);

if ($modalidade == 0) {
	$and = 'AND modalidade = 0';
} else if ($modalidade == 1 || $modalidade == 2) {
	$and = 'AND modalidade IN(1, 2)';
}

$sql = "SELECT COUNT(*) AS qtd FROM filmeEdigital WHERE ano = ".date("Y")." $and ";
$result = $conn->query($sql);
$result = $result->fetch_assoc();
$ok = 0;

if ($modalidade == 0) {
	if($result['qtd'] < 20){
	    $ok = 1;
	} 
} else if ($modalidade == 1 || $modalidade == 2 || $modalidade == 3) {
	if($result['qtd'] < 345){
	    $ok = 1;
	} 
}


if($ok){

require_once("db.php"); 


$nome                = utf8_decode($_POST['nome']);
$dataNasc            = utf8_decode($_POST['dataNasc']);
$nacionalidade       = utf8_decode($_POST['nacionalidade']);
$email               = utf8_decode($_POST['email']);
$telefone            = utf8_decode($_POST['telefone']);
$celular             = utf8_decode($_POST['celular']);
$equipamento         = utf8_decode($_POST['equipamento']);
$endereco            = utf8_decode($_POST['endereco']);
$bairro              = utf8_decode($_POST['bairro']);
$cidade              = utf8_decode($_POST['cidade']);
$cep                 = utf8_decode($_POST['cep']);
$profissao       	 = utf8_decode($_POST['profissao']);
$localTrabalho       = utf8_decode($_POST['localTrabalho']);
$banco               = utf8_decode($_POST['banco']);
$agencia             = utf8_decode($_POST['agencia']);
$bancoNum            = utf8_decode($_POST['bancoNum']);
$contaNum            = utf8_decode($_POST['contaNum']);
$cpf            	 = utf8_decode($_POST['cpf']);
$rg           	     = utf8_decode($_POST['rg']);
$ano                 = date("Y");


$sql = "SELECT count(*) as qtd FROM filmeEdigital WHERE ano = ".$ano." AND cpf= '" . $cpf . "'";
$result = $conn->query($sql);
$result = $result->fetch_assoc();

if ($result['qtd'] > 0) {
	$erro = 'CPF JÁ CADASTRADO';
	echo json_encode(array('sucesso' => 0, 'erro' => $erro, 'idErro' => $cpf));
	die;
}

function verificaVazio($var, $campo, $campoClass) {
	if(empty($var)){
		$erro = 'O Campo "'.$campo.'" não pode ficar em branco';
		echo json_encode(array('sucesso' => 0, 'erro' => $erro, 'idErro' => $campoClass));
		die;
	}
}


verificaVazio($nome, 'nome', 'nome' );
verificaVazio($dataNasc, 'Data de Nascimento', 'dataNasc' );
verificaVazio($nacionalidade, 'Nacionalidade', 'nacionalidade' );
verificaVazio($email, 'Email', 'email' );
verificaVazio($telefone, 'Telefone', 'telefone' );
verificaVazio($celular, 'celular', 'celular' );
verificaVazio($equipamento, 'Equipamento', 'equipamento' );
verificaVazio($endereco, 'Endereço', 'endereco' );
verificaVazio($bairro, 'Bairro', 'bairro' );
verificaVazio($cidade, 'Cidade', 'cidade' );
verificaVazio($cep, 'CEP', 'cep' );
verificaVazio($localTrabalho, 'Local de Trabalho', 'localTrabalho' );
verificaVazio($profissao, 'Profissão', 'profissao' );
verificaVazio($banco, 'Banco', 'banco' );
verificaVazio($agencia, 'Agencia', 'agencia' );
verificaVazio($bancoNum, 'N° do Banco', 'bancoNum' );
verificaVazio($contaNum, 'N° da Conta', 'contaNum' );
verificaVazio($cpf, 'CPF', 'cpf' );
verificaVazio($rg, 'RG', 'rg' );

$dataNasc = explode('/', $dataNasc);
$dataNasc = $dataNasc[2]  . "-" . $dataNasc[1] . "-" . $dataNasc[0];

$insertQuery = $db->prepare("INSERT INTO filmeEdigital 
							 (nome, dataNasc, modalidade, email, telefone, celular, equipamento, endereco, bairro, cidade, cep, localTrabalho, profissao,  banco, agencia, bancoNum, contaNum, nacionalidade, cpf, rg, ano)
							 VALUES 
							 	(:nome, :dataNasc, :modalidade, :email, :telefone, :celular, :equipamento, :endereco, :bairro, :cidade, :cep, :localTrabalho, :profissao, :banco, :agencia, :bancoNum, :contaNum, :nacionalidade, :cpf, :rg, :ano)");

$insertQuery->bindParam(':nome', $nome);
$insertQuery->bindParam(':dataNasc', $dataNasc);
$insertQuery->bindParam(':modalidade', $modalidade);
$insertQuery->bindParam(':email', $email);
$insertQuery->bindParam(':telefone', $telefone);
$insertQuery->bindParam(':celular', $celular);
$insertQuery->bindParam(':equipamento', $equipamento);
$insertQuery->bindParam(':endereco', $endereco);
$insertQuery->bindParam(':bairro', $bairro);
$insertQuery->bindParam(':cidade', $cidade);
$insertQuery->bindParam(':cep', $cep);
$insertQuery->bindParam(':localTrabalho', $localTrabalho);
$insertQuery->bindParam(':profissao', $profissao);
$insertQuery->bindParam(':banco', $banco);
$insertQuery->bindParam(':agencia', $agencia);
$insertQuery->bindParam(':bancoNum', $bancoNum);
$insertQuery->bindParam(':contaNum', $contaNum);
$insertQuery->bindParam(':nacionalidade', $nacionalidade);
$insertQuery->bindParam(':cpf', $cpf);
$insertQuery->bindParam(':rg', $rg);
$insertQuery->bindParam(':ano', $ano);

$execute = $insertQuery->execute();

if($execute){
	session_start();
	$_SESSION['id'] = $db->lastInsertId();
	echo json_encode(array('sucesso' => 1));
}else{
	echo json_encode(array('sucesso' => 0, 'erro' => 'Falha ao enviar', 'classe' => 'geral'));
}

}else{
	echo json_encode(array('sucesso' => 0, 'erro' => 'Número máximo de inscrições atingido.', 'classe' => 'geral'));
}

?>