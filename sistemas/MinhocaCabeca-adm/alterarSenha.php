<?php
  error_reporting(E_ALL);
  ini_set('display_errors', '1');

  include_once("../banco/gdb.php"); 
  include_once("../banco/usuario.func.php");   
		  
  $gdb = new usuarios(); 
  $codigoUsuario  = base64_decode( $gdb->vargetpost('code') ) ;
  $codigoUsuario2 = $gdb->vargetpost('code');  
  
?>  
<html>
	<?php 
	  include_once("cabecalho.php"); 
	  cabecalho( $codigoUsuario2 );
	?>
	<body class="subpage">

		<!-- Header -->
			<header id="header" >
				<div class="logo"></div>
				<div class="logo"></div>
				<a href="#menu">Menu</a>
			</header>

		<!-- Nav -->
			<nav id="menu">
				<ul class="links">
					<li><a href="http://www.pmf.sc.gov.br/sistemas/MinhocaCabeca-adm/">Home</a></li>
					<li><a href="passo.html">Inscreva-se</a></li>
				</ul>
			</nav>

		<!-- One -->
			<section id="One" class="wrapper style3">
				<div class="inner">
					<header class="align-center">
						<p><Strong>PROJETO MINHOCA NA CABE&Ccedil;A</Strong></p>
						<h2>Altera&ccedil;&atilde;o da senha do Sistema</h2>
					</header>
				</div>
			</section>
		
			<div class="box">
				<div class="content">
					
						<h3>Informe os dados abaixo para criar uma nova senha :</h3>

						<form method="post" action="#" id="formIndex" name="formIndex">
						<input type="hidden" name="codigoUsuario" id="codigoUsuario" value="<? print $codigoUsuario; ?>" >
							<div class="row uniform">
								<div class="6u 12u$(xsmall)">
									<label>Insira a nova senha</label><input type="password" name="senha" id="senha" placeholder="Informe a nova senha" />
								</div>
								<div class="6u 12u$(xsmall)">
									<label>Repita a nova senha</label><input type="password" name="repitaSenha" id="repitaSenha" placeholder="Repita" />
								</div>
							</div>
						</form>
						
						<div class="12u$">
							<ul class="actions">
								<li><input type="button" value="Salvar"  onclick="alterar();"/></li>
								<li><a href="index.html" class="button alt" >Sair</a></li>								
							</ul>
						</div>

				</div>
			</div>

			</div>


		<!-- Footer
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
							<img src="images/Comcap.png" alt="" />
							<img src="images/Prefeitura.png" alt=""/>
					</header>
				</div>
			</footer>
			 -->

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>

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
				  url: "../banco/loginMNC.php", 
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