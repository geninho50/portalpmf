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
// if(($_SESSION['usuario']['id'] != 1) || (!$_SESSION['permissoes']['geral']['perfil'])){
//    header('Location: opcoes.php');
// }

if (!isset($_GET['idEscola'])) {
    header('Location: manutencaoEscolas.php');
} else {
    include 'fnc/buscaEndereco.php';
    $endereco = buscaEndereco($_GET['idEscola']);
    if ($endereco != FALSE) {
        $end['cep'] = substr($endereco[1][11], 0, 2) . '.' . substr($endereco[1][11], 2, 3) . '-' . substr($endereco[1][11], 5, 3);
        $end['logradouro'] = $endereco[1][6];
        $end['complemento'] = $endereco[1][8];
        $end['numero'] = $endereco[1][7];
        $end['bairro'] = $endereco[1][3];

        include 'fnc/buscaEscola.php';
        $escola = buscaEscola($_GET['idEscola']);

        include 'fnc/buscaBairro.php';
		$bairro = buscaBairro($end['bairro']);
        $bairro = $bairro[$end['bairro']];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>SGE &middot; Editar Escola</title>
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
                    <h2 style='font-size:30px;'>Visualizar Escola</h1>
                    </div>
                    <hr>
                    <div class="row-fluid">
                        <div class="span12" style='padding: 20px; padding-top: 0px;'>
                            <h3>Informações Gerais</h3>
                            <h5>&middot; Nome: <?php echo ($escola[1][1]);?></h5>
                            <h5>&middot; Código INEP: <a href='<?php echo ($escola[1][4]); ?>'><?php echo ($escola[1][3]); ?></a></h5>
                            <h5>&middot; Tipo: <?php echo ($escola[1][6]);?></h5>
                            <h3>Localização</h3>
                            <h5>&middot; Logradouro: <?php echo $end['logradouro'].', '.$end['numero']; ?></h5>
                            <h5>&middot; Bairro: <?php echo ($bairro[1]); ?></h5>
                            <h5>&middot; CEP: <?php echo $end['cep']; ?></h5>
                            <hr>
                            <a class='btn pull-right' href='listaDeEscolas.php'>Voltar</a>
                        </div>
                    </div>   
                </div>
            </div> <!-- /container -->

        <!-- Le javascript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="js/jquery-1.9.1.js"></script>
        <script src="js/bootstrap.js"></script>    

    </body>
    </html>
