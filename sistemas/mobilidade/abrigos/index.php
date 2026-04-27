
<!DOCTYPE HTML>
<html lang="pt-br">

<head>
    <title>Abrigos</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

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
        <h1>Abrigos</h1>
        <div class="container" role="main">
            <br>

            <a class="btn btn-primary" href="./novosabrigos/index.php" role="button">Novos</a><br>
            <hr>
            <a class="btn btn-primary" href="./reformas/index.php" role="button">Reformas</a><br><br>

        </div>

        <hr>

    </div>
    </div>
    <div id="smpu_rodape"></div>

    <!-- <?php
    // include($_SERVER['DOCUMENT_ROOT'] . '/bas/smpu_rodape.php');
    ?> -->

</body>

</html>