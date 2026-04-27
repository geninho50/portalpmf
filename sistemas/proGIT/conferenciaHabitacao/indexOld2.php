<!DOCTYPE HTML>
<html>
	<head>
		<title>1ª Conferência Municipal de Habitação de Interesse Social</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link href="../../../layout/imagens/brasao.gif" rel="shortcut icon" type="image/x-icon" />
		<link rel="stylesheet" href="assets/css/main.css" />
	<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-54979843-1"></script>
		<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());

		  gtag('config', 'UA-54979843-1');
		</script>
		<style>
		.tooltip {
		  position: relative;
		  display: inline-block;
		  border-bottom: 1px dotted black;
		}

		.tooltip .tooltiptext {
		  visibility: hidden;
		  width: 240px;
		  background-color: black;
		  color: #fff;
		  text-align: center;
		  border-radius: 6px;
		  padding: 5px 0;

		  /* Position the tooltip */
		  position: absolute;
		  z-index: 1;
		}

		.tooltip:hover .tooltiptext {
		  visibility: visible;
		}
		</style>
	</head>
	<body>
		<div class="page-wrap">

			<nav id="nav">
				<ul>
					<li><a href="index.php"><span class="icon fa-home"></span></a></li>
					<!-- <li><a href="" class="active"><span class="icon fa-file-text-o"></span></a></li>  -->
					<li>
						<a href="inscricaoConsulta.php" class="active tooltip">
							<span class="fa fa-search"></span>
							<span class="tooltiptext">Consulta Pública</span>
						</a>
					</li> 
					<li>
						<a href="http://www.pmf.sc.gov.br/arquivos/arquivos/pdf/18_10_2018_14.13.27.33c67d71c92544cef1ec2111ffb1f0aa.pdf" class="active tooltip">
							<span class="fa fa-file-pdf-o"></span>
							<span class="tooltiptext">PMHIS</span>
						</a>
					</li>
					<li>
						<a href="pdf/MINUTA_Regimento_Interno_COMHIS_FPOLIS.pdf" class="active tooltip">
							<span class="fa fa-file-pdf-o"></span>
							<span class="tooltiptext">Regimento Interno aprovado em 30/10/2018 e atualizado pelo CMHIS em 18/07/2019</span>
						</a>
					</li>
					<li>
						<a href="videos/Palestra – Prof. Arquiteto João Sette Whitaker 30 10 2018.mp4" class="active tooltip">
							<span class="fa fa-file-video-o"></span>
							<span class="tooltiptext">Palestra – Prof. Arquiteto João Sette Whitaker - 30/10/2018</span>
						</a>
					</li>
				</ul>
			</nav>
			<section id="main" >
				<section id="banner">

