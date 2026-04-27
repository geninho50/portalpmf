<?php
session_name('ma');
session_start();

if (!$_SESSION['preenchido']['escola']) {
    header('Location: dadosEscolares.php');
}

include 'fnc/listaDeEstados.php';

if (isset($_SESSION['dados_pessoais']['com_quem_mora'])) {
    $moraComAluno = in_array('pai', $_SESSION['dados_pessoais']['com_quem_mora']);
} else {
    $moraComAluno = false;
}

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
//bairro
    if (!isset($_POST['bairro'])) {
        $erro['bairro'] = true;
    } else {
        if ($_POST['bairro'] == '') {
            $erro['bairro'] = true;
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
        $_SESSION['pai']['nome'] = $_POST['nome'];
        $_SESSION['pai']['data_nascimento'] = $_POST['dataNascimento'];
        $_SESSION['pai']['cpf'] = $_POST['cpf'];
        $_SESSION['pai']['sexo'] = $_POST['sexo'];
        $_SESSION['pai']['estado_civil'] = $_POST['estadoCivil'];
        $_SESSION['pai']['etnia'] = $_POST['etnia'];
        $_SESSION['pai']['escolaridade'] = $_POST['escolaridade'];
        $_SESSION['pai']['profissao'] = $_POST['profissao'];
        $_SESSION['pai']['religiao'] = $_POST['religiao'];
        $_SESSION['pai']['nacionalidade'] = $_POST['nacionalidade'];
        $_SESSION['pai']['naturalidade'] = $_POST['naturalidade'];
        $_SESSION['pai']['naturalidade_municipio'] = $_POST['naturalidadeM'];
        $_SESSION['pai']['telefone'] = $_POST['ufTelefone'] . $_POST['telefone'];
        $_SESSION['pai']['celular'] = $_POST['ufCelular'] . $_POST['celular'];
        $_SESSION['pai']['comercial'] = $_POST['ufComercial'] . $_POST['comercial'];
        $_SESSION['pai']['email'] = $_POST['email'];
        $_SESSION['pai']['cep_trabalho'] = $_POST['cepTrabalho'];
        $_SESSION['pai']['logradouro_trabalho'] = $_POST['logradouroTrabalho'];
        $_SESSION['pai']['numero_trabalho'] = $_POST['numeroTrabalho'];
        $_SESSION['pai']['complemento_trabalho'] = $_POST['complementoTrabalho'];
        $_SESSION['pai']['bairro_trabalho'] = $_POST['bairroTrabalho'];
        $_SESSION['pai']['estado_trabalho'] = $_POST['estadoTrabalho'];
        $_SESSION['pai']['municipio_trabalho'] = $_POST['municipioTrabalho'];
        $_SESSION['pai']['cep'] = $_POST['cep'];
        $_SESSION['pai']['logradouro'] = $_POST['logradouro'];
        $_SESSION['pai']['numero'] = $_POST['numero'];
        $_SESSION['pai']['complemento'] = $_POST['complemento'];
        $_SESSION['pai']['bairro'] = $_POST['bairro'];
        $_SESSION['pai']['estado'] = $_POST['estado'];
        $_SESSION['pai']['municipio'] = $_POST['municipio'];
        $_SESSION['pai']['mora_aluno'] = $moraComAluno;
        $_SESSION['pai']['turnos'] = $_POST['turnos'];

        if ($_SESSION['dados_pessoais']['quem_acompanha'] == 'pai') {
            $_SESSION['pai']['quem_acompanha'] = true;
        }
        include 'fnc/inserirResponsavel.php';
        if (!isset($_SESSION['preenchido']['pai'])) {
            (inserirResponsavel($_SESSION['pai'], null, 'pai', $_SESSION['aluno']['id']));
            $_SESSION['preenchido']['pai'] = true;
        } else {
            if ($_SESSION['preenchido']['pai'] != true) {
                (inserirResponsavel($_SESSION['pai'], $_SESSION['pai']['id'], 'pai', $_SESSION['aluno']['id']));
                $_SESSION['preenchido']['pai'] = true;
            } else {
                include 'fnc/atualizarResponsavel.php';
                (atualizarResponsavel($_SESSION['pai'], $_SESSION['pai']['id'], 'pai', $_SESSION['aluno']['id']));
            }
        }

        header("Location: dadosResponsavel.php");
    }
}

