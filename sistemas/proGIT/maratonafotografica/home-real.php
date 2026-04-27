<?php
// header("location: http://www.pmf.sc.gov.br");

print "<br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
<h1>Estamos em manutenção.</h1>";

die();
$datas = date('Ymd'); 
// ?>
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
												echo '<img  src="img/thumbs/28/logoMaratonaBranca.png" width="250" height="250"/><br><br>
												<ul class="actions">
													 <li><a href="#incricao" class="button alt scrolly big">Inscreva-se</a></li>
                                                </ul>
                                                <p class="autor">Foto: Davi Costa Sena Garcia</p>';
											}else{
												echo '<img  src="img/thumbs/28/logoMaratonaBranca.png" width="350" height="350"/><br><br>
												<ul class="actions">
													 <li><a href="#contact" class="button alt scrolly big">Inscreva-se</a></li>
                                                </ul>
                                                <p class="autor2">Foto: Davi Costa Sena Garcia</p>';
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
                                    <div class="input">
                                        <span data-year="25" data-info="25º Edição"></span>
                                    </div>
                                    <div class="input">
                                        <span data-year="26" data-info="26º Edição"></span>
                                    </div>
                                    <div class="input active">
                                        <span data-year="27" data-info="27º Edição"></span>
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
                                        </footer>
                                        <?php }; ?>
                                    </div>

                                    <div class="gallery">
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
                                        </footer>
                                        <?php }; ?>
                                    </div>

                                    <div class="gallery">
                                        <div class="content">
                                            <div class="media">
                                                <a href="img/fulls/26/juan.jpg"><img src="img/thumbs/26/juan.jpg" alt="" title="Sujeito e Patrim&ocirc;nio - Pr&ecirc;mio Conjunto Modalidade Anal&oacute;gica"/>Juan Ratera Alonso</a>
                                            </div>
                                            <div class="media">
                                                <a href="img/fulls/26/camila_rodolfo.jpg"><img src="img/thumbs/26/camila_rodolfo.jpg" alt="" title="Olhar Perif&eacute;rico - 1&#186; Pr&ecirc;mio Conjunto Modalidade Digital I"/>Camila Machado Rodolfo</a>
                                            </div>
                                            <div class="media">
                                                <a href="img/fulls/26/adriano_assis.jpg"><img src="img/thumbs/26/adriano_assis.jpg" alt="" title="Apontando Para o Futuro - 2&#186; Pr&ecirc;mio Conjunto Modalidade Digital I"/>Adriano Jos&eacute; Assis</a>
                                            </div>                                            
                                            <div class="media">
                                                <a href="img/fulls/26/guilherme pedroso.jpeg"><img src="img/thumbs/26/guilherme pedroso.jpeg" alt="" title="Apontando Para o Futuro - 1&#186; Pr&ecirc;mio Conjunto Modalidade Digital II"/>Guilherme Pedroso</a>
                                            </div>
                                            <div class="media">
                                                <a href="img/fulls/26/Andressa_Pszybilski.jpg"><img src="img/thumbs/26/Andressa_Pszybilski.jpg" alt="" title="Revelando Territ&oacute;rios - 1&#186; Pr&ecirc;mio Conjunto Modalidade Digital Mobile"/>Andressa Lenz Pszybilki</a>
                                            </div>
                                            <div class="media">
                                                <a href="img/fulls/26/ana_maria_de_araujo.jpg"><img src="img/thumbs/26/ana_maria_de_araujo.jpg" alt="" title="Hist&oacute;ria  e Tradi&ccedil;&atilde;o - 1&#186; Pr&ecirc;mio Conjunto Modalidade Infantojuvenil "/>Ana Maria Broering de Ara&uacute;jo</a>
                                            </div>
                                            <div class="media">
                                                <a href="img/fulls/26/elizangela_bortoluzzi.jpg"><img src="img/thumbs/26/elizangela_bortoluzzi.jpg" alt="" title="Novos e Velhos Contornos - Melhores Fotos Modalidade Mobile"/>Elizangela Bortoluzzi</a>
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
                                        </div>
                                        <footer>
                                            <h2><a href="pdf/catalogo_digital_26_maratona_fotografica.pdf" target="_blank">Catálogo da 26ª Maratona Fotográfica de Florianópolis</a></h2>
                                        </footer>
                                        <?php }; ?>
                                    </div>                 
                                    
                                    <div class="gallery active">
                                        <div class="content">
                                            <div class="media">
                                                <a href="img/fulls/27/juan_ratera.jpg"><img src="img/thumbs/27/juan_ratera.jpg" alt="" title="É o vento - Pr&ecirc;mio Conjunto Modalidade Anal&oacute;gica"/>Juan Ratera Alonso</a>
                                            </div>
                                            <div class="media">
                                                <a href="img/fulls/27/catarina_arrieche.jpg"><img src="img/thumbs/27/catarina_arrieche.jpg" alt="" title="Heranças culturais - 1º Prêmio Conjunto  Modalidade Mobile"/>Catarina Arrieche Scarduelli</a>
                                            </div>
                                            <div class="media">
                                                <a href="img/fulls/27/erik_bayer.jpg"><img src="img/thumbs/27/erik_bayer.jpg" alt="" title="Brincando com a imaginação - Prêmio Conjunto  Modalidade Inafntojuvenil 06 a 09 anos"/>Erik Iervolino Bayer</a>
                                            </div>
                                            <div class="media">
                                                <a href="img/fulls/27/eduardo_fernando.jpg"><img src="img/thumbs/27/eduardo_fernando.jpg" alt="" title="É o vento - Prêmio Melhores Fotografias"/>Eduardo Fernando Teixeira</a>
                                            </div>
                                            <div class="media">
                                                <a href="img/fulls/27/davi_costa_sena.jpg"><img src="img/thumbs/27/davi_costa_sena.jpg" alt="" title="Sensação divertida infanto - Prêmio Melhores Fotografias"/>Davi Costa Sena Garcia</a>
                                            </div>
                                            <div class="media">
                                                <a href="img/fulls/27/marcelo_bittencourt.jpg"><img src="img/thumbs/27/marcelo_bittencourt.jpg" alt="" title="Expressões singulares - Prêmio Melhores Fotografias"/>Marcelo Bittencourt Linhares</a>
                                            </div>
                                            <div class="media">
                                                <a href="img/fulls/27/bruna_araujo.jpg"><img src="img/thumbs/27/bruna_araujo.jpg" alt="" title="Natureza poética - 1º Prêmio Conjunto  Modalidade Digital 1"/>Bruna de Araújo Dechen</a>
                                            </div>
                                            <div class="media">
                                                <a href="img/fulls/27/camila_machado.jpg"><img src="img/thumbs/27/camila_machado.jpg" alt="" title="Natureza poética - 2º Prêmio Conjunto  Modalidade Digital 1"/>Camila Machado Rodolfo</a>
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
                                        </div>
                                        <footer>
                                            <h2><a href="pdf/catalogo_maratona_27.pdf" target="_blank">Catálogo da 27ª Maratona Fotográfica de Florianópolis</a></h2>
                                        </footer>
                                        <?php }; ?>
                                    </div>                    

                                </div>
                            </div>
						</section>


					<!-- Contact -->
						<section id="contact">
							<!-- Social -->
								<div class="social column">
									<h3>Sobre</h3>

									<p>A Maratona Fotográfica de Florianópolis teve sua primeira edição em 1995 e foi criada para integrar a programação alusiva às comemorações do aniversário da cidade, estimulando fotógrafos profissionais, amadores e o público infantojuvenil a registrar imagens da cidade, de forma criativa, movimentando a área da fotografia não apenas na capital catarinense, como no Estado e no Brasil. </p>

									<p>O concurso tem como objetivo estimular os participantes a olhar a cidade de maneira diferente, buscando perceber o que muitas vezes não é visto no dia a dia, permitindo a experimentação e a criação de diferentes imagens por meio da fotografia.</p> 
									 
                                    <p>Mantendo as características dos últimos anos, a edição contará mais uma vez com as modalidades Analógica e houve mudança na modalidade Digital, agora tem duas categorias - Digital Categoria Câmeras (câmeras com lentes intercambiáveis ou lentes fixas) e Digital Mobile (aparelhos celulares ou tablets)</p>
                                    
                                    <p>O público de 6 a 17 anos poderá se inscrever na modalidade Infantojuvenil, que é subdividida nas faixas etárias de 6 a 9 anos, 10 a 12 anos, 13 a 15 anos, 16 a 17 anos, e será permitido utilizar máquina fotográfica, aparelho celular ou tablet para os registros das imagens.</p>

									<p>O concurso é totalmente gratuito e ocorrerá nos dias <strong>12 e 13 de abril de 2025</strong>. Serão disponibilizadas <strong>500 vagas</strong>, distribuídas conforme Edital e Regulamento. </p>

									<p>As inscrições ocorrerão até <strong>04 de abril</strong> e as vagas serão preenchidas conforme recebimento das inscrições. Também serão reservadas vagas para inscrição no dia da abertura do concurso (sábado)</p>
                                    
                                    <p><strong>Leia o Regulamento e inscreva-se!</strong></p>

								</div>
								

							<!-- Form -->
							
								<div class="column" id="incricao">
									<!--<h3>INSCRIÇÕES PELO SITE ENCERRADAS</h3>

									<p><b>Aviso Importante: </b><br>
									Serão disponibilizadas inscrições no dia e no local da largada do concurso, dia 28/03 (sábado), das 9h às 14h, bem como as vagas remanescentes.
									Favor observar principalmente os artigos 4.7, 4.8, 4.9 e 4.10 do Edital de Inscrição e Regulamento.</p>-->

                                    <h3>Faça sua inscrição</h3>

                                    <p style="color: red;font-size:18px;"><strong>Os números das inscrições são gerados aleatóriamente!</strong></p>

									<p>Leia com atenção o regulamento antes de se inscrever.</p>

										
									<div align="center"><a target="_blank" href="pdf/regulamento28pronto.pdf" class="button big">Regulamento</a><br><br><br></div>

                                    <p>O público de 6 a 17 anos poderá se inscrever na modalidade Infantojuvenil, que é subdividida nas faixas etárias de 6 a 9 anos, 10 a 12 anos, 13 a 15 anos, 16 a 17 anos, e será permitido utilizar máquina fotográfica, aparelho celular ou tablet para os registros das imagens.</p>

                                            <!-- Botão inscrição-->     
                                                <div align="center"><a target="_blank" href="infantoJuvenil-adm.php" class="button big">Infantojuvenil</a><br><br><br></div>
                                            <!-- Botão mesma página-->  
                                                <!-- <div align="center"><a href="http://www.pmf.sc.gov.br/sistemas/maratonafotografica/home-real.php" class="button big">Infantojuvenil</a><br><br><br></div> -->
                                    
                                    <p>Analógica, Digital Categoria 1 (câmeras com lentes intercambiáveis), Digital Categoria 2 (câmeras com lentes fixas) e Mobile (celular e tablet) para participantes adultos.</p>

                                    <!-- <p style="color: red;font-size:14px;"><strong>Todas as vagas para a modalidade analógica foram preenchidas.</strong></p> -->
                                     
                                            <!-- Botão inscrição-->     
                                                <div align="center"><a target="_blank" href="filmeEdigital-adm.php" class="button big">Analógica e Digital</a><br><br><br></div>
                                            <!-- Botão mesma página-->  
                                                <!-- <div align="center"><a href="http://www.pmf.sc.gov.br/sistemas/maratonafotografica/home-real.php" class="button big">Analógica e Digital</a><br><br><br></div> -->
                                    

								</div>
							
						</section>

						<section id="contact">
							<div align="center" style=" margin-top: 50px;">
							<h3>Prezado(a) inscrito(a) na 28ª Maratona Fotográfica de Florianópolis!</h3>
						<p>A Secretaria Municipal de Turismo, Cultura e Esporte junto com a Fundação Cultural de Florianópolis Franklin Cascaes agradecem pelo interesse em participar da 28ª Maratona Fotográfica de Florianópolis.</p>
						<p>Lembramos que é obrigatória a entrega do Termo de Responsabilidade, no dia da largada da Maratona Fotográfica, dia 12 de abril (sábado), das 9h às 12h, em local sinalizado no Largo da Alfândega, onde ocorrerá também a abertura e largada do concurso.</p>
						<p>Neste mesmo dia e local será retirado o Pen Drive ou rolo de filme. </p>
						<p>OBS: Caso o Termo não tenha sido gerado, favor baixar o modelo no link: <a target="_blank" href="pdf/Termo_incriçao_adulto2024.pdf" class="button">Analógica e Digital</a> ou <a target="_blank" href="pdf/Termo_inscriçao_infantojuvenil2024.pdf" class="button">Infantojuvenil</a></p>
						<p>Att. a organização</p>
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
            <script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());

		  gtag('config', 'UA-54979843-1');
		</script>

	</body>
</html>