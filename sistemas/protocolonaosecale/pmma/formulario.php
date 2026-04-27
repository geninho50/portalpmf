<!DOCTYPE HTML>

<html>
	<head>
		<title>PMMA</title>
		<meta charset="utf-8" />
		<link rel="shortcut icon" href="icon.png" type="image/png">
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body class="is-preload">

		<!-- Header -->
			<header id="header">
				<a class="logo" href="index.html"><img src="images/logo.png" width="10%"></a>
				<nav>
					<a href="#menu">Menu</a>
				</nav>
			</header>

		<!-- Nav -->
			<nav id="menu">
				<ul class="links">
					<li><a href="index.html">Início</a></li>
					<li><a href="mata.html">Mata Atlântica</a></li>
					<li><a href="pmma.html">O que é o PMMA?</a></li>
					<li><a href="objetivos.html">Objetivos do PMMA</a></li>
					<li><a href="grupo.html">Grupo de Trabalho</a></li>
					<li><a href="processo.html">Processo Participativo</a></li>
					<li><a href="resultados.html">Resultados Parciais</a></li>
					<li><a href="formulario.php">Questionário</a></li>
					<li><a href="contato.html">Contato</a></li>
				</ul>
			</nav>

		<!-- Heading -->
			<div id="heading" >
				<h1>Participe</h1>
			</div>

		<!-- Main -->
			<section id="main" class="wrapper">
				<div class="inner">
					<div class="content">
						<p>Esta pesquisa auxilia o poder público a mobilizar atores e se inteirar sobre o conhecimento que a população possui das questões ambientais do município, evidenciando a opinião pública sobre o tema.
						O objetivo principal é identificar indivíduos e instituições que tem interesse em colaborar com a elaboração do Plano Municipal de Conservação e Recuperação da Mata Atlântica (PMMA), bem como obter uma percepção inicial da população sobre o assunto.
						Convidamos você para participar deste processo!
						Sua percepção sobre sua cidade contribuirá para que, juntos, possamos direcionar políticas públicas e ações que atendam às necessidades locais e regionais, promovendo a melhoria da qualidade de vida para todos.
						A pesquisa ficará no ar por 30 dias.</p>


	<h3>1) Identificação</h3>

	<form id="frm1" name="frm1">
		<div class="row gtr-uniform">
	       <div class="col-12">
				<label for="p1">P1. Qual a sua escolaridade (último ano concluído)?</label>
				    <select class="form-control" id="p1" name="p1">
				      <option value="Fundamental I/Primário">Fundamental I/Primário</option>
				      <option value="Fundamental II/Ginásio">Fundamental II/Ginásio</option>
				      <option value="Médio/Colegial">Médio/Colegial</option>
				      <option value="Superior">Superior</option>
				      <option value="Pós-graduação">Pós-graduação</option>
				    </select>
			</div>

	       <div class="col-12">
		  	 <label>P2. Qual a sua idade?</label><input type="text" name="p2" id="p2" value="" placeholder="Idade" />
	      	</div>

		    <div class="col-12">
			  	<label>P3. Qual o seu sexo?</label>
				  	<select name="p3" id="p3">
					    <option value="Feminino">Feminino</option>
					    <option value="Masculino">Masculino</option>
					    <option value="Não quero responder">Não quero responder</option>
					</select>
		    </div>


			<div class="col-md-12"><label>P4. Em que município você mora?</label>
			    <select class="form-control" id="situacao" name="situacao" onchange="ativacaoDiv(this);">
			      <option value="Florianópolis">Florianópolis</option>
			      <option value="Grande Florianópolis">Grande Florianópolis</option>
			    </select>
			</div>


	 			<div class="col-12" >
				  	 <label for="bairro" style="display: block;">P5. Em que distrito/bairro você mora?</label>
				  	 <select class="form-control" id="bairro" name="bairro">
				      <option value="Abraão">Abraão</option>
				      <option value="Agronômica">Agronômica</option>
				      <option value="Balneário">Balneário</option>
				      <option value="Barra da Lagoa">Barra da Lagoa</option>
				      <option value="Bom Abrigo">Bom Abrigo</option>
				      <option value="Cachoeira do Bom Jesus">Cachoeira do Bom Jesus</option>
				      <option value="Campeche">Campeche</option>
				      <option value="Canasvieiras">Canasvieiras</option>
				      <option value="Canto">Canto</option>
				      <option value="Capoeiras">Capoeiras</option>
				      <option value="Carvoeira">Carvoeira</option>
				      <option value="Centro">Centro</option>
				      <option value="Coloninha">Coloninha</option>
				      <option value="Coqueiros">Coqueiros</option>
				      <option value="Córrego Grande">Córrego Grande</option>
				      <option value="Costeira do Pirajubaé">Costeira do Pirajubaé</option>
				      <option value="Estreito">Estreito</option>
				      <option value="Ingleses do Rio Vermelho">Ingleses do Rio Vermelho</option>
				      <option value="Itacorubi">Itacorubi</option>
				      <option value="Itaguaçu">Itaguaçu</option>
				      <option value="Jardim Atlântico">Jardim Atlântico</option>
				      <option value="João Paulo">João Paulo</option>
				      <option value="José Mendes">José Mendes</option>
				      <option value="Lagoa da Conceição">Lagoa da Conceição</option>
				      <option value="Monte Cristo">Monte Cristo</option>
				      <option value="Monte Verde">Monte Verde</option>
				      <option value="Pantanal">Pantanal</option>
				      <option value="Pântano do Sul">Pântano do Sul</option>
				      <option value="Ratones">Ratones</option>
				      <option value="Ribeirão da Ilha">Ribeirão da Ilha</option>
				      <option value="Saco dos Limões">Saco dos Limões</option>
				      <option value="Saco Grande">Saco Grande</option>
				      <option value="Santa Mônica">Santa Mônica</option>
				      <option value="Santo Antônio de Lisboa">Santo Antônio de Lisboa</option>
				      <option value="São João do Rio Vermelho">São João do Rio Vermelho</option>
				      <option value="Trindade">Trindade</option>
				      <option value="Tapera da Base">Tapera da Base</option>
				    </select>
			    </div>


		    <div class="col-12">
			  	<label>P6. Você mora em:</label>
				  	 <select class="form-control" id="p6" name="p6">
					      <option value="Zona Rural">Zona Rural</option>
					      <option value="Zona Urbana">Zona Urbana</option>
					      <option value="Não sei/Não quero responder">Não sei / Não quero responder</option>
					 </select>
		    </div>


		    <div class="col-12">
			  	<label>P7. Qual grupo ou instituição você representa?</label>
				  	 <select id="p7" name="p7">
					      <option value="Não represento organização ou instituição/Sociedade Civil">Não represento organização ou instituição/Sociedade Civil</option>
					      <option value="Instituição de Ensino (pública ou privada)">Instituição de Ensino (pública ou privada)</option>
					      <option value="Associação Comunitária/de Moradores">Associação Comunitária/de Moradores</option>
					      <option value="ONG / Terceiro Setor">ONG / Terceiro Setor</option>
					      <option value="Grupo organizado da sociedade civil (voluntários, sindicatos, escoteiros, etc.)">Grupo organizado da sociedade civil (voluntários, sindicatos, escoteiros, etc.)</option>
					      <option value="Movimentos sociais (habitação, saúde, etc.)">Movimentos sociais (habitação, saúde, etc.)</option>
					      <option value="Instituição Religiosa">Instituição Religiosa</option>
					      <option value="Empresa privada">Empresa privada</option>
					      <option value="Unidades de Saúde (Ex: Programa/ Estratégia de Saúde da Família)">Unidades de Saúde (Ex: Programa/ Estratégia de Saúde da Família)</option>
					      <option value="Companhia de Saneamento do Município">Companhia de Saneamento do Município</option>
					      <option value="Outros Órgãos/Instituições Públicas (nível municipal, estadual ou federal)">Outros Órgãos/Instituições Públicas (nível municipal, estadual ou federal)</option>
					 </select>
		    </div>

		    <div class="col-12">
			  	<label>P8. Participou de algum conselho ligado ao meio ambiente de sua cidade?</label>
				  	 <select id="p8" name="p8">
					      <option value="Sim">Sim</option>
					      <option value="Não">Não</option>
					      <option value="Não quero responder">Não quero responder</option>
					 </select>
		    </div>
		
		    <div class="col-12">
				<p>Se você tem interesse em receber informações sobre o resultado desta pesquisa ou receber notícias sobre o Plano Municipal de Conservação e Recuperação da Mata Atlântica de Florianópolis, deixe seu e-mail:</p>
				<input style="background-color: white;" value="" id="email" name="email" type="text" placeholder="E-mail"/>
 			</div>
			<div class="col-12">
				  <input type="checkbox" id="receberEmailSim" name="receberEmailSim" value="sim" class="receberEmailSim" />
				  <label for="receberEmailSim">Se você acha que pode contribuir significativamente na elaboração do Plano Municipal da Mata Atlântica de Florianópolis e gostaria de participar ativamente e voluntariamente, marque esta opção e deixe seu e-mail no item anterior</label>
			</div>
			</div>

		<br><br><br>

		<div class="col-12">
		<h3>2) Sobre a água, responda:</h3>
		<br>
		    <div class="col-12">
				<label>1- A maioria das pessoas sabe que ao ocupar áreas próximas aos rios, podem passar por transtornos com enchentes. .</label>
					<select class="form-control" id="percepcao1" name="percepcao1">
					      <option value="Concordo totalmente">Concordo totalmente</option>
					      <option value="Concordo parcialmente">Concordo parcialmente</option>
					      <option value="Discordo">Discordo</option>
					      <option value="Não sei responder">Não sei responder</option>
					</select>
			</div><br>

			<div class="col-12">
				<label>2 - Os rios que passam pelo município têm suas margens preservadas com árvores.</label>
					<select class="form-control" id="percepcao2" name="percepcao2">
					      <option value="Concordo totalmente">Concordo totalmente</option>
					      <option value="Concordo parcialmente">Concordo parcialmente</option>
					      <option value="Discordo">Discordo</option>
					      <option value="Não sei responder">Não sei responder</option>
					</select>
			</div><br>


		    <div class="col-12">
				<label>3 - A maioria das pessoas sabe para onde vai o esgoto de suas casas.</label>
					<select class="form-control" id="percepcao3" name="percepcao3">
					      <option value="Concordo totalmente">Concordo totalmente</option>
					      <option value="Concordo parcialmente">Concordo parcialmente</option>
					      <option value="Discordo">Discordo</option>
					      <option value="Não sei responder">Não sei responder</option>
					</select>
			</div><br>
			
			<div class="col-12">
				<label>4 - A maioria das pessoas sabe de onde vem a água de suas casas.</label>
					<select class="form-control" id="percepcao4" name="percepcao4">
					      <option value="Concordo totalmente">Concordo totalmente</option>
					      <option value="Concordo parcialmente">Concordo parcialmente</option>
					      <option value="Discordo">Discordo</option>
					      <option value="Não sei responder">Não sei responder</option>
					</select>
			</div><br>

		    <div class="col-12">
				<label>5 - Nosso município está livre de problemas causados pelas cheias dos rios (enchentes). </label>
					<select class="form-control" id="percepcao5" name="percepcao5">
					      <option value="Concordo totalmente">Concordo totalmente</option>
					      <option value="Concordo parcialmente">Concordo parcialmente</option>
					      <option value="Discordo">Discordo</option>
					      <option value="Não sei responder">Não sei responder</option>
					</select>
			</div><br>

			<div class="col-12">
				<label>6 - A conservação da Mata Atlântica pode reduzir a poluição dos rios, já que a vegetação funciona como um “filtro” para os poluentes que chegam a eles.</label>
					<select class="form-control" id="percepcao6" name="percepcao6">
					      <option value="Concordo totalmente">Concordo totalmente</option>
					      <option value="Concordo parcialmente">Concordo parcialmente</option>
					      <option value="Discordo">Discordo</option>
					      <option value="Não sei responder">Não sei responder</option>
					</select>
			</div><br>

		    <div class="col-12">
				<label>7 - A conservação da Mata Atlântica pode reduzir os riscos e prejuízos causados por enchentes.</label>
					<select class="form-control" id="percepcao7" name="percepcao7">
					      <option value="Concordo totalmente">Concordo totalmente</option>
					      <option value="Concordo parcialmente">Concordo parcialmente</option>
					      <option value="Discordo">Discordo</option>
					      <option value="Não sei responder">Não sei responder</option>
					</select>
			</div><br>