if ($moraComAluno) {
    $_POST['cep'] = $_SESSION['localizacao']['cep'];
    $_POST['logradouro'] = $_SESSION['localizacao']['logradouro'];
    $_POST['numero'] = $_SESSION['localizacao']['numero'];
    $_POST['complemento'] = $_SESSION['localizacao']['complemento'];
    $_POST['bairro'] = $_SESSION['localizacao']['bairro'];
    $_POST['estado'] = $_SESSION['localizacao']['estado'];
    $_POST['municipio'] = $_SESSION['localizacao']['municipio'];
}

if (isset($_SESSION['pai']['turnos'])) {
    $_POST['turnos'] = $_SESSION['pai']['turnos'];
}
if (isset($_SESSION['pai']['nome'])) {
    $_POST['nome'] = $_SESSION['pai']['nome'];
}
if (isset($_SESSION['pai']['data_nascimento'])) {
    $_POST['dataNascimento'] = $_SESSION['pai']['data_nascimento'];
}
if (isset($_SESSION['pai']['cpf'])) {
    $_POST['cpf'] = $_SESSION['pai']['cpf'];
}
if (isset($_SESSION['pai']['sexo'])) {
    $_POST['sexo'] = $_SESSION['pai']['sexo'];
}
if (isset($_SESSION['pai']['estado_civil'])) {
    $_POST['estadoCivil'] = $_SESSION['pai']['estado_civil'];
}
if (isset($_SESSION['pai']['etnia'])) {
    $_POST['etnia'] = $_SESSION['pai']['etnia'];
}
if (isset($_SESSION['pai']['escolaridade'])) {
    $_POST['escolaridade'] = $_SESSION['pai']['escolaridade'];
}
if (isset($_SESSION['pai']['profissao'])) {
    $_POST['profissao'] = $_SESSION['pai']['profissao'];
}
if (isset($_SESSION['pai']['religiao'])) {
    $_POST['religiao'] = $_SESSION['pai']['religiao'];
}
if (isset($_SESSION['pai']['nacionalidade'])) {
    $_POST['nacionalidade'] = $_SESSION['pai']['nacionalidade'];
}
if (isset($_SESSION['pai']['telefone'])) {
    $_POST['ufTelefone'] = substr($_SESSION['pai']['telefone'], 0, 2);
    $_POST['telefone'] = substr($_SESSION['pai']['telefone'], 2);
}
if (isset($_SESSION['pai']['comercial'])) {
    $_POST['ufComercial'] = substr($_SESSION['pai']['comercial'], 0, 2);
    $_POST['comercial'] = substr($_SESSION['pai']['comercial'], 2);
}
if (isset($_SESSION['pai']['celular'])) {
    $_POST['ufCelular'] = substr($_SESSION['pai']['celular'], 0, 2);
    $_POST['celular'] = substr($_SESSION['pai']['celular'], 2);
}
if (isset($_SESSION['pai']['email'])) {
    $_POST['email'] = $_SESSION['pai']['email'];
}
if (isset($_SESSION['pai']['cep_trabalho'])) {
    $_POST['cepTrabalho'] = $_SESSION['pai']['cep_trabalho'];
}
if (isset($_SESSION['pai']['logradouro_trabalho'])) {
    $_POST['logradouroTrabalho'] = $_SESSION['pai']['logradouro_trabalho'];
}
if (isset($_SESSION['pai']['numero_trabalho'])) {
    $_POST['numeroTrabalho'] = $_SESSION['pai']['numero_trabalho'];
}
if (isset($_SESSION['pai']['complemento_trabalho'])) {
    $_POST['complementoTrabalho'] = $_SESSION['pai']['complemento_trabalho'];
}
if (isset($_SESSION['pai']['bairro_trabalho'])) {
    $_POST['bairroTrabalho'] = $_SESSION['pai']['bairro_trabalho'];
}
if (isset($_SESSION['pai']['estado_trabalho'])) {
    $_POST['estadoTrabalho'] = $_SESSION['pai']['estado_trabalho'];
}
if (isset($_SESSION['pai']['municipio_trabalho'])) {
    $_POST['municipioTrabalho'] = $_SESSION['pai']['municipio_trabalho'];
}
if (isset($_SESSION['pai']['cep'])) {
    $_POST['cep'] = $_SESSION['pai']['cep'];
}
if (isset($_SESSION['pai']['logradouro'])) {
    $_POST['logradouro'] = $_SESSION['pai']['logradouro'];
}
if (isset($_SESSION['pai']['numero'])) {
    $_POST['numero'] = $_SESSION['pai']['numero'];
}
if (isset($_SESSION['pai']['complemento'])) {
    $_POST['complemento'] = $_SESSION['pai']['complemento'];
}
if (isset($_SESSION['pai']['bairro'])) {
    $_POST['bairro'] = $_SESSION['pai']['bairro'];
}
if (isset($_SESSION['pai']['estado'])) {
    $_POST['estado'] = $_SESSION['pai']['estado'];
}
if (isset($_SESSION['pai']['municipio'])) {
    $_POST['municipio'] = $_SESSION['pai']['municipio'];
}
if (isset($_SESSION['pai']['naturalidade'])) {
    $_POST['naturalidade'] = $_SESSION['pai']['naturalidade'];
}
if (isset($_SESSION['pai']['naturalidade_municipio'])) {
    $_POST['naturalidadeM'] = $_SESSION['pai']['naturalidade_municipio'];
}

