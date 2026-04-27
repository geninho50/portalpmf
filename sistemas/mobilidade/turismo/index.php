<!DOCTYPE html>
<html lang="pt-br">
<!-- lang é um atributo-->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selo Turístico | Ajuda </title>

    <link rel="stylesheet" href="public/styles/main.css">
    <link rel="stylesheet" href="public/styles/partials/header.css">
    <link rel="stylesheet" href="public/styles/partials/page-instrucoes.css">

    <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@400;700&amp;family=Poppins:wght@400;600&amp;display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@400;700&amp;family=Poppins:wght@400;600&amp;display=swap" rel="stylesheet">

    <script src="./public/scripts/mobile-nav-bar-active.js" defer></script> <!-- Script for mobile nav-bar links-->


</head>

<body id="page-instrucoes">

    <div id="container">
        <header class="page-header">
            <div class="top-bar-container">
                <nav class="navbar">
                    <div class="logo-title">
                        <a href="./">SELO TURÍSTICO</a>
                    </div>
                    <a href="#" class="toggle-button">
                        <span class="bar"></span>
                        <span class="bar"></span>
                        <span class="bar"></span>
                    </a>
                    <ul class="navbar-links">

                        <li>
                            <a href="./cadastrar-operador.php">Primeiro acesso</a>
                        </li>

                        <li>
                            <a href="./login.php">Entrar</a>
                        </li>

                    </ul>
                </nav>
            </div>
            <div class="header-content">
                <img src="./public/images/logo.svg" alt="PMF">
                <strong>Selo Turismo Legal</strong>
                <strong><i>Sello Turismo Legal</i></strong>
                <br>
                <p><b>Olá! Com objetivo de melhorar a experiência e passagem dos turistas na nossa cidade, Florianópolis implantou o SELO DE IDENTIFICAÇÃO DE VEÍCULO DE TURISMO (SIVETUR) conforme lei link aqui.
                        <br>Lembramos que o cadastro é obrigatório e o não cumprimento pode acarretar em multa.</b></p>
                <p><i>¡Hola! Con el fin de mejorar la experiencia y el paso de los turistas en nuestra ciudad, Florianópolis implementó el SELO DE IDENTIFICAÇÃO DE VEÍCULO DE TURISMO (SIVETUR) de acuerdo con la ley link aqui. Le recordamos que el registro es obligatorio y el incumplimiento puede resultar en multas.</i></p>
                <br>

                <!-- <div class="header-buttons">
                    <button>Login</button>
                    <button>Cadastrar Viagem</button>
                </div> -->
            </div>


        </header>

        <main>

            <article class="intrucoes-item">
                <header>
                    <strong>PRIMEIRO ACESSO <br>
                        <i>PRIMER ACCESO </i>
                    </strong>

                </header>

                <ul>
                    <li>
                        <img src="./public/images/icons_collection/azul-clicar-botao.svg" alt="PMF">
                        <div class="li-texts">
                            Se sua empresa/operadora ainda não é cadastrada, realize o cadastro clicando em <a href="./cadastrar-operador.php">Primeiro acesso</a>. <br>
                            <i> Si su empresa / operador aún no está registrado, realice el registro haciendo clic en <a href="./cadastrar-operador.php">Primeiro acesso</a></i>
                        </div>
                    </li>

                    <li>
                        <img src="./public/images/icons_collection/azul-adicionar-operadora.svg" alt="PMF">
                        <div class="li-texts">
                            Preencha corretamente dos dados da empresa/operadora <br>
                            <i> Complete los datos de la empresa/operador correctamente.</i>
                        </div>
                    </li>

                    <li>
                        <img src="./public/images/icons_collection/azul-email-op1.svg" alt="PMF">
                        <div class="li-texts">
                            Para realizar login você utilizará seu e-mail cadastrado. <br>
                            <i> Para iniciar sesión utilizará su correo electrónico registrado.</i>
                        </div>
                    </li>

                    <li>
                        <img src="./public/images/icons_collection/azul-senha.svg" alt="PMF">
                        <div class="li-texts">
                            Anote a sua senha para poder registrar e acessar as suas viagens. <br>
                            <i> Anote su contraseña para poder registrar y acceder a sus viajes.</i>
                        </div>
                    </li>
                </ul>

            </article>

            <img class="proximo" src="./public/images/icons_collection/azul-seta-baixo.svg" alt="Próximo">

            <article class="intrucoes-item">
                <header>
                    <strong>CADASTRE E GERENCIE SUAS VIAGENS <br>
                        <i> REGÍSTRESE Y GESTIONE SUS VIAJES </i> </strong>
                </header>

                <ul>
                    <li>
                        <img src="./public/images/icons_collection/azul-login.svg" alt="PMF">
                        <div class="li-texts">
                            Faça o login com o e-mail cadastrado.<br>
                            <i> Inicie sesión con el correo electrónico registrado.</i>
                        </div>
                    </li>

                    <li>
                        <img src="./public/images/icons_collection/azul-clicar-botao.svg" alt="PMF">
                        <div class="li-texts">
                            Clique na opção <a href="./cadastrar-viagens.php">Cadastrar Viagem</a> no menu no topo da página.<br>
                            <i> Presione la opción <a href="./cadastrar-viagens.php">Cadastrar Viagem</a> en el menú en la parte superior de la página</i>
                        </div>
                    </li>

                    <li>
                        <img src="./public/images/icons_collection/azul-adicionar-viagem.svg" alt="PMF">
                        <div class="li-texts">
                            Adicione a data de chegada em Florianópolis e a data que deixará Florianópolis.<br>
                            <i> Agregue la fecha de llegada a Florianópolis y la fecha en que saldrá de Florianópolis.</i>
                        </div>
                    </li>

                    <li>
                        <img src="./public/images/icons_collection/azul-adicionar-veiculo.svg" alt="PMF">
                        <div class="li-texts">
                            Adicione as informações do Veículo.<br>
                            <i> Agregue la información del vehículo.</i>
                        </div>
                    </li>

                    <li>
                        <img src="./public/images/icons_collection/azul-adicionar-motorista.svg" alt="PMF">
                        <div class="li-texts">
                            Adicione as informações dos Motoristas.<br>
                            <i> Agregue la información del conductor.</i>
                        </div>
                    </li>

                    <li>
                        <img src="./public/images/icons_collection/azul-adicionar-rota.svg" alt="PMF">
                        <div class="li-texts">
                            Adicione as informações das rotas que serão realizadas na cidade de Florianópolis.<br>
                            <i> Agregue la información de las rutas que se realizarán en Florianópolis.</i>
                        </div>
                    </li>

                    <li>
                        <img src="./public/images/icons_collection/azul-adicionar-passageiro.svg" alt="PMF">
                        <div class="li-texts">
                            Adicione as informações de cada passageiro que estará no veículo.<br>
                            <i> Agregue la información de cada pasajero que estará en el vehículo.</i>
                        </div>
                    </li>

                </ul>

            </article>

            <img class="proximo" src="./public/images/icons_collection/azul-seta-baixo.svg" alt="Próximo">

            <article class="intrucoes-item">
                <header>
                    <strong>ANTES DE CHEGAR EM FLORIANÓPOLIS <br>
                        <i> ANTES DE LLEGAR A FLORIANÓPOLIS </i> </strong>
                </header>

                <ul>
                    <li>
                        <img src="./public/images/icons_collection/azul-download.svg" alt="PMF">
                        <div class="li-texts">
                            Acesse suas viagens e faça o download da Ficha de Viagem e do QR-CODE no botão Download PDF.<br>
                            <i> Acceda a sus viajes y descargue el Formulario de Viaje y el QR-CODE en el botón Download PDF.</i>
                        </div>
                    </li>

                    <li>
                        <img src="./public/images/icons_collection/azul-imprimir.svg" alt="PMF">
                        <div class="li-texts">
                            Imprima as fichas e o QR-CODE.<br>
                            <i> Imprime las tarjetas y el QR-CODE.</i>
                        </div>
                    </li>

                    <li>
                        <img src="./public/images/icons_collection/azul-qr-code-impressao.svg" alt="PMF">
                        <div class="li-texts">
                            Cole o QR-CODE no para-brisa.<br>
                            <i> Pegue el QR-CODE en el parabrisas.</i>
                        </div>
                    </li>

                    <li>
                        <img src="./public/images/icons_collection/azul-ficha-impressao.svg" alt="PMF">
                        <div class="li-texts">
                            Mantenha as fichas de viagem durante a estadia.<br>
                            <i> Mantenga fichas de viaje durante su estadía.</i>
                        </div>
                    </li>

                </ul>

            </article>

            <article class="intrucoes-item">
                <header>
                    <strong>DESEJAMOS UMA BOA VIAGEM <br>
                        AGUARDAMOS VOCÊS EM FLORIANÓPOLIS! <br>
                        <i>DESEAMOS UN BUEN VIAJE <br>
                        ¡ESPERAMOS HACIA FLORIANÓPOLIS!</i> 
                </strong>
                </header>

            </article>

        </main>
    </div>

</body>

</html>