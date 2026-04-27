<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Jogos Servidores</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<link href="../default.css" rel="stylesheet" type="text/css" media="all" />
	<link href="../fonts.css" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
    <script src="../js/jquery-2.1.4.min.js" type="text/javascript"></script>
    <script src="../js/jquery.maskedinput.min.js" type="text/javascript"></script>
</head>
<body>

	<?php

	include_once("../../banco/gdb.php");

     $gdb = new gdb();


	$gdb->open("SELECT sec.nome as secretaria, sec.responsavel, sec.telefone, sec.celular, sec.email
                FROM backend.secretariaJISF sec;");

    $teste = new gdb();
    $teste->open("SELECT serv.matricula, serv.nome AS servidor, pjisf.genero, serv.situacao, serv.secAtua AS secretaria, pjisf.modalidade, pjisf.equipe
            FROM backend.secretariaJISF sec
            JOIN backend.preEquipeJISF pjisf ON pjisf.idSecretaria = sec.idSecretaria
            JOIN backend.preEquipeServidor pserv ON pserv.idpreEquipeJISF = pjisf.idpreEquipeJISF
            JOIN backend.servidorJISF serv ON serv.idServidor = pserv.idServidor
            GROUP BY serv.secAtua, pjisf.modalidade, serv.nome, pjisf.genero, pjisf.equipe;");


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
			<h2>Servidores Inscritos</h2>
			<span class="byline">veja abaixo</span></div>


					<table class="table table-striped table-bordered table-hover" width="" cellspacing="0" cellpadding="6" border="1">

						<?
							foreach($gdb->gs['SECRETARIA'] as $key=>$value){
								if ($nomeEscola != $value) {
									$nomeEscola = $value;
								?>
								  <tr>
 									<td colspan="7" style="background-color: #002f99; color: white;" align="left"><? print $value ?></td>
 								  </tr>
 								  <?
									}; ?>


								<tr>
								   <td align="left"><? print $gdb->gs['SECRETARIA'][$key]; ?></td>
								   <td align="left"><? print $gdb->gs['RESPONSAVEL'][$key]; ?></td>
								   <td align="left"><? print $gdb->gs['TELEFONE'][$key]; ?></td>
								   <td align="left"><? print $gdb->gs['CELULAR'][$key]; ?></td>
								   <td align="center"><? print $gdb->gs['EMAIL'][$key]; ?></td>

								</tr>

							<? }

							?>

					</table>

                    <h2>Servidores Inscritos</h2>
			<span class="byline">veja abaixo</span></div>


					<table class="table table-striped table-bordered table-hover" width="" cellspacing="0" cellpadding="6" border="1">

						<?
							foreach($teste->gs['SECRETARIA'] as $key=>$value){
								if ($nomeEscola != $value) {
									$nomeEscola = $value;
								?>
								  <tr>
 									<td colspan="7" style="background-color: #002f99; color: white;" align="left"><? print $value ?></td>
 								  </tr>
 								  <?
									}; ?>


								<tr>
								   <td align="left"><? print $teste->gs['MATRICULA'][$key]; ?></td>
								   <td align="left"><? print $teste->gs['SERVIDOR'][$key]; ?></td>
								   <td align="left"><? print $teste->gs['GENERO'][$key]; ?></td>
								   <td align="left"><? print $teste->gs['SITUACAO'][$key]; ?></td>
								   <td align="center"><? print $teste->gs['SECRETARIA'][$key]; ?></td>
								   <td align="left"><? print $teste->gs['MODALIDADE'][$key]; ?></td>
								   <td align="center"><? print $teste->gs['EQUIPE'][$key]; ?></td>

								</tr>

							<? }

							?>

					</table>

 	</div>

 </div>


<div id="footer-wrapper" style="background-color: #696969">
	<div id="footer" class="container" >
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

</html>