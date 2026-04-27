<?php
require_once('session_status.php');
if ($_SESSION['usuarioNivelacesso'] != "9") {
    header("Location: painel_usuario.php");
}

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
        <hr>
            <h3>    Cadastro de Usuários da Rede de Mobilidade SMPU/IPUF<br></h3>
            <br>
          
            <a class="btn btn-primary" href="/user/user.php" role="button">Cadastro de Usuários do Sistema</a><br>


            <hr>
            <h3>  Viagens Lacustre</h3>
            <br>

            <a class="btn btn-primary" href="/lacustre/" role="button">Cadastro de Viagens Costa da Lagoa</a><br><br>
            <a class="btn btn-primary" href="/lacustre/lacustre_adm-2.php" role="button">Tabela Geral de viagens</a><br>


            <hr>
            <h3>Costa da Lagoa - Usuários</h3>
            <br>


            Cadastro de Moradores da Costa da Lagoa<br>
            <a class="btn btn-primary" href="/cidadao/moradores_costa/morador_costa.php" role="button">Cadastro de
                Moradores Costa da Lagoa</a><br>
            <hr>

            Cadastro de Usuários - Subsídios<br>
            <a class="btn btn-primary" href="/cidadao/usuarios_subsidio/listar.php" role="button">Cadastro de Usuários
                Subsídio</a><br>
            <hr>

            Pesquisa de usuários cadastrados SIT<br>
            <a class="btn btn-primary" href="/pesquisa1" role="button">Pesquisa Usuários SIT</a><br>

            <hr>
            <h3>Cadastro de Motofrete - Profissionais</h3>
            <br>


            Cadastro de Motofrete - Profissionais<br>
            <a class="btn btn-primary" href="/sim/motofrete/profissionais/mtp.php" role="button">Cadastro de Profissionais</a><br>
            <hr>

            Cadastro de Motofrete - Empresas<br>
            <a class="btn btn-primary" href="/sim/motofrete/empresas/mte.php" role="button">Cadastro de Empresa</a><br>
            <hr>

            Cadastro de Motofrete - Veículos (Motos)<br>
            <a class="btn btn-primary" href="/sim/motofrete/veiculos/mtv.php"" role="button">Cadastro de Veículos</a><br>

        </div>

        <hr>


    <!-- RODAPE-->
    <div id="smpu_rodape"></div><!-- RODAPE-->       </div>
 </div>

</body>
</html>
