<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<!-- lang é um atributo-->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Turismo | Cadastre de Operadores Turimo </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="sweetalert2/dist/sweetalert2.all.min.js"></script>

    <link rel="stylesheet" href="./public/styles/main.css">
    <link rel="stylesheet" href="./public/styles/partials/header.css">
    <link rel="stylesheet" href="./public/styles/partials/forms.css">
    <link rel="stylesheet" href="./public/styles/partials/step-nav-bar.css">
    <link rel="stylesheet" href="./public/styles/partials/page-cadastrar-viagens.css">

    <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@400;700&amp;family=Poppins:wght@400;600&amp;display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">

    <script type="text/javascript" src="./public/scripts/jquery.mask.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="./public/scripts/form-operador.js"></script>
    <script src="./public/scripts/on-off.js"></script>

    <!-- mascaras de input dos forms -->
    <script src="masks.js"></script>
    <script type="text/javascript" src="/bas/js/jquery.mask.min.js"></script>





</head>

<body id="page-cadastrar-viagens">

    <div id="container">
        <header class="page-header">
            <div class="top-bar-container">
                <a href="/">
                    <img src="./public/images/icons/seta_esquerda.svg" alt="Voltar">
                </a>
                <!-- <img src="./public/images/logo.svg" alt="PMF"> -->
            </div>

            <div class="header-content">
                <img src="./public/images/logo.svg" alt="PMF">

                <strong>Login</strong>
                <p>Acesse para gerenciar e cadastrar as suas viagens</p>
            </div>
            <div id="stage1" style="background-color:maroon;color:white; display:block">
            </div>
        </header>
        <main style="display: block;">


            <form method="post" id="loginform" action="./login/session_valida.php">

                <fieldset id="cadastro_contratantes" class="div-show" style="display: block;">

                    <legend> Login <?php if (isset($_SESSION['loginErro'])) {
                        echo ": ". $_SESSION['loginErro'];
                        unset($_SESSION['loginErro']);
                    } ?>
                    <?php
                    if (isset($_SESSION['logindeslogado'])) {
                        echo ": ". $_SESSION['logindeslogado'];
                        unset($_SESSION['logindeslogado']);
                    }
                    ?>

                    </legend>
                    <div class="login_show" id="login_show" style="display: block;">
                        <span id="msg-error-contratantes"></span>

                        <div class="input-block">
                            <label for="contratantes_nome">Email</label>
                            <input type="email" class="form-control" name="email" id="contratantes_login_email" aria-describedby="contratantes_login_email_helpId" placeholder="Digite o e-mail do cadastro" required>
                            <small id="contratantes_login_email_helpId" class="form-text text-muted">E-mail de cadastro da operadora</small>
                        </div>
                        <div class="input-block">
                            <label for="contratantes_cep">Senha</label>
                            <input type="password" class="form-control" name="senha" id="contratantes_login_senha" aria-describedby="contratantes_login_senha_helpId" placeholder="">
                            <small id="contratantes_login_senha_helpId" class="form-text text-muted">Senha de acesso</small>
                        </div>
                        <button class="form-control" type="submit">Acessar (usar um botao verde!)</button><br>
                        <a href="./cadastrar-operador.php" >Não tem cadastro clique aqui! (usar um botao verde!)</a>

                    </div>


                 
                

                </fieldset>


           










                <footer>
                    <p>
                        Importante! <br>
                        nononono
                    </p>
                    Não tem cadastro? clique aqui para cadastrar

                    <button id="cadastrar_operador_db">Cadastrar </button>


                    <button id="cadastrar_operador_db">Salvar cadastro</button>
                </footer>
            </form>



        </main>
        <script>

        </script>
    </div>

</body>

</html>