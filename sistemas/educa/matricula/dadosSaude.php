<?php
session_name('ma');
session_start();

if (!$_SESSION['preenchido']['outros_dados']) {
    header('Location: outrosDados.php');
}

if (count($_POST) > 0) {

    if (isset($_POST['possuiAnemia'])) {
        if ($_POST['possuiAnemia'] == '') {
            $erro['possuiAnemia'] = true;
        }
    } else {
        $erro['possuiAnemia'] = true;
    }

    if (isset($_POST['possuiDiabetes'])) {
        if ($_POST['possuiDiabetes'] == '') {
            $erro['possuiDiabetes'] = true;
        }
    } else {
        $erro['possuiDiabetes'] = true;
    }
    if (isset($_POST['utilizaOculos'])) {
        if ($_POST['utilizaOculos'] == '') {
            $erro['utilizaOculos'] = true;
        }
    } else {
        $erro['utilizaOculos'] = true;
    }

    if (isset($_POST['encaminha'])) {
        if ($_POST['encaminha'] == '') {
            $erro['encaminha'] = true;
        }
        
    } else {
        $erro['encaminha'] = true;
    }

    if (isset($_POST['possuiAlergia'])) {
        if ($_POST['possuiAlergia'] == '') {
            $erro['possuiAlergia'] = true;
        }
    } else {
        $erro['possuiAlergia'] = true;
    }

    if (isset($_POST['possuiIntoleranciaLactose'])) {
        if ($_POST['possuiIntoleranciaLactose'] == '') {
            $erro['possuiIntoleranciaLactose'] = true;
        }
    } else {
        $erro['possuiIntoleranciaLactose'] = true;
    }

    if (isset($_POST['possuiIntoleranciaGluten'])) {
        if ($_POST['possuiIntoleranciaGluten'] == '') {
            $erro['possuiIntoleranciaGluten'] = true;
        }
    } else {
        $erro['possuiIntoleranciaGluten'] = true;
    }

    if (isset($_POST['possuiRefluxo'])) {
        if ($_POST['possuiRefluxo'] == '') {
            $erro['possuiRefluxo'] = true;
        }
    } else {
        $erro['possuiRefluxo'] = true;
    }

    if (isset($_POST['possuiDeficiencia'])) {
        if ($_POST['possuiDeficiencia'] == '') {
            $erro['possuiDeficiencia'] = true;
        }
    } else {
        $erro['possuiDeficiencia'] = true;
    }

    if(isset($_POST['altura'])){
        if($_POST['altura'] > 250){
            $erro['altura'] = true;
        }
    }

    if(isset($_POST['peso'])){
        if($_POST['peso'] > 300){
            $erro['peso'] = true;
        }
    }

    $outros['anemia'] = $_POST['possuiAnemia'];
    $outros['diabetes'] = $_POST['possuiDiabetes'];
    $outros['intoleranciaLactose'] = $_POST['possuiIntoleranciaLactose'];
    $outros['intoleranciaGluten'] = $_POST['possuiIntoleranciaGluten'];
    $outros['refluxo'] = $_POST['possuiRefluxo'];
    $outros['utilizaOculos'] = $_POST['utilizaOculos'];
    $outros['alergia'] = $_POST['possuiAlergia'];
    $outros['encaminha'] = $_POST['encaminha'];
    $outros['desAlergia'] = $_POST['alergia'];

    if (!isset($erro)) {
        $_SESSION['saude']['peso'] = $_POST['peso'];
        $_SESSION['saude']['altura'] = $_POST['altura'];
        //$_SESSION['saude']['data_vencimento_vacina'] = $_POST['dataValidadeEsquemaVacina'];
        $_SESSION['saude']['possuiDeficiencia'] = $_POST['possuiDeficiencia'];
        if (isset($_POST['deficiencias'])) {
            $_SESSION['saude']['deficiencias'] = $_POST['deficiencias'];
        }
        if (isset($_POST['recursos'])) {
            $_SESSION['saude']['recursos'] = $_POST['recursos'];
        }
        $_SESSION['saude']['outros'] = $outros;
        $_SESSION['preenchido']['saude'] = true;

        include 'fnc/inserirDadosSaude.php';
        inserirDadosSaude($_SESSION['saude'], $_SESSION['aluno']['id']);

        header("Location: dadosMae.php");
    }
}

