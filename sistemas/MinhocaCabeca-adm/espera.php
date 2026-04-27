<!DOCTYPE HTML>
<!--
	Hielo by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
		<title>Minhoca na Cabe&ccedil;a</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body class="subpage">

		<!-- Header -->
			<header id="header" >
				<div class="logo"></div>
				<div class="logo"><a href="residuometro.html">RESIDU&Ocirc;METRO</a></div>
				<a href="#menu">Menu</a>
			</header>

		<!-- Nav -->
			<nav id="menu">
				<ul class="links">
					<li><a href="http://www.pmf.sc.gov.br/sistemas/MinhocaCabeca-adm/">Home</a></li>
					<li><a href="passo.html">Inscreva-se</a></li>
					<li><a href="areaAviso.html">&Aacute;rea do Participante</a></li>
				</ul>
			</nav>

		<!-- One -->
			<section id="One" class="wrapper style3">
				<div class="inner">
					<header class="align-center">
						<p><Strong>PROJETO MINHOCA NA CABE&Ccedil;A</Strong></p>
						<h2>Recicle seus h&aacute;bitos, aprenda a valorizar os res&iacute;duos org&acirc;nicos</h2>
					</header>
				</div>
			</section>

		<!-- Main 
			<div id="main" class="container">

						
								<h2>Lista de Espera</h2>
								<p>Com esses dados entraremos em contato quando abrirem novas vagas.</p>

								<form method="post" action="#" id="formIndex" name="formIndex" >
									<div class="row uniform">	
										<div class="6u$ 12u$(xsmall)">
											<label id="lbcpf">CPF</label><input type="text" name="cpf" id="cpf" placeholder="Informe o CPF"  class="obrigatorio" />
										</div>									
										<div class="6u 12u$(xsmall)">
											<label id="lbnome" >Nome completo</label><input type="text" name="nome" id="nome"  maxlength="100" placeholder="Informe a o nome completo"  class="obrigatorio" />
										</div>										
										<div class="6u$ 12u$(xsmall)">
											<label id="lbtelefone">Telefone Residencial</label><input type="text" name="telefone" id="telefone" placeholder="Informe a telefone residencial"  maxlength="14"  />
										</div>
										<div class="6u 12u$(xsmall)">
											<label id="lbcelular">Celular</label><input type="text" name="celular" id="celular" placeholder="Informe o celular"  class="obrigatorio"  />
										</div>
										<div class="6u$ 12u$(xsmall)">
											<label id="lbemail">E-mail</label><input type="text" name="email" id="email" placeholder="E-mail que ser&aacute; o seu login no sistema Minhoca na Cabe&ccedil;a"   maxlength="45" class="obrigatorio" />
										</div>
										<div class="12u$">
											<ul class="actions">
												<li><input type="button" value="Salvar"  onclick="enviar();"/></li>
												<li><input type="reset" value="Limpar" class="alt" /></li>
											</ul>
										</div>
									</div>
								</form>


						</div>
					</div>
-->
			</div>

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
							<img src="images/Comcap.png" alt="" />
							<img src="images/Prefeitura.png" alt=""/>
					</header>
				</div>
			</footer>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.maskedinput.min.js" type="text/javascript"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
			<script type="text/javascript" src="../Biblioteca/js/validadores.js"></script>  
			<script type="text/javascript">
			
			$('#cpf').mask("999.999.999-99");
		    $('#telefone').mask("(99) 99999999");
		    $('#celular').mask("(99) 999999999");
			
			function enviar(){
			
				var $inputsText = $('form input:text');		
				var values = {};
				var err = '';
				var localImagem  = '../MinhocaCabeca/images/';
				var nTelefone = '';
					
				$inputsText.each( function() {				    
					if( $(this).hasClass('obrigatorio') &&  $(this).val() == "" && err !='Tem' ){			   			  
						err = 'Tem';				
						alert("Informe o " + $( '#lb'+$(this).attr('id') ).html() + " !");
						$(this).focus();
					}
				});
				
				if( err != 	'Tem' ){        
				
					var obj = {
						cpf            : limpezaDeDocumento( $('#cpf').val() ),	
						nome           : $('#nome').val(),
						email          : $('#email').val(),							
						celular        : limpezaDeDocumento( $('#celular').val() ),
						telefone       : limpezaDeDocumento( $('#telefone').val() ),
						codigoprojeto  : 'MNC'				
					};
					
					obj = $( this ).serialize() + "&" + $.param( obj );
							  
					$.ajax({			
						   type: "POST",
						   url: "../banco/cadastrarMNCEspera.php",
						   dataType: "json",
						   data: obj,
						   success: function ( data ) {
							  document.getElementById("formIndex").action = "../banco/sucessoMNCEspera.php?telefone="+nTelefone+"&codigoprojeto=MNC&titulo=Projeto Minhoca na Cabe�a&codigo="+data['codigo']+"&evento="+data['evento']+"&localImagem="+ localImagem;
							  document.getElementById("formIndex").submit();                             
							  // console.log(data);
							},
						   
						   error: function ( data ) {
							  console.log(data);
						   }
						
					});
				}
			}   			 

			</script>
	</body>
</html>