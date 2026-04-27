<!doctype html>
<html lang='pt-BR'>
	<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Consulta Pública</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/gerenciamento.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    
  </head>
  	
  <body>



    <h1>Consulta Pública</h1>
    <br>
    <div class="containerG">
      <table class="table table-striped">
        <th>ID</th>
        <th>Nome</th>
        <th>Localidade</th>
        <th>Telefone</th>
        <th>Email</th>
        <th>Proposta</th>
        <th style="width:300px">Justificativa</th>
        <th style="width:300px">Metodologia</th>
        <th style="width:200px">Entidade</th>

        <?
          include "backend/select.php";
          echo 'Número de Propostas: ' .$i;
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


