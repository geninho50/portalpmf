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
		
		<title>Formulario liberação de Rede</title>
		
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
<?php 
function get_client_ip() {
	$ipaddress = '';
	if ($_SERVER['HTTP_CLIENT_IP'])
	$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
	else if($_SERVER['HTTP_X_FORWARDED_FOR'])
	$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
	else if($_SERVER['HTTP_X_FORWARDED'])
	$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
	else if($_SERVER['HTTP_FORWARDED_FOR'])
	$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
	else if($_SERVER['HTTP_FORWARDED'])
	$ipaddress = $_SERVER['HTTP_FORWARDED'];
	else if($_SERVER['REMOTE_ADDR'])
	$ipaddress = $_SERVER['REMOTE_ADDR'];
	else
	$ipaddress = 'UNKNOWN';
	return $ipaddress;
}
?>
  		<div  role="form">
		  		<div class="container">
		  			<h5 class="bold">FORMULARIO DE LIBERAÇÃO DE REDE</h5>
					   	<div class="form-group">
					    	<label for="exampleInputEmail1">Nome (Verificar ***)<red>*</red></label>
					    	<input type="text" class="form-control" id="nome" placeholder="">
		 				 </div>
		 				 
		 				<div class="table">	
		 					
		 					<div class="col1">
								<div class="form-group">
				    				<label for="exampleInputEmail1">Secretaria<red>*</red></label>
									<input type="text" class="form-control" id="secretaria" placeholder="" >
								</div>
								
								<div class="form-group">
				    				<label for="exampleInputEmail1">CPF<red>*</red></label>
									<input type="text" class="form-control" id="cpf" placeholder="">
								</div>
								
								<div class="form-group">
				    				<label for="exampleInputEmail1">Matricula<red>*</red></label>
									<input type="text" class="form-control" id="matricula" placeholder="">	
								</div>
								<div class="form-inline">	
									<label><input type="checkbox"  id="ip" placeholder="" checked>	
									Quero a liberação de Rede para o usuário no qual estou autenticado preenchendo este formulário</label>
								</div>
								
							</div>
							
							<div class="col2">
								<div class="form-group">
				    				<label for="exampleInputEmail1">Setor / Função<red>*</red></label>
									<input type="text" class="form-control" id="setor" placeholder="">
								</div>
							
								<div class="form-group">
				    				<label for="exampleInputEmail1">Identidade<red>*</red></label>
									<input type="text" class="form-control" id="identidade" placeholder="">
								</div>
								
								<div class="form-group">
				    				<label for="exampleInputEmail1">Telefone<red>*</red></label>
									<input type="text" class="form-control" id="telefone" placeholder="">
								</div>
								
							</div>
							<div class="form-inline ">	
									 &nbsp&nbsp&nbsp <label for="exampleInputEmail1">IP: &nbsp</label><input type="text" class="form-control" id="ipNumero" placeholder="" value="<?php echo get_client_ip(); ?>" disabled>
							<br><br>
							</div>
							
		  			    </div>
												
		  			  <p><red>*</red>Campos obrigatorios</p>
		  			  <p>**A entrega do documento impresso deve ser feita em até 5 dias na Rua Tenente Silveira, nº 60 - Ático - Sala do Governo Eletrônico - Centro <br> CEP: 88010-300 (Diretoria de Sistemas de Governo Eletrônico)</p>
		  			  <p>***Preencher entre parêntesis após o nome ou matricula do usuário o qual deseja a liberação.</p>
		  			  <p><red><strong>****Ao clicar em enviar será gerado um termo de responsabilidade para impressão.</strong></red></p>
		  			<div id="documento">
		  				<?php
		  					include "parteCimaIP.php";
		  					include "documentoLiberacaoIP.php";
							echo "</div>";
							echo "</div>";
		  				?>
		  			</div>
				  <div class="checkbox">
				    <label for="exampleInputEmail1">
				      <input type="checkbox" id="check"><p>Declaro, nesta data, ter ciência e estar de acordo com os procedimentos acima descritos, comprometendo-me a respeitá-los e cumpri-los plena e integralmente. </p>
				    </label
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
			
			$('#ip').bind('click',function(){
	    		if($(this).is(':checked') ){
	    			$('#ipNumero').prop( "disabled", true );
					$('#ipNumero').val("<?php echo get_client_ip();?>");
	    		}else{
	    			$('#ipNumero').prop( "disabled", false );
	    		}
	    	});
	    	
		jQuery(function($){
		       $("#cpf").mask("999.999.999-99");
		       $("#telefone").mask("(99) 9999-9999?9");
			  
		});
		
		$('input').bind('focus',function(){
			$('#error').addClass('hide');
		});
		
		
		$('#sendPesquisa').bind('click',function(){
			$('#error').addClass('hide');
			
			var err = '';
			var obj = {
				nome : $('#nome').val(),
				setor : $('#setor').val(),
				cpf : $('#cpf').val(),
				matricula : $('#matricula').val(),
				secretaria : $('#secretaria').val(),
				identidade : $('#identidade').val(),
				telefone : $('#telefone').val(),
				ip : $('#ipNumero').val()					
			};
				$.post( "backend/formLiberacaoIpReq.php", obj).done(function( data ) {	
			    	var retorno = jQuery.parseJSON(data);
			    	if(retorno.success == 1){
			    		location.href = "backend/printLiberacaoIP.php";
			    	}else{
			    		$('#error').text(retorno.error).removeClass('hide');
			    		
			    	}
			    	
			    	console.log( data );
				});
			 
		});
	    </script>
  		
  	</body>