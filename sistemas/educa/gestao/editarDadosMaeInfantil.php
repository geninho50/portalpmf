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
//if(($_SESSION['usuario']['id'] != 1) || (!$_SESSION['permissoes']['gera']['perfil'])){
//    header('Location: opcoes.php');
//}

if (!isset($_GET['idAluno'])) {
    header("Location: opcoes.php");
}


/*if($_SESSION['usuario']['permissoes'][12][1] != 1){
    header('Location: opcoes.php');
}*/



if (count($_POST) > 0) {

    if (isset($_POST['estadoCivil'])) {
        if ($_POST['estadoCivil'] == 'Selecione um...') {
            $erro['estadoCivil'] = true;
        }
    }
    if (isset($_POST['etnia'])) {
        if ($_POST['etnia'] == 'Selecione um...') {
            $erro['etnia'] = true;
        }
    }
    if (isset($_POST['escolaridade'])) {
        if ($_POST['escolaridade'] == 'Selecione um...') {
            $erro['escolaridade'] = true;
        }
    }
    if (isset($_POST['profissao'])) {
        if ($_POST['profissao'] == 'Selecione um...') {
            $erro['profissao'] = true;
        }
    }
    if (isset($_POST['religiao'])) {
        if ($_POST['religiao'] == 'Selecione um...') {
            $erro['religiao'] = true;
        }
    }
    if (isset($_POST['naturalidade'])) {
        if ($_POST['naturalidade'] == 'Selecione um...') {
            $erro['naturalidade'] = true;
        }
    }

    if (isset($_POST['nome'])) {
        if ($_POST['nome'] == '') {
            $erro['nome'] = true;
        }
    }

    if (isset($_POST['nacionalidade'])) {
        if ($_POST['nacionalidade'] == 30) {
            if (isset($_POST['cpf'])) {
                include 'fnc/verificaCPF.php';
                if (!verificaCPF($_POST['cpf'])) {
                    $erro['cpfInvalido'] = true;
                }
            }
        }
    }

    if (isset($_POST['dataNascimento'])) {
        if ($_POST['dataNascimento'] == '') {
            $erro['nasc_vazio'] = true;
        } else {
            if ($_POST['dataNascimento'] == '__/__/____') {
                $erro['nasc_vazio'] = true;
            } else {
                include 'fnc/verificaDataPassado.php';
                if (!verificaDataPassado($_POST['dataNascimento'])) {
                    $erro['nasc_invalido'] = true;
                }
            }
        }
    }
//Caso nacionalidade for brasileira (nacionalidade = 30), naturalidade (uf) e naturalidade (municipio)
//devem estar selecionados. Se nacionalidade não for brasileira, nao devera ter informacao nos campos.
    if (isset($_POST['nacionalidade'])) {
        if ($_POST['nacionalidade'] == 30) {
            if (!isset($_POST['naturalidade'])) {
                $erro['naturalidade'] = true;
            } else {
                if ($_POST['naturalidade'] == '') {
                    $erro['naturalidade'] = true;
                } else {
                    if ($_POST['naturalidade'] == 'Selecione um...') {
                        $erro['naturalidade'] = true;
                    } else {
                        if (!isset($_POST['naturalidadeM'])) {
                            $erro['naturalidadeM'] = true;
                        } else {
                            if ($_POST['naturalidadeM'] == '') {
                                $erro['naturalidadeM'] = true;
                            }
                        }
                    }
                }
            }
        } else {
            $_POST['naturalidade'] = '';
            $_POST['naturalidadeM'] = '';
        }
    }

//Existe a obrigatoriedade da entrada de pelo menos 1 telefone

    if ((!isset($_POST['telefone'])) && (!isset($_POST['comercial'])) && (!isset($_POST['celular']))) {
        $erro['telefones'] = true;
    } else {
        if (($_POST['telefone'] == '') && ($_POST['comercial'] == '') && ($_POST['celular'] == '')) {
            $erro['telefones'] = true;
        }
    }

//Endereco
//logradouro
    if (!isset($_POST['logradouro'])) {
        $erro['logradouro'] = true;
    } else {
        if ($_POST['logradouro'] == '') {
            $erro['logradouro'] = true;
        }
    }
//numero
    if (!isset($_POST['numero'])) {
        $erro['numero'] = true;
    } else {
        if (!ctype_digit($_POST['numero'])) {
            $erro['numeroInvalido'] = true;
        }
        if ($_POST['numero'] == '') {
            $erro['numero'] = true;
        }
    }
//cep
    if (!isset($_POST['cep'])) {
        $erro['cep'] = true;
    } else {
        $temp = str_replace('-', '', $_POST['cep']);
        $temp = str_replace('.', '', $temp);
        if (!ctype_digit($temp)) {
            $erro['cepInvalido'] = true;
        }
        if (strlen($temp) != 8) {
            $erro['cepInvalido'] = true;
        }
    }
//UF
    if (!isset($_POST['estado'])) {
        $erro['estado'] = true;
    } else {
        if ($_POST['estado'] == '') {
            $erro['estado'] = true;
        }
    }
//municipio  
    if (!isset($_POST['municipio'])) {
        $erro['municipio'] = true;
    } else {
        if ($_POST['municipio'] == '') {
            $erro['municipio'] = true;
        }
    }

//Endereco
//logradouro
    if ($_POST['profissao'] != 9 && $_POST['profissao'] != 11 && $_POST['profissao'] != 43) {
        if (!isset($_POST['logradouroTrabalho'])) {
            $erro['logradouroTrabalho'] = true;
        } else {
            if ($_POST['logradouroTrabalho'] == '')
                $erro['logradouroTrabalho'] = true;
        }
//numero
        if (!isset($_POST['numeroTrabalho'])) {
            $erro['numeroTrabalho'] = true;
        } else {
            if (!ctype_digit($_POST['numeroTrabalho'])) {
                $erro['numeroInvalidoTrabalho'] = true;
            }
        }
        //municipio  
        if (!isset($_POST['municipioTrabalho'])) {
            $erro['municipioTrabalho'] = true;
        } else {
            if ($_POST['municipioTrabalho'] == '') {
                $erro['municipioTrabalho'] = true;
            }
        }

//cep
        if (!isset($_POST['cepTrabalho'])) {
            $erro['cepTrabalho'] = true;
        } else {
            $temp = str_replace('-', '', $_POST['cepTrabalho']);
            $temp = str_replace('.', '', $temp);
            if (!ctype_digit($temp)) {
                $erro['cepInvalidoTrabalho'] = true;
            }
            if (strlen($temp) != 8) {
                $erro['cepInvalidoTrabalho'] = true;
            }
        }
    }
    if (!isset($erro)) {
        $dadosPessoais['nome'] = $_POST['nome'];
        $dadosPessoais['data_nascimento'] = $_POST['dataNascimento'];
        $dadosPessoais['cpf'] = $_POST['cpf'];
        $dadosPessoais['sexo'] = $_POST['sexo'];
        $dadosPessoais['estado_civil'] = $_POST['estadoCivil'];
        $dadosPessoais['etnia'] = $_POST['etnia'];
        $dadosPessoais['escolaridade'] = $_POST['escolaridade'];
        $dadosPessoais['profissao'] = $_POST['profissao'];
        $dadosPessoais['religiao'] = $_POST['religiao'];
        $dadosPessoais['nacionalidade'] = $_POST['nacionalidade'];
        $dadosPessoais['naturalidade'] = $_POST['naturalidade'];
        $dadosPessoais['naturalidade_municipio'] = $_POST['naturalidadeM'];
        $dadosPessoais['telefone'] = $_POST['ufTelefone'] . $_POST['telefone'];
        $dadosPessoais['celular'] = $_POST['ufCelular'] . $_POST['celular'];
        $dadosPessoais['comercial'] = $_POST['ufComercial'] . $_POST['comercial'];
        $dadosPessoais['email'] = $_POST['email'];
        $dadosPessoais['cep_trabalho'] = $_POST['cepTrabalho'];
        $dadosPessoais['logradouro_trabalho'] = $_POST['logradouroTrabalho'];
        $dadosPessoais['numero_trabalho'] = $_POST['numeroTrabalho'];
        $dadosPessoais['complemento_trabalho'] = $_POST['complementoTrabalho'];
        $dadosPessoais['bairro_trabalho'] = $_POST['bairroTrabalho'];
        $dadosPessoais['estado_trabalho'] = $_POST['estadoTrabalho'];
        $dadosPessoais['municipio_trabalho'] = $_POST['municipioTrabalho'];
        $dadosPessoais['cep'] = $_POST['cep'];
        $dadosPessoais['logradouro'] = $_POST['logradouro'];
        $dadosPessoais['numero'] = $_POST['numero'];
        $dadosPessoais['complemento'] = $_POST['complemento'];
        $dadosPessoais['bairro'] = $_POST['bairro'];
        $dadosPessoais['estado'] = $_POST['estado'];
        $dadosPessoais['municipio'] = $_POST['municipio'];
        if(isset($_POST['turnos'])){
            $dadosPessoais['turnos'] = $_POST['turnos'];
        }
        
        include 'fnc/inserirResponsavel.php';
        include 'fnc/atualizarResponsavel.php';
        if(isset($mae[0])){
            if($mae[0] != ''){
                $resultado = (atualizarResponsavelEditar($dadosPessoais, $mae[0], 'mae', $_GET['idAluno']));
            }
        } else {
            $resultado = (inserirResponsavelEditar($dadosPessoais, null, 'mae', $_GET['idAluno']));
        }
        $sucesso = $resultado;
        if($sucesso == true){
            include_once 'fnc/insereAuditoriaEditarDadosMaeInfantil.php';
            insereAuditoriaEditarDadosMaeInfantil($dadosPessoais, $_GET['idAluno'], $_SESSION['usuario']['id']);
        }
    }
}
include 'fnc/buscaDadosMae.php';
$mae = (buscaDadosMae($_GET['idAluno']));

