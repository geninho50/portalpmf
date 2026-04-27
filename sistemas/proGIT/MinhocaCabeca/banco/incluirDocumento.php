<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once("gdb.php"); 

$gdb = new gdb();  

$id_pessoa = $gdb->vargetpost('id_pessoa');

$doc_rg = (isset($_FILES['rg'])) ? $_FILES['rg']['tmp_name'] : '0';
$nm_arq_doc_rg = (isset($_FILES['rg'])) ? $_FILES['rg']['name'] : '0';

$doc_cpf = (isset($_FILES['cpf'])) ? $_FILES['cpf']['tmp_name'] : '0';
$nm_arq_doc_cpf = (isset($_FILES['cpf'])) ? $_FILES['cpf']['name'] : '0';

$doc_residencia = (isset($_FILES['comp'])) ? $_FILES['comp']['tmp_name'] : '0';
$nm_arq_doc_residencia = (isset($_FILES['comp'])) ? $_FILES['comp']['name'] : '0';

$gdb->incluirDocumento($id_pessoa,$nm_arq_doc_rg,$nm_arq_doc_cpf,$nm_arq_doc_residencia);
if($id_pessoa != 0){
	if(!is_dir("../pdf/".$id_pessoa)){
		$oldmask = umask(0);
		mkdir("../pdf/".$id_pessoa, 0755);
		umask($oldmask);
	}

	$targetPathDocRG = "../pdf/".$id_pessoa."/".$nm_arq_doc_rg;
	$targetPathDocCPF = "../pdf/".$id_pessoa."/".$nm_arq_doc_cpf;
	$targetPathDocComp = "../pdf/".$id_pessoa."/".$nm_arq_doc_residencia;

	if($doc_rg !='0'){
		if(!move_uploaded_file($doc_rg,$targetPathDocRG)){
			echo json_encode(array('error' => 'Ocorreu um erro ao realizar o upload do seu documento de RG.'));
			die;
		}
	}

	if($doc_cpf !='0'){
		if(!move_uploaded_file($doc_cpf,$targetPathDocCPF)){
			echo json_encode(array('error' => 'Ocorreu um erro ao realizar o upload do seu documento CPF.'));
			die;
		}
	}

	if($doc_residencia !='0'){
		if(!move_uploaded_file($doc_residencia,$nm_arq_doc_residencia)){
			echo json_encode(array('error' => 'Ocorreu um erro ao realizar o upload do seu documento Comprovante de Residência.'));
			die;
		}
	}
	

	echo json_encode(array('success' => '1'));
} else {
	echo json_encode(array('error' => 'Erro ao incluir documento!'));
}

?>