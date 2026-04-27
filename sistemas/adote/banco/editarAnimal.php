<?php
include_once("gdb.php"); 

$gdb = new gdb();  

$img_principal = (isset($_FILES['img_principal'])) ? $_FILES['img_principal']['tmp_name'] : '0';
$nm_arq_img_principal = (isset($_FILES['img_principal'])) ? $_FILES['img_principal']['name'] : '0';

$img_dois = (isset($_FILES['img_dois'])) ? $_FILES['img_dois']['tmp_name'] : '0';
$nm_arq_img_dois = (isset($_FILES['img_dois'])) ? $_FILES['img_dois']['name'] : '0';

$img_tres = (isset($_FILES['img_tres'])) ? $_FILES['img_tres']['tmp_name'] : '0';
$nm_arq_img_tres = (isset($_FILES['img_tres'])) ? $_FILES['img_tres']['name'] : '0';

$idAnimal = $gdb->vargetpost('id_animal');
$nome_animal = $gdb->vargetpost('nome_animal');
$sobre = $gdb->vargetpost('sobre');
$idade_animal = $gdb->vargetpost('idade_animal');
$temperamento = explode(',', $gdb->vargetpost('temperamento'));
$sociavel = explode(',', $gdb->vargetpost('sociavel'));
$vive_bem = explode(',', $gdb->vargetpost('vive_bem'));
$saude = explode(',', $gdb->vargetpost('saude'));
$id_localizacao = $gdb->vargetpost('id_localizacao');
$id_local = $gdb->vargetpost('id_local');

$gdb->editar($idAnimal, $nome_animal,$sobre,$idade_animal,$saude,$sociavel,$temperamento,$vive_bem,$nm_arq_img_principal,$nm_arq_img_dois,$nm_arq_img_tres,$id_localizacao,$id_local);


if(!is_dir("../img/".$idAnimal)){
    $oldmask = umask(0);
    mkdir("../img/".$idAnimal, 0755);
    umask($oldmask);
}

$targetPathAnimalPrincipal  = "../img/".$idAnimal."/".$nm_arq_img_principal;
$targetPathAnimalDois       = "../img/".$idAnimal."/".$nm_arq_img_dois;
$targetPathAnimalTres       = "../img/".$idAnimal."/".$nm_arq_img_tres;

if($img_dois !='0'){
    if(!move_uploaded_file($img_principal,$targetPathAnimalPrincipal)){
        echo json_encode(array('error' => 'Ocorreu um erro ao realizar o upload da sua Imagem Principal.'));
        die;
    }
}

if($img_dois !='0'){
    if(!move_uploaded_file($img_dois,$targetPathAnimalDois)){
        echo json_encode(array('error' => 'Ocorreu um erro ao realizar o upload da sua Imagem Dois.'));
        die;
    }
}

if($img_tres !='0'){
    if(!move_uploaded_file($img_tres,$targetPathAnimalTres)){
        echo json_encode(array('error' => 'Ocorreu um erro ao realizar o upload da sua Imagem Três.'));
        die;
    }
}

echo json_encode(array('success' => '1'));
?>