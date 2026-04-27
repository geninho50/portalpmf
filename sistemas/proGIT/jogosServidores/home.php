<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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
	$gdbTotalAlunos = new gdb();
	$gdbResumoModalidade = new gdb();

    $codigo = $gdb->vargetpost('codigo');
    $codigo2 = $gdb->vargetpost('codigo');

    menu( $codigo,'inicio' );

	$codigo = base64_decode( $gdb->vargetpost('codigo') );

	$gdbResumoModalidade->open("SELECT p.modalidade,
							  		   case when p.genero = 'F' Then 'Feminino' else 'Masculino' end as genero,
							  		   p.equipe,
							   count( r.idServidor ) as totalAluno
									FROM secretariaJISF e
									INNER JOIN preEquipeJISF p on p.idSecretaria = e.idSecretaria
									INNER JOIN usuario u on e.email = u.login
									LEFT OUTER JOIN preEquipeServidor r on p.idpreEquipeJISF = r.idpreEquipeJISF
									WHERE u.codigoUsuario = '$codigo'
									GROUP BY p.modalidade, p.genero, p.equipe");

  ?>

	<div id="header" class="container" style="background-image: url('images/background-new.jpg'); background-color: #F5F5F5">
		<div id="logo" style="background-color: #696969">
			<h1><a href="#">JISF 2019</a></h1>
			<p>Jogos de Integração dos Servidores Públicos de Florianópolis</p>
		</div>
	</div>

	<div id="page" class="container">
		<div class="title">
			<h2>Minhas Equipes</h2>
			<span class="byline">Veja abaixo as suas equipes já inscritas e o número de servidores por equipe, ou inscreva-se.</span></div>


 		<br><br>

 		<div id="relacaoAlunos">
           <?php
				if( $gdbResumoModalidade->linhas>0 ){
					$gdbResumoModalidade->titulo_campo  = "Modalidade, Gênero, Equipe, Total de Inscritos";
					$gdbResumoModalidade->formato_campo = ",,,";
					$gdbResumoModalidade->visivel_campo = "v,v,v,v";
					$gdbResumoModalidade->alinha_campo  = "e,e,e,e";
					$gdbResumoModalidade->print_tabela("Resumo das Equipes", 1, 1, "");
				}
		   ?><bR>
 		</div>

        <a href="preEquipe.php?codigo=<? echo $codigo2; ?>">Inscrever Equipe</a>

<br><br>

	<div class="title">
        <h2>Orientações</h2>
    </div>
        <p><strong>Será permitido no máximo 15 servidores por equipe.</strong></p>
        <p><strong>O servidor só poderá jogar por uma única secretaria.</strong></p>
        <p><strong>Cada secretaria só poderá ter no máximo dois jogadores emprestados, isto é, se o servidor trabalhar em uma secretaria diferente da que está sendo cadastrado.</strong></p>
        <p><strong>Cada servidor será identificado por sua matrícula, ou caso terceirizado por CPF.</strong></p>
        <p><strong>Para as secretarias com um volume maior de servidores poderá montar 2 times por modalidade, sendo cadastrado como Time 1 ou Time 2.</strong></p>
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
