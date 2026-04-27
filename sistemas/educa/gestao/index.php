<?php

header('location: http://sgeweb.pmf.sc.gov.br/gestao');

die;

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
    if ($_SESSION['aut_gm'] == true) {
        header('Location: opcoes.php');
    }
}

if (count($_POST)) {
    if (isset($_POST['usuario'])) {
        if (isset($_POST['senha'])) {
            include 'fnc/verificaLogin.php';
            $login = verificaLogin($_POST['usuario'], $_POST['senha']);
            if (count($login) > 1) {
                if ($login[2] != 2) {
                    $_SESSION['aut_gm'] = true;
                    $_SESSION['usuario']['nome_usuario'] = $login[1];
                    $_SESSION['usuario']['id'] = $login[0];
                    $_SESSION['usuario']['perfil'] = $login[2];
                    $_SESSION['usuario']['id_escola'] = $login[3];
                    include 'fnc/buscaPermissoes.php';
                    if ($_SESSION['usuario']['perfil'] == 3 ||
                        $_SESSION['usuario']['perfil'] == 4 ||
                            $_SESSION['usuario']['perfil'] == 5 ||
                            $_SESSION['usuario']['perfil'] == 6 ||
                            $_SESSION['usuario']['perfil'] == 7 ||
                            $_SESSION['usuario']['perfil'] == 8 ||
                            $_SESSION['usuario']['perfil'] == 9 ||
                            $_SESSION['usuario']['perfil'] == 10 ||
                            $_SESSION['usuario']['perfil'] == 11) {
                        include 'fnc/verificaPrimeiroAcesso.php';
                        $primeiroAcesso = verificaPrimeiroAcessoDiretor($_SESSION['usuario']['nome_usuario']);
                        $_SESSION['usuario']['permissoes'] = buscaPermissoes($login[2]);
                        if ($primeiroAcesso) {
                            header("Location: trocarSenha.php");
                        } else {
                            header('Location: opcoes.php'); 
                        }
                    } else {
                        $_SESSION['usuario']['permissoes'] = buscaPermissoes($login[2]);
                        header('Location: opcoes.php');
                    }
                } else {
                    $erro = true;
                }
            } else {
                $erro = true;
            }
        } else {
            $erro = true;
        }
    } else {
        $erro = true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>SGE &middot; Página Inicial</title>
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
                <div class='row-fluid' style='text-align: center; padding-top: 20px; padding-bottom: 20px;'>
                    <h1 style='font-size:30px;'>Gestão Matrícula</h1>
                </div>
                <div class="row-fluid">
                    <div class="span4">

                    </div>
                    <div class="span4 well">
                        <form style='text-align: center;' method="post">
                            <label><strong style='font-size: 18px;'>Usuário</strong>
                                <input type="text" name="usuario">
                            </label>
                            <label><strong style='font-size: 18px;'>Senha</strong>
                                <input type="password" name="senha">
                            </label>
                            <!-- <a class='btn'>Esqueceu a senha?</a> -->
                            <button class='btn btn-primary'>Entrar</button>
                        </form>                        
                        <?php if (isset($erro)) { ?>
                            <div class="erro" style='width: 85%; margin-left: auto; margin-right: auto;'>
                                <strong>Erro!</strong> Usuário e/ou senha incorretos.
                            </div>
                        <?php } ?> 
                    </div>
                    <div class="span4">

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
