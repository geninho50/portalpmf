<!DOCTYPE HTML>
<html>
	<head>
		<title>Minhoca na Cabeça</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-54979843-1"></script>
		<link href="../../layout/imagens/brasao.gif" rel="shortcut icon" type="image/x-icon" />
		<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());

		  gtag('config', 'UA-54979843-1');
		</script>

	</head>
	<body>

		<!-- Header -->
			<header id="header">
				<div class="logo"><a href="residuometro.html">RESIDUÔMETRO</a></div>
				<a href="#menu">Menu</a>
			</header>

		<!-- Nav -->
		<?php 
		
		   error_reporting(E_ALL);
		   ini_set('display_errors', '1');
		   
		   include_once("../banco/gdb.php");
		   include_once("../banco/sessao.php");
		   
		   $ponto = new gdb();
		   $gdb   = new gdb();
		   
		   
		   $codigoUsuario = base64_decode( $gdb->vargetpost('codigoUsuario') );		   
		   
		   if( $codigoUsuario !="" ){			  
			   $sessao = new sessao();		
			   $sessao->encerrar_sessao($sistema = 'MNC', $codigoUsuario); 
			   /*
			   $gdb->open("SELECT codigoSessao, dataInicial, horaInicial  FROM backend.acessos where codigoUsuario='$codigoUsuario' order by dataInicial desc, horaInicial desc LIMIT 0,1 ");
			   $codigoSessao = $gdb->gs['CODIGOSESSAO'][0];
			   $gdb->open("update backend.acessos set horaFinal = '', dataFinal = '' Where codigoSessao='$codigoSessao' ");
			   */			  
		   }
		   
		   
		   /*
		   print "<pre>";
		   print_r($_SERVER);
		   print "</pre>";
		   */
		   if( ISSET( $_SERVER['REMOTE_ADDR'] ) ){
			   $IP = $_SERVER['REMOTE_ADDR'];
			   $ip = split('[.]',$_SERVER['REMOTE_ADDR'] );
		   }else{
			   $IP = '0.0.0.0';
			   $ip = array('0','0','0','0');
		   }
		   $faixa = $ip[0].".".$ip[1].".".$ip[2]."."."X";
		   
		   // print "IP : ".$GLOBALS[_SERVER][REMOTE_ADDR];
		   
		   $ponto->open("select count(*) as temIP
						  from faixaIP
						 where ( ip='$IP' or  upper(ip)='$faixa' ) 
						   and situacao = 1 ");
		?>
			<nav id="menu">
				<ul class="links">
					<li><a href="login.html">Área do Participante</a></li>
					<li><a href="loginComFone.html">Acesso sem senha</a></li>
					<?php if( $ponto->gs['TEMIP'][0] != 0 ){ ?>
					<li><a href="admin/loginAdmin.html">Área da Administração</a></li>
					<?php } ?>
					<li><a href="manual.php">Manual do Minhocário</a></li>
				</ul>
			</nav>

			<section id="two" class="wrapper style3">
				<div class="inner">
				<!--	<div class="logo">
						<img src="images/Prefeitura.png" alt=""/>
						<img src="images/Comcap.png" alt="" align="right"/>
					</div>-->
					<header class="align-center">
						<p>Prefeitura de Florianópolis / Comcap</p>
						<h2>Projeto Minhoca na Cabeça</h2>
						</header>
						
					
				</div>
			</section>


		<!-- One -->
			<section id="one" class="wrapper style2">
				<div class="inner">
					<div class="grid-style">

						<div>
							<div class="box">
								<div class="image fit">
									<img src="images/pic02.jpg" alt="" />
								</div>
								<div class="content">
									<header class="align-center">
										<p>A PREFEITURA IRÁ DOAR 500 KITS</p>
										<h2>INSCRIÇÃO</h2>
									</header>
									<p>A Prefeitura de Florianópolis, por meio da Comcap, adota conceito inovador e sustentável para a gestão dos resíduos sólidos domiciliares. A proposta é reciclar hábitos para gerar cada vez menos lixo. </p>

							        <p>A reciclagem de orgânicos na fonte é a escolha mais inteligente para reduzir a pegada de carbono na geração de resíduos. Pelo projeto, serão doados 500 kits (caixa e minhocas) para compostagem em domicílios de Florianópolis. O projeto é operacionalizado pela Comcap e controlado por meio de sistema web desenvolvido pela Diretoria de Sistemas de Governo Eletrônico da PMF.</p>  

									<footer class="align-center">
										<a href="passo.html" class="button alt">INSCREVA-SE</a>
										<!-- <a href="loginParaInscricao.html" class="button alt">INSCRIÇÃO PARA PESSOAS DA FILA DE ESPERA</a>-->
									</footer>
								</div>
							</div>
						</div>

						<div>
							<div class="box">
								<div class="image fit">
									<img src="images/pic03.png" alt="" />
								</div>
								<div class="content">
									<header class="align-center">
										<p>JÁ É PARTICIPANTE DO PROJETO?</p>
										<h2>COMPARTILHE SUA EXPERIÊNCIA</h2>
									</header>
									<p> Aqui você terá acesso a tudo que precisa saber sobre a operação da caixa e o cuidado com as minhocas. Poderá esclarecer dúvidas sobre a compostagem domiciliar e receber orientação técnica, além de compartilhar informações com outros participantes.</p> 
									
									<p> Em troca, deverá informar a quantidade de resíduos orgânicos que você ajudou a desviar do aterro sanitário por meio da ferramenta chamada Residuômetro.  Sempre que uma caixa encher e for trocada, informe no site para que as quantidades compostadas por você sejam somadas no Residuômetro.</p>
									
									<footer class="align-center">
										<a href="login.html" class="button alt" >ACESSAR</a>
										<a href="loginComFone.html" class="button alt" >ACESSO SEM SENHA</a>
									</footer>
								</div>
							</div>
						</div>

					</div>
				</div>
			</section>

		<!-- Two -->
			<section id="two" class="wrapper style3">
				<div class="inner">
					<header class="align-center">
						<p>Prefeitura de Florianópolis / Comcap</p>
						<h2>Projeto Minhoca na Cabeça</h2>
					</header>
				</div>
			</section>

		<!-- Three -->
			<section id="three" class="wrapper style2">
				<div class="inner">
					<header class="align-center">
						<p class="special">Compartilhe suas experiências na Página da Comcap no Facebook</h2>
					</header>

					<div class="gallery">
						<div>
							<div class="image fit">
								<div id="fb-root"></div>
								<div class="fb-page" data-href="https://www.facebook.com/comcapoficial" data-tabs="timeline" data-width="900" data-height="725" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="true"><blockquote cite="https://www.facebook.com/comcapoficial" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/comcapoficial">COMCAP</a></blockquote></div>
							</div>
						</div>
						<div>
							<div class="image fit">
								<span class="image fit"><img src="images/gean.jpg" alt="" /></span>
								<span class="image fit"><img src="images/regras.jpg" alt="" /></span>
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
			


			<script>(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) return;
			  js = d.createElement(s); js.id = id;
			  js.src = 'https://connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.10';
			  fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));
			</script>

	</body>
</html>