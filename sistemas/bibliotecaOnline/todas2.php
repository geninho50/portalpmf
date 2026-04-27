<?php 

  $json = file_get_contents('noticias.json');
  $obj = json_decode($json);
  $ultimasNoticias = 5;

 /* for($i=0;$i<count($obj);$i++){
  echo $obj[$i]->titulo;
  echo $obj[$i]->subtitulo;
  echo $obj[$i]->audio;
  echo '<br>'; 
  }
*/

?>


<!DOCTYPE HTML>

<html>
	<head>
		<title>Rádio PMF</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link href='http://fonts.googleapis.com/css?family=Oxygen:400,300,700' rel='stylesheet' type='text/css'>
		<!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-panels.min.js"></script>
		<script src="js/init.js"></script>
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
						<h1><a href="#"><font color="white">Rádio PMF</font></a></h1>
						<span><font color="white">Prefeitura de Florianópolis</font></span>
					</div>
				
				<!-- Nav -->
					<nav id="nav">
						<ul>
							<li class="active"><a href="index.php">Últimas Notícias</a></li>
							<li><a href="todas.php">Todas as Notícias</a></li>
							<li><a href="redacao.html">Redação</a></li>
							<li><a href="contato.html">Contato</a></li>
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
								<header>
									<h2>Todas as notícias</h2>
									<span class="byline">Veja aqui as notícias por ordem Cronológica</span>
								</header>
					
	<?php

/*
		$pagina = 1;
		$registros_pagina = 5;
		$inicio = $registros_pagina * ($pagina - 1);
		$fim =  ($registros_pagina * $pagina) - 1;


 								for($i=$inicio;$i<=$fim;$i++){ 

							  	for($i=0;$i<count($obj);$i++){
								  			echo  '	 
								  			
											<section style="box-shadow: 0 2px 2px rgba(0, 0, 0, 0.3); padding-left: 5px; padding-right: 5px; background-color: #F5F5F5;">
						                        <header>
													<h1><spam style="background-color: #FFA500">'.$obj[$i]->tema.' - '.$obj[$i]->data.'</spam></h1><br>
						                            <h2>'.$obj[$i]->titulo.'</h2>
						                            <span class="byline">'.$obj[$i]->subtitulo.'</span>
						                        </header>
						                        
						                        <audio controls id="'.$i.'_audio">
						                        <source src="audio/'.$obj[$i]->audio.'" type="audio/mpeg">
						                        </audio>';

												 
											/*	$chrome = strpos($_SERVER["HTTP_USER_AGENT"], 'Chrome') ? true : false;

												if($chrome == true){
												    
												}else{
													echo '<a href="audio/'.$obj[$i]->audio.'" download="'.$obj[$i]->audio.'"><img src="images/icone.png" height="40" width="35"></a><br>';
												};*/

/*
											$iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
											$ipad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad");
											$android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
											$palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
											$berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
											$ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
											$symbian =  strpos($_SERVER['HTTP_USER_AGENT'],"Symbian");

											if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian == true){
												echo '<a href="whatsapp://send?text=http://www.pmf.sc.gov.br/radio/noticia.php?id='.$i.'" title="'.$obj[$i]->titulo.'"><img src="images/whatsapp.png" height="40" width="35"></a>';
											}else{

											};

 												
											echo '<p><img src="images/mic2.png" height="20" width="10">  '.$obj[$i]->reporter.'</p>

												<a href="noticia.php?id='.$i.'">Link desta Notícia</a>
												
						                    </section> ';
									    }

										  	?>

							</section>
						</div>		
				</div>*/
/*
				for($i=0;$i<count($obj);$i++){
								  			echo  '	 
								  			
								<section style="box-shadow: 0 2px 2px rgba(0, 0, 0, 0.3); padding-left: 5px; padding-right: 5px; background-color: #F5F5F5;">
						                        
									<h1><spam style="background-color: #FFA500">'.$obj[$i]->tema.' - '.$obj[$i]->data.'</spam> - <strong>'.$obj[$i]->titulo.'</strong></h1>
						                       
						                     ';

											$iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
											$ipad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad");
											$android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
											$palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
											$berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
											$ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
											$symbian =  strpos($_SERVER['HTTP_USER_AGENT'],"Symbian");

											if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian == true){
												echo '<a href="whatsapp://send?text=http://www.pmf.sc.gov.br/radio/noticia.php?id='.$i.'" title="'.$obj[$i]->titulo.'"><img src="images/whatsapp.png" height="40" width="35"></a>';
											}else{

											};
	
											echo '<a href="noticia.php?id='.$i.'">Link desta Notícia</a>
												
						                    </section> ';
									    }

										  	?>

							</section>
						</div>		
				</div>

 <?php
 		/*
				echo '<a href="http://www.pmf.sc.gov.br/radio/todas.php?pagina='.($pagina+1).'">Página Anterior</a>';
				
			
			/* if($pagina > 1){
				echo '<a href="http://www.pmf.sc.gov.br/radio/todas.php?pagina='.$pagina.-1.'">Página Anterior</a>';
			};*/
			?>
			</div>
		</div>

		

		<div id="copyright">
			<div class="container">
				<img src="images/logo_radio_colorido.png" style="margin-right: 25px">
				<img src="images/pmf.png">
			</div>
		</div>
<script>
	    function ativarDIV(idDIV){
      var ultimaDiv = document.getElementById("ultimaDiv").value;  

      document.getElementById(idDIV).style.display = 'block';
	


      if( ultimaDiv !='' && ultimaDiv != idDIV ){
          document.getElementById(ultimaDiv).style.display = 'none';
          $('#'+ultimaDiv+'_audio')[0].pause();

         /* window.location.reload(); (refresh na pagina e para o audio)*/
      } 

      document.getElementById("ultimaDiv").value = idDIV;  
    }   
</script>
	</body>
</html>

