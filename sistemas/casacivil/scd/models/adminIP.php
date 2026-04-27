<? 
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
		<link rel="stylesheet" type="text/css" href="estilo.css" />
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
  			<div id="nomeUsuario"><strong>Nome: </strong><?echo $_SESSION['login'];?></div>
  			<div class="tituloPag">Liberação de IP</div>
  		</div>
  		
  		
  		
  		<div class="overflow" id="aguardando">
	  		<table class="table table-striped table-bordered text-capitalize">
	  			<h5 class="tituloTabela" style="background-color: #F2DEDE;">Aguardando Liberação</h5>
	  			<tr>
	  				<th class="nomeTabela">Nome</th>
	  				<th>Setor</th>
	  				<th>Função</th>
	  				<th>Telefone</th>
	  				<th>Ver mais</th>
	  			</tr>
	  				<?
	  				include "selectIP.php";
					if($aguardando == ''){
						$aguardando = "<tr><td colspan=5> Nenhum usuario aguardando liberação</td></tr>";	
					}
					echo $aguardando;
	  				?>
	  			
	  		</table>
  		</div>

 		<div class="overflow" id="aprovado">
	  		<table class="table table-striped table-bordered text-capitalize">
	  			<h5 class="tituloTabela" style="background-color: #FCF8E3;">Aprovado</h5>
	  			<tr>
	  				<th class="nomeTabela">Nome</th>
	  				<th>Setor</th>
	  				<th>Função</th>
	  				<th>Telefone</th>
	  				<th>Ver mais</th>
	  			</tr>
	  				<? 
		  				if($aprovado == ''){
							$aprovado = "<tr><td colspan=5> Nenhum usuario aprovado</td></tr>";	
						}
						echo $aprovado; 
					?>
	  		</table>
  		</div>

		
  		
 		<div class="overflow" id="finalizado">
	  		<table class="table table-striped table-bordered text-capitalize">
	  			<h5 class="tituloTabela" style="background-color: #DFF0D8;">Finalizado</h5>
	  			<tr>
	  				<th class="nomeTabela">Nome</th>
	  				<th>Setor</th>
	  				<th>Função</th>
	  				<th>Telefone</th>
	  				<th>Ver mais</th>
	  			</tr>
	  				<? 
		  				if($finalizado == ''){
							$finalizado = "<tr><td colspan=5> Nenhuma solicitação finalizada</td></tr>";	
						}
						echo $finalizado; 
					?>
	  		</table>
  		</div>
		
  		
  		
  		<div class="overflow">
	  		<table class="table table-striped table-bordered text-capitalize">
	  			<h5 class="tituloTabela"  style="background-color: #DDD;">Cancelada</h5>	
	  			<tr>
	  				<th class="nomeTabela">Nome</th>
	  				<th>Setor</th>
	  				<th>Função</th>
	  				<th>Telefone</th>
	  			</tr>
	  				<? 
		  				if($cancelado == ''){
							$cancelado = "<tr><td colspan=5> Nenhum usuario cancelado</td></tr>";	
						}
		  				echo $cancelado; 
	  				?>
	  		</table>
  		</div>
  		<div class="boxprocurar">
  			<input type="text" class="procurarCampo "> 
			<input type="button" class="btn btn-default porcurarBot" value="Procurar"> 
  		</div>
  		<div class="alert alert-danger hide" id="error"> </div>
  		<script src="http://www.pmf.sc.gov.br/sistemas/casacivil/scd/jquery.maskedinput.js"></script>
  		<script>

  		$('.overflow').bind('click',function(){
  			if( $(this).css("height") == "600px"){
  				$(this).css("height", "50px");
  			}else{
  				$(this).css("height", "600px");
  			}
  		});

		$('.botaoVerMais').bind('click',function(){
			$('#error').addClass('hide');
			id = $(this).attr('id');
			var obj = { id : id };
			$.post( "backend/SELverMaisIP.php", obj).done(function( data ) {
				var retorno = jQuery.parseJSON(data);
				if(retorno.success == 1){
					location.href ="backend/verMaisIP.php";
				}else{
					$('#error').text(retorno.error).removeClass('hide');
				}
				console.log( data );
			});
		});
		
		$('.porcurarBot').bind('click',function(){
			$('#error').addClass('hide');
			campo = $('.procurarCampo').val();
			var obj = { campo : campo };
			$.post( "backend/SELprocuraIP.php", obj).done(function( data ) {
				var retorno = jQuery.parseJSON(data);
				if(retorno.success == 1){
					
				}else{
					$('#error').text(retorno.error).removeClass('hide');
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