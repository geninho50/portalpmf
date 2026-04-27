<!DOCTYPE HTML>
<html>
	<head>
		<title>Minhoca na Cabe&ccedil;a</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="../assets/css/main.css" />
	</head>

	<body class="subpage">

		<!-- Header -->
			<header id="header" >
				<div class="logo"></div>
				<div class="logo"><a href="residuometro.html">RESIDU&Ocirc;METRO</a></div>
				<a href="#menu">Menu</a>
			</header>


		<!-- One -->
			<section id="One" class="wrapper style3">
				<div class="inner">
					<header class="align-center">
						<p><Strong>PROJETO MINHOCA NA CABE&Ccedil;A</Strong></p>
						<h2>Incri&ccedil;&atilde;o Fila de Espera</h2>
					</header>
				</div>
			</section>

			<div id="main" class="container">

								<h2>Dados do Participante</h2>

								<form method="post" action="#" id="formIndex" name="formIndex" >
								   
									<div class="row uniform">
										<div class="6u 12u$(xsmall)">
											<label id="lbcpf">CPF</label>
											<input type="text" name="cpf" id="cpf"  value="" >
										</div>
										<div class="6u 12u$(xsmall)">
											<label id="lbnome" >Email</label><input type="text" name="email" id="email"  maxlength="100"  value="" />
										</div>										
	
										<div class="12u$">
											<ul class="actions">
												<li><input type="button" value="Enviar"  onclick="enviar();"/></li>
												<li><input type="reset" value="Limpar" class="alt" /></li>
											</ul>
										</div>
									</div>
								</form>
						</div>
					</div>

			</div>

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
			<script src="../assets/js/jquery.maskedinput.min.js" type="text/javascript"></script>
			<script src="../assets/js/jquery.scrollex.min.js"></script>
			<script src="../assets/js/skel.min.js"></script>
			<script src="../assets/js/util.js"></script>
			<script src="../assets/js/main.js"></script>
			<script type="text/javascript" src="../../Biblioteca/js/validadores.js"></script>  
			<script type="text/javascript">
			
			$('#cpf').mask("999.999.999-99");		    
			
			function enviar(){
				data = {
					 "cpf" : limpezaDeDocumento( $('#cpf').val() ),
					 "email" : $("#email").val()
				};
				
				data = $( this ).serialize() + "&" + $.param(data);

				$.ajax( {
				  type: "POST",
				  dataType: "html",
				  url: "../../banco/autorizarCadastro.php", 
				  data: data,
				  success: function( data ){  
                             console.log( data );   				  
							 if( data != '0'  ){
								 formIndex.action = data;
								 formIndex.submit();						 
							 }else{
								 alert("CPF ou email, incorreto !"); 
								 $("#cpf").val("");		  
								 $("#email").val("");
								 $("#cpf").focus;
							 }            
						  },
				 error: function( data ){
					 alert(data); 
					console.log( data );
				 }
				} );					

			}
			</script>

	</body>
</html>