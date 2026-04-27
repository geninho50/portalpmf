<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');
include_once("../banco/gdb.php");

$gdb = new gdb(); 
$gdb2 = new gdb(); 

date_default_timezone_set('America/Sao_Paulo');
$atual = date('Y-m-d');


$cpf = $_GET['cpf'];

if($cpf == ''){
	header('Location: index.php');
}



$gdb2->open("select cpf
	FROM adm
	WHERE cpf = '$cpf'");

$select = "select c.id,
a.diaInteiro,
DATE_FORMAT(a.data,'%d/%m/%Y') as data,
TIME_FORMAT(a.horario,'%H:%i') as horario,
a.descricao,
c.tipo,
c.assunto,
c.secretaria,
c.setor,
c.solicitante,
c.telefone,
c.email,
c.participantes,
c.local,
c.ministrante
from  agenda a
left join capacitacao c ON a.idCapacitacao = c.id
where left(data,10) >= current_date()
GROUP BY descricao, data, secretaria
order by a.data, a.horario";


$gdb->open( $select );


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Prefeitura de Florianópolis</title>


	<link rel="stylesheet" href="../../../layout/pmf-estilo.css" type="text/css">
	<link rel="stylesheet" href="../../../layout/pmf-estilo-home-new-2.css" type="text/css">
	<link rel="stylesheet" href="../../../scripts/slidesjs/css/global.css">
	<link rel="stylesheet" href="../../../scripts/js/ui/jquery-ui.css">
	<link href="../../../layout/imagens/brasao.gif" rel="shortcut icon" type="image/x-icon" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

</head>
<body>

	<script>

		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-54979843-1', 'auto');
		ga('send', 'pageview');

	</script>


	<link href="https://fonts.googleapis.com/css?family=Montserrat:300??,400,500,600,700" rel="stylesheet">
	<link rel="stylesheet" href="../../../layout/themePMF/css/style.css">

	<div class="mini-header">
		<ul class="mini-header__items">
			<li style="font-size: 13px;">Capacitação Rastreabilidade</li>
		</ul>
	</div>
	

	<div class="header">
		<div class="header__brand">
			<a href="http://www.pmf.sc.gov.br">
				<img src="../../../images/marca-pmf.svg">
			</a>
		</div>

		<ul class="header__nav">
			<li>
				<a href="solicitacao.php?cpf=<? echo $cpf; ?>" style="font-size: 15px;">Solicitações</a>
			</li>
			<li>
				<a href="agenda.php?cpf=<? echo $cpf; ?>" style="font-size: 15px; color: #e827d7;">Agenda</a>
			</li>
			<li>
				<a href="capacitacao.php?cpf=<? echo $cpf; ?>" style="font-size: 15px;">Capacitação</a>
			</li>
			<li>
				<a href="lista.php?cpf=<? echo $cpf; ?>" style="font-size: 15px; color: #A020F0;">Participantes</a>
			</li>
			<li>
				<a href="feriado.php?cpf=<? echo $cpf; ?>" style="font-size: 15px;">Compromisso</a>
			</li>
			<li>
				<a href="duvidas.php?cpf=<? echo $cpf; ?>" style="font-size: 15px; color: #32CD32;">Dúvidas</a>
			</li>
			<li>
				<a href="participantes.php?cpf=<? echo $cpf; ?>" style="font-size: 15px;">Capacitados</a>
			</li>
			<li>
				<a href="avaliacao.php?cpf=<? echo $cpf; ?>" style="font-size: 15px;">Avaliação</a>
			</li>
		</ul>
	</div>

	<div class="flex-container hero-wrapper">

		<div class="column4-lg column4-md column8-sm" style="padding-left: 15px; padding-bottom: 9px;">
			<form method="post" name="frmSituacao">	
				<h1 class="hidden-sm hidden-xs"><span style="color: black;">AGENDA DE CAPACITAÇÃO:</span></h1><br>
				<input type="hidden" name="cpf" value="$cpf">
			</form> 
		</div>

		<table class="table">

			<tr>  
				<td align="center"><b>data</b></td>
				<td align="center"><b>Horario</b></td>
				<td align="center"><b>Descrição</b></td>
				<td align="center"><b>Assunto</b></td>
				<td align="center"><b>Secretaria</b></td>
				<td align="center"><b>Setor</b></td>
				<td align="center"><b>Participantes</b></td>
				<td align="center"><b>Nome do Responsável</b></td>
				<td align="center"><b>Telefone</b></td>
				<td align="center"><b>Email</b></td>
				<td align="center"><b>Local</b></td>
				<td align="center"><b>Ministrante</b></td>
			</tr>

			<? 
			if(isset($gdb->gs['ID'])){
				foreach($gdb->gs['ID'] as $key=>$value){ 
					if ($gdb->gs['DIAINTEIRO'][$key] == '1') {
						$gdb->gs['HORARIO'][$key] = 'Dia inteiro';
					}
					?>
					<tr>
						<td align="center"><strong><? print $gdb->gs['DATA'][$key]; ?></strong></td>
						<td align="center"><strong><? print $gdb->gs['HORARIO'][$key]; ?></strong></td>
						<td align="center"><strong><? print $gdb->gs['DESCRICAO'][$key]; ?></strong></td>
						<td align="center"><? print $gdb->gs['ASSUNTO'][$key]; ?></td>
						<td align="center"><? print $gdb->gs['SECRETARIA'][$key]; ?></td>
						<td align="center"><? print $gdb->gs['SETOR'][$key]; ?></td>
						<td align="center"><? print $gdb->gs['PARTICIPANTES'][$key]; ?></td>
						<td align="center"><? print $gdb->gs['SOLICITANTE'][$key]; ?></td>
						<td align="center"><? print $gdb->gs['TELEFONE'][$key]; ?></td>
						<td align="center"><? print $gdb->gs['EMAIL'][$key]; ?></td> 				   
						<td align="center"><? print $gdb->gs['LOCAL'][$key]; ?></td> 
						<td align="center"><? print $gdb->gs['MINISTRANTE'][$key]; ?></td>
					</tr>				 					  						 

					<?

				}}; ?>	 

			</table>

			
		</div>
		<br><br><br><br><br>

		<div class="flex-container">
			<div class="column4-lg column4-md column8-sm">
				<div id="fb-root"></div>
				<script>
					(function(d, s, id) {
						var js, fjs = d.getElementsByTagName(s)[0];
						if (d.getElementById(id)) return;
						js = d.createElement(s); js.id = id;
						js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.10&appId=150853192172803";
						fjs.parentNode.insertBefore(js, fjs);
					}(document, 'script', 'facebook-jssdk'));
				</script>

			</div>
		</div>

		<script type="text/javascript" src="../assets/js/validadores.js"></script>  
		<script src="../assets/js/jquery.min.js"></script>
		<script src="../assets/js/jquery.maskedinput.min.js" type="text/javascript"></script> 
		<script src='http://momentjs.com/downloads/moment.min.js'></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

		<script type="text/javascript">

			function loadScript( url, callback ) {
				var script = document.createElement( "script" )
				script.type = "text/javascript";
        if(script.readyState) {  //IE
        	script.onreadystatechange = function() {
        		if ( script.readyState === "loaded" || script.readyState === "complete" ) {
        			script.onreadystatechange = null;
        			callback();
        		}
        	};
        } else {  //Others
        	script.onload = function() {
        		callback();
        	};
        }
        script.src = url;
        document.getElementsByTagName( "head" )[0].appendChild( script );
    }

</script>

<script src="layout/themePMF/js/slick.min.js"></script>

<script src="layout/themePMF/js/main.min.js"></script>

<div id="rodape">
	<div class="info">
		<div class="info-column">
			<div class="info-block">
				<h4>Equipe de Suporte</h4>
				<ul>
					<li><p style="color: white;">Karla Kinchescki</p></li>
					<li><p style="color: white;">Mayara Meurer</p></li>
				</ul>
			</div>
		</div>

		<div class="info-column">
			<div class="info-block">
				<h4>Telefone - Endereço</h4>
				<ul>
					<li><p style="color: white;">(48) 3213-5509 - Secretaria da Fazenda</p></li>
					<li><p style="color: white;">(48) 3251-6457 - Pró-Cidadão</p></li>
				</ul>
			</div>

			<div class="info-block">
				<h4>Email</h4>
				<ul>
					<li><p style="color: white;">suporte.rastreabilidade@pmf.sc.gov.br</p></li>
				</ul>
			</div>
		</div>
	</div>
</div>

<script src="layout/themePMF/js/home.min.js"></script>

</body>
</html>
