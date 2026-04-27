<?php
session_name('re');
session_start();
if (!isset($_SESSION['temp'])) {
    include 'fnc/buscaIndividuoRenda.php';
    $inds = buscaIndividuoRenda($_SESSION['id']);
    $_SESSION['temp'] = 1;

    if (isset($inds)) {
        if ($inds != false) {
            foreach ($inds as $key => $value) {
                $data = explode('-', $value[5]);
                $temp = $data[2] . '/' . $data[1] . '/' . $data[0];
                $pessoa = [$value[7], $value[4], $value[6], $temp, $value[8], $value[3]];

                if (!isset($_SESSION['renda']['pessoas'])) {
                    $_SESSION['renda']['pessoas'] = array();
                }
                array_push($_SESSION['renda']['pessoas'], $pessoa);
                $temp = '';
            }
        }
    }
}

include 'fnc/buscaOutrasRendas.php';
$outras = buscaOutrasRendas($_SESSION['id']);

if ((isset($_SESSION['preenchido']['mae'])) || isset($_SESSION['preenchido']['pai']) || $_SESSION['preenchido']['responsavel']) {
    if (count($_POST) > 0) {
        if (!isset($_SESSION['renda']['inserido'])) {
            if (isset($_SESSION['renda']['pessoas'])) {
                include 'fnc/inserirRenda.php';
                include 'fnc/removerRenda.php';
                removerRenda($_SESSION['id']);
                inserirRenda($_SESSION['renda']['pessoas'], $_SESSION['id']);
                inserirOutraRenda($_POST['pensao'], $_SESSION['id'], 2);
                inserirOutraRenda($_POST['bolsa'], $_SESSION['id'], 3);
                if ($_SESSION['outrosDados']['pensao'] == 'sim') {
                    if ($_POST['pensao'] == 0) {
                        $erro['pensao'] = true;
                    }
                }
                if ($_SESSION['outrosDados']['bolsa_familia'] == 'sim') {
                    if ($_POST['bolsa'] == 0) {
                        $erro['bolsa'] = true;
                    }
                }

                if (!isset($erro)) {
                    $_SESSION['renda']['pensao'] = $_POST['pensao'];
                    $_SESSION['renda']['bolsa'] = $_POST['bolsa'];
                    $_SESSION['renda']['inserido'] = true;
                    header('Location: confirmacaoRematricula.php');
                }
            }
        } else {
            header('Location: confirmacaoRematricula.php');
        }
    }
} else {
    header("Location: dadosMaeRematricula.php");
}

if (isset($_POST['pensao'])) {
    if (isset($_POST['bolsa'])) {
        if (!isset($_SESSION['renda']['pessoas'])) {
            $erro['semPessoas'] = true;
        }
    }
}

