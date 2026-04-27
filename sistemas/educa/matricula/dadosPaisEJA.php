<?php
session_name('ma_eja');
session_start();

if (!$_SESSION['preenchido']['localizacao']) {
    header('Location: dadosLocalizacaoEJA.php');
}

if (count($_POST) > 0) {

    if(isset($_POST['nomeMae'])){
        if($_POST['nomeMae'] != ''){
            if($_POST['escolaridadeMae'] == 'Selecione um...'){
                $erro['escolaridadeMae'] = true;
            }
        }
    }
    if(isset($_POST['nomePai'])){
        if($_POST['nomePai'] != ''){
            if($_POST['escolaridadePai'] == 'Selecione um...'){
                $erro['escolaridadePai'] = true;
            }
        }
    }
    if(isset($_POST['nomeResp'])){
        if($_POST['nomeResp'] != ''){
            if($_POST['escolaridadeResp'] == 'Selecione um...'){
                $erro['escolaridadeResp'] = true;
            }
        }
    }

    if(!isset($erro)){

        if(isset($_POST['nomeMae'])){
            $_SESSION['pais']['nomeMae'] = $_POST['nomeMae'];
            $_SESSION['pais']['escolaridadeMae'] = $_POST['escolaridadeMae'];
        }
        if(isset($_POST['nomePai'])){
            $_SESSION['pais']['nomePai'] = $_POST['nomePai'];
            $_SESSION['pais']['escolaridadePai'] = $_POST['escolaridadePai'];
        }
        if(isset($_POST['nomeResp'])){
            $_SESSION['pais']['nomeResp'] = $_POST['nomeResp'];
            $_SESSION['pais']['escolaridadeResp'] = $_POST['escolaridadeResp'];
        }

        $_SESSION['preenchido']['pais'] = true;        

        header("Location: dadosRendaEJA.php");
    }
}

