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

    menu( $gdb->vargetpost('codigo'),'equipes' );

	$codigo = base64_decode( $gdb->vargetpost('codigo') );
	$gdb->open("select idSecretaria as codigo
	              from secretariaJISF e,
				       usuario u
			     where e.email = u.login
				   and u.codigoUsuario = '$codigo' ");

	$idSecretaria = $gdb->gs['CODIGO'][0];

	if($codigo == ''){
      header('Location: /sistemas/jogosServidores/login.html');
        }
  ?>

	<!-- end #menu -->
	<div id="header" class="container" style="background-image: url('images/background-new.jpg'); background-color: #F5F5F5">
		<div id="logo" style="background-color: #696969">
			<h1><a href="#">JISF 2019</a></h1>
			<p>Jogos de Integração dos Servidores Públicos de Florianópolis</p>
		</div>
	</div>
	
	<div id="page" class="container">
		<h2>Inscrição de Times ENCERRADO - Somente a inscrições de servidores está liberada</h2>
		<div class="title">
			<h2>Pré Inscri&ccedil;&atilde;o dos Times</h2>
			<span class="byline">Inscreva quais as modalidades que a secretaria irá participar.</span></div>


	<form id="formulario" name="frm">
	   <input type='hidden' name='idSecretaria' id='idSecretaria' value='<?php print $idSecretaria; ?>' >

		<h2>Modalidade</h2>
		<div class="row">
			<div class="col-md-6">
			    <select class="form-control" id="modalidade" name="modalidade" class="div-select">
	 				  <!-- <option value="Beach Tênis">Beach Tênis</option>
					  <option value="Beach Soccer">Beach Soccer</option>
				      <option value="Bocha Raffa">Bocha Raffa</option>
				      <option value="Canastra">Canastra</option>
				      <option value="Dominó">Dominó</option>
				      <option value="Futebol Sete">Futebol Sete</option>
				      <option value="Futsal">Futsal</option>
				      <option value="Tênis">Tênis</option>
				      <option value="Tênis de Mesa">Tênis de Mesa</option>
				      <option value="Truco">Truco</option>
				      <option value="Voleibol">Voleibol</option>
				      <option value="Volêi de Praia">Volêi de Praia</option>
					  <option value="Xadrez">Xadrez</option> -->
					  <option value="Voleibol Misto">Voleibol Misto</option>
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



        <h2>Times</h2>
		<div class="row">
			<div class="col-md-12">
			<p>Caso a sua secretaria tenha muitos servidores, você pode criar dois times da mesma modalidade. Só organize como Time 1 e Time 2.</p>
			</div>
			<div class="col-md-6">
			    <select class="form-control" id="equipe">
			      <option value="Time 1">Time 1</option>
			      <option value="Time 2">Time 2</option>
			     </select>
			</div>
		</div><br>




<button type="button" class="btn btn-default" onClick="adicionar();">Salvar</button>

<br><br>

	<div class="title">
        <h2>Orienta&ccedil;&otilde;es</h2>
    </div>

       <p><strong>Cada Secretaria dever&aacute; se responsabilizar por seu transporte até o local da competi&ccedil;&atilde;o.</strong></p>
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

<script type="text/javascript">

	function adicionar(){

			var obj = {
				modalidade          : $('#modalidade').val(),
				genero              : $('#genero').val(),
				equipe              : $('#equipe').val(),
				idSecretaria        : $('#idSecretaria').val()
			};

		$.ajax({
				   type: "POST",
				   url: "../banco/cadastrarPreEquipeJISF.php",
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
