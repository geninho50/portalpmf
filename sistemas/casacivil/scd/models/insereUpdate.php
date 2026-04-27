<? 
session_start();
if(!$_SESSION['login']){ header('Location: ../loginADM.php'); }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link href="/../../layout/imagens/brasao.gif" rel="shortcut icon" type="image/x-icon">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="estilo.css" />
		
	<title>Formulario liberação IP</title>
		
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-theme.min.css">
	<script src="js/bootstrap.min.js"></script>
		
</head>
<body>
	<div class="headerLogin bg-primary">
		<input type='button' value='Sair' class='sair btn btn-default btn-xs'>
		<input type='button' value='Home' class='home btn btn-default btn-xs'>
		<div id="nomeUsuario"><strong>Nome: </strong><?echo $_SESSION['login'];?></div>
	</div>
	<div  role="form">
		
		<form action="foo.php" method="post">
		    Name VM (CIASC)  <input type="text" name="name_vm" /><br />
		    IP Address <input type="text" name="ip" /><br />
			DISCO<input type="text" name="disco"><br />
  			OS<input type="text" name="os"><br />
  			Memoria<input type="text" name="memoria"><br />
  			CORE<input type="text" name="core"><br />
  			Host Name<input type="text" name="host_name"><br />
  			Portas<input type="text" name="portas"><br />
  			Serviços<input type="text" name="servicos"><br />
  			Login<input type="text" name="login"><br />
 		    <input type="submit" name="submit" value="Me aperte!" />
		</form>


	</div>

<script type="text/javascript">
			$('.home').bind('click',function(){
				location.href = "decidirADM.php";
		});
		$('.sair').bind('click',function(){
			location.href = "loginADM.php";
		});	
</script>
</body>
</html>