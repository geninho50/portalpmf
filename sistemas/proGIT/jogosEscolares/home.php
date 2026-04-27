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
	$gdbTotalAlunos = new gdb();  
	$gdbResumoModalidade = new gdb();  	
	
    $codigo = $gdb->vargetpost('codigo');
    $codigo2 = $gdb->vargetpost('codigo');

    menu( $codigo,'inicio' ); 
	
	$codigo = base64_decode( $gdb->vargetpost('codigo') );
	
	$gdbTotalAlunos->open("SELECT count(idAluno) as totalAluno 
	                         FROM escola e, 
							      preEquipe p,
							      preEquipeAluno a, 
								  usuario u  
						    WHERE p.idEscola = e.idEscola 
							  AND e.email = u.login 
							  AND u.codigoUsuario = '$codigo'
							  AND a.idpreEquipe = p.idpreEquipe ");
	

		$gdbResumoModalidade->open("SELECT p.modalidade,
							  		   p.genero,  
							  		   p.faixaEtaria,  	    	
							   count( r.idAluno ) as totalAluno 
									FROM escola e
									INNER JOIN preEquipe p on p.idEscola = e.idEscola 
									INNER JOIN usuario u on e.email = u.login 
									LEFT OUTER JOIN preEquipeAluno r on p.idpreEquipe = r.idpreEquipe
									WHERE u.codigoUsuario = '$codigo'
									GROUP BY p.modalidade, p.genero, p.faixaEtaria");
	
  ?>
	<!-- end #menu -->
	<div id="header" class="container" style="background-image: url('images/fundo1.jpeg'); background-color: #F5F5F5">
		<div id="logo" style="background-color: #696969">
			<h1><a href="#">Jogos Escolares</a></h1>
			<p>Fundação Municipal de Esportes</a></p>
		</div>
	</div>
	
	<div id="page" class="container">
		<div class="title">
			<h2>Instruções</h2>
			<span class="byline">Inscreva primeiro o time (modalidade/gênero/faixa etária) e depois inclua alunos no time criado.</span></div>
		<br>
		<div class="title">
			<h2>Meus Times</h2>
			<span class="byline">Veja abaixo os seus times já inscritos, ou inscreva-se.</span></div>


 		<br><br>

 		<div>
           <?php 
				if( $gdbResumoModalidade->linhas>0 ){
					$gdbResumoModalidade->titulo_campo  = "Modalidade, Gênero, Faixa Etária, Total de Inscritos";
					$gdbResumoModalidade->formato_campo = ",,,";
					$gdbResumoModalidade->visivel_campo = "v,v,v,v";
					$gdbResumoModalidade->alinha_campo  = "e,e,e,e";				
					$gdbResumoModalidade->print_tabela("Resumo das Equipes", 1, 1, "");
				}					   
		   ?><bR>
 			<?php
				if( $gdbTotalAlunos->linhas>0 ){
					print "<h2>Total de alunos inscritos : ".$gdbTotalAlunos->gs['TOTALALUNO'][0]."<h2>";
				}			
			?>		
			<a href="consultaTimes.php?codigo=<? echo $codigo2; ?>"><button class="btn btn-default">Ver Alunos Inscritos</button></a>   
 		</div>

		<br><br>
		<!-- <h2>INSCRIÇÕES ENCERRADAS!</h2> -->
		
 		<h2>Inscrever</h2>

         <a href="times.php?codigo=<? echo $codigo2; ?>"><button class="btn btn-default">Inscrever Alunos</button></a>

<br><br>

	<div class="title">
        <h2>Orientações</h2>
    </div>

        <p>Os Jogos escolares de Florianópolis são organizados pela Secretaria de Cultura, Esporte e Juventude de Florianópolis através da fundação Municipal de Esportes, onde escolas públicas e particulares participaram de 16 modalidades esportivas em ambos os sexos e divididos em duas categorias: 11 a 13 e de 14 a 16 anos de idade, valendo vaga para o estadual, os <strong>Jogos Escolares de Santa Catarina (JESC). </strong></p>

        <p><strong>Cada Escola deverá se responsabilizar por seu transporte até o local da competição.</strong></p>
</form>	
	</div>



<div id="footer-wrapper" style="background-color: #696969">
	<div id="footer" class="container" >
		<h2>Fundação Municipal de Esportes</h2>
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
		    $('#telefone').mask("(99) 999999999");
		    $('#celular').mask("(99) 999999999");	    
		    $('#cep').mask("99.999-999");
			$('#nascimento').mask("99/99/9999");


</script>
</html>
