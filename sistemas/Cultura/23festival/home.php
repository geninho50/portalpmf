<!DOCTYPE HTML>
<html>
	<head>
		<title>23º Festival Isnard Azevedo</title>
		<meta charset="utf-8" />
		<link rel="shortcut icon" href="images/icon2.png" type="image/png">
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<link rel="stylesheet" href="assets/css/main.css" />
	<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-54979843-1"></script>
		<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());

		  gtag('config', 'UA-54979843-1');
		</script>	

	</head>
	<body>

	<section id="main">
		<div class="inner">

		<!-- One -->
			<section id="one" class="wrapper style1">

				<?php 
					$iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
							$ipad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad");
							$android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
							$palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
							$berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
							$ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
							$symbian =  strpos($_SERVER['HTTP_USER_AGENT'],"Symbian");

							if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian == true){
								echo '<div class="image fit flush"><img  src="images/folder.png"/><br><br></div>';
							}else{
								echo '<section id="banner" data-video="images/banner">
										<video autoplay="" loop="">
											<source src="images/banner.mp4" type="video/mp4">
										</video>
									</section>';
							};
							
							?>	
					

				<div id='cssmenu'>
					<ul>
					   <li><a href='index.html'>Início</a></li>
					   <li class='active'><a href='#'>O Festival</a>
					      <ul>  
				             <li><a href='edicao.html'>Edição 2018</a></li>
				             <li><a href='isnard.html'>Isnard Azevedo</a></li>
				             <li><a href='tecnica.html'>Ficha Técnica do Festival</a></li>
				             <li><a href='enderecos.php'>Endereços úteis</a></li>   
				             <li><a href='festa.html'>Festa do Festival</a></li>   
					      </ul>
					   </li>
					   <li class='active'><a href='#'>Programação</a>
					   	  <ul>
							<li><a href='http://www.pmf.sc.gov.br/sistemas/Cultura/23festival/folder.pdf'>Folder</a></li>  
				            <li><a href='http://www.pmf.sc.gov.br/sistemas/Cultura/23festival/calendario.php'>Por Dia</a></li>
					      </ul>
					    </li>

					   <li class='active'><a href='#'>Espetáculos</a>
					      <ul>
					        <li><a href="http://www.pmf.sc.gov.br/sistemas/Cultura/23festival/images/programacao/teatros.png">Mostra Teatros</a></li>
					   		<li><a href='http://www.pmf.sc.gov.br/sistemas/Cultura/23festival/images/programacao/cena_aberta.png'>Cena Aberta nas Comunidades</a></li>
					   		<li><a href='http://www.pmf.sc.gov.br/sistemas/Cultura/23festival/images/programacao/quintais.png'>2ª Mostra Quintais Cênicos</a></li>
					   		<li><a href='http://www.pmf.sc.gov.br/sistemas/Cultura/23festival/images/programacao/cena_universitaria.png'>Cena Universitária</a></li>
					   		<li><a href='http://www.pmf.sc.gov.br/sistemas/Cultura/23festival/images/programacao/paralela.png'>Mostra Paralela</a></li>
					   		<li><a href='http://www.pmf.sc.gov.br/sistemas/Cultura/23festival/images/programacao/cidades.png'>Circuito Cidades</a></li>
					   	  </ul>
						</li>
					  <li><a href='#'>Ações Formativas</a>
					   	  <ul>
					   		<li><a href='roda1.html'>3ª Roda de Conversas Teatrais</a></li>
					   		<li><a href='roda.html'>Roda de Conversas Teatrais</a></li>
					   		<li><a href='oficinas.html'>Oficinas</a></li>
					   		<li><a href='debates.html'>Debates</a></li>
					      </ul>
					   </li>
					  </ul>
					</div>
				</header>
		
			</section>
			<section id="one" class="wrapper style1" style="background-color: #FFFFFF;">
						<div class="content">
							<p><strong>Realizado pela Prefeitura de Florianópolis, por meio da Secretaria Municipal de Cultura, Esporte e Juventude e Fundação Cultural de Florianópolis Franklin Cascaes, o Festival Isnard Azevedo é uma mostra de diversidade teatral com a participação de 53 grupos/coletivos teatrais de 6 estados brasileiros e dois internacionais que contempla apresentações teatrais de espetáculos de teatro infantil, teatro infanto-juvenil, teatro adulto, teatro de rua e circo-teatro dos mais variados gêneros e formatos.</strong></p>
							<button onclick="window.location.href='http://www.pmf.sc.gov.br/sistemas/Cultura/23festival/calendario.php'">Programação por dia</button>
							<div class="gallery">
								<div>
									<div class="image fit flush">
										<a href="images/infos/1.png" alt=""><img style="border: 10px solid transparent; " src="images/infos/1.png" /></a>
									</div>
								</div>
								<div>
									<div class="image fit flush">
										<a href="images/infos/2.png"  alt=""><img style="border: 10px solid transparent; " src="images/infos/2.png" alt="" /></a>
									</div>
								</div>
								<div>
									<div class="image fit flush">
										<a href="images/infos/3.png"  alt=""><img style="border: 10px solid transparent; " src="images/infos/3.png" alt="" /></a>
									</div>
								</div>
								<div>
								  <div class="image fit flush">
									<a href="images/infos/4.png"><img style="border: 10px solid transparent; " src="images/infos/4.png" alt="" /></a>
							      </div>
								</div>
							</div>
						</div>
					</section>

				</div>
			</section>


			<footer id="footer">
				<div class="container">
					<ul class="icons">
						<a href="../../../"><img src="images/logos.png" width="85%"></a>
					</ul>
				</div>
			</footer>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.poptrox.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
			<script src="assets/js/script.js"></script>

	</body>
</html>