if(isset($_POST['nome'])){
    if($_POST['nome'] == ''){
        if(isset($_SESSION['identificacao']['nome_pai'])){
            $_POST['nome'] == $_SESSION['identificacao']['nome_pai'];
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" CONTENT="NO-CACHE">
    <title>SGE &middot; Dados do Pai</title>
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
      </head>

      <body>

        <div class="container">
            <?php include 'shared/topo.php'; ?>
            <?php include 'shared/barraTopo.php'; ?>
            <div class='conteudo'>
                <div class='row-fluid' style='text-align: center; height: 90px;'>
                    <div style='text-align: center; padding-top: 15px;'>
                        <h3>Dados do Pai</h3>
                        <img src="img/lapis.png" style="width: 470px; position:relative; top: -65px; left: -25px;">
                    </div>
                </div>
                <div class='row-fluid' style='text-align: center;'>
                    <?php include 'shared/barraLateral.php'; ?>

                    <div class="span8 folha" style='display: none;' id='conteudo'>
                        <img src="img/canto.png" style="position: relative; left: -238px; top: -10px;">
                        <form class="form-horizontal" method="post" 
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
                                id="inputCPF" placeholder="999.999.999-99" data-mask='999.999.999-99' onselect="setCaretPosition($(this), 0);" required>
                            </div>
                            <?php if (isset($erro['cpfInvalido'])) { ?>
                            <div class="erro">
                                <strong>Erro!</strong> CPF Inválido.
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
                                <select name='profissao' id='inputProfissao' onchange='if ($(this).val() == 11 || $(this).val() == 9 || $(this).val() == 43) {
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
                                    echo '<option value=' . $value[0] . '>' . ($value[1]) . '</option>';
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
            $paises = listaDePaises();
            foreach ($paises as $key => $value) {
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
<input name='telefone' type="text" id="inputTelResidencial" style='width: 195px;' data-mask='99999999'
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
<input name='celular' type="text" id="inputTelCelular" style='width: 195px;' data-mask='99999999'
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
<input name='comercial' type="text" id="inputTelComercial" style='width: 195px;' data-mask='99999999'
<?php
if (isset($_POST['comercial'])) {
    echo 'value="' . $_POST['comercial'] . '"';
}
?>>
</div>
<?php if (isset($erro['telefones'])) { ?>
<div class="erro">
    <strong>Erro!</strong> No mínimo um telefone deve ser fornecido!
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

<label class="control-label" for="inputNumero">Número</label>
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
    <select disabled name='estado' id="inputEstado" onchange="buscaMunicipio($(this).val(), 'inputMunicipio');">
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
    <select name='municipio' id="inputMunicipio" disabled onchange='if ($(this).val() != "8452") {
    $("#inputBairro").attr("disabled", "");
} else {
$("#inputBairro").removeAttr("disabled");
}
;'>
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
<div id='enderecoTrabalho'  <?php
if (isset($_POST['profissao'])) {
    if ($_POST['profissao'] == 11 || $_POST['profissao'] == 9 || $_POST['profissao'] == 43) {
        echo 'style="display: none;"';
    }
}
?>>
<label class="control-label" id='labelBairro' for="inputBairro">Bairro</label>
<div class="controls">
    <select name='bairro' id="inputBairro" disabled>
        <option></option>
        <?php
        include 'fnc/listaDeBairros.php';
        $bairros = listaDeBairros(8452);
        foreach ($bairros as $key => $value) {
            if(isset($_POST['bairro'])){
                if ($key == $_POST['bairro']) {
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
<?php if (isset($erro['bairro'])) { ?>
<div class="erro">
    <strong>Erro!</strong> Você deve escolher uma opção.
</div>
<?php } ?>

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

<label class="control-label" for="inputNumeroTrabalho">Número</label>
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
    <select disabled name='estadoTrabalho' id="inputEstadoTrabalho" onchange="buscaMunicipio($(this).val(), 'inputMunicipioTrabalho');"  >
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
    <select name='municipioTrabalho' id="inputMunicipioTrabalho" <?php
    if (!isset($_POST['estadoTrabalho'])) {
        echo 'disabled';
    }
    ?> onchange='if ($(this).val() != "8452") {
    $("#inputBairroTrabalho").attr("disabled", "");
} else {
$("#inputBairroTrabalho").removeAttr("disabled");
}
;'>
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
</div>
<?php if (isset($erro['municipioTrabalho'])) { ?>
<div class="erro">
    <strong>Erro!</strong> Você deve escolher uma opção.
</div>
<?php } ?>

<label class="control-label" id='labelBairroTrabalho' for="inputBairroTrabalho"<?php
if (isset($_POST['municipioTrabalho'])) {
    if ($_POST['municipioTrabalho'] != 8452) {
        echo 'style="display: none;"';
    }
}
?>>Bairro</label>
<div class="controls">
    <select name='bairroTrabalho' id="inputBairroTrabalho" disabled
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
        if(isset($_POST['bairroTrabalho'])){
            if ($key == $_POST['bairroTrabalho']) {
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
<?php if (isset($erro['bairroTrabalho'])) { ?>
<div class="erro">
    <strong>Erro!</strong> Você deve escolher uma opção.
</div>
<?php } ?>

<a class='btn' href='dadosMae.php'>Voltar</a>
<a class='btn btn-warning' href='dadosResponsavel.php' <?php
if ($moraComAluno) {
    echo 'style="display: none;"';
}
?>>Pular</a>
<button class='btn btn-primary'>Avan&ccedil;ar</button>
</form>
</div>   
</div>

<noscript>
    <div class="span8" style='padding-left: 10px;'>
        <div class="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>AVISO!</strong> Você está com o JavaScript desabilitado. 
            <bR> Para continuar baixe o navegador Google Chrome <a href='http://www.google.com/intl/pt-BR/chrome/'>aqui</a>
                <br> ou habilite o JavaScript em seu navegador seguindo <a href='http://www.enable-javascript.com/pt/'>estas instruções</a>.
            </div>
        </div>
    </noscript>
    
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
                        $("#" + id_elemento_bairro).css('display', '');
                        $("#" + id_elemento_label_bairro).css('display', '');
                        $("#" + id_elemento_bairro + ">option:selected").removeAttr('selected');
                        $("#" + id_elemento_bairro + ">option[value='" + ar[2] + "']").attr('selected', '');
                        $("#" + id_elemento_logradouro).val(ar[1]);
                    }
                } else {
                    $('#CepNaoEncontrado').css('display', 'inherit');
                }
            });

}

</script>
<script>
     $('#conteudo').css('display', 'inherit');
    $('#bl1').addClass('itemLaranja');
    $('#bl1').addClass('ativo');
    $('#bl1').removeClass('item');
    $('#bl2').addClass('itemVerde');
    $('#bl2').addClass('ativo');
    $('#bl2').removeClass('item');
    $('#bl3').addClass('itemRoxo');
    $('#bl3').addClass('ativo');
    $('#bl3').removeClass('item');
    $('#bl4').addClass('itemAzul');
    $('#bl4').addClass('ativo');
    $('#bl4').removeClass('item');
    $('#bl5').addClass('itemMarrom');
    $('#bl5').addClass('ativo');
    $('#bl5').removeClass('item');
    $('#bl6').addClass('itemAmarelo');
    $('#bl6').addClass('ativo');
    $('#bl6').removeClass('item');
    $('#bl7').addClass('itemOliva');
    $('#bl7').addClass('ativo');
    $('#bl7').removeClass('item');
    $('#bl8').addClass('itemCinza');
    $('#bl8').addClass('t');
    $('#bl8').removeClass('item');
    $('#bl9').addClass('itemCinza');
    $('#bl9').addClass('verde-azulado');
    $('#bl9').removeClass('item');
</script>
<?php
if ($moraComAluno) {
    echo '<script>';
    echo "$('#inputCEP').attr('disabled', '');";
    echo "$('#inputLogradouro').attr('disabled', '');";
    echo "$('#inputNumero').attr('disabled', '');";
    echo "$('#inputComplemento').attr('disabled', '');";
    echo "$('#inputBairro').attr('disabled', '');";
    echo "$('#inputEstado').attr('disabled', '');";
    echo "$('#inputMunicipio').attr('disabled', '');";
    echo '</script>';
}
?>

</body>
</html>
