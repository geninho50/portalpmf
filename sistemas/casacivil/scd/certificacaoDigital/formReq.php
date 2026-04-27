<?
include "db.php"; 
include "funcoes.php";

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

$testaRgCpf = $db->prepare("SELECT * FROM scd.certificacaodigital WHERE CPF = '$cpf' and RG = '$rg' ");
$testaRgCpf->execute();
$data = $testaRgCpf->fetch(PDO::FETCH_ASSOC);

if($data){
	echo json_encode(array('success' => 3, 'id' => $data['id']));
	die;
}

$testaCpf = $db->prepare("SELECT * FROM scd.certificacaodigital WHERE CPF = '$cpf'");
$testaCpf->execute();
$data2 = $testaCpf->fetch(PDO::FETCH_ASSOC);

if($data2){
	echo json_encode(array('success' => 0, 'error' => 'CPF já cadastrado no sistema e RG incompatível'));
	die;
}

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


$insetQr = $db->prepare("INSERT INTO scd.certificacaodigital
							(nome, nascimento, cpf, rg, orgao, estadorg, pis, cei, titulo, zona, secao, cidade, estadotitulo, email, tipoFuncionario)
						VALUES
							(:nome, :nascimento, :cpf, :rg, :orgaoEmissor, :estadoRg, :pis, :cei, :titulo, :zona, :secao, :cidade, :estadoTitulo, :email, :tipoFuncionario)");

$insetQr->bindParam(':nome', $nome);
$insetQr->bindParam(':nascimento', $nascimento);
$insetQr->bindParam(':cpf', $cpf);
$insetQr->bindParam(':rg', $rg);
$insetQr->bindParam(':orgaoEmissor', $orgaoEmissor);
$insetQr->bindParam(':estadoRg', $estadoRg);
$insetQr->bindParam(':pis', $pis);
$insetQr->bindParam(':cei', $cei);
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