<br><br>

		<div class="col-12">
		<h3>3) PERCEPÇÃO AMBIENTAL SOBRE O TEMA:</h3>
		<br><br>
		<h5 align="center"><strong>“COMO ESTAMOS CUIDANDO DO AMBIENTE?”</strong></h5>
		<br>
		<p> A seguir há algumas afirmativas sobre questões ambientais diversas, implicadas na conservação ou degradação da Mata Atlântica. Por favor, responda se você “concorda totalmente”, “concorda parcialmente” ou “discorda” de cada uma delas.<br />
		Ao responder, pense no município de Florianópolis, nas pessoas que você conhece, no bairro em que você mora.</p>
		</div>
		<br><br>

		<h5>1. O que as fotos abaixo lhe dizem?</h5>

		<div class="row gtr-uniform">
		    <div class="col-6">
				<img src="images/questionario1.jpg" width="100%">
			</div>
			<div class="col-6">
				<img src="images/questinario2.jpg" width="97%">
			</div>


		    <div class="col-12">
				<label>1- A foto 1 representa uma paisagem de Mata Atlântica conservada.</label>
					<select class="form-control" id="percepcao8" name="percepcao8">
					      <option value="Concordo totalmente">Concordo totalmente</option>
					      <option value="Concordo parcialmente">Concordo parcialmente</option>
					      <option value="Discordo">Discordo</option>
					      <option value="Não sei responder">Não sei responder</option>
					</select>
			</div>

			<div class="col-12">
				<label>2 - A Mata Atlântica da foto 1 oferece benefícios à vida.</label>
					<select class="form-control" id="percepcao9" name="percepcao9">
					      <option value="Concordo totalmente">Concordo totalmente</option>
					      <option value="Concordo parcialmente">Concordo parcialmente</option>
					      <option value="Discordo">Discordo</option>
					      <option value="Não sei responder">Não sei responder</option>
					</select>
			</div>


		    <div class="col-12">
				<label>3 - Nas encostas e topos de morro a manutenção da vegetação nativa evita que, em períodos de chuvas fortes, as camadas superficiais do solo deslizem, atingindo moradias da região, além do leito de rios e nascentes, prejudicando-os.</label>
					<select class="form-control" id="percepcao10" name="percepcao10">
					      <option value="Concordo totalmente">Concordo totalmente</option>
					      <option value="Concordo parcialmente">Concordo parcialmente</option>
					      <option value="Discordo">Discordo</option>
					      <option value="Não sei responder">Não sei responder</option>
					</select>
			</div>
			<div class="col-12">
				<label>4 - Nos topos de morros, em geral, encontram-se as matas mais preservadas.</label>
					<select class="form-control" id="percepcao11" name="percepcao11">
					      <option value="Concordo totalmente">Concordo totalmente</option>
					      <option value="Concordo parcialmente">Concordo parcialmente</option>
					      <option value="Discordo">Discordo</option>
					      <option value="Não sei responder">Não sei responder</option>
					</select>
			</div>

		    <div class="col-12">
				<label>5 - A foto 2 demonstra como o desmatamento da vegetação nativa e a ocupação irregular desordenada podem gerar riscos aos moradores.</label>
					<select class="form-control" id="percepcao12" name="percepcao12">
					      <option value="Concordo totalmente">Concordo totalmente</option>
					      <option value="Concordo parcialmente">Concordo parcialmente</option>
					      <option value="Discordo">Discordo</option>
					      <option value="Não sei responder">Não sei responder</option>
					</select>
			</div>

			<div class="col-12">
				<label>6 - Áreas de alta declividade são consideradas de preservação permanente (APP) não apenas pelos seus atributos naturais, mas porque oferecem riscos ao entorno, se alteradas.</label>
					<select class="form-control" id="percepcao13" name="percepcao13">
					      <option value="Concordo totalmente">Concordo totalmente</option>
					      <option value="Concordo parcialmente">Concordo parcialmente</option>
					      <option value="Discordo">Discordo</option>
					      <option value="Não sei responder">Não sei responder</option>
					</select>
			</div>

		    <div class="col-12">
				<label>7 - O planejamento da ocupação, em uma cidade, é muito importante.</label>
					<select class="form-control" id="percepcao14" name="percepcao14">
					      <option value="Concordo totalmente">Concordo totalmente</option>
					      <option value="Concordo parcialmente">Concordo parcialmente</option>
					      <option value="Discordo">Discordo</option>
					      <option value="Não sei responder">Não sei responder</option>
					</select>
			</div>

			<div class="col-12">
				<label>8 - Deve ser planejada a conservação das áreas de Mata Atlântica que não podem ser ocupadas.</label>
					<select class="form-control" id="percepcao15" name="percepcao15">
					      <option value="Concordo totalmente">Concordo totalmente</option>
					      <option value="Concordo parcialmente">Concordo parcialmente</option>
					      <option value="Discordo">Discordo</option>
					      <option value="Não sei responder">Não sei responder</option>
					</select>
			</div>

	</div>

	<br><br>
