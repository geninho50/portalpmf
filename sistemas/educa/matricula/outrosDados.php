<?php
session_name('ma');
session_start();

if (!$_SESSION['preenchido']['dados_pessoais']) {
    header('Location: dadosPessoaisAluno.php');
}

if (count($_POST) > 0) {
    if (isset($_POST['utilizouTransporte'])) {
        if ($_POST['utilizouTransporte'] == '') {
            $erro['utilizouTransporte'] = true;
        } elseif ($_POST['utilizouTransporte'] == 'sim') {
            if (isset($_POST['tipoTransporte'])) {
                if ($_POST['tipoTransporte'] == '') {
                    $erro['tipoTransporte'] = true;
                } else {
                    if (isset($_POST['numeroTransporte'])) {
                        if ($_POST['numeroTransporte'] == '') {
                            $erro['numeroTransporte'] = true;
                        } elseif (!ctype_digit($_POST['numeroTransporte'])) {
                            $erro['numeroTransporteInvalido'] = true;
                        }
                    }
                }
            } else {
                $erro['tipoTransporte'] = true;
            }
        }
    } else {
        $erro['utilizouTransporte'] = true;
    }

    if (isset($_POST['precisaraTranporte'])) {
        if ($_POST['precisaraTranporte'] == '') {
            $erro['precisaraTranporte'] = true;
        }
    } else {
        $erro['precisaraTranporte'] = true;
    }

    if (isset($_POST['zonaMoradia'])) {
        if ($_POST['zonaMoradia'] == '') {
            $erro['zonaMoradia'] = true;
        }
    } else {
        $erro['zonaMoradia'] = true;
    }

    if (isset($_POST['autorizaUso'])) {
        if ($_POST['autorizaUso'] == '') {
            $erro['autorizaUso'] = true;
        }
    } else {
        $erro['autorizaUso'] = true;
    }

    if (isset($_POST['bolsaFamilia'])) {
        if ($_POST['bolsaFamilia'] == '') {
            $erro['bolsaFamilia'] = true;
        }
    } else {
        $erro['bolsaFamilia'] = true;
    }

    if (isset($_POST['localPermanencia'])) {
        if ($_POST['localPermanencia'] == '') {
            $erro['localPermanencia'] = true;
        } elseif ($_POST['localPermanencia'] == 'outro') {
            if (isset($_POST['outroLocalPermanencia'])) {
                if ($_POST['outroLocalPermanencia'] == '') {
                    $erro['outroLocalPermanencia'] = true;
                }
            } else {
                $erro['outroLocalPermanencia'] = true;
            }
        }
    } else {
        $erro['localPermanencia'] = true;
    }

    if (isset($_POST['possuiComputador'])) {
        if ($_POST['possuiComputador'] == '') {
            $erro['possuiComputador'] = true;
        }
    } else {
        $erro['possuiComputador'] = true;
    }

    if (isset($_POST['acessoInternet'])) {
        if ($_POST['acessoInternet'] == '') {
            $erro['acessoInternet'] = true;
        }
    } else {
        $erro['acessoInternet'] = true;
    }

    if (isset($_POST['carro'])) {
        if ($_POST['carro'] == '') {
            $erro['carro'] = true;
        }
    } else {
        $erro['carro'] = true;
    }

    if (isset($_POST['moradia'])) {
        if ($_POST['moradia'] == '') {
            $erro['moradia'] = true;
        }
    } else {
        $erro['moradia'] = true;
    }

    if (isset($_POST['pensao'])) {
        if ($_POST['pensao'] == '') {
            $erro['pensao'] = true;
        }
    } else {
        $erro['pensao'] = true;
    }    

    if (isset($_POST['tempoResidencia'])) {
        if ($_POST['tempoResidencia'] == 'Selecione um...') {
            $erro['tempoResidencia'] = true;
        }
    }
    if (isset($_POST['acessoInternet'])) {
        if ($_POST['acessoInternet'] == 'Selecione um...') {
            $erro['acessoInternet'] = true;
        }
    }

}

