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

if(!isset($_SESSION['novo_aluno_infantil']['inserido'])){
    header("Location: dadosEscolaresInfantil.php");
}

include 'fnc/buscaEscola.php';
include 'fnc/buscaInscricao.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" CONTENT="NO-CACHE">
        <title>SGE &middot; Confirmação</title>
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
                        <h3>Confirmação</h3>
                        <img src="img/lapis.png" style="width: 470px; position:relative; top: -65px; left: -25px;">
                    </div>
                </div>
                <div class='row-fluid' style='text-align: center;'>
                    <?php include 'shared/barraLateral.php'; ?>

                    <div class="span8 folha">
                        <img src="img/canto.png" style="position: relative; left: -285px; top: -10px;">
                        <!-- TODO - Atenção: Diferenças entre Infantil e Básica -->
                        <!-- TODO - Atenção: Validação -->
                        <!-- TODO - Atenção: Confirmação -->
                        <form class="form-horizontal" method="post">
                            <h4>Novo aluno cadastrado com sucesso.</h4>
                            <h5>Nome: <?php echo $_SESSION['novo_aluno_infantil']['dados_pessoais']['nome']; ?></h3>
                            	<?php $busbaInscricao =  buscaInscricao($_SESSION['novo_aluno_infantil']['dados_pessoais']['id']);?>
                            <h5>Número de matrícula: <?php echo $busbaInscricao[0]; ?></h3>

                            <?php
                                if((isset($_SESSION['novo_aluno_infantil']['escola']['primeira_opcao']))){

                                    $priOpcao = buscaEscola($_SESSION['novo_aluno_infantil']['escola']['primeira_opcao']);
                                    ?>
                                    <h5>Primeira Opção: <?php echo ($priOpcao[1][1]); ?></h3>
                                    <?php
                                }
                                if((isset($_SESSION['novo_aluno_infantil']['escola']['segunda_opcao']))){

                                    $segOpcao = buscaEscola($_SESSION['novo_aluno_infantil']['escola']['segunda_opcao']);
                                    ?>
                                    <h5>Segunda Opção: <?php echo ($segOpcao[1][1]); ?></h3>
                                    <?php
                                }
                            ?>

                            <a class='btn-info btn' href="relatorios/emitirFormListaIntencaoPreenchido.php"><i class='icon-print icon-white'></i> Emitir comprovante</a>                           
                            <br>                            
                            <br>
                            <a class='btn btn-primary' href="opcoes.php">Finalizar</a>
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
            $('#bl7').addClass('itemOliva');
            $('#bl7').addClass('ativo');
            $('#bl7').removeClass('item');
            $('#bl8').addClass('itemT');
            $('#bl8').addClass('ativo');
            $('#bl8').removeClass('item');
            $('#bl9').addClass('itemVerde-azulado');
            $('#bl9').addClass('ativo');
            $('#bl9').removeClass('item');
        </script>

    </body>
</html>
