<?php
session_name('ma');
session_start();
session_destroy();

session_name('re_eja');
session_start();
session_destroy();
session_name('re_eja');
session_start();

if (isset($_POST['usuario'])) {
    if (isset($_POST['senha'])) {
        include 'fnc/validaLogin.php';
        $resultado = validaLogin($_POST['usuario'], $_POST['senha']);
        if ($resultado != FALSE) {
            $_SESSION['id'] = $resultado[0][0];
            $_SESSION['usuario'] = $resultado[0][1];
            $_SESSION['perfil'] = $resultado[0][3];
            if ($_SESSION['perfil'] == 2) {
                $_SESSION['autenticado_rematricula_eja'] = true;
                header('Location: opcoesEJA.php');
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" CONTENT="NO-CACHE">
    <title>SGE &middot; Login</title>
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
                        <h3>Login &middot; Rematrícula &middot; EJA</h3>
                        <img src="img/lapis.png" style="
                        width: 470px; position:relative; top: -65px; left: -25px;">
                    </div>
                </div>
                <div class='row-fluid' style='text-align: center;'>
                    <form method='post'>
                        <label>
                            <strong>Número de Matrícula</strong><br>
                            <input name="usuario" type='text' maxlength="13" required style='width: 150px; text-align: center;'>
                        </label>
                        <label>
                            <strong>Data de Nascimento (Somente Números. Ex.: 01012001)</strong><br>
                            <input name="senha" type='text' maxlength="10" required style='width: 150px; text-align: center;'>
                        </label>
                        <button class='btn btn-primary'>Entrar &raquo;</button>
                        <?php if (isset($resultado)) {
                            if($resultado == false){ ?>
                            <div class="erro" style='margin-top: 5px;'>
                                <strong>Erro!</strong> Senha e/ou usuários incorrretos.
                            </div>
                            <?php }} ?>
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