include_once 'fnc/buscaComQuemMora.php';
$cqm = buscaComQuemMoraParentesco($_GET['idAluno'], 1);
if($cqm == true){
    $dadosPessoais['mora_aluno'] = 1;
} else {
    $dadosPessoais['mora_aluno'] = 0;
}

include_once 'fnc/buscaQuemAcompanha.php';
$qa = buscaQuemAcompanhaParentesco($_GET['idAluno'], 1);
if($qa == true){
    $dadosPessoais['quem_acompanha'] = true;
} else {
    $dadosPessoais['quem_acompanha'] = false;
}

include_once 'fnc/buscaAluno.php';
$aluno = buscaAluno($_GET['idAluno']);

if ($mae[5] == 30) {
    include 'fnc/buscaNaturalidade.php';
    $naturalidade = buscaNaturalidade($mae[0]);
}

if (isset($_SESSION['identificacao']['nome_mae'])) {
    $dadosPessoais['nome'] = $_SESSION['identificacao']['nome_mae'];
}


if ($mae != false) {
    $dadosPessoais['preenchido'] = true;
    $dadosPessoais['nome'] = $mae[9];
    $data = explode('-', $mae[10]);
    $dadosPessoais['data_nascimento'] = $data[2] . '/' . $data[1] . '/' . $data[0];
    $dadosPessoais['cpf'] = substr($mae[11], 0, 3) . '.' . substr($mae[11], 3, 3) . '.' . substr($mae[11], 6, 3) . '-' . substr($mae[11], 9, 2);
    $dadosPessoais['sexo'] = strtolower($mae[8]);
    $dadosPessoais['estado_civil'] = ($mae[4]);
    $dadosPessoais['etnia'] = ($mae[1]);
    $dadosPessoais['escolaridade'] = ($mae[7]);
    $dadosPessoais['profissao'] = ($mae[3]);
    $dadosPessoais['religiao'] = ($mae[2]);
    $dadosPessoais['nacionalidade'] = ($mae[5]);
    iF (isset($naturalidade)) {
        $dadosPessoais['naturalidade'] = ($naturalidade[1]);
        $dadosPessoais['naturalidade_municipio'] = ($naturalidade[0]);
    }

    include 'fnc/buscaTel.php';
    $telefones = buscaTel($mae[0]);
    if (isset($telefones[1])) {
        $dadosPessoais['celular'] = $telefones[1][3] . $telefones[1][4];
    }
    if (isset($telefones[2])) {
        $dadosPessoais['telefone'] = $telefones[2][3] . $telefones[2][4];
    }
    if (isset($telefones[3])) {
        $dadosPessoais['comercial'] = $telefones[3][3] . $telefones[3][4];
    }

    include 'fnc/buscaEmail.php';
    $email = buscaEmail($mae[0]);
    if ($email != false) {
        $dadosPessoais['email'] = $email[0];
    }

    include 'fnc/buscaAlunoEndereco.php';
    $end = buscaAlunoEndereco($mae[0]);

    $dadosPessoais['cep'] = substr($end[11], 0, 2) . '.' . substr($end[11], 2, 3) . '-' . substr($end[11], 5, 3);
    $dadosPessoais['logradouro'] = $end[6];
    $dadosPessoais['numero'] = $end[7];
    $dadosPessoais['complemento'] = $end[8];
    $dadosPessoais['bairro'] = $end[3];
    $dadosPessoais['estado'] = $end[5];
    $dadosPessoais['municipio'] = $end[4];

    $end = buscaTrabalhoEndereco($mae[0]);
    if ($end != false) {
        $dadosPessoais['cep_trabalho'] = substr($end[11], 0, 2) . '.' . substr($end[11], 2, 3) . '-' . substr($end[11], 5, 3);
        $dadosPessoais['logradouro_trabalho'] = $end[6];
        $dadosPessoais['numero_trabalho'] = $end[7];
        $dadosPessoais['complemento_trabalho'] = $end[8];
        $dadosPessoais['bairro_trabalho'] = $end[3];
        $dadosPessoais['estado_trabalho'] = $end[5];
        $dadosPessoais['municipio_trabalho'] = $end[4];
    }

    include 'fnc/buscaTurnos.php';
    $temp = (buscaTurnos($mae[0]));
    $dadosPessoais['turnos'] = array();
    if ($temp[0] == 1) {
        array_push($dadosPessoais['turnos'], 'mat');
    }
    if ($temp[1] == 1) {
        array_push($dadosPessoais['turnos'], 'ves');
    }
    if ($temp[2] == 1) {
        array_push($dadosPessoais['turnos'], 'not');
    }
}

