<?php

  error_reporting(E_ALL);
  ini_set('display_errors', '1');
  include_once("../banco/gdb.php");

  $gdb = new gdb();

  $codigoUsuario = base64_decode( $gdb->vargetpost('codigoUsuario') );
  $codigoUsuario2 = base64_decode( $gdb->vargetpost('codigoUsuario') );

  $gdb->open("   select count(*) as total
                   from caixaEnvioMNC c
				  Where ( select count(*)
				            from  caixaRespostaMNC r
						   where r.codigoMensagem = c.codigoMensagem and lido='n'	) > 0
						     and c.codigoUsuario = '$codigoUsuario' ");

  $numeroMensagem = $gdb->gs['TOTAL'][0];

  $gdb->open("select p.codigoPessoa,
                     p.nome,
                     p.email
                from usuario u,
				      pessoa p
			   where u.codigoUsuario = '$codigoUsuario'
			     and p.email = u.login ");


  $nome = $gdb->gs['NOME'][0];
  $email = $gdb->gs['EMAIL'][0];

  $gdb->open("select codigoPessoa,
                     p.nome,
                     p.email,
  		   replace(( SELECT DATE_FORMAT( MAX( dataTroca ),'%d/%m/%Y')
		       FROM trocaCaixaMNC t
			  WHERE t.codigoPessoa = p.codigoPessoa ),'.',',') as dataTroca,
  		   replace(( SELECT sum( qtdeTroca )
		       FROM trocaCaixaMNC t
			  WHERE t.codigoPessoa = p.codigoPessoa ),'.',',') as totalPessoaTroca,
			( SELECT sum( qtdeTroca )
		       FROM trocaCaixaMNC t ) as totalTroca,
	  ( select count(*)
		  from pessoa pi, eventoInscricao i, eventoProgramacao pe, evento e
		where pi.codigoPessoa = i.codigoPessoa
		  and pe.codigoTurma = i.codigoTurma
		  and pe.codigoEvento = e.codigoEvento
		  and codigoprojeto = 'MNC'
		  and  ADDDATE( pe.data, INTERVAL 14 DAY)<sysdate()
		  and i.codigoPessoa = p.codigoPessoa  ) as ok
                from usuario u,
				      pessoa p
			   where u.codigoUsuario = '$codigoUsuario'
			     and p.email = u.login ");

  $codigoPessoa     = $gdb->gs['CODIGOPESSOA'][0];
  $nome 		    = $gdb->gs['NOME'][0];
  $email 		    = $gdb->gs['EMAIL'][0];
  $ultimaTroca      = $gdb->gs['DATATROCA'][0];
  $totalPessoaTroca = $gdb->gs['TOTALPESSOATROCA'][0];
  $totalTroca       = $gdb->gs['TOTALTROCA'][0];

    $codigoUsuario = $gdb->vargetpost('codigoUsuario');

?>

<!DOCTYPE HTML>
<html>

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-54979843-1"></script>
		<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());

		  gtag('config', 'UA-54979843-1');
		</script>
	<?php
	  include_once("cabecalho.php");
	  cabecalho( $codigoUsuario );
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
				<a href="#menu">Menu</a>
			</header>

		<!-- Nav -->
		<?php
		  include_once("menu.php");
		  menu( $codigoUsuario );
		  ?>
		<!-- One -->
			<section id="One" class="wrapper style3">
				<div class="inner">
					<header class="align-center">
						<p><Strong>PROJETO MINHOCA NA CABE&Ccedil;A</Strong></p>
						<h2>Sistema do Usu&aacute;rio</h2>
					</header>
				</div>
			</section>

      <section class="wrapper" style="background-color: white; height: 50%;">
        <div class="inner align-center">
          <header class="align-center">
            <h2 style="color:black;">Pesquisa do Projeto Minhoca na Cabeça</h2>
            <p>Por favor, participe da nossa pesquisa para avaliarmos a eficiência do Projeto Minhoca na Cabeça. Sua participação é essencial, clique no ícone abaixo na imagem para iniciar.</p>
          </header>
          <a href="https://docs.google.com/forms/d/e/1FAIpQLSeHSGzchUhRwt9CLl76KlBQRggIVZgl8a8QcKjnu1goclMleQ/viewform" target="_blank" class="trs"><img src="images/icon-form.png"/></a>
        </div>
      </section>

			<section id="two" class="wrapper style2">
				<div class="inner" style="background-color: white;"><br>
					<header class="align-center" >
						<h2>Manual do Minhocário</h2>
							<p>Saiba como operar seu minhocário. Baixe o manual.</p>

								<?php
									$iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
											$ipad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad");
											$android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
											$palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
											$berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
											$ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
											$symbian =  strpos($_SERVER['HTTP_USER_AGENT'],"Symbian");

											if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian == true){
												echo '';
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
														</figure>';
											};

											?>

						<a href="pdf/Tutorial_Minhoca_na_Cabeca.pdf" class="button special" >Manual</a><br><br>
					</header>
			</div>
			<br><br>


				<div class="inner">
					<header class="align-center">
						<p class="special">Sua Caixa</p>
					</header>

					<div class="gallery">
						<div>
							<div class="image fit">
								<p>Veja quantos quilos de resíduos orgânicos você já desviou do aterro sanitário, contribuindo para que a pegada de carbono de Florianópolis seja mais leve: <strong style="font-size: 20px"><? echo $totalPessoaTroca; ?></strong> .</p>
								<p>Veja quantos quilos de resíduos orgânicos os participantes do Minhoca na Cabeça recuperam juntos: <strong style="font-size: 20px"><? echo $totalTroca; ?></strong> .</p>
								<p>Esse resultado é muito favorável para a cidade. Significa que deixam de ser emitidos gases poluentes, reduzindo o impacto ambiental da geração de resíduos. </p>
								<a href="caixa.php?codigoUsuario=<?echo $codigoUsuario;?>" class="button special">Trocar Caixa</a>


								<iframe align="right" src="https://www.facebook.com/plugins/share_button.php?href=http%3A%2F%2Fwww.pmf.sc.gov.br%2Fsistemas%2FMinhocaCabeca%2Fimages%2FEu_participo_Minhoca_na_Cabe%25C3%25A7a.png&layout=button&size=large&mobile_iframe=true&width=119&height=28&appId" width="119" height="28" style="border:none;overflow:hidden;" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>

							</div>
						</div>
						<div>
							<div class="image fit">
								<h3>Dúvidas? A equipe do Minhoca na Cabeça irá ajudar.</h3>
									<form method="post" action="" name="formEnviar" id="formEnviar">
										<input type="hidden" id="nome" name="nome"  value="<?echo $nome;?>"/>
										<input type="hidden" id="email" name="email" value="<?echo $email;?>" />
										<input type="hidden" id="codigoUsuario" name="codigoUsuario" value="<?echo $codigoUsuario2;?>" />


										Assunto<input type="text" id="titulo" name="titulo" size="35" /><br />
										Mensagem:<textarea name="texto" id="texto" cols="100" rows="5"></textarea><br>

										<input type="button" class="button special" onclick="enviar();" value="Enviar" />

									</form>

							</div>
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

	function enviar(){
		if(confirm("Deseja enviar esta mensagem?")){
			if($("#titulo").val()==""){
				alert("Informe o Assunto");

			}else if($("#texto").val()==""){
				alert("Informe a Mensagem");

			}else{
			   data = {
					 "tipo": "m",
					 "titulo": $("#titulo").val(),
					 "texto": $("#texto").val(),
					 "codigoUsuario": $("#codigoUsuario").val()
				};

				data = $( this ).serialize() + "&" + $.param(data);

				$.ajax( {
				  type: "POST",
				  dataType: "json",
				  url: "../banco/enviarMensagem.php",
				  data: data,
				  success: function( data ){
							if( data == 1){
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


    function acessarSistema(){

	  if( $("#login").val() =="" ){
		  alert("Informe o login !");
          $("#login").val("");
		  $("#senha").val("");
	  }else if( $("#senha").val() =="" ){
  			    alert("Informe a Senha !");
				$("#login").val("");
				$("#senha").val("");
	  }else{
        data = {
             "login": $("#login").val(),
             "senha": $("#senha").val()
        };

		data = $( this ).serialize() + "&" + $.param(data);

		$.ajax( {
		  type: "POST",
		  dataType: "json",
		  url: "../banco/loginMNC.php",
		  data: data,
		  success: function( data ){
					 if( data != 0  ){
					     document.formIndex.action = "sistema.php?codigoUsuario="+data;
						 document.formIndex.submit();
					 }else{
					     alert("O usuário ou senha, está incorreto !");
						 $("#login").val("");
						 $("#senha").val("");
						 $("#login").focus;
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

</body>

</html>
