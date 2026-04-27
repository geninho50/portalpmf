<!DOCTYPE HTML>

<html>
	<head>
		<title>Minhoca na Cabeça</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body class="subpage">

		<!-- Header -->
			<header id="header" >
				<div class="logo"></div>
				<div class="logo"><a href="residuometro.html">RESIDUÔMETRO</a></div>
				<a href="#menu">Menu</a>
			</header>

		<!-- Nav -->
			<nav id="menu">
				<ul class="links">
					<li><a href="index.html">Home</a></li>
					<li><a href="passo.html">Inscreva-se</a></li>
					<li><a href="areaAviso.html">Área do Participante</a></li>
				</ul>
			</nav>

		<!-- One -->
			<section id="One" class="wrapper style3">
				<div class="inner">
					<header class="align-center">
					<p>responsabilidades do participante</p>
						<h2>TERMO DE COMPROMISSO</h2>
					</header>
				</div>
			</section>

		<!-- Main -->
			<div id="main" class="container">
			<input type="hidden" id="contadorCheck" value=0>
				<!-- Elements -->
					<h2 id="elements">Para participar do projeto Minhoca na Cabeça é preciso concordar com as condições que seguem. Clique quando a resposta for SIM:</h2>
					<br><br>						
								<form id="formIndex" name="formIndex" method="post" action="#">
									<div class="row uniform">
										<div class="6u 12u$(small)">
											<input type="checkbox" id="1" name="1" onclick="contagemCheck(this);">
											<label for="1">Participar da oficina de capacitação no dia selecionado no momento da inscrição.</label>
										</div>
										<div class="6u$ 12u$(small)">
											<input type="checkbox" id="2" name="2" onclick="contagemCheck(this);">
											<label for="2">Informar com antecedência de dois dias (48 horas) caso não possa participar da oficina de capacitação, no campo indicado no site do projeto Minhoca na Cabeça.</label>
										</div>
										<div class="6u 12u$(small)">
											<input type="checkbox" id="3" name="3" onclick="contagemCheck(this);">
											<label for="3">Utilizar o kit (caixas e minhocas) recebidos no dia da oficina de capacitação exclusivamente para o seu objetivo que é o tratamento domiciliar dos resíduos orgânicos.</label>
										</div>
										<div class="6u$ 12u$(small)">
											<input type="checkbox" id="4" name="4" onclick="contagemCheck(this);">
											<label for="4">Assinar termo de recebimento do kit (caixas e minhocas) ao final da oficina de capacitação.</label>
										</div>
										<div class="6u 12u$(small)">
											<input type="checkbox" id="5" name="5" onclick="contagemCheck(this);">
											<label for="5">Participar do sistema de monitoramento do projeto Minhoca na Cabeça com informações relativas às quantidades tratadas, por meio de campo indicado no site do projeto Minhoca na Cabeça.</label>
										</div>
										<div class="6u$ 12u$(small)">
											<input type="checkbox" id="6" name="6" onclick="contagemCheck(this);">
											<label for="6">Devolver o kit ao projeto Minhoca na Cabeça caso não se adapte ao tratamento domiciliar dos resíduos orgânicos ou por algum outro motivo, A devolução deverá ser solicitada no campo indicado no site do projeto Minhoca na Cabeça, para que a Prefeitura de Florianópolis possa providenciar sua retirada.</label>
										</div>
										<!-- Break -->
									</div>
									<br>
									<br>
									<br>
									<br>


				<div class="row uniform">
					<div class="6u 12u$(small)">
						<h2>Escolha um horário para participar</h2>
						<div class="table-wrapper">
							<h3>Janeiro - 2018</h3>
							<table class="alt">
								<thead>
									<tr>
										<th>Data</th>
										<th>Dia da semana</th>
										<th>Turno - horário</th>
									</tr>
								</thead>
								<tbody>
								<?
								
								
								?>
								<!--	<tr>
										<td><input  type="radio" id="of1" value="1" name="curso" ><label for="of1">16/01</label></td>
										<td>Terça</td>
										<td>Vespertino – 14h</td>
									</tr>-->
									<tr>
										<td><input  type="radio" id="of2" value="2" name="curso" disabled="true" /><label id="lbof2" for="of2">20/01</label></td>
										<td>Sábado</td>
										<td>Vespertino – 14h</td>	
									</tr>
									<tr>
										<td><input  type="radio" id="of3" value="3" name="curso" disabled="true"  /><label id="lbof3"  for="of3">23/01</label></td>
										<td>Terça</td>
										<td>Matutino – 9h</td>
									</tr>
									<tr>
										<td><input  type="radio" id="of4" value="4" name="curso"  disabled="true" /><label id="lbof4" for="of4">27/01</label></td>
										<td>Sábado</td>
										<td>Matutino - 9h</td>
									</tr>
									<tr>
										<td><input  type="radio" id="of5" value="5" name="curso" disabled="true"  /><label  id="lbof5" for="of5">30/01</label></td>
										<td>Terça</td>
										<td>Vespertino - 14h</td>
									</tr>
									<!--
									<tr>
										<td>Total das Oficinas</td>
										<td>05</td>
									</tr>
									<tr>
										<td>N° de Kits</td>
										<td>125</td>
									</tr>
									<tr>
										<td>N° de Participantes</td>
										<td>125</td>
									</tr>
									-->
								</tbody>
							</table>
						</div>
					</div>
					<div class="6u 12u$(small)">
						<h2>-</h2>
						<div class="table-wrapper">
							<h3>Fevereiro - 2018</h3>
							<table class="alt">
								<thead>
									<tr>
										<th>Data</th>
										<th>Dia da semana</th>
										<th>Turno - horário</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><input  type="radio" id="of13" value="6" name="curso" disabled="true"  /><label id="lbof13" for="of13">03/02</label></td>
										<td>Sábado</td>
										<td>Matutino – 9h</td>
									</tr>
									<tr>
										<td><input  type="radio" id="of14" value="7" name="curso" disabled="true"  /><label id="lbof14" for="of14">06/02</label></td>
										<td>Terça</td>
										<td>Vespertino – 14h</td>
									</tr>
									<tr>
										<td><input  type="radio" id="of15" value="8" name="curso" disabled="true"  /><label id="lbof15" for="of15">17/02</label></td>
										<td>Sábado</td>
										<td>Vespertino – 14h</td>
									</tr>
									<tr>
										<td><input  type="radio" id="of16" value="9" name="curso" disabled="true"  /><label id="lbof16" for="of16">20/02</label></td>
										<td>Terça</td>
										<td>Matutino - 9h</td>
									</tr>
									<tr>
										<td><input  type="radio" id="of17" value="10" name="curso" disabled="true"  /><label id="lbof17" for="of17">24/02</label></td>
										<td>Sábado</td>
										<td>Matutino - 9h</td>
									</tr>
									<tr>
										<td><input  type="radio" id="of18" value="11" name="curso"  disabled="true"  /><label   id="lbof18" for="of18">27/02</label></td>
										<td>Terça</td>
										<td>Vespertino – 14h</td>
									</tr>
									<!--
									<tr>
										<td>Total das Oficinas</td>
										<td>06</td>
									</tr>
									<tr>
										<td>N° de Kits</td>
										<td>150</td>
									</tr>
									<tr>
										<td>N° de Participantes</td>
										<td>150</td>
									</tr>
                                    -->
								</tbody>
							</table>
						</div>
					</div>


					<div class="6u 12u$(small)">
						<h2>-</h2>
						<div class="table-wrapper">
							<h3>Março - 2018</h3>
							<table class="alt">
								<thead>
									<tr>
										<th>Data</th>
										<th>Dia da semana</th>
										<th>Turno - horário</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><input  type="radio" id="of6" value="12" name="curso" disabled="true"  /><label id="lbof6" for="of6">03/03</label></td>
										<td>Sábado</td>
										<td>Matutino – 9h</td>
									</tr>
									<tr>
										<td><input  type="radio" id="of7" value="13" name="curso" disabled="true"  /><label  id="lbof7" for="of7">06/03</label></td>
										<td>Terça</td>
										<td>Matutino – 9h</td>
									</tr>
									<tr>
										<td><input  type="radio" id="of8" value="14" name="curso" disabled="true"  /><label  id="lbof8" for="of8">10/03</label></td>
										<td>Sábado</td>
										<td>Vespertino – 14h</td>
									</tr>
									<tr>
										<td><input  type="radio" id="of9" value="15" name="curso" disabled="true"  /><label  id="lbof9"  for="of9">13/03</label></td>
										<td>Terça</td>
										<td>Matutino – 9h</td>
									</tr>
									<tr>
										<td><input  type="radio" id="of10" value="16" name="curso" disabled="true"  /><label id="lbof10" for="of10">17/03</label></td>
										<td>Sábado</td>
										<td>Matutino – 9h</td>
									</tr>
									<tr>
										<td><input  type="radio" id="of11" value="17" name="curso" disabled="true"  /><label id="lbof11" for="of11">20/03</label></td>
										<td>Terça</td>
										<td>Vespertino – 14h</td>
									</tr>
									<tr>
										<td><input  type="radio" id="of12" value="18" name="curso"  disabled="true" /><label  id="lbof12" for="of12">24/03</label></td>
										<td>Sábado</td>
										<td>Vespertino – 14h</td>
									</tr>
									<tr>
										<td><input  type="radio" id="of19" value="19" name="curso"  disabled="true"  /><label   id="lbof19" for="of19">27/03</label></td>
										<td>Terça</td>
										<td>Matutino – 9h</td>
									</tr>
									<!--
									<tr>
										<td>Total das Oficinas</td>
										<td>08</td>
									</tr>
									<tr>
										<td>N° de Kits</td>
										<td>200</td>
									</tr>
									<tr>
										<td>N° de Participantes</td>
										<td>200</td>
									</tr>
									-->
								</tbody>
							</table>
						</div>
					</div>

					<div class="6u 12u$(small)">
						<h2>-</h2>
						<div class="table-wrapper">
							<h3>Abril - 2018</h3>
							<table class="alt">
								<thead>
									<tr>
										<th>Data</th>
										<th>Dia da semana</th>
										<th>Turno - horário</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><input  type="radio" id="of20" value="20" name="curso"  disabled="true"  /><label id="lbof20" for="of20">07/04</label></td>
										<td>Sábado</td>
										<td>Matutino – 9h</td>
									</tr>

									<tr>
										<td><input  type="radio" id="of1" value="1" name="curso"  disabled="true"  /><label id="lbof1" for="of1">10/04</label></td>
										<td>Terça</td>
										<td>Vespertino – 14h</td>
									</tr>
									<!--
									<tr>
										<td>Total das Oficinas</td>
										<td>01</td>
									</tr>
									<tr>
										<td>N° de Kits</td>
										<td>25</td>
									</tr>
									<tr>
										<td>N° de Participantes</td>
										<td>25</td>
									</tr>
                                    --> 
								</tbody>
							</table>
						</div>
					</div>


				</div>

								<!--	<div class="4u 12u$(xsmall)">
									<p>Escolha a data: <input type="text" id="calendario"/></p>
									</div>-->


										<div class="12u$">
											<ul class="actions">
												<li>INSCRICOES ENCERRADAS</li>
												<!--<li><input type="button" value="ACEITAR" onclick="proximo(1);"/></li>-->
												<li><input type="reset" value="CANCELAR" class="alt" onclick="proximo(2);"/></li>
											</ul>
										</div>
									</div>
								</form>
	

						</div>
					</div>

			</div>

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
			<script src="http://code.jquery.com/jquery-1.8.2.js"></script>
			<script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>
			<script type="text/javascript">
			
					// $(document).ready(function(){

					// });		
					$('input:radio').each(function () {
						
						var id = $(this).attr('id');
						
						var obj = {
							codigoTurma  : $(this).val()
						};
						
						obj = $( this ).serialize() + "&" + $.param( obj );
								  
						$.ajax({			
							   type: "POST",
							   url: "../banco/temVaga.php",
							   dataType: "json",
							   data: obj,
							   success: function ( data ) {
								  		
								  if( data['TEMVAGA'] == 0 ){								  
									  $( '#'+id ).attr('checked', false);
								      var label = $( '#lb'+id ).html();
								      $( '#lb'+id ).html( label + '<b> ( ESGOTADO )</b>' );
								  }else{
									  $( '#'+id ).prop("disabled", false );
								  }
								},
							   
							   error: function ( data ) {
								  console.log(data);
							   }
							
						});
					});					

					function proximo(passo){
						if(passo == 1 ){							
							if (document.getElementById("contadorCheck").value == "6" ) {
								if( document.formIndex.curso.value !='' ){
									document.getElementById("formIndex").action = "cadastro.php"; 
									document.getElementById("formIndex").submit(); 
								}else{
								   alert(" Escolha um horário para realizar o curso !");	
								}
							}else{
							   alert("Você não aceitou todos os itens do termo! ");
							}
						}else{
							document.getElementById("formIndex").action = "desistir.html";
							document.getElementById("formIndex").submit(); 
						}
					}

					function contagemCheck(obj){
						var contagem = parseInt( document.getElementById("contadorCheck").value );
						if(obj.checked){
							contagem += 1;   
						}else{
							contagem -= 1; 
						}
						document.getElementById("contadorCheck").value = contagem.toString();
					}
					
			</script>

	</body>
</html>