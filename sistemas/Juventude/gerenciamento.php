<?php

header('Location: http://www.pmf.sc.gov.br');  

$user = $_POST['user'];
$password = $_POST['password'];
if ($user == "fernando" && $password == "#d3g2bs15Z1%") {
  ?>
  <!doctype html>
  <html lang='pt-BR'>

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inscrições Jovem em Ação Floripa</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/gerenciamento.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

  </head>

  <body>



    <h1>Inscri&ccedil;&otilde;es Jovem em A&ccedil;&atilde;o Floripa</h1>
    <br>
    <div class="containerG">
      <table class="table table-striped">
        <th>ID</th>
        <th>Nome</th>
        <th>Data de Nascimento</th>
        <th>CPF</th>
        <th>G&ecirc;nero</th>
        <th style="width:130px">Escolaridade</th>
        <th style="width:130px">Email</th>
        <th style="width:130px">Telefone</th>
        <th style="width:130px">Celular</th>
        <th>Esperi&ecirc;ncia Profissional?</th>
        <th>Qual?</th>
        <th>CTPS?</th>
        <th>Curso</th>
        <?php
          include "backend/select.php";
          echo 'Número de inscrições: ' . $i;
          echo $tabela;
          ?>
      </table>

    </div>

    <script src="js/prefixfree.min.js"></script>
    <script src="js/jquery-2.1.4.min.js" type="text/javascript"></script>
    <script src="js/jquery.maskedinput.min.js" type="text/javascript"></script>
    <script type="text/javascript">

    </script>


  </body>

  </html>
<?php
} else {
  header('location:http://www.pmf.sc.gov.br/sistemas/Juventude/login.php');
}
?>