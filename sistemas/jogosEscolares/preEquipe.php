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
    
    menu( $gdb->vargetpost('codigo'),'inscricaoEquipe' ); 
	
	$codigo = base64_decode( $gdb->vargetpost('codigo') );	
	$gdb->open("select idEscola as codigo 
	              from escola e, 
				       usuario u  
			     where e.email = u.login 
				   and u.codigoUsuario = '$codigo' ");
	
	$idEscola = $gdb->gs['CODIGO'][0];
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
			<h2>Pré Inscri&ccedil;&atilde;o dos Times</h2>
			<span class="byline">Inscreva quais as modalidades que a escola irá participar.</span></div>

<!--	<form id="formulario" name="frm">
	   <input type='hidden' name='idEscola' id='idEscola' value='<?php print $idEscola; ?>' >

		<h2>Faixa Et&aacute;ria</h2>
		<div class="row">
			<div class="col-md-6">
			    <select class="form-control" id="faixaEtaria" name="faixaEtaria" >
			      <option value="11 a 13">11 a 13 anos (nascidos de 2006 a 2008)</option>
			      <option value="14 a 16">14 a 16 anos (nascidos de 2003 a 2005)</option>
			    </select>
			</div>
        </div><br>        

		<h2>Modalidade</h2>
		<div class="row">
			<div class="col-md-6">
			    <select class="form-control" id="modalidade" name="modalidade" class="div-select">
			     	<option value="Atletismo">Atletismo</option>
					<option value="Badminton">Badminton</option>
					<option value="Beach Soccer">Beach Soccer</option>
					<option value="Bocha">Bocha</option>
					<option value="Basquetebol">Basquetebol</option>
					<option value="Ciclismo">Ciclismo</option>
					<option value="Futebol">Futebol</option>
					<option value="Futsal">Futsal</option>
					<option value="Ginástica Artística">Ginástica Artística</option>
					<option value="Ginástica Rítmica Feminina">Ginástica Rítmica Feminina</option>
					<option value="Handebol">Handebol</option>
					<option value="Jiu-jitsu">Jiu-jitsu</option>
					<option value="Judô">Judô</option>
					<option value="Karatê">Karatê</option>
					<option value="Luta Olímpica">Luta Olímpica</option>
					<option value="Natação">Natação</option>
					<option value="Punhobol">Punhobol</option>
					<option value="Remo">Remo</option>
					<option value="Taekwondo">Taekwondo</option>
					<option value="Tênis">Tênis</option>
					<option value="Tênis de Mesa">Tênis de Mesa</option>
					<option value="Triatlon">Triatlon</option>
					<option value="Voleibol">Voleibol</option>
					<option value="Volêi de Praia">Volêi de Praia</option>
					<option value="Xadrez">Xadrez</option>
			    </select>
			</div>
        </div><br>  

        <h2>Gênero</h2>
		<div class="row">
			<div class="col-md-6">
			    <select class="form-control" id="genero">
			      <option value="M">Masculino</option>
			      <option value="F">Feminino</option>
			    </select>
			</div>

        </div><br>  

<button type="button" class="btn btn-default" onClick="adicionar();">Salvar</button>

<br><br>

	<div class="title">
        <h2>Orienta&ccedil;&otilde;es</h2>
    </div>

        <p>Os Jogos escolares de Florian&oacute;polis s&atilde;o organizados pela Secretaria de Cultura, Esporte e Juventude de Florian&oacute;polis atrav&eacute;s da funda&ccedil;&atilde;o Municipal de Esportes, onde escolas p&uacute;blicas e particulares participaram de 16 modalidades esportivas em ambos os sexos e divididos em duas categorias: 11 a 13 e de 14 a 16 anos de idade, valendo vaga para o estadual, os <strong>Jogos Escolares de Santa Catarina (JESC). </strong></p>

        <p><strong>Cada Escola dever&aacute; se responsabilizar por seu transporte até o local da competi&ccedil;&atilde;o.</strong></p>
</form>	-->
<h2>ENCERRADA A INSCRIÇÃO DE MODALIDADES</h2>
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

<script type="text/javascript">
			
	function adicionar(){
		
			var obj = {
				faixaEtaria         : $('#faixaEtaria').val(),
				modalidade          : $('#modalidade').val(),
				genero              : $('#genero').val(),
				idEscola            : $('#idEscola').val()
			};
            
		$.ajax({			
				   type: "POST",
				   url: "../banco/cadastrarPreEquipe.php",
				   dataType: "json",
				   data: obj,
				   success: function ( data ) {
				   	console.log(data);
					   if( data['success'] == 1 ){
						   alert("Informações enviadas com SUCESSO.");
					   }else{
						   alert(data['error']);   
					   }
					  				   	
					},				   
				   error: function ( data ) {
					   alert( data['error'] );
					   console.log(data);
				   }
				
			});
			
 }

</script>
</html>