if (count($_POST) > 0) {
    if (!isset($erro)) {
        $_SESSION['outrosDados']['utilizou_transporte'] = $_POST['utilizouTransporte'];
        $_SESSION['outrosDados']['tipo_transporte'] = $_POST['tipoTransporte'];
        $_SESSION['outrosDados']['numero_cartao_transporte'] = $_POST['numeroTransporte'];
        $_SESSION['outrosDados']['precisara_transporte'] = $_POST['precisaraTranporte'];
        $_SESSION['outrosDados']['zona_moradia'] = $_POST['zonaMoradia'];
        $_SESSION['outrosDados']['autoriza_uso'] = $_POST['autorizaUso'];
        $_SESSION['outrosDados']['pensao'] = $_POST['pensao'];
        $_SESSION['outrosDados']['carro'] = $_POST['carro'];
        $_SESSION['outrosDados']['moradia'] = $_POST['moradia'];
        $_SESSION['outrosDados']['bolsa_familia'] = $_POST['bolsaFamilia'];
        $_SESSION['outrosDados']['local_permanencia'] = $_POST['localPermanencia'];
        $_SESSION['outrosDados']['outro_local_permanencia'] = $_POST['outroLocalPermanencia'];
        $_SESSION['outrosDados']['possui_computador'] = $_POST['possuiComputador'];
        $_SESSION['outrosDados']['acesso_internet'] = $_POST['acessoInternet'];
        $_SESSION['outrosDados']['tempo_residencia'] = $_POST['tempoResidencia'];
        $_SESSION['outrosDados']['nome_mae'] = $_SESSION['identificacao']['nome_mae'];
        $_SESSION['outrosDados']['nome_pai'] = $_SESSION['identificacao']['nome_pai'];
        $_SESSION['preenchido']['outros_dados'] = true;

        include_once 'fnc/inserirOutrosDados.php';
        inserirOutrosDados($_SESSION['outrosDados'], $_SESSION['aluno']['id']);

        header("Location: dadosSaude.php");
    }
}

