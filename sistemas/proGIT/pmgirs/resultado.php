<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Resultados</title>
    <link type="image/x-icon" rel="shortcut icon" href="img/brasao.gif">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/estilos.css" rel="stylesheet">
    <script src="js/jquery-2.1.4.min.js" type="text/javascript"></script>
    <link href='https://fonts.googleapis.com/css?family=Cabin+Condensed:700' rel='stylesheet' type='text/css'>
</head>

<body>
	<div>
        <div class="jumbotron">
            <img class ='logo' src="img/logo.png" />
        </div>

        <h2>Resultado da pesquisa PMGIRS</h2>
        <div class="table table-striped">
            <table class="table table-striped table-bordered table-hover">
                <th>Sugestão</th>
                <th>Justificativa</th>
                <th>Metodologia</th>
                <th>Representante</th>
                <th>Documento</th>
                <th>Email</th>
                <?php
                  include "select.php";
                  echo $tabela;
                ?>
            </table>
        </div>

 
        <div class="row">
              <div class="col-md-6 pull-left">
        <a href="index.php" type="button" name="submit" id="voltar" class="btn btn-primary botao "><b>Voltar</b></a>
            </div>
        </div>

    </div>

</body>
</html>