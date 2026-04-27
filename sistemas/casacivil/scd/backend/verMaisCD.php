<?php 
session_start();
if(!$_SESSION['login']){ header('Location: ../loginADM.php'); }

include "db.php"; 
include "funcoes.php";
$id = $_SESSION['id'];

$sql = $db->prepare("SELECT * FROM scd.certificacaodigital where id = $id");
$sql->execute();
$data = $sql->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<link href="/../../layout/imagens/brasao.gif" rel="shortcut icon" type="image/x-icon">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="http://www.pmf.sc.gov.br/sistemas/casacivil/scd/estilo.css" />
		
		<title>Formulário Certificação Digital</title>
		
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
		
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		
		<!-- Optional theme -->
		<link rel="stylesheet" href="../css/bootstrap-theme.min.css">
		
		<!-- Latest compiled and minified JavaScript -->
		<script src="../js/bootstrap.min.js"></script>
		
  	</head>
  	<body>
  		<div class="headerLogin bg-primary">
  			<input type='button' value='Sair' class='sair btn btn-default btn-xs'>
  			<input type='button' value='Home' class='home btn btn-default btn-xs'>
  			<div id="nomeUsuario"><strong>Nome: </strong><?php echo $_SESSION['login'];?></div>
  			<div class="tituloPag">Certificação Digital</div>
  		</div>
  		<h5 class="tituloTabela">Dados Certificação Digital</h5>
  		<div class="container">
  			<div class="tabela tabelaVPN ">
  				
  				<div class="linha">
  					<div class="form-group">
  						<strong>Nome:</strong> <?php  echo utf8_decode($data['nome']);?>
  					</div>
  				</div>
				<div class="linha">
	  				<div class="form-group">
						<?php 
							$dataNasc = explode("-",$data['nascimento']);
							$data['nascimento'] = $dataNasc[2]."/".$dataNasc[1]."/".$dataNasc[0];
						?>
	  					 <strong>Data de Nascimento:</strong> <?=$data['nascimento']; ?>
	  				</div>
				</div>
	  			<div class="linha">
					<div class="form-group">
  						<strong>CPF:</strong> <?=$data['cpf']?> 
  					</div>
				</div>
				<div class="linha">
  					<div class="form-group">
  						<strong>RG:</strong> <?=$data['rg'];?>  <strong>Órgão:</strong> <?=$data['orgao'];?> / <?=$data['estadoRg'];?>
  					</div>
				</div>  

				<div class="linha">
	  				<div class="form-group">
	  					<strong>PIS:</strong> <?=$data['pis'];?>
	  				</div>
	  			</div>
				<div class="linha">
	  				<div class="form-group">
	  					<strong>Titulo:</strong> <?=$data['titulo'];?> <strong>Zona:</strong> <?=$data['zona'];?> <strong>Seção:</strong> <?=$data['secao'];?> 
						<strong>Cidade:</strong> <?=$data['cidade'];?> / <?=$data['estadoTitulo'];?>
	  				</div>
	  			</div>
				<div class="linha">
	  				<div class="form-group">
	  					<strong>E-mail:</strong> <?=$data['email'];?>
	  				</div>
	  			</div>
				
				<?php if($data['liberacao'] > 0) { ?>
				<div class="linha">
	  				<div class="form-group">
	  					<strong>Data de Liberação:</strong> 
						<?php  
							$nova_data = explode("-", $data['dataLiberacao']);
							$data['dataLiberacao'] = "$nova_data[2]/$nova_data[1]/$nova_data[0]";
							echo $data['dataLiberacao']; 
						?>
	  				</div>
	  			</div>	
				<?php } ?>
				
				<?php if($data['liberacao'] == 2) { ?>
				<div class="linha">
	  				<div class="form-group">
	  					<strong>Data de Expiração:</strong> 
						<?php  
							$novaDataE = explode("-", $data['dataExpiracao']);
							$data['dataExpiracao'] = "$novaDataE[2]/$novaDataE[1]/$novaDataE[0]";
							echo $data['dataExpiracao']; 
						?>
	  				</div>
	  			</div>	
				<?php } ?>
				
				<div class="linha">
	  				<div class="form-group">
	  					<strong>Tipo de Funcionário:</strong> <?php  echo tipoDeFuncionario($data['tipoFuncionario']);?>
					
	  				</div>
	  			</div>				
				
	  			<div class="linha">
  					<div class="form-group">
  						<strong>Status:</strong> <?php  echo liberacaoCertificacaoDigital($data['liberacao']); ?>
  					</div>
  				</div>
  				
  			</div>
	  	</div>
		  		<div class="botoesVerMais">
					  <?php 
					   
			  		if($data['liberacao'] == 0){
			  			echo "<input type='button' value='LIBERAR' class='botaoLiberar btn btn-success btn-xs' id=$id>";
						
			  		}
			  		?>
			  		
			  		<input type='button' value='VOLTAR' class='voltar btn btn-default btn-xs'>
		  		</div>
				
		  		<div class="alert alert-danger hide" id="error">  </div>
	  		 <script src="http://www.pmf.sc.gov.br/sistemas/casacivil/scd/jquery.maskedinput.js"></script>
		    <script>

			$('.voltar').bind('click',function(){
				location.href = "../certificacaoDigital.php";
			});
			
			$('.home').bind('click',function(){
				location.href = "../decidirADM.php";
			});
			
			$('.botaoLiberar').bind('click',function(){
			$('#error').addClass('hide');
			
				var err = '';
				var obj = {
					id : $(this).attr('id'),
					acao : 1
				};
				$.post( "alteracaoStatusCD.php", obj).done(function( data ) {	
			    	var retorno = jQuery.parseJSON(data);
			    	if(retorno.success == 0){
			    		$('#error').text(retorno.error).removeClass('hide');
			    	}else{
			    		location.href ="../certificacaoDigital.php";
			    	}
			    	console.log( data );
				});
			 
			});
		$('.finalizar').bind('click',function(){
			$('#error').addClass('hide');
			
				var err = '';
				var obj = {
					id : $(this).attr('id'),
					observacao : $('#observacao').val(),
					acao : 3
				};
				$.post( "alteracaoStatus.php", obj).done(function( data ) {	
			    	var retorno = jQuery.parseJSON(data);
			    	if(retorno.success == 1){
			    		location.href = "../adminIP.php";
			    	}else{
			    		$('#error').text(retorno.error).removeClass('hide');
			    	}
			    	console.log( data );
				});
		});
		$('.revogar').bind('click',function(){
			$('#error').addClass('hide');
			
				var err = '';
				var obj = {
					id : $(this).attr('id'),
					acao : 2
				};
				$.post( "alteracaoStatus.php", obj).done(function( data ) {	
			    	var retorno = jQuery.parseJSON(data);
			    	if(retorno.success == 1){
			    		location.href = "../adminIP.php";
			    	}else{
			    		$('#error').text(retorno.error).removeClass('hide');
			    		
			    	}
			    	
			    	console.log( data );
				});
		});	
		
		$('.sair').bind('click',function(){
			location.href = "../loginADM.php";
		});	
			
		    </script>
	</body>  		
