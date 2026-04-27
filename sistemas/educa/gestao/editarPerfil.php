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

//if(($_SESSION['usuario']['id'] != 1) || (!$_SESSION['permissoes']['gera']['perfil'])){
//    header('Location: opcoes.php');
//}


if (!isset($_GET['idPerfil'])) {
    header('Location: manutencaoPerfil.php');
}

include 'fnc/buscaPapeis.php';
$papeis = buscaPapeis();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>SGE &middot; Editar Perfil</title>
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
            <div class='conteudo' style='min-height: 500px;'>
                <div class='row-fluid' style='text-align: center; padding-top: 20px;'>
                    <h2 style='font-size:30px;'>Editar Perfil</h1>
                </div>
                <hr>
                <div class="row-fluid">
                    <div class="span2 bs-docs-sidebar" style='padding-left: 10px; padding-right: 10px;'>
                        <ul class="nav nav-list bs-docs-sidenav">
                            <li><a><i class="icon-chevron-right"></i> Papéis</a></li>
                            <li style='text-align: right;'><a href="manutencaoPerfil.php"></i> Voltar</a></li>
                        </ul>
                    </div>
                    <div class="span10" style='padding: 20px; padding-top: 0px;'>


                        <div id='papeis' style='display: inherit;'>
                            <h4>Papéis</h4>
                            <form>
                                <input name='idPerfil' type='hidden' value='<?php echo $_GET['idPerfil']; ?>'/>
                                <table class='table'>
                                    <thead>
                                        <tr>
                                            <td>Nome</td>
                                            <td style='width: 50px;'></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $aspa = "'";
                                        foreach ($papeis as $key => $value) {
                                            echo '<tr>';
                                            echo '<td>';
                                            echo $value[1];
                                            echo '</td>';
                                            echo '<td>';
                                            echo '<div class="btn-group" data-toggle="buttons-radio">
                                                    <button title="Habilitar" type="button" class="btn btn-primary"><i class="iconic-check"></i></button>
                                                    <button title="Desabilitar" type="button" class="btn btn-primary"><i class="iconic-x"></i></button>
                                                  </div>';
                                            echo '</td>';
                                            echo '</tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>

                                <button class='btn btn-primary'>Salvar</button>
                            </form>
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
        </script>

    </body>
</html>
