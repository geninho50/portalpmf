<?php
session_name('re');
session_start();

if (!$_SESSION['autenticado_rematricula']) {
    header('Location: loginRematricula.php');
}

if (isset($_GET['curso'])) {
    $_SESSION['curso'] = $_GET['curso'];
} else {
    if (!isset($_SESSION['curso'])) {
        header('Location: index.php');
    }
}
if (isset($_GET['ano'])) {
    $_SESSION['periodo_ano'] = $_GET['ano'];
} else {
    if (!isset($_SESSION['periodo_ano'])) {
        header('Location: index.php');
    }
}
if (isset($_GET['periodo'])) {
    $_SESSION['id_periodo'] = $_GET['periodo'];
} else {
    if (!isset($_SESSION['id_periodo'])) {
        header('Location: index.php');
    }
}

if (isset($_GET['tipoMatricula'])) {
    $_SESSION['tipoMatricula'] = $_GET['tipoMatricula'];
} else {
    if (!isset($_SESSION['tipoMatricula'])) {
        header('Location: index.php');
    }
}

if (isset($_POST['nome'])) {
    if ($_POST['nome'] == '') {
        $erro['nome_vazio'] = true;
    }
} else {
    
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

//if (isset($_POST['nomeResponsavel'])) {
//    if ($_POST['nomeResponsavel'] == '') {
//        $erro['nome_resp_vazio'] = true;
//    }
//}
//if (isset($_POST['cpf'])) {
//    if ($_POST['cpf'] == '') {
//        $erro['cpf_vazio'] = true;
//    } else {
//        if ($_POST['cpf'] == '___.___.___-__') {
//            $erro['cpf_vazio'] = true;
//        } else {
//            include 'fnc/verificaCPF.php';
//            if (!verificaCPF($_POST['cpf'])) {
//                $erro['cpf_invalido'] = true;
//            }
//        }
//    }
//}

include 'fnc/buscaAluno.php';
$aluno = buscaAluno($_SESSION['id']);
include 'fnc/buscaResponsavelAluno.php';
$resp = buscaResponsavelAluno($aluno[3]);

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
$_SESSION['identificacao']['cpf_responsavel'] = substr($resp[2], 0, 3) . '.' .
        substr($resp[2], 3, 3) . '.' .
        substr($resp[2], 6, 3) . '-' .
        substr($resp[2], 9, 2);

$alteracao = false;

if (isset($_POST['nome'])) {
    if ($_POST['nome'] != $_SESSION['identificacao']['nome_aluno']) {
        $alteracao = true;
    }
}

if (isset($_POST['dataNascimento'])) {
    if ($_POST['dataNascimento'] != $_SESSION['identificacao']['data_nascimento']) {
        $alteracao = true;
    }
}

if (isset($_POST['nomeResponsavel'])) {
    if ($_POST['nomeResponsavel'] != $_SESSION['identificacao']['nome_responsavel']) {
        $alteracao = true;
    }
}

if (isset($_POST['cpf'])) {
    if ($_POST['cpf'] != $_SESSION['identificacao']['cpf_responsavel']) {
        $alteracao = true;
    }
}

if (isset($_POST['parentesco'])) {
    if ($_POST['parentesco'] != $_SESSION['identificacao']['parentesco']) {
        $alteracao = true;
    }
}
if (isset($_POST['nome'])) {
    if (!isset($erro)) {
        $_SESSION['identificacao']['nome_aluno'] = $_POST['nome'];
        $_SESSION['identificacao']['data_nascimento'] = $_POST['dataNascimento'];
        $_SESSION['identificacao']['nome_mae'] = $_POST['nomeMae'];
        $_SESSION['identificacao']['nome_pai'] = $_POST['nomePai'];
        $_SESSION['identificacao']['nome_responsavel'] = $_POST['nomeResponsavel'];
//        $_SESSION['identificacao']['cpf_responsavel'] = $_POST['cpf'];
//        $_SESSION['identificacao']['parentesco'] = $_POST['parentesco'];
//        if ($_POST['parentesco'] == 'outros') {
//            $_SESSION['identificacao']['outros'] = $_POST['outros'];
//        }
        //$_SESSION['alteracao']['identificacao'] = true;
        $_SESSION['preenchido']['identificacao'] = true;
        header("Location: dadosPessoaisAlunoRematricula.php");
    }
}

if ($resp[1] == '1') {
    $_SESSION['identificacao']['parentesco'] = 'mae';
} else {
    if ($resp[1] == '2') {
        $_SESSION['identificacao']['parentesco'] = 'pai';
    } else {
        if ($resp[1] == '3') {
            $_SESSION['identificacao']['parentesco'] = 'outros';
        }
    }
}

if (isset($_SESSION['identificacao']['nome_aluno'])) {
    $_POST['nome'] = $_SESSION['identificacao']['nome_aluno'];
}
if (isset($_SESSION['identificacao']['cpf_responsavel'])) {
    $_POST['cpf'] = $_SESSION['identificacao']['cpf_responsavel'];
}
if (isset($_SESSION['identificacao']['nome_mae'])) {
    $_POST['nomeMae'] = $_SESSION['identificacao']['nome_mae'];
}
if (isset($_SESSION['identificacao']['nome_pai'])) {
    $_POST['nomePai'] = $_SESSION['identificacao']['nome_pai'];
}
if (isset($_SESSION['identificacao']['nome_responsavel'])) {
    $_POST['nomeResponsavel'] = $_SESSION['identificacao']['nome_responsavel'];
}
if (isset($_SESSION['identificacao']['data_nascimento'])) {
    $_POST['dataNascimento'] = $_SESSION['identificacao']['data_nascimento'];
}
if (isset($_SESSION['identificacao']['parentesco'])) {
    $_POST['parentesco'] = $_SESSION['identificacao']['parentesco'];
}
if (isset($_SESSION['identificacao']['outros'])) {
    $_POST['outros'] = $_SESSION['identificacao']['outros'];
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" CONTENT="NO-CACHE">
        <title>SGE &middot; Identifica&ccedil;&atilde;o do Aluno</title>
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
                        <h3>Dados de Identifica&ccedil;&atilde;o do Aluno</h3>
                        <img src="img/lapis.png" style="width: 470px; position:relative; top: -65px; left: -25px;">
                    </div>
                </div>
                <div class='row-fluid' style='text-align: center;'>
                    <div class="span3" style="padding-left: 10px;">
                        <div class='itemLaranja ativo'>
                            Dados de Identificação  
                        </div>
                        <div class='itemCinza verde'>
                            Dados Pessoais  
                        </div>
                        <div class='itemCinza roxo'>
                            Outros Dados
                        </div>
                        <div class='itemCinza azul'>
                            Dados de Saúde
                        </div>
                        <div class='itemCinza marrom'>
                            Dados de Localização
                        </div>
                        <div class='itemCinza oliva'>
                            Dados dos Pais
                        </div>
                        <div class='itemCinza t'>
                            Dados de Renda
                        </div>
                        <div class='itemCinza verde-azulado'>
                            Confirmação
                        </div>
                    </div>

                    <div class="span8 folha" style='display: none;' id='conteudo'>
                        <img src="img/canto.png" style="position: relative; left: -238px; top: -10px;">
                        <div class="alert">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>AVISO!</strong> Este site é melhor visualizado e utilizado no navegador Google Chrome. Você pode baixa-lo <a href='http://www.google.com/intl/pt-BR/chrome/'>aqui</a>.
                        </div>
                        <form class="form-horizontal" method="post">
                            <div class="control-group">
                                <label class="control-label" for="inputNome">Nome Completo do Aluno</label>
                                <div class="controls">
                                    <input onkeypress='verificaCaracteres("#inputNome");' onkeyup='verificaCaracteres("#inputNome");'
                                           name='nome' type="text" id="inputNome" placeholder="Nome Completo do Aluno" value='<?php
                                           if (isset($_POST['nome'])) {
                                               echo $_POST['nome'];
                                           }
                                           ?>' required>
                                </div>
                                <?php if (isset($erro['nome_vazio'])) { ?>
                                    <div class="erro">
                                        <strong>Erro!</strong> Nome vazio! Entre um nome para continuar.
                                    </div>
                                <?php } ?>
                                <label class="control-label" for="inputDataNasc">Data de Nascimento</label>
                                <div class="controls">
                                    <input name='dataNascimento' value='<?php
                                    if (isset($_POST['dataNascimento'])) {
                                        echo $_POST['dataNascimento'];
                                    }
                                    ?>' type="text" class='datepicker' id="inputDataNasc" placeholder="dd/mm/aaaa" data-mask='99/99/9999' onselect="setCaretPosition($(this), 0);" required>
                                </div>
                                <?php if (isset($erro['nasc_vazio'])) { ?>
                                    <div class="erro">
                                        <strong>Erro!</strong> Data de Nascimento vazio! Entre uma data de nascimento para continuar.
                                    </div>
                                <?php } ?>
                                <?php if (isset($erro['nasc_invalido'])) { ?>
                                    <div class="erro">
                                        <strong>Erro!</strong> Data de Nascimento inválida! Entre uma data de nascimento válida para continuar.
                                    </div>
                                <?php } ?>      
                                <label class="control-label" for="inputNomeResponsavel">Nome da Mãe</label>
                                <div class="controls">
                                    <input onkeypress='verificaCaracteres("#inputNomeMae");' onkeyup='verificaCaracteres("#inputNomeMae");' name='nomeMae' type="text" value='<?php
                                    if (isset($_POST['nomeMae'])) {
                                        echo $_POST['nomeMae'];
                                    }
                                    ?>' id="inputNomeMae" placeholder="Nome da Mãe">
                                </div>
                                <?php if (isset($erro['nome_resp_vazio'])) { ?>
                                    <div class="erro">
                                        <strong>Erro!</strong> Nome do responsável vazio! Entre um nome de responsável para continuar.
                                    </div>
                                <?php } ?>
                                <label class="control-label" for="inputNomeResponsavel">Nome do Pai</label>
                                <div class="controls">
                                    <input onkeypress='verificaCaracteres("#inputNomePai");' onkeyup='verificaCaracteres("#inputNomePai");' name='nomePai' type="text" value='<?php
                                    if (isset($_POST['nomePai'])) {
                                        echo $_POST['nomePai'];
                                    }
                                    ?>' id="inputNomePai" placeholder="Nome do Pai">
                                </div>
                                <?php if (isset($erro['nome_resp_vazio'])) { ?>
                                    <div class="erro">
                                        <strong>Erro!</strong> Nome do responsável vazio! Entre um nome de responsável para continuar.
                                    </div>
                                <?php } ?>
                                <label class="control-label" for="inputNomeResponsavel">Nome do Responsavel</label>
                                <div class="controls">
                                    <input onkeypress='verificaCaracteres("#inputNomeResponsavel");' onkeyup='verificaCaracteres("#inputNomeResponsavel");' name='nomeResponsavel' type="text" value='<?php
                                    if (isset($_POST['nomeResponsavel'])) {
                                        echo $_POST['nomeResponsavel'];
                                    }
                                    ?>' id="inputNomeResponsavel" placeholder="Nome do Responsavel">
                                </div>
                                <?php if (isset($erro['nome_resp_vazio'])) { ?>
                                    <div class="erro">
                                        <strong>Erro!</strong> Nome do responsável vazio! Entre um nome de responsável para continuar.
                                    </div>
                                <?php } ?>
                                <!--                                <label class="control-label" for="inputCPF">CPF do Respons&aacute;vel</label>
                                                                <div class="controls">
                                                                    <input name='cpf' type="text" id="inputCPF" value='<?php
                                if (isset($_POST['cpf'])) {
                                    echo $_POST['cpf'];
                                }
                                ?>' placeholder="999.999.999-99" data-mask='999.999.999-99' required>
                                                                </div>-->
                                <?php if (isset($erro['cpf_vazio'])) { ?>
                                    <!--                                    <div class="erro">
                                                                            <strong>Erro!</strong> CPF vazio! Entre um CPF para continuar.
                                                                        </div>-->
                                <?php } ?>
                                <?php if (isset($erro['cpf_invalido'])) { ?>
                                    <div class="erro">
                                        <strong>Erro!</strong> CPF inválido! Entre um CPF válido para continuar.
                                    </div>
                                <?php } ?>
                                <!--                                <label class="control-label" for="inputParentesco">Grau de Parentesco</label>
                                                                <div class="controls">
                                                                    <select name='parentesco' onchange="if ($(this).val() == 'outros') {
                                                                                $('#outrosDiv').css('display', 'inherit');
                                                                                $('#inputOutros').attr('required', '');
                                                                            } else {
                                                                                $('#outrosDiv').css('display', 'none');
                                                                                $('#inputOutros').removeAttr('required');
                                                                            }">
                                                                        <option value='mae'
                                <?php
                                if (isset($_POST['parentesco'])) {
                                    if ($_POST['parentesco'] == 'mae') {
                                        echo 'selected';
                                    }
                                }
                                ?>>Mãe</option>
                                                                        <option value='pai'
                                <?php
                                if (isset($_POST['parentesco'])) {
                                    if ($_POST['parentesco'] == 'pai') {
                                        echo 'selected';
                                    }
                                }
                                ?>>Pai</option>
                                                                        <option value='outros'
                                <?php
                                if (isset($_POST['parentesco'])) {
                                    if ($_POST['parentesco'] == 'outros') {
                                        echo 'selected';
                                    }
                                }
                                ?>>Outro</option>
                                                                    </select>
                                                                </div>-->
                                <div id='outrosDiv' 
                                <?php
//                                if (isset($_POST['parentesco'])) {
//                                    if ($_POST['parentesco'] == 'outros') {
//                                        echo 'style="display: inherit;"';
//                                    }
//                                    else
//                                        echo 'style="display: none;"';
//                                }
//                                else
//                                    echo 'style="display: none;"';
                                ?>>
                                    <!--                                    <label class="control-label" for="inputOutros">Outro</label>
                                                                        <div class="controls">
                                                                            <input  onkeypress='verificaCaracteres("#inputOutros");' onkeyup='verificaCaracteres("#inputOutros");' name='outros'  id='inputOutros' type='text' style='margin-top: 5px;'
                                    <?php
//                                        if (isset($_POST['outros'])) {
//                                            echo 'value="' . $_POST['outros'] . '"';
//                                            if ($_POST['parentesco'] == 'outros') {
//                                                echo 'required';
//                                            }
//                                        }
                                    ?>>
                                                                        </div>-->
                                </div>
                            </div>
                            <button class='btn btn-primary'>Avan&ccedil;ar</button>
                        </form>
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
                                        $('#conteudo').css('display', 'inherit');
        </script>

    </body>
</html>
