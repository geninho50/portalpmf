<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="../img/2093faviconpmf.ico">
    <title>Adote</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="../index.php">
                <img id="logo" src="../img/logosdp5.png" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse flex-row-reverse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link" href="../index.php"><span>Sair</span></a>
                </div>
            </div>
        </nav>
    </header>

    <div class="container">
        <form action="inclusao.php" method="POST">
            <h1 style="margin-top: 1rem">Administração</h1>
            <br>
            <div class="form-group col-md-4">
                <label for="user">Usuário</label>
                <input class="form-control" type="text" id="user" name="user" />
            </div>
            <div class="form-group col-md-4">
                <label for="password">Senha</label>
                <input class="form-control" type="password" id="password" name="password" />
            </div>
            <button type="submit" class="btn btn-primary">Entrar</button>
        </form>
    </div>

    <footer>
        <div class="text-center">
            <h3 class="text-uppercase">Diretoria de Bem Estar Animal</h3>
            <p style="color:#fff; font-weight:bold;">Horário de funcionamento: Segunda a Sexta das 08:00 às 17:00<br>Endereço: SC-401, 114 - Itacorubi, Florianópolis - SC, 88010-102<br>Contato: (48) 3234-5677</p>
            <p><a href="http://www.pmf.sc.gov.br/entidades/bemestaranimal/index.php"><img src="../img/prefeitura.png" alt="Logo da Prefeitura de Florianópolis"/></a></p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>