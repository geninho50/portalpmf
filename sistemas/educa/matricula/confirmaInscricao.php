<?php
session_name('ma');
session_start();

if(!isset($_SESSION['identificacao'])){
    header("Location: dadosEscolares.php");
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" CONTENT="NO-CACHE">
        <title>SGE &middot; Verificação de Dados</title>
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
                        <h3>Verificação de Dados</h3>
                        <img src="img/lapis.png" style="width: 470px; position:relative; top: -65px; left: -25px;">
                    </div>
                </div>
                <div class='row-fluid' style='text-align: center;'>
                    <?php include 'shared/barraLateral.php'; ?>

                    <div class="span8 folha">
                        <img src="img/canto.png" style="position: relative; left: -238px; top: -10px;">
                        <form class="form-horizontal" method="post" action='verificaInscricao.php'>
                            <h4>Dados do Aluno</h4>
                            <p>As informações preenchidas serão utilizadas para 
                                a realização da sua inscrição. Verifique se os
                                dados preenchidos estão corretos  <br>e clique em 
                                <strong>Confirmar</strong> ou <strong>Voltar</strong>.
                            </p>
                            <p><strong>Nome:</strong> 
                                <?php echo $_SESSION['identificacao']['nome_aluno']; ?></p>
                            <p><strong>Data de Nascimento:</strong> 
                                <?php echo $_SESSION['identificacao']['data_nascimento']; ?></p>
                            <p><strong>Escola:</strong> 
                                <?php
                                include 'fnc/buscaEscola.php';
                                echo (buscaEscola($_SESSION['escola']['novaEscola']['id_escola'])[$_SESSION['escola']['novaEscola']['id_escola']][1]);
                                ?></p>
                            <p><strong>Ano Escolar:</strong> 
                                <?php
                                include 'fnc/buscaAno.php';
                                echo (buscaAno($_SESSION['escola']['novaEscola']['ano'], $_SESSION['curso'], $_SESSION['escola']['novaEscola']['id_escola'], $_SESSION['id_periodo'], $_SESSION['periodo_ano'])[1]);
                                ?></p>
                            <p><strong>Possui irmãos e/ou irmãs na unidade:</strong> 
                                <?php
                                if ($_SESSION['escola']['novaEscola']['possui_irmaos'] == 'nao') {
                                    echo 'Não';
                                } else {
                                    echo 'Sim';
                                }
                                ?></p>
                            <p><strong>Motivo:</strong> 
                                <?php 
                                include 'fnc/buscaMotivo.php';
                                echo buscaMotivo($_SESSION['escola']['novaEscola']['motivo'])[1]; ?></p>
                            <p><strong>Distância da residência até a escola:</strong> 
                                <?php 
                                echo ($_SESSION['escola']['novaEscola']['distancia']); ?></p>

                            <br>
                            <a href='dadosEscolares.php' class='btn'>Voltar</a>
                            <button class='btn btn-primary'>Confirmar</button>
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
