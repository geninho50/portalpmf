<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<title>Importa Base de Dados</title>
</head>


<body>
	<div class="container" theme-showcase" role="main">
		<div class="page-header">
			<h2>Importa Base de Dados </h2>

			O sistema funciona com análise de XML.<br>
			Conveter o arquivo XLS de origem em XLM 2003<br>
			A primeira linha com o nome dos campos será desconsiderada<br>
			Manter a primeira linha no XLS e XLM para não perder a primeira linha de dados na importação

			<hr>
			<form class="px-4 py-3" method="POST" action="processa_linhas_reduzido.php" enctype="multipart/form-data">
				<label>Arquivo de linhas - simplificado</label>
				<input type="file" name="arquivo">
				<input type="submit" class="btn btn-primary" name="submit" value="Enviar">
				<br> id_tipo_transporte,
				num,
				nome,
				id_validador
			</form>
			<hr>


			<hr>
			<form class="px-4 py-3" method="POST" action="processa_linhas.php" enctype="multipart/form-data">
				<label>Arquivo de linhas</label>
				<input type="file" name="arquivo">
				<input type="submit" class="btn btn-primary" name="submit" value="Enviar">
			</form>
			<hr>
			<form class="px-4 py-3" method="POST" action="processa_horarios.php" enctype="multipart/form-data">
				<label>Arquivo de horários</label>
				<input type="file" name="arquivo">
				<input type="submit" class="btn btn-primary" name="submit" value="Enviar">
			</form>
			<hr>
			<form class="px-4 py-3" method="POST" action="processa_od.php" enctype="multipart/form-data">
				<label>Arquivo de od</label>
				<input type="file" name="arquivo">
				<input type="submit" class="btn btn-primary" name="submit" value="Enviar">
			</form>
			<hr>

			<form class="px-4 py-3" method="POST" action="processa_frota_simples.php" enctype="multipart/form-data">
				<label>Arquivo de Frota - Indice simplificado</label>
				<input type="file" name="arquivo">
				<input type="submit" class="btn btn-primary" name="submit" value="Enviar">
				<br>Operadora | NumOrdem | Placa | LotaçãoSentados | LotaçãoDePé | Elevador
			</form>

			<hr>

			<form class="px-4 py-3" method="POST" action="processa_setores.php" enctype="multipart/form-data">
				<label>Arquivo de setores Operacionais</label>
				<input type="file" name="arquivo">
				<input type="submit" class="btn btn-primary" name="submit" value="Enviar">
				<br>
				Linha prioridade setor subsetor
			</form>

			<hr>

			<form class="px-4 py-3" method="POST" action="processa_embarcaoes.php" enctype="multipart/form-data">
			<h4>Embarcacoes </h4>
			nome | inscricao | capacidade | ocupacao<br>
			<br>
			<div class="form-group">
				<label>Arquivo de embarcacoes Costa da Lagoa</label>
				<input type="file" name="arquivo">
				</div>

				<div class="form-check">
					<input type="checkbox" class="form-check-input" id="exampleCheck1" name="resetar">
					<label class="form-check-label" for="exampleCheck1">Resetar base de dados?</label>
				</div>
				<div class="form-group">
				<input type="submit" class="btn btn-primary" name="submit" value="Enviar">
				</div>
				<br>
				
			</form>


			<form class="px-4 py-3" method="POST" action="processa_usuarios.php" enctype="multipart/form-data">
			<h4>Importar - Cadastro de Usuarios </h4>
			<br>
			<br>
			<div class="form-group">
				<label>Arquivo de usuarios do transporte coletivo/label>
				<input type="file" name="arquivo">
				</div>
				<div class="form-check">
					<input type="checkbox" class="form-check-input" id="exampleCheck1" name="resetar">
					<label class="form-check-label" for="exampleCheck1">Resetar base de dados?</label>
				</div>
				<div class="form-group">
				<input type="submit" class="btn btn-primary" name="submit" value="Enviar">
				</div>
				<br>		
			</form>
		</div>
		<div>

			<span id="server-results"></span>
		</div>
</body>

</html>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript"></script>
<script>
	//variáveis para paginador

	var qnt_result_pg = 10; //quantidade de registro por página
	var pagina = 1; //página inicial

	//---- MODAL EDITAR

	//---- LSTAR PÁGINA INICIAL

	$("#my_form").submit(function(event) {
		event.preventDefault(); // Prevent default action
		var post_url = $(this).attr("action"); // Get form action URL ex pesquisa.php
		var request_method = $(this).attr("method"); // Get form GET/POST method
		var form_data = new FormData(this); // Creates new FormData object
		var dados = {
			pagina: pagina,
			qnt_result_pg: qnt_result_pg
		}
		$.ajax({
			url: post_url,
			type: request_method,
			data: form_data,
			contentType: false,
			cache: false,
			processData: false
		}).done(function(response) { //
			$("#server-results").html(response);
		});
	});
</script>