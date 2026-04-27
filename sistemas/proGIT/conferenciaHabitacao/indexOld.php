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
	</head>
	<body>
		<div class="page-wrap">

			<nav id="nav">
				<ul>
					<li><a href="index.php"><span class="icon fa-home"></span></a></li>
					<li><a href="" class="active"><span class="icon fa-file-text-o"></span></a></li> 
					<li><a href="inscricaoConsulta.php" class="active"><span class="fa fa-search"></span></a></li> 
					<li><a href="http://www.pmf.sc.gov.br/arquivos/arquivos/pdf/18_10_2018_14.13.27.33c67d71c92544cef1ec2111ffb1f0aa.pdf" class="active"><span class="fa fa-file-pdf-o"></span></a></li>
					<li><a href="MINUTA_Regimento_Interno_COMHIS_FPOLIS.pdf" class="active"><span class="fa fa-file-pdf-o"></span></a></li>
				</ul>
			</nav>


 <?php 
 
	$iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
	$ipad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad");
	$android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
	$palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
	$berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
	$ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
	$symbian =  strpos($_SERVER['HTTP_USER_AGENT'],"Symbian");

	if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian == true){
		echo '<section id="main" >
					<section id="banner">
						<div class="inner">
							<h2>1ª Conferência Municipal de Habitação <br /> de Interesse Social</h2>
							  <ul class="actions">
								<li><a href="inscricao.php" class="button alt">Inscrições</a></li>
							 </ul>
					</div>
				</section>
			<section>';
	}else{
		echo '<section id="main" >
					<section id="banner">
						<div class="inner">
							<h2>1ª Conferência Municipal de Habitação <br /> de Interesse Social</h2>
							 <ul class="actions">
								<li><a href="http://www.pmf.sc.gov.br/arquivos/arquivos/pdf/18_10_2018_14.13.27.33c67d71c92544cef1ec2111ffb1f0aa.pdf" class="button alt scrolly big">Plano Municipal de Habitação de Interesse Social - PMHIS</a></li>
							 </ul>
							  <ul class="actions">
								<li><a href="inscricao.php" class="button alt scrolly big">Inscrições</a></li>
							 </ul>
					</div>
				</section>
			<section>';  };    ?>

				
	
							<div class="inner">
								<header>
									<h1>Comunicado</h1>
								</header>
						
						<h3>Prezados conferencistas!</h3>
						<br>

						<p>O Conselho Municipal de Habitação de Interesse Social (CMHIS), em sua 66ª Reunião Ordinária, realizada no dia 12/12/2018, enalteceu a participação dos 138 conferencistas presentes na solenidade de abertura da I Conferência Municipal de Habitação de Interesse Social. Na oportunidade, definiu que:</p>
						<li>A Consulta Pública para registrar demandas e proposições para o processo da I Conferência permanece aberta;</li>
						<li>As inscrições para participar da I Conferência serão reabertas quando da retomada dos trabalhos da Coordenação Geral;</li>
						<li>Quem já realizou a inscrição, permanece inscrito para as demais etapas da I Conferência;</li>
						<li>A Coordenação Geral da I Conferência retomará suas reuniões/atividades no início de fevereiro/2019.</li>
						<li>O novo cronograma da I Conferência será informado no site <a href="http://www.pmf.sc.gov.br/sistemas/conferenciaHabitacao">
						http://www.pmf.sc.gov.br/sistemas/conferenciaHabitacao</a> e no email dos conferencistas já inscritos, após aprovação do CMHIS;</li>

						<br>

						<p>Pedimos aos conferencistas e demais munícipes a apropriação do conteúdo do Plano Municipal de Habitação de Interesse Social, disponível no site <a href="http://www.pmf.sc.gov.br/sistemas/conferenciaHabitacao">http://www.pmf.sc.gov.br/sistemas/conferenciaHabitacao</a>, colaborando com o sucesso da nossa I Conferência Municipal de Habitação de Interesse Social</p>
						<p>	Para demais informações e esclarecimentos, a Secretaria executiva do CMHIS, localizada na Rua Tenente Silveira, nº 60 – 4º andar – Centro – Fpolis se coloca à disposição através do email <strong>conselhohabitacaofloripa@gmail.com e telefone 3251-6317.</strong></p>
						</p>
	
					
							</div>
	
							<br>
<!--
							<div class="inner">
								<header>
									<h1>Programação</h1>
									<h4>I ETAPA:</h4>
								</header>
									<h4>30/10 – Terça-feira – Auditório da ALESC:</h4>
									<li>18h00min – Credenciamento dos participantes; </li>
									<li>18h30min – Abertura da I Conferência;</li>
									<li>19h00min – Palestra de abertura – Prof. Arquiteto João Sette Whitaker;</li>
									<li>20h00min - Apresentação e aprovação do Regimento Interno da I Conferência Municipal de Habitação de Interesse Social;</li>
									<li>21h00min – Encerramento.</li>
									<br>
							</div>

							<div class="inner">
								<header>
									<h4>II ETAPA:</h4>
								</header>
								<p><strong>Plenárias Regionais:</strong></p>	
							<?php	if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian == true){
								echo '<li><strong>NORTE da Ilha - 06/11/2018 - 18h às 21h30min</strong> - Escola Jovem Jacó Ânderle – Rua Francisco Fausto Martins – Vargem Grande – ao lado do TICAN </li><br>
							<li><strong>Continente - 08/11/2018 - 18h às 21h30min</strong> - Biblioteca Pública Municipal Prof. Barreiros Filho - Rua João Evangelista da Costa, 1160 - Estreito</li><br>
							<li><strong>Sul/Leste da Ilha - 20/11/2018 - 18h às 21h30min</strong> - C. C. Fazenda Rio Tavares - Rodovia SC 405, Km 3, Nº 480, ao lado do TIRIO (Terminal do Rio Tavares) Fazenda do Rio Tavares. </li><br>
							<li><strong>Centro/Oeste da Ilha - 22/11/2018 - 18h às 21h30min</strong> - Centro de Educação Continuada – Rua Ferreira Lima, nº 82 – Centro</li><br>';
							}else{
								echo '<table>
										<thead>
										    <tr>
										      <th scope="col">REGIÃO</th>
										      <th scope="col">DIA</th>
										      <th scope="col">HORA</th>
										      <th scope="col">LOCAL</th>
										    </tr>
										</thead>
										<tbody>
									    <tr>
									      <th scope="row">Norte da Ilha</th>
									      <td>06/11/2018</td>
									      <td>18h às 21h30min</td>
									      <td>Escola Jovem Jacó Ânderle – Rua Francisco Fausto Martins – Vargem Grande – ao lado do TICAN</td>
									    </tr>
									    <tr>
									      <th scope="row">Continente</th>
									      <td>08/11/2018</td>
									      <td>18h às 21h30min</td>
									      <td>Biblioteca Pública Municipal Prof. Barreiros Filho - Rua João Evangelista da Costa, 1160 - Estreito</td>
									    </tr>
									    <tr>
									      <th scope="row">Sul/Leste da Ilha</th>
									      <td>20/11/2018</td>
									      <td>18h às 21h30min</td>
									      <td>C. C. Fazenda Rio Tavares - Rodovia SC 405, Km 3, Nº 480, ao lado do TIRIO (Terminal do Rio Tavares) Fazenda do Rio Tavares</td>
									    </tr>
									    <tr>
									      <th scope="row">Centro/Oeste da Ilha</th>
									      <td>22/11/2018</td>
									      <td>18h às 21h30min</td>
									      <td>Centro de Educação Continuada – Rua Ferreira Lima, nº 82 – Centro</td>
									    </tr>
									  </tbody>
									</table>';  };    ?>
									
									<br>
									<p><strong>Programação das Plenárias:</strong></p>	
									<li>18h00min – Recepção e Credenciamento dos participantes;</li>
									<li>18h30min – Apresentação da programação da I COMHIS Florianópolis e das Plenárias Regionais e resumo do Regimento Interno;</li>
									<li>18h40min – Palestra I: Histórico da Habitação de Interesse Social e da Política Habitacional de Florianópolis; </li>
									<li>19h00min - Palestra II: Apresentação do Plano Municipal de Habitação de Interesse Social relativo à área de abrangência regional - Cibele Assmann Lorenzi</li>
									<li>19h30min – Experiência local; </li>
									<li>19h45min - Apresentação das demandas indicadas na Consulta Pública e levantamento das demandas e propostas das comunidades;</li>
									<li>20h30min – Discussão das proposições apresentadas e dos indicativos para a etapa da Plenária Final;</li>
									<li>21h30min – Encerramento.</li>			
							</div>

							<div class="inner">
								<header>
									<h4>III ETAPA:</h4>
								</header>
								
								<h4>08/12 – Sábado - Auditório do SENAC: </h4>	
									<li>09h00min – Credenciamento dos Delegados e Participantes;</li>
									<li>09h30min – Abertura e composição da mesa;</li>
									<li>09h40min – Apresentação da programação da I COMHIS Florianópolis e resumo do Regimento Interno;</li>

									<p><strong>Painéis:</strong></p>
									<li>10h00min – 1º Painel: Política Nacional de Habitação de Interesse Social – Arq. Ângelo Arruda;</li>
									<li>10h20min – 2º Painel: Regularização Fundiária – Promotor Dr. Paulo Locatelli (a confirmar);</li>
									<li>10h40min – 3º Painel: Política de HIS de Florianópolis – Engº. Rogério Miranda; </li>
									<li>11h00min – 4º Painel: Processo participativo/Gestão democrática – Sr. Modesto Azevedo;</li>
									<li>11h20min – 5º Painel: Apresentação de experiência não governamental: Comunidade Ponta do Leal;</li>
									<li>11h40min – Debate;</li>		
									<li>12h30min – Intervalo (Saída para o almoço - SESC);</li>	
									<li>13h20min – Atividade de Integração – SESC;</li>
									<li>13h30min – Apresentação das proposições e apontamento de destaques;</li>
									<li>14h40min - Discussão e votação dos destaques;</li>
									<li>16h00min – Coffe Break;</li>
									<li>16h30min - Votação de hierarquização das Proposições;</li>
									<li>17h00min – Apresentação e votação das Moções;</li>
									<li>18h00min - Encerramento da I Conferência Municipal de Habitação de Interesse Social de Florianópolis.</li>
							</div>


-->
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