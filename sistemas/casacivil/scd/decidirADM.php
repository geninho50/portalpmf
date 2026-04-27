<?php
session_start();
if(!$_SESSION['login']){ header('Location: ../loginADM.php'); }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link href="/../../layout/imagens/brasao.gif" rel="shortcut icon" type="image/x-icon">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="estilo.css" />
		
	<title>Formulario liberação IP</title>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-theme.min.css">
	<script src="js/bootstrap.min.js"></script>	
</head>
<body>
	<div class="headerLogin bg-primary">
		<input type='button' value='Sair' class='sair btn btn-default btn-xs'>
		<div id="nomeUsuario"><strong>Nome: </strong><?php echo $_SESSION['login'];?></div>
	</div>
	<div  role="form">
		<div  class="loginAdm masthead">
			<div class="boxDecisao">
			<?php if($_SESSION['permissoes'] == 0 || $_SESSION['permissoes'] == 1 ){?>

				<div class="form-group">
					<button type="button" class="btn btn-default" id="impressora">Tutorial Impressora</button>
				</div>

				<div class="form-group">
					<button type="button" class="btn btn-default" id="liberacaoIP">Liberação IP</button>
				</div>

				<div class="form-group mostra2" aria-hidden="true">
						<button type="button" class="btn btn-default" id="servidores">Comunicação <strong>(Em Construção)</strong></button>
					</div>

					<div class="form-group esconde2" aria-hidden="true">
						<button type="button" class="btn btn-default" id="servidores">Comunicação <strong>(Em Construção)</strong></button>
					</div>
					<div id='mais_inf2'>	
						<div class="form-group">
							<button type="button" class="btn btn-default" id="voz">Voz</button>
						</div>
						<div class="form-group">
							<button type="button" class="btn btn-default" id="dados">Dados</button>
						</div>
				</div>
		
				<div class="form-group">
					<button type="button" class="btn btn-default" id="liberacaoVPN">Liberação VPN</button>
				</div>

				<?php } if($_SESSION['permissoes'] == 0){?>
					<div class="form-group mostra" aria-hidden="true">
						<button type="button" class="btn btn-default" id="servidores">Servidores</button>
					</div>

					<div class="form-group esconde" aria-hidden="true">
						<button type="button" class="btn btn-default" id="servidores">Servidores</button>
					</div>
					<div id='mais_inf'>	
						<div class="form-group">
							<button type="button" class="btn btn-default" id="servidoresWindows">Servidores Windows</button>
						</div>
						<div class="form-group">
							<button type="button" class="btn btn-default" id="servidoresLinux">Servidores Linux</button>
						</div>
					</div>
				<?php } ?>


				<?php if($_SESSION['permissoes'] == 0 || $_SESSION['permissoes'] == 2 ){?>
					<div class="form-group">
						<button type="button" class="btn btn-default" id="thema">Thema</button>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
		
<script src="http://www.pmf.sc.gov.br/sistemas/casacivil/scd/jquery.maskedinput.js"></script>
	<script>
		$('#liberacaoIP').bind('click',function(){
			location.href = "adminIP.php";
		});
		
		$('#liberacaoVPN').bind('click',function(){
			location.href = "adminVPN.php";
		});
		
		$('#servidoresWindows').bind('click',function(){
			location.href = "servidoresWindows.php";
		});

		$('#servidoresLinux').bind('click',function(){
			location.href = "servidoresLinux.php";
		});

		$('#certificacaoDigital').bind('click',function(){
			location.href = "certificacaoDigital.php";
		});
			
		$('.sair').bind('click',function(){
			location.href = "loginADM.php";
		});
		
		$('#impressora').bind('click',function(){
			location.href = "http://www.pmf.sc.gov.br/tutoriais/impressoras/";
		});

		$('#thema').bind('click',function(){
			location.href = "http://www.pmf.sc.gov.br/sistemas/thema/cadastrados.php";
		});
		

		$('#mais_inf').hide();
		$('.esconde').hide();

		$('.mostra').click(function() {
			$("#mais_inf").show();
			$('.mostra').hide();
			$('.esconde').show();
		});

		$('.esconde').click(function() {
			$("#mais_inf").hide();
			$('.mostra').show();
			$('.esconde').hide();
		});

		$('#mais_inf2').hide();
		$('.esconde2').hide();

		$('.mostra2').click(function() {
			$("#mais_inf2").show();
			$('.mostra2').hide();
			$('.esconde2').show();
		});

		$('.esconde2').click(function() {
			$("#mais_inf2").hide();
			$('.mostra2').show();
			$('.esconde2').hide();
		});
	</script>
</body>