<?php
session_name('re_eja');
session_start();

if (!isset($_SESSION['autenticado_rematricula_eja'])){
    header("Location: index.php");
}

if (count($_POST)) {

    if(isset($_POST['estadoCivil'])){
        if($_POST['estadoCivil'] == 'Selecione um...'){
            $erro['estadoCivil'] = true;
        }
    } else {
        $erro['estadoCivil'] = true;
    }

    if(isset($_POST['etnia'])){
        if($_POST['etnia'] == 'Selecione um...'){
            $erro['etnia'] = true;
        }
    } else {
        $erro['etnia'] = true;
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

//Existe a obrigatoriedade da entrada de pelo menos 1 telefone

    if ((!isset($_POST['telefone'])) && (!isset($_POST['comercial'])) && (!isset($_POST['celular']))) {
        $erro['telefones'] = true;
    } else {
        if (($_POST['telefone'] == '') && ($_POST['comercial'] == '') && ($_POST['celular'] == '')) {
            $erro['telefones'] = true;
        }
    }
}

//VALIDAR CAMPOS NAO OBRIGATORIOS
//se o rg foi passado, data, orgao emissor e estado do orgao emissor sao obrigatorios
if (isset($_POST['possuiRG'])) {
    if ($_POST['possuiRG'] == 'sim') {
        include 'fnc/verificaDataPassado.php';
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

include 'fnc/buscaAluno.php';
$aluno = buscaAluno($_SESSION['id']);
$data = explode('-', $aluno[1]);

if (isset($data[2])) {
    if (isset($data[1])) {
        if (isset($data[0])) {
            $data = $data[2] . '/' . $data[1] . '/' . $data[0];
        }
    }
}

if ($data == '//') {
    $data = '';
}

$_SESSION['identificacao']['nome_aluno'] = $aluno[0];
$_SESSION['identificacao']['data_nascimento'] = $data;

include 'fnc/buscaInfoAluno.php';
$infoAluno = buscaInfoAluno($_SESSION['id']);

$_SESSION['dados_pessoais']['sexo'] = strtolower($infoAluno[0]);

if(isset($infoAluno[1])){
    $_SESSION['dados_pessoais']['etnia'] = $infoAluno[1];
}
if (isset($infoAluno[2])) {
    $_SESSION['dados_pessoais']['nacionalidade'] = $infoAluno[2];
}
if (isset($infoAluno[4])) {
    $_SESSION['dados_pessoais']['naturalidade']['uf'] = $infoAluno[4];
}
if (isset($infoAluno[3])) {
    $_SESSION['dados_pessoais']['naturalidade']['municipio'] = $infoAluno[3];
}

include 'fnc/buscaEstadoCivil.php';
$estado_civil = buscaEstadoCivil($_SESSION['id']);
if(isset($estado_civil)){
    $_SESSION['dados_pessoais']['estado_civil'] = $estado_civil[0];
}

include 'fnc/buscaTel.php';
$telefones = buscaTel($_SESSION['id']);
if (isset($telefones[1])) {
    $_SESSION['dados_pessoais']['telefones']['celular'] = $telefones[1][4];
}
if (isset($telefones[2])) {
    $_SESSION['dados_pessoais']['telefones']['residencial'] = $telefones[2][4];
}
if (isset($telefones[3])) {
    $_SESSION['dados_pessoais']['telefones']['comercial'] = $telefones[3][4];
}

include 'fnc/buscaDocumento.php';
include 'fnc/buscaEstado.php';
$rg = buscaDocumento($_SESSION['id'], 1);
if ($rg != false) {
    $_SESSION['dados_pessoais']['rg']['possui'] = 'sim';
    $_SESSION['dados_pessoais']['rg']['numero'] = $rg[3];
    $temp = explode('/', $rg[4]);
    $id_estado = buscaEstado($temp[1]);
    $_SESSION['dados_pessoais']['rg']['orgao_rg'] = $temp[0];
    $_SESSION['dados_pessoais']['rg']['uf_rg'] = $id_estado;
    $temp = explode('-', $rg['5']);
    $data = $temp[2] . '/' . $temp[1] . '/' . $temp[0];
    $_SESSION['dados_pessoais']['rg']['data_rg'] = $data;
}

$certidao = buscaDocumento($_SESSION['id'], 2);

if ($certidao != false) {
    $_SESSION['dados_pessoais']['certidao']['tipo_certidao'] = 'novo';
    $_SESSION['dados_pessoais']['certidao']['numero'] = $certidao[3];
} else {
    $certidao = buscaDocumento($_SESSION['id'], 4);
    if ($certidao != false) {
        $_SESSION['dados_pessoais']['certidao']['tipo_certidao'] = 'antigo';
        $_SESSION['dados_pessoais']['certidao']['termo'] = $certidao[3];
        $_SESSION['dados_pessoais']['certidao']['cartorio'] = $certidao[8];
        $_SESSION['dados_pessoais']['certidao']['uf_cart'] = buscaEstado($certidao[9])[0];
        $_SESSION['dados_pessoais']['certidao']['livro'] = $certidao[7];
        $_SESSION['dados_pessoais']['certidao']['folha'] = $certidao[6];
    } else {
        $_SESSION['dados_pessoais']['certidao']['tipo_certidao'] = 'naoPossui';
    }
}

//todo

if (count($_POST) > 0) {
    if (!isset($erro)) {
        $_SESSION['identificacao']['nome_aluno'] = $_POST['nome'];
        $_SESSION['identificacao']['data_nascimento'] = $_POST['dataNascimento'];
        $_SESSION['dados_pessoais']['nome_aluno'] = $_POST['nome'];
        $_SESSION['dados_pessoais']['data_nascimento'] = $_POST['dataNascimento'];
        $_SESSION['dados_pessoais']['sexo'] = $_POST['sexo'];
        $_SESSION['dados_pessoais']['etnia'] = $_POST['etnia'];
        $_SESSION['dados_pessoais']['rg']['possui'] = $_POST['possuiRG'];
        if ($_SESSION['dados_pessoais']['rg']['possui'] == 'sim') {
            $_SESSION['dados_pessoais']['rg']['numero'] = $_POST['rg'];
            $_SESSION['dados_pessoais']['rg']['orgao_rg'] = $_POST['orgaoRG'];
            $_SESSION['dados_pessoais']['rg']['uf_rg'] = $_POST['uf_rg'];
            $_SESSION['dados_pessoais']['rg']['data_rg'] = $_POST['dataRG'];
        }

        $_SESSION['dados_pessoais']['certidao']['tipo_certidao'] = $_POST['tipoCertidao'];
        if ($_SESSION['dados_pessoais']['certidao']['tipo_certidao'] == 'antigo') {
            $_SESSION['dados_pessoais']['certidao']['termo'] = $_POST['certidao'];
            $_SESSION['dados_pessoais']['certidao']['cartorio'] = $_POST['cartorio'];
            $_SESSION['dados_pessoais']['certidao']['uf_cart'] = $_POST['uf_cart'];
            $_SESSION['dados_pessoais']['certidao']['livro'] = $_POST['livro'];
            $_SESSION['dados_pessoais']['certidao']['folha'] = $_POST['folha'];
        } elseif ($_SESSION['dados_pessoais']['certidao']['tipo_certidao'] == 'novo') {
            $_SESSION['dados_pessoais']['certidao']['numero'] = $_POST['novaCertidao'];
        }

        $_SESSION['dados_pessoais']['estado_civil'] = $_POST['estadoCivil'];
        $_SESSION['dados_pessoais']['nacionalidade'] = $_POST['nacionalidade'];
        $_SESSION['dados_pessoais']['naturalidade']['uf'] = $_POST['naturalidade'];
        $_SESSION['dados_pessoais']['naturalidade']['municipio'] = $_POST['naturalidadeM'];

        $_SESSION['dados_pessoais']['telefones']['residencial'] = $_POST['telefone'];
        $_SESSION['dados_pessoais']['telefones']['ufResidencial'] = $_POST['ufTelefone'];
        $_SESSION['dados_pessoais']['telefones']['comercial'] = $_POST['comercial'];
        $_SESSION['dados_pessoais']['telefones']['ufComercial'] = $_POST['ufComercial'];
        $_SESSION['dados_pessoais']['telefones']['celular'] = $_POST['celular'];
        $_SESSION['dados_pessoais']['telefones']['ufCelular'] = $_POST['ufCelular'];

        $_SESSION['preenchido']['dados_pessoais'] = true;

        header("Location: outrosDadosRematriculaEJA.php");
    }
}


if (isset($_SESSION['dados_pessoais']['sexo'])) {
    $_POST['sexo'] = $_SESSION['dados_pessoais']['sexo'];
}
if (isset($_SESSION['dados_pessoais']['estado_civil'])) {
    $_POST['estadoCivil'] = $_SESSION['dados_pessoais']['estado_civil'];
}
if (isset($_SESSION['dados_pessoais']['etnia'])) {
    $_POST['etnia'] = $_SESSION['dados_pessoais']['etnia'];
}
if (isset($_SESSION['dados_pessoais']['rg']['possui'])) {
    $_POST['possuiRG'] = $_SESSION['dados_pessoais']['rg']['possui'];
}
if (isset($_SESSION['dados_pessoais']['rg']['numero'])) {
    $_POST['rg'] = $_SESSION['dados_pessoais']['rg']['numero'];
}
if (isset($_SESSION['dados_pessoais']['rg']['orgao_rg'])) {
    $_POST['orgaoRG'] = $_SESSION['dados_pessoais']['rg']['orgao_rg'];
}
if (isset($_SESSION['dados_pessoais']['rg']['uf_rg'])) {
    $_POST['uf_rg'] = $_SESSION['dados_pessoais']['rg']['uf_rg'];
}
if (isset($_SESSION['dados_pessoais']['rg']['data_rg'])) {
    $_POST['dataRG'] = $_SESSION['dados_pessoais']['rg']['data_rg'];
}
if (isset($_SESSION['dados_pessoais']['certidao']['tipo_certidao'])) {
    $_POST['tipoCertidao'] = $_SESSION['dados_pessoais']['certidao']['tipo_certidao'];
}
if (isset($_SESSION['dados_pessoais']['certidao']['termo'])) {
    $_POST['certidao'] = $_SESSION['dados_pessoais']['certidao']['termo'];
}
if (isset($_SESSION['dados_pessoais']['certidao']['livro'])) {
    $_POST['livro'] = $_SESSION['dados_pessoais']['certidao']['livro'];
}
if (isset($_SESSION['dados_pessoais']['certidao']['folha'])) {
    $_POST['folha'] = $_SESSION['dados_pessoais']['certidao']['folha'];
}
if (isset($_SESSION['dados_pessoais']['certidao']['cartorio'])) {
    $_POST['cartorio'] = $_SESSION['dados_pessoais']['certidao']['cartorio'];
}
if (isset($_SESSION['dados_pessoais']['certidao']['uf_cart'])) {
    $_POST['uf_cart'] = $_SESSION['dados_pessoais']['certidao']['uf_cart'];
}
if (isset($_SESSION['dados_pessoais']['certidao']['numero'])) {
    $_POST['novaCertidao'] = $_SESSION['dados_pessoais']['certidao']['numero'];
}
if (isset($_SESSION['dados_pessoais']['nacionalidade'])) {
    $_POST['nacionalidade'] = $_SESSION['dados_pessoais']['nacionalidade'];
}
if (isset($_SESSION['dados_pessoais']['naturalidade']['uf'])) {
    $_POST['naturalidade'] = $_SESSION['dados_pessoais']['naturalidade']['uf'];
}
if (isset($_SESSION['dados_pessoais']['naturalidade']['municipio'])) {
    $_POST['naturalidadeM'] = $_SESSION['dados_pessoais']['naturalidade']['municipio'];
}
if (isset($_SESSION['dados_pessoais']['telefones']['residencial'])) {
    if (isset($telefones[2][3])) {
        $_POST['ufTelefone'] = $telefones[2][3];
    }
    $_POST['telefone'] = $_SESSION['dados_pessoais']['telefones']['residencial'];
}
if (isset($_SESSION['dados_pessoais']['telefones']['comercial'])) {
    if (isset($telefones[3][3])) {
        $_POST['ufComercial'] = $telefones[3][3];
    }
    $_POST['comercial'] = $_SESSION['dados_pessoais']['telefones']['comercial'];
}
if (isset($_SESSION['dados_pessoais']['telefones']['celular'])) {
    if (isset($telefones[1][3])) {
        $_POST['ufCelular'] = $telefones[1][3];
    }
    $_POST['celular'] = $_SESSION['dados_pessoais']['telefones']['celular'];
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
                    <div class = "span3" style = "padding-left: 10px;">
                        <div class = 'itemLaranja ativo'>
                            Dados de Identificação
                        </div>
                        <div class = 'itemVerde ativo'>
                            Dados Pessoais
                        </div>
                        <div class = 'itemCinza roxo'>
                            Outros Dados
                        </div>
                        <div class='itemCinza azul'>
                            Dados de Localização
                        </div>
                        <div class='itemCinza marrom'>
                            Dados Escolares
                        </div>
                        <div class = 'itemCinza oliva'>
                            Dados dos Pais
                        </div>
                        <div class = 'itemCinza t'>
                            Dados de Renda
                        </div>
                        <div class = 'itemCinza verde-azulado'>
                            Confirmação
                        </div>
                    </div>

                    <div class = "span8 folha" style='display: none;' id='conteudo'>
                        <img src = "img/canto.png" style = "position: relative; left: -238px; top: -10px;">
                        <!--TODO - Atenção: Diferenças entre Infantil e Básica-->
                        <form class = "form-horizontal" method = "post" 
                        onsubmit='$("#inputEstado").removeAttr("disabled");
                        $("#inputMunicipio").removeAttr("disabled");
                        $("#inputNaturalidade").removeAttr("disabled");'>
                        <div class = "control-group">
                            <label class = "control-label" for = "inputNome">Nome Completo</label>
                            <div class = "controls">
                                <input name = 'nome' type = "text" id = "inputNome" placeholder = "Nome Completo do Aluno" value = '<?php
                                if (isset($_SESSION['identificacao']['nome_aluno'])) {
                                    echo $_SESSION['identificacao']['nome_aluno'];
                                }
                                ?>'>
                            </div>
                            <label class = "control-label" for = "inputDataNasc">Data de Nascimento</label>
                            <div class = "controls">
                                <input name = 'dataNascimento' type = "text" value = '<?php
                                if (isset($_SESSION['identificacao']['data_nascimento'])) {
                                    echo $_SESSION['identificacao']['data_nascimento'];
                                }
                                ?>' class = 'datepicker' id = "inputDataNasc" placeholder = "dd/mm/aaaa" data-mask = '99/99/9999' onselect = "setCaretPosition($(this), 0);" required>
                            </div>
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
                            <?php if (isset($erro['etnia'])) { ?>
                            <div class="erro">
                                <strong>Erro!</strong> Você deve escolher uma opção para continuar.
                            </div>
                            <?php } ?>
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
                                <input name='orgaoRG' type='text' id='inputOrgaoRG' onkeypress='verificaMaiusculo("#inputOrgaoRG");' onkeyup='verificaMaiusculo("#inputOrgaoRG");'  placeholder='Órgão Emissor'  style='margin-top: 5px; width:130px;'  value='<?php
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
                        $('#divCertidaoAntiga').css('display', 'none')">Não Possui<br>
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
                        <input onkeypress='verificaMaiusculo("#inputCartorio");' onkeyup='verificaMaiusculo("#inputCartorio");' value='<?php if (isset($_POST['cartorio'])) echo $_POST['cartorio']; ?>' name='cartorio' type="text" id="inputCartorio">
                    </div>                    
                    <label class="control-label" for="inputCartorioUF">UF Cartório</label>
                    <div class="controls">
                        <select name='uf_cart' style='margin-top: 5px;'>
                            <option></option>
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
        function verificaMaiusculo(elemento) {
            var string = $(elemento).val();
            var caracter = string.substr(string.length - 1, string.length);
            var letra = caracter.toUpperCase();
            if (letra < "A" || letra > "Z") {

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
        $('#conteudo').css('display', 'inherit');
    </script>
</body>
</html>
