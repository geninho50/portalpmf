<!DOCTYPE HTML>
<!--
	Hielo by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
		<title>Minhoca na Cabe&ccedil;a</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="../assets/css/main.css" />
	</head>
<?
  error_reporting(E_ALL);
  ini_set('display_errors', '1');
  include_once("../../banco/gdb.php");

  $gdb = new gdb();
  $gdb2 = new gdb();

  $codigo = base64_decode( $gdb->vargetpost('codigo') );

  $codigoUsuario = $gdb->vargetpost('codigo');

  $select = "select codigoInscricao as codigo,
					p.nome,
					cpf,
					email,
					telefone,
					celular,
			case when tipo = 'E' Then 'Esperando'
				 else 'Enviado' end as situacao
				from pessoa p,
					 pessoaAuxiliar a,
					 eventoInscricao e
				where a.codigoProjeto = 'MNC'
				 and a.codigoPessoa = p.codigoPessoa
				 and e.codigoPessoa = a.codigoPessoa
				 and e.tipo  in ('M','E')
				 and e.codigoInscricao='$codigo' ";

  $gdb->open( $select );


?>
	<body class="subpage">

		<!-- Header -->
			<header id="header" >
				<div class="logo"></div>
				<div class="logo"><a href="residuometro.html">RESIDU&Ocirc;METRO</a></div>
				<a href="#menu">Menu</a>
			</header>

		<!-- Nav -->
			<nav id="menu">
				<ul class="links">
					<li><a href="../index.php?codigoUsuario=<?echo $codigoUsuario;?>">Sair</a></li>
				</ul>
			</nav>

		<!-- One -->
			<section id="One" class="wrapper style3">
				<div class="inner">
					<header class="align-center">
						<p><Strong>PROJETO MINHOCA NA CABE&Ccedil;A</Strong></p>
						<h2>Finalizando a Incri&ccedil;&atilde;o</h2>
					</header>
				</div>
			</section>

	<? if( $gdb->linhas>0 ){?>
		<!-- Main -->
			<div id="main" class="container">

							<!-- Form -->
								<h2>Dados do Participante</h2>
								<p>Todos os campos s&atilde;o obrigat&oacute;rios. <br /> Ao finalizar a inscri&ccedil;&atilde;o imprima o seu comprovante e leve-o assinado no dia da Oficina. Não esqueça de levar o comprovante de residência no dia da oficina.</p>

								<form method="post" action="#" id="formIndex" name="formIndex" >
								    <input type="hidden" name="inscricao" id="inscricao" value="<? print $codigo; ?>" >
									<div class="row uniform">
										<div class="6u 12u$(xsmall)">
											<label id="lbcpf">CPF</label><input type="text"  value="<? print $gdb->gs['CPF'][0]; ?>" readonly />
											<input type="hidden" name="cpf" id="cpf"  value="<? print $gdb->gs['CPF'][0]; ?>" >
										</div>
										<div class="6u$ 12u$(xsmall)">
											<label id="lbprofissao" >Profiss&atilde;o</label><input type="text" name="profissao" id="profissao" placeholder="Informe a profiss&atilde;o"  class="obrigatorio" />
										</div>
										<div class="6u 12u$(xsmall)">
											<label id="lbnome" >Nome completo</label><input type="text" name="nome" id="nome"  maxlength="100"  value="<? print $gdb->gs['NOME'][0]; ?>" readonly  />
										</div>
										<div class="6u$ 12u$(xsmall)">
											<label id="lbrg">RG</label><input type="text" name="rg" id="rg" placeholder="RG"  maxlength="15"  class="obrigatorio" />
										</div>
										<div class="6u 12u$(xsmall)">
											<label id="lbnascimento" >Data de Nascimento</label><input type="text" id="nascimento" name="nascimento" class="obrigatorio" placeholder="Informe a data de nascimento"  />
										</div>
										<div class="6u$ 12u$(xsmall)">
											<label id="lbcep">CEP</label><input type="text" name="cep" id="cep" placeholder="Informe o CEP"  class="obrigatorio" />
											 <span class="input-group-btn">
						                        <button class="btn btn-default" onclick="buscarCEP();" type="button">BUSCAR CEP</button>
						                    </span>
										</div>
										<div class="6u 12u$(xsmall)">
											<label id="lblogradouro">Endere&ccedil;o ( Ex.: Rua Silva Araujo apto 20 Bloco A .... )</label><input type="text" name="logradouro" id="logradouro"  maxlength="80" placeholder="Informe o endere&ccedil;o"   class="obrigatorio" />
										</div>
										<div class="6u$ 12u$(xsmall)">
											<label id="lb">N&uacute;mero</label><input type="text" name="numero" id="numero" placeholder="N&uacute;mero"  maxlength="10" />
										</div>
										<div class="6u 12u$(xsmall)">
											<label id="lbbairro">Bairro</label><input type="text" name="bairro" id="bairro" placeholder="Informe a bairro"  maxlength="50"  class="obrigatorio" />
										</div>
										<div class="6u$ 12u$(xsmall)">
											<label id="lbmunicipio">Munic&iacute;pio</label><input type="text" id="municipio" name="municipio" value="Florian&oacute;polis"  maxlength="50" disabled="disabled"/>
										</div>
										<div class="6u 12u$(xsmall)">
											<label id="lbmoradores">N&uacute;mero de Moradores na Resid&ecirc;ncia</label>
											<select name="moradores" id="moradores">
											<?php
												for($x=1;$x<50;$x++){
													print "<option value='$x'>$x pessoa(s)</option>";
												}
											?>
											</select>
											<!--
											<input type="text" name="moradores" id="moradores" placeholder="Informe a n�mero de pessoas que reside na resid�ncia"  class="obrigatorio"  />
											-->
										</div>
										<div class="6u$ 12u$(xsmall)">
											<label id="lbtelefone">Telefone Residencial</label><input type="text" name="telefone" id="telefone" value="<? print $gdb->gs['TELEFONE'][0]; ?>" readonly  maxlength="14"  />
										</div>
										<div class="6u 12u$(xsmall)">
											<label id="lbcelular">Celular</label><input type="text" name="celular" id="celular" value="<? print $gdb->gs['CELULAR'][0]; ?>" readonly  class="obrigatorio"  />
										</div>

										<div class="6u$ 12u$(xsmall)">
											<label id="lbemail">E-mail</label><input type="text" name="email" id="email" value="<? print $gdb->gs['EMAIL'][0]; ?>" readonly    maxlength="45" class="obrigatorio" />
										</div>

										<div class="6u 12u(xsmall)">
											<label id="lbsenha">Senha ( Min&iacute;mo 6 e no max&iacute;mo 10  Caracteres  )</label><input type="password" name="senha" id="senha" placeholder="Informe a Senha de acesso ao sistema"  maxlength="10"  />
										</div>

										<div class="6u$ 12u(xsmall)">
											<label id="lbsenha">repita a Senha</label><input type="password" name="repetesenha" id="repetesenha" placeholder="repita a senha de acesso ao sistema"   maxlength="10" />
										</div>
										<?

										$select = "SELECT data,
                                                          date_format( data,'%m-%Y' ) as mesAno,
														  date_format( data,'%Y-%m-%d' ) as datap,
														  date_format( data,'%m' ) as mes,
														  date_format( data,'%Y' ) as ano,
														  date_format( data,'%d/%m' ) as diames,
														  date_format( hora,'%H' )	 as hora,
														  t.codigoTurma as codigo
													 FROM backend.evento e,
														  backend.eventoTurma t,
														  backend.eventoProgramacao p
													WHERE t.codigoEvento = e.codigoEvento
													  AND p.codigoTurma = t.codigoTurma
													  AND data>CURDATE()
													  AND t.numeroVagas > ( select count(*)
													                          from eventoInscricao i
																			 Where i.codigoTurma = t.codigoTurma ) ";

										$gdb->open( $select );	?>

										<div class="row uniform">
											<div class="">
												<h2>Escolha um horario para participar</h2>
												<div class="table-wrapper">
												<?
												    $arrayMes = array("Janeiro","Fevereiro","Marco","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro");
												    $arrayDia = array("Domingo","Segunda","Terca","Quarta","Quinta","Sexta","Sabado");
													$mesano = "";
												?>
													<table class="alt">

												<?  foreach( $gdb->gs['DATA'] as $i=>$value ){
												        $dia = $arrayDia[(date('N',strtotime( $gdb->gs['DATAP'][$i]) ) ) ];
														$mes = $arrayMes[( $gdb->gs['MES'][$i] - 1)];

													    if( $gdb->gs['MESANO'][$i] != $mesano ){ ?>
															  <h3><? print $mes." - ".$gdb->gs['ANO'][$i]; ?></h3>
															  <? $mesano = $gdb->gs['MESANO'][$i]; ?>
															   <tr>
																	<td align="center" ><b>Data</b></td>
																	<td align="center"><b>Dia da semana</b></td>
																	<td align="center"><b>Turno - Horario</b></td>
																</tr>
														  <? } ?>
															<tr>
																<td>
																  <input  type="radio" id="of<? print $gdb->gs['CODIGO'][$i]; ?>" value="<? print $gdb->gs['CODIGO'][$i]; ?>" name="curso" />
																  <label id="lbof<? print $gdb->gs['CODIGO'][$i]; ?>" for="of<? print $gdb->gs['CODIGO'][$i]; ?>"><? print $gdb->gs['DIAMES'][$i]; ?></label></td>
																<td><? print $dia; ?></td>
																<td><?
																     if( $gdb->gs['HORA'][$i] > 12  ){
																		print "Vespertino - ".$gdb->gs['HORA'][$i]."h";
																	 }else{
																		print "Matutino - ".$gdb->gs['HORA'][$i]."h";
																	 }
																	?>
																</td>
															</tr>
												 <? } ?>
													</table>
												</div>
											</div>
										</div>

										<input id="estado" name="estado" type="hidden" value="SC" />

										<div class="12u$">
											<ul class="actions">
												<li><input type="button" value="Salvar"  onclick="enviar();"/></li>
												<li><input type="reset" value="Limpar" class="alt" /></li>
											</ul>
										</div>
									</div>
								</form>


						</div>
					</div>

			</div>
	<? }else{
	      for( $i=0; $i<6; $i++ ){ print "<br>";} ?>
	  		    <h3 class="align-center" ><b>Sua inscri&ccedil;&atilde;o j&aacute; foi realizada !<b></h3>
		  <?
		  for( $i=0; $i<6; $i++ ){ print "<br>";}
	  }?>

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
							<img src="../images/Comcap.png" alt="" />
							<img src="../images/Prefeitura.png" alt=""/>
					</header>
				</div>
			</footer>

		<!-- Scripts -->
			<script src="../assets/js/jquery.min.js"></script>
			<script src="../assets/js/jquery.maskedinput.min.js" type="text/javascript"></script>
			<script src="../assets/js/jquery.scrollex.min.js"></script>
			<script src="../assets/js/skel.min.js"></script>
			<script src="../assets/js/util.js"></script>
			<script src="../assets/js/main.js"></script>
			<script type="text/javascript" src="../../Biblioteca/js/validadores.js"></script>
			<script type="text/javascript">
		    // $('#telefone').mask("(99) 999999999");
			/*$('#cpf').mask("999.999.999-99");*/

		    $('#celular').mask("(99) 999999999");
		    $('#cep').mask("99.999-999");
			$('#nascimento').mask("99/99/9999");

			function buscarCEP() {

				//Nova vari�vel "cep" somente com d�gitos.
				var cep = $("#cep").val().replace(/\D/g, '');

				//Verifica se campo cep possui valor informado
				if ( cep !== "" && $("#logradouro").val() === "" )  {

					 $("#btnCEP").val("Processando ...");

					//Express�o regular para validar o CEP.
					var validacep = /^[0-9]{8}$/;

					//Valida o formato do CEP.
					if(validacep.test(cep)) {

						//Consulta o webservice viacep.com.br
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
				} //end if.
			 }

			function enviar(){

				var $inputsText = $('form input:text');
				var values = {};
				var err = '';
				var localImagem  = '../MinhocaCabeca/images/';
				var nTelefone = '';

				$inputsText.each( function() {
					if( $(this).hasClass('obrigatorio') &&  $(this).val() == "" && err !='Tem' ){
						err = 'Tem';
						alert("Informe o " + $( '#lb'+$(this).attr('id') ).html() + " !");
						$(this).focus();
					}
				});

				if( $('#cep').val().substr(0,4) !='88.0' ){
					alert("Voc� n�o � morador de Florian�polis !");
					document.getElementById("formIndex").reset();
					err = 'Tem';
					// $('#cpf').focus();
				}

				if( err != 	'Tem' ){

					if(  $('#senha').val() !='' && $('#repetesenha').val() !='' ){

						if( $('#senha').val().length<6 ){
						   err = 'Tem';
						   alert("A senha � muito curta !");
						   $('#senha').val('');
						   $('#repetesenha').val('');
						   $('#senha').focus();
						}

						if( $('#repetesenha').val() != $('#senha').val() ){
						   err = 'Tem';
						   alert("As senhas s�o diferentes !");
						   $('#senha').val('');
						   $('#repetesenha').val('');
						   $('#senha').focus();
						}

					}else{
					   err = 'Tem';
					   alert("Informe a senha e repita a mesma !");
					   $('#senha').focus();
					}

				}

				if( err != 	'Tem' ){

					var obj = {
						nome           : $('#nome').val(),
						rg             : limpezaDeDocumento( $('#rg').val() ),
						cpf            : limpezaDeDocumento( $('#cpf').val() ),
						celular        : limpezaDeDocumento( $('#celular').val() ),
						telefone       : limpezaDeDocumento( $('#telefone').val() ),
						cep            : limpezaDeDocumento( $('#cep').val() ),
						nascimento     : ajustarData($('#nascimento').val()),
						logradouro     : $('#logradouro').val(),
						bairro         : $('#bairro').val(),
						municipio      : $('#municipio').val(),
						numero         : $('#numero').val(),
						email          : $('#email').val(),
						profissao      : $('#profissao').val(),
						numeroMorador  : $('#moradores').val(),
						senha          : $('#senha').val(),
						curso          : document.formIndex.curso.value,
						inscricao      : $('#inscricao').val(),
						codigoprojeto  : 'MNC'
					};

					obj = $( this ).serialize() + "&" + $.param( obj );

					$.ajax({
						   type: "POST",
						   url: "../../banco/cadastrarMNCfinalizar.php",
						   dataType: "json",
						   data: obj,
						   success: function ( data ) {
							  document.getElementById("formIndex").action = "../../banco/sucessoMNC.php?telefone="+nTelefone+"&codigoprojeto=MNC&titulo=Projeto Minhoca na Cabe�a&codigo="+data['codigo']+"&curso="+data['curso']+"&localImagem="+ localImagem;
							  document.getElementById("formIndex").submit();
							  // console.log(data);
							},

						   error: function ( data ) {
							  console.log(data);
						   }

					});
				}
			}

			</script>

	</body>
</html>
