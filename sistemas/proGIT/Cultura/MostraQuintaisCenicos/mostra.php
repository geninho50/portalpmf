<!doctype html>
<html lang='pt-BR'>
	<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mostra Quintais Cênicos</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/gerenciamento.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    
  </head>
  	
  <body>

    <h1>Incrições 2ª Mostra Quintais Cênicos 2017</h1>
    <br>
    <div class="containerG">
      <table class="table table-bordered">
        <th style="width:80px">Inscrição</th>
        <th>Tipo</th>
		<th>Espetáculo</th>
		<th>Compania</th>
		<th>Autor</th>
		<th>Direção</th>
		<th style="width:80px">Tempo Duração</th>
		<th style="width:100px">Gênero</th>
		<th style="width:80px">Categoria</th>	
		<th style="width:80px">Cl. Etária Juvenil</th>
		<th style="width:80px">Cl. Etária Adulto</th>
		<th style="width:150px">Espaço para encenação</th>
		<th style="width:150px">Outros</th>
		<th style="width:700px">Sinopse do Espetáculo</th>
		<th style="width:80px">N° Pessoas Total</th>
		<th>Site/Blog/Facebook</th>
		<th>Links para Vídeo</th>
		<th style="width:150px">Histórico Grupo</th>
		<th style="width:150px">Currículo do Grupo</th>
		<th style="width:150px">Currículo da Direção</th>
		<th style="width:150px">Fotos</th>
		<th style="width:150px">Mapa de Iluminação</th>
		<th style="width:150px">Mapa de Sonorização</th>	


        <?
          include "backend/selectDadosCadastro2.php";
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