<!--

	<h3>3) Marque as alternativas que você considera que seriam mais importantes para compor os objetivos do PMMA <strong>(você pode selecionar até 10 alternativas)</strong>:</h3>

	<div class="col-4 col-12-small">
		<input type="checkbox" id="checkbox-1" name="objetivosPMMA[]"  value="obj1 " />
		<label for="checkbox-1">Manter e melhorar a qualidade da água no município, garantindo as áreas de mananciais (rios, nascentes, lagoas, córregos, banhados, águas subterrâneas etc.)</label>
	</div>
	<div class="col-4 col-12-small">
		<input type="checkbox" id="checkbox-2" name="objetivosPMMA[]"  value="obj2 " />
		<label for="checkbox-2">Criar e fortalecer faixas de vegetação que interligam áreas de mata nativa (corredores ecológicos), facilitando a circulação da fauna e a preservação da flora.</label>
	</div>
	<div class="col-4 col-12-small">
		<input type="checkbox" id="checkbox-3" name="objetivosPMMA[]" value="obj3 " />
		<label for="checkbox-3">Conservar e recuperar ecossistemas costeiros (manguezais, restingas, praias, dunas, costões, estuários)</label>
	</div>
	<div class="col-4 col-12-small">
		<input type="checkbox" id="checkbox-4" name="objetivosPMMA[]" value="obj4 " />
		<label for="checkbox-4">Avaliar áreas propícias para criação de parques e reservas naturais (unidades de conservação), melhorando a qualidade de vida no município</label>
	</div>
	<div class="col-4 col-12-small">
		<input type="checkbox" id="checkbox-5" name="objetivosPMMA[]" value="obj5 " />
		<label for="checkbox-5">Mapear, identificar, proteger e recuperar áreas de preservação permanente</label>
	</div>
	<div class="col-4 col-12-small">
		<input type="checkbox" id="checkbox-6" name="objetivosPMMA[]" value="obj6 " />
		<label for="checkbox-6">Contribuir na implementação e revisões do Plano Diretor Municipal</label>
	</div>
	<div class="col-4 col-12-small">
		<input type="checkbox" id="checkbox-7" name="objetivosPMMA[]" value="obj7 " />
		<label for="checkbox-7">Ampliar e estruturar as áreas verdes urbanas (parques urbanos, áreas verdes de lazer, praças etc.)</label>
	</div>
	<div class="col-4 col-12-small">
		<input type="checkbox" id="checkbox-8" name="objetivosPMMA[]" value="obj8 " />
		<label for="checkbox-8">Diminuir os impactos da expansão urbana em áreas de Mata Atlântica</label>
	</div>
	<div class="col-4 col-12-small">
		<input type="checkbox" id="checkbox-9" name="objetivosPMMA[]" value="obj9 " />
		<label for="checkbox-9">Fortalecer a produção e disseminação de mudas nativas</label>
	</div>
	<div class="col-4 col-12-small">
		<input type="checkbox" id="checkbox-10" name="objetivosPMMA[]" value="obj10 " />
		<label for="checkbox-10">Fortalecer as práticas agrícolas de baixo impacto (agroecologia, permacultura, agricultura orgânica, roça de susbsistência)</label>
	</div>
	<div class="col-4 col-12-small">
		<input type="checkbox" id="checkbox-11" name="objetivosPMMA[]" value="obj11 " />
		<label for="checkbox-11">Fortalecer e valorizar comunidades tradicionais e relações sustentáveis com a Mata Atlântica</label>
	</div>
	<div class="col-4 col-12-small">
		<input type="checkbox" id="checkbox-12" name="objetivosPMMA[]" value="obj12 " />
		<label for="checkbox-12">Fortalecer o turismo sustentável</label>
	</div>
	<div class="col-4 col-12-small">
		<input type="checkbox" id="checkbox-13" name="objetivosPMMA[]" value="obj13 " />
		<label for="checkbox-13">Ampliar a arborização urbana (áreas públicas e privadas) com espécies nativas da região</label>
	</div>
	<div class="col-4 col-12-small">
		<input type="checkbox" id="checkbox-14" name="objetivosPMMA[]" value="obj14 " />
		<label for="checkbox-14">Ajudar os moradores do município a se adaptarem à mudança do clima</label>
	</div>
	<div class="col-4 col-12-small">
		<input type="checkbox" id="checkbox-15" name="objetivosPMMA[]" value="obj15 " />
		<label for="checkbox-15">Apoiar e incentivar pesquisas e práticas educativas relacionadas Mata Atlântica</label>
	</div>
	<div class="col-4 col-12-small">
		<input type="checkbox" id="checkbox-16" name="objetivosPMMA[]" value="obj16 " />
		<label for="checkbox-16">Promover o controle e substituição de espécies exóticas no município</label>
	</div>
	<div class="col-4 col-12-small">
		<input type="checkbox" id="checkbox-17" name="objetivosPMMA[]" value="obj17 " />
		<label for="checkbox-17">Interagir com os municípios vizinhos, ou em âmbito regional (como por exemplo, Comitê de Bacia Hidrográfica), na implantação de corredores ecológicos.</label>
	</div>
