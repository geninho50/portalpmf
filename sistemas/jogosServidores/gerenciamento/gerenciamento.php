<?php
$user = $_POST['user'];
$password = $_POST['password'];
if ($user == "fmeesportes@gmail.com" && $password == "fmeflorianopolis") {
	?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Jogos Servidores</title>
		<meta name="keywords" content="" />
		<meta name="description" content="" />
		<link href="../default.css" rel="stylesheet" type="text/css" media="all" />
		<link href="../fonts.css" rel="stylesheet" type="text/css" media="all" />
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<script src="../js/jquery-2.1.4.min.js" type="text/javascript"></script>
		<script src="../js/jquery.maskedinput.min.js" type="text/javascript"></script>
	</head>

	<body>

		<?php

			include_once("../../banco/gdb.php");

			$servidores = new gdb();
			$servidores->open("SELECT serv.matricula, serv.nome AS servidor, pjisf.genero, serv.situacao, sec.nome AS secretaria, pjisf.modalidade, pjisf.equipe
				FROM backend.secretariaJISF sec
				JOIN backend.preEquipeJISF pjisf ON pjisf.idSecretaria = sec.idSecretaria
				JOIN backend.preEquipeServidor pserv ON pserv.idpreEquipeJISF = pjisf.idpreEquipeJISF
				JOIN backend.servidorJISF serv ON serv.idServidor = pserv.idServidor
				GROUP BY sec.nome, pjisf.modalidade, serv.nome, pjisf.genero, pjisf.equipe;");

			$responsaveis = new gdb();
			$responsaveis->open("SELECT sec.nome as secretaria, sec.responsavel, sec.telefone, sec.celular, sec.email
						  FROM backend.secretariaJISF sec;");

			$modalidades = new gdb();
			$modalidades->open("SELECT sec.nome as secretaria, pej.modalidade, case when pej.genero = 'F' Then 'Feminino' else 'Masculino' end as genero, 
									   pej.equipe, count( pes.idServidor ) as totalServidor
								FROM secretariaJISF sec
								INNER JOIN preEquipeJISF pej on pej.idSecretaria = sec.idSecretaria
								INNER JOIN usuario u on sec.email = u.login
								LEFT OUTER JOIN preEquipeServidor pes on pej.idpreEquipeJISF = pes.idpreEquipeJISF
								GROUP BY sec.nome, pej.modalidade, pej.genero, pej.equipe");

			?>

		<div id="wrapper">

		</div>
		<!-- end #menu -->
		<div id="header" class="container" style="background-image: url('../images/background-new.jpg'); background-color: #F5F5F5">
			<div id="logo" style="background-color: #696969">
				<h1><a href="#">JISF 2019</a></h1>
				<p>Jogos de Integração dos Servidores Públicos de Florianópolis</p>
			</div>
		</div>

		<div id="page" class="container">
			<div class="title">
				<h2>Selecione uma opção:</h2>
				<span class="byline">veja abaixo</span>
			</div>

			<div id="accordion">
				<div class="card">
					<div class="card-header" id="headingOne">
						<h5 class="mb-0">
							<button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
								Servidores Inscritos
							</button>
						</h5>
					</div>

					<div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
						<div class="card-body">
							<table class="table table-striped table-bordered table-hover" width="" cellspacing="0" cellpadding="6" border="1">

								<?
									foreach ($servidores->gs['SECRETARIA'] as $key => $value) {
										if ($nomeEscola != $value) {
											$nomeEscola = $value;
											?>
										<tr>
											<td colspan="7" style="background-color: #002f99; color: white;" align="left"><? print $value ?></td>
										</tr>
									<?
											}; ?>


									<tr>
										<td align="left"><? print $servidores->gs['MATRICULA'][$key]; ?></td>
										<td align="left"><? print $servidores->gs['SERVIDOR'][$key]; ?></td>
										<td align="left"><? print $servidores->gs['GENERO'][$key]; ?></td>
										<td align="left"><? print $servidores->gs['SITUACAO'][$key]; ?></td>
										<td align="center"><? print $servidores->gs['SECRETARIA'][$key]; ?></td>
										<td align="left"><? print $servidores->gs['MODALIDADE'][$key]; ?></td>
										<td align="center"><? print $servidores->gs['EQUIPE'][$key]; ?></td>

									</tr>

								<? }

									?>

							</table>
						</div>
					</div>
				</div>
				<div class="card">
					<div class="card-header" id="headingTwo">
						<h5 class="mb-0">
							<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
								Responsáveis
							</button>
						</h5>
					</div>
					<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
						<div class="card-body">
							<table class="table table-striped table-bordered table-hover" width="" cellspacing="0" cellpadding="6" border="1">

								<?
									foreach ($responsaveis->gs['SECRETARIA'] as $key => $value) {
										if ($nomeEscola != $value) {
											$nomeEscola = $value;
											?>
										<tr>
											<td colspan="7" style="background-color: #002f99; color: white;" align="left"><? print $value ?></td>
										</tr>
									<?
											}; ?>


									<tr>
										<td align="left"><? print $responsaveis->gs['RESPONSAVEL'][$key]; ?></td>
										<td align="left"><? print $responsaveis->gs['TELEFONE'][$key]; ?></td>
										<td align="left"><? print $responsaveis->gs['CELULAR'][$key]; ?></td>
										<td align="center"><? print $responsaveis->gs['EMAIL'][$key]; ?></td>

									</tr>

								<? }

									?>

							</table>
						</div>
					</div>
				</div>
				<div class="card">
					<div class="card-header" id="headingThree">
						<h5 class="mb-0">
							<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
								Modalidades
							</button>
						</h5>
					</div>
					<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
						<div class="card-body">
							<table class="table table-striped table-bordered table-hover" width="" cellspacing="0" cellpadding="5" border="1">

								<?
									foreach ($modalidades->gs['SECRETARIA'] as $key => $value) {
										if ($nomeEscola != $value) {
											$nomeEscola = $value;
											?>
										<tr>
											<td colspan="5" style="background-color: #002f99; color: white;" align="left"><? print $value ?></td>
										</tr>
									<?
											}; ?>


									<tr>
										<td align="left"><? print $modalidades->gs['MODALIDADE'][$key]; ?></td>
										<td align="left"><? print $modalidades->gs['GENERO'][$key]; ?></td>
										<td align="left"><? print $modalidades->gs['EQUIPE'][$key]; ?></td>
										<td align="left"><? print $modalidades->gs['TOTALSERVIDOR'][$key]; ?></td>
									</tr>

								<? }

									?>

							</table>
						</div>
					</div>
				</div>
			</div>
		</div>

		</div>


		<div id="footer-wrapper" style="background-color: #696969">
			<div id="footer" class="container">
				<h2>Fundação Municipal de Esportes</h2>
				<span class="byline"></span>
				<ul class="contact">
					<li><img src="../images/logo.png" width="20%"></li>
				</ul>
			</div>
		</div>

		<div id="copyright" class="container">
			<p><img src="../images/pmf.png" width="20%"><a href="http://www.pmf.sc.gov.br"></a></p>
		</div>

	</body>

	<script src="../assets/js/jquery.min.js"></script>
	<script src="../assets/js/jquery.maskedinput.min.js" type="text/javascript"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

	</html>
<?php
} else {
	header('location:http://www.pmf.sc.gov.br/sistemas/jogosServidores/gerenciamento/login.php');
}
?>