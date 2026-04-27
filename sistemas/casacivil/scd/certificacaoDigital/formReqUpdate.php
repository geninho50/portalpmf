<?
include "db.php"; 
include "funcoes.php";

$id = $_POST['id'];
$nome = $_POST['nome'];
$nascimento = $_POST['nascimento'];
$cpf = $_POST['cpf'];
$rg = $_POST['rg'];
$orgaoEmissor = $_POST['orgaoEmissor'];
$estadoRg = $_POST['estadoRg'];
$pis = $_POST['pis'];
$cei = $_POST['cei'];
$titulo = $_POST['titulo'];
$zona = $_POST['zona'];
$secao = $_POST['secao'];
$cidade = $_POST['cidade'];
$estadoTitulo = $_POST['estadoTitulo'];
$email = $_POST['email'];
$tipoFuncionario = $_POST['funcionario'];

$nome  = utf8_decode ( $nome );
$entidade = utf8_decode ( $entidade ); 
validateEmpty($nome, "Nome", "nome");
$nova_data = explode("/", $nascimento);
$nascimento = "$nova_data[2]-$nova_data[1]-$nova_data[0]";
validateEmpty($nascimento, "Data de Nascimento", "nascimento");
validateEmpty($cpf, "CPF", "cpf");
validateCPF($cpf, "CPF");
validateEmpty($rg, "RG", "rg"); 

$rg = str_replace('.', '', $rg);
$rg = str_replace('-', '', $rg);
$rg = str_replace('/', '', $rg);

validateEmpty($orgaoEmissor, "Órgao Emissor", "orgaoEmissor");
validateEmpty($estadoRg, "Estado", "estadoRg"); 
validateEmpty($pis, "NIS/PIS/PASEP/NIT", "pis"); 
validateEmpty($cei, "CEI", "cei");
validateEmpty($titulo, "Titulo de Eleitor", "titulo");
validateEmpty($zona, "Zona", "zona");
validateEmpty($secao, "Seção", "secao");
validateEmpty($cidade, "Cidade", "cidade");
validateEmpty($estadoTitulo, "Estado", "estadoTitulo");
validateEmpty($email, "E-mail", "email"); 
validateMail($email, "E-mail");

$insetQr = $db->prepare("UPDATE scd.certificacaodigital SET
							nome = :nome, orgao = :orgaoEmissor, estadorg = :estadoRg, titulo = :titulo, zona = :zona, secao = :secao, cidade = :cidade, 
							estadotitulo = :estadoTitulo, email = :email, tipoFuncionario = :tipoFuncionario, liberacao = 0, dataExpiracao = null
						WHERE id=$id

						");

$insetQr->bindParam(':nome', $nome);
$insetQr->bindParam(':orgaoEmissor', $orgaoEmissor);
$insetQr->bindParam(':estadoRg', $estadoRg);
$insetQr->bindParam(':titulo', $titulo);
$insetQr->bindParam(':zona', $zona);
$insetQr->bindParam(':secao', $secao);
$insetQr->bindParam(':cidade', $cidade);
$insetQr->bindParam(':estadoTitulo', $estadoTitulo);
$insetQr->bindParam(':tipoFuncionario', $tipoFuncionario);
$insetQr->bindParam(':email', $email);
$execute = $insetQr->execute();

if($execute){
	session_start();
	$_SESSION['cpf'] = $cpf;
	echo json_encode(array('success' => 1));
	
}else{
	echo json_encode(array('success' => 0, 'error' => 'Falha ao enviar', 'fieldProblem' => $fieldProblem));
}
