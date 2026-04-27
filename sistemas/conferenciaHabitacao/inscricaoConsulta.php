<!DOCTYPE HTML>
<html>
	<head>
		<title>Seminário</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
		  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">


	</head>
	<body>
		<div class="page-wrap">

			<nav id="nav">
				<ul>
					<li><a href="index.php"><span class="icon fa-home"></span></a></li>
					<li><a href="inscricao.php" class="active"><span class="icon fa-file-text-o"></span></a></li>
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
							<h2 style="font-size: 20px;">1ª Conferência Municipal de Habitação <br /> de Interesse Social</h2>
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
							<!--	<li><a href="inscricao.php" class="button alt scrolly big">participar</a></li> -->
								<li><a href="http://www.pmf.sc.gov.br/arquivos/arquivos/pdf/18_10_2018_14.13.27.33c67d71c92544cef1ec2111ffb1f0aa.pdf" class="button alt scrolly big">Plano Municipal de Habitação de Interesse Social - PMHIS</a></li>
							 </ul>
							  <ul class="actions">
							<!--	<li><a href="inscricao.php" class="button alt scrolly big">participar</a></li> -->
								<li><a href="inscricao.php" class="button alt scrolly big">Inscrições</a></li>
							 </ul>
					</div>
				</section>
			<section>';  };    ?>


				<section>
					<div class="inner">
						<header>
							<h2>Consulta Pública</h2><br />
							<p>A consulta pública com o objetivo de antecipar e sistematizar demandas e propostas, leia o Plano Municipal de Habitação de Interesse Social e participe abaixo.</p>
							<p>* Todos os campos são obrigatórios.</p>
						</header>

						<div class="column">
							<form action="#" method="post" name="frm">
								<div class="row">
		        					<div class="col-md-4">
											<label>Nome completo:</label><input value="" id="nome" class="form-control" type="text"/>
											</div>
										<div class="col-md-2">
  											 <label>CPF:</label><input value="" id="cpf" class="form-control" type="text" onChange="validarCPF();"/>
										</div>
										<div class="col-md-3">
  											 <label>Email:</label><input value="" id="email" class="form-control" type="text" onChange="validarCPF();"/>
										</div>
										<div class="col-md-3">
											<label>Região:</label>
											<select id="regiao" name="regiao" class="form-control">
												<!--<option value="Norte da Ilha">Norte da Ilha</option>
												<option value="Sul/Leste da Ilha">Sul/Leste da Ilha</option>
												<option disabled="true" value="Centro/Oeste da Ilha">Centro/Oeste da Ilha</option>
												<option disabled="true" value="Continente">Continente</option>-->
											</select>
										</div>
								</div><br>

									<div class="row">
							           <div class="col-md-2"><label>CEP:</label><input value="" id="cep" name="cep" class="form-control" type="text"/>
											 <span>
								                <button class="btn btn-default" onclick="buscarCEP();" type="button">BUSCAR CEP</button>
								            </span>
							           </div>
							           <div class="col-md-3"><label>Endereço:</label><input value="" id="logradouro" name="logradouro" class="form-control" type="text"/></div>
							           <div class="col-md-1"><label>Número:</label><input value="" id="numero" name="numero" class="form-control" type="text"/></div>
							           <div class="col-md-2"><label>Complemento:</label><input value="" id="complemento" name="complemento" class="form-control" type="text"/></div>
							           <div class="col-md-2"><label>Bairro:</label><input value="" id="bairro" name="bairro" class="form-control" type="text"/></div>
							           <div class="col-md-2"><label>Cidade:</label><input value="Florianópolis" id="cidade" name="cidade" class="form-control" type="text" disabled="disabled"/>
							           </div>
							        </div>
							        <br>

									<div class="row">
										<div class="col-md-6">
											<label>Citar o problema/demanda (o que):</label><textarea value="" id="problema" class="form-control" type="text" cols="100" rows="5"></textarea>
										</div>
										<div class="col-md-6">
											<label>Sugestão de como resolver o problema:</label><textarea value="" id="sugestao" class="form-control" type="text" cols="100" rows="5"></textarea>
										</div>
									</div><br>

									<div class="row">
										<div class="col-md-6">
											<label>Justificativa (por que):</label><textarea value="" id="justificativa" class="form-control" type="text" cols="100" rows="5"></textarea>
										</div>
									</div>

										<ul class="actions">
											<li><input value="Enviar" class="button" type="button" onClick="salvar();"></li>
										</ul>
									</form>
								</div>
						</section>

					<!-- Footer -->
						<footer id="footer" style="background-color: #0D1217;">
							<div class="copyright">
							<a href="http://www.pmf.sc.gov.br"><img src="images/Prefeitura.png"></a>.
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

			<script type="text/javascript" src="../Biblioteca/js/validadores.js"></script>
			<script src="assets/js/jquery.min.js"></script>
  			<script src="assets/js/jquery.maskedinput.min.js" type="text/javascript"></script>

