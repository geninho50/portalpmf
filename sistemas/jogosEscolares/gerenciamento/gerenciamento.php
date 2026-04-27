<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Jogos Escolares</title>
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

     $select = "select e.nome as escola,
			   p.modalidade,
		       p.genero,
		       p.faixaEtaria,
			   a.nome as aluno,
		       a.nascimento,
		       a.matricula
		from  escola e,
			  aluno a,
			  preEquipe p,
			  preEquipeAluno q
		where
			e.idEscola = p.idEscola AND
			a.idAluno = q.idAluno AND
		    p.idpreEquipe = q.idpreEquipe
		order by p.modalidade, p.genero, p.faixaEtaria, e.nome, a.nome;";


	$gdb->open($select);



     ?>

<div id="wrapper">
	<div id="menu" class="container">
		
	</div>
	<!-- end #menu -->
	<div id="header" class="container" style="background-image: url('../images/fundo1.jpeg'); background-color: #D3D3D3">
		<div id="logo" style="background-color: #668B8B">
			<h1><a href="#">Jogos Escolares</a></h1>
			<p>Fundação Municipal de Esportes</a></p>
		</div>
	</div>
	
	<div id="page" class="container">
		<div class="title">
			<h2>Escolas Inscritas</h2>
			<span class="byline">veja abaixo</span></div>


					<table class="table table-striped table-bordered table-hover" width="" cellspacing="0" cellpadding="6" border="1"> 

						<? /*
							foreach($gdb->gs['ESCOLA'] as $key=>$value){
								if ($nomeEscola != $value) {
									$nomeEscola = $value;
								?>
								  <tr>
 									<td colspan="6" style="background-color: #668B8B; color: white;" align="left"><? print $value ?></td>
 								  </tr> 
 								  <?
									}; ?>

								
								<tr>	  
								   <td align="left"><? print $gdb->gs['MODALIDADE'][$key]; ?></td>
								   <td align="left"><? print $gdb->gs['GENERO'][$key]; ?></td>
								   <td align="left"><? print $gdb->gs['FAIXAETARIA'][$key]; ?></td>
								   <td align="left"><? print $gdb->gs['ALUNO'][$key]; ?></td> 
								   <td align="left"><? print $gdb->gs['NASCIMENTO'][$key]; ?></td> 
								   <td align="center"><? print $gdb->gs['MATRICULA'][$key]; ?></td>
								</tr>

							<? } */ ?>

						<?php 
							foreach($gdb->gs['MODALIDADE'] as $key=>$value){
								if ($nomeModalidade != $value || $tipoGenero != $gdb->gs['GENERO'][$key] || $nomeFaixaEtaria != $gdb->gs['FAIXAETARIA'][$key]) {
									$nomeModalidade = $value;
									$tipoGenero = $gdb->gs['GENERO'][$key];
									$nomeFaixaEtaria = $gdb->gs['FAIXAETARIA'][$key];
						?>
								  <tr>
 									<td colspan="6" style="background-color: #668B8B; color: white;" align="left"><? echo $value." - ".$gdb->gs['GENERO'][$key]." - ".$gdb->gs['FAIXAETARIA'][$key] ?></td>
 								  </tr> 
 								  <?
									}; ?>

								
								<tr>	  
								   <!--<td align="left"><? //print $gdb->gs['GENERO'][$key]; ?></td>
								   <td align="left"><? //print $gdb->gs['FAIXAETARIA'][$key]; ?></td>-->
								   <td align="left"><? print $gdb->gs['ESCOLA'][$key]; ?></td>
								   <td align="left"><? print $gdb->gs['ALUNO'][$key]; ?></td> 
								   <td align="left"><? print $gdb->gs['NASCIMENTO'][$key]; ?></td> 
								   <td align="center"><? print $gdb->gs['MATRICULA'][$key]; ?></td>
								</tr>
						<?php } ?>

					</table>


 	</div>

 </div>


<div id="footer-wrapper" style="background-color: #668B8B">
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