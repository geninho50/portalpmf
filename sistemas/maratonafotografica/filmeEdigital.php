<?php
//header("locationlocation: http://www.pmf.sc.gov.br");
?>
<!DOCTYPE HTML>

<html>
	<head>
		<title>Maratona Fotográfica</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<link href="../../layout/imagens/brasao.gif" rel="shortcut icon" type="image/x-icon" />
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
		<div class="page-wrap">

			<!-- Nav 
				<nav id="nav">
					<ul>
						<li><a href="index.html" class="active"><span class="icon fa-home"></span></a></li>
						<li><a href="gallery.html"><span class="icon fa-camera-retro"></span></a></li>
						<li><a href="generic.html"><span class="icon fa-file-text-o"></span></a></li>
					</ul>
				</nav>-->

			<!-- Main -->
				<section id="main">

					<!-- Banner -->
						<section id="banner">
							<div class="inner">
									<div align="center">
										<?php 
									$iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
											$ipad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad");
											$android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
											$palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
											$berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
											$ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
											$symbian =  strpos($_SERVER['HTTP_USER_AGENT'],"Symbian");

											if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian == true){
												echo '<img  src="img/thumbs/26/LOGO 26 Maratona-Colorida-05.png" width="250" height="250"/><br><br>
												
                                                <p class="autor">Fotógrafa: Sandra Kraus</p>';
											}else{
												echo '<img  src="img/thumbs/26/LOGO 26 Maratona-Colorida-05.png" width="400" height="400"/><br><br>
												
                                                <p class="autor2">Fotógrafa: Sandra Kraus</p>';
											};
											
											?>
										
									</div>
								<!--<h1>24° Maratona Fotográfica de Florianópolis</h1>
								<p>um projeto da Fundação Franklin Cascaes</p>-->
								
							</div>
						</section>

					<!-- Gallery -->
						<section id="galleries">
                            <link rel="stylesheet" href="assets/css/timeline.css" />
                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                            <script src="assets/js/timeline.js"></script>

                            <h1>Maratonas Fotográficas</h1>
                            <div class="flex-parent">
                                <div class="input-flex-container">
                                    <div class="input">
                                        <span data-year="22" data-info="22º Edição"></span>
                                    </div>
                                    <div class="input">
                                        <span data-year="23" data-info="23º Edição"></span>
                                    </div>
                                    <div class="input">
                                        <span data-year="24" data-info="24º Edição"></span>
                                    </div>
                                    <div class="input active">
                                        <span data-year="25" data-info="25º Edição"></span>
                                    </div>
                                </div>
                                <div class="description-flex-container">
                                    <div class="gallery">
                                        <div class="content">
                                            <div class="media">
                                                <a href="img/fulls/22/Beatriz%20Binotto%20-%20Vida%20simples-%20Premio%20Conjunto%20Modalidade%20Infantojuvenil16%20a%2017%20anos.jpg"><img src="img/thumbs/22/Beatriz%20Binotto%20-%20Vida%20simples-%20Premio%20Conjunto%20Modalidade%20Infantojuvenil16%20a%2017%20anos.jpg" alt="" title="Vida simples – Prêmio Conjunto Modalidade Infantojuvenil – 16 a 17 anos" />Beatriz Binotto</a>
                                            </div>
                                            <div class="media">
                                                <a href="img/fulls/22/Raphael%20Zulianello%20-%20Juventude-%202%20premio%20conjunto%20digital%201.jpg"><img src="img/thumbs/22/Raphael%20Zulianello%20-%20Juventude-%202%20premio%20conjunto%20digital%201.jpg" alt="" title="Juventude – Prêmio Conjunto Digital 2" />Raphael Zulianello</a>
                                            </div>
                                            <div class="media">
                                                <a href="img/fulls/22/Katia%20Speck%20-%20Juventude%20-%201%20Prêmio%20Conjunto%20Digital%20Categoria%202.jpg"><img src="img/thumbs/22/Katia%20Speck%20-%20Juventude%20-%201%20Prêmio%20Conjunto%20Digital%20Categoria%202.jpg" alt="" title="Juventude – Prêmio Digital – Categoria 2" />Katia Speck</a>
                                            </div>

                                            <?php
                                            $iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
                                            $ipad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad");
                                            $android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
                                            $palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
                                            $berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
                                            $ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
                                            $symbian =  strpos($_SERVER['HTTP_USER_AGENT'],"Symbian");

                                            if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian == true){

                                            } else {
                                            ?>
                                            <div class="media">
                                                <a href="img/fulls/22/Miguel%20Luiz%20Dalpra%20Pereira-Vida%20simples-%20Premio%20Melhores%20Fotografias.jpg"><img src="img/thumbs/22/Miguel%20Luiz%20Dalpra%20Pereira-Vida%20simples-%20Premio%20Melhores%20Fotografias.jpg" alt="" title="Vida simples – Prêmio Melhores Fotografias" />Miguel Luiz Dalpra Pereira</a>
                                            </div>

                                            <div class="media">
                                                <a href="img/fulls/22/Felipe%20da%20Silva%20Vieira%20-Juventude%20-%201%20premio%20conjunto%20digital%201.JPG"><img src="img/thumbs/22/Felipe%20da%20Silva%20Vieira%20-Juventude%20-%201%20premio%20conjunto%20digital%201.JPG" alt="" title="Juventude – Prêmio Conjunto Digital 1" />Felipe da Silva Vieira</a>
                                            </div>

                                            <div class="media">
                                                <a href="img/fulls/22/Eduarda%20Mendonça%20de%20Souza-Vida%20simples-Premio%20Melhores%20Fotografias_divulgação.jpg"><img src="img/thumbs/22/Eduarda%20Mendonça%20de%20Souza-Vida%20simples-Premio%20Melhores%20Fotografias_divulgação.jpg" alt="" title="Vida simples – Prêmio Melhores Fotografias" />Eduarda Mendonça de Souza</a>
                                            </div>

                                            <div class="media">
                                                <a href="img/fulls/22/Felipe%20Guimarães%20-%20Ruínas%20urbanas%20-%202%20Prêmio%20Conjunto%20Digital%202%20-%20divulgação.jpg"><img src="img/thumbs/22/Felipe%20Guimarães%20-%20Ruínas%20urbanas%20-%202%20Prêmio%20Conjunto%20Digital%202%20-%20divulgação.jpg" alt="" title="Ruínas urbandas – Prêmio Conjunto Digital 2" />Felipe Guimarães</a>
                                            </div>
                                        </div>

                                        <footer>
                                            <h2><a href="pdf/catalogo_maratona_22.pdf">Catálogo da 22ª Maratona Fotográfica de Florianópolis</a></h2>
                                            <h1>26ª Maratona Fotográfica de Florianópolis!</h1>
                                            <h3 style="font-style:italic;">*Em virtude da proibição da realização de eventos de grande público na cidade de Florianópolis devido a atual situação do Covid 19, causada pelo Coronavírus, através do Decreto N. 21.340, de 13 de março/2020, informamos que a 26ª Maratona Fotográfica não tem data definida para sua realização.</h3>
                                        </footer>
                                        <?php }; ?>
                                    </div>

                                    <div class="gallery">
                                        <div class="content">
                                            <div class="media">
                                                <a href="img/fulls/23/Betina_Madeira_Schmitt.jpg"><img src="img/thumbs/23/Betina_Madeira_Schmitt.jpg" alt="" title="Mobilidade – 1º Prêmio Conjunto Modalidade Digital – Categoria 1" />Betina Schmitt</a>
                                            </div>
                                            <div class="media">
                                                <a href="img/fulls/23/Hortencia_Brandao_Subtema_Desconstrucao.JPG"><img src="img/thumbs/23/Hortencia_Brandao_Subtema_Desconstrucao.JPG" alt="" title="[Des]construção – Prêmio Fotografia Individual" />Hortência Brandão</a>
                                            </div>
                                            <div class="media">
                                                <a href="img/fulls/23/Felipe Obrer Cardoso_subtema Multicultural.jpg"><img src="img/thumbs/23/Felipe Obrer Cardoso_subtema Multicultural.jpg" alt="" title="Multicultural – Prêmio Fotografia Individual" />Felipe Obrer Cardozo</a>
                                            </div>

                                            <?php
                                            $iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
                                            $ipad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad");
                                            $android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
                                            $palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
                                            $berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
                                            $ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
                                            $symbian =  strpos($_SERVER['HTTP_USER_AGENT'],"Symbian");

                                            if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian == true){

                                            } else {
                                            ?>
                                            <div class="media">
                                                <a href="img/fulls/23/Leonardo_Gaudio_Mobilidade_Premio_Melhores_Fotografias.jpg"><img src="img/thumbs/23/Leonardo_Gaudio_Mobilidade_Premio_Melhores_Fotografias.jpg" alt="" title="Mobilidade – Prêmio Melhores Fotografias" />Leonardo Gaudio</a>
                                            </div>

                                            <div class="media">
                                                <a href="img/fulls/23/Eduarda.jpg"><img src="img/thumbs/23/Eduarda.jpg" alt="" title="Brinquedos esquecidos – Prêmio Conjunto Modalidade Infantojuvenil – 16 a 17 anos" />Eduarda Mendonça de Souza</a>
                                            </div>

                                            <div class="media">
                                                <a href="img/fulls/23/Katia_Speck_subtema Raizes_profundas.jpg"><img src="img/thumbs/23/Katia_Speck_subtema Raizes_profundas.jpg" alt="" title="Raízes profundas – 1º Prêmio Conjunto Modalidade Digital – Categoria 2" />Kátia Speck</a>
                                            </div>

                                            <div class="media">
                                                <a href="img/fulls/23/Virissimo_Bortolin_Silva_subtema_Brinquedos_esquecidos.jpg"><img src="img/thumbs/23/Virissimo_Bortolin_Silva_subtema_Brinquedos_esquecidos.jpg" alt="" title="Brinquedos esquecidos – Prêmio Conjunto Modalidade Infantojuvenil – 13 a 15 anos" />Veríssimo Bortolin Silva</a>
                                            </div>
                                        </div>

                                        <footer>
                                            <h2><a href="pdf/catalogo_maratona_23.pdf">Catálogo da 23ª Maratona Fotográfica de Florianópolis</a></h2>
                                            <h1>26ª Maratona Fotográfica de Florianópolis!</h1>
                                            <h3 style="font-style:italic;">*Em virtude da proibição da realização de eventos de grande público na cidade de Florianópolis devido a atual situação do Covid 19, causada pelo Coronavírus, através do Decreto N. 21.340, de 13 de março/2020, informamos que a 26ª Maratona Fotográfica não tem data definida para sua realização.</h3>
                                        </footer>
                                        <?php }; ?>
                                    </div>

                                    <div class="gallery">
                                        <div class="content">
                                            <div class="media">
                                                <a href="img/fulls/24/Adriano%20José%20Assis%20-%20Premio%20Melhores%20Fotografias_Subtema%201%20-%20Era%20uma%20vez_divulgação.jpg"><img src="img/thumbs/24/Adriano%20José%20Assis%20-%20Premio%20Melhores%20Fotografias_Subtema%201%20-%20Era%20uma%20vez_divulgação.jpg" alt="" title="Era uma vez – Prêmio Melhores Fotografias"/>Adriano José Assis</a>
                                            </div>
                                            <div class="media">
                                                <a href="img/fulls/24/Arthur%20Muniz_%202%20premio%20digital%201_Subtema%20Presença%20açoriana%20-%20divulgação.jpg"><img src="img/thumbs/24/Arthur%20Muniz_%202%20premio%20digital%201_Subtema%20Presença%20açoriana%20-%20divulgação.jpg" alt="" title="Presença Açoriana – Prêmio Melhores Fotografias Digital – Categoria 1"/>Arthur Muniz</a>
                                            </div>
                                            <div class="media">
                                                <a href="img/fulls/24/Italo%20Zaccaron%20-%20Premio%20Melhores%20Fotografias%20-%20Presença%20açoriana_divulgação.jpg"><img src="img/thumbs/24/Italo%20Zaccaron%20-%20Premio%20Melhores%20Fotografias%20-%20Presença%20açoriana_divulgação.jpg" alt="" title="Presença Açoriana – Prêmio Melhores Fotografias – Categoria 1"/>Italo Zaccaron</a>
                                            </div>

                                            <?php
                                            $iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
                                            $ipad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad");
                                            $android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
                                            $palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
                                            $berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
                                            $ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
                                            $symbian =  strpos($_SERVER['HTTP_USER_AGENT'],"Symbian");

                                            if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian == true){

                                            } else {
                                            ?>

                                            <div class="media">
                                                <a href="img/fulls/24/Juan%20Alonso_%20Aquilo%20que%20se%20esconde_divulgação.jpg"><img src="img/thumbs/24/Juan%20Alonso_%20Aquilo%20que%20se%20esconde_divulgação.jpg" alt="" title="Aquilo que se esconde – Prêmio Melhores Fotografias" />Juan Alonso</a>
                                            </div>

                                            <div class="media">
                                                <a href="img/fulls/24/Leonardo%20Guadio%20-%201%20Premio%20Conjunto%20Digital%201-%20Subtema%20Realidades%20invisíveis_divulgação.jpg"><img src="img/thumbs/24/Leonardo%20Guadio%20-%201%20Premio%20Conjunto%20Digital%201-%20Subtema%20Realidades%20invisíveis_divulgação.jpg" alt="" title="Realidades invisíveis – Prêmio Conjunto Digital" />Leonardo Guadio</a>
                                            </div>

                                            <div class="media">
                                                <a href="img/fulls/24/Leonardo%20Guadio%20-%201%20Premio%20Conjunto%20Digital%201-%20Subtema%20Reflexos%20da%20diversidade.jpg"><img src="img/thumbs/24/Leonardo%20Guadio%20-%201%20Premio%20Conjunto%20Digital%201-%20Subtema%20Reflexos%20da%20diversidade.jpg" alt="" title="Reflexos da diversidade – Prêmio Conjunto Digital" />Leonardo Guadio</a>
                                            </div>

                                            <div class="media">
                                                <a href="img/fulls/24/Miguel%20Dalpra%20Pereira%20-Premio%20Conjunto%20Infantojuvenil%2013a15anos%20-%20subtema%20Caminho%20improvável.jpg"><img src="img/thumbs/24/Miguel%20Dalpra%20Pereira%20-Premio%20Conjunto%20Infantojuvenil%2013a15anos%20-%20subtema%20Caminho%20improvável.jpg" alt="" title="Caminho improvável - Prêmio Conjunto Modalidade Infantojuvenil – 13 a 15 anos"/>Miguel Luiz Dalpra Pereira</a>
                                            </div>
                                        </div>

                                        <footer>
                                            <h2><a href="pdf/catalogo_maratona_24.pdf">Catálogo da 24ª Maratona Fotográfica de Florianópolis</a></h2>
                                            <h1>Maratona Fotográfica de Florianópolis!</h1>
                                            <h3 style="font-style:italic;">*Em virtude da proibição da realização de eventos de grande público na cidade de Florianópolis devido a atual situação do Covid 19, causada pelo Coronavírus, através do Decreto N. 21.340, de 13 de março/2020, informamos que a 26ª Maratona Fotográfica não tem data definida para sua realização.</h3>
                                        </footer>
                                        <?php }; ?>
                                    </div>

                                    <div class="gallery active">
                                        <div class="content">
                                            <div class="media">
                                                <a href="img/fulls/25/AdrianoAssis_Fortaleza-Digital1_divulgacao.jpg"><img src="img/thumbs/25/AdrianoAssis_Fortaleza-Digital1_divulgacao.jpg" alt="" title="Fortaleza – Prêmio Melhores Fotografias Digitais"/>Adriano Assis</a>
                                            </div>
                                            <div class="media">
                                                <a href="img/fulls/25/DeiseCristofoli_Fortaleza_ConjuntoDigital2_divulgacao.jpg"><img src="img/thumbs/25/DeiseCristofoli_Fortaleza_ConjuntoDigital2_divulgacao.jpg" alt="" title="Fortaleza – Conjunto Fotografia Digital – Categoria 2"/>Denise Cristofoli</a>
                                            </div>
                                            <div class="media">
                                                <a href="img/fulls/25/GuilhermeGoes_Fortaleza-Digital1_divulgacao.jpg"><img src="img/thumbs/25/GuilhermeGoes_Fortaleza-Digital1_divulgacao.jpg" alt="" title="Fortaleza – Conjunto Fotografia Digital – Categoria 1"/>Guilherme Goes</a>
                                            </div>

                                            <?php
                                            $iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
                                            $ipad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad");
                                            $android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
                                            $palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
                                            $berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
                                            $ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
                                            $symbian =  strpos($_SERVER['HTTP_USER_AGENT'],"Symbian");

                                            if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian == true){

                                            } else {
                                            ?>

                                            <div class="media">
                                                <a href="img/fulls/25/JuanAlonso_Novos_cartoes_postais_divulgacao.jpg"><img src="img/thumbs/25/JuanAlonso_Novos_cartoes_postais_divulgacao.jpg" alt="" title="Novos Cartões Postais – Conjunto Fotografia Digital" />Juan Alonso</a>
                                            </div>

                                            <div class="media">
                                                <a href="img/fulls/25/PaulaMichels_A_cidade_vista_do_morro-Digital1_divulgacao.jpg"><img src="img/thumbs/25/PaulaMichels_A_cidade_vista_do_morro-Digital1_divulgacao.jpg" alt="" title="A Cidade Vista do Morro – Conjunto Fotografia Digital – Categoria 1" />Paula Michel</a>
                                            </div>

                                            <div class="media">
                                                <a href="img/fulls/25/SandraKraus_novos_cartoes_postais-Digital1_divulgacao.jpg"><img src="img/thumbs/25/SandraKraus_novos_cartoes_postais-Digital1_divulgacao.jpg" alt="" title="Cartões Postais – Conjunto Fotografia Digital – Categoria 1" />Sandra Kraus</a>
                                            </div>

                                            <div class="media">
                                                <a href="img/fulls/25/VerissimoSilva_Cabelo_cabeleira_Premio_Infantojuvenil_divulgacao.jpg"><img src="img/thumbs/25/VerissimoSilva_Cabelo_cabeleira_Premio_Infantojuvenil_divulgacao.jpg" alt="" title="Cabelo Cabeleira - Prêmio Conjunto Modalidade Infantojuvenil"/>Verissimo Silva</a>
                                            </div>
                                        </div>

                                        <footer>
                                            <h2><a href="pdf/catalogo_maratona_25.pdf">Catálogo da 25ª Maratona Fotográfica de Florianópolis</a></h2>
                                            <h1><!--Vem aí a-->26ª Maratona Fotográfica de Florianópolis!</h1>
                                            <!--<h3>Nessa edição teremos uma nova modalidade!</h3>
                                            <h3>Em breve você poderá se inscrever!</h3>
                                            <h3>Venha participar, se divertir e curtir mais uma edição.</h3>-->
                                            <h3 style="font-style:italic;">*Em virtude da proibição da realização de eventos de grande público na cidade de Florianópolis devido a atual situação do Covid 19, causada pelo Coronavírus, através do Decreto N. 21.340, de 13 de março/2020, informamos que a 26ª Maratona Fotográfica não tem data definida para sua realização.</h3>
                                        </footer>
                                        <?php }; ?>
                                    </div>
                                </div>
                            </div>
						</section>


					

					<!-- Footer -->
						<footer id="footer">
							<div align="center">

						
								<?php 
									$iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
											$ipad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad");
											$android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
											$palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
											$berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
											$ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
											$symbian =  strpos($_SERVER['HTTP_USER_AGENT'],"Symbian");

											if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian == true){
												echo '<div class="gallery">
														<div class="content">
															<div class="media">
																<img  src="img/2.png" />
															</div>
														</div>
													   </div>';
											}else{
												echo '<div class="galleryy">
														<div class="content">
															<div class="media">
																<img  src="img/2.png" />
															</div>
														</div>
													   </div>';
											};
											
											?>

							</div>
						</footer>
				</section>
		</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.poptrox.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>