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

if (count($_POST) > 0) {
    if (isset($_POST['senha'])) {
        if (isset($_POST['senhaRepetida'])) {
            if (isset($_POST['email'])) {
                include 'fnc/trocarSenha.php';
                if ($_POST['senha'] == $_POST['senhaRepetida']) {
                    $sucesso = trocarSenha($_SESSION['usuario']['id'], $_POST['senha']);
                    if($sucesso){
                        include 'fnc/inserirEmail.php';
                        inserirEmail($_SESSION['usuario']['id'], $_POST['email']);
                        var_dump($sucesso);
                        header("Location: opcoes.php");
                    }
                } else {
                    $erro['igual'] = true;
                }
            } else {
                $erro['email'] = true;
            }
        } else {
            $erro['senhaR'] = true;
        }
    } else {
        $erro['senha'] = true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>SGE &middot; Trocar Senha</title>
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
                <div class="row-fluid">
                    <div class="span12" style="padding-left: 5px; padding-right: 5px; margin-top: 5px; text-align: center;">

                        <h4>Por favor, troque sua senha e informe seu e-mail</h4>

                        <form method='post'>
                            <label>Digite a nova senha:
                                <input type="password" name="senha" required/>
                            </label>
                            <?php if (isset($erro['senha'])) { ?>
                                <div class="erro">
                                    <strong>Erro!</strong> O campo senha deve ser preenchido!
                                </div>
                            <?php } ?>
                            <label>Repita a nova senha:
                                <input type="password" name="senhaRepetida" required/>
                            </label>
                            <?php if (isset($erro['senhaR'])) { ?>
                                <div class="erro">
                                    <strong>Erro!</strong> O campo da repetição senha deve ser preenchido!
                                </div>
                            <?php } ?>
                            <label>Insira seu e-mail:
                                <input type="email" name="email" required/>
                            </label>
                            <button class='btn btn-primary'>Continuar</button>
                        </form>


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
