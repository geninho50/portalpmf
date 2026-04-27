<!doctype html>
<html lang='pt-BR'>
	<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Código de Obras e Edificações</title>
    <link type="image/x-icon" rel="shortcut icon" href="img/brasao.gif">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
    <script src="js/jquery-2.1.4.min.js" type="text/javascript"></script>
    <link href='https://fonts.googleapis.com/css?family=Cabin+Condensed:700' rel='stylesheet' type='text/css'>
    <link href="css/tabela.css" rel="stylesheet">
  </head>
  	
  <body>

    <img class='logo center-block' src="img/Logo PMF-01.png" />


    <h1>Revisão do Código de Obras e Edificações</h1>
    <div class="container">
      <table class="table table-striped table-bordered table-hover">
        <th>ID</th>
        <th>Nome</th>
        <th>E-Mail</th>
        <th>Ocupação</th>
        <th>Tema</th>
        <th>Sugestão</th>


        <?php
          include "selectResultados.php";
          echo $tabela;
        ?>
      </table>

    </div>

   
    <script src="js/prefixfree.min.js"></script>
    <script src="js/jquery-2.1.4.min.js" type="text/javascript"></script>
    <script src="js/jquery.maskedinput.min.js" type="text/javascript"></script>

  </body>
</html>