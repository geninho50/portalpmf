<?php 

  // $json = file_get_contents('noticias.json');
  // $obj = json_decode($json);

//include_once("../sistemas/banco/gdb_default.php");

//$gdb = new gdb();
//$gdb->open('radio','SELECT tema, data, titulo, subtitulo, audio, reporter FROM noticias ORDER BY id DESC');
//$dados = $gdb->gs;
//$ultimasNoticias = 5;
//@$i = $_GET['id'];

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
		<title>Biblioteca Online PMF</title>
		<html xmlns='http://www.w3.org/1999/xhtml'
		      xmlns:og='http://ogp.me/ns#'>
			<?php

		  	if(array_key_exists($i, $dados["TITULO"])){
			  			/*echo  '<meta property="og:title" content="'.$obj[$i]->titulo.'">
							   <meta property="og:description" content="'.$obj[$i]->subtitulo.'">';*/
						echo '<meta property="og:title" content="'.$dados["TITULO"][$i].'">
							  <meta property="og:description" content="'.$dados["SUBTITULO"][$i].'">';
					} else {

					} ?>

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
					<?php

							  	if(array_key_exists($i, $dados["TITULO"])){
								  			/*echo  '	
											<section>
						                        <header>
													<h1><spam style="background-color: #FFA500">'.$obj[$i]->tema.' - '.$obj[$i]->data.'</spam></h1><br>
						                            <h2>'.$obj[$i]->titulo.'</h2>
						                            <span class="byline">'.$obj[$i]->subtitulo.'</span>
	
						                            <a href="'.$obj[$i]->website1.'">'.$obj[$i]->link1.'</a><br>
						                            <a href="'.$obj[$i]->website2.'">'.$obj[$i]->link2.'</a> 
						                        

						                        </header>
						                        
						                        <audio controls id="'.$i.'_audio">
						                        <source src="audio/'.$obj[$i]->audio.'" type="audio/mpeg">
						                        </audio>';*/
						                    echo '<section>
							                        <header>
														<h1><spam style="background-color: #FFA500">'.$dados["TEMA"][$i].' - '.$dados["DATA"][$i].'</spam></h1><br>
							                            <h2>'.$dados["TITULO"][$i].'</h2>
							                            <span class="byline">'.$dados["SUBTITULO"][$i].'</span> 
							                        </header>
							                        
							                        <audio controls id="'.$i.'_audio">
							                        	<source src="audio/'.$dados["AUDIO"][$i].'" type="audio/mpeg" >
							                        </audio>';

												 
											/*	$chrome = strpos($_SERVER["HTTP_USER_AGENT"], 'Chrome') ? true : false;

												if($chrome == true){
												    
												}else{
													echo '<a href="audio/'.$obj[$i]->audio.'" download="'.$obj[$i]->audio.'"><img src="images/icone.png" height="40" width="35"></a><br>';
												};*/

 												
											// echo '<p><img src="images/mic2.png" height="20" width="10">  '.$obj[$i]->reporter.'</p>';
												echo '<p><img src="images/mic2.png" height="20" width="10">  '.$dados["REPORTER"][$i].'</p>';


											$iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
											$ipad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad");
											$android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
											$palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
											$berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
											$ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
											$symbian =  strpos($_SERVER['HTTP_USER_AGENT'],"Symbian");

											if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian == true){
												echo '<a href="whatsapp://send?text=http://www.pmf.sc.gov.br/radio/noticia.php?id='.$i.'" title="'.$dados["AUDIO"][$i].'"><img src="images/whatsapp.png" height="40" width="35"></a>';
											}else{

											};
											

						                    '</section> ';
									  } else {
									  	echo '<h1>Notícia não encontrada.</h1>';
										  	
									  }
									  ?>

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