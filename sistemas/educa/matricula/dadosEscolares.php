<?php
session_name('ma');
session_start();

if (!$_SESSION['preenchido']['localizacao']) {
    header('Location: dadosLocalizacao.php');
}

if(isset($_SESSION['escola']['novaEscola']['vaga'])){
    header('Location: outrosDados.php');
}

if (count($_POST) > 0) {
    if (isset($_POST['ano'])) {
        if ($_POST['ano'] == '') {
            $erro['ano'] = true;
        }
    } else {
        $erro['ano'] = true;
    }


    if (isset($_POST['motivo'])) {
        if ($_POST['motivo'] == 'Selecione um...') {
            $erro['motivo'] = true;
        }
    }

    if (isset($_POST['dist'])) {
        if ($_POST['dist'] == 'Selecione um...') {
            $erro['dist'] = true;
        }
    }

    if (isset($_POST['escola'])) {
        if(isset($_POST['ano'])){
            if($_POST['ano'] < 10){
                if ($_POST['escola'] == '') {
                    $erro['escola'] = true;
                }
            }
        }
    } else {         
        if(isset($_POST['ano'])){
            if($_POST['ano'] < 10){
                $erro['escola'] = true;
            }
        }
    }

    if (isset($_POST['uf'])) {
        if(isset($_POST['ano'])){
            if($_POST['ano'] < 10){
                if ($_POST['uf'] == '') {
                    $erro['uf'] = true;
                }
            }
        }
    } else {         
        if(isset($_POST['ano'])){
            if($_POST['ano'] < 10){
                $erro['uf'] = true;
            }
        }
    }

    if (isset($_POST['municipio'])) {
        if(isset($_POST['ano'])){
            if($_POST['ano'] < 10){
                if ($_POST['municipio'] == '') {
                    $erro['municipio'] = true;
                }
            }
        }
    } else {         
        if(isset($_POST['ano'])){
            if($_POST['ano'] < 10){
                $erro['municipio'] = true;
            }
        }
    }

    if (isset($_POST['rede'])) {
        if(isset($_POST['ano'])){
            if($_POST['ano'] < 10){
                if ($_POST['rede'] == '') {
                    $erro['rede'] = true;
                }
            }
        }
    } else {         
        if(isset($_POST['ano'])){
            if($_POST['ano'] < 10){
                $erro['rede'] = true;
            }
        }
    }

    if (isset($_POST['escolaNova'])) {
        if ($_POST['escolaNova'] == '') {
            $erro['escolaNova'] = true;
        }
    } else {
        $erro['escolaNova'] = true;
    }

    if (isset($_POST['anoNova'])) {
        if ($_POST['anoNova'] == '') {
            $erro['anoNova'] = true;
        }
    } else {
        $erro['anoNova'] = true;
    }

    if (isset($_POST['possuiIrmaos'])) {
        if ($_POST['possuiIrmaos'] == '') {
            $erro['possuiIrmaos'] = true;
        }
    } else {
        $erro['possuiIrmaos'] = true;
    }

    if (isset($_POST['motivo'])) {
        if ($_POST['motivo'] == '') {
            $erro['motivo'] = true;
        }
    } else {
        $erro['motivo'] = true;
    }

    if (!isset($erro)) {
        if(isset($_POST['ano'])){
            $_SESSION['escola']['escolaAnterior']['ano'] = $_POST['ano'];
            if($_POST['ano'] != 10){
                $_SESSION['escola']['escolaAnterior']['nome'] = $_POST['escola'];
                $_SESSION['escola']['escolaAnterior']['uf'] = $_POST['uf'];
                $_SESSION['escola']['escolaAnterior']['municipio'] = $_POST['municipio'];
                $_SESSION['escola']['escolaAnterior']['rede'] = $_POST['rede'];
            }
        }
        $_SESSION['escola']['novaEscola']['ano'] = $_POST['anoNova'];
        $_SESSION['escola']['novaEscola']['id_escola'] = $_POST['escolaNova'];
        $_SESSION['escola']['novaEscola']['possui_irmaos'] = $_POST['possuiIrmaos'];
        $_SESSION['escola']['novaEscola']['motivo'] = $_POST['motivo'];
        $_SESSION['escola']['novaEscola']['distancia'] = $_POST['dist'];
        $_SESSION['preenchido']['escola'] = true;
        header("Location: confirmaInscricao.php");
    }
}

