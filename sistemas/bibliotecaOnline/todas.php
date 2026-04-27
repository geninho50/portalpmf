<?php 

//if($_SERVER["REMOTE_ADDR"] == '10.10.202.74'){
	//include_once("../sistemas/banco/gdb_default.php");

	//$gdb = new gdb();
	//$gdb->open('radio','SELECT COUNT(id) as TOTAL FROM noticias');
	//$count = $gdb->gs["TOTAL"][0];
	//echo $count;
	//$gdb->open('radio','SELECT tema, data, titulo, subtitulo, audio, reporter FROM noticias ORDER BY id DESC');
	//$dados = $gdb->gs;
/*} else {
	$json = file_get_contents('noticias.json');
	$obj = json_decode($json);
}*/
?>


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
								<header>
									<h2>Todos os Áudios</h2>
								</header>
					
	<?php
		$iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
		$ipad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad");
		$android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
		$palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
		$berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
		$ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
		$symbian =  strpos($_SERVER['HTTP_USER_AGENT'],"Symbian");

		//if($_SERVER["REMOTE_ADDR"] == '10.10.202.74'){
			for($i=0;$i<$count;$i++){
				echo  '<section style="box-shadow: 0 2px 2px rgba(0, 0, 0, 0.3); padding-left: 5px; padding-right: 5px; background-color: #F5F5F5;">                    
							<h1><spam style="background-color: #FFA500">'.$dados["TEMA"][$i].' - '.$dados["DATA"][$i].'</spam> - <strong>'.$dados["TITULO"][$i].'</strong></h1>';

				if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian == true){	
					echo '<a href="whatsapp://send?text=http://www.pmf.sc.gov.br/radio/noticia.php?id='.$i.'" title="'.$dados["TITULO"][$i].'"><img src="images/whatsapp.png" height="40" width="35"></a>';
				}

					echo '<a href="noticia.php?id='.$i.'">Link desta Notícia</a>					
					            </section> ';
			}
		/*} else {
			for($i=0;$i<count($obj);$i++){
				echo  '<section style="box-shadow: 0 2px 2px rgba(0, 0, 0, 0.3); padding-left: 5px; padding-right: 5px; background-color: #F5F5F5;">                    
							<h1><spam style="background-color: #FFA500">'.$obj[$i]->tema.' - '.$obj[$i]->data.'</spam> - <strong>'.$obj[$i]->titulo.'</strong></h1>';

				if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian == true){	
					echo '<a href="whatsapp://send?text=http://www.pmf.sc.gov.br/radio/noticia.php?id='.$i.'" title="'.$obj[$i]->titulo.'"><img src="images/whatsapp.png" height="40" width="35"></a>';
				}

					echo '<a href="noticia.php?id='.$i.'">Link desta Notícia</a>					
					            </section> ';
			}
		}*/
	?>
							</section>
						</div>		
				</div>
			</div>
		</div>

		<div id="copyright">
			<div class="container">
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
      } 

      document.getElementById("ultimaDiv").value = idDIV;  
    }   
</script>
	</body>
</html>

