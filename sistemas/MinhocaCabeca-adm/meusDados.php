<?php
require_once("repository/participante.php"); 

$participante = new participante();

$codigoUsuario = $participante->vargetpost('codigoUsuario');  
$codigoUsuario64 = base64_decode( $codigoUsuario );

$dadosParticipante = $participante->buscaDadosParticipante($codigoUsuario64);

$nome 	   	= $dadosParticipante['NOME'][0];
$cpf 		= $dadosParticipante['CPF'][0];
$identidade = $dadosParticipante['IDENTIDADE'][0];
$cep 		= $dadosParticipante['CEP'][0];
$logradouro = $dadosParticipante['LOGRADOURO'][0];
$numero     = $dadosParticipante['NUMERO'][0];
$bairro     = $dadosParticipante['BAIRRO'][0];
$telefone   = $dadosParticipante['TELEFONE'][0];
$celular    = $dadosParticipante['CELULAR'][0];
$email      = $dadosParticipante['EMAIL'][0];
  
?>


<!DOCTYPE HTML>
<html>
	<head>
		<script src="js/jquery-2.1.4.min.js" type="text/javascript"></script>
	</head>
	<?php 
	  include_once("cabecalho.php"); 
	  cabecalho( $codigoUsuario );
	?>
	<body class="subpage">

		<!-- Header -->
			<header id="header">
				<div class="logo"><a href="residuometro.html">RESIDU&Ocirc;METRO</a></div>
				<a href="#menu">Menu</a>
			</header>

		<!-- Nav -->
		<?php
		  include_once("menu.php");   
		  menu( $codigoUsuario ); 
		 ?>


		<!-- One -->
			<section id="One" class="wrapper style3">
				<div class="inner">
					<header class="align-center">
						<p><Strong>PROJETO MINHOCA NA CABE&Ccedil;A</Strong></p>
						<h2>Meus Dados</h2>
					</header>
				</div>
			</section>

			<section id="two" class="wrapper style2">
				<div class="inner">
					<form enctype="multipart/form-data" id="form">
						<header class="align-left">
							<br>
								<label for="nome">Nome</label>
								<input type="text" id="nome" name="nome" required="true" value="<?php echo $nome ?>" disabled="true">
								<div style="display: flex; width: 100%">
									<div style="width: 49%; margin-right: 1%">
										<label for="cpf">CPF</label>
										<input type="text" id="cpf" name="cpf" value="<?php echo $cpf ?>" readOnly="true" disabled="true">
									</div>
									<div style="width: 49%; margin-left: 1%">
										<label for="rg">RG</label>
										<input type="text" id="rg" name="rg" value="<?php echo $identidade ?>" readOnly="true" disabled="true">
									</div>
								</div>
								<div>
									<p style="margin-top: 1em; margin-bottom: 0;"><b style="color: red; font-size: 14px">Logradouro e Bairro serão automaticamente preenchidos ao inserir o CEP</b></p>
								</div>
								<div style="display: flex; width: 100%">
									<script>
							            $(document).ready(function(){
							                $("#cep").change(function () {
							                    $.get( "https://viacep.com.br/ws/"+$("#cep")[0].value+"/json/").done(function( data ) {
							                        if(typeof data.erro != 'undefined') {
							                        	alert("CEP não encontrado.");	
							                        } else {
							                        	$("#logradouro")[0].value = data.logradouro;
							                        	$("#bairro")[0].value = data.bairro;
							                        }
							                    }).fail(function () {
							                        alert("CEP não encontrado.");
							                    });
							                });
							            });
							        </script>
									<div style="width: 19%; margin-right: 1%">
										<label for="cep">CEP</label>
										<input type="text" id="cep" name="cep" required="true" value="<?php echo $cep ?>" disabled="true">
									</div>
									<div style="width: 48%; margin-left: 1%; margin-right: 1%">
										<label for="logradouro">Logradouro</label>
										<input type="text" id="logradouro" name="logradouro" value="<?php echo $logradouro ?>" readOnly="true" disabled="true">
									</div>
									<div style="width: 18%; margin-left: 1%; margin-right: 1%">
										<label for="bairro">Bairro</label>
										<input type="text" id="bairro" name="bairro" value="<?php echo $bairro ?>" readOnly="true" disabled="true">
									</div>
									<div style="width: 9%; margin-left: 1%;">
										<label for="numero">Número</label>
										<input type="text" id="numero" name="numero" required="true" value="<?php echo $numero ?>" disabled="true">
									</div>
								</div>
								<div style="display: flex; width: 100%">
									<div style="width: 49%; margin-right: 1%">
										<label for="telefone">Telefone</label>
										<input type="text" id="telefone" name="telefone" value="<?php echo $telefone ?>" disabled="true">
									</div>
									<div style="width: 49%; margin-left: 1%">
										<label for="celular">Celular</label>
										<input type="text" id="celular" name="celular" value="<?php echo $celular ?>" disabled="true">
									</div>
								</div>
								<label for="email">Email</label>
								<input type="text" id="email" name="email" required="true" value="<?php echo $email ?>" disabled="true">
									<div style="display: flex; margin-top: 1em; width: 100%">
										<div style="width: 30%; margin-right: 1%">
											<label for="docIdentificacao">Documento de identificação</label>
											<input type="file" accept="image/*,application/pdf" name="docIdentificacao" id="docIdentificacao" disabled="true">
										</div>
										<div style="width: 30%; margin-left: 1%; margin-right: 1%">
											<label for="comprovanteResidencia">Comprovante de residência</label>
											<input type="file" accept="image/*,application/pdf" name="comprovanteResidencia" id="comprovanteResidencia" disabled="true">
										</div>
										<div style="width: 36%; margin-left: 1%">
											<label for="comprovanteResidenciaComplementar">Comprovante de residência complementar <br><b style="color: red">Enviar quando o comprovante de residência não está no seu nome.</b></label>
											<input type="file" accept="image/*,application/pdf" name="comprovanteResidenciaComplementar" id="comprovanteResidenciaComplementar" disabled="true">
										</div>
									</div>
								<input type="hidden" id="codigoUsuario" name="codigoUsuario" value="<?php echo $codigoUsuario ?>" disabled="true">
								<div align="center">
									<input type="button" name="lib" id="lib" value="Liberar alteração dos dados" style="margin-top: 1em;" onclick="liberarAlteracao()">
									<input type="button" name="blc" id="blc" value="Bloquear alteração dos dados" style="margin-top: 1em; display: none" onclick="bloquearAlteracao()">
									<input type="submit" name="alt" id="alt" value="Alterar dados" disabled="true" style="margin-top: 1em;">
								</div>						
						</header>
					</form>
				</div>
			</section>


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
			<script type="text/javascript">
				function bloquearAlteracao() {
					$("#alt")[0].disabled = true;
					$("#codigoUsuario")[0].disabled = true;
					$("#nome")[0].disabled = true;
					$("#nome")[0].style = 'background:rgba(0,0,0,0.075)';
					$("#cpf")[0].disabled = true;
					$("#rg")[0].disabled = true;
					$("#cep")[0].disabled = true;
					$("#cep")[0].style = 'background:rgba(0,0,0,0.075)';
					$("#logradouro")[0].disabled = true;
					$("#bairro")[0].disabled = true;
					$("#numero")[0].disabled = true;
					$("#numero")[0].style = 'background:rgba(0,0,0,0.075)';
					$("#telefone")[0].disabled = true;
					$("#telefone")[0].style = 'background:rgba(0,0,0,0.075)';
					$("#celular")[0].disabled = true;
					$("#celular")[0].style = 'background:rgba(0,0,0,0.075)';
					$("#email")[0].disabled = true;
					$("#email")[0].style = 'background:rgba(0,0,0,0.075)';
					$("#lib")[0].style = 'margin-top: 1em;';
					$("#blc")[0].style = 'margin-top: 1em; display: none';
					$("#alt")[0].onclick = null;
					$("#docIdentificacao")[0].disabled = true;
					$("#comprovanteResidencia")[0].disabled = true;
					$("#comprovanteResidenciaComplementar")[0].disabled = true;
				}

				function liberarAlteracao() {
					$("#alt")[0].disabled = false;
					$("#codigoUsuario")[0].disabled = false;
					$("#nome")[0].disabled = false;
					$("#nome")[0].style = 'background:rgba(0,0,0,0)';
					$("#cpf")[0].disabled = false;
					$("#rg")[0].disabled = false;
					$("#cep")[0].disabled = false;
					$("#cep")[0].style = 'background:rgba(0,0,0,0)';
					$("#logradouro")[0].disabled = false;
					$("#bairro")[0].disabled = false;
					$("#numero")[0].disabled = false;
					$("#numero")[0].style = 'background:rgba(0,0,0,0)';
					$("#telefone")[0].disabled = false;
					$("#telefone")[0].style = 'background:rgba(0,0,0,0)';
					$("#celular")[0].disabled = false;
					$("#celular")[0].style = 'background:rgba(0,0,0,0)';
					$("#email")[0].disabled = false;
					$("#email")[0].style = 'background:rgba(0,0,0,0)';
					$("#lib")[0].style = 'margin-top: 1em; display: none';
					$("#blc")[0].style = 'margin-top: 1em;';
					$("#alt")[0].onclick = atualizaDados;
					$("#docIdentificacao")[0].disabled = false;
					$("#comprovanteResidencia")[0].disabled = false;
					$("#comprovanteResidenciaComplementar")[0].disabled = false;
				}

				function atualizaDados() {					
					$("#form").on('submit', function(e){
				        e.preventDefault();
				        $.ajax({
						    type: "POST",
						    url: "repository/atualizaParticipante.php",
						    data: new FormData(this),
						    processData: false,
	    					contentType: false,
	    					cache: false,
						    success: function (retorno) {
						        array = JSON.parse(retorno);
						        if( array.retorno == 1 ){
						            alert("Dados atualizados com sucesso!");
						            location.reload();
						        } else {
						            alert(array.erro);
						        }
						    }
						});	
				    });
				}
			</script>

	</body>
</html>