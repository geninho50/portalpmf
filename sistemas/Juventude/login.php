<html>
	<head>
		<title>Gerenciamento Juventude</title>
		<meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link href="../../layout/imagens/brasao.gif" rel="shortcut icon" type="image/x-icon" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	</head>
	<body>

        <!-- redirecionamento de pagina -->
        <script>window.location.href = "http://www.pmf.sc.gov.br";</script>

		<form action="gerenciamento.php" method="POST">
            <h2 align="center">Gerenciamento Juventude</h2>
            <div class="form-row col-sm-6 col-md-6 col-lg-6" style="margin:auto">
                <div class="form-group col-sm-6 col-md-6 col-lg-6">
                    <label for="user">Usuário</label>
                    <input class="form-control" type="text" id="user" name="user" />
                </div>
                <div class="form-group col-sm-6 col-md-6 col-lg-6">
                    <label for="password">Senha</label>
                    <input class="form-control" type="password" id="password" name="password" />
                </div>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
        </form>
	</body>
</html>