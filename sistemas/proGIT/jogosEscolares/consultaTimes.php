<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Jogos Escolares</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<link rel="shortcut icon" href="icon.png" type="image/png">
	<link href="default.css" rel="stylesheet" type="text/css" media="all" />
	<link href="fonts.css" rel="stylesheet" type="text/css" media="all" />
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
    $gdbResumoAlunos = new gdb();  
		
    menu( $gdb->vargetpost('codigo'),'consultaTimes' ); 
	
	$codigo = base64_decode( $gdb->vargetpost('codigo') );	
	$gdb->open("select idEscola as codigo from escola e, usuario u  where e.email = u.login and u.codigoUsuario = '$codigo' ");
	$idEscola = $gdb->gs['CODIGO'][0];
	

	$gdbResumoAlunos->open("SELECT e.idEscola, p.modalidade, p.genero, p.faixaEtaria, a.nome, a.matricula, date_format(a.nascimento, '%d/%m/%Y'), e.nome as escola 
							FROM aluno a, preEquipe p, preEquipeAluno c, escola e 
							where a.idAluno = c.idAluno 
							AND p.idpreEquipe = c.idpreEquipe 
							AND p.idEscola = e.idEscola 
							AND e.idEscola = '$idEscola'
							ORDER by e.idEscola, p.modalidade, p.genero, p.faixaEtaria");
	
  ?>

	<!-- end #menu -->
	<div id="header" class="container" style="background-image: url('images/fundo1.jpeg'); background-color: #F5F5F5">
		<div id="logo" style="background-color: #696969">
			<h1><a href="#">Jogos Escolares</a></h1>
			<p>Funda&ccedil;&atilde;o Municipal de Esportes</a></p>
		</div>
	</div>
	
	<div id="page" class="container">
		<div class="title">
			<h2>Consultar Times</h2>
			<span class="byline">Informe os dados abaixo, e clique em consultar para ver o time da sua unidade escolar</span></div>

	<form id="formulario" name="frm">
	   <input type='hidden' name='idEscola' id='idEscola' value='<?php print $idEscola; ?>' >

		<div>
           <?php 
				if( $gdbResumoAlunos->linhas>0 ){
					$gdbResumoAlunos->titulo_campo  = ", Modalidade, Gênero, Faixa Etária, Aluno, Matricula, Nascimento,";
					$gdbResumoAlunos->formato_campo = ",,,,,,,";
					$gdbResumoAlunos->visivel_campo = "i,v,v,v,v,v,v,i";
					$gdbResumoAlunos->alinha_campo  = "c,c,c,c,e,c,c,e";				
					$gdbResumoAlunos->print_tabela($gdbResumoAlunos->gs['ESCOLA'][0], 1, 1, "");
				}					   
		   ?><bR>
 			<?php
				if( $gdbTotalAlunos->linhas>0 ){
					print "<h2>Total de alunos inscritos : ".$gdbTotalAlunos->gs['TOTALALUNO'][0]."<h2>";
				}			
			?>		   

			<input onclick="window.print();" value="Imprimir" type="button" />
 		</div>



<br><br>

	<div class="title">
        <h2>Orienta&ccedil;&otilde;es</h2>
    </div>

        <p>Os Jogos escolares de Florian&oacute;polis s&atilde;o organizados pela Secretaria de Cultura, Esporte e Juventude de Florian&oacute;polis atrav&eacute;s da funda&ccedil;&atilde;o Municipal de Esportes, onde escolas p&uacute;blicas e particulares participaram de 16 modalidades esportivas em ambos os sexos e divididos em duas categorias: 11 a 13 e de 14 a 16 anos de idade, valendo vaga para o estadual, os <strong>Jogos Escolares de Santa Catarina (JESC). </strong></p>

        <p><strong>Cada Escola dever&aacute; se responsabilizar por seu transporte at&eacute; o local da competi&ccedil;&atilde;o.</strong></p>
</form>	
	</div>



<div id="footer-wrapper" style="background-color: #696969">
	<div id="footer" class="container" >
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

