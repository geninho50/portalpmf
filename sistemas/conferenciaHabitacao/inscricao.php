<!DOCTYPE HTML>
<html>
	<head>
		<title>1ª Conferência Municipal de Habitação de Interesse Social</title>
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

					<div class="inner">
						<header>
							<h2>Inscrição para Conferência</h2><br />
						<p>* Todos os campos são obrigatórios.</p>
						</header>

							<div class="column">
							<form action="#" method="post" name="frm">
								<div class="row">
		        						<div class="col-md-3">
										<label>Nome completo:</label><input value="" id="nome" class="form-control" type="text"/>
										</div>
										<div class="col-md-2">
											<label>Nascimento:</label><input value="" id="nascimento" class="form-control" type="text"/>
										</div>
										<div class="col-md-2">
  											 <label>CPF:</label><input value="" id="cpf" class="form-control" type="text" onChange="validarCPF();"/>
										</div>
										<div class="col-md-3">
  											 <label>Email:</label><input value="" id="email" class="form-control" type="text"/>
										</div>
										<div class="col-md-2">
  											 <label>Telefone:</label><input value="" id="telefone" class="form-control" type="text"/>
										</div>

								</div><br>

									<div class="row">
										<div class="col-md-3">
  											 <label>Instituição:</label><input value="" id="instituicao" class="form-control" type="text"/>
										</div>
										<div class="col-md-2">
											<label>Comunidade que Reside:</label><input value="" id="comunidade" class="form-control" type="text"/>
										</div>

										<div class="col-md-2">
											<label>Bairro:</label><input value="" id="bairro" class="form-control" type="text"></input>
										</div>
										<div class="col-md-2">
											<label>Região:</label>
											<select id="regiao" name="regiao" class="form-control">
												<option value="Norte da Ilha">Norte da Ilha</option>
												<option value="Sul/Leste da Ilha">Sul/Leste da Ilha</option>
												<option value="Centro/Oeste da Ilha">Centro/Oeste da Ilha</option>
												<option value="Continente">Continente</option>
											</select>
										</div>
										<div class="col-md-3">
											<label>Segmento:</label>

										<select id="segmento" name="segmento" class="form-control">
											<option value="Sociedade Civil">Sociedade Civil</option>
											<option value="Associação de Moradores (ou Conselhos Comunitários)">Associação de Moradores (ou Conselhos Comunitários)</option>
											<option value="Institucional">Institucional</option>
											<option value="Outros">Outros</option>
										</select>
																				</div>
								</div><br><br>




									<br><br>
										<ul class="actions">
											<li><input value="Enviar" class="button" type="button" onclick="salvar();"></li>
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
 $("#nascimento").mask("99/99/9999");

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
		}else if( $('#nascimento').val() == "" ){
			alert("Informe o nascimento!");
			$('#nascimento').focus();
			return false;
		}else if( $('#cpf').val() == "" ){
			alert("Informe o CPF!");
			$('#cpf').focus();
			return false;
		}else if( $('#email').val() == "" ){
			alert("Informe o email!");
			$('#email').focus();
			return false;
		}else if( $('#telefone').val() == "" ){
			alert("Informe o Telefone!");
			$('#telefone').focus();
			return false;
		}else if( $('#instituicao').val() == "" ){
			alert("Informe a instituicao!");
			$('#instituicao').focus();
			return false;
		}else if( $('#comunidade').val() == "" ){
			alert("Informe a comunidade!");
			$('#comunidade').focus();
			return false;
		}else if( $('#bairro').val() == "" ){
			alert("Informe o bairro!");
			$('#bairro').focus();
			return false;
		}else if( $('#regiao').val() == "" ){
			alert("Informe a regiao!");
			$('#regiao').focus();
			return false;
		}else if( $('#segmento').val() == "" ){
			alert("Informe o segmento!");
			$('#segmento').focus();
			return false;
		}else{

			$('#error').addClass('hide');
			var err = '';


			var obj = {
				nome                : $('#nome').val(),
				nascimento          : $('#nascimento').val(),
				cpf                 : $('#cpf').val(),
				email               : $('#email').val(),
				telefone            : $('#telefone').val(),
				instituicao         : $('#instituicao').val(),
				comunidade         	: $('#comunidade').val(),
				bairro              : $('#bairro').val(),
				regiao       		: $('#regiao').val(),
				segmento       		: $('#segmento').val()
			};

			$.ajax({
				   type: "POST",
				   url: "../banco/cadastrarHabitacaoInscricao.php",
				   dataType: "json",
				   data: obj,
				   success: function ( data ) {

					   if( data['success'] == 1 ){
						   alert("Informações enviadas com SUCESSO.");
						   $('#nome').val("");
						   $('#nascimento').val("");
					       $('#cpf').val("");
					       $('#email').val("");
					       $('#telefone').val("");
						   $('#instituicao').val("");
						   $('#comunidade').val("");
						   $('#bairro').val("");
						   $('#regiao').val("");
						   $('#segmento').val("");
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