if (isset($_SESSION['outrosDados']['utilizou_transporte'])) {
    $_POST['utilizouTransporte'] = $_SESSION['outrosDados']['utilizou_transporte'];
}
if (isset($_SESSION['outrosDados']['tipo_transporte'])) {
    $_POST['tipoTransporte'] = $_SESSION['outrosDados']['tipo_transporte'];
}
if (isset($_SESSION['outrosDados']['numero_cartao_transporte'])) {
    $_POST['numeroTransporte'] = $_SESSION['outrosDados']['numero_cartao_transporte'];
}
if (isset($_SESSION['outrosDados']['precisara_transporte'])) {
    $_POST['precisaraTranporte'] = $_SESSION['outrosDados']['precisara_transporte'];
}
if (isset($_SESSION['outrosDados']['carro'])) {
    $_POST['carro'] = $_SESSION['outrosDados']['carro'];
}
if (isset($_SESSION['outrosDados']['moradia'])) {
    $_POST['moradia'] = $_SESSION['outrosDados']['moradia'];
}
if (isset($_SESSION['outrosDados']['pensao'])) {
    $_POST['pensao'] = $_SESSION['outrosDados']['pensao'];
}
if (isset($_SESSION['outrosDados']['zona_moradia'])) {
    $_POST['zonaMoradia'] = $_SESSION['outrosDados']['zona_moradia'];
}
if (isset($_SESSION['outrosDados']['autoriza_uso'])) {
    $_POST['autorizaUso'] = $_SESSION['outrosDados']['autoriza_uso'];
}
if (isset($_SESSION['outrosDados']['bolsa_familia'])) {
    $_POST['bolsaFamilia'] = $_SESSION['outrosDados']['bolsa_familia'];
}
if (isset($_SESSION['outrosDados']['local_permanencia'])) {
    $_POST['localPermanencia'] = $_SESSION['outrosDados']['local_permanencia'];
}
if (isset($_SESSION['outrosDados']['outro_local_permanencia'])) {
    $_POST['outroLocalPermanencia'] = $_SESSION['outrosDados']['outro_local_permanencia'];
}
if (isset($_SESSION['outrosDados']['possui_computador'])) {
    $_POST['possuiComputador'] = $_SESSION['outrosDados']['possui_computador'];
}
if (isset($_SESSION['outrosDados']['acesso_internet'])) {
    $_POST['acessoInternet'] = $_SESSION['outrosDados']['acesso_internet'];
}
if (isset($_SESSION['outrosDados']['tempo_residencia'])) {
    $_POST['tempoResidencia'] = $_SESSION['outrosDados']['tempo_residencia'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" CONTENT="NO-CACHE">
    <title>SGE &middot; Outros Dados</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <style>
        .controls {
            text-align: left; padding-left: 40px;
        }
    </style>

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
                        <h3>Outras Informações do Aluno</h3>
                        <img src="img/lapis.png" style="width: 470px; position:relative; top: -65px; left: -25px;">
                    </div>
                </div>
                <div class='row-fluid' style='text-align: center;'>


                    <?php include 'shared/barraLateral.php'; ?>

                    <div class="span8 folha" style='display: none;' id='conteudo'>
                        <img src="img/canto.png" style="position: relative; left: -238px; top: -10px;">
                        <form class="form-horizontal" method="post">
                            <div class="control-group highlight" style='margin-bottom: 0px;'>
                                <label class="control-label" for="inputTransporteAno">Utilizou transporte<br> escolar em 2013</label>
                                <div class="controls" style='line-height: 40px;'>                
                                    <input type="radio" name="utilizouTransporte" value="sim" 
                                    <?php
                                    if (isset($_POST['utilizouTransporte'])) {
                                        if ($_POST['utilizouTransporte'] == 'sim') {
                                            echo 'checked';
                                        }
                                    }
                                    ?>
                                    onclick="$('#inputTipoTransporte').removeAttr('disabled');
                                    $('#divTransporte').css('display', 'inherit');
                                    if ($('#inputTipoTransporte').val() == 'publico') {
                                    $('#inputNumeroCartaoTransporte').removeAttr('disabled');
                                } else {
                                $('#inputNumeroCartaoTransporte').attr('disabled', '');
                            }">
                            <font style='position: relative; top: 4px; left: 5px;'>Sim</font> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                            <input type="radio" name="utilizouTransporte" value="nao"
                            <?php
                            if (isset($_POST['utilizouTransporte'])) {
                                if ($_POST['utilizouTransporte'] == 'nao') {
                                    echo 'checked';
                                }
                            }
                            ?>
                            onclick="$('#inputTipoTransporte').attr('disabled', '');
                            $('#inputNumeroCartaoTransporte').attr('disabled', '');
                            $('#divTransporte').css('display', 'none');
                            "><font style='position: relative; top: 4px; left: 5px;'>Não</font>
                        </div>
                    </div>
                    <?php if (isset($erro['utilizouTransporte'])) { ?>
                    <div class="erro" style='width: 80%; margin-left: auto; margin-right: auto;'>
                        <strong>Erro!</strong> Você deve informar se utilizou transporte escolar em 2013.
                    </div>
                    <?php } ?>                
                    <div id='divTransporte' <?php
                    if (isset($_POST['utilizouTransporte'])) {
                        if ($_POST['utilizouTransporte'] == 'nao') {
                            echo 'style="display: none;"';
                        }
                    }
                    ?>>
                    <label class="control-label" for="inputTipoTransporte">Tipo de Transporte</label>
                    <div class="controls">
                        <select name='tipoTransporte' id='inputTipoTransporte' 
                        onchange="if ($(this).val() == '2') {
                        $('#inputNumeroCartaoTransporte').removeAttr('disabled');
                    } else {
                    $('#inputNumeroCartaoTransporte').attr('disabled', '');
                    $('#inputNumeroCartaoTransporte').val('');
                }" 
                <?php
                if (isset($_POST['utilizouTransporte'])) {
                    if ($_POST['utilizouTransporte'] == 'nao') {
                        echo 'disabled';
                    }
                }
                ?>>

                <?php
                include 'fnc/listaDeRedes.php';
                $redes = listaDeRedes();
                foreach ($redes as $key => $value) {
                    if (isset($_POST['tipoTransporte'])) {
                        if ($_POST['tipoTransporte'] == $key) {
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
        <?php if (isset($erro['tipoTransporte'])) { ?>
        <div class="erro" style='width: 80%; margin-left: auto; margin-right: auto;'>
            <strong>Erro!</strong> Você deve informar um tipo de transporte.
        </div>
        <?php } ?>                    
        <label class="control-label" for="inputNumeroCartaoTransporte">N&ordm; Cartão de Transporte</label>
        <div class="controls">
            <input type='text'  maxlength="10" name='numeroTransporte' id='inputNumeroCartaoTransporte' onkeypress='verificaDigitos("#inputNumeroCartaoTransporte");' onkeyup='verificaDigitos("#inputNumeroCartaoTransporte");'
            <?php
            if (isset($_POST['numeroTransporte'])) {
                if ($_POST['numeroTransporte'] != '') {
                    echo 'value="' . $_POST['numeroTransporte'] . '"';
                }
            }
            ?>
            <?php
            if (isset($_POST['tipoTransporte'])) {
                if ($_POST['tipoTransporte'] != 2) {
                    echo 'disabled';
                }
            } else {
                echo 'disabled';
            }
            ?>>
        </div>
        <?php if (isset($erro['numeroTransporte'])) { ?>
        <div class="erro" style='width: 80%; margin-left: auto; margin-right: auto;'>
            <strong>Erro!</strong> Você deve informar o número do cartão de transporte.
        </div>
        <?php } ?> 
        <?php if (isset($erro['numeroTransporteInvalido'])) { ?>
        <div class="erro" style='width: 80%; margin-left: auto; margin-right: auto;'>
            <strong>Erro!</strong> Você deve informar um número válido.
        </div>
        <?php } ?>  
    </div>
    <div class="control-group highlight" style='margin-bottom: 0px;'>
        <label class="control-label" for="inputPrecisaraTransporte">Precisará de transporte público em 2014?</label>
        <div class="controls" style='line-height: 40px'>                
            <input type="radio" name="precisaraTranporte" value="sim" 
            <?php
            if (isset($_POST['precisaraTranporte'])) {
                if ($_POST['precisaraTranporte'] == 'sim') {
                    echo 'checked';
                }
            }
            ?>><font style='position: relative; top: 4px; left: 5px;'>Sim</font> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            <input type="radio" name="precisaraTranporte" value="nao"
            <?php
            if (isset($_POST['precisaraTranporte'])) {
                if ($_POST['precisaraTranporte'] == 'nao') {
                    echo 'checked';
                }
            }
            ?>><font style='position: relative; top: 4px; left: 5px;'>Não</font>
        </div>
    </div>
    <?php if (isset($erro['precisaraTranporte'])) { ?>
    <div class="erro" style='width: 80%; margin-left: auto; margin-right: auto;'>
        <strong>Erro!</strong> Você deve informar se precisará de transporte em 2014.
    </div>
    <?php } ?>  
    <div class="control-group highlight" style='margin-bottom: 0px;'>
        <label class="control-label" for="inputZonaMoradia">Zona de Moradia</label>
        <div class="controls">                
            <input type="radio" name="zonaMoradia" value="rural" 
            <?php
            if (isset($_POST['zonaMoradia'])) {
                if ($_POST['zonaMoradia'] == 'rural') {
                    echo 'checked';
                }
            }
            ?>><font style='position: relative; top: 4px; left: 5px;'>Rural</font> &nbsp; &nbsp; &nbsp;
            <input type="radio" name="zonaMoradia" value="urbana"
            <?php
            if (isset($_POST['zonaMoradia'])) {
                if ($_POST['zonaMoradia'] == 'urbana') {
                    echo 'checked';
                }
            }
            ?>><font style='position: relative; top: 4px; left: 5px;'>Urbana</font>
        </div>
    </div>   
    <?php if (isset($erro['zonaMoradia'])) { ?>
    <div class="erro" style='width: 80%; margin-left: auto; margin-right: auto;'>
        <strong>Erro!</strong> Você deve informar sua zona de moradia.
    </div>
    <?php } ?>  
    <div class="control-group highlight" style='margin-bottom: 0px;'>
        <label class="control-label" for="inputAutorizaUso">Autoriza Uso de imagem e produção?</label>
        <div class="controls" style='line-height: 40px'>                
            <input type="radio" name="autorizaUso" value="sim" 
            <?php
            if (isset($_POST['autorizaUso'])) {
                if ($_POST['autorizaUso'] == 'sim') {
                    echo 'checked';
                }
            }
            ?>><font style='position: relative; top: 4px; left: 5px;'>Sim</font> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            <input type="radio" name="autorizaUso" value="nao"
            <?php
            if (isset($_POST['autorizaUso'])) {
                if ($_POST['autorizaUso'] == 'nao') {
                    echo 'checked';
                }
            }
            ?>><font style='position: relative; top: 4px; left: 5px;'>Não</font>
        </div>
    </div>      
    <?php if (isset($erro['autorizaUso'])) { ?>
    <div class="erro" style='width: 80%; margin-left: auto; margin-right: auto;'>
        <strong>Erro!</strong> Você deve informar se autoriza uso de imagem e produção.
    </div>
    <?php } ?>  
    <div class="control-group highlight" style='margin-bottom: 0px;'>
        <label class="control-label" for="inputBolsaFamilia">Família recebe<br> Bolsa Família?</label>
        <div class="controls" style='line-height: 40px'>                
            <input type="radio" name="bolsaFamilia" value="sim" 
            <?php
            if (isset($_POST['bolsaFamilia'])) {
                if ($_POST['bolsaFamilia'] == 'sim') {
                    echo 'checked';
                }
            }
            ?>><font style='position: relative; top: 4px; left: 5px;'>Sim</font> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            <input type="radio" name="bolsaFamilia" value="nao"
            <?php
            if (isset($_POST['bolsaFamilia'])) {
                if ($_POST['bolsaFamilia'] == 'nao') {
                    echo 'checked';
                }
            }
            ?>><font style='position: relative; top: 4px; left: 5px;'>Não</font>
        </div>
    </div>      
    <?php if (isset($erro['bolsaFamilia'])) { ?>
    <div class="erro" style='width: 80%; margin-left: auto; margin-right: auto;'>
        <strong>Erro!</strong> Você deve informar se sua família recebe bolsa família.
    </div>
    <?php } ?>  

    <div class="control-group highlight" style='margin-bottom: 0px;'>
        <label class="control-label" for="inputPensao">Família recebe<br> pensão?</label>
        <div class="controls" style='line-height: 40px'>                
            <input type="radio" name="pensao" value="sim" 
            <?php
            if (isset($_POST['pensao'])) {
                if ($_POST['pensao'] == 'sim') {
                    echo 'checked';
                }
            }
            ?>><font style='position: relative; top: 4px; left: 5px;'>Sim</font> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            <input type="radio" name="pensao" value="nao"
            <?php
            if (isset($_POST['pensao'])) {
                if ($_POST['pensao'] == 'nao') {
                    echo 'checked';
                }
            }
            ?>><font style='position: relative; top: 4px; left: 5px;'>Não</font>
        </div>
    </div>      
    <?php if (isset($erro['pensao'])) { ?>
    <div class="erro" style='width: 80%; margin-left: auto; margin-right: auto;'>
        <strong>Erro!</strong> Você deve informar se sua família recebe pensão.
    </div>
    <?php } ?> 

    <div class="control-group highlight" style='margin-bottom: 0px;'>
        <label class="control-label" for="inputCarro">Família possui carro?</label>
        <div class="controls" style='line-height: 20px'>                
            <input type="radio" name="carro" value="sim" 
            <?php
            if (isset($_POST['carro'])) {
                if ($_POST['carro'] == 'sim') {
                    echo 'checked';
                }
            }
            ?>><font style='position: relative; top: 4px; left: 5px;'>Sim</font> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            <input type="radio" name="carro" value="nao"
            <?php
            if (isset($_POST['carro'])) {
                if ($_POST['carro'] == 'nao') {
                    echo 'checked';
                }
            }
            ?>><font style='position: relative; top: 4px; left: 5px;'>Não</font>
        </div>
    </div>      
    <?php if (isset($erro['carro'])) { ?>
    <div class="erro" style='width: 80%; margin-left: auto; margin-right: auto;'>
        <strong>Erro!</strong> Você deve informar se sua família possui carro.
    </div>
    <?php } ?>

    <div class="control-group highlight" style='margin-bottom: 0px;'>
        <label class="control-label" for="inputMoradia"> Situação da Moradia</label>
        <div class="controls" style='line-height: 20px'>                
            <input type="radio" name="moradia" value="propria" 
            <?php
            if (isset($_POST['moradia'])) {
                if ($_POST['moradia'] == 'propria') {
                    echo 'checked';
                }
            }
            ?>><font style='position: relative; top: 4px; left: 5px;'>Casa Própria</font> &nbsp; &nbsp; &nbsp;
            <input type="radio" name="moradia" value="alugada"
            <?php
            if (isset($_POST['moradia'])) {
                if ($_POST['moradia'] == 'alugada') {
                    echo 'checked';
                }
            }
            ?>><font style='position: relative; top: 4px; left: 5px;'>Alugada</font> &nbsp; &nbsp; &nbsp;
            <input type="radio" name="moradia" value="outros"
            <?php
            if (isset($_POST['moradia'])) {
                if ($_POST['moradia'] == 'outros') {
                    echo 'checked';
                }
            }
            ?>><font style='position: relative; top: 4px; left: 5px;'>Outro</font>
        </div>
    </div>      
    <?php if (isset($erro['moradia'])) { ?>
    <div class="erro" style='width: 80%; margin-left: auto; margin-right: auto;'>
        <strong>Erro!</strong> Você deve informar a situação da moradia da família.
    </div>
    <?php } ?>

    <div class="control-group  highlight" style='margin-bottom: 0px;'>
        <label class="control-label" for="inputBolsaFamilia">Local de Permanência<br> no contra-turno</label>
        <div class="controls" style='line-height: 40px'>                
            <input type="radio" name="localPermanencia" value="casa" onclick="$('#divOutroLocal').css('display', 'none');"
            <?php
            if (isset($_POST['localPermanencia'])) {
                if ($_POST['localPermanencia'] == 'casa') {
                    echo 'checked';
                }
            }
            ?>><font style='position: relative; top: 4px; left: 5px;'>Casa</font> &nbsp;
            <input type="radio" name="localPermanencia" value="ue" onclick="$('#divOutroLocal').css('display', 'none');"
            <?php
            if (isset($_POST['localPermanencia'])) {
                if ($_POST['localPermanencia'] == 'ue') {
                    echo 'checked';
                }
            }
            ?>><font style='position: relative; top: 4px; left: 5px;'>Unidade de Educação</font> &nbsp;
            <input type="radio" name="localPermanencia" value="outro" onclick="$('#divOutroLocal').css('display', 'inherit');"
            <?php
            if (isset($_POST['localPermanencia'])) {
                if ($_POST['localPermanencia'] == 'outro') {
                    echo 'checked';
                }
            }
            ?>><font style='position: relative; top: 4px; left: 5px;'>Outro</font>
        </div>
    </div>      
    <?php if (isset($erro['localPermanencia'])) { ?>
    <div class="erro" style='width: 80%; margin-left: auto; margin-right: auto;'>
        <strong>Erro!</strong> Você deve informar o local de permanência no contra-turno.
    </div>
    <?php } ?>  
    <div id='divOutroLocal'
    <?php
    if (isset($_POST['localPermanencia'])) {
        if ($_POST['localPermanencia'] != 'outro') {
            echo 'style="display: none;"';
        } else {
            echo 'style="display: inherit; margin-bottom: 0px;"';
        }
    } else {
        echo 'style="display: none;"';
    }
    ?>>
    <div class="control-group highlight">
        <label class="control-label" for="inputOutroLocalPermanencia">Outro Local de Permanência</label>
        <div class="controls" style='margin-bottom: 0px; margin-top: 10px;'>
            <input type='text' name='outroLocalPermanencia' id='inputOutroLocalPermanencia' 
            <?php
            if (isset($_POST['outroLocalPermanencia'])) {
                if ($_POST['outroLocalPermanencia'] != '') {
                    echo 'value="' . $_POST['outroLocalPermanencia'] . '"';
                }
            }
            ?>>
        </div>
    </div>   
    <?php if (isset($erro['outroLocalPermanencia'])) { ?>
    <div class="erro" style='width: 80%; margin-left: auto; margin-right: auto;'>
        <strong>Erro!</strong> Você deve informar o local de permanência no contra-turno.
    </div>
    <?php } ?>  
</div>  
<div class="control-group highlight" style='margin-bottom: 0px;'>
    <label class="control-label" for="inputPossuiComputador">Possui Computador?</label>
    <div class="controls" style='line-height: 20px'>                
        <input type="radio" name="possuiComputador" value="sim" 
        <?php
        if (isset($_POST['possuiComputador'])) {
            if ($_POST['possuiComputador'] == 'sim') {
                echo 'checked';
            }
        }
        ?>><font style='position: relative; top: 4px; left: 5px;'>Sim</font> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
        <input type="radio" name="possuiComputador" value="nao"
        <?php
        if (isset($_POST['possuiComputador'])) {
            if ($_POST['possuiComputador'] == 'nao') {
                echo 'checked';
            }
        }
        ?>><font style='position: relative; top: 4px; left: 5px;'>Não</font>
    </div>
</div>     
<?php if (isset($erro['possuiComputador'])) { ?>
<div class="erro" style='width: 80%; margin-left: auto; margin-right: auto;'>
    <strong>Erro!</strong> Você deve informar se possui computador.
</div>
<?php } ?>  
<div class="control-group" style='margin-bottom: 0px;'>
    <label class="control-label" for="inputAcessoInternet">Local de Acesso à Internet</label>
    <div class="controls" style='line-height: 20px'>                
        <select name='acessoInternet' id='inputAcessoInternet' onchange='$("#opt8").remove();'>
        <option id='opt8'>Selecione um...</option>
            <option value='casa' 
            <?php
            if (isset($_POST['acessoInternet'])) {
                if ($_POST['acessoInternet'] == 'casa') {
                    echo 'selected';
                }
            }
            ?>>Casa</option>
            <option value='escola' 
            <?php
            if (isset($_POST['acessoInternet'])) {
                if ($_POST['acessoInternet'] == 'escola') {
                    echo 'selected';
                }
            }
            ?>>Escola</option>
            <option value='trabalho' 
            <?php
            if (isset($_POST['acessoInternet'])) {
                if ($_POST['acessoInternet'] == 'trabalho') {
                    echo 'selected';
                }
            }
            ?>>Trabalho</option>
            <option value='outro' 
            <?php
            if (isset($_POST['acessoInternet'])) {
                if ($_POST['acessoInternet'] == 'outro') {
                    echo 'selected';
                }
            }
            ?>>Outro</option>
        </select>
    </div>
</div>     
<?php if (isset($erro['acessoInternet'])) { ?>
<div class="erro" style='width: 80%; margin-left: auto; margin-right: auto;'>
    <strong>Erro!</strong> Você deve informar o local de acesso à Internet.
</div>
<?php } ?>     
<div class="control-group" style='margin-bottom: 0px;'>
    <label class="control-label" for="inputTempoResidencia">Tempo de Residência no Município</label>
    <div class="controls" style='line-height: 50px'>                
        <select name='tempoResidencia' id='inputTempoResidencia' onchange='$("#opt7").remove();'>
        <option id='opt7'>Selecione um...</option>
            <option value='1' 
            <?php
            if (isset($_POST['tempoResidencia'])) {
                if ($_POST['tempoResidencia'] == '1') {
                    echo 'selected';
                }
            }
            ?>>Até 3 meses</option>
            <option value='2' 
            <?php
            if (isset($_POST['tempoResidencia'])) {
                if ($_POST['tempoResidencia'] == '2') {
                    echo 'selected';
                }
            }
            ?>>De 3 à 6 meses</option>
            <option value='3' 
            <?php
            if (isset($_POST['tempoResidencia'])) {
                if ($_POST['tempoResidencia'] == '3') {
                    echo 'selected';
                }
            }
            ?>>De 6 à 9 meses</option>
            <option value='4' 
            <?php
            if (isset($_POST['tempoResidencia'])) {
                if ($_POST['tempoResidencia'] == '4') {
                    echo 'selected';
                }
            }
            ?>>De 9 a 12 meses</option>
            <option value='5' 
            <?php
            if (isset($_POST['tempoResidencia'])) {
                if ($_POST['tempoResidencia'] == '5') {
                    echo 'selected';
                }
            }
            ?>>Mais de 12 meses</option>
        </select>
    </div>
</div>     
<?php if (isset($erro['tempoResidencia'])) { ?>
<div class="erro" style='width: 80%; margin-left: auto; margin-right: auto;'>
    <strong>Erro!</strong> Você deve informar o tempo de residência no município.
</div>
<?php } ?> 
<br>
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
