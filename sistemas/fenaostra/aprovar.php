<? 
session_start();
if(!$_SESSION['login']){ header('Location: login.php'); } 
?>

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
    <link href="css/estilosRick.css" rel="stylesheet">
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

 	<div class="conteiner">
      <img class="logo" src="img/fenaostra.png">
      <h1 class="fenaostra">#Fenaostra2015</h1>
      <div class="caixa_aprovar_fotos">
	      <div class="foto_para_aprovar">
	        <img src="img/FimAprovacao.jpg" class="imagem_telao" id="">
	      </div>
	  	  <div id="botaoAprovar">
	      	<span class="glyphicon glyphicon-ok"></span>
	      </div>
	       <div id="botaoReprovar">
	      	<span class="glyphicon glyphicon-remove"></span>
	      </div>
	      <button class="carregar_mais">Carregar mais fotos</button>
      </div>
     	
    </div>
  </body>
</html>

<script>



	function fotos_aprovar(){
		$.getJSON( "backend/getAprovar.php", function( fotos ) {
			var contador = 0;
			var fotosArr = $.makeArray(fotos);
			if(fotosArr.length > 0){
				$(".imagem_telao").attr("src", fotosArr[contador].url);
				$(".imagem_telao").attr("id", fotosArr[contador].id);

				$("#botaoAprovar").bind('click', function(){
					id = $(".imagem_telao").attr("id");
					var obj = { id : id };

					$.post( "backend/aprovar.php", obj).done(function( data ) {	
				    	var retorno = jQuery.parseJSON(data);
				    	if(retorno == 1){
				    		contador++;
				    		if(fotosArr.length <= contador){
					    		$(".imagem_telao").attr("src", "img/FimAprovacao.jpg");
								$(".imagem_telao").attr("id", "");
								fotos_aprovar();
								$("#botaoAprovar").off();
				    		}else{
				    			$(".imagem_telao").attr("src", fotosArr[contador].url);
								$(".imagem_telao").attr("id", fotosArr[contador].id);
							}
				    	}else{
				    		alert("Erro ao aprovar");
				    	}

					});
				});


				$("#botaoReprovar").bind('click', function(){
					id = $(".imagem_telao").attr("id");
					var obj = { id : id };

					$.post( "backend/reprovar.php", obj).done(function( data ) {	
				    	var retorno = jQuery.parseJSON(data);
				    	if(retorno == 1){
				    		contador++;
				    		if(fotosArr.length <= contador){
					    		$(".imagem_telao").attr("src", "img/FimAprovacao.jpg");
								$(".imagem_telao").attr("id", "");
								fotos_aprovar();
								$("#botaoReprovar").off();
				    		}else{
				    			$(".imagem_telao").attr("src", fotosArr[contador].url);
								$(".imagem_telao").attr("id", fotosArr[contador].id);
							}
				    	}else{
				    		alert("Erro ao aprovar");
				    	}

					});
				});

			}else{
				$(".imagem_telao").attr("src", "img/FimAprovacao.jpg");
				$(".imagem_telao").attr("id", "");
			}
		});
	}
	fotos_aprovar();
	$(".carregar_mais").click(function(){
		fotos_aprovar();
	});
	
</script>