if (isset($dadosPessoais['turnos'])) {
    $_POST['turnos'] = $dadosPessoais['turnos'];
}
if (isset($dadosPessoais['nome'])) {
    $_POST['nome'] = $dadosPessoais['nome'];
}
if (isset($dadosPessoais['data_nascimento'])) {
    $_POST['dataNascimento'] = $dadosPessoais['data_nascimento'];
}
if (isset($dadosPessoais['cpf'])) {
    $_POST['cpf'] = $dadosPessoais['cpf'];
}
if (isset($dadosPessoais['sexo'])) {
    $_POST['sexo'] = $dadosPessoais['sexo'];
}
if (isset($dadosPessoais['estado_civil'])) {
    $_POST['estadoCivil'] = $dadosPessoais['estado_civil'];
}
if (isset($dadosPessoais['etnia'])) {
    $_POST['etnia'] = $dadosPessoais['etnia'];
}
if (isset($dadosPessoais['escolaridade'])) {
    $_POST['escolaridade'] = $dadosPessoais['escolaridade'];
}
if (isset($dadosPessoais['profissao'])) {
    $_POST['profissao'] = $dadosPessoais['profissao'];
}
if (isset($dadosPessoais['religiao'])) {
    $_POST['religiao'] = $dadosPessoais['religiao'];
}
if (isset($dadosPessoais['nacionalidade'])) {
    $_POST['nacionalidade'] = $dadosPessoais['nacionalidade'];
}
if (isset($dadosPessoais['telefone'])) {
    $_POST['ufTelefone'] = substr($dadosPessoais['telefone'], 0, 2);
    $_POST['telefone'] = substr($dadosPessoais['telefone'], 2);
}
if (isset($dadosPessoais['comercial'])) {
    $_POST['ufComercial'] = substr($dadosPessoais['comercial'], 0, 2);
    $_POST['comercial'] = substr($dadosPessoais['comercial'], 2);
}
if (isset($dadosPessoais['celular'])) {
    $_POST['ufCelular'] = substr($dadosPessoais['celular'], 0, 2);
    $_POST['celular'] = substr($dadosPessoais['celular'], 2);
}
if (isset($dadosPessoais['email'])) {
    $_POST['email'] = $dadosPessoais['email'];
}
if (isset($dadosPessoais['cep_trabalho'])) {
    $_POST['cepTrabalho'] = $dadosPessoais['cep_trabalho'];
}
if (isset($dadosPessoais['logradouro_trabalho'])) {
    $_POST['logradouroTrabalho'] = $dadosPessoais['logradouro_trabalho'];
}
if (isset($dadosPessoais['numero_trabalho'])) {
    $_POST['numeroTrabalho'] = $dadosPessoais['numero_trabalho'];
}
if (isset($dadosPessoais['complemento_trabalho'])) {
    $_POST['complementoTrabalho'] = $dadosPessoais['complemento_trabalho'];
}
if (isset($dadosPessoais['bairro_trabalho'])) {
    $_POST['bairroTrabalho'] = $dadosPessoais['bairro_trabalho'];
}
if (isset($dadosPessoais['estado_trabalho'])) {
    $_POST['estadoTrabalho'] = $dadosPessoais['estado_trabalho'];
}
if (isset($dadosPessoais['municipio_trabalho'])) {
    $_POST['municipioTrabalho'] = $dadosPessoais['municipio_trabalho'];
}
if (isset($dadosPessoais['cep'])) {
    $_POST['cep'] = $dadosPessoais['cep'];
}
if (isset($dadosPessoais['logradouro'])) {
    $_POST['logradouro'] = $dadosPessoais['logradouro'];
}
if (isset($dadosPessoais['numero'])) {
    $_POST['numero'] = $dadosPessoais['numero'];
}
if (isset($dadosPessoais['complemento'])) {
    $_POST['complemento'] = $dadosPessoais['complemento'];
}
if (isset($dadosPessoais['bairro'])) {
    $_POST['bairro'] = $dadosPessoais['bairro'];
}
if (isset($dadosPessoais['estado'])) {
    $_POST['estado'] = $dadosPessoais['estado'];
}
if (isset($dadosPessoais['municipio'])) {
    $_POST['municipio'] = $dadosPessoais['municipio'];
}
if (isset($dadosPessoais['naturalidade'])) {
    $_POST['naturalidade'] = $dadosPessoais['naturalidade'];
}
if (isset($dadosPessoais['naturalidade_municipio'])) {
    $_POST['naturalidadeM'] = $dadosPessoais['naturalidade_municipio'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>SGE &middot; Dados da Mãe do Aluno</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.js"></script>
          <![endif]-->

          <!-- Fav and touch icons -->
          <link rel="apple-touch-icon-precomposed" sizes="144x144" href="ico/apple-touch-icon-144-precomposed.png">
          <link rel="apple-touch-icon-precomposed" sizes="114x114" href="ico/apple-touch-icon-114-precomposed.png">
          <link rel="apple-touch-icon-precomposed" sizes="72x72" href="ico/apple-touch-icon-72-precomposed.png">
          <link rel="apple-touch-icon-precomposed" href="ico/apple-touch-icon-57-precomposed.png">
          <link rel="shortcut icon" href="ico/favicon.png">
          <style>
            .controls {
                text-align: left;
                padding-left: 40px;
            }
            .control-group {
                padding-left: 120px;
            }
        </style>
    </head>

    <body>

        <div class="container">
            <?php include 'shared/topo.php'; ?>
            <?php
            include 'shared/barraTopo.php';
            ?>
            <div class='conteudo' style='min-height: 500px;'>
                <div class='row-fluid' style='text-align: center; padding-top: 20px;'>
                    <h2 style='font-size:30px;'>Editar Aluno</h1>
                        <h4><?php echo $aluno[2] . ' &middot ' . ($aluno[0]); ?></h4>
                    </div>
                    <hr>
                    <div class="row-fluid">
                        <div class="span12" style='padding: 20px; padding-top: 0px;'>
                            <h3>Dados da Mãe</h3>
                            <?php
                            if(isset($sucesso)){
                                if($sucesso){
                                    ?>
                                    <div class="sucesso">
                                        <strong>Sucesso!</strong> Dados da Mãe atualizados!
                                    </div>
                                    <?php
                                } else {
                                    ?>
                                    <div class="erro">
                                        <strong>Erro!</strong> Um erro ocorreu, tente novamente!
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                            <form class="form-horizontal" method="post" id='form1'
                            onsubmit="
                            $('#inputCEP').removeAttr('disabled');
                            $('#inputLogradouro').removeAttr('disabled');
                            $('#inputNumero').removeAttr('disabled');
                            $('#inputComplemento').removeAttr('disabled');
                            $('#inputBairro').removeAttr('disabled');
                            $('#inputEstado').removeAttr('disabled');
                            $('#inputMunicipio').removeAttr('disabled');
                            $('#inputCEPTrabalho').removeAttr('disabled');
                            $('#inputLogradouroTrabalho').removeAttr('disabled');
                            $('#inputNumeroTrabalho').removeAttr('disabled');
                            $('#inputComplementoTrabalho').removeAttr('disabled');
                            $('#inputBairroTrabalho').removeAttr('disabled');
                            $('#inputEstadoTrabalho').removeAttr('disabled');
                            $('#inputMunicipioTrabalho').removeAttr('disabled');
                            ">
                            <div class="control-group">
                                <label class="control-label" for="inputNome">Nome Completo</label>
                                <div class="controls">
                                    <input name='nome' type="text" id="inputNome" placeholder="Nome Completo"  onkeypress="verificaCaracteres('#inputNome');" onkeyup="verificaCaracteres('#inputNome');"
                                    <?php
                                    if (isset($_POST['nome'])) {
                                        echo 'value="' . $_POST['nome'] . '"';
                                    }
                                    ?>>
                                </div>                            
                                <?php if (isset($erro['nome'])) { ?>
                                <div class="erro">
                                    <strong>Erro!</strong> Nome vazio! Entre um nome para continuar.
                                </div>
                                <?php } ?>
                                <label class="control-label" for="inputDataNasc">Data de Nascimento</label>
                                <div class="controls">
                                    <input name='dataNascimento' type="text" class='datepicker' id="inputDataNasc" placeholder="dd/mm/aaaa" data-mask='99/99/9999' onselect="setCaretPosition($(this), 0);" required
                                    <?php
                                    if (isset($_POST['dataNascimento'])) {
                                        echo 'value="' . $_POST['dataNascimento'] . '"';
                                    }
                                    ?>>
                                </div>                           
                                <?php if (isset($erro['nasc_invalido'])) { ?>
                                <div class="erro">
                                    <strong>Erro!</strong> Data de nascimento inválida.
                                </div>
                                <?php } ?>                      
                                <?php if (isset($erro['nasc_vazio'])) { ?>
                                <div class="erro">
                                    <strong>Erro!</strong> Preencha uma data de nascimento.
                                </div>
                                <?php } ?>
                                <label class="control-label" for="inputCPF">CPF</label>
                                <div class="controls">
                                    <input name='cpf' type="text"  class='datepicker'
                                    <?php
                                    if (isset($_POST['cpf'])) {
                                        echo 'value="' . $_POST['cpf'] . '"';
                                    }
                                    ?>
                                    id="inputCPF" placeholder="999.999.999-99" data-mask='999.999.999-99' onselect="setCaretPosition($(this), 0);">
                                </div>
                                <?php if (isset($erro['cpfInvalido'])) { ?>
                                <div class="erro">
                                    <strong>Erro!</strong> CPF inválido.
                                </div>
                                <?php } ?>
                                <label class="control-label" for="inputSexo">Sexo</label>
                                <div class="controls">
                                    <select name='sexo' onchange='$("#opt7").remove();'>
                                        <option id='opt7'>Selecione um...</option>
                                        <option 
                                        <?php
                                        if (isset($_POST['sexo'])) {
                                            if ($_POST['sexo'] == 'm') {
                                                echo 'selected';
                                            }
                                        }
                                        ?> value='m'>Masculino</option>
                                        <option 
                                        <?php
                                        if (isset($_POST['sexo'])) {
                                            if ($_POST['sexo'] == 'f') {
                                                echo 'selected';
                                            }
                                        }
                                        ?>
                                        value='f'>Feminino</option>
                                    </select>
                                </div>
                                <label class="control-label" for="inputEstadoCivil">Estado Civil</label>
                                <div class="controls">
                                    <select name='estadoCivil' onchange='$("#opt1").remove();'>
                                        <option id='opt1'>Selecione um...</option>
                                        <?php
                                        include 'fnc/listaDeEstadosCivis.php';
                                        $estados = listaDeEstadosCivis();
                                        foreach ($estados as $key => $value) {
                                            if (isset($_POST['estadoCivil'])) {
                                                if ($_POST['estadoCivil'] == $key) {
                                                    echo "<option value='" . ($value[0]) . "' selected>" . ($value[1]) . "</option>";
                                                } else {
                                                    echo "<option value='" . ($value[0]) . "'>" . ($value[1]) . "</option>";
                                                }
                                            } else {
                                                echo "<option value='" . ($value[0]) . "'>" . ($value[1]) . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>                           
                                <?php if (isset($erro['estadoCivil'])) { ?>
                                <div class="erro">
                                    <strong>Erro!</strong> Você deve escolher uma opção para continuar.
                                </div>
                                <?php } ?>
                                <label class="control-label" for="inputEtnia">Etnia (Cor/Raça)</label>
                                <div class="controls">
                                    <select name='etnia' onchange='$("#opt2").remove();'>
                                        <option id='opt2'>Selecione um...</option>
                                        <?php
                                        include 'fnc/listaDeEtnias.php';
                                        $estados = listaDeEtnias();
                                        foreach ($estados as $key => $value) {
                                            if (isset($_POST['etnia'])) {
                                                if ($_POST['etnia'] == $key) {
                                                    echo "<option value='" . ($value[0]) . "' selected>" . ($value[1]) . "</option>";
                                                } else {
                                                    echo "<option value='" . ($value[0]) . "'>" . ($value[1]) . "</option>";
                                                }
                                            } else {
                                                echo "<option value='" . ($value[0]) . "'>" . ($value[1]) . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>                       
                                <?php if (isset($erro['etnia'])) { ?>
                                <div class="erro">
                                    <strong>Erro!</strong> Você deve escolher uma opção para continuar.
                                </div>
                                <?php } ?>

                                <label class="control-label" for="inputEscolaridade">Escolaridade</label>
                                <div class="controls">
                                    <select name='escolaridade' onchange='$("#opt3").remove();'>
                                        <option id='opt3'>Selecione um...</option>
                                        <?php
                                        include 'fnc/listaDeEscolaridade.php';
                                        $escolaridade = listaDeEscolaridade();
                                        foreach ($escolaridade as $key => $value) {
                                            if (isset($_POST['escolaridade'])) {
                                                if ($_POST['escolaridade'] == ($value[0])) {
                                                    echo '<option value=' . ($value[0]) . ' selected>' . ($value[1]) . '</option>';
                                                } else {
                                                    echo '<option value=' . ($value[0]) . '>' . ($value[1]) . '</option>';
                                                }
                                            } else {
                                                echo '<option value=' . ($value[0]) . '>' . ($value[1]) . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>                      
                                <?php if (isset($erro['escolaridade'])) { ?>
                                <div class="erro">
                                    <strong>Erro!</strong> Você deve escolher uma opção para continuar.
                                </div>
                                <?php } ?>


                                <label class="control-label" for="inputProfissao">Profissão</label>
                                <div class="controls">
                                    <select name='profissao' id='inputProfissao' onchange='if ($(this).val() == 11 || $(this).val() == 43 || $(this).val() == 9) {
                                    $("#enderecoTrabalho").css("display", "none");
                                } else {
                                $("#enderecoTrabalho").css("display", "inherit");
                            }
                            $("#opt4").remove();'>
                            <option id='opt4'>Selecione um...</option>
                            <?php
                            include 'fnc/listaDeProfissoes.php';
                            $profissoes = listaDeProfissoes();
                            foreach ($profissoes as $key => $value) {
                                if (isset($_POST['profissao'])) {
                                    if ($_POST['profissao'] != 40) {
                                        if ($_POST['profissao'] == $value[0]) {
                                            echo '<option value=' . $value[0] . ' selected>' . ($value[1]) . '</option>';
                                        } else {
                                            echo '<option value=' . $value[0] . '>' . ($value[1]) . '</option>';
                                        }
                                    } else {
                                            echo '<option value=' . $value[0] . '>' . ($value[1]) . '</option>';
                                        }
                                } else {
                                    if ($_POST['profissao'] != 40) {
                                        echo '<option value=' . $value[0] . '>' . ($value[1]) . '</option>';
                                    }
                                }
                            }

                            if (isset($_POST['profissao'])) {
                                if ($_POST['profissao'] == 40) {
                                    echo "<option value=40 selected>Outras / Não Listada</option>";
                                } else {
                                    echo "<option value=40>Outras / Não Listada</option>";
                                }
                            } else {
                                echo "<option value=40>Outras / Não Listada</option>";
                            }
                            ?>
                        </select>
                    </div>                      
                    <?php if (isset($erro['profissao'])) { ?>
                    <div class="erro">
                        <strong>Erro!</strong> Você deve escolher uma opção para continuar.
                    </div>
                    <?php } ?>
                    <label class="control-label" for="inputReligiao">Religião</label>
                    <div class="controls">
                        <select name='religiao' id='inputReligiao' onchange='$("#opt5").remove();'>
                            <option id='opt5'>Selecione um...</option>
                            <?php
                            include 'fnc/listaDeReligioes.php';
                            $religioes = listaDeReligioes();
                            foreach ($religioes as $key => $value) {
                                if (isset($_POST['religiao'])) {
                                    if ($_POST['religiao'] == ($value[0])) {
                                        echo '<option value=' . ($value[0]) . ' selected>' . ($value[1]) . '</option>';
                                    } else {
                                        echo '<option value=' . ($value[0]) . '>' . ($value[1]) . '</option>';
                                    }
                                } else {
                                    echo '<option value=' . ($value[0]) . '>' . ($value[1]) . '</option>';
                                }
                            }
                            ?>                                        
                        </select>
                    </div>                      
                    <?php if (isset($erro['religiao'])) { ?>
                    <div class="erro">
                        <strong>Erro!</strong> Você deve escolher uma opção para continuar.
                    </div>
                    <?php } ?>

                    <label class="control-label" for="inputNacionalidade">País da Nacionalidade</label>
                    <div class="controls">
                        <select id='inputNacionalidade' name='nacionalidade' 
                        onchange='if ($(this).val() == 30) {
                        $("#inputNaturalidade").removeAttr("disabled");
                        $("#inputNaturalidade").removeAttr("title");
                    }
                    else {
                    $("#inputNaturalidade").attr("disabled", "");
                    $("#inputNaturalidade").attr("title", "Preenchimento obrigatório somente para brasileiros.");
                }'>
                <?php
                include 'fnc/listaDePaises.php';
                $maeses = listaDePaises();
                foreach ($maeses as $key => $value) {
                    if (isset($_POST['nacionalidade'])) {
                        if ($_POST['nacionalidade'] == $value[0]) {
                            echo '<option value="' . $value[0] . '" selected>' . ($value[1]) . '</option>';
                        }
                        else
                            echo '<option value="' . $value[0] . '">' . ($value[1]) . '</option>';
                    }
                    else {
                        if (30 == $value[0]) {
                            echo '<option value="' . $value[0] . '" selected>' . ($value[1]) . '</option>';
                        }
                        else
                            echo '<option value="' . $value[0] . '">' . ($value[1]) . '</option>';
                    }
                }
                ?>
            </select>
        </div>

        <label class="control-label" for="inputNaturalidade">Naturalidade (UF)</label>
        <div class="controls">
            <select name='naturalidade' id="inputNaturalidade" onchange="buscaMunicipio($(this).val(), 'inputNaturalidadeM');
            $('#opt6').remove();" 
            <?php
            if (isset($_POST['nacionalidade'])) {
                if ($_POST['nacionalidade'] != '30') {
                    echo 'disabled';
                }
            }
            ?>>
            <option id='opt6'>Selecione um...</option>
            <?php
            include_once 'fnc/listaDeEstados.php';
            $estados = listaDeEstados();
            foreach ($estados as $key => $value) {
                if (isset($_POST['naturalidade'])) {
                    if ($_POST['naturalidade'] == $key) {
                        echo '<option value=' . $key . ' selected>' . ($value[1]) . '</option>';
                    } else {
                        echo '<option value=' . $key . '>' . ($value[1]) . '</option>';
                    }
                } else {
                    echo '<option value=' . $key . '>' . ($value[1]) . '</option>';
                }
            }
            ?>
        </select>
    </div>                   
    <?php if (isset($erro['naturalidade'])) { ?>
    <div class="erro">
        <strong>Erro!</strong> Você deve escolher uma opção para continuar.
    </div>
    <?php } ?>

    <label class="control-label" for="inputNaturalidadeM">Naturalidade (Município)</label>
    <div class="controls">
        <select name='naturalidadeM' id="inputNaturalidadeM" <?php
        if (!isset($_POST['naturalidade'])) {
            echo 'disabled';
        } else {
            if ($_POST['naturalidade'] == '') {
                echo 'disabled';
            }
            if ($_POST['naturalidade'] == 'Selecione um...')
                echo 'disabled';
        }
        ?>>
        <option></option>
        <?php
        include 'fnc/listaDeMunicipios.php';
        if (isset($_POST['naturalidade'])) {
            $municipios = listaDeMunicipios($_POST['naturalidade']);
        }
        foreach ($municipios as $key => $value) {
            if (isset($_POST['naturalidadeM'])) {
                if ($_POST['naturalidadeM'] == $key) {
                    echo '<option value=' . $key . ' selected>' . ($value[1]) . '</option>';
                } else {
                    echo '<option value=' . $key . '>' . ($value[1]) . '</option>';
                }
            } else {
                echo '<option value=' . $key . '>' . ($value[1]) . '</option>';
            }
        }
        ?>
    </select>
</div>           
<?php if (isset($erro['naturalidadeM'])) { ?>
<div class="erro">
    <strong>Erro!</strong> Você deve escolher uma opção.
</div>
<?php } ?>

<label class="control-label" for="inputTelResidencial">Telefone Residencial</label>
<div class="controls">
    <select name="ufTelefone" id="inputUfTelefone" style='width: 50px;'
    onchange='
    if ($(this).val() < 30) {
    $("#inputTelResidencial").attr("data-mask", "999999999")
}'>
<?php
include 'fnc/buscaDDD.php';
$ddd = buscaDDD();
foreach ($ddd as $key => $value) {
    if ($value[0] == 48) {
        echo '<option value="' . $value[0] . '" selected>' . $value[0] . '</option>';
    }
    echo '<option value="' . $value[0] . '">' . $value[0] . '</option>';
}
?>
</select>
<input name='telefone' type="text" style='width: 195px;' id="inputTelResidencial" data-mask='99999999'
<?php
if (isset($_POST['telefone'])) {
    echo 'value="' . $_POST['telefone'] . '"';
}
?>>
</div>

<label class="control-label" for="inputTelCelular">Telefone Celular</label>
<div class="controls">
    <select name="ufCelular" id="inputUfCelular" style='width: 50px;'
    onchange='
    if ($(this).val() < 30) {
    $("#inputTelCelular").attr("data-mask", "999999999")
}'>
<?php
$ddd = buscaDDD();
foreach ($ddd as $key => $value) {
    if ($value[0] == 48) {
        echo '<option value="' . $value[0] . '" selected>' . $value[0] . '</option>';
    }
    echo '<option value="' . $value[0] . '">' . $value[0] . '</option>';
}
?>
</select>
<input name='celular' style='width: 195px;' type="text" id="inputTelCelular" data-mask='99999999'
<?php
if (isset($_POST['celular'])) {
    echo 'value="' . $_POST['celular'] . '"';
}
?>>
</div>

<label class="control-label" for="inputTelComercial">Telefone Comercial</label>
<div class="controls">
    <select name="ufComercial" id="inputUfComercial" style='width: 50px;'
    onchange='
    if ($(this).val() < 30) {
    $("#inputTelComercial").attr("data-mask", "999999999")
}'>
<?php
$ddd = buscaDDD();
foreach ($ddd as $key => $value) {
    if ($value[0] == 48) {
        echo '<option value="' . $value[0] . '" selected>' . $value[0] . '</option>';
    }
    echo '<option value="' . $value[0] . '">' . $value[0] . '</option>';
}
?>
</select>
<input name='comercial' style='width: 195px;' type="text" id="inputTelComercial" data-mask='99999999'
<?php
if (isset($_POST['comercial'])) {
    echo 'value="' . $_POST['comercial'] . '"';
}
?>>
</div>           
<?php if (isset($erro['telefones'])) { ?>
<div class="erro">
    <strong>Erro!</strong> Você deve fornecer pelo menos um número de telefone.
</div>
<?php } ?>

<label class="control-label" for="inputEmail">E-mail</label>
<div class="controls">
    <input name='email' type="email" id="inputEmail" 
    <?php
    if (isset($_POST['email'])) {
        echo 'value="' . $_POST['email'] . '"';
    }
    ?>>
</div>
<h5>Endereço Residencial</h5>

<label class="control-label" for="inputCEP">CEP</label>
<div class="controls">
    <input name='cep' type="text" id="inputCEP" data-mask='99.999-999' 
    onchange='buscaEndereco($(this).val(), "inputLogradouro", "inputBairro", "inputMunicipio", "inputEstado", "labelBairro");'
    <?php
    if (isset($_POST['cep'])) {
       echo 'value="' . $_POST['cep'] . '"';
   }
   ?>>
</div>     
<h5>Não sabe seu CEP? Clique <span class='linkSpan' onclick='window.open("http://www.buscacep.correios.com.br")'>aqui</span> e descubra!</h5>              
<?php if (isset($erro['cep'])) { ?>
<div class="erro">
    <strong>Erro!</strong> Preencha um CEP válido.
</div>
<?php } ?>         
<?php if (isset($erro['cepInvalido'])) { ?>
<div class="erro">
    <strong>Erro!</strong> Preencha um CEP válido.
</div>
<?php } ?>

<label class="control-label" for="inputLogradouro">Logradouro</label>
<div class="controls">
    <input name='logradouro' type="text" id="inputLogradouro"
    <?php
    if (isset($_POST['logradouro'])) {
        echo 'value="' . $_POST['logradouro'] . '"';
    }
    ?>>
</div>            
<?php if (isset($erro['logradouro'])) { ?>
<div class="erro">
    <strong>Erro!</strong> Você deve entrar um logradouro válido.
</div>
<?php } ?>

<label class="control-label" for="inputNumero">Número
    <span class="dica" data-toggle="tooltip" title="Caso o endereço não tenha número, preencha com o número 0">?</span>
</label>
<div class="controls">
    <input name='numero' type="text" id="inputNumero"
    <?php
    if (isset($_POST['numero'])) {
        echo 'value="' . $_POST['numero'] . '"';
    }
    ?>>
</div>      
<?php if (isset($erro['numero'])) { ?>
<div class="erro">
    <strong>Erro!</strong> Você deve entrar um número válido.
</div>
<?php } ?> 
<?php if (isset($erro['numeroInvalido'])) { ?>
<div class="erro">
    <strong>Erro!</strong> Você deve entrar um número válido.
</div>
<?php } ?>

<label class="control-label" for="inputComplemento">Complemento</label>
<div class="controls">
    <input name='complemento' type="text" id="inputComplemento"
    <?php
    if (isset($_POST['complemento'])) {
        echo 'value="' . $_POST['complemento'] . '"';
    }
    ?>>
</div>   

<label class="control-label" for="inputEstado">Unidade Federal</label>
<div class="controls">
    <select name='estado' id="inputEstado" onchange="buscaMunicipio($(this).val(), 'inputMunicipio');">
        <option></option>
        <?php
        $estados = listaDeEstados();
        foreach ($estados as $key => $value) {
            if (isset($_POST['estado'])) {
                if ($key == $_POST['estado']) {
                    echo '<option value="' . $key . '" selected>' . ($value[1]) . '</option>';
                } else {
                    echo '<option value="' . $key . '">' . ($value[1]) . '</option>';
                }
            } else {
                echo '<option value="' . $key . '">' . ($value[1]) . '</option>';
            }
        }
        ?>
    </select>
</div>
<?php if (isset($erro['estado'])) { ?>
<div class="erro">
    <strong>Erro!</strong> Você deve escolher uma opção.
</div>
<?php } ?>

<label class="control-label" for="inputMunicipio">Município</label>
<div class="controls">
    <select name='municipio' id="inputMunicipio"    onchange="if($(this).val() != 8452){ $('#inputBairro').css('display', 'none'); $('#labelBairro').css('display', 'none'); } 
    else {$('#inputBairro').css('display', 'inherit'); $('#labelBairro').css('display', 'inherit');} "> 
    <option></option>
    <?php
    if (isset($_POST['estado'])) {
        $municipios = listaDeMunicipios($_POST['estado']);
    }
    foreach ($municipios as $key => $value) {
        if (isset($_POST['municipio'])) {
            if ($key == $_POST['municipio']) {
                echo '<option value="' . $key . '" selected>' . ($value[1]) . '</option>';
            } else {
                echo '<option value="' . $key . '">' . ($value[1]) . '</option>';
            }
        } else {
            echo '<option value="' . $key . '">' . ($value[1]) . '</option>';
        }
    }
    ?>
</select>
</div>
<?php if (isset($erro['municipio'])) { ?>
<div class="erro">
    <strong>Erro!</strong> Você deve escolher uma opção.
</div>
<?php } ?>


<label class="control-label" id="labelBairro" for="inputBairro"
<?php
if (isset($_POST['municipio'])) {
    if ($_POST['municipio'] != 8452) {
        echo 'style="display: none;"';
    }
}
?>>Bairro</label>
<div class="controls">
    <select name='bairro' id="inputBairro"
    <?php
    if (isset($_POST['municipio'])) {
        if ($_POST['municipio'] != 8452) {
            echo 'style="display: none;"';
        }
    }
    ?>>
    <option></option>
    <?php
    include 'fnc/listaDeBairros.php';
    $bairros = listaDeBairros(8452);
    foreach ($bairros as $key => $value) {
        if ($key == $_POST['bairro']) {
            echo '<option value="' . $key . '" selected>' . ($value[1]) . '</option>';
        } else {
            echo '<option value="' . $key . '">' . ($value[1]) . '</option>';
        }
    }
    ?>
</select>
</div>
<?php if (isset($erro['bairro'])) { ?>
<div class="erro">
    <strong>Erro!</strong> Você deve escolher uma opção.
</div>
<?php } ?>

<div id='enderecoTrabalho'  <?php
if (isset($_POST['profissao'])) {
    if ($_POST['profissao'] == 11 || $_POST['profissao'] == 9 || $_POST['profissao'] == 43) {
        echo 'style="display: none;"';
    }
}
?>>
<h5>Turnos do Trabalho</h5>

<div class="control-group highlight" style="">
    <label class="control-label" for="inputTurnos">Indique os turnos em que você está trabalhando</label>
    <div class="controls">                
        <label>
            <input id='1' type="checkbox" name="turnos[]" value="mat"
            <?php
            if (isset($_POST['turnos'])) {
                if (in_array('mat', $_POST['turnos'])) {
                    echo 'checked';
                }
            }
            ?>>
            <font style='position: relative; top: 3px; left: 0px; display: inline;'>
                Matutino
            </font>
        </label>
        <label>
            <input id='1' type="checkbox" name="turnos[]" value="ves"
            <?php
            if (isset($_POST['turnos'])) {
                if (in_array('ves', $_POST['turnos'])) {
                    echo 'checked';
                }
            }
            ?>>
            <font style='position: relative; top: 3px; left: 0px; display: inline;'>
                Vespertino
            </font>
        </label>
        <label>
            <input id='1' type="checkbox" name="turnos[]" value="not"
            <?php
            if (isset($_POST['turnos'])) {
                if (in_array('not', $_POST['turnos'])) {
                    echo 'checked';
                }
            }
            ?>>
            <font style='position: relative; top: 3px; left: 0px; display: inline;'>
                Noturno
            </font>
        </label>
    </div>
</div>
<h5>Endereço do Trabalho</h5>
<h5>Não sabe seu CEP? Clique <span class='linkSpan' onclick='window.open("http://www.buscacep.correios.com.br")'>aqui</span> e descubra!</h5>

<label class="control-label" for="inputCEPTrabalho">CEP</label>
<div class="controls">
    <input name='cepTrabalho' type="text" id="inputCEPTrabalho" data-mask='99.999-999' 
    onchange='buscaEndereco($(this).val(), "inputLogradouroTrabalho", "inputBairroTrabalho", "inputMunicipioTrabalho", "inputEstadoTrabalho", "labelBairroTrabalho");'
    <?php
    if (isset($_POST['cepTrabalho'])) {
       echo 'value="' . $_POST['cepTrabalho'] . '"';
   }
   ?>>
</div>
<?php if (isset($erro['cepInvalidoTrabalho'])) { ?>
<div class="erro">
    <strong>Erro!</strong> Você deve escolher uma opção.
</div>
<?php } ?>

<label class="control-label" for="inputLogradouroTrabalho">Logradouro</label>
<div class="controls">
    <input name='logradouroTrabalho' type="text" id="inputLogradouroTrabalho"
    <?php
    if (isset($_POST['logradouroTrabalho'])) {
        echo 'value="' . $_POST['logradouroTrabalho'] . '"';
    }
    ?>>
</div>
<?php if (isset($erro['logradouroTrabalho'])) { ?>
<div class="erro">
    <strong>Erro!</strong> Você deve fornecer um logradouro.
</div>
<?php } ?>

<label class="control-label" for="inputNumeroTrabalho">Número
    <span class="dica" data-toggle="tooltip" title="Caso o endereço não tenha número, preencha com o número 0">?</span>
</label>
<div class="controls">
    <input name='numeroTrabalho' type="text" id="inputNumeroTrabalho"
    <?php
    if (isset($_POST['numeroTrabalho'])) {
        echo 'value="' . $_POST['numeroTrabalho'] . '"';
    }
    ?>>
</div>
<?php if (isset($erro['numeroInvalidoTrabalho'])) { ?>
<div class="erro">
    <strong>Erro!</strong> Você deve entrar um número válido.
</div>
<?php } ?>
<?php if (isset($erro['numeroTrabalho'])) { ?>
<div class="erro">
    <strong>Erro!</strong> Você deve entrar um número válido.
</div>
<?php } ?>

<label class="control-label" for="inputComplementoTrabalho">Complemento</label>
<div class="controls">
    <input name='complementoTrabalho' type="text" id="inputComplementoTrabalho"
    <?php
    if (isset($_POST['complementoTrabalho'])) {
        echo 'value="' . $_POST['complementoTrabalho'] . '"';
    }
    ?>>
</div>

<label class="control-label" for="inputEstadoTrabalho">Unidade Federal</label>
<div class="controls">
    <select name='estadoTrabalho' id="inputEstadoTrabalho" onchange="buscaMunicipio($(this).val(), 'inputMunicipioTrabalho');"  >
        <option></option>
        <?php
        $estados = listaDeEstados();
        foreach ($estados as $key => $value) {
            if (isset($_POST['estadoTrabalho'])) {
                if ($key == $_POST['estadoTrabalho']) {
                    echo '<option value="' . $key . '" selected>' . ($value[1]) . '</option>';
                } else {
                    echo '<option value="' . $key . '">' . ($value[1]) . '</option>';
                }
            } else {
                echo '<option value="' . $key . '">' . ($value[1]) . '</option>';
            }
        }
        ?>
    </select>
</div>
<?php if (isset($erro['estadoTrabalho'])) { ?>
<div class="erro">
    <strong>Erro!</strong> Você deve escolher uma opção.
</div>
<?php } ?>

<label class="control-label" for="inputMunicipioTrabalho">Município</label>
<div class="controls">
    <select name='municipioTrabalho' id="inputMunicipioTrabalho" 
    onchange="if($(this).val() != 8452){ $('#inputBairroTrabalho').css('display', 'none'); $('#labelBairroTrabalho').css('display', 'none'); } 
    else {$('#inputBairroTrabalho').css('display', 'inherit'); $('#labelBairroTrabalho').css('display', 'inherit');} "> 
    <?php
    if (!isset($_POST['estadoTrabalho'])) {
        echo 'disabled';
    }
    ?>>
    <option></option>
    <?php
    if (isset($_POST['estadoTrabalho'])) {
        $municipios = listaDeMunicipios($_POST['estadoTrabalho']);
    }
    foreach ($municipios as $key => $value) {
        if (isset($_POST['municipioTrabalho'])) {
            if ($key == $_POST['municipioTrabalho']) {
                echo '<option value="' . $key . '" selected>' . ($value[1]) . '</option>';
            } else {
                echo '<option value="' . $key . '">' . ($value[1]) . '</option>';
            }
        } else {
            echo '<option value="' . $key . '">' . ($value[1]) . '</option>';
        }
    }
    ?>
</select>
</div>
<?php if (isset($erro['municipioTrabalho'])) { ?>
<div class="erro">
    <strong>Erro!</strong> Você deve escolher uma opção.
</div>
<?php } ?>
<label class="control-label" id='labelBairroTrabalho' for="inputBairroTrabalho"
<?php
if (isset($_POST['municipioTrabalho'])) {
    if ($_POST['municipioTrabalho'] != 8452) {
        echo 'style="display: none;"';
    }
}
?>>Bairro</label>
<div class="controls">
    <select name='bairroTrabalho' id="inputBairroTrabalho"
    <?php
    if (isset($_POST['municipioTrabalho'])) {
        if ($_POST['municipioTrabalho'] != 8452) {
            echo 'style="display: none;"';
        }
    }
    ?>> 
    <option></option>
    <?php
    $bairros = listaDeBairros(8452);
    foreach ($bairros as $key => $value) {
        if ($key == $_POST['bairroTrabalho']) {
            echo '<option value="' . $key . '" selected>' . ($value[1]) . '</option>';
        } else {
            echo '<option value="' . $key . '">' . ($value[1]) . '</option>';
        }
    }
    ?>
</select>
</div>
<?php if (isset($erro['bairroTrabalho'])) { ?>
<div class="erro">
    <strong>Erro!</strong> Você deve escolher uma opção.
</div>
<?php } ?>
</div>
</form>
<hr>
<a class='btn btn-primary pull-right' onclick='$("#form1").submit();'>Salvar</a>
<a class='btn pull-right' style='margin-right: 5px;' href='editarAlunoInfantil.php?idAluno=<?php echo $_GET['idAluno']; ?>'>Voltar</a>;
</div>
</div>   
</div>
</div> <!-- /container -->

        <!-- Le javascript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="js/jquery-1.9.1.js"></script>
        <script src="js/bootstrap.js"></script>
        <script type="text/javascript">
          function setCaretPosition(elemId, caretPos) {
              var elem = document.getElementById(elemId);

              if (elem != null) {
                  if (elem.createTextRange) {
                      var range = elem.createTextRange();
                      range.move('character', caretPos);
                      range.select();
                  }
                  else {
                      if (elem.selectionStart) {
                          elem.focus();
                          elem.setSelectionRange(caretPos, caretPos);
                      }
                      else
                          elem.focus();
                  }
              }
          }

          function verificaCaracteres(elemento) {
              var string = $(elemento).val();
              var caracter = string.substr(string.length - 1, string.length);
              var letra = caracter.toUpperCase();
              if (letra < "A" || letra > "Z") {
                  if (letra != " ") {
                      $(elemento).val(string.substr(0, string.length - 1));
                  }
              } else {
                  $(elemento).val(string.substr(0, string.length - 1) + letra);
              }

          }
      </script>
      <script type="text/javascript">
        function buscaMunicipio(id_estado, id_elemento) {
            id_elemento = '#' + id_elemento.toString();
            if (id_estado != '') {
                $.get("ajax/municipios.php", {id_estado: id_estado})
                .done(function(data) {
                    $(id_elemento).html(data);
                    $(id_elemento).removeAttr('disabled');
                });
            } else {
                $(id_elemento).html("<select></select>");
                $(id_elemento).attr('disabled', '');
            }
        }

    </script>
    <script type="text/javascript">
        function buscaEndereco(cd_cep, id_elemento_logradouro, id_elemento_bairro, id_elemento_localidade, id_elemento_estado, id_elemento_label_bairro) {

            $.get("ajax/endereco.php", {cd_cep: cd_cep})
            .done(function(data) {

                var ar = JSON.parse(data);
                $('#foraDaArea').css('display', 'none');
                $('#CepNaoEncontrado').css('display', 'none');

                if (ar.length === 8) {
                    if (ar[4] != '8452') {
                        $("#" + id_elemento_estado + ">option[value='" + ar[6] + "']").attr('selected', '');
                        $("#" + id_elemento_estado).attr('disabled', '');
                        $("#" + id_elemento_localidade).attr('disabled', '');
                        $("#" + id_elemento_localidade).html('<option value="' + ar[4] + '" selected>' + ar[5] + '</option>');
                        $("#" + id_elemento_bairro).attr('disabled', '');
                        $("#" + id_elemento_bairro).css('display', 'none');
                        $("#" + id_elemento_label_bairro).css('display', 'none');
                        $("#" + id_elemento_logradouro).val(ar[1]);
                    } else {
                        $("#" + id_elemento_estado + ">option[value='" + ar[6] + "']").attr('selected', '');
                        $("#" + id_elemento_estado).attr('disabled', '');
                        $("#" + id_elemento_localidade).attr('disabled', '');
                        $("#" + id_elemento_localidade).html('<option value="' + ar[4] + '"selected>' + ar[5] + '</option>');
                        $("#" + id_elemento_bairro).removeAttr('disabled');
                        $("#" + id_elemento_bairro).css('display', 'inherit');
                        $("#" + id_elemento_label_bairro).css('display', 'inherit');
                        $("#" + id_elemento_bairro + ">option:selected").removeAttr('selected');
                        $("#" + id_elemento_bairro + ">option[value='" + ar[2] + "']").attr('selected', '');
                        $("#" + id_elemento_logradouro).val(ar[1]);
                    }
                } else {
                    $('#CepNaoEncontrado').css('display', 'inherit');
                }
            });

}

$('.dica').tooltip();
$('#conteudo').css('display', 'inherit');
</script>

</body>
</html>
