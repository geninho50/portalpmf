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
  <?php 
  
  ?>
    <div class="conteiner">
      <img class="logo" src="img/fenaostra.png">
      <h1 class="fenaostra">#Fenaostra2015</h1>
  		<div class="boxLogin">
			<div class="form-group">
				<label for="exampleInputEmail1">Login</label>
			   	<input type="text" class="form-control input-sm" id="login" placeholder="">
 			</div>

			<div class="form-group">
		    	<label for="exampleInputEmail1">Senha</label>
				<input type="password" class="form-control input-sm" id="senha" placeholder="" >
			</div>
				
  			<div class="alert alert-danger hide" id="error"></div>
  			
  			<button type="button" id="logar" class="btn btn-primary btn-xs">Logar</button>
    	</div>
    </div>
  </body>
</html>
<script>
$('#logar').bind('click',function(){
			$('#error').addClass('hide');
			
			var err = '';
			var obj = {
				login : $('#login').val(),
				senha : $('#senha').val(),
			};
				$.post( "backend/logar.php", obj).done(function( data ) {	
			    	var retorno = jQuery.parseJSON(data);
			    	if(retorno.success == 1){
			    		location.href = "aprovar.php";
			    	}else{
			    		$('#error').text(retorno.error).removeClass('hide');
			    	}
			    	
			    	console.log( data );
				});
		});
</script>
