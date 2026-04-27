<!DOCTYPE HTML>
<html>
	<head>
		<title>1ª Conferência Municipal de Habitação de Interesse Social</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
	   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">


	</head>
	<body>
		<div class="page-wrap">

			<nav id="nav">
				<ul>
					<li><a href="index.php"><span class="icon fa-home"></span></a></li>
					<li><a href="inscricao.php" class="active"><span class="icon fa-file-text-o"></span></a></li>
					<li><a href="inscricaoConsulta.php" class="active"><span class="fa fa-search"></span></a></li>
					<li><a href="http://www.pmf.sc.gov.br/arquivos/arquivos/pdf/18_10_2018_14.13.27.33c67d71c92544cef1ec2111ffb1f0aa.pdf" class="active"><span class="fa fa-file-pdf-o"></span></a></li>
					<li><a href="MINUTA_Regimento_Interno_COMHIS_FPOLIS.pdf" class="active"><span class="fa fa-file-pdf-o"></span></a></li>
				</ul>
			</nav>
			<?php

						$iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
						$ipad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad");
						$android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
						$palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
						$berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
						$ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
						$symbian =  strpos($_SERVER['HTTP_USER_AGENT'],"Symbian");

						if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian == true){
							echo '<section id="main" >
									<section id="banner">
										<div class="inner">
											<h2 style="font-size: 20px;">1ª Conferência Municipal de Habitação <br /> de Interesse Social</h2>
											  <ul class="actions">
												<li><a href="inscricao.php" class="button alt">Inscrições</a></li>
											 </ul>
									</div>
								</section>
							<section>';
						}else{
							echo '<section id="main" >
										<section id="banner">
											<div class="inner">
												<h2>1ª Conferência Municipal de Habitação <br /> de Interesse Social</h2>
												 <ul class="actions">
												<!--	<li><a href="inscricao.php" class="button alt scrolly big">participar</a></li> -->
													<li><a href="http://www.pmf.sc.gov.br/arquivos/arquivos/pdf/18_10_2018_14.13.27.33c67d71c92544cef1ec2111ffb1f0aa.pdf" class="button alt scrolly big">Plano Municipal de Habitação de Interesse Social - PMHIS</a></li>
												 </ul>
												  <ul class="actions">
												<!--	<li><a href="inscricao.php" class="button alt scrolly big">participar</a></li> -->
													<li><a href="inscricao.php" class="button alt scrolly big">Inscrições</a></li>
												 </ul>
										</div>
									</section>
								<section>';  };    ?>
					<div class="inner">
						<header>
							<h2>Acesso ao gerenciamento Inscritos</h2><br />
						</header>

						<div class="column">
							<form action="gerenciamento2.php" method="post" name="frm">
								<div class="row" style="margin-bottom: 10px;">
		        						<div class="col-md-3">
										<label>login:</label><input value="" id="user" name="user" class="form-control" type="text"/>
										</div>
										<div class="col-md-2">
											<label>Senha:</label><input value="" id="password" name="password" class="form-control" type="password"/>
										</div>
								</div>
								<div class="col-md-2" >
									<input value="Acessar" class="button" type="submit">
								</div>
							</form>


					<!-- Footer -->
						<footer id="footer" style="margin-top: 5%;background-color: #0D1217;">
							<div class="copyright">
							<a href="http://www.pmf.sc.gov.br"><img src="images/Prefeitura.png"></a>.
							</div>
						</footer>
		</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.poptrox.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

			<script type="text/javascript" src="../Biblioteca/js/validadores.js"></script>
			<script src="assets/js/jquery.min.js"></script>
  			<script src="assets/js/jquery.maskedinput.min.js" type="text/javascript"></script>
	</body>
</html>
