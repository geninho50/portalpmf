<?php
  error_reporting(E_ALL);
  ini_set('display_errors', '1');

  include_once("../banco/gdb.php");
  include_once("../banco/usuario.func.php");

  $gdb = new usuarios();
  $codigoUsuario  = base64_decode( $gdb->vargetpost('code') ) ;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>JISF 2019</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<link href="default.css" rel="stylesheet" type="text/css" media="all" />
	<link href="fonts.css" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
    <script src="js/jquery-2.1.4.min.js" type="text/javascript"></script>
    <script src="js/jquery.maskedinput.min.js" type="text/javascript"></script>
</head>
<body>
<div id="wrapper">
	<div id="menu" class="container">
		<ul>
			<li><a href="index.php" class="current_page_item">In&iacute;cio</a></li>
			<li><a href="secretaria.html"  >Inscri&ccedil;&atilde;o</a></li>
			<li ><a href="login.html" >Entrar</a></li>
			<li><a href="contato.php">Contato</a></li>
		</ul>
	</div>

		<div id="header" class="container" style="background-image: url('images/background-new.jpg'); background-color: #F5F5F5">
		<div id="logo" style="background-color: #696969">
			<h1><a href="#">JISF 2019</a></h1>
			<p>Jogos de Integra��o dos Servidores P�blicos de Florian�polis</p>
		</div>
	</div>
	<div id="page" class="container">
		<div class="title">
			<h3>Informe os dados abaixo para criar uma nova senha :</h3>

		</div>
					<form method="post" action="#" id="formIndex" name="formIndex">
						<input type="hidden" name="codigoUsuario" id="codigoUsuario" class="form-control" value="<? print $codigoUsuario; ?>" >
							<div class="row">
								<div class="col-md-4">
									<label>Insira a nova senha</label><input type="password" name="senha" id="senha" placeholder="Informe a nova senha" class="form-control" />
								</div>
								<div class="col-md-4">
									<label>Repita a nova senha</label><input type="password" name="repitaSenha" id="repitaSenha" placeholder="Repita" class="form-control" />
								</div>
							</div>
					</form>
<br>
			<div class="row">
			  <div class="col-md-1"><button type="button" class="btn btn-default" type="button" value="Alterar"  onclick="alterar();"/>Alterar</button></div>
			  <div class="col-md-1"><button href="login.html" class="btn btn-default" type="button" >Sair</button></div>
			</div>

		</div>
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
<script src="../banco/js/base64.min.js"></script>

<script type="text/javascript">
<script type="text/javascript">

    function alterar(){

	  var senha = $("#senha").val();
	  var repitaSenha = $("#repitaSenha").val();

	  if( senha =="" ||  repitaSenha ==""  ){
		  alert("Informe a nova senha e repita !");
          $("#senha").val("");
		  $("#repitaSenha").val("");
		  $("#senha").focus();
	  }else if( senha != repitaSenha ){
			  alert("As senhas s�o diferentes !");
			  $("#senha").val("");
			  $("#repitaSenha").val("");
			  $("#senha").focus();
	  }else{
			data = {
				 "alterarSenha" :1,
				 "codigoUsuario": $("#codigoUsuario").val(),
				 "senha": senha,
				 "sistema":"cliente"
			};

			data = $( this ).serialize() + "&" + $.param(data);
			$.ajax( {
				  type: "POST",
				  dataType: "html",
				  url: "../banco/loginJEM.php",
				  data: data,
				  success: function( data ){
							 if( data == '1' ){
								 alert("Sua senha foi alterada com sucesso !");
								 document.formIndex.action = "login.html";
								 document.formIndex.submit();
							 }
						  },
				  error: function( data ){
							console.log( data );
				  }
			  }
			);
	  }

    }
</script>