if (isset($_SESSION['saude']['peso'])) {
    $_POST['peso'] = $_SESSION['saude']['peso'];
}
if (isset($_SESSION['saude']['altura'])) {
    $_POST['altura'] = $_SESSION['saude']['altura'];
}
//if (isset($_SESSION['saude']['data_vencimento_vacina'])) {
//    if ($_SESSION['saude']['data_vencimento_vacina'] != '00/00/0000') {
//        $_POST['dataValidadeEsquemaVacina'] = $_SESSION['saude']['data_vencimento_vacina'];
//    }
//}
if (isset($_SESSION['saude']['outros']['anemia'])) {
    $_POST['possuiAnemia'] = $_SESSION['saude']['outros']['anemia'];
}
if (isset($_SESSION['saude']['outros']['utilizaOculos'])) {
    $_POST['utilizaOculos'] = $_SESSION['saude']['outros']['utilizaOculos'];
}
if (isset($_SESSION['saude']['outros']['alergia'])) {
    $_POST['possuiAlergia'] = $_SESSION['saude']['outros']['alergia'];
}
if (isset($_SESSION['saude']['outros']['desAlergia'])) {
    $_POST['alergia'] = $_SESSION['saude']['outros']['desAlergia'];
}
if (isset($_SESSION['saude']['outros']['encaminha'])) {
    $_POST['encaminha'] = $_SESSION['saude']['outros']['encaminha'];
}
if (isset($_SESSION['saude']['outros']['diabetes'])) {
    $_POST['possuiDiabetes'] = $_SESSION['saude']['outros']['diabetes'];
}
if (isset($_SESSION['saude']['outros']['intoleranciaLactose'])) {
    $_POST['possuiIntoleranciaLactose'] = $_SESSION['saude']['outros']['intoleranciaLactose'];
}
if (isset($_SESSION['saude']['outros']['intoleranciaGluten'])) {
    $_POST['possuiIntoleranciaGluten'] = $_SESSION['saude']['outros']['intoleranciaGluten'];
}
if (isset($_SESSION['saude']['outros']['refluxo'])) {
    $_POST['possuiRefluxo'] = $_SESSION['saude']['outros']['refluxo'];
}
if (isset($_SESSION['saude']['possuiDeficiencia'])) {
    $_POST['possuiDeficiencia'] = $_SESSION['saude']['possuiDeficiencia'];
}
if (isset($_SESSION['saude']['deficiencias'])) {
    $_POST['deficiencias'] = $_SESSION['saude']['deficiencias'];
}
if (isset($_SESSION['saude']['recursos'])) {
    $_POST['recursos'] = $_SESSION['saude']['recursos'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" CONTENT="NO-CACHE">
    <title>SGE &middot; Dados de Saúde</title>
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
            <div class='conteudo'>
                <div class='row-fluid' style='text-align: center; height: 90px;'>
                    <div style='text-align: center; padding-top: 15px;'>
                        <h3>Dados de Saúde do Aluno</h3>
                        <img src="img/lapis.png" style="width: 470px; position:relative; top: -65px; left: -25px;">
                    </div>
                </div>
                <div class='row-fluid' style='text-align: center;'>
                    <?php include 'shared/barraLateral.php'; ?>

                    <div class="span8 folha" style='display: none;' id='conteudo'>
                        <img src="img/canto.png" style="position: relative; left: -238px; top: -10px;">
                        <form class="form-horizontal" method="post">
                            <label class="control-label" for="inputPeso">Peso (kg)</label>
                            <div class="controls" style='line-height: 20px'>
                                <input onkeypress="verificaDigitos('#inputPeso');" onkeyup="verificaDigitos('#inputPeso');" id='inputPeso' type='number' name='peso' value='<?php
                                if (isset($_POST['peso'])) {
                                    echo $_POST['peso'];
                                }
                                ?>'>
                            </div>
                            <?php if (isset($erro['peso'])) { ?>
                            <div class="erro" style='width: 80%; margin-left: auto; margin-right: auto;'>
                                <strong>Erro!</strong> Você deve informar um valor válido.
                            </div>
                            <?php } ?>  
                            <label class="control-label" for="inputAltura">Altura (cm)</label>
                            <div class="controls" style='line-height: 20px'>
                                <input onkeypress="verificaDigitos('#inputAltura');" onkeyup="verificaDigitos('#inputAltura');" id='inputAltura'  type='number' name='altura' value='<?php
                                if (isset($_POST['altura'])) {
                                    echo $_POST['altura'];
                                }
                                ?>'>
                            </div>
                            <?php if (isset($erro['altura'])) { ?>
                            <div class="erro" style='width: 80%; margin-left: auto; margin-right: auto;'>
                                <strong>Erro!</strong> Você deve informar um valor válido.
                            </div>
                            <?php } ?>  
                            <!--                            <label class="control-label" for="inputDataNasc">Data de vencimento do esquema vacinal</label>
                                                        <div class="controls">
                                                            <input name='dataValidadeEsquemaVacina' value='<?php
                            if (isset($_POST['dataValidadeEsquemaVacina'])) {
                                echo $_POST['dataValidadeEsquemaVacina'];
                            }
                            ?>' type="text" class='datepicker' id="inputDataNasc" placeholder="dd/mm/aaaa" data-mask='99/99/9999'>
                        </div>-->
                        <?php if (isset($erro['dataValidadeEsquemaVacina'])) { ?><br>
                                <!--                                <div class="erro" style='width: 90%; margin-left: auto; margin-right: auto;'>
                                                                    <strong>Erro!</strong> Você deve informar a data de vencimento do esquema vacinal.
                                                                </div>-->
                                                                <?php } ?>
                                                                <br>
                                                                <div class="control-group highlight">
                                                                    <label class="control-label" for="inputPossuiAnemia">Possui Anemia?</label>
                                                                    <div class="controls" style='line-height: 20px;'>                
                                                                        <input type="radio" name="possuiAnemia" value="sim" required
                                                                        <?php
                                                                        if (isset($_POST['possuiAnemia'])) {
                                                                            if ($_POST['possuiAnemia'] == 'sim') {
                                                                                echo 'checked';
                                                                            }
                                                                        }
                                                                        ?>><font style='position: relative; top: 4px; left: 5px;'>Sim</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                        <input type="radio" name="possuiAnemia" value="nao" required
                                                                        <?php
                                                                        if (isset($_POST['possuiAnemia'])) {
                                                                            if ($_POST['possuiAnemia'] == 'nao') {
                                                                                echo 'checked';
                                                                            }
                                                                        }
                                                                        ?>><font style='position: relative; top: 4px; left: 5px;'>Não</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                        <input type="radio" name="possuiAnemia" value="naoSei" required
                                                                        <?php
                                                                        if (isset($_POST['possuiAnemia'])) {
                                                                            if ($_POST['possuiAnemia'] == 'naoSei') {
                                                                                echo 'checked';
                                                                            }
                                                                        }
                                                                        ?>><font style='position: relative; top: 4px; left: 5px;'>Não sei</font><br>
                                                                    </div>
                                                                </div>
                                                                <?php if (isset($erro['possuiAnemia'])) { ?>
                                                                <div class="erro" style='width: 80%; margin-left: auto; margin-right: auto;'>
                                                                    <strong>Erro!</strong> Você deve informar se o aluno possui anemia.
                                                                </div>
                                                                <?php } ?>  
                                                                <div class="control-group highlight">
                                                                    <label class="control-label" for="inputPossuiDiabetes">Possui Diabetes?</label>
                                                                    <div class="controls" style='line-height: 20px;'>                
                                                                        <input type="radio" name="possuiDiabetes" value="sim" required
                                                                        <?php
                                                                        if (isset($_POST['possuiDiabetes'])) {
                                                                            if ($_POST['possuiDiabetes'] == 'sim') {
                                                                                echo 'checked';
                                                                            }
                                                                        }
                                                                        ?>><font style='position: relative; top: 4px; left: 5px;'>Sim</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                        <input type="radio" name="possuiDiabetes" value="nao" required
                                                                        <?php
                                                                        if (isset($_POST['possuiDiabetes'])) {
                                                                            if ($_POST['possuiDiabetes'] == 'nao') {
                                                                                echo 'checked';
                                                                            }
                                                                        }
                                                                        ?>><font style='position: relative; top: 4px; left: 5px;'>Não</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                        <input type="radio" name="possuiDiabetes" value="naoSei" required
                                                                        <?php
                                                                        if (isset($_POST['possuiDiabetes'])) {
                                                                            if ($_POST['possuiDiabetes'] == 'naoSei') {
                                                                                echo 'checked';
                                                                            }
                                                                        }
                                                                        ?>><font style='position: relative; top: 4px; left: 5px;'>Não sei</font><br>
                                                                    </div>
                                                                </div>
                                                                <?php if (isset($erro['possuiDiabetes'])) { ?>
                                                                <div class="erro" style='width: 80%; margin-left: auto; margin-right: auto;'>
                                                                    <strong>Erro!</strong> Você deve informar se o aluno possui diabetes.
                                                                </div>
                                                                <?php } ?>  
                                                                <div class="control-group highlight">
                                                                    <label class="control-label" for="inputIntoleranciaLactose">Possui Intolerância à Lactose?</label>
                                                                    <div class="controls" style='line-height: 40px;'>                
                                                                        <input type="radio" name="possuiIntoleranciaLactose" value="sim" required
                                                                        <?php
                                                                        if (isset($_POST['possuiIntoleranciaLactose'])) {
                                                                            if ($_POST['possuiIntoleranciaLactose'] == 'sim') {
                                                                                echo 'checked';
                                                                            }
                                                                        }
                                                                        ?>><font style='position: relative; top: 4px; left: 5px;'>Sim</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                        <input type="radio" name="possuiIntoleranciaLactose" value="nao" required
                                                                        <?php
                                                                        if (isset($_POST['possuiIntoleranciaLactose'])) {
                                                                            if ($_POST['possuiIntoleranciaLactose'] == 'nao') {
                                                                                echo 'checked';
                                                                            }
                                                                        }
                                                                        ?>><font style='position: relative; top: 4px; left: 5px;'>Não</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                        <input type="radio" name="possuiIntoleranciaLactose" value="naoSei" required
                                                                        <?php
                                                                        if (isset($_POST['possuiIntoleranciaLactose'])) {
                                                                            if ($_POST['possuiIntoleranciaLactose'] == 'naoSei') {
                                                                                echo 'checked';
                                                                            }
                                                                        }
                                                                        ?>><font style='position: relative; top: 4px; left: 5px;'>Não sei</font><br>
                                                                    </div>
                                                                </div>
                                                                <?php if (isset($erro['possuiIntoleranciaLactose'])) { ?>
                                                                <div class="erro" style='width: 85%; margin-left: auto; margin-right: auto;'>
                                                                    <strong>Erro!</strong> Você deve informar se o aluno possui intolerância à lactose.
                                                                </div>
                                                                <?php } ?>  
                                                                <div class="control-group highlight">
                                                                    <label class="control-label" for="inputIntoleranciaGluten">Possui Intolerância à Glúten?</label>
                                                                    <div class="controls" style='line-height: 40px;'>                
                                                                        <input type="radio" name="possuiIntoleranciaGluten" value="sim" required
                                                                        <?php
                                                                        if (isset($_POST['possuiIntoleranciaGluten'])) {
                                                                            if ($_POST['possuiIntoleranciaGluten'] == 'sim') {
                                                                                echo 'checked';
                                                                            }
                                                                        }
                                                                        ?>><font style='position: relative; top: 4px; left: 5px;'>Sim</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                        <input type="radio" name="possuiIntoleranciaGluten" value="nao" required
                                                                        <?php
                                                                        if (isset($_POST['possuiIntoleranciaGluten'])) {
                                                                            if ($_POST['possuiIntoleranciaGluten'] == 'nao') {
                                                                                echo 'checked';
                                                                            }
                                                                        }
                                                                        ?>><font style='position: relative; top: 4px; left: 5px;'>Não</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                        <input type="radio" name="possuiIntoleranciaGluten" value="naoSei" required
                                                                        <?php
                                                                        if (isset($_POST['possuiIntoleranciaGluten'])) {
                                                                            if ($_POST['possuiIntoleranciaGluten'] == 'naoSei') {
                                                                                echo 'checked';
                                                                            }
                                                                        }
                                                                        ?>><font style='position: relative; top: 4px; left: 5px;'>Não sei</font><br>
                                                                    </div>
                                                                </div>
                                                                <?php if (isset($erro['possuiIntoleranciaGluten'])) { ?>
                                                                <div class="erro" style='width: 85%; margin-left: auto; margin-right: auto;'>
                                                                    <strong>Erro!</strong> Você deve informar se o aluno possui intolerância à glúten.
                                                                </div>
                                                                <?php } ?>  
                                                                <div class="control-group highlight">
                                                                    <label class="control-label" for="inputRefluxo">Possui Refluxo?</label>
                                                                    <div class="controls" style='line-height: 40px;'>                
                                                                        <input type="radio" name="possuiRefluxo" value="sim" required
                                                                        <?php
                                                                        if (isset($_POST['possuiRefluxo'])) {
                                                                            if ($_POST['possuiRefluxo'] == 'sim') {
                                                                                echo 'checked';
                                                                            }
                                                                        }
                                                                        ?>><font style='position: relative; top: 4px; left: 5px;'>Sim</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                        <input type="radio" name="possuiRefluxo" value="nao" required
                                                                        <?php
                                                                        if (isset($_POST['possuiRefluxo'])) {
                                                                            if ($_POST['possuiRefluxo'] == 'nao') {
                                                                                echo 'checked';
                                                                            }
                                                                        }
                                                                        ?>><font style='position: relative; top: 4px; left: 5px;'>Não</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                        <input type="radio" name="possuiRefluxo" value="naoSei" required
                                                                        <?php
                                                                        if (isset($_POST['possuiRefluxo'])) {
                                                                            if ($_POST['possuiRefluxo'] == 'naoSei') {
                                                                                echo 'checked';
                                                                            }
                                                                        }
                                                                        ?>><font style='position: relative; top: 4px; left: 5px;'>Não sei</font><br>
                                                                    </div>
                                                                </div>
                                                                <?php if (isset($erro['possuiRefluxo'])) { ?>
                                                                <div class="erro" style='width: 80%; margin-left: auto; margin-right: auto;'>
                                                                    <strong>Erro!</strong> Você deve informar se o aluno possui refluxo.
                                                                </div>
                                                                <?php } ?>  
                                                                <div class="control-group highlight">
                                                                    <label class="control-label" for="inputOculos">Utiliza óculos?</label>
                                                                    <div class="controls" style='line-height: 40px;'>                
                                                                        <input type="radio" name="utilizaOculos" value="sim" required
                                                                        <?php
                                                                        if (isset($_POST['utilizaOculos'])) {
                                                                            if ($_POST['utilizaOculos'] == 'sim') {
                                                                                echo 'checked';
                                                                            }
                                                                        }
                                                                        ?>><font style='position: relative; top: 4px; left: 5px;'>Sim</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                        <input type="radio" name="utilizaOculos" value="nao" required
                                                                        <?php
                                                                        if (isset($_POST['utilizaOculos'])) {
                                                                            if ($_POST['utilizaOculos'] == 'nao') {
                                                                                echo 'checked';
                                                                            }
                                                                        }
                                                                        ?>><font style='position: relative; top: 4px; left: 5px;'>Não</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                        <input type="radio" name="utilizaOculos" value="naoSei" required
                                                                        <?php
                                                                        if (isset($_POST['utilizaOculos'])) {
                                                                            if ($_POST['utilizaOculos'] == 'naoSei') {
                                                                                echo 'checked';
                                                                            }
                                                                        }
                                                                        ?>><font style='position: relative; top: 4px; left: 5px;'>Não sei</font><br>
                                                                    </div>
                                                                </div>
                                                                <?php if (isset($erro['utilizaOculos'])) { ?>
                                                                <div class="erro" style='width: 80%; margin-left: auto; margin-right: auto;'>
                                                                    <strong>Erro!</strong> Você deve informar se o aluno utiliza óculos.
                                                                </div>
                                                                <?php } ?>
                                                                <div class="control-group highlight">
                                                                    <label class="control-label" for="inputAlergia">Possui alergia?</label>
                                                                    <div class="controls" style='line-height: 40px;'>                
                                                                        <input type="radio" name="possuiAlergia" value="sim" required onclick="$('#alergia').css('display', 'inherit');"
                                                                        <?php
                                                                        if (isset($_POST['possuiAlergia'])) {
                                                                            if ($_POST['possuiAlergia'] == 'sim') {
                                                                                echo 'checked';
                                                                            }
                                                                        }
                                                                        ?>><font style='position: relative; top: 4px; left: 5px;'>Sim</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                        <input type="radio" name="possuiAlergia" value="nao" required onclick="$('#alergia').css('display', 'none');"
                                                                        <?php
                                                                        if (isset($_POST['possuiAlergia'])) {
                                                                            if ($_POST['possuiAlergia'] == 'nao') {
                                                                                echo 'checked';
                                                                            }
                                                                        }
                                                                        ?>><font style='position: relative; top: 4px; left: 5px;'>Não</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                        <input type="radio" name="possuiAlergia" value="naoSei" required onclick="$('#alergia').css('display', 'none');"
                                                                        <?php
                                                                        if (isset($_POST['possuiAlergia'])) {
                                                                            if ($_POST['possuiAlergia'] == 'naoSei') {
                                                                                echo 'checked';
                                                                            }
                                                                        }
                                                                        ?>><font style='position: relative; top: 4px; left: 5px;'>Não sei</font><br>
                                                                    </div>
                                                                </div>
                                                                <?php if (isset($erro['utilizaOculos'])) { ?>
                                                                <div class="erro" style='width: 80%; margin-left: auto; margin-right: auto;'>
                                                                    <strong>Erro!</strong> Você deve informar se o aluno possui alergia.
                                                                </div>
                                                                <?php } ?> 
                                                                <div class="control-group highlight" id='alergia' <?php
                                                                if (isset($_POST['possuiAlergia'])) {
                                                                    if ($_POST['possuiAlergia'] == 'sim') {
                                                                        echo "style='display: inherit;'";
                                                                    } else {
                                                                        echo "style='display: none;'";
                                                                    }
                                                                }
                                                                ?>>
                                                                <label class="control-label" for="inputQualAlergia"
                                                                >Qual alergia?</label>
                                                                <div class="controls" style='line-height: 40px;'>                
                                                                    <input type="text" name="alergia" maxlength="100"
                                                                    <?php
                                                                    if (isset($_POST['alergia'])) {
                                                                        echo 'value="'.$_POST['alergia'].'"';
                                                                    }
                                                                    ?>>
                                                                </div>
                                                            </div> 
                                                            <div class="control-group highlight">
                                                                <label class="control-label" for="inputEncaminha">Em caso de acidente/emergência, autorizo a Unidade Educativa encaminhar a criança/adolescente para receber o devido atendimento fora do estabelecimento de ensino.</label>
                                                                <div class="controls" style='line-height: 130px;'>                
                                                                    <input type="radio" name="encaminha" value="sim" required
                                                                    <?php
                                                                    if (isset($_POST['encaminha'])) {
                                                                        if ($_POST['encaminha'] == 'sim') {
                                                                            echo 'checked';
                                                                        }
                                                                    }
                                                                    ?>><font style='position: relative; top: 4px; left: 5px;'>Sim</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    <input type="radio" name="encaminha" value="nao" required
                                                                    <?php
                                                                    if (isset($_POST['encaminha'])) {
                                                                        if ($_POST['encaminha'] == 'nao') {
                                                                            echo 'checked';
                                                                        }
                                                                    }
                                                                    ?>><font style='position: relative; top: 4px; left: 5px;'>Não</font><br>
                                                                </div>
                                                            </div>
                                                            <?php if (isset($erro['encaminha'])) { ?>
                                                            <div class="erro" style='width: 80%; margin-left: auto; margin-right: auto;'>
                                                                <strong>Erro!</strong> Você deve escolher uma opção.
                                                            </div>
                                                            <?php } ?>  
                                                            <div class="control-group highlight">
                                                                <label class="control-label" for="inputPossuiDeficiencia">Aluno com deficiência, transtorno global do desenvolvimento ou altas habilidades/superdotação</label>
                                                                <div class="controls" style='line-height: 85px;'>                
                                                                    <input type="radio" name="possuiDeficiencia" value="sim" onclick='$("#deficiencias").css("display", "inherit");' required
                                                                    <?php
                                                                    if (isset($_POST['possuiDeficiencia'])) {
                                                                        if ($_POST['possuiDeficiencia'] == 'sim') {
                                                                            echo 'checked';
                                                                        }
                                                                    }
                                                                    ?>><font style='position: relative; top: 4px; left: 5px;'>Sim</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    <input type="radio" name="possuiDeficiencia" value="nao" onclick='$("#deficiencias").css("display", "none");' required
                                                                    <?php
                                                                    if (isset($_POST['possuiDeficiencia'])) {
                                                                        if ($_POST['possuiDeficiencia'] == 'nao') {
                                                                            echo 'checked';
                                                                        }
                                                                    }
                                                                    ?>><font style='position: relative; top: 4px; left: 5px;'>Não</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    <input type="radio" name="possuiDeficiencia" value="naoSei" required
                                                                    <?php
                                                                    if (isset($_POST['possuiDeficiencia'])) {
                                                                        if ($_POST['possuiDeficiencia'] == 'naoSei') {
                                                                            echo 'checked';
                                                                        }
                                                                    }
                                                                    ?>><font style='position: relative; top: 4px; left: 5px;'>Não sei</font><br>
                                                                </div>
                                                            </div>
                                                            <?php if (isset($erro['possuiDeficiencia'])) { ?>
                                                            <div class="erro" style='width: 85%; margin-left: auto; margin-right: auto;'>
                                                                <strong>Erro!</strong> Você deve informar se o aluno possui deficiência, transtorno global do desenvolvimento ou altas habilidades/superdotação.
                                                            </div>
                                                            <?php } ?>
                                                            <div id='deficiencias'
                                                            <?php
                                                            if (isset($_POST['possuiDeficiencia'])) {
                                                                if ($_POST['possuiDeficiencia'] == 'sim') {
                                                                    echo 'style="display: inherit;"';
                                                                } else {
                                                                    echo 'style="display: none;"';
                                                                }
                                                            } else {
                                                                echo 'style="display: none;"';
                                                            }
                                                            ?>>
                                                            <div class="control-group highlight" style="">
                                                                <label class="control-label" for="inputDeficiencias">Deficiências</label>
                                                                <div class="controls">                
                                                                    <label>
                                                                        <input id='1' type="checkbox" name="deficiencias[]" value="cegueira"
                                                                        <?php
                                                                        if (isset($_POST['deficiencias'])) {
                                                                            if (in_array('cegueira', $_POST['deficiencias'])) {
                                                                                echo 'checked';
                                                                            }
                                                                        }
                                                                        ?>>
                                                                        <font style='position: relative; top: 3px; left: 0px; display: inline;'>
                                                                            Cegueira
                                                                        </font>
                                                                    </label>
                                                                    <label>
                                                                        <input id='1' type="checkbox" name="deficiencias[]" value="baixaVisao"
                                                                        <?php
                                                                        if (isset($_POST['deficiencias'])) {
                                                                            if (in_array('baixaVisao', $_POST['deficiencias'])) {
                                                                                echo 'checked';
                                                                            }
                                                                        }
                                                                        ?>>
                                                                        <font style='position: relative; top: 3px; left: 0px; display: inline;'>
                                                                            Baixa Visão
                                                                        </font>
                                                                    </label>
                                                                    <label>
                                                                        <input id='1' type="checkbox" name="deficiencias[]" value="surdez"
                                                                        <?php
                                                                        if (isset($_POST['deficiencias'])) {
                                                                            if (in_array('surdez', $_POST['deficiencias'])) {
                                                                                echo 'checked';
                                                                            }
                                                                        }
                                                                        ?>>
                                                                        <font style='position: relative; top: 3px; left: 0px; display: inline;'>
                                                                            Surdez
                                                                        </font>
                                                                    </label>
                                                                    <label>
                                                                        <input id='1' type="checkbox" name="deficiencias[]" value="deficienciaAuditiva"
                                                                        <?php
                                                                        if (isset($_POST['deficiencias'])) {
                                                                            if (in_array('deficienciaAuditiva', $_POST['deficiencias'])) {
                                                                                echo 'checked';
                                                                            }
                                                                        }
                                                                        ?>>
                                                                        <font style='position: relative; top: 3px; left: 0px; display: inline;'>
                                                                            Deficiência auditiva
                                                                        </font>
                                                                    </label>
                                                                    <label>
                                                                        <input id='1' type="checkbox" name="deficiencias[]" value="surdocegueira"
                                                                        <?php
                                                                        if (isset($_POST['deficiencias'])) {
                                                                            if (in_array('surdocegueira', $_POST['deficiencias'])) {
                                                                                echo 'checked';
                                                                            }
                                                                        }
                                                                        ?>>
                                                                        <font style='position: relative; top: 3px; left: 0px; display: inline;'>
                                                                            Surdocegueira
                                                                        </font>
                                                                    </label>
                                                                    <label>
                                                                        <input id='1' type="checkbox" name="deficiencias[]" value="deficienciaFisica"
                                                                        <?php
                                                                        if (isset($_POST['deficiencias'])) {
                                                                            if (in_array('deficienciaFisica', $_POST['deficiencias'])) {
                                                                                echo 'checked';
                                                                            }
                                                                        }
                                                                        ?>>
                                                                        <font style='position: relative; top: 3px; left: 0px; display: inline;'>
                                                                            Deficiência física
                                                                        </font>
                                                                    </label>
                                                                    <label>
                                                                        <input id='1' type="checkbox" name="deficiencias[]" value="deficienciaIntelectual"
                                                                        <?php
                                                                        if (isset($_POST['deficiencias'])) {
                                                                            if (in_array('deficienciaIntelectual', $_POST['deficiencias'])) {
                                                                                echo 'checked';
                                                                            }
                                                                        }
                                                                        ?>>
                                                                        <font style='position: relative; top: 3px; left: 0px; display: inline;'>
                                                                            Deficiência intelectual
                                                                        </font>
                                                                    </label>
                                                                    <label>
                                                                        <input id='1' type="checkbox" name="deficiencias[]" value="deficienciaMultipla"
                                                                        <?php
                                                                        if (isset($_POST['deficiencias'])) {
                                                                            if (in_array('deficienciaMultipla', $_POST['deficiencias'])) {
                                                                                echo 'checked';
                                                                            }
                                                                        }
                                                                        ?>>
                                                                        <font style='position: relative; top: 3px; left: 0px; display: inline;'>
                                                                            Deficiência múltipla
                                                                        </font>
                                                                    </label>
                                                                </div>   
                                                            </div>             
                                                            <br>
                                                            <div class="control-group highlight" style="">
                                                                <label class="control-label" for="inputDeficiencias">Transtorno global do desenvolvimento</label>
                                                                <div class="controls">                
                                                                    <label>
                                                                        <input id='1' type="checkbox" name="deficiencias[]" value="autismoInfantil"
                                                                        <?php
                                                                        if (isset($_POST['deficiencias'])) {
                                                                            if (in_array('autismoInfantil', $_POST['deficiencias'])) {
                                                                                echo 'checked';
                                                                            }
                                                                        }
                                                                        ?>>
                                                                        <font style='position: relative; top: 3px; left: 0px; display: inline;'>
                                                                            Autismo Infantil
                                                                        </font>
                                                                    </label>
                                                                    <label>
                                                                        <input id='1' type="checkbox" name="deficiencias[]" value="asperger"
                                                                        <?php
                                                                        if (isset($_POST['deficiencias'])) {
                                                                            if (in_array('asperger', $_POST['deficiencias'])) {
                                                                                echo 'checked';
                                                                            }
                                                                        }
                                                                        ?>>
                                                                        <font style='position: relative; top: 3px; left: 0px; display: inline;'>
                                                                            Síndrome de Asperger
                                                                        </font>
                                                                    </label>
                                                                    <label>
                                                                        <input id='1' type="checkbox" name="deficiencias[]" value="rett"
                                                                        <?php
                                                                        if (isset($_POST['deficiencias'])) {
                                                                            if (in_array('rett', $_POST['deficiencias'])) {
                                                                                echo 'checked';
                                                                            }
                                                                        }
                                                                        ?>>
                                                                        <font style='position: relative; top: 3px; left: 0px; display: inline;'>
                                                                            Síndrome de Rett
                                                                        </font>
                                                                    </label>
                                                                    <label>
                                                                        <input id='1' type="checkbox" name="deficiencias[]" value="tdi"
                                                                        <?php
                                                                        if (isset($_POST['deficiencias'])) {
                                                                            if (in_array('tdi', $_POST['deficiencias'])) {
                                                                                echo 'checked';
                                                                            }
                                                                        }
                                                                        ?>>
                                                                        <font style='position: relative; top: 3px; left: 5px; display: inline;'>
                                                                            Transtorno Desintegrativo da Infância
                                                                        </font>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="control-group highlight" style="">
                                                                <label class="control-label" for="inputDeficiencias">Altas habilidades ou Superdotação</label>
                                                                <div class="controls">                
                                                                    <label>
                                                                        <input id='1' type="checkbox" name="deficiencias[]" value="superdotado"
                                                                        <?php
                                                                        if (isset($_POST['deficiencias'])) {
                                                                            if (in_array('superdotado', $_POST['deficiencias'])) {
                                                                                echo 'checked';
                                                                            }
                                                                        }
                                                                        ?>>
                                                                        <font style='position: relative; top: 3px; left: 0px; display: inline;'>
                                                                            Altas habilidades ou Superdotação
                                                                        </font>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="control-group highlight" style="">
                                                                <label class="control-label" for="inputDeficiencias">Recursos necessários para a participação do aluno em avaliações do Inep</label>
                                                                <div class="controls">                
                                                                    <label>
                                                                        <input id='1' type="checkbox" name="recursos[]" value="auxilioLedor"
                                                                        <?php
                                                                        if (isset($_POST['recursos'])) {
                                                                            if (in_array('auxilioLedor', $_POST['recursos'])) {
                                                                                echo 'checked';
                                                                            }
                                                                        }
                                                                        ?>>
                                                                        <font style='position: relative; top: 3px; left: 0px; display: inline;'>
                                                                            Auxílio ledor
                                                                        </font>
                                                                    </label>
                                                                    <label>
                                                                        <input id='1' type="checkbox" name="recursos[]" value="auxilioTranscricao"
                                                                        <?php
                                                                        if (isset($_POST['recursos'])) {
                                                                            if (in_array('auxilioTranscricao', $_POST['recursos'])) {
                                                                                echo 'checked';
                                                                            }
                                                                        }
                                                                        ?>>
                                                                        <font style='position: relative; top: 3px; left: 0px; display: inline;'>
                                                                            Auxílio-transcrição
                                                                        </font>
                                                                    </label>
                                                                    <label>
                                                                        <input id='1' type="checkbox" name="recursos[]" value="guiaInterprete"
                                                                        <?php
                                                                        if (isset($_POST['recursos'])) {
                                                                            if (in_array('guiaInterprete', $_POST['recursos'])) {
                                                                                echo 'checked';
                                                                            }
                                                                        }
                                                                        ?>>
                                                                        <font style='position: relative; top: 3px; left: 0px; display: inline;'>
                                                                            Guia-Intérprete
                                                                        </font>
                                                                    </label>
                                                                    <label>
                                                                        <input id='1' type="checkbox" name="recursos[]" value="interpreteLibras"
                                                                        <?php
                                                                        if (isset($_POST['recursos'])) {
                                                                            if (in_array('interpreteLibras', $_POST['recursos'])) {
                                                                                echo 'checked';
                                                                            }
                                                                        }
                                                                        ?>>
                                                                        <font style='position: relative; top: 3px; left: 0px; display: inline;'>
                                                                            Intérprete de libras
                                                                        </font>
                                                                    </label>
                                                                    <label>
                                                                        <input id='1' type="checkbox" name="recursos[]" value="leituraLabial"
                                                                        <?php
                                                                        if (isset($_POST['recursos'])) {
                                                                            if (in_array('leituraLabial', $_POST['recursos'])) {
                                                                                echo 'checked';
                                                                            }
                                                                        }
                                                                        ?>>
                                                                        <font style='position: relative; top: 3px; left: 0px; display: inline;'>
                                                                            Leitura labial
                                                                        </font>
                                                                    </label>
                                                                    <label>
                                                                        <input id='1' type="checkbox" name="recursos[]" value="braile"
                                                                        <?php
                                                                        if (isset($_POST['recursos'])) {
                                                                            if (in_array('braile', $_POST['recursos'])) {
                                                                                echo 'checked';
                                                                            }
                                                                        }
                                                                        ?>>
                                                                        <font style='position: relative; top: 3px; left: 0px; display: inline;'>
                                                                            Prova em braile
                                                                        </font>
                                                                    </label>
                                                                    <label>
                                                                        <input id='1' type="checkbox" name="recursos[]" value="ampliada16"
                                                                        <?php
                                                                        if (isset($_POST['recursos'])) {
                                                                            if (in_array('ampliada16', $_POST['recursos'])) {
                                                                                echo 'checked';
                                                                            }
                                                                        }
                                                                        ?>>
                                                                        <font style='position: relative; top: 3px; left: 0px; display: inline;'>
                                                                            Prova ampliada (Fonte 16)
                                                                        </font>
                                                                    </label>
                                                                    <label>
                                                                        <input id='1' type="checkbox" name="recursos[]" value="ampliada20"
                                                                        <?php
                                                                        if (isset($_POST['recursos'])) {
                                                                            if (in_array('ampliada20', $_POST['recursos'])) {
                                                                                echo 'checked';
                                                                            }
                                                                        }
                                                                        ?>>
                                                                        <font style='position: relative; top: 3px; left: 0px; display: inline;'>
                                                                            Prova ampliada (Fonte 20)
                                                                        </font>
                                                                    </label>
                                                                    <label>
                                                                        <input id='1' type="checkbox" name="recursos[]" value="ampliada24"
                                                                        <?php
                                                                        if (isset($_POST['recursos'])) {
                                                                            if (in_array('ampliada24', $_POST['recursos'])) {
                                                                                echo 'checked';
                                                                            }
                                                                        }
                                                                        ?>>
                                                                        <font style='position: relative; top: 3px; left: 0px; display: inline;'>
                                                                            Prova ampliada (Fonte 24)
                                                                        </font>
                                                                    </label>  
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <a href='outrosDados.php' class='btn'>Voltar</a>
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
        <script src="js/bootstrap-datepicker.js"></script>
        <script type="text/javascript">
                                    //$('.datepicker').datepicker();
                                </script>
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
                                    $('#conteudo').css('display', 'inherit');
                                </script>
                                <script>
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
