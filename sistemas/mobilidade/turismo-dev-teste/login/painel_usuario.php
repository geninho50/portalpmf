<?php
require_once('session_status.php');




//Não foi encontrado um usuario na tabela usuário com os mesmos dados digitado no formulário
//redireciona o usuario para a página de login






//echo "Usuario: ". $_SESSION['usuarioNome'];	
header('Content-type: text/html; charset=UTF-8');
setlocale(LC_ALL, 'pt_BR.UTF8');

?>
<!DOCTYPE HTML>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/bas/js/javascriptpersonalizado.js"></script>
    <script src="/bas/js/sorttable.js"></script>
    <script type="text/javascript" src="/bas/js/jquery.quick.search.js"></script>
    <script type="text/javascript" src="/bas/js/jquery.js"></script>
    <script type="text/javascript" src="/bas/js/jquery.maskedinput-1.1.4.pack.js"></script>
    <script type="text/javascript" src="/bas/js/jquery.mask.min.js"></script>
    <script type="text/javascript" src="/bas/js/jquery-ui.min.js"></script>
    <script src="/bas/js/formrules.js"></script>
    <script src="https://compressjs.herokuapp.com/compress.js"></script>
    <script>
        $(document).ready(function() {
            $("#smpu_topo").load("/bas/smpu_topo.php");
            $("#smpu_rodape").load("/bas/smpu_rodape.php");
        });
    </script>
</head>

<body>
    <!--CABECALHO -->
    <div class="container" theme-showcase" role="main">
        <!-- TOPO -->
        <div id="smpu_topo"></div>
        <!-- TOPO -->
        <div class="container" role="main">
            <br>
            <div class="row justify-content-md-center">
                <h2>
                    Bem vindo <?php echo    $_SESSION['usuarioNome'] ?><br>
                    Aguarde a autorização para acessar seus serviços
                </h2>
            </div>

            <br>

        </div>
        <!-- RODAPE-->
        <div id="smpu_rodape"></div><!-- RODAPE-->