<!DOCTYPE html>
<html lang="en">
	<head>
		<link href="/../../layout/imagens/brasao.gif" rel="shortcut icon" type="image/x-icon">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="estilo.css" />
		
		<title>Certificação Digital</title>
		
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
		
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
		
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/jquery.alerts.css">
		
		
		<!-- Optional theme -->
		<link rel="stylesheet" href="css/bootstrap-theme.min.css">
		
		<!-- Latest compiled and minified JavaScript -->
		<script src="js/bootstrap.min.js"></script>
		<script src="js/jquery.alerts.js"></script>

		
		
  	</head>
  	<body>

  		<div  role="form">
		  	<div class="container">
		  		<br>
		  		<br>
		  		<h4 class="bold">TERMO DE TITULARIDADE E RESPONSABILIDADE DE CERTIFICADO DIGITAL DE PESSOA FÍSICA</h4>
				<br><br>
				<div class="row">
					<div class="col-xs-12">
			 			<div class="form-group">
						    <label for="nome" class="control-label">Nome<red>*</red></label>
						    <input type="text" class="form-control" id="nome" placeholder="">
			 			</div>
		 			</div>
		 		</div>
		 		<div class="row">
		 			<div class="col-xs-4">
			 			<div class="form-group">
						    <label for="nascimento">Data de Nascimento<red>*</red></label>
						    <input type="text" class="form-control" id="nascimento" placeholder="">
			 			</div>
		 			</div>

		 			<div class="col-xs-8">
			 			<div class="form-group">
						    <label for="cpf">CPF<red>*</red></label>
						    <input type="text" class="form-control" id="cpf" placeholder="">
			 			</div>
		 			</div>
		 		</div>	

		 		<div class="row">
		 			<div class="col-xs-4">
			 			<div class="form-group">
						    <label for="rg">RG<red>*</red></label>
						    <input type="text" class="form-control" id="rg" placeholder="">
			 			</div>
		 			</div>
		 			<div class="col-xs-4">
			 			<div class="form-group">
						    <label for="orgaoEmissor">Órgão Emissor:<red>*</red></label>
						    <input type="text" class="form-control" id="orgaoEmissor" placeholder="">
			 			</div>
		 			</div>

		 			<div class="col-xs-4">
			 			<div class="form-group">
						    <label for="estadoRg">Estado:<red>*</red></label>
						    <input type="text" class="form-control" id="estadoRg" placeholder="">
			 			</div>
		 			</div>
		 		</div>	

		 		<div class="row">
		 			
		 			<div class="col-xs-6">
			 			<div class="form-group">
						    <label for="pis">NIS/PIS/PASEP/NIT:<red>*</red></label>
						    <input type="text" class="form-control" id="pis" placeholder="">
			 			</div>
		 			</div>
		 		
		 			<div class="col-xs-6">
			 			<div class="form-group">
						    <label for="cei">CEI<red>*</red></label>
						    <input type="text" class="form-control" id="cei" placeholder="">
			 			</div>
		 			</div>
		 		</div>

		 		<div class="row">
		 			<div class="col-xs-3">
			 			<div class="form-group">
						    <label for="titulo">Titulo de Eleitor<red>*</red></label>
						    <input type="text" class="form-control" id="titulo" placeholder="">
			 			</div>
		 			</div>
		 			<div class="col-xs-2">
			 			<div class="form-group">
						    <label for="zona">Zona<red>*</red></label>
						    <input type="text" class="form-control" id="zona" placeholder="">
			 			</div>
		 			</div>
		 			<div class="col-xs-2">
			 			<div class="form-group">
						    <label for="secao">Seção<red>*</red></label>
						    <input type="text" class="form-control" id="secao" placeholder="">
			 			</div>
		 			</div>
		 			<div class="col-xs-3">
			 			<div class="form-group">
						    <label for="cidade">Cidade<red>*</red></label>
						    <input type="text" class="form-control" id="cidade" placeholder="">
			 			</div>
		 			</div>
		 			<div class="col-xs-2">
			 			<div class="form-group">
						    <label for="estadoTitulo">Estado<red>*</red></label>
						    <input type="text" class="form-control" id="estadoTitulo" placeholder="">
			 			</div>
		 			</div>
		 		</div>

		 		<div class="row">
		 			<div class="col-xs-12">
			 			<div class="form-group">
						    <label for="email">E-mail<red>*</red></label>
						    <input type="text" class="form-control" id="email" placeholder="">
			 			</div>
		 			</div>
		 		</div>

		 		<div class="row">
		 			<div class="col-xs-12">
			 			<div class="form-group">
						    <label for="funcionario">Tipo de Funcionário</label>
						    <select class="form-control" id="funcionario">
						    	<option value="1">Comissionado</option>
						    	<option value="2">Comissionado de Carreira</option>
						    	<option value="3">Efetivo</option>
						    </select>
			 			</div>
		 			</div>
		 		</div>

				<div class="row">
		 			<div class="col-xs-12">
				  		<div class="alert alert-danger hide" id="error">  </div>
				  		<button type="button" id="sendForm" class="btn btn-primary">Imprimir</button>
		  			</div>
		 		</div>
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
		       $("#nascimento").mask("99/99/9999");
			   $("#cnpj").mask("99.999.999/9999-99");
		});
		
		$('input').bind('focus',function(){
			$('#error').addClass('hide');
		});
		
		
		$('#sendForm').bind('click',function(){
			$('#error').addClass('hide');
			
			var err = '';
			var obj = {
				nome :       	$('#nome').val(),
				nascimento : 	$('#nascimento').val(),
				cpf  :      	$('#cpf').val(),
				rg  : 		    $('#rg').val(),
				orgaoEmissor  : $('#orgaoEmissor').val(),
				estadoRg  : 	$('#estadoRg').val(),
				pis  : 			$('#pis').val(),
				cei  : 			$('#cei').val(),
				titulo : 		$('#titulo').val(),
				zona  : 		$('#zona').val(),
				secao   : 		$('#secao').val(),
				cidade   : 		$('#cidade').val(),
				funcionario  :  $('#funcionario').val(),
				estadoTitulo  : $('#estadoTitulo').val(),
				email  : 		$('#email').val()
			};
				$.post( "formReq.php", obj).done(function( data ) {	
			    	var retorno = jQuery.parseJSON(data);
			    	if(retorno.success == 3){
						jConfirm('Cadastro já realizado anteriormente, gostaria de renovar o Certificado Digital?', '', function(r) {
							if(r==true){

								obj = {
									nome :       	$('#nome').val(),
									nascimento : 	$('#nascimento').val(),
									cpf  :      	$('#cpf').val(),
									rg  : 		    $('#rg').val(),
									orgaoEmissor  : $('#orgaoEmissor').val(),
									estadoRg  : 	$('#estadoRg').val(),
									pis  : 			$('#pis').val(),
									cei  : 			$('#cei').val(),
									titulo : 		$('#titulo').val(),
									zona  : 		$('#zona').val(),
									secao   : 		$('#secao').val(),
									cidade   : 		$('#cidade').val(),
									funcionario  :  $('#funcionario').val(),
									estadoTitulo  : $('#estadoTitulo').val(),
									email  : 		$('#email').val(),
									id : retorno.id
								};

								$.post( "formReqUpdate.php", obj).done(function( data ) {	
								var retorno = jQuery.parseJSON(data);
								if(retorno.success == 1){
									location.href = "print.php";
								}
								if(retorno.success == 0){
									$('#error').text(retorno.error).removeClass('hide');
								}
								});
							}
						});
					}
					if(retorno.success == 1){
			    		location.href = "print.php";
			    	}
					if(retorno.success == 0){
			    		$('#error').text(retorno.error).removeClass('hide');
			    	}
			    	console.log( data );
				});
		});
	    </script>
  		
  	</body>