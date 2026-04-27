<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Jogos Escolares</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<link href="default.css" rel="stylesheet" type="text/css" media="all" />
	<link href="fonts.css" rel="stylesheet" type="text/css" media="all" />
	<link rel="shortcut icon" href="icon.png" type="image/png">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
	<script src="js/jquery-2.1.4.min.js" type="text/javascript"></script>
	<script src="js/jquery.maskedinput.min.js" type="text/javascript"></script>
</head>

<body>
	<div id="wrapper">
		<?php

		include_once("../banco/gdb.php");
		include_once("menu.php");

		$gdb = new gdb();
		$gdbm = new gdb();

		menu($gdb->vargetpost('codigo'), 'inscricao');

		$codigo = base64_decode($gdb->vargetpost('codigo'));
		$gdb->open("select idEscola as codigo
	              from escola e,
				       usuario u
			     where e.email = u.login
				   and u.codigoUsuario = '$codigo' ");

		$idEscola = $gdb->gs['CODIGO'][0];

		if ($codigo == '') {
			header('Location: /sistemas/jogosEscolares/login.html');
		}

		$gdbm->open("select p.idpreEquipe as equipe,
	                    p.faixaEtaria as etaria,
	                    p.modalidade,
	                case when p.genero = 'F' Then 'Feminino' else 'Masculino' end as genero
				   from preEquipe p,
				   		escola e,
				   		usuario u
				  where p.idEscola = '$idEscola'
				    AND p.idEscola = e.idEscola
					AND u.login = e.email
     				AND u.codigoProjeto = 'JEM'
				    AND ( select count(*) from preEquipeAluno EA where EA.idpreEquipe = p.idpreEquipe   )<26
			   ORDER BY modalidade");

		?>

		<!-- end #menu -->
		<div id="header" class="container" style="background-image: url('images/fundo1.jpeg'); background-color: #F5F5F5">
			<div id="logo" style="background-color: #696969">
				<h1><a href="#">Jogos Escolares</a></h1>
				<p>Fundação Municipal de Esportes</a></p>
			</div>
		</div>

		<div id="page" class="container">
			
			<!--<div class="title">
				<h2>Inscrição dos Times</h2>
				<span class="byline">Inscreva um aluno por vez, selecionando as equipes já cadastradas.</span>
			</div>

			<form id="formulario" name="frm">
				<input type='hidden' name='idEscola' id='idEscola' value='<?php print $idEscola; ?>'>


				<h2>Escolha a Equipe</h2>
				<div class="row">
					<div class="col-md-6">
						<select class="form-control" id="modalidade">
							<?php foreach ($gdbm->gs['EQUIPE'] as $key => $value) {
								print "<option value='$value'>" . $gdbm->gs['MODALIDADE'][$key] . " - " . $gdbm->gs['ETARIA'][$key] . " - " . $gdbm->gs['GENERO'][$key] . "</option>";
							}
							?>
						</select>
					</div>
				</div><br>

				<h2>Time</h2>
				<div class="row">
					<div class="col-md-3"><label>Nome do Aluno:</label><input value="" id="nome" name="nome" class="form-control" type="text" />
						<button type="button" class="btn btn-default" onclick="adicionar();">Adicionar Aluno</button></div>
					<div class="col-md-3"><label>Matrícula</label><input value="" id="matricula" name="matricula" class="form-control" type="text" /></div>
					<div class="col-md-3"><label>Nascimento:</label><input value="" id="nascimento" name="nascimento" class="form-control" type="date"></div>
				</div>-->
				<h3>INSCRIÇÕES ENCERRADAS PARA ESTA ETAPA!</h3>

				<br><br>


				<br><br>

				<div class="title">
					<h2>Orienta&ccedil;&otilde;es</h2>
				</div>

				<p>Os Jogos escolares de Florian&oacute;polis s&atilde;o organizados pela Secretaria de Cultura, Esporte e Juventude de Florian&oacute;polis atrav&eacute;s da funda&ccedil;&atilde;o Municipal de Esportes, onde escolas p&uacute;blicas e particulares participaram de 16 modalidades esportivas em ambos os sexos e divididos em duas categorias: 11 a 13 e de 14 a 16 anos de idade, valendo vaga para o estadual, os <strong>Jogos Escolares de Santa Catarina (JESC). </strong></p>

				<p><strong>Cada Escola dever&aacute; se responsabilizar por seu transporte até o local da competi&ccedil;&atilde;o.</strong></p>
			</form>
		</div>



		<div id="footer-wrapper" style="background-color: #696969">
			<div id="footer" class="container">
				<h2>Funda&ccedil;&atilde;o Municipal de Esportes</h2>
				<span class="byline"></span>
				<ul class="contact">
					<li><img src="images/logo.png" width="20%"></li>
				</ul>
			</div>
		</div>

		<div id="copyright" class="container">
			<p><img src="images/pmf.png" width="20%"><a href="http://www.pmf.sc.gov.br"></a></p>
		</div>

</body>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/jquery.maskedinput.min.js" type="text/javascript"></script>

<script type="text/javascript">
	function adicionar() {
		var ano = $('#nascimento').val();
		ano = ano.substring(0, 4);

		if ($('#nome').val() == '') {
			alert('Informe o nome do aluno!');
			$('#nome').focus();
		} else if ($('#matricula').val() == '') {
			alert('Informe a matricula do aluno!');
			$('#matricula').focus();
		} else if ($('#nascimento').val() == '') {
			alert('Informe a data de nascimento do aluno!');
			$('#nascimento').focus();
		} else {
			var obj = {
				idpreEquipe: $('#modalidade').val(),
				nome: $('#nome').val(),
				matricula: $('#matricula').val(),
				nascimento: $('#nascimento').val(),
				idEscola: $('#idEscola').val()
			};

			$.ajax({
				type: "POST",
				url: "../banco/cadastrarJogador2.php",
				dataType: "json",
				data: obj,
				success: function(data) {
					console.log(data);
					var nome = $('#nome').val();
					var modalidade = $('#modalidade').val();

					if (data['success'] == 1) {
						alert("Aluno " + nome + " cadastrado com SUCESSO.");
						$('#nome').val('');
						$('#matricula').val('');
						$('#nascimento').val();
						buscarTime();
					} else {
						alert(data['error']);
					}

				},
				error: function(data) {
					alert(data['error']);
					console.log(data);
				}

			});

		}
	}

	function buscarTime() {
		var obj = {
			faixaEtaria: $('#faixaEtaria').val(),
			modalidade: $('#modalidade').val(),
			genero: $('#genero').val(),
			idEscola: $('#idEscola').val()
		};

		$.ajax({
			type: "POST",
			url: "../banco/bucarTime.php",
			dataType: "html",
			data: obj,
			success: function(data) {
				console.log(data);
				$("#relacaoAlunos").html(data);
			},
			error: function(data) {
				alert("Erro na busca de time ");
				console.log(data);
			}

		});
	}
</script>

</html>