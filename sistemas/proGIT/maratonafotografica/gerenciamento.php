
<?php 
$user = $_POST['user'];
$password = $_POST['password'];
  if($user=="sandra" && $password=="#p6B3*c2#Z%") {
  ?>
  <html lang='pt-BR'>
  	<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Maratona Fotográfica</title>
      <link rel="stylesheet" href="css/normalize.css">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
      <link rel="stylesheet" href="css/gerenciamento.css">
    </head>
    	
    <body>
      <h1>Incrições Maratona Fotográficas</h1>
      <div class="container">
        <table class="table table-striped">
          <th>ID</th>
          <th>Nome</th>
          <th>E-Mail</th>
          <th>Nascimento</th>
          <th>Modalidade</th>
          <th>Equipamento</th>
          <th>Endereço</th>
          <th>Bairro</th>
          <th>Cidade</th>
          <th>Editar</th>

          <?php
            include "backend/selectFilmeEdigital.php";
            echo $tabela;
          ?>
        </table>
      </div>

      <h1>Incrições Infantojuvenil</h1>
      <div class="container">
          <table class="table table-striped">
            <th>ID</th>
            <th>Nome</th>
            <th>E-Mail</th>
            <th>Nascimento</th>
            <th>Faixa Etária</th>
            <th>Equipamento</th>
            <th>Responsável</th>
            <th>Parentesco</th>
            <th>Bairro</th>
            <th>Cidade</th>
            <th>Endereço</th>
            <th>Editar</th>

            <?php
              include "backend/selectInfantoJuvenil.php";
              echo $tabela;
            ?>
          </table>
        </div>
      </div>

      <script src="js/prefixfree.min.js"></script>
      <script src="js/jquery-2.1.4.min.js" type="text/javascript"></script>
      <script src="js/jquery.maskedinput.min.js" type="text/javascript"></script>
      <script type="text/javascript">
        function editar(id){
		  location.href = "filmeEdigital-adm.php?id=" + id;
          // location.href = "filmeEdigital.php?id=" + id;
        }

        function editar2(id){
          location.href = "infantoJuvenil-adm.php?id=" + id;
        }

        function excluir(id){
          var confirmacao = confirm('Você deseja excluir?');
          if(confirmacao){
            var err = '';
            var obj = {
              id : id
            };

            $.post( "backend/deleteFilmeEdigital.php", obj).done(function( data ) {
                var retorno = jQuery.parseJSON(data);
                if(retorno.successo == 0){
                    $('#error').text(retorno.error).removeClass('hide');
                }else{
                    location.href = '';
                }
            });
          }
        }

        function excluir2(id){
          var confirmacao = confirm('Você deseja excluir?');
          if(confirmacao){
            var err = '';
            var obj = {
              id : id
            };

            $.post( "backend/deleteInfantoJuvenil.php", obj).done(function( data ) {  
                var retorno = jQuery.parseJSON(data);
                if(retorno.success != 1){
                  $('#error').text(retorno.error).removeClass('hide');
                } else{
                  location.href = '';
                } 
            });
          }
        }
      </script>
    </body>
  </html>
<?php 
} else {
  header('location:http://www.pmf.sc.gov.br/sistemas/maratonafotografica/login.php');
}
?>