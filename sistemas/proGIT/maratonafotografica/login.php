<html>
	<head>
		<title>Gerenciamento Maratona Fotográfica</title>
		<meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link href="../../layout/imagens/brasao.gif" rel="shortcut icon" type="image/x-icon" />
        <link rel="stylesheet" href="css/login.css">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"rel="stylesheet">
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	</head>
	<body>
        <div class="box">
            <div class="gerenciamento">
                <img src="img/N. 977-10 - Lorena Scanzani_Sujeito e patrimônio_Digital1.JPG">
                <h2>Gerenciamento <br> Maratona <br> Fotográfica</h2>
            </div>
            <div class="login">     
                <form action="gerenciamento.php" method="POST">  
                    <p>Login</p>
                        <div>
                            <label for="user"></label>
                            <input class="form-control" type="text" id="user" name="user" placeholder="Digite seu Usuário..." />
                        </div>
                        <div>
                            <label for="password"></label>
                            <input class="form-control" type="password" id="password" name="password" placeholder="Digite sua Senha..." />
                        </div>
                        <a href="/"><button class="bn632-hover bn26">Enviar</button></a>    
                 </form>
            </div>
        </div>
	</body>
</html>