<?php
session_start();
if(!$_SESSION['login']){ header('Location: loginADM.php'); }
	else{ if($_SESSION['permissoes'] != 0){ header('Location: decidirADM.php'); }
}
?>

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
  		<div class="headerLogin bg-primary">	
  			<input type='button' value='Sair' class='sair btn btn-default btn-xs'>
  			<input type='button' value='Home' class='home btn btn-default btn-xs'>
  			<div id="nomeUsuario"><strong>Nome: </strong><?php echo $_SESSION['login'];?></div>
  			<div class="tituloPag">Certificação Digital</div>
  		</div>
  		
  		<h5 class="tituloTabela">Aguardando Liberação</h5>
  		
  		<div class="overflow">
	  		<table class="table table-striped table-bordered ">
	  			<tr>
	  				<th class="nomeTabela">Nome</th>
	  				<th>CPF</th>
	  				<th>Nascimento</th>
	  				<th>Tipo de Funcionario</th>
	  				<th>Data</th>
	  				<th>Anos para expiração</th>
	  				<th>Liberar</th>
	  				<th>Ver mais</th>
	  			</tr>
	  				<?php
	  				include "selectCD.php";
					if($aguardando == ''){
						$aguardando = "<tr><td colspan=8> Nenhuma Certificação aguardando liberação</td></tr>";	
					}
					echo $aguardando;
	  				?>
	  			
	  		</table>
  		</div>
  		
  		<h5 class="tituloTabela">Liberado</h5>
  		
 		<div class="overflow">
	  		<table class="table table-striped table-bordered ">
	  			<tr>
	  				<th class="nomeTabela">Nome</th>
	  				<th>CPF</th>
	  				<th>Nascimento</th>
	  				<th>Tipo de Funcionario</th>
	  				<th>Data Liberacao</th>
	  				<th>Ver mais</th>
	  			</tr>
	  				<?php 
		  				if($liberado == ''){
							$liberado = "<tr><td colspan=6> Nenhuma Certificação Liberada</td></tr>";	
						}
						echo $liberado; 
					?>
	  		</table>
  		</div>

		<h5 class="tituloTabela">Expirado</h5>
  		
 		<div class="overflow">
	  		<table class="table table-striped table-bordered ">
		  		<tr>
	  				<th class="nomeTabela">Nome</th>
	  				<th>CPF</th>
	  				<th>Nascimento</th>
	  				<th>Tipo de Funcionario</th>
	  				<th>Data Liberação</th>
	  				<th>Data Expiração</th>
	  				<th>Ver mais</th>
	  			</tr>
	  				<?php 
		  				if($expirado == ''){
							$expirado = "<tr><td colspan=7> Nenhuma Certificação expirada</td></tr>";	
						}
						echo $expirado; 
					?>
	  		</table>
  		</div>
		
  		
  		<div class="alert alert-danger hide" id="error"> </div>
  		<script src="http://www.pmf.sc.gov.br/sistemas/casacivil/scd/jquery.maskedinput.js"></script>
  		<script>

  		jQuery(function($){
		       $(".QtdAnoExpiracao").mask("9");
		       $(".dataLiberacao").mask("99/99/9999");
		});

		$('.botaoVerMais').bind('click',function(){
			$('#error').addClass('hide');
			id = $(this).attr('id');
			var obj = { id : id };
			$.post( "backend/SELverMaisCD.php", obj).done(function( data ) {
				var retorno = jQuery.parseJSON(data);
				if(retorno.success == 1){
					location.href ="backend/verMaisCD.php";
				}else{
					$('#error').text(retorno.error).removeClass('hide');
				}
				console.log( data );
			});
		});

		$('.botaoLiberar').bind('click',function(){
				
			$('#error').addClass('hide');
				

				var err = '';
				var obj = {
					id : $(this).attr('id'),
					ano : $('#ano'+$(this).attr('id')).val(),
					data : $('#data'+$(this).attr('id')).val(),
					acao : 1
				};
				$.post( "backend/alteracaoStatusCD.php", obj).done(function( data ) {	
			    	var retorno = jQuery.parseJSON(data);
			    	if(retorno.success == 0){
			    		$('#error').text(retorno.error).removeClass('hide');
			    	}else{
			    		location.href ="certificacaoDigital.php";
			    	}
			    	console.log( data );
				});
			 
		});
		
		$('.sair').bind('click',function(){
			location.href = "loginADM.php";
		});	


		$('.home').bind('click',function(){
			location.href = "decidirADM.php";
		});
	    </script>
  	</body>