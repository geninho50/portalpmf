<?php
session_start();
require_once('./login/session_status.php');
include_once("./src/conexao.php");
include_once("./src/calculaidade.php");
$operador_email = $_SESSION['usuarioEmail'];

// link geral do gerado de pdf - biblioteca mpdf

//
$operador_email = $_SESSION['usuarioEmail']; //recebe da pagina anterior o numero do cadastro
$operador_nome = $_SESSION['usuarioNome']; //recebe da pagina anterior o numero do cadastro

// echo $operador_nome;

$query_02 = "SELECT * FROM turismo.viagens WHERE operador_email = '$operador_email' ORDER BY data_chegada";
$resultado_02 = $conn->query($query_02);
$resultado_02_count = $resultado_02->rowCount();

?>


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
                        <a href="./">SELO TURÍSTICO</a> 
                    </div>
                    <a href="#" class="toggle-button">
                        <span class="bar"></span>
                        <span class="bar"></span>
                        <span class="bar"></span>
                    </a>
                    <ul class="navbar-links">
                        <li>
                            <a href="./">Ajuda</a>
                        </li>
                        <li>
                            <a href="#">Dados da Operadora</a>
                        </li>
                        <li>
                            <a href="./cadastrar-viagens.php">Cadastrar viagem</a>
                        </li>

                        <li>
                            <a href="./login/sair.php">Sair</a>
                        </li>
                        
                    </ul>
                </nav>
            </div>
            <div class="header-content">
            <img src="./public/images/logo.svg" alt="PMF">
                <strong>Suas Viagens</strong>
                <p>
                    <strong><?php echo $_SESSION['usuarioNome']; ?></strong> <br> Aqui estão suas 
                    <?php //echo $resultado_02_count ?> 
                    viagens!
                </p>
            </div>
        </header>
            
        <main>
        <?php
        if (($resultado_02_count != 0)) {
                          
        ?>

        <!-- Inserir aqui os dados da operadora -->
          
        <?php
            while ($row = $resultado_02->fetch()) {
                $contagem = $contagem + 1;
                $id_viagem = $row['id_viagem'];
                $cod_registro = $row['cod_registro'];
                $data_cadastro = date('d-m-Y', strtotime($row['data_cadastro']));
                $data_chegada = date('d-m-Y', strtotime($row['data_chegada']));
                $data_saida = date('d-m-Y', strtotime($row['data_saida']));
                // dados do veiculo
                $modelo = $row['modelo'];
                $placa = $row['placa'];
                $tipo = $row['tipo'];
                // dados da origem da viagem
                $logradouro_origem = $row['logradouro_origem'];
                $bairro_origem = $row['bairro_origem'];
                $cidade_origem = $row['cidade_origem'];
                $estado_origem = $row['estado_origem'];
                $pais_origem = $row['pais_origem'];
                $demais_referencias = $row['demais_referencias'];
                // decode json Motoristas
                $motoristas = $row['motoristas'];
                $array_motoristas = json_decode($motoristas, true);
                // decode json Rotas
                $rotas = $row['rotas'];
                $array_rotas = json_decode($rotas, true);
                // decode json Passageiros
                $passageiros = $row['passageiros'];
                $array_passageiros = json_decode($passageiros, true);
        ?>

           <article class="minhas-viagens-item">
                <header>
                    <div>
                        <strong>Viagem<?php echo $cod_registro ?> </strong>
                    </div>
                </header>
            
                <p>
                    <strong>País de Origem:</strong> <?php echo $pais_origem; ?> <br>
                    <strong>Data de cadastro: </strong><?php echo $data_cadastro; ?><br>
                    <strong>Data de Chegada: </strong><?php echo $data_chegada; ?><br>
                    <strong>Data de retorno: </strong><?php echo $data_saida; ?><br>
                    <!-- <strong>Dias de permanência: </strong><?php //echo $data_saida - $data_chegada;?><br> -->
                </p>
            
                <footer>
                    <p>Acesse de sua ficha de viagem <br>
                    para obter o <strong>QRCode</strong>
                    </p>
                    <div class="footer-buttons">
                    <a href="http://redemobilidade.pmf.sc.gov.br/turismo-dev/imprimir.php?cod_registro=<?php echo $cod_registro; ?>" class="button" target="_blank">
                        Download PDF
                        <img src="./public/images/icons/qr-code.svg" alt="Gerar QRCode">
                    </a>  
                    <a href="http://redemobilidade.pmf.sc.gov.br/turismo-dev/ficha.php?cod_registro=<?php echo $cod_registro; ?>"  class="button" target="_blank">
                        <!-- <img src="icone de qrcode" alt="Gerar QRCode"> -->
                        Ver detalhes
                    </a>   
                    </div>
                    <!-- <button onclick="location.href='http://redemobilidade.pmf.sc.gov.br/turismo-dev/imprimir.php?cod_registro=<?php //echo $cod_registro; ?>'" type="button">Imprimir Ficha e<br> QR-CODE</button> -->
                                    
                </footer>
            </article>

            <?php
                }} else {
                    // Mensagem caso não tenha viagens cadastradas
                    echo '<p class="no-results">Nenhum viagem cadastrada</p>';
                }
            ?>
        </main>
    </div>
   
</body>
</html>