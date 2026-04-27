<?php
session_name('ga');
session_start();

$cadastroAberto = 'false'; 

if($cadastroAberto == 'false'){
    header("Location: index.php");
}

//EXPIRA A SESSAO SE NAO HOUVE ATIVIDADE NOS ULTIMOS 30 MINUTOS
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    session_unset();
    session_destroy();
    header("Location: index.php");
}
$_SESSION['LAST_ACTIVITY'] = time();

if ($_SESSION['usuario']['permissoes'][3][1] != 1) {
    header('Location: index.php');
}

if (count($_POST)) {
//Caso nacionalidade for brasileira (nacionalidade = 0), naturalidade (uf) e naturalidade (municipio)
//devem estar selecionados. Se nacionalidade não for brasileira, nao devera ter informacao nos campos.
    if (isset($_POST['nacionalidade'])) {
        if ($_POST['nacionalidade'] == 30) {
            if (!isset($_POST['naturalidade'])) {
                $erro['naturalidade'] = true;
            } else {
                if ($_POST['naturalidade'] == '') {
                    $erro['naturalidade'] = true;
                }
            }
            if (!isset($_POST['naturalidadeM'])) {
                $erro['naturalidadeM'] = true;
            } else {
                if ($_POST['naturalidadeM'] == '') {
                    $erro['naturalidadeM'] = true;
                }
            }
        } else {
            $_POST['naturalidade'] = '';
            $_POST['naturalidadeM'] = '';
        }
    }


    if (isset($_POST['dataNascimento'])) {
        if ($_POST['dataNascimento'] == '') {
            $erro['nasc_vazio'] = true;
        } else {
            if ($_POST['dataNascimento'] == '__/__/____') {
                $erro['nasc_vazio'] = true;
            } else {
                include_once 'fnc/verificaDataPassado.php';
                if (!verificaDataPassado($_POST['dataNascimento'])) {
                    $erro['nasc_invalido'] = true;
                }
            }
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

//O aluno tem que morar com pelo menos 1 pessoa (Mae, Pai ou outro)
    if (!isset($_POST['comQuemMora'])) {
        $erro['comQuemMora'] = true;
    } else {
        if ($_POST['comQuemMora'] == '') {
            $erro['comQuemMora'] = true;
        }
    }
//Pelo menos uma pessoa deve acompanhar o aluno
    if (!isset($_POST['quemAcompanha'])) {
        $erro['quemAcompanha'] = true;
    } else {
        if ($_POST['quemAcompanha'] == '') {
            $erro['quemAcompanha'] = true;
        }
    }
    if (isset($_POST['jaFrequenta'])) {
        if ($_POST['jaFrequenta'] == '') {
            $erro['jaFrequenta'] = true;
        }
    } else {
        $erro['jaFrequenta'] = true;
    }
}

//VALIDAR CAMPOS NAO OBRIGATORIOS
//se o rg foi passado, data, orgao emissor e estado do orgao emissor sao obrigatorios
if (isset($_POST['possuiRG'])) {
    if ($_POST['possuiRG'] == 'sim') {
        include_once 'fnc/verificaDataPassado.php';
        if (!isset($_POST['dataRG'])) {
            $erro['dataRG'] = true;
        } elseif ($_POST['dataRG'] == '') {
            $erro['dataRG'] = true;
        } elseif ($_POST['dataRG'] == '__/__/____') {
            $erro['dataRG'] = true;
        } elseif (!verificaDataPassado($_POST['dataRG'])) {
            $erro['dataRgInvalida'] = true;
        }
        if (!isset($_POST['orgaoRG'])) {
            $erro['orgaoRG'] = true;
        } elseif ($_POST['orgaoRG'] == '') {
            $erro['orgaoRG'] = true;
        }
        if (!isset($_POST['uf_rg'])) {
            $erro['uf_rg'] = true;
        } elseif ($_POST['uf_rg'] == '') {
            $erro['uf_rg'] = true;
        }
        if (!isset($_POST['rg'])) {
            $erro['rg'] = true;
        } elseif ($_POST['rg'] == '') {
            $erro['rg'] = true;
        }
    }
}

//nova certidao
if (isset($_POST['tipoCertidao'])) {
    if ($_POST['tipoCertidao'] == 'novo') {
        if (isset($_POST['novaCertidao'])) {
            include 'fnc/verificaNovaCertidao.php';
            if (!verificaNovaCertidao($_POST['novaCertidao'])) {
                $erro['novaCertidao'] = true;
            }
        }
    }
}

if (count($_POST) > 0) {
    if (!isset($erro)) {
        $_SESSION['novo_aluno_infantil']['dados_pessoais']['nome'] = $_POST['nome'];
        $_SESSION['novo_aluno_infantil']['dados_pessoais']['data_nascimento'] = $_POST['dataNascimento'];
        $_SESSION['novo_aluno_infantil']['dados_pessoais']['sexo'] = $_POST['sexo'];
        $_SESSION['novo_aluno_infantil']['dados_pessoais']['etnia'] = $_POST['etnia'];
        $_SESSION['novo_aluno_infantil']['dados_pessoais']['rg']['possui'] = $_POST['possuiRG'];
        if ($_SESSION['novo_aluno_infantil']['dados_pessoais']['rg']['possui'] == 'sim') {
            $_SESSION['novo_aluno_infantil']['dados_pessoais']['rg']['numero'] = $_POST['rg'];
            $_SESSION['novo_aluno_infantil']['dados_pessoais']['rg']['orgao_rg'] = $_POST['orgaoRG'];
            $_SESSION['novo_aluno_infantil']['dados_pessoais']['rg']['uf_rg'] = $_POST['uf_rg'];
            $_SESSION['novo_aluno_infantil']['dados_pessoais']['rg']['data_rg'] = $_POST['dataRG'];
        }

        $_SESSION['novo_aluno_infantil']['dados_pessoais']['certidao']['tipo_certidao'] = $_POST['tipoCertidao'];
        if ($_SESSION['novo_aluno_infantil']['dados_pessoais']['certidao']['tipo_certidao'] == 'antigo') {
            $_SESSION['novo_aluno_infantil']['dados_pessoais']['certidao']['termo'] = $_POST['certidao'];
            $_SESSION['novo_aluno_infantil']['dados_pessoais']['certidao']['cartorio'] = $_POST['cartorio'];
            $_SESSION['novo_aluno_infantil']['dados_pessoais']['certidao']['uf_cart'] = $_POST['uf_cart'];
            $_SESSION['novo_aluno_infantil']['dados_pessoais']['certidao']['livro'] = $_POST['livro'];
            $_SESSION['novo_aluno_infantil']['dados_pessoais']['certidao']['folha'] = $_POST['folha'];
        } elseif ($_SESSION['novo_aluno_infantil']['dados_pessoais']['certidao']['tipo_certidao'] == 'novo') {
            $_SESSION['novo_aluno_infantil']['dados_pessoais']['certidao']['numero'] = $_POST['novaCertidao'];
        }

        $_SESSION['novo_aluno_infantil']['dados_pessoais']['nacionalidade'] = $_POST['nacionalidade'];
        $_SESSION['novo_aluno_infantil']['dados_pessoais']['naturalidade']['uf'] = $_POST['naturalidade'];
        $_SESSION['novo_aluno_infantil']['dados_pessoais']['naturalidade']['municipio'] = $_POST['naturalidadeM'];
        $_SESSION['novo_aluno_infantil']['dados_pessoais']['jaFrequenta'] = $_POST['jaFrequenta'];


        if (strlen($_POST['telefone']) >= 8) {
            $_SESSION['novo_aluno_infantil']['dados_pessoais']['telefones']['residencial'] = $_POST['ufTelefone'] . $_POST['telefone'];
        }
        if (strlen($_POST['comercial']) >= 8) {
            $_SESSION['novo_aluno_infantil']['dados_pessoais']['telefones']['comercial'] = $_POST['ufComercial'] . $_POST['comercial'];
        }
        if (strlen($_POST['celular']) >= 8) {
            $_SESSION['novo_aluno_infantil']['dados_pessoais']['telefones']['celular'] = $_POST['ufCelular'] . $_POST['celular'];
        }
        $_SESSION['novo_aluno_infantil']['dados_pessoais']['com_quem_mora'] = $_POST['comQuemMora'];
        $_SESSION['novo_aluno_infantil']['dados_pessoais']['quem_acompanha'] = $_POST['quemAcompanha'];

        $_SESSION['novo_aluno_infantil']['preenchido']['dados_pessoais'] = true;

        header("Location: dadosLocalizacaoInfantil.php");
    }
}

if (isset($_SESSION['novo_aluno_infantil']['dados_pessoais']['nome'])) {
    $_POST['nome'] = $_SESSION['novo_aluno_infantil']['dados_pessoais']['nome'];
}
if (isset($_SESSION['novo_aluno_infantil']['dados_pessoais']['dataNascimento'])) {
    $_POST['data_nascimento'] = $_SESSION['novo_aluno_infantil']['dados_pessoais']['dataNascimento'];
}
if (isset($_SESSION['novo_aluno_infantil']['dados_pessoais']['sexo'])) {
    $_POST['sexo'] = $_SESSION['novo_aluno_infantil']['dados_pessoais']['sexo'];
}
if (isset($_SESSION['novo_aluno_infantil']['dados_pessoais']['estado_civil'])) {
    $_POST['estadoCivil'] = $_SESSION['novo_aluno_infantil']['dados_pessoais']['estado_civil'];
}
if (isset($_SESSION['novo_aluno_infantil']['dados_pessoais']['jaFrequenta'])) {
    $_POST['jaFrequenta'] = $_SESSION['novo_aluno_infantil']['dados_pessoais']['jaFrequenta'];
}
if (isset($_SESSION['novo_aluno_infantil']['dados_pessoais']['etnia'])) {
    $_POST['etnia'] = $_SESSION['novo_aluno_infantil']['dados_pessoais']['etnia'];
}
if (isset($_SESSION['novo_aluno_infantil']['dados_pessoais']['rg']['possui'])) {
    $_POST['possuiRG'] = $_SESSION['novo_aluno_infantil']['dados_pessoais']['rg']['possui'];
}
if (isset($_SESSION['novo_aluno_infantil']['dados_pessoais']['rg']['numero'])) {
    $_POST['rg'] = $_SESSION['novo_aluno_infantil']['dados_pessoais']['rg']['numero'];
}
if (isset($_SESSION['novo_aluno_infantil']['dados_pessoais']['rg']['orgao_rg'])) {
    $_POST['orgaoRG'] = $_SESSION['novo_aluno_infantil']['dados_pessoais']['rg']['orgao_rg'];
}
if (isset($_SESSION['novo_aluno_infantil']['dados_pessoais']['rg']['uf_rg'])) {
    $_POST['uf_rg'] = $_SESSION['novo_aluno_infantil']['dados_pessoais']['rg']['uf_rg'];
}
if (isset($_SESSION['novo_aluno_infantil']['dados_pessoais']['rg']['data_rg'])) {
    $_POST['dataRG'] = $_SESSION['novo_aluno_infantil']['dados_pessoais']['rg']['data_rg'];
}
if (isset($_SESSION['novo_aluno_infantil']['dados_pessoais']['certidao']['tipo_certidao'])) {
    $_POST['tipoCertidao'] = $_SESSION['novo_aluno_infantil']['dados_pessoais']['certidao']['tipo_certidao'];
}
if (isset($_SESSION['novo_aluno_infantil']['dados_pessoais']['certidao']['termo'])) {
    $_POST['certidao'] = $_SESSION['novo_aluno_infantil']['dados_pessoais']['certidao']['termo'];
}
if (isset($_SESSION['novo_aluno_infantil']['dados_pessoais']['certidao']['livro'])) {
    $_POST['livro'] = $_SESSION['novo_aluno_infantil']['dados_pessoais']['certidao']['livro'];
}
if (isset($_SESSION['novo_aluno_infantil']['dados_pessoais']['certidao']['folha'])) {
    $_POST['folha'] = $_SESSION['novo_aluno_infantil']['dados_pessoais']['certidao']['folha'];
}
if (isset($_SESSION['novo_aluno_infantil']['dados_pessoais']['certidao']['cartorio'])) {
    $_POST['cartorio'] = $_SESSION['novo_aluno_infantil']['dados_pessoais']['certidao']['cartorio'];
}
if (isset($_SESSION['novo_aluno_infantil']['dados_pessoais']['certidao']['uf_cart'])) {
    $_POST['uf_cart'] = $_SESSION['novo_aluno_infantil']['dados_pessoais']['certidao']['uf_cart'];
}
if (isset($_SESSION['novo_aluno_infantil']['dados_pessoais']['certidao']['numero'])) {
    $_POST['novaCertidao'] = $_SESSION['novo_aluno_infantil']['dados_pessoais']['certidao']['numero'];
}
if (isset($_SESSION['novo_aluno_infantil']['dados_pessoais']['nacionalidade'])) {
    $_POST['nacionalidade'] = $_SESSION['novo_aluno_infantil']['dados_pessoais']['nacionalidade'];
}
if (isset($_SESSION['novo_aluno_infantil']['dados_pessoais']['naturalidade']['uf'])) {
    $_POST['naturalidade'] = $_SESSION['novo_aluno_infantil']['dados_pessoais']['naturalidade']['uf'];
}
if (isset($_SESSION['novo_aluno_infantil']['dados_pessoais']['naturalidade']['municipio'])) {
    $_POST['naturalidadeM'] = $_SESSION['novo_aluno_infantil']['dados_pessoais']['naturalidade']['municipio'];
}
if (isset($_SESSION['novo_aluno_infantil']['dados_pessoais']['telefones']['residencial'])) {
    $_POST['ufTelefone'] = substr($_SESSION['novo_aluno_infantil']['dados_pessoais']['telefones']['residencial'], 0, 2);
    $_POST['telefone'] = substr($_SESSION['novo_aluno_infantil']['dados_pessoais']['telefones']['residencial'], 2);
}

if (isset($_SESSION['novo_aluno_infantil']['dados_pessoais']['telefones']['comercial'])) {
    $_POST['ufComercial'] = substr($_SESSION['novo_aluno_infantil']['dados_pessoais']['telefones']['comercial'], 0, 2);
    $_POST['comercial'] = substr($_SESSION['novo_aluno_infantil']['dados_pessoais']['telefones']['comercial'], 2);
}
if (isset($_SESSION['novo_aluno_infantil']['dados_pessoais']['telefones']['celular'])) {
    $_POST['ufCelular'] = substr($_SESSION['novo_aluno_infantil']['dados_pessoais']['telefones']['celular'], 0, 2);
    $_POST['celular'] = substr($_SESSION['novo_aluno_infantil']['dados_pessoais']['telefones']['celular'], 2);
}
if (isset($_SESSION['novo_aluno_infantil']['dados_pessoais']['com_quem_mora'])) {
    $_POST['comQuemMora'] = $_SESSION['novo_aluno_infantil']['dados_pessoais']['com_quem_mora'];
}
if (isset($_SESSION['novo_aluno_infantil']['dados_pessoais']['quem_acompanha'])) {
    $_POST['quemAcompanha'] = $_SESSION['novo_aluno_infantil']['dados_pessoais']['quem_acompanha'];
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" CONTENT="NO-CACHE">
        <title>SGE &middot; Dados Pessoais</title>
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
        </style>
    </head>

    <body>

        <div class="container">
            <?php include 'shared/topo.php'; ?>
            <?php include 'shared/barraTopo.php'; ?>
            <div class = 'conteudo'>
                <div class = 'row-fluid' style = 'text-align: center; height: 90px;'>
                    <div style = 'text-align: center; padding-top: 15px;'>
                        <h3>Dados Pessoais do Aluno</h3>
                        <img src = "img/lapis.png" style = "width: 470px; position:relative; top: -65px; left: -25px;">
                    </div>
                </div>
                <div class = 'row-fluid' style = 'text-align: center;'>
                    <?php include 'shared/barraLateral.php'; ?>

                    <div class = "span8 folha">
                        <img src = "img/canto.png" style = "position: relative; left: -284px; top: -10px;">
                        <!--TODO - Atenção: Diferenças entre Infantil e Básica-->
                        <form class = "form-horizontal" method = "post" 
                              onsubmit='$("#inputEstado").removeAttr("disabled");
                                      $("#inputMunicipio").removeAttr("disabled");
                                      $("#inputNaturalidade").removeAttr("disabled");'>
                            <div class = "control-group">
                                <label class = "control-label" for = "inputNome">Nome Completo</label>
                                <div class = "controls">
                                    <input name = 'nome' type = "text" id = "inputNome" placeholder = "Nome Completo do Aluno" value = '<?php
                                    if (isset($_POST['nome'])) {
                                        echo $_POST['nome'];
                                    }
                                    ?>' required
                                           onkeypress="verificaCaracteres('#inputNome');" onkeyup="verificaCaracteres('#inputNome');">
                                </div>
                                <label class = "control-label" for = "inputDataNasc">Data de Nascimento</label>
                                <div class = "controls">
                                    <input name = 'dataNascimento' type = "text" value = '<?php
                                    if (isset($_SESSION['novo_aluno_infantil']['dados_pessoais']['data_nascimento'])) {
                                        echo $_SESSION['novo_aluno_infantil']['dados_pessoais']['data_nascimento'];
                                    }
                                    ?>' class = 'datepicker' id = "inputDataNasc" placeholder = "dd/mm/aaaa" data-mask = '99/99/9999' onselect = "setCaretPosition($(this), 0);" required>
                                </div>
                                <?php if (isset($erro['nasc_vazio'])) { ?>
                                    <div class="erro">
                                        <strong>Erro!</strong> Data de nascimento vazia!
                                    </div>
                                <?php } ?>
                                <?php if (isset($erro['nasc_invalido'])) { ?>
                                    <div class="erro">
                                        <strong>Erro!</strong> Data de nascimento inválida!
                                    </div>
                                <?php } ?>
                                <label class = "control-label" for = "inputSexo">Sexo</label>
                                <div class = "controls">
                                    <select name = 'sexo' onchange='$("#opt1").remove();'>
                                        <option id='opt1'>Selecione um...</option>
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

                                <label class="control-label" for="inputEtnia">Cor/Raça</label>
                                <div class="controls">
                                    <select name='etnia' onchange='$("#opt2").remove();'>
                                        <option id='opt2'>Selecione um...</option>
                                        <?php
                                        include 'fnc/listaDeEtnias.php';
                                        $etnias = listaDeEtnias();
                                        foreach ($etnias as $key => $value) {
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
                                <label class="control-label">Possui RG</label>
                                <div class="controls">                
                                    <input type="radio" name='possuiRG' value='sim' 
                                    <?php
                                    if (isset($_POST['possuiRG'])) {
                                        if ($_POST['possuiRG'] == 'sim') {
                                            echo 'checked';
                                        }
                                    }
                                    ?> 
                                           onclick="$('#divRG').css('display', 'inherit');">Sim<br>
                                    <input type="radio" name='possuiRG' value='nao'                 
                                    <?php
                                    if (isset($_POST['possuiRG'])) {
                                        if ($_POST['possuiRG'] == 'nao') {
                                            echo 'checked';
                                        }
                                    } else {
                                        echo 'checked';
                                    }
                                    ?> 
                                           onclick="$('#divRG').css('display', 'none');">Não
                                </div>
                                <div id='divRG'                 
                                <?php
                                if (isset($_POST['possuiRG'])) {
                                    if ($_POST['possuiRG'] == 'nao') {
                                        echo 'style="display: none;"';
                                    }
                                } else {
                                    echo 'style="display: none;"';
                                }
                                ?> >
                                    <label class="control-label" for="inputRG" style="padding-top: 8px;">Registro Geral (RG)</label>
                                    <div class="controls">
                                        <input name='rg' type='text' placeholder='RG' style='margin-top: 5px;' value='<?php
                                        if (isset($_POST['rg'])) {
                                            echo $_POST['rg'];
                                        }
                                        ?>'/>
                                    </div>
                                    <?php if (isset($erro['rg'])) { ?>
                                        <div class="erro">
                                            <strong>Erro!</strong> Número de RG vazio!
                                        </div>
                                    <?php } ?>
                                    <label class="control-label" for="inputOrgaoRG" style="padding-top: 8px;">Órgão Emissor</label>
                                    <div class="controls">
                                        <input name='orgaoRG' type='text' id='inputOrgaoRG' onkeypress='verificaCaracteres("#inputOrgaoRG");' onkeyup='verificaCaracteres("#inputOrgaoRG");'  placeholder='Órgão Emissor'  style='margin-top: 5px; width:130px;'  value='<?php
                                        if (isset($_POST['orgaoRG'])) {
                                            echo $_POST['orgaoRG'];
                                        }
                                        ?>'/>
                                        <select name='uf_rg' style='margin-top: 5px; width:60px;'>
                                            <option></option>
                                            <?php
                                            include 'fnc/listaDeEstados.php';
                                            $estados = listaDeEstados();
                                            foreach ($estados as $key => $value) {
                                                if (isset($_POST['uf_rg'])) {
                                                    if ($_POST['uf_rg'] == $key) {
                                                        echo "<option value='" . $key . "' selected>" . ($value[2]) . "</option>";
                                                    } else {
                                                        echo "<option value='" . $key . "'>" . ($value[2]) . "</option>";
                                                    }
                                                } else {
                                                    echo "<option value='" . $key . "'>" . ($value[2]) . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <?php if (isset($erro['orgaoRG'])) { ?>
                                        <div class="erro">
                                            <strong>Erro!</strong> Órgão Emissor do RG vazio!
                                        </div>
                                    <?php } ?>
                                    <?php if (isset($erro['uf_rg'])) { ?>
                                        <div class="erro">
                                            <strong>Erro!</strong> Estado do Órgão Emissor do RG vazio!
                                        </div>
                                    <?php } ?>
                                    <label class="control-label" for="inputDataRG">Data de Expedição</label>
                                    <div class="controls">
                                        <input name='dataRG' type="text" id="inputDataRG" placeholder="dd/mm/aaaa" data-mask='99/99/9999' onselect="setCaretPosition($(this), 0);"
                                               value='<?php
                                               if (isset($_POST['dataRG'])) {
                                                   echo $_POST['dataRG'];
                                               }
                                               ?>'
                                               >
                                    </div>
                                    <?php if (isset($erro['dataRG'])) { ?>
                                        <div class="erro">
                                            <strong>Erro!</strong> Data de expedição do RG vazio!
                                        </div>
                                    <?php } ?>
                                    <?php if (isset($erro['dataRgInvalida'])) { ?>
                                        <div class="erro">
                                            <strong>Erro!</strong> Data de expedição do RG inválida!
                                        </div>
                                    <?php } ?>
                                </div>

                                <label class="control-label">Certidão de Nascimento</label>
                                <div class="controls">                
                                    <input type="radio" name='tipoCertidao' value='antigo'               
                                    <?php
                                    if (isset($_POST['tipoCertidao'])) {
                                        if ($_POST['tipoCertidao'] == 'antigo') {
                                            echo 'checked';
                                        }
                                    }
                                    ?> 
                                           onclick="$('#divCertidaoAntiga').css('display', 'inherit');
                                      $('#divCertidaoNova').css('display', 'none')">Modelo Antigo<br>
                                    <input type="radio" name='tipoCertidao' value='novo'                
                                    <?php
                                    if (isset($_POST['tipoCertidao'])) {
                                        if ($_POST['tipoCertidao'] == 'novo') {
                                            echo 'checked';
                                        }
                                    } else {
                                        echo 'checked';
                                    }
                                    ?> 
                                           onclick="$('#divCertidaoNova').css('display', 'inherit');
                                      $('#divCertidaoAntiga').css('display', 'none')">Modelo Novo<br>
                                    <input type="radio" name='tipoCertidao' value='naoPossui'           
                                    <?php
                                    if (isset($_POST['tipoCertidao'])) {
                                        if ($_POST['tipoCertidao'] == 'naoPossui') {
                                            echo 'checked';
                                        }
                                    }
                                    ?> 
                                           onclick="$('#divCertidaoNova').css('display', 'none');
                                      $('#divCertidaoAntiga').css('display', 'none')">Não Possui Informação<br>
                                </div>

                                <div id='divCertidaoAntiga' 
                                <?php
                                if (isset($_POST['tipoCertidao'])) {
                                    if ($_POST['tipoCertidao'] != 'antigo') {
                                        echo 'style="display: none;"';
                                    }
                                } else {
                                    echo 'style="display: none;"';
                                }
                                ?>>
                                    <label class="control-label" for="inputCertidao">Certidão de Nascimento</label>
                                    <div class="controls">
                                        <input value='<?php if (isset($_POST['certidao'])) echo $_POST['certidao']; ?>' title='Preencha este campo caso o aluno tenha sua certidão no modelo antigo' placeholder='Somente números' name='certidao' type="text" id="inputCertidao">
                                    </div>
                                    <div class="controls" style='margin-left: 144px;'>
                                        <div style='display: inline; text-align: right'>
                                            <label for="inputFolha" style='display: inline;'>Folha</label>
                                            <input value='<?php if (isset($_POST['folha'])) echo $_POST['folha']; ?>' name='folha' type="text" id="inputLivro" style='margin-top: 5px; width:74px;'>
                                        </div>
                                        <div style='display: inline; text-align: right'>
                                            <label for="inputLivro" style='display: inline;'>Livro</label>
                                            <input value='<?php if (isset($_POST['livro'])) echo $_POST['livro']; ?>' name='livro' type="text" id="inputFolha" style='margin-top: 5px; width:74px; display: inline;'>
                                        </div>
                                    </div>                    
                                    <label class="control-label" for="inputCartorio">Cartório</label>
                                    <div class="controls">
                                        <input onkeypress='verificaCaracteres("#inputCartorio");' onkeyup='verificaCaracteres("#inputCartorio");' value='<?php if (isset($_POST['cartorio'])) echo $_POST['cartorio']; ?>' name='cartorio' type="text" id="inputCartorio">
                                    </div>                    
                                    <label class="control-label" for="inputCartorioUF">UF Cartório</label>
                                    <div class="controls">
                                        <select name='uf_cart' style='margin-top: 5px;'>
                                            <?php
                                            $estados = listaDeEstados();
                                            foreach ($estados as $key => $value) {
                                                if (isset($_POST['uf_cart'])) {
                                                    if ($_POST['uf_cart'] == $key) {
                                                        echo "<option value='" . $key . "' selected>" . ($value[2]) . "</option>";
                                                    } else {
                                                        echo "<option value='" . $key . "'>" . ($value[2]) . "</option>";
                                                    }
                                                } else {
                                                    if ($key == 25) {
                                                        echo "<option value='" . $key . "' selected>" . ($value[2]) . "</option>";
                                                    }
                                                    echo "<option value='" . $key . "'>" . ($value[2]) . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div id='divCertidaoNova'              
                                <?php
                                if (isset($_POST['tipoCertidao'])) {
                                    if ($_POST['tipoCertidao'] != 'novo') {
                                        echo 'style="display: none;"';
                                    }
                                }
                                ?>>
                                    <label class="control-label" title='Somente números' for="inputNovaCertidao">Nova Certidão</label>
                                    <div class="controls">
                                        <input name='novaCertidao' 
                                               value='<?php
                                               if (isset($_POST['novaCertidao'])) {
                                                   echo $_POST['novaCertidao'];
                                               }
                                               ?>'
                                               title='Somente números' maxlength="32" title='Preencha este campo caso o aluno tenha sua certidão no novo modelo' placeholder='Somente números' type="text" id="inputNovaCertidao">
                                    </div>
                                    <?php if (isset($erro['novaCertidao'])) { ?>
                                        <div class="erro">
                                            <strong>Erro!</strong> Número inválido!
                                        </div>
                                    <?php } ?>
                                </div>

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
                                      }'

                                            >
                                                <?php
                                                include 'fnc/listaDePaises.php';
                                                $paises = listaDePaises();
                                                foreach ($paises as $key => $value) {
                                                    if (isset($_POST['nacionalidade'])) {
                                                        if ($_POST['nacionalidade'] == $key) {
                                                            echo '<option value="' . $key . '" selected>' . ($value[1]) . '</option>';
                                                        }
                                                        else
                                                            echo '<option value="' . $key . '">' . ($value[1]) . '</option>';
                                                    } else {
                                                        if ($key == 30) {
                                                            echo '<option value="' . $key . '" selected>' . ($value[1]) . '</option>';
                                                        } else {
                                                            echo '<option value="' . $key . '">' . ($value[1]) . '</option>';
                                                        }
                                                    }
                                                }
                                                ?>
                                    </select>
                                </div>

                                <label class="control-label" for="inputNaturalidade">Naturalidade (UF)</label>
                                <div class="controls">
                                    <select name='naturalidade' id="inputNaturalidade" onchange="buscaMunicipio($(this).val(), 'inputNaturalidadeM');" 
                                    <?php
                                    if (isset($_POST['nacionalidade'])) {
                                        if ($_POST['nacionalidade'] != '30') {
                                            echo 'disabled';
                                        }
                                    }
                                    else
                                        echo 'disabled';
                                    ?>>
                                        <option></option>
                                        <?php
                                        $estados = listaDeEstados();
                                        foreach ($estados as $key => $value) {
                                            if (isset($_POST['naturalidade'])) {
                                                if ($_POST['naturalidade'] == $value[0]) {
                                                    echo "<option value='" . $value[0] . "' selected>" . ($value[1]) . "</option>";
                                                } else {
                                                    echo "<option value='" . $value[0] . "'>" . ($value[1]) . "</option>";
                                                }
                                            } else {
                                                echo "<option value='" . $value[0] . "'>" . ($value[1]) . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <?php if (isset($erro['naturalidade'])) { ?>
                                    <div class="erro">
                                        <strong>Erro!</strong> Unidade Federal da Naturalidade vazio!
                                    </div>
                                <?php } ?>

                                <label class="control-label" for="inputNaturalidadeM">Naturalidade (Município)</label>
                                <div class="controls">
                                    <select required name='naturalidadeM' id="inputNaturalidadeM" <?php
                                    if (!isset($_POST['naturalidade'])) {
                                        echo 'disabled';
                                    }
                                    ?>>
                                        <option></option>
                                        <?php
                                        include 'fnc/listaDeMunicipios.php';
                                        if (isset($_POST['naturalidade'])) {
                                            $municipios = listaDeMunicipios($_POST['naturalidade']);
                                        }
                                        echo "<option></option>";
                                        foreach ($municipios as $key => $value) {
                                            if (isset($_POST['naturalidadeM'])) {
                                                if ($_POST['naturalidadeM'] == $key) {
                                                    echo "<option value='" . $key . "' selected>" . ($value[1]) . "</option>";
                                                } else {
                                                    echo "<option value='" . $key . "'>" . ($value[1]) . "</option>";
                                                }
                                            } else {
                                                echo "<option value='" . $key . "'>" . ($value[1]) . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <?php if (isset($erro['naturalidadeM'])) { ?>
                                    <div class="erro">
                                        <strong>Erro!</strong> Município da Naturalidade vazio!
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

                                <label class="control-label" for="inputComQuemMora">Com quem o aluno mora?</label>
                                <div class="controls">    
                                    <label>
                                        <input type="checkbox" name="comQuemMora[]" value="pai"
                                        <?php
                                        if (isset($_POST['comQuemMora'])) {
                                            if (in_array('pai', $_POST['comQuemMora'])) {
                                                echo 'checked';
                                            }
                                        }
                                        ?>><font style='position: relative; top: 3px; left: 3px; display: inline;'>Pai</font>
                                    </label> 
                                    <label>
                                        <input type="checkbox" name="comQuemMora[]" value="mae"
                                        <?php
                                        if (isset($_POST['comQuemMora'])) {
                                            if (in_array('mae', $_POST['comQuemMora'])) {
                                                echo 'checked';
                                            }
                                        }
                                        ?>><font style='position: relative; top: 3px; left: 3px; display: inline;'>Mãe</font> 
                                    </label>
                                    <input type="checkbox" name="comQuemMora[]" 
                                           value="outro" id='outroCheckBox' <?php
                                           if (isset($_POST['comQuemMora'])) {
                                               if (in_array('outro', $_POST['comQuemMora'])) {
                                                   echo 'checked';
                                               }
                                           }
                                           ?>>
                                    <font id='textoOutroC' style='position: relative; top: 3px; left: -1px; display: inline;'>
                                    <?php
                                    echo 'Responsável';
                                    ?></font>
                                </div>
                                <?php if (isset($erro['comQuemMora'])) { ?>
                                    <div class="erro">
                                        <strong>Erro!</strong> Você deve selecionar pelo menos uma das opções!
                                    </div>
                                <?php } ?>
                                <label class="control-label" for="inputComQuemMora">Quem acompanha o aluno na vida escolar?</label>
                                <div class="controls" style='line-height: 20px;'>
                                    <label>
                                        <input type="radio" name="quemAcompanha" value="pai"  required
                                        <?php
                                        if (isset($_POST['quemAcompanha'])) {
                                            if ($_POST['quemAcompanha'] == 'pai') {
                                                echo 'checked';
                                            }
                                        }
                                        ?>><font style='position: relative; top: 3px; left: 0px; display: inline;'>Pai</font>
                                    </label>
                                    <label>
                                        <input type="radio" name="quemAcompanha" value="mae" required
                                        <?php
                                        if (isset($_POST['quemAcompanha'])) {
                                            if ($_POST['quemAcompanha'] == 'mae') {
                                                echo 'checked';
                                            }
                                        }
                                        ?>><font style='position: relative; top: 3px; left: 0px; display: inline;'>Mãe</font>
                                    </label>
                                    <label>
                                        <input type="radio" name="quemAcompanha" value="outro" id='outroRadio' required 
                                        <?php
                                        if (isset($_POST['quemAcompanha'])) {
                                            if ($_POST['quemAcompanha'] == 'outro') {
                                                echo 'checked';
                                            }
                                        }
                                        ?>><font style='position: relative; top: 3px; left: 0px; display: inline;' id='textoOutroR'><?php
                                               echo "Responsável";
                                               ?></font>
                                    </label>
                                </div>
                                <?php if (isset($erro['quemAcompanha'])) { ?>
                                    <div class="erro">
                                        <strong>Erro!</strong> Uma das opções deve ser escolhida!
                                    </div>
                                <?php } ?>

                                <div class="control-group highlight" style='margin-bottom: 0px;'>
                                    <label class="control-label" for="inputCarro">Já frequenta a rede <br>de ensino municipal <BR> de Florianópolis?</label>
                                    <div class="controls" style='line-height: 60px'>                
                                        <input type="radio" name="jaFrequenta" value="sim" 
                                        <?php
                                        if (isset($_POST['jaFrequenta'])) {
                                            if ($_POST['jaFrequenta'] == 'sim') {
                                                echo 'checked';
                                            }
                                        }
                                        ?>><font style='position: relative; top: 4px; left: 5px;'>Sim</font> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                        <input type="radio" name="jaFrequenta" value="nao"
                                        <?php
                                        if (isset($_POST['jaFrequenta'])) {
                                            if ($_POST['jaFrequenta'] == 'nao') {
                                                echo 'checked';
                                            }
                                        }
                                        ?>><font style='position: relative; top: 4px; left: 5px;'>Não</font>
                                    </div>
                                </div>      
                                <?php if (isset($erro['jaFrequenta'])) { ?>
                                    <div class="erro" style='width: 80%; margin-left: auto; margin-right: auto;'>
                                        <strong>Erro!</strong> Você deve informar se a criança já frequenta a rede municipal de ensino.
                                    </div>
                                <?php } ?>

                                <button class='btn btn-primary'>Avan&ccedil;ar</button>
                        </form>
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
            function isNumber(n) {
                return !isNaN(parseFloat(n)) && isFinite(n);
            }
            function verificaDigitos(elemento) {
                var string = $(elemento).val();
                var caracter = string.substr(string.length - 1, string.length);
                if (!isNumber(caracter)) {
                    $(elemento).val(string.substr(0, string.length - 1));
                }
            }
        </script>
        <script>
            if ($('#inputNacionalidade').val() == 30) {
                $('#inputNaturalidade').removeAttr('disabled');
            }
        </script>
        <script>
            $('#bl1').css('display', 'none');
            $('#bl2').addClass('itemVerde');
            $('#bl2').addClass('ativo');
            $('#bl2').removeClass('item');
            $('#bl3').addClass('itemCinza');
            $('#bl3').addClass('roxo');
            $('#bl3').removeClass('item');
            $('#bl4').addClass('itemCinza');
            $('#bl4').addClass('azul');
            $('#bl4').removeClass('item');
            $('#bl5').addClass('itemCinza');
            $('#bl5').addClass('marrom');
            $('#bl5').removeClass('item');
            $('#bl6').addClass('itemCinza');
            $('#bl6').addClass('amarelo');
            $('#bl6').removeClass('item');
            $('#bl7').addClass('itemCinza');
            $('#bl7').addClass('oliva');
            $('#bl7').removeClass('item');
            $('#bl8').addClass('itemCinza');
            $('#bl8').addClass('t');
            $('#bl8').removeClass('item');
            $('#bl9').addClass('itemCinza');
            $('#bl9').addClass('verde-azulado');
            $('#bl9').removeClass('item');
        </script>
    </body>
</html>
