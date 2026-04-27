<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="SMPU Login">
    <meta name="author" content="Michel Mittmann">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/bas/js/javascriptpersonalizado.js"></script>
    <script type="text/javascript" src="/bas/js/javascript_frota.js"></script>
    <script src="/bas/js/sorttable.js"></script>
    <script type="text/javascript" src="<?php dirname(__FILE__).'/bas/js/jquery.quick.search.js';?>"></script>
    <script type="text/javascript" src="<?php dirname(__FILE__).'/cidadao/moradores_costa/js/jquery.js';?>">
    </script>
    <script type="text/javascript" src="/bas/js/jquery.maskedinput-1.1.4.pack.js"></script>
    <script src="/bas/js/formrules.js"></script>
    <script src="/bas/js/cep.js"></script> <!-- análise de CEP !-->
    <script src="/bas/js/masks.js"></script> <!-- máscaras para input formularios !-->
    <script type="text/javascript" src="/bas/js/jquery.mask.min.js"></script>
    <script type="text/javascript" src="/bas/js/jquery-ui.min.js"></script>
    <script src="https://compressjs.herokuapp.com/compress.js"></script>
    <script>
    $(document).ready(function() {
        $("#smpu_topo").load("/bas/smpu_topo.php");
        $("#smpu_rodape").load("/bas/smpu_rodape.php");
    });
    </script>









    <title>SMPU - Login</title>

    <!-- Bootstrap core CSS -->

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

    <div class="container border rounded border-primary" role="main">

        <!-- TOPO -->
        <div id="smpu_topo"></div>
        <!-- TOPO -->

        <form class="form-signin" method="POST" action="session_valida.php">
            <h2 class="form-signin-heading">Área Restrita</h2>
            <label for="inputEmail" class="sr-only">Email</label>
            <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email" required
                autofocus>
            <label for="inputPassword" class="sr-only">Senha</label>
            <input type="password" name="senha" id="inputPassword" class="form-control" placeholder="Senha" required>
            <button class="btn btn-lg btn-danger btn-block" type="submit">Acessar</button>



            <button type="button" class="btn btn-lg  btn-success btn-block" data-toggle="modal" onClick="limpa()"
                data-target="#MODALuser_cadastrar">
                Cadastrar Usuário
            </button>
        </form>
        <p class="text-center text-danger">
            <?php if (isset($_SESSION['loginErro'])) {
        echo $_SESSION['loginErro'];
        unset($_SESSION['loginErro']);
      } ?>
        </p>
        <p class="text-center text-success">
            <?php
      if (isset($_SESSION['logindeslogado'])) {
        echo $_SESSION['logindeslogado'];
        unset($_SESSION['logindeslogado']);
      }
      ?>
        </p>





        <!-- MODAL CADASTRAR --><?php include_once("../user/user_formulario.php"); ?>



    </div> <!-- /container -->

    <script src="/user/user_formulario.js"></script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
</body>

</html>