<?php 
	$iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
	$ipad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad");
	$android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
	$palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
	$berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
	$ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
	$symbian =  strpos($_SERVER['HTTP_USER_AGENT'],"Symbian");

	if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian == true){
?>
					<div class="inner">
						<h2>1ª Conferência Municipal de Habitação <br /> de Interesse Social</h2>
						  <ul class="actions">
							<li><a href="inscricao.php" class="button alt">Inscrições</a></li>
						 </ul>
					</div>
<?php } else { ?>
					<div class="inner">
						<h2>1ª Conferência Municipal de Habitação <br /> de Interesse Social</h2>
						 <ul class="actions">
							<li><a href="http://www.pmf.sc.gov.br/arquivos/arquivos/pdf/18_10_2018_14.13.27.33c67d71c92544cef1ec2111ffb1f0aa.pdf" class="button alt scrolly big">Plano Municipal de Habitação de Interesse Social - PMHIS</a></li>
						 </ul>
						  <ul class="actions">
							<li><a href="inscricao.php" class="button alt scrolly big">Inscrições</a></li>
						 </ul>
					</div>		
<?php } ?>

				</section>
				<section>
					<div class="inner">	
						<p>
							O Conselho Municipal de Habitação de Interesse Social (CMHIS), em parceria com a Prefeitura Municipal de Florianópolis está retomando a <b>1ª Conferência Municipal de Habitação de Interesse Social de Florianópolis</b>.
							<br>
							O evento acontecerá entre os dias 03 de agosto e 14 de setembro de 2019, tendo como Tema: <b>Habitação e o direito à Cidade no debate em Florianópolis</b>. Lembramos que a solenidade de abertura foi realizada no dia 30/10/2018.
							<br>
							A Conferência possibilitará a participação dos diversos segmentos da sociedade no debate sobre as políticas públicas de direito à moradia digna. 
						</p>
						<p>
							<b>INSCRIÇÃO GRATUITA:</b> Pelo site <a href="http://www.pmf.sc.gov.br/sistemas/conferenciaHabitacao/inscricao.php">http://www.pmf.sc.gov.br/sistemas/conferenciaHabitacao/inscricao.php</a>, QR Code (no cartaz da Conferência) ou no dia do evento.
							<br>
							<b>Obs</b>. Quem fez inscrição em 2018 permanece inscrito.
						</p>
						<p>
							<b>DELEGADOS:</b> Serão considerados DELEGADOS(AS), com direito a voz e a voto na Plenária Final, os munícipes que participarem de uma Plenária Regional.
						</p>
						<p>
							<b>CONSULTA PÚBLICA:</b> Está disponível no site da Conferência a consulta pública <a href="http://www.pmf.sc.gov.br/sistemas/conferenciaHabitacao/inscricaoConsulta.php">http://www.pmf.sc.gov.br/sistemas/conferenciaHabitacao/inscricaoConsulta.php</a>; que tem por objetivo antecipar e sistematizar demandas e propostas das comunidades para o embasamento da primeira revisão do Plano Municipal de Habitação de Interesse Social, através das plenárias regionais. 
						</p>
						<p>
							<b>PLANO MUNICIPAL DE HABITAÇÃO DE INTERESSE SOCIAL:</b> Convidamos a todos que se apropriem do conteúdo do Plano Municipal de Habitação de Interesse Social, disponível no site <a href="http://www.pmf.sc.gov.br/sistemas/conferenciaHabitacao">http://www.pmf.sc.gov.br/sistemas/conferenciaHabitacao</a>, colaborando com o sucesso da 1ª Conferência Municipal de Habitação de Interesse Social.
						</p>
						<p>
							Para demais informações e esclarecimentos, a Secretaria executiva do CMHIS, localizada na Rua Tenente Silveira, nº 60 – 4º andar – Centro – Florianópolis se coloca à disposição através do email <a href="mailto:conselhohabitacaofloripa@gmail.com">conselhohabitacaofloripa@gmail.com</a> e telefone 3251-6317.
						</p>

						<h2>PROGRAMAÇÃO DA CONFERÊNCIA</h2>
						<div align="center">
							<b>
								I ETAPA:<br>
								Reabertura da I COMHIS Florianópolis<br>
								03/08/2019 – Sábado - Auditório do SENAC - Prainha<br>
								(Abertura realizada no dia 30/10/2018)
							</b>
						</div>
						<p>
							<b>08h30min</b> – Recepção e Credenciamento dos participantes; <br>
							<b>09h00min</b> – Apresentação da programação da I COMHIS Florianópolis e resumo do Regimento Interno;<br>
								<b style="margin-left:5em"><u>SIMPÓSIO:</u></b><br>
							<b>09h15min</b> – Histórico da Habitação de Interesse Social e da Política Habitacional de Florianópolis;<br>
							<b>10h00min</b> – Experiência não governamental – Comunidade Ponta do Leal;<br>
							<b>10h30min</b> – Apresentação do Plano Municipal de Habitação de Interesse Social;<br>
							<b>11h00min</b> – Apresentação da avaliação dos programas e metas do PMHIS;<br>
							<b>11h30min</b> – Palavra Aberta<br>
							<b>12h30min</b> – Encerramento.
						</p>
						<div align="center">
							<b>
								II ETAPA:<br>
								PLENÁRIAS REGIONAIS
							</b>
							<table>
								<tr>
									<td>
										<b>REGIÃO CENTRO/OESTE</b>
									</td>
									<td>
										<b>REGIÃO CONTINENTE</b>
									</td>
									<td>
										<b>REGIÃO NORTE</b>
									</td>
									<td>
										<b>REGIÃO SUL/LESTE</b>
									</td>
								</tr>
								<tr>
									<td>
										<b>13/08/2019<br>(3ª feira)</b>
									</td>
									<td>
										<b>15/08/2019<br>(5ª feira)</b>
									</td>
									<td>
										<b>20/08/2019<br>(3ª feira)</b>
									</td>
									<td>
										<b>22/08/2019<br>(5ª feira)</b>
									</td>
								</tr>
								<tr>
									<td>
										<b>Centro de Educação Continuada</b><br>Rua Ferreira Lima, nº 82 – Centro.
									</td>
									<td>
										<b>Escola Estadual Prof. Aníbal Nunes Pires</b><br>Rua Irmã Bonavita, nº 240 – Capoeiras
									</td>
									<td>
										<b>Escola Jovem Jacó Ânderle </b><br>Rua Francisco Fausto Martins – Vargem Grande – ao lado do TICAN
									</td>
									<td>
										<b>EEM Ver. Oscar Manoel da Conceição (Escola Jovem)</b><br>Rod. SC 405 – Fazenda do Rio Tavares, ao lado do TIRIO
									</td>
								</tr>
							</table>
						</div>
						<p>
							<b>18h30min</b> – Recepção e Credenciamento dos participantes;  <br>
							<b>18h50min</b> – Apresentação da programação da I COMHIS Florianópolis e resumo do Regimento Interno;<br>
							<b>19h00min</b> – Apresentação do Plano Municipal de Habitação de Interesse Social relativo à área de abrangência regional;<br>
							<b>19h30min</b> – Experiência local;<br>
							<b>19h45min</b> – Apresentação das demandas indicadas na Consulta Pública, levantamento das demandas e propostas das comunidades;<br>
							<b>20h30min</b> – Discussão das proposições apresentadas e dos indicativos para a etapa da Plenária Final;<br>
							<b>21h30min</b> – Encerramento.
						</p>
						<div align="center">
							<b>
								III ETAPA:<br>
								PLENÁRIA FINAL<br>
								14/09/2019 - Sábado - Auditório do SENAC - Prainha
							</b>
						</div>
						<p>
							<b>08h30min</b> – Credenciamento dos Delegados e Participantes;<br>
							<b>09h00min</b> – Abertura e composição da mesa;<br>
							<b>09h15min</b> – Apresentação da programação da I COMHIS Florianópolis e resumo do Regimento Interno;<br>
							<b>09h30min</b> – Apresentação das proposições e apontamento de destaques;<br>
							<b>10h30min</b> – Discussão e votação dos destaques;<br>
							<b>11h10min</b> – Votação de hierarquização das Proposições;<br>
							<b>11h50min</b> – Apresentação e votação das Moções;<br>
							<b>12h20min</b> – Encerramento da I Conferência Municipal de Habitação de Interesse Social de Florianópolis.
						</p>
					</div>
				</section>
				<!-- Footer -->
				<footer id="footer">
					<div class="copyright">
					<a href="http://www.pmf.sc.gov.br"><img src="images/Prefeitura.png"></a>		
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