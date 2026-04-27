<?php
include_once("gdb.php"); 

$gdb = new gdb();  

$doc_rg = (isset($_FILES['doc_rg'])) ? $_FILES['doc_rg']['tmp_name'] : '0';
$nm_arq_doc_rg = (isset($_FILES['doc_rg'])) ? $_FILES['doc_rg']['name'] : '0';

$doc_cpf = (isset($_FILES['doc_cpf'])) ? $_FILES['doc_cpf']['tmp_name'] : '0';
$nm_arq_doc_cpf = (isset($_FILES['doc_cpf'])) ? $_FILES['doc_cpf']['name'] : '0';

$doc_residencia = (isset($_FILES['doc_residencia'])) ? $_FILES['doc_residencia']['tmp_name'] : '0';
$nm_arq_doc_residencia = (isset($_FILES['doc_residencia'])) ? $_FILES['doc_residencia']['name'] : '0';


$gdb->editarArquivo($id_pessoa,$nm_arq_doc_rg,$nm_arq_doc_cpf,$nm_arq_doc_residencia);


if(!is_dir("../img/".$id_pessoa)){
    $oldmask = umask(0);
    mkdir("../img/".$id_pessoa, 0755);
    umask($oldmask);
}

$targetPathDocRg  = "../img/".$id_pessoa."/".$nm_arq_doc_rg;
$targetPathDocCpf       = "../img/".$id_pessoa."/".$nm_arq_doc_cpf;
$targetPathDocResidencia       = "../img/".$id_pessoa."/".$nm_arq_doc_residencia;

if($doc_rg !='0'){
    if(!move_uploaded_file($doc_rg,$targetPathDocRg)){
        echo json_encode(array('error' => 'Ocorreu um erro ao realizar o upload do arquivo RG.'));
        die;
    }
}

if($doc_cpf !='0'){
    if(!move_uploaded_file($doc_cpf,$targetPathDocCpf)){
        echo json_encode(array('error' => 'Ocorreu um erro ao realizar o upload do arquivo CPF.'));
        die;
    }
}

if($doc_residencia !='0'){
    if(!move_uploaded_file($doc_residencia,$targetPathDocResidencia)){
        echo json_encode(array('error' => 'Ocorreu um erro ao realizar o upload do arquivo Comprovante de Residencia.'));
        die;
    }
}

echo json_encode(array('success' => '1'));
?>