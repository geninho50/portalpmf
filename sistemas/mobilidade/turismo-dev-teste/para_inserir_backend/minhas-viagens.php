<!DOCTYPE html>
<html lang="pt-br"><!-- lang é um atributo-->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Turismo | Cadastro de Operadores Turimo </title>

    <link rel="stylesheet" href="public/styles/main.css">
    <link rel="stylesheet" href="public/styles/partials/header.css">
    <link rel="stylesheet" href="public/styles/partials/page-minhas-viagens.css">
    
    <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@400;700&amp;family=Poppins:wght@400;600&amp;display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@400;700&amp;family=Poppins:wght@400;600&amp;display=swap" rel="stylesheet">

    <script src="./public/scripts/mobile-nav-bar-active.js" defer></script> <!-- Script for mobile nav-bar links-->
</head>

<body id="page-minhas-viagens">

    <div id="container">
        <header class="page-header">
            <div class="top-bar-container">
                <nav class="navbar" >
                    <div class="logo-title">
                        SELO TURÍSTICO
                    </div>
                    <a href="#" class="toggle-button">
                        <span class="bar"></span>
                        <span class="bar"></span>
                        <span class="bar"></span>
                    </a>
                    <ul class="navbar-links">
                        <li>
                            <a href="">Ajuda</a>
                        </li>
                        <li>
                            <a href="">Meus dados</a>
                        </li>
                        <li>
                            <a href="">Cadastrar viagem</a>
                        </li>
                        <li>
                            <a href="">Sair</a>
                        </li>
                        
                    </ul>
                </nav>
            </div>
            <div class="header-content">
            <img src="./public/images/logo.svg" alt="PMF">
                <strong>Suas Viagens</strong>
                <p>Aqui estão dos dados das suas 
                    <?php //echo $resultado_02_count ?> 
                    viagens!</p>
            </div>
        </header>
            
        <main>
            <!-- Mensagem caso não tenha viagens cadastradas -->
            <p class="no-results">Nenhum viagem cadastrada</p>

            <article class="minhas-viagens-item">
                <header>
                    <div>
                        <strong>Viagem ? </strong>
                    </div>
                </header>
            
                <p>
                    <strong>País de Origem: </strong> <br>
                    <strong>Data de cadastro: </strong>15-12-2020<br>
                    <strong>Data de Chegada: </strong>23-12-2020<br>
                    <strong>Data de retorno: </strong>01-01-1970<br>
                </p>
            
                <footer>
                    <p>Acesse de sua ficha de viagem <br>
                    para obter o <strong>QRCode</strong>
                    </p>
                    <div class="footer-buttons">
                    <a href="link para iterar" class="button" target="_blank">
                        Download PDF
                        <img src="./public/images/icons/qr-code.svg" alt="Gerar QRCode">
                        
                    </a>  
                    <a href="link para iterar" class="button" target="_blank">
                        <!-- <img src="icone de qrcode" alt="Gerar QRCode"> -->
                        Ver detalhes
                    </a>      
                    </div>
                                    
                </footer>
            </article>

        </main>
    </div>
   
</body>
</html>