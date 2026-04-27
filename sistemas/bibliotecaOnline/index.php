<?php 
  /*$json = file_get_contents('noticias.json');
  $obj = json_decode($json);
  $ultimasNoticias = 5;

//if($_SERVER["REMOTE_ADDR"] == '10.10.202.74'){
	include_once("../sistemas/banco/gdb_default.php");

	$gdb = new gdb();
	$gdb->open('radio','SELECT tema, data, titulo, subtitulo, audio, reporter FROM noticias ORDER BY id DESC');
	$dados = $gdb->gs;
//}
*/
?>

<!DOCTYPE HTML>

<html>
	<head>
		<title>Biblioteca Online - PMF</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<html xmlns='http://www.w3.org/1999/xhtml'
		      xmlns:og='http://ogp.me/ns#'>
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

		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-54979843-1"></script>
		<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());

		  gtag('config', 'UA-54979843-1');
		</script>
		<!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="css/ie/v9.css" /><![endif]-->
	</head>
	<body>
		<input type="hidden" id="ultimaDiv" value="0">

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

					<!-- Sidebar -->
						<div id="sidebar" class="4u">
							<section>
								<header>
									<h2>Últimos Áudios</h2>
								</header>
								<ul class="default">
									<?php
										 // for($i=0;$i<($ultimasNoticias -1);$i++){
										  	//if($_SERVER["REMOTE_ADDR"] == '10.10.202.74'){
										  		echo '<li><a href="javascript:void(0)" onclick="ativarDIV('.$i.');">'.$dados["TITULO"][$i].'</a></li>'; 
										  	/*} else {
										  		echo '<li><a href="javascript:void(0)" onclick="ativarDIV('.$i.');">'.$obj[$i]->titulo.'</a></li>'; 
										  	}*/
										 // }

										  	?>
									<li><a href="javascript:void(0)" onclick="ativarDIV('noticia1');">Exemplo de Áudio</a></li>
									<li><a href="javascript:void(0)" onclick="ativarDIV('noticia2');">Exemplo de Áudio</a></li>
									<li><a href="javascript:void(0)" onclick="ativarDIV('noticia3');">Exemplo de Áudio</a></li>
									<li><a href="javascript:void(0)" onclick="ativarDIV('noticia4');">Exemplo de Áudio</a></li>
									<li><a href="javascript:void(0)" onclick="ativarDIV('noticia5');">Exemplo de Áudio</a></li>
									<li><a href="javascript:void(0)" onclick="ativarDIV('noticia6');">Exemplo de Áudio</a></li>
								</ul>
							</section>
						</div>
					<!-- Sidebar -->
				
				

					<!-- Content -->
					<div id="content" class="8u skel-cell-important">

						<?php

						$visivel = "block";

							  	for($i=0;$i<($ultimasNoticias -1);$i++){
							  	 	//if($_SERVER["REMOTE_ADDR"] == '10.10.202.74'){
								  		echo '<div id="'.$i.'" style="display:'.$visivel.';" >
							                    <section>
							                        <header>
														<h1><spam style="background-color: #FFA500">'.$dados["TEMA"][$i].' - '.$dados["DATA"][$i].'</spam></h1><br>
							                            <h2>'.$dados["TITULO"][$i].'</h2>
							                            <span class="byline">'.$dados["SUBTITULO"][$i].'</span> 
							                        </header>
							                        
							                        <audio controls id="'.$i.'_audio">
							                        	<source src="audio/'.$dados["AUDIO"][$i].'" type="audio/mpeg" >
							                        </audio>';
								  	/*} else {
								  		echo '<div id="'.$i.'" style="display:'.$visivel.';" >
							                    <section>
							                        <header>
														<h1><spam style="background-color: #FFA500">'.$obj[$i]->tema.' - '.$obj[$i]->data.'</spam></h1><br>

							                            <h2>'.$obj[$i]->titulo.'</h2>
							                            <span class="byline">'.$obj[$i]->subtitulo.'</span> 
							                            <a href="'.$obj[$i]->website1.'">'.$obj[$i]->link1.'</a><br>
							                            <a href="'.$obj[$i]->website2.'">'.$obj[$i]->link2.'</a> 

							                        </header>
							                        
							                        <audio controls id="'.$i.'_audio">
							                        <source src="audio/'.$obj[$i]->audio.'" type="audio/mpeg" >
							                        </audio>';
								  	}*/
								  
								  	//if($_SERVER["REMOTE_ADDR"] == '10.10.202.74'){
								  		echo '<p><img src="images/mic2.png" height="20" width="10">  '.$dados["REPORTER"][$i].'</p>
										<a style="color="black" href="noticia.php?id='.$i.'">Link desta Notícia</a><br>';
								  	/*} else {	
										echo '<p><img src="images/mic2.png" height="20" width="10">  '.$obj[$i]->reporter.'</p>
										<a style="color="black" href="noticia.php?id='.$i.'">Link desta Notícia</a><br>';
									}*/
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
											echo '
					
						                    </section>
						                  </div>';

						                  $visivel = "none";
								}
						?>

						<!--<? include_once("corpo.php"); ?>   -->

					</div>

				<!-- /Content -->
						
				</div>
			
			</div>
		</div>
		
			</div>
		</div>
	<!-- Footer -->

	<!-- Copyright -->
		<div id="copyright">
			<div class="container">
				<img src="images/pmf.png">
			</div>
		</div>

	</body>
</html>

<script type="text/javascript">
	
/*	function Mudarestado(el) {
        var display = document.getElementById(el).style.display;
        if(display == "none")
            document.getElementById(el).style.display = 'block';
        else
            document.getElementById(el).style.display = 'none';
    }
*/

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


 /* iniciar
$('#audio')[0].play();

// pausar
$('#audio')[0].pause();

// rebobinar (hehe)
$('#audio')[0].currentTime = 0;*/


</script>