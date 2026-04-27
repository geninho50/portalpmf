<!DOCTYPE html>
<html lang="en">
	<head>
		<link href="/../../layout/imagens/brasao.gif" rel="shortcut icon" type="image/x-icon">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="http://www.pmf.sc.gov.br/sistemas/casacivil/scd/estilo.css" />
		
		<title>Pesquisa Mercado Público</title>
		
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
		  			<h5 class="bold">FORMULARIO DE PESQUISA NO BANCO DE DADOS</h5>
		  			
					   	<div class="form-group">
					    	<label for="exampleInputEmail1">Nome</label>
					    	<input type="text" class="form-control" id="nome" placeholder="">
		 				 </div>
		 				 
		 				<div class="table">	
		 					
		 					<div class="col1">
								<div class="form-group">
				    				<label for="exampleInputEmail1">Setor</label>
									<input type="text" class="form-control" id="setor" placeholder="" >
								</div>
								
								<div class="form-group">
				    				<label for="exampleInputEmail1">CPF</label>
									<input type="text" class="form-control" id="cpf" placeholder="">
								</div>
								
								<div class="form-group">
				    				<label for="exampleInputEmail1">Matricula</label>
									<input type="text" class="form-control" id="matricula" placeholder="">	
								</div>
							</div>
							
							<div class="col2">
								<div class="form-group">
				    				<label for="exampleInputEmail1">Função</label>
									<input type="text" class="form-control" id="funcao" placeholder="">
								</div>
							
								<div class="form-group">
				    				<label for="exampleInputEmail1">Identidade</label>
									<input type="text" class="form-control" id="identidade" placeholder="">
								</div>
								
								<div class="form-group">
				    				<label for="exampleInputEmail1">Telefone</label>
									<input type="text" class="form-control" id="telefone" placeholder="">
								</div>
							</div>
							
		  			    </div>
		  			    <button type="button" id="sendPesquisa" class="btn btn-primary">Pesquisar</button>
		    </div>
	    </div>
	    <script src="http://www.pmf.sc.gov.br/sistemas/casacivil/scd/jquery.maskedinput.js"></script>
	    <script>

		jQuery(function($){
		       $("#cpf").mask("999.999.999-99");
		       $("#telefone").mask("(99) 9999-9999?9");
		       $("#nascimento").mask("99/99/9999");
		});
		
		$('input').bind('focus',function(){
			$('#error').addClass('hide');
		});
		
		$('#sendPesquisa').bind('click',function(){
			$('#error').addClass('hide');
			
			var err = '';
			var obj = {
				nome_instituicao : $('#nome_instituicao').val(),
				razao_social : $('#razao_social').val(),
				nome : $('#nome').val(),
				cpf : $('#cpf').val(),	
				naturalidade : $('#naturalidade').val(),
				email : $('#email').val(),
				nascimento : $('#nascimento').val(),
				uf : $('#uf').val(),
				matricula : $('#matricula').val(),
				adicional : $('#adicional').val(),
				motivo : $('#motivo').val()
			};
			
			$.post( "selectIP.php", obj).done(function( data ) {	
			 var retorno = jQuery.parseJSON(data);
			 if(retorno.success == 1){
			 	location.href = "adminTabelaIP.php";
			 }else{
			   	$('#error').text(retorno.error).removeClass('hide');
			  }
			 console.log( data );
		});
		

		});
	    </script>
  		
  	</body>