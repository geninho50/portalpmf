<? 
session_start();
if(!$_SESSION['login']){ 
	header('Location: http://www.pmf.sc.gov.br/sistemas/casacivil/scd/loginADM.php'); 
}else{ 
	if($_SESSION['permissoes'] != 0 && $_SESSION['permissoes'] != 2){ 
		header('Location: http://www.pmf.sc.gov.br/sistemas/casacivil/scd/decidirADM.php'); 
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Cadastro Thema</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
	<script src="js/jquery-2.1.4.min.js" type="text/javascript"></script>
	<script src="js/jquery.maskedinput.min.js" type="text/javascript"></script>
	<link rel="stylesheet" href="estilos.css">
	<link href='https://fonts.googleapis.com/css?family=Montserrat:700' rel='stylesheet' type='text/css'>
</head>
<body>

	<h1 class="center">Liberação de Acesso</h1>
	<div class="menu">
		<button type="button" class="btn btn-primary" id="adicionar">Adicionar Novo</button>
		<button type="button" class="btn btn-primary" id="voltar">Sair</button>
	</div>
	
	<div class="tabelaCadastrados table table-striped">
		<table class="table table-striped table-bordered">
			<h5 class="titulotabela">Aguardando</h5>
  			<tr>
  				<th>N</th>
  				<th>Nome</th>
  				<th>Telefone</th>
  				<th>CPF</th>
  				<th>Secretaria/Órgão que irá trabalhar</th>
  				<th>Movimentações que serão efetuadas</th>
  				<th>Status</th>
  				<th>Editar</th>
  				<th>Excluir</th>
  			</tr>
			<? 
				include "backend/selectCadastros.php";
				echo $tabela;
			?>
  		</table>
	</div>

	<div class="tabelaCadastrados table table-striped">
		<table class="table table-striped table-bordered">
			<h5 class="titulotabela">Aprovados</h5>
  			<tr>
  				<th>N</th>
  				<th>Nome</th>
  				<th>Telefone</th>
  				<th>CPF</th>
  				<th>Secretaria/Órgão que irá trabalhar</th>
  				<th>Movimentações que serão efetuadas</th>
  				<th>Status</th>
  				<th>Editar</th>
  				<th>Excluir</th>
  			</tr>
			<? 
				include "backend/selectAprovados.php";
				echo $tabela;
			?>
  		</table>
	</div>
<script type="text/javascript">
	function editar(id){
		location.href = "cadastro.php?id=" + id;
	}

	function excluir(id){
		var confirmacao = confirm('Você deseja excluir?');
		if(confirmacao){
			var err = '';
			var obj = {
				id : id
			};

			$.post( "backend/deleteCadastro.php", obj).done(function( data ) {	
		    	var retorno = jQuery.parseJSON(data);
			    if(retorno.success != 1){
			    	$('#error').text(retorno.error).removeClass('hide');
			    } else{
			    	location.href = '';
			    }	
			});
		}
	}

	$('#adicionar').bind('click',function(){
		location.href = "cadastro.php";
	});

	$('#voltar').bind('click',function(){
		location.href = "http://www.pmf.sc.gov.br/sistemas/casacivil/scd/loginADM.php";
	});

	$('#submit').bind('click',function(){
		$('#error').addClass('hide');
			
		var err = '';
		var obj = {
			name_vm      : $('#nome').val(),
			host_name    : $('#telefone').val(),
			ip           : $('#cpf').val(),
			disco        : $('#orgao').val(),
			memoria      : $('#movimentacao').val()
		};

		$.post( "backend/cadastroReq.php", obj).done(function( data ) {	
	    	var retorno = jQuery.parseJSON(data);
		    if(retorno.success == 1){
		    	location.href = "cadastrados.php";
		    }else{
		    	$('#error').text(retorno.error).removeClass('hide');			    		
			}			    	
		});
	});
</script>
</body>
</html>