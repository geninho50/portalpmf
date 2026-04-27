<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Fenaostra</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/estilos.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Josefin+Sans:600italic' rel='stylesheet' type='text/css'>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

  </head>
  <body>
<div class="top">
  		<img class="logo" src="img/fenaostra.png">
  	</div>

	<h1 class="fenaostra">#Fenaostra2015</h1>

    <div class="conteiner">
      <div class="row">
      	<img class="img-circle col-md-4 profile_picture pull-left" src="img/Instagram.jpg">
      	<p class="col-md-6 from pull-left usuario">Fenaostra</p>
      </div>

	    <hr>
		
		<div class="instagram">
	        <img src="img/Instagram.jpg" class="imagem_telao">
	    </div>

	    <hr>


      <div class="row">
      	<div class="col-md-4">
      	  <img class="logoflin pull-left" src="img/Flinlogo.png">
	     </div>
	    <div class="col-md-4">
	      <img class="logopmf center-block" src="img/Logo PMF-01.png">
	    </div>
	    <div class="col-md-4">
	      <img class="logounesco pull-right" src="img/Logo Unesco.png">
	    </div>
	  </div>
    </div>
  </body>
</html>


<script>
		$.getJSON( "backend/getAllData.php");
	setInterval(function(){ 	
		$.getJSON( "backend/getAllData.php");
	}, 30000);

	function mostrar_fotos_home(){ 
		contador = 0;
		$.getJSON( "backend/getTelao.php" ,function( fotos ) {
			setTimeout(trocar_imagens, 3000);

			function trocar_imagens(){ 	
				
				var fotosArr = $.makeArray(fotos);
				if(contador < fotosArr.length){
					$(".imagem_telao").attr('src', fotosArr[contador].url);
					$(".usuario").html(fotosArr[contador].from);
					$(".profile_picture").attr('src', fotosArr[contador].profile_picture);
					contador++;
					setTimeout(trocar_imagens, 3000);
				}else{
					$(".imagem_telao").attr('src', "img/Instagram.jpg");
					$(".usuario").html("Fenaostra");
					$(".profile_picture").attr('src', "img/Instagram.jpg");
					mostrar_fotos_home();
				}
			}

		});
	}
	mostrar_fotos_home();
</script>