<!DOCTYPE HTML>

<html>
	<head>
		<title>Biblioteca Online PMF</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link href='http://fonts.googleapis.com/css?family=Oxygen:400,300,700' rel='stylesheet' type='text/css'>
		<!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-panels.min.js"></script>
		<script src="js/init.js"></script>
		<link href="../../layout/imagens/brasao.gif" rel="shortcut icon" type="image/x-icon" />
		<noscript>
			<link rel="stylesheet" href="css/skel-noscript.css" />
			<link rel="stylesheet" href="css/style.css" />
		</noscript>
		<!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="css/ie/v9.css" /><![endif]-->
	</head>
	<body>

	<!-- Header -->
		<div id="header">
			<div class="container">
					
				<!-- Logo -->
					<div id="logo">
						<h1><a href="#"><font color="white">Biblioteca Online PMF</font></a></h1>
						<span><font color="white">Prefeitura de Florianópolis</font></span>
					</div>
				
				<!-- Nav -->
					<nav id="nav">
						<ul>
							<li class="active"><a href="#">Últimos Áudios</a></li>
							<li><a href="todas.php">Todos os Áudios</a></li>
							<li><a href="envieAudio.php">Envie um Áudio</a></li>
						</ul>
					</nav>

			</div>
		</div>
	<!-- Header -->
			
	<!-- Main -->
		<div id="main">
			<div class="container">
				<div class="row">

					<!-- Content -->
						<div id="content" class="12u skel-cell-important">						
				
							<section>
								<div class="center">
								<form>
								<p>
									<label for="titulo" class="colocar_nome">Título<span class="obrigatorio">*</span></label>
									<input type="text" name="introduzir_nome" id="titulo" required="obrigatorio">
								</p>
							
								<p>
									<label for="autor" class="colocar_email">Autor<span class="obrigatorio">*</span></label>
									<input type="text" name="introduzir_email" id="autor" required="obrigatorio">
								</p>
						
								<p>
									<label for="resumo" class="colocar_mensagem">Resumo<span class="obrigatorio">*</span></label>                     
                               		<textarea name="introduzir_mensagem" class="texto_mensagem" id="resumo" required="obrigatorio"></textarea> 
								</p>
								   
								<p>
									<label for="audio" class="colocar_email">Áudio<span class="obrigatorio">*</span></label>
									<input type="file" name="introduzir_email" id="audio" required="obrigatorio">
								</p>
							
								<button type="submit" name="enviar_formulario" id="enviar"><p>Enviar</p></button>
								</form>  
								</div>    
							</section>
						</div>
					<!-- /Content -->
						
				</div>
			
			</div>
		</div>

		

		<div id="copyright">
			<div class="container">
				<img src="images/pmf.png">
			</div>
		</div>

	</body>
</html>

	</body>
</html>