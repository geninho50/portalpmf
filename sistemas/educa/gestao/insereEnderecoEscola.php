<?php
session_name('ga');
session_start();

//EXPIRA A SESSAO SE NAO HOUVE ATIVIDADE NOS ULTIMOS 30 MINUTOS
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    session_unset(); 
    session_destroy();
    header("Location: index.php");
}
$_SESSION['LAST_ACTIVITY'] = time();

if (isset($_SESSION['aut_gm'])) {
    if ($_SESSION['aut_gm'] != true) {
        header('Location: index.php');
    }
} else {
    header('Location: index.php');
}

if (isset($_POST['id'])) {
    include 'fnc/verificaQuantidadeEnderecos.php';
	$quantidadeEnderecos = verificaQuantidadeEnderecos($_POST['id'], 2);
    if ($quantidadeEnderecos[1][0] > 0) {
        include 'fnc/removeEnderecos.php';
        removeEnderecos($_POST['id'], 2);
    }

    include 'fnc/inserirEndereco.php';
    $localizacao['logradouro'] = $_POST['logradouro'];
    $localizacao['bairro'] = $_POST['bairro'];
    $localizacao['municipio'] = 8452;
    $localizacao['estado'] = 25;
    $localizacao['numero'] = $_POST['numero'];
    $localizacao['complemento'] = $_POST['complemento'];
    $localizacao['cep'] = $_POST['cep'];
    $resultado = inserirEndereco($localizacao, $_POST['id'], 2);

    if ($resultado) {
        header("Location: alterarEnderecoEscola.php?idEscola=" . $_POST['id'] . "&sucessoEnd=true");
    } else {
        header("Location: alterarEnderecoEscola.php?idEscola=" . $_POST['id'] . "&sucessoEnd=false");
    }
}
?>