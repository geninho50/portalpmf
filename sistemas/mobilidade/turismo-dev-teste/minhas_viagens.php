<?php
session_start();
require_once('./login/session_status.php');
include_once("./src/conexao.php");
include_once("./src/calculaidade.php");

// link geral do gerado de pdf - biblioteca mpdf

//
$operador_email = $_SESSION['usuarioEmail']; //recebe da pagina anterior o numero do cadastro
$operador_nome = $_SESSION['usuarioNome']; //recebe da pagina anterior o numero do cadastro

echo $operador_nome;

$query_02 = "SELECT * FROM turismo.viagens WHERE operador_email = '$operador_email'";
$resultado_02 = $conn->query($query_02);
$resultado_02_count = $resultado_02->rowCount();

?>

<!DOCTYPE html>
<!-- saved from url=(0071)http://192.168.173.217/teste-interface/src/views/cadastrar-viagens.html -->
<html lang="pt-br">
<!-- lang é um atributo-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Turismo | Cadastre sua viagem </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="./public/styles/main.css">
    <link rel="stylesheet" href="./public/styles/partials/header.css">
    <link rel="stylesheet" href="./public/styles/partials/forms.css">
    <link rel="stylesheet" href="./public/styles/partials/info-nav-bar.css">
    <link rel="stylesheet" href="./public/styles/partials/page-cadastrar-viagens.css">
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@400;700&amp;family=Poppins:wght@400;600&amp;display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="./public/scripts/on-off.js"></script>
</head>

<body id="page-cadastrar-viagens">
    <div id="container">
        <header class="page-header">
            <div class="top-bar-container">
                <a href="http://192.168.173.217/">
                    <img src="./public/images/icons/seta_esquerda.svg" alt="Voltar">
                </a>
                
            </div>
            <div class="header-content">
            <img src="./public/images/logo.svg" alt="PMF">
                <strong>Suas Viagens</strong>
                <p>Aqui estão dos dados das suas <?php echo $resultado_02_count ?> viagens!</p>
            </div>
        </header>
        <main>
        <?php


        if (($resultado_02_count != 0)) {
                          
                ?>
                   <nav>
                        <ul class="nav-form-setp-bar">
                            <li>
                                <img src="./public/images/check_circle.svg" alt="check">
                            </li>
                            <li>
                                Operador Turístico: <b><?php echo $operador_nome; ?></b>
                                <br>Email: <b><?php echo $operador_email; ?></b>
                            </li>
                            <li>
                                <button class="botao-sucesso" onclick="location.href='cadastrar-viagens.php'" type="button">Cadastrar viagem !</button>
                            </li>
                        </ul>
                    </nav>
                  
            

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
                
                    <fieldset id="informacoes_viagem" class="div-show" style="display: block;">
                        <legend> <?php echo $contagem; ?>. Viagem: <?php $contagem ?> <?php echo $cod_registro ?>
                        </legend>
                        <div id="informacoes_viagem_show" style="display:block">
                            País de Origem: <b> <?php echo $pais_origem ?></b><br>
                            Data de cadastro: <b> <?php echo $data_cadastro ?></b><br>
                            Data de Chegada: <b> <?php echo $data_chegada ?></b><br>
                            Data de retorno: <b> <?php echo $data_saida ?></b><br>
                            
                            <button onclick="location.href='http://redemobilidade.pmf.sc.gov.br/turismo-dev-teste/imprimir.php?cod_registro=<?php echo $cod_registro; ?>'" type="button">Imprimir Ficha e<br> QR-CODE</button>

                            <button onclick="location.href='http://redemobilidade.pmf.sc.gov.br/turismo-dev-teste/ficha.php?cod_registro=<?php echo $cod_registro; ?>'" type="button">Ver detalhes</button>
                        </div>
                    </fieldset>
                <?php } ?>
                <footer>
                    <p>
                        Importante! <br>
                        Faça o download da ficha de viagem e QR-CODE!
                        Imprima ......
                    </p>
                    <button onclick="location.href='http://redemobilidade.pmf.sc.gov.br/turismo-dev/imprimir.php?cod_registro=<?php echo $cod_registro; ?>'" type="button">Imprimir Ficha e<br> QR-CODE</button>
                </footer>
                </main>
                </a>
    </div>
</body>

</html>

<?php

        } else {
            echo "O usuário ". $operador_email. " não possuí nenhuma viagem cadastrada!" ;
        }
?>