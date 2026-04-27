<?php
	header('Location: https://www.pmf.sc.gov.br');
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<link href="/../../layout/imagens/brasao.gif" rel="shortcut icon" type="image/x-icon">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="http://www.pmf.sc.gov.br/sistemas/casacivil/scd/estilo.css" />
		
		<title>Formulario Liberação VPN</title>
		
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
		
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="css/bootstrap.min.css">
		
		<!-- Optional theme -->
		<link rel="stylesheet" href="css/bootstrap-theme.min.css">
		
		<!-- Latest compiled and minified JavaScript -->
		<script src="js/bootstrap.min.js"></script>
		
  	</head>
  	<body>

  		<div  role="form">
		  		<div class="container">
		  			<h5 class="bold">DADOS DA INSTITUIÇÃO</h5>
					   
		 				<div class="table">	
							<div class="col1">	
								<div class="form-group">
									<label for="exampleInputEmail1">Nome<red>*</red></label>
									<input type="text" class="form-control" id="nome_instituicao" placeholder="">
								 </div>							
								 <div class="form-group">
									<label for="exampleInputEmail1">CNPJ<red>*</red></label>
									<input type="text" class="form-control" id="cnpj" placeholder="">
								</div>
							</div>
							<div class="col2">
								 <div class="form-group">
										<label for="exampleInputEmail1">Entidade / Orgão / Razão Social<red>*</red></label>
										<input type="text" class="form-control" id="entidade" placeholder="">
								</div>
								<div class="form-group">
									<label for="exampleInputEmail1">Telefone<red>*</red></label>
									<input type="text" class="form-control" id="telefone" placeholder="">
								</div>
							</div>
						</div>
		 				 <h5 class="bold">DADOS DO FUNCIONÁRIO DA INSTITUIÇÃO</h5>
		 				 
		 				<div class="form-group">
					    	<label for="exampleInputEmail1">Nome<red>*</red></label>
					    	<input type="text" class="form-control" id="nome" placeholder="">
		 				 </div>
		 				 
		 				<div class="table">	
		 					<div class="col1">							
								<div class="form-group">
				    				<label for="exampleInputEmail1">CPF<red>*</red></label>
									<input type="text" class="form-control" id="cpf" placeholder="">
								</div>
								
								<div class="form-group">
				    				<label for="exampleInputEmail1">Naturalidade<red>*</red></label>
									<input type="text" class="form-control" id="naturalidade" placeholder="">	
								</div>
								
								<div class="form-group">
				    				<label for="exampleInputEmail1">Email<red>*</red></label>
									<input type="text" class="form-control" id="email" placeholder="">
								</div>
								
							</div>
							
							<div class="col2">
								<div class="form-group">
				    				<label for="exampleInputEmail1">Data de Nascimento<red>*</red></label>
									<input type="text" class="form-control" id="nascimento" placeholder="">
								</div>
							
								<div class="form-group">
				    				<label for="exampleInputEmail1">UF</label>
									<select class="form-control" id="uf" placeholder="">
										 <option value="1">AL</option>
										 <option value="2">AP</option>
										 <option value="3">AM</option>
										 <option value="4">BA</option>
										 <option value="5">CE</option>
										 <option value="6">DF</option>
										 <option value="7">ES</option>
										 <option value="8">GO</option>
										 <option value="9">MA</option>
										 <option value="10">MT</option>
										 <option value="11">MS</option>
										 <option value="12">MG</option>
										 <option value="13">PA</option>
										 <option value="14">PB</option>
										 <option value="15">PR</option>
										 <option value="16">PE</option>
										 <option value="17">PI</option>
										 <option value="18">RJ</option>
										 <option value="19">RN</option>
										 <option value="20">RS</option>
										 <option value="21">RO</option>
										 <option value="22">RR</option>
										 <option value="23" selected>SC</option>
										 <option value="24">SP</option>
										 <option value="25">SE</option>
										 <option value="26">TO</option>
									</select>
								</div>	
															
								<div class="form-group">
				    				<label for="exampleInputEmail1">Matricula</label>
									<input type="text" class="form-control" id="matricula" placeholder="">
								</div>
							</div>
							
							<div class="form-group">
				    				<label for="exampleInputEmail1">DADOS ADICIONAIS: (Preencher caso faça manuseio da VPN)</label>
									<textarea class="form-control" id="adicional" placeholder=""></textarea>
							</div>
							
							<div class="form-group">
				    				<label for="exampleInputEmail1">MOTIVO: (Preencher caso faça manuseio da VPN)<red>*</red></label>
									<input type="text" class="form-control" id="motivo" placeholder="">
							</div>
		  			    </div>
		  			<p><red>*</red>Campos obrigatorios</p>  
		  			<p>**A entrega do documento impresso deve ser feita em até 5 dias na Rua Tenente Silveira, nº 60 - Ático - Sala do Governo Eletrônico - Centro <br> CEP: 88010-300 (Diretoria de Sistemas de Governo Eletrônico)</p>
		  			<p><red><strong>***Ao clicar em enviar será gerado um termo de responsabilidade para impressão.</strong></red></p>
		  			<div id="documento">
		  				<?php
		  					include "parteCimaVPN.php";
		  					include "documentoVPN.php";
							echo "</div>";
							echo "</div>";
		  				?>
		  			</div>
				  <div class="checkbox">
				    <label for="exampleInputEmail1">
				      <input type="checkbox" id="check"> Declaro, nesta data, <b>ter ciência e estar de acordo com os procedimentos acima descritos,</b> comprometendo-me a respeitá-los e cumpri-los plena e integralmente.
				    </label>
				  </div>
		  		<div class="alert alert-danger hide" id="error">  </div>
		  			<button type="button" id="sendPesquisa" class="btn btn-primary" disabled>Enviar</button>
			   
		    </div>
	    </div>
	    <script src="http://www.pmf.sc.gov.br/sistemas/casacivil/scd/jquery.maskedinput.js"></script>
	    <script>
	    	$('#check').bind('click',function(){
	    		if($(this).is(':checked') ){
	    			$('#sendPesquisa').prop( "disabled", false );
	    		}else{
	    			$('#sendPesquisa').prop( "disabled", true );
	    		}
	    	});
	    	
		jQuery(function($){
		       $("#cpf").mask("999.999.999-99");
		       $("#telefone").mask("(99)9999-9999?9");
		       $("#nascimento").mask("99/99/9999");
			   $("#cnpj").mask("99.999.999/9999-99");
		});
		
		$('input').bind('focus',function(){
			$('#error').addClass('hide');
		});
		
		
		$('#sendPesquisa').bind('click',function(){
			$('#error').addClass('hide');
			
			var err = '';
			var obj = {
				nome_instituicao : $('#nome_instituicao').val(),
				razao_social 	 : $('#razao_social').val(),
				nome 			 : $('#nome').val(),
				cpf 			 : $('#cpf').val(),	
				naturalidade 	 : $('#naturalidade').val(),
				email 			 : $('#email').val(),
				nascimento 		 : $('#nascimento').val(),
				uf 				 : $('#uf').val(),
				matricula 		 : $('#matricula').val(),
				adicional 		 : $('#adicional').val(),
				motivo 			 : $('#motivo').val(),
				cnpj 			 : $('#cnpj').val(),
				entidade 		 : $('#entidade').val(),
				telefone 		 : $('#telefone').val(),
			};
				$.post( "backend/formVPNReq.php", obj).done(function( data ) {	
					console.log( data );
			    	var retorno = jQuery.parseJSON(data);
			    	if(retorno.success == 1){
						alert("Cadastro realizado com sucesso!");
						$('#nome_instituicao').val('');
						$('#nome').val('');
						$('#cpf').val('');
						$('#naturalidade').val('');
						$('#email').val('');
						$('#nascimento').val('');
						$('#uf').val('');
						$('#matricula').val('');
						$('#adicional').val('');
						$('#motivo').val('');
						$('#cnpj').val('');
						$('#entidade').val('');
						$('#telefone').val('');
			    		location.href = "backend/printLiberacaoVPN.php";
			    	}else{
			    		$('#error').text(retorno.error).removeClass('hide');
			    	}
			    	
			    	console.log( data );
				});
		});
	    </script>
  		
  	</body>