$soma = 0;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" CONTENT="NO-CACHE">
        <title>SGE &middot; Dados de Renda</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Le styles -->
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/datepicker.css" rel="stylesheet">
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
                        <h3>Dados de Renda</h3>
                        <img src="img/lapis.png" style="width: 470px; position:relative; top: -65px; left: -25px;">
                    </div>
                </div>
                <div class='row-fluid' style='text-align: center;'>
                    <div class="span3" style="padding-left: 10px;">
                        <div class='itemLaranja ativo'>
                            Dados de Identificação  
                        </div>
                        <div class='itemVerde ativo'>
                            Dados Pessoais  
                        </div>
                        <div class='itemRoxo ativo'>
                            Outros Dados
                        </div>
                        <div class='itemAzul ativo'>
                            Dados de Saúde
                        </div>
                        <div class='itemMarrom ativo'>
                            Dados de Localização
                        </div>
                        <div class='itemOliva ativo'>
                            Dados dos Pais
                        </div>
                        <div class='itemT ativo'>
                            Dados de Renda
                        </div>
                        <div class='itemCinza verde-azulado'>
                            Confirmação
                        </div>
                    </div>

                    <div class="span9 folha" style="position:relative; left: -5px; display: none;" id='conteudo'>
                        <img src="img/canto.png" style="position: relative; left: -272px; top: -10px;">
                        <h5>Pessoas que moram sob o mesmo teto:</h5>
                        <p>Insira aqui todas as pessoas que moram sob o mesmo teto junto ao aluno.</p>
                        <?php if (isset($erro['semPessoas'])) { ?>
                            <div class="erro" style='width: 85%; margin-left: auto; margin-right: auto;'>
                                <strong>Erro!</strong> Pelo menos uma pessoa deve ser inserida.
                            </div>
                        <?php } ?> 
                        <?php
                        if (isset($_SESSION['renda']['pessoas'])) {
                            if (count($_SESSION['renda']['pessoas']) > 0) {
                                ?>
                                <table class="table" style='margin-left: 5px; width: 585px; border: 1px solid #9a9aff; border-radius: 5px; font-size: 13px;'>
                                    <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th title="Situação Ocupacional">Sit. Ocup.</th>
                                            <th title="Data de Nascimento">Parentesco</th>
                                            <th title="Data de Nascimento">Dt. de Nasc.</th>
                                            <th>Valor Mensal (R$)</th>
                                            <th>Comprovação</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include 'fnc/buscaSituacaoOcupacional.php';
                                        include 'fnc/buscaComprovacao.php';

                                        foreach ($_SESSION['renda']['pessoas'] as $key => $value) {
                                            $soma = $soma + $value[2];
                                            $temp = $value[0];
                                            if (strlen($temp) > 20) {
                                                $temp = substr($temp, 0, 20) . '...';
                                            }
                                            echo '<tr>';
                                            echo '<td style="text-align:left;">' . $temp . '</td>';
                                            echo '<td style="text-align:left;">' . (buscaSituacaoOcupacional($value[1])[1]) . '</td>';
                                            echo '<td style="text-align:left;">' . $value[4] . '</td>';
                                            echo '<td style="text-align:left;">' . $value[3] . '</td>';
                                            echo '<td style="text-align:left;">' . $value[2] . '</td>';
                                            echo '<td style="text-align:left;">' . (buscaComprovacao($value[5])[1]) . '</td>';
                                            echo '<td style="text-align:center;"><a href="removerPessoaRendaRematricula.php?numero=' . $key . '"><i class="iconic-x" style="color:red; font-size: 16px;
                                        cursor: pointer;"></i></a></td>';
                                            echo '</tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <?php
                            }
                        }
                        ?>
                        <h5>Adicionar pessoa</h5>
                        <p style="padding: 3px;">Para adicionar uma pessoa preencha todas as informações abaixo e clique no<br> botão Adicionar. Repita o processo até preencher todas as pessoas que moram sob o mesmo teto ao aluno.</p>
                        <form id='form1' class="form-horizontal" method='post' action="adicionarPessoaRendaRematricula.php">
                            <div class="control-group" style='margin-bottom: 5px;'>
                                <label class="control-label" for="inputAnoNova">Nome</label>
                                <div class="controls" style='line-height: 20px'>                
                                    <input type='text' name='nome' id='inputNomePessoa' required="" onkeyup="verificaCaracteres('#inputNomePessoa');" onkeypress="verificaCaracteres('#inputNomePessoa');">
                                </div>
                            </div>
                            <div class="control-group" style='margin-bottom: 5px;'>
                                <label class="control-label" for="inputDataNasc">Data de Nascimento</label>
                                <div class="controls">
                                    <input name='dataNascimento' type="text" class='datepicker' id="inputDataNasc" placeholder="dd/mm/aaaa" data-mask='99/99/9999' onselect="setCaretPosition($(this), 0);" required>
                                </div>
                            </div>
                            <div id='erroDataNasc' class='erro' style='display: none;'>
                                <strong>Erro!</strong> Você deve entrar uma data válida.
                            </div>
                            <div class="control-group" style='margin-bottom: 5px;'>
                                <label class="control-label" for="inputSitOcupacional">Situação Ocupacional</label>
                                <div class="controls" style='line-height: 20px'>                
                                    <select name='sitOcupacional' id='inputSitOcupacional' onchange='$("#opt1").remove();'>
                                        <option id='opt1'>Selecione um...</option>
                                        <?php
                                        include 'fnc/listaDeSituacoesOcupacionais.php';
                                        $situacoes = listaDeSituacoesOcupacionais();
                                        foreach ($situacoes as $key => $value) {
                                            echo '<option value="' . ($value[0]) . '">' . ($value[1]) . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div id='erroSitOcup' class='erro' style='display: none;'>
                                <strong>Erro!</strong> Você deve selecionar uma opção.
                            </div>
                            <div class="control-group" style='margin-bottom: 5px;'>
                                <label class="control-label" for="inputParentesco">Parentesco</label>
                                <div class="controls" style='line-height: 20px'>                
                                    <select name='parentesco' id='inputParentesco' onchange='$("#opt2").remove();'>
                                        <option id='opt2'>Selecione um...</option>
                                        <?php
                                        include 'fnc/listaDeParentescos.php';
                                        $parentescos = listaDeParentescos();
                                        foreach ($parentescos as $key => $value) {
                                            echo '<option value="' . ($value) . '">' . ($value) . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div id='erroParentesco' class='erro' style='display: none;'>
                                <strong>Erro!</strong> Você deve selecionar uma opção.
                            </div>
                            <div class="control-group" style='margin-bottom: 5px;'>
                                <label class="control-label" for="inputValor">Valor do rendimento mensal</label>
                                <div class="controls" style='line-height: 20px'>                
                                    <input min="0" type='number' name='valor' id='inputValor' required>
                                </div>
                            </div>
                            <div class="control-group" style='margin-bottom: 5px;'>
                                <label class="control-label" for="inputComprovacao">Comprovação de Rendimentos</label>
                                <div class="controls" style='line-height: 40px'>                
                                    <select name='comprovacao' id='inputComprovacao' onchange='$("#opt3").remove();'>
                                        <option id='opt3'>Selecione um...</option>
                                        <?php
                                        include 'fnc/listaDeComprovacoes.php';
                                        $comprovacoes = listaDeComprovacoes();
                                        foreach ($comprovacoes as $key => $value) {
                                            echo '<option value=' . $value[0] . '>' . ($value[1]) . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div id='erroComprovacao' class='erro' style='display: none;'>
                                <strong>Erro!</strong> Você deve selecionar uma opção.
                            </div>
                            <br>
                            <a class='btn btn-info' onclick='if (validaCampos()) {
                                                $("#form1").submit();
                                            }
                                            ;'>Adicionar</a>
                        </form>
                        <hr>
                        <form id="form2" class="form-horizontal" method="post">
                            <div class="control-group" style='margin-bottom: 5px;'>
                                <label class="control-label" for="inputValor">Valor de pensão</label>
                                <div class="controls" style='line-height: 20px'>                
                                    <input step="any" min="0" type='number' name='pensao' id='inputPensao' required value='<?php
                                    if (isset($outras[0][6])) {
                                        echo $outras[0][6];
                                    } else {
                                        echo 0;
                                    }
                                    ?>'>
                                </div>
                                <?php if (isset($erro['pensao'])) { ?>
                                    <div class="erro" style='width: 80%; margin-left: auto; margin-right: auto;'>
                                        <strong>Erro!</strong> Você deve informar um valor da pensão.
                                    </div>
                                <?php } ?>  
                                <div id='erroPensao' class='erro' style='display: none;'>
                                    <strong>Erro!</strong> Você deve entrar um número. Exemplos: 4 - 2,1 - 2.1 - 1200.
                                </div>
                            </div>
                            <div class="control-group" style='margin-bottom: 5px;'>
                                <label class="control-label" for="inputValor">Valor de Bolsa Família</label>
                                <div class="controls" style='line-height: 20px'>                
                                    <input step="any" min="0" type='number' name='bolsa' id='inputBolsa' required value='<?php
                                    if (isset($outras[1][6])) {
                                        echo $outras[1][6];
                                    } else {
                                        echo 0;
                                    }
                                    ?>'>
                                </div>
                                <?php if (isset($erro['bolsa'])) { ?>
                                    <div class="erro" style='width: 80%; margin-left: auto; margin-right: auto;'>
                                        <strong>Erro!</strong> Você deve informar um valor de bolsa família.
                                    </div>
                                <?php } ?>  
                                <div id='erroBolsa' class='erro' style='display: none;'>
                                    <strong>Erro!</strong> Você deve entrar um número. Exemplos: 4 - 2,1 - 2.1 - 1200.
                                </div> 
                            </div>
                            <br>
                            <a class='btn' href='dadosMaeRematricula.php'>Voltar</a>
                            <button class='btn btn-primary' onclick='if (validaCamposDois()) {
                                                $("#form2").submit();
                                            }
                                            ;'>Avan&ccedil;ar</button>
                        </form>
                    </div>

                    <noscript>
                    <div class="span9" style='padding-left: 20px;'>
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
        <script src="js/bootstrap-datepicker.js"></script>
        <script type="text/javascript">
                                        function checkdate(m, d, y) {
                                            return m > 0 && m < 13 && y > 0 && y < 32768 && d > 0 && d <= (new Date(y, m, 0)).getDate();
                                        }
                                        function validaCampos() {
                                            var result = true;
                                            $('#erroSitOcup').css('display', 'none');
                                            $('#erroParentesco').css('display', 'none');
                                            $('#erroComprovacao').css('display', 'none');
                                            $('#erroDataNasc').css('display', 'none');
                                            if ($('#inputSitOcupacional').val() == 'Selecione um...') {
                                                $('#erroSitOcup').css('display', 'inherit');
                                                result = false;
                                            }
                                            if ($('#inputParentesco').val() == 'Selecione um...') {
                                                $('#erroParentesco').css('display', 'inherit');
                                                result = false;
                                            }
                                            if ($('#inputComprovacao').val() == 'Selecione um...') {
                                                $('#erroComprovacao').css('display', 'inherit');
                                                result = false;
                                            }
                                            if ($('#inputDataNasc').val() == '__/__/____' || $('#inputDataNasc').val() == '') {
                                                $('#erroDataNasc').css('display', 'inherit');
                                                result = false;
                                            } else {
                                                var data = $('#inputDataNasc').val().split("/");
                                                if (!checkdate(data[1], data[0], data[2])) {
                                                    $('#erroDataNasc').css('display', 'inherit');
                                                    result = false;
                                                }
                                            }

                                            return result;
                                        }
                                        function validaCamposDois() {
                                            var result = true;
                                            $('#erroPensao').css('display', 'none');
                                            $('#erroBolsa').css('display', 'none');
                                            if (isNaN(parseFloat($('#inputPensao').val()))) {
                                                $('#erroPensao').css('display', 'inherit');
                                                result = false;
                                            }
                                            if (isNaN(parseFloat($('#inputBolsa').val()))) {
                                                $('#erroBolsa').css('display', 'inherit');
                                                result = false;
                                            }

                                            return result;
                                        }
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
                                        function isNumber(n) {
                                            return !isNaN(parseFloat(n)) && isFinite(n);
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
            $('#conteudo').css('display', 'inherit');

        </script>
        <script>
        </script>

    </body>
</html>
