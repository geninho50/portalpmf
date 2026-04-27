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

		function gtag() {
			dataLayer.push(arguments);
		}
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
				<!--<li>
					<a href="inscricaoConsulta.php" class="active tooltip">
						<span class="fa fa-search"></span>
						<span class="tooltiptext">Consulta Pública</span>
					</a>
				</li>-->
				<li>
					<a href="pptx/APRESENTAÇÃO PMHIS CONFERENCIA 03 08 2019.pptx" class="active tooltip">
						<span class="fa fa-file-powerpoint-o"></span>
						<span class="tooltiptext">APRESENTAÇÃO DO PMHIS</span>
					</a>
				</li>
				<li>
					<a href="pptx/AVALIAÇÃO PROGRAMAS E METAS DO PMHIS 03 08 2019.pptx" class="active tooltip">
						<span class="fa fa-file-powerpoint-o"></span>
						<span class="tooltiptext">APRESENTAÇÃO DA AVALIAÇÃO DOS PROGRAMAS E METAS DO PMHIS</span>
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
		<section id="main">
			<section id="banner">

				<?php
				$iphone = strpos($_SERVER['HTTP_USER_AGENT'], "iPhone");
				$ipad = strpos($_SERVER['HTTP_USER_AGENT'], "iPad");
				$android = strpos($_SERVER['HTTP_USER_AGENT'], "Android");
				$palmpre = strpos($_SERVER['HTTP_USER_AGENT'], "webOS");
				$berry = strpos($_SERVER['HTTP_USER_AGENT'], "BlackBerry");
				$ipod = strpos($_SERVER['HTTP_USER_AGENT'], "iPod");
				$symbian =  strpos($_SERVER['HTTP_USER_AGENT'], "Symbian");

				if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian == true) {
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
							<!-- <li><a href="inscricao.php" class="button alt scrolly big">Inscrições</a></li> -->
						</ul>
					</div>
				<?php } ?>

			</section>
			<section>

				<div class="inner">
					<h3 align="center">Carta da 1ª Conferência Municipal de Habitação de Interesse Social</h3>

					<p>
						A 1ª Conferência Municipal de Habitação de Interesse Social de Florianópolis (I COMHIS Florianópolis) que teve por tema <strong>“Habitação e o Direito à Cidade no debate em Florianópolis”</strong>, foi realizada no período de 30 de outubro de 2018 a 14 de setembro de 2019, convocada pelo Conselho Municipal de Habitação de Interesse Social de Florianópolis (CMHIS), conforme Art. 11 da Lei Municipal 8210/2010, por meio dos seguintes decretos municipais:
					</p>
					<ul>
						<li>Decreto nº 19.054 de 18/10/2018, que convocou a I COMHIS Florianópolis para o período de 30/10 a 08/12/2018.</li>
						<li>Decreto nº 19.259 de 28/12/2018, o qual considerou as proposições advindas da Plenária de Abertura e apresentou alterações no cronograma das atividades e a impossibilidade de realizar as Plenárias Regionais e a Plenária Final da I COMHIS Florianópolis, suspendendo temporariamente os trabalhos.</li>
						<li>Decreto nº 20.523 de 24/07/2019 revogou o Decreto 19.259/2018 e convocou a I COMHIS Florianópolis para o período de 03/08 a 14/09/2019.</li>
					</ul>

				<div class="corpo">
					<p>
						O eventobuscou atender aos seguintes objetivos gerais: Popularizar o debate sobre as políticas públicas de acesso à moradia digna; Analisar o contexto habitacional de interesse social com base no diagnóstico contido no Plano Municipal de Habitação de Interesse Social(PMHIS)do Município; Propiciar a participação democrática dos diversos segmentos da sociedade para Formulação de proposições sobre a Política Municipal de Habitação de Interesse Social e Revisão do Plano Municipal de Habitação de Interesse Social; Sensibilizar e mobilizar a sociedade para os desafios da Habitação de Interesse Social a fim de estabelecer agendas, metas e planos sustentáveis; Consolidar a Conferência Municipal de Habitação de Interesse Social como instrumento de debate, deliberação, gestão democrática e de controle social da Política Municipal de Habitação de Interesse Social.
					</p>
					<p>
						Os trabalhos de planejamento, organização e acompanhamento da Conferência foram conduzidos pela Comissão Organizadora composta pelos conselheiros: Albertina da Silva, Angela Maria Liuti, Audenir Cursino de Carvalho, Carlos B. Leite, Leonardo Pessina, Telma de Oliveira Pitta; técnicos da Secretaria Municipal de Infraestrutura: o geógrafo Eduardo Zons Guidi, a arquiteta Juliana Hartmann Gomes e a assistente social Kelly Cristina Vieira; a secretária-executiva do CMHIS Paulina Korc e os trabalhos foram presididos pelo Superintendente de Habitação e Saneamento, engenheiro civil Fábio Ritzmann.
					</p>
					<p>
						A atividade de mobilização comunitária para chamar e sensibilizar os munícipes para adesão e participação dos debates foi realizada pelos membros do Conselho Municipal de Habitação de Interesse Social, técnicos da Diretoria de Habitação/Superintendência de Habitação e Saneamento/PMF e parceiros da sociedade civil, através das mídias eletrônicas e redes sociais, cartazes, reuniões com diversos grupos, dentre outras formas de divulgação. A relatoria da Conferência ficou sob a responsabilidade de Angela Maria Liuti, Eduardo Zons Guidi, Juliana Hartmann Gomes, Leonardo Pessina e Telma de Oliveira Pitta (coordenadora), tendo como colaboradoras: Maria Aparecida N. Catarina, Michaeli F. G. Martendal e Simone Lolatto.
					</p>
					<p>
						A Conferência foi realizada em três etapas: Etapa de Abertura(30/10/2018 e 03/08/2019);EtapadasPlenáriasRegionais(13/08/2019–Região Centro/Oeste da Ilha; 15/08/2019–Região Continental; 20/08/2019–Região Norte da Ilha; 22/08/2019 eRegião Sul da Ilha) e Etapa da Plenária Final(14/09/2019), totalizando sete oportunidades para discussão, avaliação e construção da política habitacional de interesse social que se pretende para Florianópolis.
					</p>
					<p>
						No decorrer da 1ª Conferência, quatrocentase oitenta e seis (486) pessoas participaram, tendo em média noventa (90) conferencistas por plenária regional. De acordo com as exigências do Regimento Interno da Conferência, trezentos e dez (310) conferencistas se habilitaram como Delegados à Etapa Final. A Plenária Final teve a presença de cento e noventa e sete (197) conferencistas, sendocento e quarenta e um (141) destes habilitados como Delegados.
					</p>
					<p>
						Na Etapa de Abertura em 30/10/2018,após Palestra proferida pelo Professor João Whitaker, deu-se a apresentação e aprovação do Regimento Interno, quando foram apontados os seguintes destaques: necessidade da apresentação do PMHIS em seu enfoque municipal antes das plenárias regionais; necessidade da apresentação da avaliação das metas e ações do PMHIS; intensificar a mobilização e sensibilização com ênfase no movimento social organizado. Na oportunidade, foi aprovada uma nova programação, posteriormenteanalisada pela Comissão Organizadora e avaliada como inexequível, sendo suspensa temporariamente a Conferência.
					</p>
					<p>
						Em 2019, seguindo novo calendário e programação elaborados pela Comissão Organizadora e devidamente aprovados pelo plenário do CMHIS, as atividades da 1ª COMHIS Florianópolis foram retomadas a partir da reabertura da Conferência, realizada no dia 03/08/2019 no Auditório do SENAC da Prainha. Naquelaoportunidade, o arquiteto João Maria Lopes fez um breve relato histórico da Habitação de Interesse Social e da Política Habitacional em Florianópolis. Na sequência João Luiz de Oliveira –Gão, líder comunitário, explanou sobre a Experiência da Comunidade da Ponta do Leal; Juliana Hartmann Gomes, arquiteta da Secretaria Municipal de Infraestrutura realizou a apresentação do Plano Municipal de Habitação de Interesse Social e Kelly Cristina Vieira, assistente social também da SMI, a avaliação dos programas e metas do PMHIS, sendo finalizada esta etapa com o momento da Palavra Aberta a todos os presentes.
					</p>
					<p>
						A II Etapa da Conferência foi realizada em Plenárias Regionais, com o objetivo de apresentar o PMHIS relativo à área de abrangência regional, tendo sido realizadapelos técnicos da Diretoria de Habitação, Arquiteta JulianaHartmann Gomes e Geógrafo Eduardo Zons Guidi, sendo todas presididas pelo Presidente do CMHIS Engenheiro CivilFábio Ritzmann. Em cada Plenária houve também o depoimento sobre a experiência local acerca da política de habitação de interesse social em suas comunidades, assim apresentadas: região central por Sulimar Alves Vargas relatando a experiência do Projeto do PAC Maciço do Morro da Cruz; na região continental Antônio Joel de Paula com os trabalhos para implantação do Projeto Habitar Brasil BID nas comunidades daregiãoChico Mendes; senhor Nivaldo Araújo da Silva enquanto representante da regional norte, apresentou o histórico de lutas, avanços e desafios para a comunidade da Vila do Arvoredo e na região sul da ilha o senhor Ivan Borges relembrou o processo de organização comunitária nasAreias do Campeche. Após os relatos das experiências, seguia-se a apresentação das demandas indicadas por região na Consulta Pública, realizada pela Assistente Social Kelly Cristina Vieira e, posteriormente, levantamento das demais demandas e propostas das comunidades a partir do debate de proposições e indicativos que seriam remetidos para a etapa da Plenária Final.
					</p>
					<p>
						A III Etapa deu-se no dia 14 de setembro de 2019, no Auditório do Instituto Estadual de Educação, sob apresidência dos trabalhos deFábio Ritzmanne com acolaboração da Coordenadora da Comissão de Relatoria Telma de Oliveira Pitta e do Facilitador Alexandre Francisco Böck, todas as proposições apresentadas na Consulta Pública e nas Plenárias Regionais foram lidas na Plenária Final, uma a uma, para manifestação dos Delegados por sua aprovação, rejeição ou ajuste no texto, estando assim aprovadas para o processo de hierarquização. Em seguida, aberto processo de votação para a hierarquização das noventa (90) proposições, de forma individualizada e com registro em cédulas especificas, cada Delegado pode distribuir um máximo de cem pontos entre as propostas de sua preferência.Foram aprovadas e hierarquizadas setenta e quatro (74) proposições, conforme tabela abaixo. Finalizando a Conferência, foram lidas e aprovadas quatro (4) moções abaixo transcritas.
					</p>
					<p>
						A apuração dos votos foi conduzida por representantes da Comissão Organizadora da Conferência e representantes escolhidos na plenária com esta finalidade. Os trabalhos foram iniciados na tarde do dia 14/09/2019, logo após o encerramento da Plenária. Contudo, devido ao grande volume de trabalho,dada a necessidade de contagem manual dos votos, os trabalhos foram interrompidos e retomados pela mesma equipe na tarde do dia 16/09/2019, na sala de reuniões da Superintendência de Saneamento e Habitação, Secretaria Municipal de Infraestrutura na Rua Tenente Silveiranº 60, até sua total apuração e encerramento dos trabalhos.
					</p>
					<p>
						As propostas a seguir são o resultado da hierarquizaçãoconforme a sistemática de votação prevista no Regimento Interno da I COMHIS Florianópolisocorrida na Plenária Finalem14 de setembrode 2019e configuram o posicionamento dos conferencistaspresentesnas etapas da Conferência. Para formalizar essas proposiçõesemProgramas de Ações e Metas na revisão do PMHIS, as mesmas passarão por análise técnica e jurídica,assegurando sua aplicabilidade elegalidade,bem como o atendimento aos Princípios, Objetivos e Diretrizes do Plano.
					</p>
				</div>

				<h3>Quadro de propostas hierarquizadas</h3>

				<div class="imagens">
					<img src="images/tabela1.png" alt="Tabela">
					<img src="images/tabela2.png" alt="Tabela">
					<img src="images/tabela3.png" alt="Tabela">
					<img src="images/tabela4.png" alt="Tabela">
					<img src="images/tabela5.png" alt="Tabela">
					<img src="images/tabela6.png" alt="Tabela">
					<img src="images/tabela7.png" alt="Tabela">
					<img src="images/tabela8.png" alt="Tabela">
					<img src="images/tabela9.png" alt="Tabela">
					<img src="images/tabela10.png" alt="Tabela">
					<img src="images/tabela11.png" alt="Tabela">
					<img src="images/tabela12.png" alt="Tabela">
				</div>

				<div class="corpo">
					<p>
					As propostas abaixo foram apresentadas nas plenárias regionais, porém foram retiradas pelos respectivos autores na Plenária Final.
					</p>
				</div>

					<h3>Propostas Excluídas</h3>

				<div class="imagens">
					<img src="images/tabela13.png" alt="Tabela">
				</div>

				<div class="corpo">
					<p>
					Não obstante a desobediência ao regimento interno no tocante a ausência de leitura integral das redações finais das moções, o não cumprimento do rito regimental previamente estabelecido e comprometida a aprovação na Plenária Final da Conferência, ocorrida em 14 de setembro, seguem as moções apresentadas nesta plenária, mantendo o compromisso com a divulgação dos trabalhos de forma ética e transparente.	
					</p>
				</div>

				<h3>Moções</h3>

				
				<img src="images/tabela14.png" alt="Tabela">
				<img src="images/tabela15.png" alt="Tabela">

				

				<div class="paragrafo">
					<p><b>Conselho Municipal de Habitação de Interesse Social <br>
					Rua Tenente Silveira, N° 60 - 4º andar - Centro - Florianópolis/SC <br>
					E-mail: conselhohabitacaofloripa@gmail.com <br>
					Telefone: (48) 3251-6317</b></p>
				</div>



				
									

					<!-- <div class="inner">	
						<h3 align="center">Prezados/as Conferencistas,</h3>

						<p>
							A Comissão Organizadora da 1ª Conferência Municipal de Habitação de Interesse Social informa sobre a III Etapa - Plenária Final:
						</p>
						<p>
							<h4>1.  LISTA DOS(AS) DELEGADOS(AS) PARA A PLENÁRIA FINAL:</h4>
						<a href = "pdf/DELEGADOS PARA SITE.pdf" target="_blank">Disponível aqui</a> <br>

						Conforme Art. 15 e 16 do Regimento Interno da Conferência, todos os DELEGADOS(AS), tem direito a voz e a voto na Plenária Final.
						</p>
						

						<p>
							<h4>2.  ALTERAÇÃO DO LOCAL DA PLENÁRIA FINAL:</h4>
							Considerando o grande número de DELEGADOS(AS), a Plenária final será realizada:
							<br>
							<b style="color: #FF0007">DIA:14 de setembro de 2019 - SÁBADO
							<br>
							HORA: Início às 8h30min
							<br>
							LOCAL: Auditório do IEE (Instituto Estadual de Educação)
							<br>
              				Av. Mauro Ramos, nº 275 – Centro – Florianópolis/SC.
              				</b>
						</p>

						<p>
							<h4>3.  PROPOSIÇÕES APRESENTADAS:</h4>

						Segue a relação de todas as proposições que serão hierarquizadas pelos DELEGADOS(AS) na Plenária Final.
						<br>
						<a href = "pdf/PROPOSTAS  RELATORIA FINAL.pdf" target="_blank">Disponível aqui</a> 
						<br>
						A votação se dará da seguinte forma:
						<br>
						<b>Art. 32</b> – Cada DELEGADO receberá uma cédula para votação e o Coordenador concederá 15 minutos para que todos delegados presentes entreguem suas cédulas de votação na urna.
						<br>
						<b>§ 1º</b> – Cada DELEGADO terá cem (100) pontos para distribuir dentre todas as proposições em votação na Plenária Final, para fins de hierarquização das propostas;
						<br>
						<b>§ 2º</b> – Cada DELEGADO poderá aplicar no máximo 10 pontos em cada proposta de sua cédula de votação;
						<br>
						<b>§ 3º</b> – As cédulas que apresentarem mais que 100 pontos totalizados, serão automaticamente anuladas;
						<br>
						<b>§ 4º</b> – As aprovações serão realizadas por maioria simples e somente os DELEGADOS terão direito a voto.
						</p>

						<p>
						<h4 style="color:#546228">LEMBRETES:</h4>
						1)    Solicitamos a todos que levem COPO ou CANECA para uso próprio. A natureza agradece!
						<br>
						2)    O IEE não dispõe de estacionamento.
						<br>
						3)    Solicitamos aos DELEGADOS(AS) que levem a caneta para usar na votação.
						<br><br>
						Para demais informações e esclarecimentos, a Secretaria executiva do CMHIS, localizada na Rua Tenente Silveira, nº 60 – 4º andar – Centro – Florianópolis se coloca à disposição através do email conselhohabitacaofloripa@gmail.com e telefone 3251-6317.
						</p>
						
						
						<h4 align = "center">III ETAPA:</h4>
	                    <h4 align = "center">PLENÁRIA FINAL</h4>
	          			<p>
	                    <br>
						<b>08h30min</b> – Credenciamento dos Delegados e Participantes;<br>
						<b>09h00min</b> – Abertura e composição da mesa;<br>
						<b>09h15min</b> – Apresentação da programação da I COMHIS Florianópolis e resumo do Regimento Interno;<br>
						<b>09h30min</b> – Apresentação das proposições e apontamento de destaques;<br>
						<b>10h30min</b> – Discussão e votação dos destaques;<br>
						<b>11h10min</b> – Votação de hierarquização das Proposições;<br>
						<b>11h50min</b> – Apresentação e votação das Moções<br>						
						<b>12h20min</b> – Encerramento da I Conferência Municipal de Habitação de Interesse Social de Florianópolis.<br>
						</p> -->

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