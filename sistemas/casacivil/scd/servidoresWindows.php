<?php
session_start();
if(!$_SESSION['login']){ 
	header('Location: ../loginADM.php'); 
}else{ 
	if($_SESSION['permissoes'] != 0){ 
		header('Location: decidirADM.php'); 
	}
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
		
	<title>Servidores Windows</title>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-theme.min.css">
	<script src="js/bootstrap.min.js"></script>
</head>
<body>
	<div class="headerLogin bg-primary">
		<input type='button' value='Sair' class='sair btn btn-default btn-xs'>
		<input type='button' value='Home' class='home btn btn-default btn-xs'>
		<div id="nomeUsuario"><strong>Nome: </strong><?php echo $_SESSION['login'];?></div>
	</div>

	<div  class="loginAdm masthead">
		<div class="boxDecisao">
			<button type="button" class="btn btn-primary" id="adicionar">Adicionar Novo</button>
			<button type="button" class="btn btn-primary" id="exportar">Exportar</button>
			<button type="button" class="btn btn-primary" id="voltar">Voltar</button>
		</div>
	</div>
	
	<div class="tabelaServidor">
		<table class="table table-striped table-bordered">
  			<tr>
  				<th>N</th>
  				<th>Name VM (CIASC)</th>
  				<th>Host Name</th>
  				<th>IP Address</th>
  				<th>DISCO</th>
  				<th>Memoria</th>
  				<th>CORE</th>
  				<th>OS</th>
  				<th>VM Serial</th>
  				<th>Server SerialKey</th>
  				<th>Serviços</th>
  				<th>Login</th>
  				<th>Portas</th>
  				<th>Editar</th>
  				<th>Excluir</th>
  			</tr>
			<?php 
				include "backend/SelectServidoresWindows.php";
				echo $tabela;
			?>
  		</table>
	</div>
<script type="text/javascript">
	function editar(id){
		location.href = "AdicionarServidorWindows.php?id=" + id;
	}

	function verPortas(id){
		location.href = "verPortasWindows.php?id=" + id;
	}

	function excluir(id){
		var confirmacao = confirm('Você deseja excluir?');
		if(confirmacao){
			var err = '';
			var obj = {
				id : id
			};

			$.post( "backend/deleteServidorWindows.php", obj).done(function( data ) {	
		    	var retorno = jQuery.parseJSON(data);
			    if(retorno.success != 1){
			    	$('#error').text(retorno.error).removeClass('hide');
			    } else{
			    	location.href = '';
			    }	
			});
		}
	}

	$('.home').bind('click',function(){
		location.href = "decidirADM.php";
	});

	$('#exportar').bind('click',function(){
		location.href = "exportarWindows.php";
	});

	$('.sair').bind('click',function(){
		location.href = "loginADM.php";
	});	

	$('#voltar').bind('click', function(){
		location.href = "decidirADM.php";
	})

	$('#adicionar').bind('click',function(){
		location.href = "AdicionarServidorWindows.php";
	});

	$('#submit').bind('click',function(){
		$('#error').addClass('hide');
		var err = '';
		var obj = {
			name_vm      : $('#name_vm').val(),
			host_name    : $('#host_name').val(),
			ip           : $('#ip').val(),
			disco        : $('#disco').val(),
			memoria      : $('#memoria').val(),
			core 	     : $('#core').val(),
			os           : $('#os').val(),
			vm_serial    : $('#vm_serial').val(),
			server_serial: $('#server_serial').val(),
			servicos     : $('#servicos').val(),
			login        : $('#login').val()
		};

		$.post( "backend/formServWindowsReq.php", obj).done(function( data ) {	
	    	var retorno = jQuery.parseJSON(data);
		    if(retorno.success == 1){
		    	location.href = "servidoresWindows.php";
		    }else{
		    	$('#error').text(retorno.error).removeClass('hide');			    		
			}			    	
		});
	});
</script>
</body>
</html>