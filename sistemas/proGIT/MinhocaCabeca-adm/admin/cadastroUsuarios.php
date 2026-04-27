<?php 

  error_reporting(E_ALL);
  ini_set('display_errors', '1');
  include_once("../../banco/gdb.php"); 

  $gdb = new gdb();
  $gdb2 = new gdb();  
  
  $codigoUsuario  = base64_decode( $gdb->vargetpost('codigoUsuario') );  
  $codigoUsuario2 = $gdb->vargetpost('codigoUsuario');    				   
?>


<!DOCTYPE HTML>
<html>
		<?php 
		  include_once("cabecalho.php"); 
		  cabecalho( $codigoUsuario2 );
		?>
	<body class="subpage">
	

		<!-- Header -->
			<header id="header">
				<div class="logo"><a href="../residuometro.html">RESIDU&Ocirc;METRO</a></div>
				<a href="#menu">Menu</a>
			</header>

		<!-- Nav -->
		<? 
		  include_once("menu.php");   
		  menu( $codigoUsuario2 ); 
		  ?>

		<!-- One -->
			<section id="One" class="wrapper style3">
				<div class="inner">
					<header class="align-center">
						<p><Strong>PROJETO MINHOCA NA CABE&Ccedil;A</Strong></p>
						<h2>Manuten&ccedil;&atilde;o de Cursos</h2>
					</header>
				</div>
			</section>

			<section id="two" class="wrapper style2">
			<form name="frm" id="frm" action="" method="post" >
			<input type="hidden" name="operacao" id="operacao" value="">
			    <div id="main" class="container">  
				<div class="inner">					
					<div class="row uniform">								
						<div class="6u$ 12u$(xsmall)">
						   <label>Informe as opcoes abaixo para realizar a inscrição</label>  
						</div>								
						<div class="6u$ 12u$(xsmall)">
						   <label>Nome</label><input type="text" id="nome" name="nome" placeholder="Fulano de Tal">
						</div>								
						<div class="6u$ 12u$(xsmall)">
						   <label>E-mail</label><input type="text" id="email" name="email" placeholder="fulanodetal@pmf.sc.gov.br">
						</div>								
						<div class="6u$ 12u$(xsmall)">
						   <label>Senha</label><input type="password" id="senha" name="senha">
						</div>																							
						<div class="12u$">
						  <ul class="actions">								
							<li><input type="button" value="Cadastrar" onclick="cadastrarUsuario(document.getElementById('nome').value, document.getElementById('senha').value, document.getElementById('email').value);" /></li>
						  </ul>
						</div>								
					</div>	 							  																						  				  
				</div>
				</div>
				</form>
			</section>


		<!-- Footer -->
			<footer id="footer">
				<div class="container">
					<ul class="icons">
						<li><a href="https://twitter.com/_comcap" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
						<li><a href="https://www.facebook.com/comcapoficial" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
						<li><a href="https://www.instagram.com/explore/locations/240724652/prefeitura-de-florianopolis/" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
						<li><a href="mailto:minhocacabeca.comcap@pmf.sc.gov.br" class="icon fa-envelope-o"><span class="label">Email</span></a></li>
					</ul>
				</div>
				<div class="copyright">
					<header class="align-center">
							<img src="../images/Comcap.png" alt="" />
							<img src="../images/Prefeitura.png" alt=""/>
					</header>
				</div>
			</footer>

		<!-- Scripts -->
			<script src="../assets/js/jquery.min.js"></script>
			<script src="../assets/js/jquery.scrollex.min.js"></script>
			<script src="../assets/js/skel.min.js"></script>
			<script src="../assets/js/util.js"></script>
			<script src="../assets/js/main.js"></script>
			<script src="../assets/js/jquery.maskedinput.min.js" type="text/javascript"></script>
	</body>
</html>
<script>
  $('#cpf').mask("999.999.999-99");

  function cadastrarUsuario(nome, senha, login) {
  	$.ajax( {
		  type: "POST",
		  dataType: "json",
		  url: "../../banco/cadastrarUsuarioMNC.php", 
		  data: {
		  			nome : nome,
		  			senha : senha,
		  			login : login
		  		},
		  success: function( data ){
					 if( data.success == 1 ){
						 alert("O usuário foi cadastrado."); 
					 } else {
					     alert("Ocorreu um erro ao cadastrar o usuário."); 
						 $("#email").val("");		  
						 $("#nome").val("");
						 $("#senha").val("");
						 $("#nome").focus;					
					 }
				  },
		 error: function( data ){
			console.log( data );
		 }
		} 
		);
  }
</script>