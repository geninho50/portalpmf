<!DOCTYPE html>
<html lang="pt-br">
<!-- lang é um atributo-->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Turismo | Cadastre sua viagem </title>

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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="./public/scripts/addField.js"></script>
    <script src="./public/scripts/jqueyPostToPhp.js"></script>
    <script src="./public/scripts/form.js"></script>
    <script src="./public/scripts/on-off.js"></script>


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

                <strong>Selo Turístico</strong>
                <p>Sua Viagem .....</p>
            </div>
            <div id="stage1" style="background-color:maroon;color:white; display:none">
            </div>
        </header>

        <main>

        <button onclick="location.href='http://redemobilidade.pmf.sc.gov.br/turismo-dev-teste/cadastrar-viagens.php'" type="button">Login!</button>
        <button onclick="location.href='http://redemobilidade.pmf.sc.gov.br/turismo-dev-teste/cadastrar-viagens.php'" type="button">Cadastrar viagem!</button>


            <fieldset id="schedule-items" class="div-show" style="display: block;">

                <legend> 1. Preencha Corratamente o formulário on-line


                </legend>

                <div style="display: grid;  grid-template-columns: 50px auto ;  grid-gap: 10px;  padding: 10px;">

                    <div>
                        <img style="display: block;  margin-left: auto;  margin-right: auto;  width: 100%;" src="./public/images/1.-adicionar_operadora-24px.svg" alt="PMF">
                    </div>
                    <div>
                        Preencha corretamente dos dados da operadora
                    </div>

                    <div>
                        <img style="display: block;  margin-left: auto;  margin-right: auto;  width: 100%;" src="./public/images/1.2-adicionar-viagem-24px.svg" alt="PMF">
                    </div>
                    <div>
                        Defina a data que estará em Florianópolis e que deixará Florianópolis.
                    </div>

                    <div>
                        <img style="display: block;  margin-left: auto;  margin-right: auto;  width: 100%;" src="./public/images/1.-adicionar-motorista-24px.svg" alt="PMF">
                    </div>
                    <div>
                        Inclua a lista de motoristas da viagem
                    </div>

                    <div>
                        <img style="display: block;  margin-left: auto;  margin-right: auto;  width: 100%;" src="./public/images/1.-adicionar_rota-24px.svg" alt="PMF">
                    </div>
                    <div>
                        As rotas
                    </div>

                    <div>
                        <img style="display: block;  margin-left: auto;  margin-right: auto;  width: 100%;" src="./public/images/1.-adicionar-passageiro-24px.svg" alt="PMF">
                    </div>
                    <div>
                        Preencha a lista de passageiros, indicando ....
                    </div>

                </div>
            </fieldset>


            <fieldset id="schedule-items" class="div-show" style="display: block;">

                <legend> 2. Faça o download da ficha de viagem e QR-CODE


                </legend>

                <div style="display: grid;  grid-template-columns: 50px auto ;  grid-gap: 10px;  padding: 10px;">

                    <div>
                        <img style="display: block;  margin-left: auto;  margin-right: auto;  width: 100%;" src="./public/images/1.-adicionar-passageiro-24px.svg" alt="PMF">
                    </div>
                    <div>
                        Após o preenchimento do formulário você terá acesso a ficha de viagem on-line.
                    </div>

                    <div>
                        <img style="display: block;  margin-left: auto;  margin-right: auto;  width: 100%;" src="./public/images/1.-adicionar-passageiro-24px.svg" alt="PMF">
                    </div>
                    <div>
                        Imprima as fichas e o QR-CODE
                    </div>

                    <div>
                        <img style="display: block;  margin-left: auto;  margin-right: auto;  width: 100%;" src="./public/images/1.-adicionar-passageiro-24px.svg" alt="PMF">
                    </div>
                    <div>
                        Cole o QR-CODE no para-brisa
                    </div>

                    <div>
                        <img style="display: block;  margin-left: auto;  margin-right: auto;  width: 100%;" src="./public/images/1.-adicionar-passageiro-24px.svg" alt="PMF">
                    </div>
                    <div>
                        Mantenha as fichas de viagem durante a estadia
                    </div>

                </div>
            </fieldset>

            <fieldset id="schedule-items" class="div-show" style="display: block;">

            <legend> 3. Cole o QR-CODE no veículo e mantanha as fichas durante a viagem


            </legend>

            <div style="display: grid;  grid-template-columns: 50px auto ;  grid-gap: 10px;  padding: 10px;">

                <div>
                    <img style="display: block;  margin-left: auto;  margin-right: auto;  width: 100%;" src="./public/images/1.-adicionar-passageiro-24px.svg" alt="PMF">
                </div>
                <div>
                    nonono </div>

                <div>
                    <img style="display: block;  margin-left: auto;  margin-right: auto;  width: 100%;" src="./public/images/1.-adicionar-passageiro-24px.svg" alt="PMF">
                </div>
                <div>
                    nonoon </div>

                <div>
                    <img style="display: block;  margin-left: auto;  margin-right: auto;  width: 100%;" src="./public/images/1.-adicionar-passageiro-24px.svg" alt="PMF">
                </div>
                <div>
                    nononon </div>

                <div>
                    <img style="display: block;  margin-left: auto;  margin-right: auto;  width: 100%;" src="./public/images/1.-adicionar-passageiro-24px.svg" alt="PMF">
                </div>
                <div>
                    nonon </div>

            </div>
            </fieldset>




            <footer>
                <p>
                    Importante! <br>
                    Preencha todos os dados corretamente
                </p>
                <button onclick="location.href='http://redemobilidade.pmf.sc.gov.br/turismo-dev-teste/cadastrar-viagens.php'" type="button">Cadastrar Viagens!</button>

            </footer>

    </div>


    <!-- onclick="Swal.fire(
                    'Good job!',
                    'You clicked the button!',
                    'success'
                  );" -->

    </main>
    <script>

    </script>
    </div>

</body>

</html>