<script>

 $('#cpf').mask("999.999.999-99");
 $("#telefone").mask("(99) 99999999?9");

 function buscarCEP() {


				var cep = $("#cep").val().replace(/\D/g, '');

				if ( cep !== "" && $("#logradouro").val() === "" )  {

					 $("#btnCEP").val("Processando ...");

					var validacep = /^[0-9]{8}$/;

					if(validacep.test(cep)) {

						var urlCEP = "https://viacep.com.br/ws/" + cep + "/json/";
						$.ajax( {
							type: "POST",
							dataType: "jsonp",
							url: urlCEP,
							crossDomain: true,
							contentType:"application/json",
							success: function( dados )  {
								$("#logradouro").val(dados.logradouro + " " + dados.complemento);
								$("#bairro").val(dados.bairro);
								$("#municipio").val(dados.localidade);
								$("#estado").val(dados.uf);
							},
							error : function(dados){
								alert("Erro no retorno de dados !");
							}
						} );

						$("#btnCEP").val("Buscar");

					}
				}
			 }

 function validarCPF(){

   var nCPF = $("#cpf").val();
   nCPF = nCPF.replace('-','');
   nCPF = nCPF.replace('.','');
   nCPF = nCPF.replace('.','');

   if ( !eCPF(nCPF) ) {
 	   alert("CPF inválido");
 	   $("#cpf").val('');
 	   $("#cpf").focus();
 	}
}

    function salvar(){
		if( $('#nome').val() == "" ){
			alert("Informe o nome!");
			$('#nome').focus();
			return false;
		}else if( $('#cpf').val() == "" ){
			alert("Informe o CPF!");
			$('#cpf').focus();
			return false;
		}else if( $('#email').val() == "" ){
			alert("Informe o email!");
			$('#email').focus();
			return false;
		}else if( $('#cep').val() == "" ){
			alert("Informe o cep!");
			$('#cep').focus();
			return false;
		}else if( $('#logradouro').val() == "" ){
			alert("Informe o logradouro!");
			$('#logradouro').focus();
			return false;
		}else if( $('#numero').val() == "" ){
			alert("Informe o numero!");
			$('#numero').focus();
			return false;
		}else if( $('#complemento').val() == "" ){
			alert("Informe o complemento!");
			$('#complemento').focus();
			return false;
		}else if( $('#bairro').val() == "" ){
			alert("Informe o bairro!");
			$('#bairro').focus();
			return false;
		}else if( $('#problema').val() == "" ){
			alert("Informe o problema!");
			$('#problema').focus();
			return false;
		}else if( $('#sugestao').val() == "" ){
			alert("Informe a sugestao!");
			$('#sugestao').focus();
			return false;
		}else if( $('#justificativa').val() == "" ){
			alert("Informe a justificativa!");
			$('#justificativa').focus();
			return false;
		}else{

			$('#error').addClass('hide');
			var err = '';


			var obj = {
				nome                : $('#nome').val(),
				cpf                 : $('#cpf').val(),
				email               : $('#email').val(),
				regiao              : $('#regiao').val(),
				cep         		: $('#cep').val(),
				logradouro      	: $('#logradouro').val(),
				numero              : $('#numero').val(),
				complemento         : $('#complemento').val(),
				bairro         		: $('#bairro').val(),
				problema        	: $('#problema').val(),
				sugestao         	: $('#sugestao').val(),
				justificativa       : $('#justificativa').val()
			};

			$.ajax({
				   type: "POST",
				   url: "../banco/cadastrarSaneamentoConsulta.php",
				   dataType: "json",
				   data: obj,
				   success: function ( data ) {

					   if( data['success'] == 1 ){
						   alert("Informações enviadas com SUCESSO.");
						   $('#nome').val("");
					       $('#cpf').val("");
					       $('#email').val("");
					       $('#regiao').val("");
						   $('#cep').val("");
						   $('#logradouro').val("");
						   $('#numero').val("");
						   $('#complemento').val("");
						   $('#bairro').val("");
						   $('#problema').val("");
						   $('#sugestao').val("");
						   $('#justificativa').val("");

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

	</body>
</html>
