<!doctype html>
<html lang='pt-BR'>
	<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mini Curso</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/main.css" />
  </head>
  	
  <body>

    <h1 align="center">Incri&ccedil;&otilde;es Mini Curso de Fotografia</h1>
      <table class="table table-striped">
        <th>ID</th>
        <th>Nome</th>
        <th>Idade</th>
        <th>Responsavel</th>
        <th>CPF</th>
        <th>Telefone</th>
        <th>Email</th>
        <th>CEP</th>
        <th>Endere&ccedil;o</th>
        <th>N&uacute;mero</th>
        <th>Bairro</th>
        <th>Municipio</th>
        <!--<th>Profissão</th>-->
        <!--<th>Local de Trabalho</th>
        <th>Banco</th>
        <th>Nº Banco</th>
        <th>Agencia</th>
        <th>Nº Conta</th>
        <th>Editar</th>
        <th>Excluir</th>-->

        <?
          include "backend/select.php";
          echo $tabela;
        ?>
      </table>


    <script src="js/prefixfree.min.js"></script>
    <script src="js/jquery-2.1.4.min.js" type="text/javascript"></script>
    <script src="js/jquery.maskedinput.min.js" type="text/javascript"></script>
  </body>
</html>