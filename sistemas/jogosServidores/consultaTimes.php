<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>JISF</title>
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
    $gdbResumoServidores = new gdb();

    menu( $gdb->vargetpost('codigo'),'consultaTimes' );

	$codigo = base64_decode( $gdb->vargetpost('codigo') );
	$gdb->open("select idSecretaria as codigo from secretariaJISF e, usuario u  where e.email = u.login and u.codigoUsuario = '$codigo' ");
	$idSecretaria = $gdb->gs['CODIGO'][0];


	$gdbResumoServidores->open("SELECT e.idSecretaria, p.modalidade, case when p.genero = 'F' Then 'Feminino' else 'Masculino' end as genero, p.equipe, a.nome, a.matricula, a.secAtua, a.situacao, e.nome as secretaria
							FROM servidorJISF a, preEquipeJISF p, preEquipeServidor c, secretariaJISF e
							where a.idServidor = c.idServidor
							AND p.idpreEquipeJISF = c.idpreEquipeJISF
							AND p.idSecretaria = e.idSecretaria
							AND e.idSecretaria = '$idSecretaria'
							ORDER by e.idSecretaria, p.modalidade, p.genero, p.equipe");

  ?>

	<!-- end #menu -->
	<div id="header" class="container" style="background-image: url('images/background-new.jpg'); background-color: #F5F5F5">
		<div id="logo" style="background-color: #696969">
			<h1><a href="#">JISF 2019</a></h1>
			<p>Jogos de Integração dos Servidores Públicos de Florianópolis</p>
		</div>
	</div>

	<div id="page" class="container">
		<div class="title">
			<h2>Consultar Times</h2>
			<span class="byline">Informe os dados abaixo, e clique em consultar para ver o time da sua secretaria</span></div>

	<form id="formulario" name="frm">
	   <input type='hidden' name='idSecretaria' id='idSecretaria' value='<?php print $idSecretaria; ?>' >

			<div>
           <?php
				if( $gdbResumoServidores->linhas>0 ){
					$gdbResumoServidores->titulo_campo  = ", Modalidade, Gênero, Equipe, Servidor, Matricula, Secretaria Atua, Situação";
					$gdbResumoServidores->formato_campo = ",,,,,,,";
					$gdbResumoServidores->visivel_campo = "i,v,v,v,v,v,v,v";
					$gdbResumoServidores->alinha_campo  = "e,e,e,e,e,e,e,e";
					$gdbResumoServidores->print_tabela($gdbResumoServidores->gs['SECRETARIA'][0], 1, 1, "");
				}
		   ?><bR>

			<input onclick="window.print();" value="Imprimir" type="button" />
 		</div>
<br><br>

	<div class="title">
        <h2>Orienta&ccedil;&otilde;es</h2>
    </div>

        <p><strong>Cada Secretaria dever&aacute; se responsabilizar por seu transporte at&eacute; o local da competi&ccedil;&atilde;o.</strong></p>
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