-->

		<br>

		<div class="col-12">
			<ul class="actions">
				<li><button type="button" class="btn btn-primary btn-lg" onclick="salvar();" class="primary">Salvar</button></li>
			</ul>
		</div>

			</form>	
		</div>
	</div>
</section>

		<!-- Footer -->
			<footer id="footer">
				<div class="inner" align="center" style="background-color: white">
					<a href="http://www.pmf.sc.gov.br"><img src="images/logo_rodape.jpg" width="80%" align="center"></a>
				</div>
			</footer>
</body>
		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
			<script type="text/javascript" src="../Biblioteca/js/validadores.js"></script>  


			<script type="text/javascript">

			function ativacaoDiv(obj){

				if(obj.value=='Florianópolis'){
					document.getElementById('bairro').style.display = "block";
					} else {
					document.getElementById('bairro').style.display = "none";
					}
			}

		
			function salvar(){

		/*	var $objetivosPMMA = $("#frm1 input[name='objetivosPMMA[]']:checked");		
			var objetivosPMMAChecked = '';

			if( $objetivosPMMA.length != 0 ){
		
		    $objetivosPMMA.each( function(){
			   objetivosPMMAChecked += $(this).val() + ", ";
			});

			}

			if( $objetivosPMMA.length > 10 ){
		    alert("Informe somente 10 Objetivos!");
		    err = 'Tem';
		    $("#frm1 input[name='objetivosPMMA[]']").focus();
			}*/
				 if ( $('#p1').val() == '') {
					alert('Responda a pergunta P1.');
					$('#p1').focus();
				}else if ( $('#p2').val() == '') {
					alert('Responda a pergunta P2.');
					$('#p2').focus();
				}else{
					$('#error').addClass('hide');
					var err = '';

					var obj = {
						p1     			: $('#p1').val(),
						p2          	: $('#p2').val(),
						p3          	: $('#p3').val(),
						situacao    	: $('#situacao').val(),
						bairro      	: $('#bairro').val(),	
						p6          	: $('#p6').val(),
						p7				: $('#p7').val(),
						p8				: $('#p8').val(),
						email			: $('#email').val(),
						receberEmailSim	: $('.receberEmailSim:checked').val(),
						percepcao1		: $('#percepcao1').val(),
						percepcao2		: $('#percepcao2').val(),
						percepcao3		: $('#percepcao3').val(),
						percepcao4		: $('#percepcao4').val(),
						percepcao5		: $('#percepcao5').val(),
						percepcao6		: $('#percepcao6').val(),
						percepcao7		: $('#percepcao7').val(),
						percepcao8		: $('#percepcao8').val(),
						percepcao9		: $('#percepcao9').val(),
						percepcao10		: $('#percepcao10').val(),
						percepcao11		: $('#percepcao11').val(),
						percepcao12		: $('#percepcao12').val(),
						percepcao13		: $('#percepcao13').val(),
						percepcao14		: $('#percepcao14').val(),
						percepcao15		: $('#percepcao15').val()



						/*objetivosPMMA   : objetivosPMMAChecked */

					};
		            
					$.ajax({			
						   type: "POST",
						   url: "../banco/cadastrarPMMA.php",
						   dataType: "json",
						   data: obj,
						   success: function ( data ) {
						   	console.log(data);
							   if( data['success'] == 1  ){
								   alert("Participação enviada com SUCESSO.");
								   location.href = "index.html";						  
								   $('#p1').val('');
								   $('#p2').val('');
								   $('#p3').val('');
								   $('#situacao').val('');
								   $('#bairro').val('');
								   $('#p6').val('');
								   $('#p7').val('');
								   $('#p8').val('');
								   $('#email').val('');
								   $('#receberEmailSim').val('');
								   $('#percepcao1').val('');
								   $('#percepcao2').val('');
								   $('#percepcao3').val('');
								   $('#percepcao4').val('');
								   $('#percepcao5').val('');
								   $('#percepcao6').val('');
								   $('#percepcao7').val('');
								   $('#percepcao8').val('');
								   $('#percepcao9').val('');
								   $('#percepcao10').val('');
								   $('#percepcao11').val('');
								   $('#percepcao12').val('');
								   $('#percepcao13').val('');
								   $('#percepcao14').val('');
								   $('#percepcao15').val('');
					   
								}else{
									   alert(data['error']);   
								   }
								  				   	
								},		

							   error: function ( data ) {
								   alert( data['error'] );
								   console.log(data);
							   }
						
					});

				}
			}

			</script>

	
</html>