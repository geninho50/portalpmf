<!DOCTYPE HTML>

<html>
	<head>
		<title>Minhoca na Cabe&ccedil;a</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="http://www.nffacademia.com.br/biblioteca/dashboard/jquery-jvectormap-1.2.2.css">
        <link rel="stylesheet" href="http://www.nffacademia.com.br/biblioteca/dashboard/AdminLTE.min.css">
        <link rel="stylesheet" href="http://www.nffacademia.com.br/biblioteca/dashboard/_all-skins.min.css">	      
	</head>

	<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());

		  gtag('config', 'UA-54979843-1');
		</script>

<?php

	$enviar = 0;

 if ($_POST['nome'] != '' && $_POST['email'] != '' && $_POST['texto'] != '') {

		  $para = "minhocanacabeca@pmf.sc.gov.br";
		 
		  $nome = $_POST['nome'];

		  $assunto = $_POST['assunto'];

		  $email = $_POST['email'];
		  $texto = $_POST['texto'];

		  $mensagem = "<strong>Nome:  </strong>".$nome;
		  $mensagem .= "<br>  <strong>Mensagem: </strong>".$_POST['texto'];
		 
		  $headers =  "Content-Type:text/html; charset=UTF-8\n";
		  $headers .= "From:  ".$email."\n"; 
		  $headers .= "X-Sender:  ".$email."\n"; 
		  $headers .= "X-Mailer: PHP  v".phpversion()."\n";
		  $headers .= "X-IP:  ".$_SERVER['REMOTE_ADDR']."\n";
		  $headers .= "Return-Path:  ".$email."\n"; 
		  $headers .= "MIME-Version: 1.0\n";

		if( mail($para, $assunto, $mensagem, $headers)  ){
			$enviar = 1;
		}

 }
  ?>

	<style>
		* {margin: 0; padding: 0;}
		body {background: #000}
		a,img {border: none;}
		.trs {-webkit-transition:all ease-out 0.5s;
			-moz-transition:all ease-out 0.5s;
			-o-transition:all ease-out 0.5s;
			-ms-transition:all ease-out 0.5s;
			transition:all ease-out 0.5s;}  
		#slider {position: relative; z-index: 1;}
		#slider a { position: absolute; top: 0; left: 0; opacity: 0;filter:alpha(opacity=0);}
		.ativo {opacity: 1!important; filter:alpha(opacity=100)!important;}

		/*controladores*/
		span {background: #9b4f90; cursor: pointer; opacity: 0;filter:alpha(opacity=0); position: absolute; bottom: 40%; width: 43px; height: 43px; z-index: 5;}
		.next {right: 10px;}
		.next:before,.next:after {left: 21px;}
		.next:before {
			-webkit-transform: rotate(-42deg);
			top: 5px;
		}
		.next:after {
			-webkit-transform: rotate(-132deg);
			top: 19px;
		}
		.next:before,.next:after,.prev:before,.prev:after {content: "";
			height: 20px;
			background: #fff;
			width: 1px;
			position: absolute;
		}
		.prev {left: 10px;}
		.prev:before,.prev:after {left: 18px;}
		.prev:before {
			-webkit-transform: rotate(42deg);
			top: 5px;
		}
		.prev:after {
			-webkit-transform: rotate(132deg);
			top: 19px;
		}

		figure:hover span {opacity: 0.76;filter:alpha(opacity=76);}
			figure {
			max-width: 900px;
			height: 400px;
			position: relative;
			overflow: hidden;
			margin: 50px auto;
		}

		/*figcaption {padding-left: 20px;color: #fff; font-family: "Kaushan Script","Lato","arial"; font-size: 22px; background: #9b4f90; width: 100%; position: absolute; bottom: 0; left: 0; line-height: 55px; height: 55px; z-index: 5}*/
	</style>

	<body class="subpage">
	
			<header id="header">
				<div class="logo"><a href="residuometro.html">RESIDUÔMETRO</a></div>
			</header>

			<section id="One" class="wrapper style3">
				<div class="inner">
					<header class="align-center">
						<p><Strong>PROJETO MINHOCA NA CABE&Ccedil;A</Strong></p>
						<h2>Manual do Minhocário</h2>
					</header>
				</div>
			</section>


			<section id="two" class="wrapper style2">
				<div class="inner" style="background-color: white;"><br>
					<header class="align-center" >
							<h2>Saiba como operar seu minhocário. Baixe o manual.</h2>
					</header>
							<p style="color: black; padding-left: 10px; font-size: 15px;">A reciclagem de orgânicos no domicílio é escolha inteligente para reduzir a pegada de carbono. Separar os restos de alimentos, evitando que sigam para o aterro sanitário, reduz a emissão de gases poluentes e os custos públicos com coleta e destino final. É fácil e proporciona um manejo mais limpo do lixo. </p>
							<p style="color: black; padding-left: 10px; font-size:15px;">Recuperar esses resíduos no próprio domicílio permite produzir composto sólido e líquido de excelente qualidade para uso em vasos, jardins e hortas.</p>
							<p style="color: black; padding-left: 10px; font-size: 15px;">O melhor é que você pode começar agora mesmo a reciclagem dos seus hábitos. </p>
 							<p style="color: black; padding-left: 10px; font-size: 15px;">A equipe técnica da Comcap preparou um manual para a compostagem com minhocas para os participantes do projeto Minhoca na Cabeça. Esse material está compartilhado aqui para ajudar quem já tem minhocário ou quer montar um.</p>	
 							<div class="align-center">
								<?php 
									$iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
											$ipad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad");
											$android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
											$palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
											$berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
											$ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
											$symbian =  strpos($_SERVER['HTTP_USER_AGENT'],"Symbian");

											if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian == true){
												echo '<a href="pdf/manual_impressao.pdf" target="_blank" class="button special" >Manual</a><br><br>';
											}else{
												echo '<figure>
														   <span class="trs next"></span>
														   <span class="trs prev"></span>
														   <div id="slider">
														     <a href="pdf/Tutorial_Minhoca_na_Cabeca.pdf" class="trs"><img src="images/slides/slide01.jpeg" width="100%" height="100%" /></a>
														     <a href="pdf/Tutorial_Minhoca_na_Cabeca.pdf" class="trs"><img src="images/slides/slide02.jpeg" width="100%" height="100%"/></a>
														     <a href="pdf/Tutorial_Minhoca_na_Cabeca.pdf" class="trs"><img src="images/slides/slide03.jpeg" width="100%" height="100%"/></a>
														   </div>

														   <figcaption></figcaption>
														</figure>

						<a href="pdf/Tutorial_Minhoca_na_Cabeca.pdf" target="_blank" class="button special" >Manual</a><br><br>
						<a href="pdf/manual_impressao.pdf" target="_blank" class="button special" >Manual para Impressão</a><br><br>';
											};
											
											?>

				</div>
					
			</div>
			<br><br>
				

				<div class="inner">
					<header class="align-center">
						<p class="special">Oficinas</p>
					</header>


					<div class="gallery">
						<div>
							<div class="image fit">
								<img src="images/oficina_1.jpg" alt="" />
							</div>
						</div>
						<div>
							<div class="image fit">
								<img src="images/oficina_2.jpg" alt="" />
							</div>
						</div>
						<div>
							<div class="image fit">
								<img src="images/oficina_3.jpg" alt="" />
							</div>
						</div>
						<div>
							<div class="image fit">
								<img src="images/oficina_5.jpg" alt="" />
							</div>
						</div>
					</div>
					
						
			
			<div class="inner" style="background-color: white; padding-left: 45px; padding-right: 45px;"><br>
				<header class="align-center" >
					<h3>Dúvidas? A equipe do Minhoca na Cabeça irá ajudar.</h3>
					<p>*Todos os campos são obrigatórios</p>

				<?php

				if ($enviar) {
					echo "Mensagem enviada com sucesso!";
				}

				?>
				
				</header>

				
				<form method="post">
					Nome:<input type="text" id="nome" name="nome" size="35" /><br />
					Email:<input type="text" id="email" name="email" size="35" /><br />
					Assunto:<input type="text" id="assunto" name="assunto" size="35" /><br />
					Mensagem:<textarea name="texto" id="texto" cols="100" rows="5"></textarea><br>
					<input type="submit" class="button special" value="Enviar" /><br><br>

				</form>

			</div>
						

					</div>
				</div>
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
							<img src="images/Comcap.png" alt="" />
							<img src="images/Prefeitura.png" alt=""/>
					</header>
				</div>
			</footer>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>


<script type="text/javascript">
	function setaImagem(){
		var settings = {
			primeiraImg: function(){
				elemento = document.querySelector("#slider a:first-child");
				elemento.classList.add("ativo");
				this.legenda(elemento);
			},

			slide: function(){
				elemento = document.querySelector(".ativo");

				if(elemento.nextElementSibling){
					elemento.nextElementSibling.classList.add("ativo");
					settings.legenda(elemento.nextElementSibling);
					elemento.classList.remove("ativo");
				}else{
					elemento.classList.remove("ativo");
					settings.primeiraImg();
				}

			},

			proximo: function(){
				clearInterval(intervalo);
				elemento = document.querySelector(".ativo");

				if(elemento.nextElementSibling){
					elemento.nextElementSibling.classList.add("ativo");
					settings.legenda(elemento.nextElementSibling);
					elemento.classList.remove("ativo");
				}else{
					elemento.classList.remove("ativo");
					settings.primeiraImg();
				}
				intervalo = setInterval(settings.slide,4000);
			},

			anterior: function(){
				clearInterval(intervalo);
				elemento = document.querySelector(".ativo");

				if(elemento.previousElementSibling){
					elemento.previousElementSibling.classList.add("ativo");
					settings.legenda(elemento.previousElementSibling);
					elemento.classList.remove("ativo");
				}else{
					elemento.classList.remove("ativo");                     
					elemento = document.querySelector("a:last-child");
					elemento.classList.add("ativo");
					this.legenda(elemento);
				}
				intervalo = setInterval(settings.slide,4000);
			},

			legenda: function(obj){
				var legenda = obj.querySelector("img").getAttribute("alt");
				document.querySelector("figcaption").innerHTML = legenda;
			}

		}

		//chama o slide
		settings.primeiraImg();

		//chama a legenda
		settings.legenda(elemento);

		//chama o slide à um determinado tempo
		var intervalo = setInterval(settings.slide,4000);
		document.querySelector(".next").addEventListener("click",settings.proximo,false);
		document.querySelector(".prev").addEventListener("click",settings.anterior,false);
	}

	window.addEventListener("load",setaImagem,false);
/*	
function enviar(){
		if(confirm("Deseja enviar esta mensagem?")){
			if($("#titulo").val()==""){
				alert("Informe o Título");
				$('#titulo').focus();
				return false;

			}else if($("#texto").val()==""){
				alert("Informe a Mensagem");
				$('#texto').focus();
				return false;
			
			}else if($("#nome").val()==""){
				alert("Informe o Nome");
				$('#nome').focus();
				return false;

			}else if($("#email").val()==""){
				alert("Informe o Email");
				$('#email').focus();
				return false;

			}else{
			   data = {
					 "nome": $("#nome").val(),
					 "email": $("#email").val(),
					 "titulo": $("#titulo").val(),
					 "texto": $("#texto").val()
				};
				
				data = $( this ).serialize() + "&" + $.param(data);

				$.ajax( {
				  type: "POST",
				  dataType: "json",
				  url: "../banco/enviarEMAIL.php", 
				  data: data,
				  success: function( data ){
							if( data == 1){
								$("#nome").val("");
								$("#email").val("");
								$("#titulo").val("");		  
								$("#texto").val("");
								alert("Mensagem enviada com sucesso!"); 
								$("#titulo").focus;
							}else{
								alert("Tivemos problema no envio da sua mensagem! Tente novamente mais tarde.");
							}	 
						  },
				 error: function( data ){
					console.log( data );
				 }
				} 
				);
			}
		}
	}

*/

</script>

</body>

</html>