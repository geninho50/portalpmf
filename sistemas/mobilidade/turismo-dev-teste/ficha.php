<?php
session_start();

include_once("./src/conexao.php");
include_once("./src/calculaidade.php");
// link geral do gerado de pdf - biblioteca mpdf


$cod_registro = $_GET['cod_registro']; //recebe da pagina anterior o numero do cadastro
$contratantes_email = $_GET['contratantes_email']; //recebe da pagina anterior o numero do cadastro

$query_02 = "SELECT * FROM turismo.viagens WHERE cod_registro  = '$cod_registro'";
$resultado_02 = $conn->query($query_02);
$resultado_02_count = $resultado_02->rowCount();


if (($resultado_02_count != 0)) {

    while ($row = $resultado_02->fetch()) {

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
        // decode json Contratantes

        $contratantes = $row['contratantes'];
        $array_contratantes = json_decode($contratantes, true);
        $contratantes_nome = $array_contratantes['contratantes_nome'];
        $contratantes_email = $array_contratantes['contratantes_email'];
        $contratantes_telefone = $array_contratantes['contratantes_telefone_com_ddd'];

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


<!DOCTYPE html>
<!-- saved from url=(0071)http://192.168.173.217/teste-interface/src/views/cadastrar-viagens.html -->
<html lang="pt-br"><!-- lang é um atributo-->
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
                <!-- <img src="./public/images/icons/seta_esquerda.svg" alt="Voltar"> -->
                </a>
                <!-- <img src="./public/images/logo.svg" alt="PMF"> -->
            </div>
            <img src="./public/images/logo.svg" alt="PMF">

            <div class="header-content">
                <img src="./public/images/logo.svg" alt="PMF">
                <strong>
                Ficha da Viagem  <?php echo  $cod_registro; ?></strong>
                <p>Aqui estão dos dados da viagem</p>
            </div>
       
        </header>
        <nav>
            <ul class="nav-form-setp-bar">
                
                <li>
                    <img src="./public/images/check_circle.svg" alt="check">
                </li>

                        
                <li>
                    <h3>Data de Chegada : <strong><?php echo $data_chegada; ?></strong> </h3>
                    <h3>Data de Retorno : <strong><?php echo $data_saida; ?></strong> </h3>
                </li>                
                <li>
                    <button  class="botao-sucesso" onclick="location.href='http://redemobilidade.pmf.sc.gov.br/turismo-dev/imprimir.php?cod_registro=<?php echo $cod_registro;?>'" 
                            type="button">Imprimir Ficha e<br>
                            QR-CODE
                    </button>
                </li>                  

            </ul>
        </nav>
        <main>
            
                <fieldset id="cadastro_contratantes" class="div-show" style="display: block;">
                  
                  
                  
                    <legend> Dados da operadora</legend>
                    Operador Turístico: <b><?php echo $contratantes_nome; ?></b>
                    <br> Telefone: <b><?php echo $contratantes_telefone; ?></b>
                    <br>Email: <b><?php echo $contratantes_email; ?></b>
                    <br>Endereço:<b>
                    <?php echo $array_contratantes['contratantes_logradouro'] ?>
                    <?php echo $array_contratantes['contratantes_bairro'] ?>
                    <?php echo $array_contratantes['contratantes_cidade'] ?>
                    <?php echo $array_contratantes['contratantes_estado'] ?>
                    <?php echo $array_contratantes['contratantes_pais'] ?> </b>
                </fieldset>



                <fieldset id="cadastro_veiculo" class="div-show" style="display: block;">
                    <legend> Veículo</legend>
                    <div id="cadastro_veiculo_show" style="display:block">
                    Placa: <b><?php echo $placa ?></b>&nbsp&nbsp&nbspModelo: <b><?php echo $modelo ?></b>&nbsp&nbsp&nbspTipo: <b><?php echo $tipo; ?></b> 

                    </div>
                </fieldset>

                

                <fieldset id="informacoes_viagem" class="div-show" style="display: block;">
                    <legend> Informações Sobre a Viagem</legend>
                    <div id="informacoes_viagem_show" style="display:block">


                    País de Origem: <b> <?php echo $pais_origem ?></b><br>
                    Endereço:<b>
                    <?php echo $logradouro_origem ?>
                    - <?php echo $bairro_origem ?>
                    - <?php echo $cidade_origem ?>
                    , <?php echo $estado_origem ?></b><br>
                    Mais informações: 
                    <b><?php echo $demais_referencias ?></b>
                    
                    </div>
                </fieldset>



                <fieldset id="cadastro_motoristas" class="div-show" style="display: block;">
                    <legend> Motoristas
                    <button type="button"id="button_mudarEstadoDetalhes_motoristas"
                        onclick="mudarEstadoDetalhes('cadastro_motoristas_show','button_mudarEstadoDetalhes_motoristas')">+ Ver detalhes</button>
                    </legend>
                    <div id="cadastro_motoristas_show" style="display:none">
                        <table id="" class="table table-striped table-hover table-sm" cellspacing="0" width="100%">
                            <tr class="table-primary">
                                <td><b><a>Nome</a></b></td>
                                <td><b><a>Habilitação</a></b></td>
                                <td><b><a>Telefone</a></b></td>
                            </tr>
                            <?php foreach ($array_motoristas as $key => $value) { ?>
                                <tr>
                                    <td><?php echo $value['motoristas_nome'] ?></td>
                                    <td><?php echo $value['motoristas_documento_habilitacao'] ?> - <?php echo $value['motoristas_orgao_emissor'] ?></td>
                                    <td><?php echo $value['motoristas_telefone_ddd'] ?></td>
                                </tr>
                            <?php }; ?>
                        </table>
                    </div>
                </fieldset>


                <fieldset id="cadastro_rotas" class="div-show" style="display: block;">
                    <legend> Rotas Programadas
                        <button type="button"id="button_mudarEstadoDetalhes_rotas"
                        onclick="mudarEstadoDetalhes('cadastro_rotas_show','button_mudarEstadoDetalhes_rotas')">Ver detalhes + </button>
                    </legend>
                    <div id="cadastro_rotas_show" style="display:none">
                    <table id="" class="table table-striped table-hover table-sm" cellspacing="0" width="100%">
                        <tr class="table-primary">
                            <td><b><a>Dia</a></b></td>
                            <td><b><a>Saída</a></b></td>
                            <td><b><a>Local</a></b></td>

                        </tr>
                        <?php foreach ($array_rotas as $key => $value) {
                            $data = date('d-m-Y', strtotime($value['data'])); ?>
                            <tr>
                                <td><?php echo $data ?></td>
                                <td><?php echo $value['endereco_partida'] ?></td>
                                <td><?php echo $value['endereco_destino'] ?></td>
                            </tr>

                        <?php }; ?>
                    </table>

                    </div>
                </fieldset>


                <fieldset id="cadastro_passageiros" class="div-show" style="display: block;">
                    <legend> Lista de Passageiros
                        <button type="button"id="button_mudarEstadoDetalhes_passageiros"
                            onclick="mudarEstadoDetalhes('cadastro_passageiros_show','button_mudarEstadoDetalhes_passageiros')">+ Ver detalhes</button>
                        </legend>
                    </legend>
                    <div id="cadastro_passageiros_show" style="display:none">

                    <table id="" class="table table-striped table-hover table-sm" cellspacing="0" width="100%">
                        <tr class="table-primary">
                            <td><b><a>Nome</a></b></td>
                            <td><b><a>Data de Nascimento</a></b></td>
                            <td><b><a>Documento</a></b></td>

                        </tr>
                        <?php foreach ($array_passageiros as $key1 => $value1) {
                            $data = date('d-m-Y', strtotime($value1['data_nascimento']));
                        ?>
                            <tr>
                                <td><?php echo $value1['nome']; ?> </td>
                                <td><?php echo $data;?> ( <?php echo calcular_idade($data, $data_chegada); ?> )</td>
                                <td><?php echo $value1['tipo_documento'] ?> : <?php echo $value1['documento'] ?> - <?php echo $value1['orgao_emissor'] ?></td>
                            </tr>
                        <?php }; ?>
                    </table>
                    </div>
                </fieldset>
               
                <fieldset id="schedule-items" class="div-show" style="display: none;">
                    <legend>
                        Cadastro de Passageiros
                        <button id="add-time">+ Adicionar passageiro</button>
                    </legend>
                </fieldset>                        

            <footer>
                <p>
                    Importante! <br>
                    Faça o download da ficha de viagem e QR-CODE!
                    Imprima ......
                </p>
                <button onclick="location.href='http://redemobilidade.pmf.sc.gov.br/turismo-dev/imprimir.php?cod_registro=<?php echo $cod_registro;?>'" type="button">Imprimir Ficha e<br> QR-CODE</button>
            </footer>
               
        </main>
    </a></div><a>


</a></body></html>



<?php   } 
 } 


else 

{ echo "nao";}
?>