if(isset($_SESSION['pais']['nomeMae'])){
    $_POST['nomeMae'] = $_SESSION['pais']['nomeMae'];
}
if(isset($_SESSION['pais']['escolaridadeMae'])){
    $_POST['escolaridadeMae'] = $_SESSION['pais']['escolaridadeMae'];
}
if(isset($_SESSION['pais']['nomePai'])){
    $_POST['nomePai'] = $_SESSION['pais']['nomePai'];

}
if(isset($_SESSION['pais']['escolaridadePai'])){
    $_POST['escolaridadePai'] = $_SESSION['pais']['escolaridadePai'];
}
if(isset($_SESSION['pais']['nomeResp'])){
    $_POST['nomeResp'] = $_SESSION['pais']['nomeResp'];
}
if(isset($_SESSION['pais']['escolaridadeResp'])){
    $_POST['escolaridadeResp'] = $_SESSION['pais']['escolaridadeResp'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" CONTENT="NO-CACHE">
    <title>SGE &middot; Dados Escolares</title>
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
                        <h3>Dados de Localização do Aluno</h3>
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
                            Dados de Localização
                        </div>
                        <div class='itemMarrom ativo'>
                            Dados Escolares
                        </div>
                        <div class='itemOliva ativo'>
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
                        <form class="form-horizontal" method="post" onsubmit="">
                            <h4>Dados dos Pais</h4>
                            
                            <label class="control-label" for="inputNomeMae">Nome da Mãe</label>
                            <div class="controls">
                                <input type='text' name='nomeMae'  id='nomeMae' onkeypress="verificaMaiusculo('#nomeMae');" onkeyup="verificaMaiusculo('#nomeMae');"
                                <?php
                                if (isset($_POST['nomeMae'])) {
                                    echo 'value="' . $_POST['nomeMae'] . '"';
                                }
                                ?>>
                            </div>

                            <label class="control-label" for="inputEscolaridadeMae">Escolaridade (Mãe)</label>
                            <div class="controls">
                                <select name='escolaridadeMae' onchange='$("#opt3").remove();'>
                                    <option id='opt3'>Selecione um...</option>
                                    <option value="0" <?php if(isset($_POST['escolaridadeMae'])) {if($_POST['escolaridadeMae'] == 0) echo 'selected';} ?>>Não sei</option>
                                    <?php
                                    include 'fnc/listaDeEscolaridade.php';
                                    $escolaridade = listaDeEscolaridade();
                                    foreach ($escolaridade as $key => $value) {
                                        if (isset($_POST['escolaridadeMae'])) {
                                            if ($_POST['escolaridadeMae'] == ($value[0])) {
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
                            <?php if (isset($erro['escolaridadeMae'])) { ?>
                            <div class="erro">
                                <strong>Erro!</strong> Você deve escolher uma opção para continuar.
                            </div>
                            <?php } ?>

                            <label class="control-label" for="inputNomePai">Nome do Pai</label>
                            <div class="controls">
                                <input type='text' name='nomePai'  id='nomePai' onkeypress="verificaMaiusculo('#nomePai');" onkeyup="verificaMaiusculo('#nomePai');"
                                <?php
                                if (isset($_POST['nomePai'])) {
                                    echo 'value="' . $_POST['nomePai'] . '"';
                                }
                                ?>>
                            </div>

                            <label class="control-label" for="inputEscolaridadePai">Escolaridade (Pai)</label>
                            <div class="controls">
                                <select name='escolaridadePai' onchange='$("#opt2").remove();'>
                                    <option id='opt2'>Selecione um...</option>
                                    <option value="0" <?php if(isset($_POST['escolaridadePai'])) {if($_POST['escolaridadePai'] == 0) echo 'selected';} ?>>Não sei</option>
                                    <?php
                                    $escolaridade = listaDeEscolaridade();
                                    foreach ($escolaridade as $key => $value) {
                                        if (isset($_POST['escolaridadePai'])) {
                                            if ($_POST['escolaridadePai'] == ($value[0])) {
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
                            <?php if (isset($erro['escolaridadePai'])) { ?>
                            <div class="erro">
                                <strong>Erro!</strong> Você deve escolher uma opção para continuar.
                            </div>
                            <?php } ?>

                            <label class="control-label" for="inputNomeResp">Nome do Responsável</label>
                            <div class="controls">
                                <input type='text' name='nomeResp' id='nomeResp' onkeypress="verificaMaiusculo('#nomeResp');" onkeyup="verificaMaiusculo('#nomeResp');"
                                <?php
                                if (isset($_POST['nomeResp'])) {
                                    echo 'value="' . $_POST['nomeResp'] . '"';
                                }
                                ?>>
                            </div>

                            <label class="control-label" for="inputEscolaridadeResp">Escolaridade (Responsável)</label>
                            <div class="controls">
                                <select name='escolaridadeResp' onchange='$("#opt1").remove();'>
                                    <option id='opt1'>Selecione um...</option>
                                    <option value="0"  <?php if(isset($_POST['escolaridadeResp'])) {if($_POST['escolaridadeResp'] == 0) echo 'selected';} ?>>Não sei</option>
                                    <?php
                                    $escolaridade = listaDeEscolaridade();
                                    foreach ($escolaridade as $key => $value) {
                                        if (isset($_POST['escolaridadeResp'])) {
                                            if ($_POST['escolaridadeResp'] == ($value[0])) {
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
                            <?php if (isset($erro['escolaridadeResp'])) { ?>
                            <div class="erro">
                                <strong>Erro!</strong> Você deve escolher uma opção para continuar.
                            </div>
                            <?php } ?>

                            <br>
                            <a class='btn' href='dadosEscolaresEJA.php'>Voltar</a>
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
        <script>
            function verificaMaiusculo(elemento) {
                var string = $(elemento).val();
                var caracter = string.substr(string.length - 1, string.length);
                if(caracter == 'ç' || caracter == 'Ç'){
                    $(elemento).val(string.substr(0, string.length - 1));  
                } else {
                    var letra = caracter.toUpperCase();
                    if (letra < "A" || letra > "Z") {


                    } else { 
                        if(letra != 'Ç'){
                            $(elemento).val(string.substr(0, string.length - 1) + letra);                    
                        }
                    }
                }
            }

            $('#conteudo').css('display', 'inherit');
        </script>

    </body>
    </html>
