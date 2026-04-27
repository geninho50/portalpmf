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
      <table class="table table-striped">
        <th style="width:80px">Inscrição</th>
        <th>Tipo</th>
        <th>Nome</th>
        <th>CNPJ</th>
        <th style="width:300px">Endereço</th>
        <th>Cidade</th>
        <th>Bairro</th>
        <th style="width:100px">CEP</th>
        <th style="width:130px">Telefone</th>
        <th>Email</th>
        <th>Responsável Legal</th>
        <th>Cpf do Responsável</th>
        <th>Produtor</th>
        <th>Produtor Fone</th>
        <th>Produtor Celular</th>
        <th>Produtor Email</th>
		<th>Espetáculo</th>
		<th>Autor</th>
		<th>Direção</th>
		<th>Cenografia</th>
		<th>Iluminação</th>
		<th>Figurino</th>
		<th>Maquiagem</th>
		<th style="width:80px">Tempo Duração</th>
		<th style="width:90px">Tempo Montagem</th>
		<th style="width:110px">Tempo Desmontagem</th>
		<th style="width:100px">Gênero</th>
		<th style="width:80px">Categoria</th>	
		<th style="width:80px">Cl. Etária Juvenil</th>
		<th style="width:80px">Cl. Etária Adulto</th>
		<th style="width:80px">+ apresentações</th>
		<th style="width:150px">Espaço para encenação</th>
		<th style="width:150px">Outros</th>
		<th style="width:900px">Sinopse do Espetáculo</th>
		<th style="width:80px">Med Boca Cena</th>
		<th style="width:80px">Med Boca (min)</th>
		<th style="width:100px">Profundidade</th>
		<th style="width:100px">Profundidade Min</th>
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
          include "backend/selectDadosCadastro.php";
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


