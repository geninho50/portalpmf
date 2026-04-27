<?php

session_name('ma');
session_start();

include 'fnc/inserirLogin.php';
include 'fnc/inserirAluno.php';
include 'fnc/inserirEndereco.php';
include 'fnc/inserirEscolaAnterior.php';
include 'fnc/inserirDadosPessoais.php';
include 'fnc/buscaInscricao.php';

if (!isset($_SESSION['escola']['novaEscola']['vaga'])) {
    if (!isset($_SESSION['aluno']['id'])) {
        $temp = inserirAluno($_SESSION);
        if ($temp != false) {
            $_SESSION['aluno']['id'] = $temp;
            $inscricao = buscaInscricao($_SESSION['aluno']['id'])[0];
            inserirLogin($_SESSION['aluno']['id'], $inscricao, str_replace('/', '', $_SESSION['identificacao']['data_nascimento']), 2);
            inserirEndereco($_SESSION['localizacao'], $_SESSION['aluno']['id'], 1);
            if (isset($_SESSION['escola']['escolaAnterior'])) {
                inserirEscolaAnterior($_SESSION['escola']['escolaAnterior'], $_SESSION['periodo_ano'], $_SESSION['aluno']['id']);
            }
            inserirDadosPessoais($_SESSION['dados_pessoais'], $_SESSION['aluno']['id']);
            include 'fnc/insereDistancia.php';
            insereDistancia($_SESSION['aluno']['id'], $_SESSION['escola']['novaEscola']['distancia']);
        } else {
            
        }
    }
    $escola = $_SESSION['escola']['novaEscola']['id_escola'];
    $curso = $_SESSION['curso'];
    $ano_serie = $_SESSION['escola']['novaEscola']['ano'];
    $ano = $_SESSION['periodo_ano'];
    $periodo = $_SESSION['id_periodo'];

    //AQUI É FEITA A VERIFICACAO DE DISPONIBILIDADE DE VAGA
    include 'fnc/verificaVaga.php';
    include 'fnc/alocarAlunoVaga.php';
    $vagas = verificaVaga($escola, $curso, $ano_serie, $ano, $periodo);
    if ($vagas > 0) {
        if (alocarAlunoVaga($_SESSION['aluno']['id'], $escola, $curso, $ano_serie, $ano, $periodo)) {
            //INSERIR AQUI A DISTANCIA ATÉ A UNIDADE
            $_SESSION['escola']['novaEscola']['vaga'] = true;
        } else {
            $_SESSION['escola']['novaEscola']['vaga'] = false;
        }
    } else {
        $_SESSION['escola']['novaEscola']['vaga'] = false;
    }
}
header("Location: escolhaIntencao.php");
?>
