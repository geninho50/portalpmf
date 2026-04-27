<?php

session_start();
if(!$_SESSION['login']){ header('Location: loginADM.php'); } 
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<link href="/../../layout/imagens/brasao.gif" rel="shortcut icon" type="image/x-icon">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="http://www.pmf.sc.gov.br/sistemas/casacivil/scd/estilo.css" />
		<title>ADMIN liberação IP</title>
		
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
		
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
		
		<!-- Optional theme -->
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
		
		<!-- Latest compiled and minified JavaScript -->
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
  	</head>
  	<body>
  		<div class="headerLogin bg-primary">	
  			<input type='button' value='Sair' class='sair btn btn-default btn-xs'>
  			<input type='button' value='Home' class='home btn btn-default btn-xs'>
  			<div id="nomeUsuario"><strong>Nome: </strong><?php echo $_SESSION['login'];?></div>
  			<div class="tituloPag">Liberação de VPN</div>
  		</div>
  		
  		<h5 class="tituloTabela">Aguardando Liberação</h5>
  		
  		<div class="overflow">
	  		<table class="table table-striped table-bordered text-capitalize">
	  			<tr>
	  				<th class="nomeTabelaVPN">Nome</th>
	  				<th>Instituição</th>
	  				<th>Entidade</th>
	  				<th>E-mail</th>
	  				<th>Ver mais</th>
	  			</tr>
	  				<?php 
	  				include "selectVPN.php";
					if($aguardando == ''){
						$aguardando = "<tr><td colspan=5> Nenhum usuario aguardando liberação</td></tr>";	
					}
					echo $aguardando;
	  				?>
	  			
	  		</table>
  		</div>
  		
  		<h5 class="tituloTabela">Aprovado</h5>
  		
 		<div class="overflow">
	  		<table class="table table-striped table-bordered text-capitalize">
	  			<tr>
	  				<th class="nomeTabelaVPN">Nome</th>
	  				<th>Instituição</th>
	  				<th>Entidade</th>
	  				<th>E-mail</th>
	  				<th>Ver mais</th>
	  			</tr>
	  			<?php  
	  			if($aprovado == ''){
						$aprovado = "<tr><td colspan=5> Nenhum usuario aprovado</td></tr>";	
				}
	  			echo $aprovado; 
	  			?>
	  		</table>
  		</div>

  		<h5 class="tituloTabela">Cancelada</h5>	
  		
  		<div class="overflow">
	  		<table class="table table-striped table-bordered text-capitalize">
	  			<tr>
	  				<th class="nomeTabelaVPN">Nome</th>
	  				<th>Instituição</th>
	  				<th>Entidade</th>
	  				<th>E-mail</th>
	  			</tr>
	  				<?php  
	  				if($cancelado == ''){
						$cancelado = "<tr><td colspan=5> Nenhum usuario cancelado</td></tr>";	
					}
	  				echo $cancelado; 
	  				?>
	  		</table>
  		</div>
  		<div class="alert alert-danger hide" id="error"> </div>
  		<script src="http://www.pmf.sc.gov.br/sistemas/casacivil/scd/jquery.maskedinput.js"></script>
  		<script>
		$('.botaoVerMais').bind('click',function(){
			$('#error').addClass('hide');
			id = $(this).attr('id');
			var obj = { id : id };
			$.post( "backend/SELverMaisVPN.php", obj).done(function( data ) {
				var retorno = jQuery.parseJSON(data);
				if(retorno.success == 1){
					location.href ="backend/verMaisVPN.php";
				}else{
					$('#error').text(retorno.error).removeClass('hide');
				}
				console.log( data );
			});
		});
		$('.home').bind('click',function(){
				location.href = "decidirADM.php";
		});
		$('.sair').bind('click',function(){
			location.href = "loginADM.php";
		});	
	    </script>
  	</body>