if (isset($_SESSION['escola']['escolaAnterior']['ano'])) {
    $_POST['ano'] = $_SESSION['escola']['escolaAnterior']['ano'];
}
if (isset($_SESSION['escola']['escolaAnterior']['nome'])) {
    $_POST['escola'] = $_SESSION['escola']['escolaAnterior']['nome'];
}
if (isset($_SESSION['escola']['escolaAnterior']['uf'])) {
    $_POST['uf'] = $_SESSION['escola']['escolaAnterior']['uf'];
}
if (isset($_SESSION['escola']['escolaAnterior']['municipio'])) {
    $_POST['municipio'] = $_SESSION['escola']['escolaAnterior']['municipio'];
}
if (isset($_SESSION['escola']['escolaAnterior']['rede'])) {
    $_POST['rede'] = $_SESSION['escola']['escolaAnterior']['rede'];
}
if (isset($_SESSION['escola']['novaEscola']['ano'])) {
    $_POST['anoNova'] = $_SESSION['escola']['novaEscola']['ano'];
}
if (isset($_SESSION['escola']['novaEscola']['id_escola'])) {
    $_POST['escolaNova'] = $_SESSION['escola']['novaEscola']['id_escola'];
}
if (isset($_SESSION['escola']['novaEscola']['possui_irmaos'])) {
    $_POST['possuiIrmaos'] = $_SESSION['escola']['novaEscola']['possui_irmaos'];
}
if (isset($_SESSION['escola']['novaEscola']['motivo'])) {
    $_POST['motivo'] = $_SESSION['escola']['novaEscola']['motivo'];
}
if (isset($_SESSION['escola']['novaEscola']['distancia'])) {
    $_POST['dist'] = $_SESSION['escola']['novaEscola']['distancia'];
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
                        <h3>Dados Escolares do Aluno</h3>
                        <img src="img/lapis.png" style="width: 470px; position:relative; top: -65px; left: -25px;">
                    </div>
                </div>
                <div class='row-fluid' style='text-align: center;'>
                    <?php include 'shared/barraLateral.php'; ?>

                    <div class="span8 folha">
                        <img src="img/canto.png" style="position: relative; left: -238px; top: -10px;">
                        <!-- TODO - Atenção: Diferenças entre Infantil e Básica -->
                        <!-- TODO - Atenção: Validação -->
                        <!-- TODO - Atenção: Confirmação -->
                        <form class="form-horizontal" method="post">
                            <h5>Dados da Escola Anterior</h5>
                            <div class="control-group" style='margin-bottom: 5px;'>
                                <label class="control-label" for="inputAno">Ano</label>
                                <div class="controls" style='line-height: 20px'>                
                                    <select name='ano' id='inputAno' required 
                                    onchange="if ($(this).val() == 10)
                                    {
                                    $('#inputEscola').attr('disabled', '');
                                    $('#inputUF').attr('disabled', '');
                                    $('#inputMunicipio').attr('disabled', '');
                                    $('#inputRede').attr('disabled', '');
                                    $('#inputEscola').css('display', 'none');
                                    $('#inputUF').css('display', 'none');
                                    $('#inputMunicipio').css('display', 'none');
                                    $('#inputRede').css('display', 'none');
                                    $('#labelEscola').css('display', 'none');
                                    $('#labelUF').css('display', 'none');
                                    $('#labelMunicipio').css('display', 'none');
                                    $('#labelRede').css('display', 'none');
                                } else {
                                $('#inputEscola').removeAttr('disabled');
                                $('#inputUF').removeAttr('disabled');
                                $('#inputMunicipio').removeAttr('disabled');
                                $('#inputRede').removeAttr('disabled');
                                $('#inputEscola').css('display', 'inherit');
                                $('#inputUF').css('display', 'inherit');
                                $('#inputMunicipio').css('display', 'inherit');
                                $('#inputRede').css('display', 'inherit');
                                $('#labelEscola').css('display', 'inherit');
                                $('#labelUF').css('display', 'inherit');
                                $('#labelMunicipio').css('display', 'inherit');
                                $('#labelRede').css('display', 'inherit');
                            }">
                            <?php
                            include 'fnc/listaDeAnosAnterior.php';
                            $anos = listaDeAnosAnteriores2($_SESSION['curso']);
                            foreach ($anos as $key => $value) {
                                echo '<option value=' . $key . '>' . ($value) . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <label class="control-label" for="inputEscola" id='labelEscola' <?php if(isset($_POST['ano'])) {if($_POST['ano'] == 10) { echo 'disabled style="display: none;"';}} ?>>Escola</label>
                <div class="controls">
                    <input <?php if(isset($_POST['ano'])) {if($_POST['ano'] == 10) { echo 'disabled style="display: none;"';}} ?> onkeypress="verificaMaiusculo('#inputEscola');" onkeyup="verificaMaiusculo('#inputEscola');" name='escola' type="text" value='<?php
                    if (isset($_POST['escola'])) {
                        echo $_POST['escola'];
                    }
                    ?>' id="inputEscola" placeholder="Nome da Escola" required>
                </div>
                <?php if (isset($erro['escola'])) { ?>
                <div class="erro">
                    <strong>Erro!</strong> Nome da escola vazia! Entre um nome para continuar.
                </div>
                <?php } ?>
                <label class="control-label" for="inputUF" id='labelUF'<?php if(isset($_POST['ano'])) {if($_POST['ano'] == 10) { echo 'disabled style="display: none;"';}} ?>>UF</label>
                <div class="controls">
                    <select <?php if(isset($_POST['ano'])) {if($_POST['ano'] == 10) { echo 'disabled style="display: none;"';}} ?> name='uf' required id="inputUF" onchange="buscaMunicipio($(this).val(), 'inputMunicipio');">
                        <option></option>
                        <?php
                        include 'fnc/listaDeEstados.php';
                        $estados = listaDeEstados();
                        foreach ($estados as $key => $value) {
                            if (isset($_POST['uf'])) {
                                if ($_POST['uf'] == $key) {
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
                <label class="control-label" for="inputMunicipio" id='labelMunicipio' <?php if(isset($_POST['ano'])) {if($_POST['ano'] == 10) { echo 'disabled style="display: none;"';}} ?>>Município</label>
                <div class="controls">
                    <select <?php if(isset($_POST['ano'])) {if($_POST['ano'] == 10) { echo 'disabled style="display: none;"';}} ?> name='municipio' id="inputMunicipio" <?php
                        if (!isset($_POST['uf'])) {
                            echo 'disabled';
                        }
                        ?> required>
                        <?php
                        include 'fnc/listaDeMunicipios.php';
                        if (isset($_POST['uf'])) {
                            $municipios = listaDeMunicipios($_POST['uf']);
                        }
                        echo '<option></option>';
                        foreach ($municipios as $key => $value) {
                            if (isset($_POST['municipio'])) {
                                if ($_POST['municipio'] == $key) {
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
                <label class="control-label" for="inputRede" id='labelRede' <?php if(isset($_POST['ano'])) {if($_POST['ano'] == 10) { echo 'disabled style="display: none;"';}} ?>>Rede da Escola</label>
                <div class="controls">
                    <select name='rede' id="inputRede" required <?php if(isset($_POST['ano'])) {if($_POST['ano'] == 10) { echo 'disabled style="display: none;"';}} ?>>
                        <?php
                        include 'fnc/listaDeRedes.php';
                        $redes = listaDeRedes();
                        foreach ($redes as $key => $value) {
                            if (isset($_POST['rede'])) {
                                if ($_POST['rede'] == $key) {
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
                <h5>Dados da Escola para 2014</h5>                           
                <label class="control-label" for="inputEscolaNova">Escola</label>
                <div class="controls">
                    <select name='escolaNova' id="inputEscolaNova" required 
                    onchange='buscaFases(<?php echo $_SESSION['curso']; ?>,
                    $(this).val(), <?php echo $_SESSION['id_periodo']; ?>,
                    <?php echo $_SESSION['periodo_ano']; ?>,
                    "inputAnoNova");'>
                    <option></option>
                    <?php
                    include 'fnc/listaDeEscolas.php';
                    $escolas = listaDeEscolas($_SESSION['curso'], $_SESSION['id_periodo'], $_SESSION['periodo_ano']);
                    foreach ($escolas as $key => $value) {
                        if(isset($_POST['escolaNova'])){
                            if ($key == $_POST['escolaNova']) {
                                echo '<option value=' . $value[0] . ' selected>' . ($value[1]) . '</option>';
                            } else {
                                echo '<option value=' . $value[0] . '>' . ($value[1]) . '</option>';
                            }
                        } else {
                            echo '<option value=' . $value[0] . '>' . ($value[1]) . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="control-group" style='margin-bottom: 5px;'>
                <label class="control-label" for="inputAnoNova">Ano</label>
                <div class="controls" style='line-height: 20px'>                
                    <select name='anoNova' id='inputAnoNova' required <?php
                    if (!isset($_POST['escolaNova'])) {
                        echo 'disabled';
                    } else {
                        if (!isset($_POST['anoNova'])) {
                            echo 'disabled';
                        }
                    }
                    ?>>
                    <?php
                    if (isset($_POST['escolaNova'])) {
                        if (isset($_POST['anoNova'])) {
                            include 'fnc/listaDeAnos.php';
                            $anos = listaDeAnos($_SESSION['curso'], $_POST['escolaNova'], $_SESSION['id_periodo'], $_SESSION['periodo_ano']);
                            foreach ($anos as $key => $value) {
                                if ($key = $_POST['anoNova']) {
                                    echo '<option value=' . $value[0] . ' selected>' . ($value[1]) . '</option>';
                                } else {
                                    echo '<option value=' . $value[0] . '>' . ($value[1]) . '</option>';
                                }
                            }
                        }
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="control-group highlight" style='margin-bottom: 0px;'>
            <label class="control-label" for="inputPossuiIrmaos">Possui irmãos e/ou irmãs<br> na escola selecionada?</label>
            <div class="controls" style='line-height: 40px;'>                
                <input required type="radio" name="possuiIrmaos" value="sim" 
                <?php
                if (isset($_POST['possuiIrmaos'])) {
                    if ($_POST['possuiIrmaos'] == 'sim') {
                        echo 'checked';
                    }
                }
                ?>><font style='position: relative; top: 4px; left: 5px;'>Sim</font> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                <input required type="radio" name="possuiIrmaos" value="nao"
                <?php
                if (isset($_POST['possuiIrmaos'])) {
                    if ($_POST['possuiIrmaos'] == 'nao') {
                        echo 'checked';
                    }
                }
                ?>><font style='position: relative; top: 4px; left: 5px;'>Não</font>
            </div>
        </div>

        <div class="control-group" style='margin-bottom: 5px;'>
            <label class="control-label" for="inputMotivo">Motivo da Escolha</label>
            <div class="controls" style='line-height: 20px'>                
                <select name='motivo' id='inputMotivo' required onchange='$("#opt5").remove();'>
                    <option id='opt5'>Selecione um...</option>
                    <?php
                    include 'fnc/listaDeMotivos.php';
                    $motivos = listaDeMotivos();
                    foreach ($motivos as $key => $value) {
                        echo '<option value=' . $value[0] . '>' . ($value[1]) . '</option>';
                    }
                    ?>
                </select>
            </div>
        </div>
        <?php if (isset($erro['motivo'])) { ?>
        <div class="erro">
            <strong>Erro!</strong> Você deve escolher uma opção.
        </div>
        <?php } ?>


        <div class="control-group" style='margin-bottom: 5px;'>
            <label class="control-label" for="inputDist">Distância da residência<bR> até a escola</label>
            <div class="controls" style='line-height: 40px'>                
                <select name='dist' id='inputDist' required onchange='$("#opt6").remove();'>
                    <option id='opt6'>Selecione um...</option>
                    <option>Até 0,5km</option>
                    <option>De 0,5km até 1,0km</option>
                    <option>De 1,0km até 1,5km</option>
                    <option>De 1,5km até 2,0km</option>
                    <option>De 2,0km até 2,5km</option>
                    <option>De 2,5km até 3,0km</option>
                    <option>Mais de 3,0km</option>
                </select>
            </div>
        </div>
        <?php if (isset($erro['dist'])) { ?>
        <div class="erro">
            <strong>Erro!</strong> Você deve escolher uma opção.
        </div>
        <?php } ?>
        <br>
        <a class='btn' href='dadosLocalizacao.php'>Voltar</a>
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
            function buscaFases(curso, escola, id_periodo, periodo_ano, id_elemento) {
                id_elemento = '#' + id_elemento.toString();
                if (curso != '' && escola != '' && id_periodo != '' && periodo_ano != '') {
                    $.get("ajax/fases.php", {curso: curso, escola: escola, id_periodo: id_periodo, periodo_ano: periodo_ano})
                    .done(function(data) {
                        $(id_elemento).html(data);
                        $(id_elemento).removeAttr('disabled');
                    });
                } else {
                    $(id_elemento).html("");
                    $(id_elemento).attr('disabled', '');
                }
            }

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
