<?php

session_start();

include '../fnc/listaDeProfissoes.php';
var_dump(listaDeProfissoes());

var_dump($_SESSION);

include '../fnc/inserirAluno.php';
echo 'Aluno';
$id = (inserirAluno($_SESSION));
var_dump($id);

include '../fnc/inserirTransporte.php';
echo 'Transporte';
var_dump(inserirTransporte($_SESSION, $id));

include '../fnc/inserirEndereco.php';
echo 'Endereco';
var_dump(inserirEndereco($_SESSION['localizacao'], $id, 1));

include '../fnc/inserirOutrosDados.php';
echo 'Outros Dados';
var_dump(inserirOutrosDados($_SESSION['outrosDados'], $id));

include '../fnc/inserirDadosSaude.php';
echo 'Saude';
var_dump(inserirDadosSaude($_SESSION['saude'], $id));

include '../fnc/verificaVaga.php';
echo 'Verifica Vaga<br>';
echo verificaVaga(1, 1, 1, 2013, 1) . '<br><br>';

//include '../fnc/alocarAlunoVaga.php';
//var_dump(alocarAlunoVaga($id, 1, 1, 1, 2013, 1));

include '../fnc/registrarIntencao.php';
echo 'Intencao';
var_dump(registrarIntencao($id, 1, 1, 1, 2013, 1, 1));

include '../fnc/inserirDadosPessoais.php';
echo 'Dados Pessoais';
var_dump(inserirDadosPessoais($_SESSION['dados_pessoais'], $id));

echo 'Verifica Vaga<br>';
echo verificaVaga(1, 1, 1, 2013, 1) . '<br><br>';

include '../fnc/inserirEscolaAnterior.php';
echo 'Escola Anterior';
var_dump(inserirEscolaAnterior($_SESSION['escola']['escolaAnterior'], 2013, $id));

include '../fnc/buscaEscola.php';
echo 'Busca Escola';
var_dump(buscaEscola(1));

include '../fnc/listaDeEscolas.php';
echo 'Lista de Escolas';
var_dump(listaDeEscolas(1, 1, 2013));

include '../fnc/listaDeAnos.php';
var_dump(listaDeAnos(1, 1, 1, 2013));

include '../fnc/buscaEndereco.php';
$endereco = buscaEndereco('88140000');
var_dump($endereco);
$endereco = buscaEndereco('88025210');
var_dump($endereco);

// VERIFICA CERTIDAO
include '../fnc/verificaNovaCertidao.php';

$numero = '104539.01.55.2013.1.00012.021.0000123-21';
if (verificaNovaCertidao($numero)) {
    echo "VerificaNovaCertidao - OK";
    echo '<br>';
}

// VERIFICA CPF
include '../fnc/verificaCPF.php';

$cpf = '063.722.689-57';
if (verificaCPF($cpf)) {
    $cpf = '22222222222';
    if (!verificaCPF($cpf)) {
        $cpf = '57847557657';
        if (verificaCPF($cpf)) {
            echo "VerificaCPF - OK";
            echo '<br>';
        }
    }
}

// VERIFICA DATA NASCIMENTO
include '../fnc/verificaDataPassado.php';

$data = '13/07/1989';
if (verificaDataPassado($data)) {
    $data = '13/07/2014';
    if (!verificaDataPassado($data)) {
        $data = '32/06/2010';
    } if (!verificaDataPassado($data)) {
        echo "VerificaDataPassado - OK";
        echo '<br>';
    }
}

//VERIFICA LISTA DE PAISES
include '../fnc/listaDePaises.php';

count(listaDePaises());

//VERIFICA LISTA DE ESTADOS
include '../fnc/listaDeEstados.php';

listaDeEstados();
?>