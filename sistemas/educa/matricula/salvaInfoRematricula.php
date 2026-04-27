<?php

session_name('re');
session_start();
ini_set('max_execution_time', 300);

include_once 'fnc/inserirEndereco.php';
include_once 'fnc/inserirTransporte.php';
include_once 'fnc/inserirOutrosDados.php';
include_once 'fnc/inserirDadosSaude.php';
include_once 'fnc/inserirEscolaAnterior.php';
include_once 'fnc/inserirDadosPessoais.php';
include_once 'fnc/removeEndereco.php';
include_once 'fnc/removeTransporte.php';
include_once 'fnc/removerDadosSaude.php';

removeEndereco($_SESSION['id'], 1);
inserirEndereco($_SESSION['localizacao'], $_SESSION['id'], 1);
removeTransporte($_SESSION['id']);
(inserirTransporte($_SESSION, $_SESSION['id']));
(inserirOutrosDados($_SESSION['outrosDados'], $_SESSION['id']));
removerDadosSaude($_SESSION['id']);
inserirDadosSaude($_SESSION['saude'], $_SESSION['id']);
inserirDadosPessoais($_SESSION['dados_pessoais'], $_SESSION['id']);

header('Location: dadosMaeRematricula.php');
?>