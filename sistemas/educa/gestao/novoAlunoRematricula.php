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

if($_SESSION['usuario']['permissoes'][12][1] != 1){
    header('Location: index.php');
}

if (isset($_GET['dataNascimento'])) {
    if ($_GET['dataNascimento'] == '') {
        $erro['nasc_vazio'] = true;
    } else {
        if ($_GET['dataNascimento'] == '__/__/____') {
            $erro['nasc_vazio'] = true;
        } else {
            include 'fnc/verificaDataPassado.php';
            if (!verificaDataPassado($_GET['dataNascimento'])) {
                $erro['nasc_invalido'] = true;
            } else {
                if (isset($_GET['matricula'])) {
                    if (isset($_GET['ano'])) {
                        if (isset($_GET['fase'])) {
                            if (isset($_GET['nome'])) {
                                if (isset($_GET['escola'])) {
                                    include 'fnc/insereNovoAlunoRematricula.php';
                                    $novoAluno = insereNovoAlunoRematricula($_GET['dataNascimento'], $_GET['matricula'], $_GET['ano'], $_GET['fase'], $_GET['escola'], $_GET['nome']);
                                    if($novoAluno == true){
                                        include_once 'fnc/removerVaga.php';
                                        removerVaga(1, 2014, $_GET['fase'], $_GET['escola']);
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}



include 'fnc/buscaEscolas.php';
$escolas = buscaEscolasFundamental();

include 'fnc/buscaPeriodos.php';
$anos = buscaPeriodos();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>SGE &middot; Novo Aluno para Rematrícula</title>
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
            <?php include 'shared/barraTopo.php'; ?>
            <div class='conteudo' style='min-height: 500px;'>
                <div class='row-fluid' style='text-align: center; padding-top: 20px;'>
                    <h2 style='font-size:30px;'>Novo Aluno para Rematrícula</h2>
                </div>
                <hr>
                <div class="row-fluid">
                    <div class="span12" style='padding: 20px; padding-top: 0px;'>
                        <div>
                            <div class="tab-pane" id="tabEndereco">
                                <div style='display: inherit;'>
                                    <?php
                                    if (isset($novoAluno)) {
                                        if ($novoAluno == true) {
                                            ?>
                                            <div class='sucesso'>
                                                <strong>Sucesso!</strong> Rematrícula adicionada com sucesso. 
                                            </div>
                                            <?php
                                        } else {
                                            ?>
                                            <div class='erro'>
                                                <strong>Erro!</strong> Um erro ocorreu, tente novamente.
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>

                                    <form>
                                        <label style='display: inline;'> Escola:
                                            <select id='inputEscola' name='escola' style='margin-bottom: 0px;' required 
                                                    onchange="if ($(this).val() != '') {
                                                                $('#opt1').remove();
                                                                $('#inputAno').removeAttr('disabled');
                                                                $('#opt2').attr('selected', '');
                                                                $('#inputFase').attr('disabled', '');
                                                            }">
                                                <option id='opt1'></option>
                                                <?php
                                                foreach ($escolas as $key => $value) {
                                                    echo '<option value="' . $value[0] . '">' . ($value[1]) . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </label>
                                        <label style='display: inline;'> Ano:
                                            <select id='inputAno' disabled name='ano' style='margin-bottom: 0px; width: 150px;' required
                                                    onchange='$.get("ajax/fasesCAE.php", {curso: 1, ano: $(this).val(), escola: $("#inputEscola").val()})
                                                                    .done(function(data) {
                                                                $("#inputFases").html(data);
                                                                $("#inputFases").removeAttr("disabled");
                                                            });'>
                                                <option id='opt2'></option>
                                                <?php
                                                foreach ($anos as $key => $value) {
                                                    echo '<option>' . $value[0] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </label>
                                        <label style='display: inline;'> Etapa:
                                            <select id='inputFases' disabled name='fase' style='margin-bottom: 0px;' required>
                                                <?php
                                                foreach ($fases as $key => $value) {
                                                    echo '<option>' . ($value[1]) . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </label>
                                        <h5 id='semFase' style='display: none;'>Escola não possui fases no ano escolhido.</h5>
                                        <br><br>
                                        <label> Número de Matrícula: 
                                            <input type="number" name="matricula" min="0" max="99999999999" required>
                                        </label>
                                        <label> Data de Aniversário: 
                                            <input name='dataNascimento' type="text" class='datepicker' id="inputDataNasc" placeholder="dd/mm/aaaa" data-mask='99/99/9999' onselect="setCaretPosition($(this), 0);" required>
                                        </label>
                                        <label> Nome: 
                                            <input name='nome' maxlength="100" type="text" id="nome" onkeyup="verificaCaracteres('#nome');" onkeypress="verificaCaracteres('#nome');" required>
                                        </label>
                                        <button class='btn btn-primary pull-right'>Adicionar Novo Aluno para Rematrícula</button>
                                        <a class="btn pull-right" style="margin-right: 5px;" href="opcoes.php">Voltar</a>
                                    </form>

                                </div>
                            </div>


                        </div>
                    </div>
                </div>   
            </div>
        </div> <!-- /container -->

        <!-- Le javascript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="js/jquery-1.9.1.js"></script>
        <script src="js/bootstrap.js"></script>     
        <script>
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

    </body>
</html>
