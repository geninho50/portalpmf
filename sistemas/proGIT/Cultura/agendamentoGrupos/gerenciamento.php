<!doctype html>
<html lang='pt-BR'>
	<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Franklin Cascaes</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/gerenciamento.css">
  </head>
  	
  <body>

    <h1>Agendamento Grupos</h1>
    <div class="container-fluid">
      <table class="table table-striped">
        <th>ID</th>
        <th>Nome</th>
  		<th>Rua</th>
        <th>Número</th>
        <th>Complemento</th>
        <th>Municipio</th>
        <th>Bairro</th>
        <th>Cep</th>
        <th>telefone</th>
        <th>celular</th>
        <th>E-Mail 1</th>
        <th>E-Mail 2</th> 
        <th>Turma</th>
        <th>Faixa Etaria</th>
        <th>Título</th>
        <th>Data</th>
        <th>Horário</th>
        <th>Local</th>
        <th>Ingressos Estudante</th>
        <th>Ingressos Profissionais</th>
        <th>Nome Responsável</th>
        <th>Fone Responsável</th>
        <th>Email Responsável</th>
        <th>Editar</th>
        <th>Excluir</th>

        <?
          include "backend/selectGrupo.php";
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
        location.href = "agendamentoGrupos2.php?id=" + id;
      }

      function excluir(id){
        var confirmacao = confirm('Você deseja excluir?');
        if(confirmacao){
          var err = '';
          var obj = {
            id : id
          };

          $.post( "backend/deleteGrupo.php", obj).done(function( data ) {  
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