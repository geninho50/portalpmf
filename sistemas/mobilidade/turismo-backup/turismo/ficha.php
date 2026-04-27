<?php
session_start();

include_once("./src/database/conexao.php");
include_once("./src/database/calculaidade.php");
// link geral do gerado de pdf - biblioteca mpdf
include("/home/www/sistemas/mobilidade/bas/pdf/mpdf60/mpdf.php");

$id_viagem = $_GET['id_viagem']; //recebe da pagina anterior o numero do cadastro 
$query_02 = "SELECT * FROM turismo.viagens WHERE id_viagem  = '$id_viagem'";
$resultado_02 = $conn->query($query_02);
$resultado_02_count = $resultado_02->rowCount();
?>
<!DOCTYPE HTML>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="javascriptpersonalizado.js"></script>
    <script type="text/javascript" src="javascript_frota.js"></script>
    <script src="sorttable.js"></script>
    <script type="text/javascript" src="jquery.quick.search.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>


    <style>
        .bouton-image:before {
            content: "";
            width: 200px;
            height: 200px;
            display: inline-block;
            margin-right: 0px;
            vertical-align: text-botton;
            background-color: transparent;
            background-position: center center;
            background-repeat: no-repeat;
        }

        .monBouton:before {
            background-image: url(http://redemobilidade.pmf.sc.gov.br/turismo/public/images/printqr1.png);
        }



        .btn-image {
            background-image: url('./public/images/printqr.pgn');
            background-size: contain;
        }
    </style>

</head>

<body>
    <div class="container theme-showcase" role="main">

        <?php

        if (($resultado_02_count != 0)) {

            while ($row = $resultado_02->fetch()) {

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
                <div class="container border rounded border-primary" role="main">
                    <h3 class="text-uppercase font-weight-bold">
                        CADASTRO DE VIAGEM TURÍSTICA: <?php echo $row['id_viagem']; ?><br>
                    </h3>
                    <h5>

                        <b class="text-muted">Data de Chegada: </b> <?php echo $data_chegada; ?>
                        <b class="text-muted">&nbsp&nbsp&nbspData de Retorno: </b><?php echo $data_saida; ?>
                        <b class="text-muted">&nbsp&nbsp&nbspData de Cadastro: </b><?php echo $data_cadastro; ?><br>
                    </h5>

                    <!-- Dados do Contratante !-->

                    <h5><b class="text-muted">Contratante:<br></b></h5>
                    <b class="text-muted">Nome: </b><?php echo $array_contratantes['contratantes_nome'] ?><br>
                    <b class="text-muted">E-mail: </b><?php echo $array_contratantes['contratantes_email'] ?><br>
                    <b class="text-muted">Telefone: </b><?php echo $array_contratantes['contratantes_telefone_com_ddd'] ?><br>
                    <b class="text-muted">Endereço: </b>
                    <?php echo $array_contratantes['contratantes_logradouro'] ?>
                    <?php echo $array_contratantes['contratantes_bairro'] ?>
                    <?php echo $array_contratantes['contratantes_cidade'] ?>
                    <?php echo $array_contratantes['contratantes_estado'] ?>
                    <?php echo $array_contratantes['contratantes_pais'] ?>
                    <br>

                    <!-- Dados da Origem da Viagem !-->
                    <br>
                    <h5><b class="text-muted">Origem da Viagem:<br></b></h5>

                    <b class="text-muted">Endereço: </b>

                    <?php echo $logradouro_origem ?>
                    <?php echo $bairro_origem ?>
                    <?php echo $cidade_origem ?>
                    <?php echo $estado_origem ?>
                    <?php echo $pais_origem ?>
                    <?php echo $demais_referencias ?>

                    <br>


                    <!-- Dados do Veículo !-->
                    <br>
                    <h5><b class="text-muted">Veículo:<br></b></h5>
                    <b class="text-muted">Modelo: </b><?php echo $modelo ?>
                    <b class="text-muted">&nbsp&nbsp&nbspPlaca: </b><?php echo $placa ?>
                    <b class="text-muted">&nbsp&nbsp&nbspTipo: </b><?php echo $tipo; ?><br>
                    <br>


                    <!-- Tabela de Motoristas !-->
                    <h5><b class="text-muted">Motoristas:<br></b></h5>
                    <table id="" class="table table-striped table-hover table-sm" cellspacing="0" width="100%">
                        <tr class="table-primary">
                            <td><b><a class="text-default">Nome</a></b></td>
                            <td><b><a class="text-default">Habilitação</a></b></td>
                            <td><b><a class="text-default">Telefone</a></b></td>
                        </tr>
                        <?php foreach ($array_motoristas as $key => $value) { ?>
                            <tr>
                                <td><?php echo $value['motoristas_nome'] ?></td>
                                <td><?php echo $value['motoristas_documento_habilitacao'] ?> - <?php echo $value['motoristas_orgao_emissor'] ?></td>
                                <td><?php echo $value['motoristas_telefone_ddd'] ?></td>
                            </tr>
                        <?php }; ?>
                    </table>


                    <!-- Tabela de Rotas !-->


                    <b class="text-muted">Rotas Programadas:<br></b>
                    <table id="" class="table table-striped table-hover table-sm" cellspacing="0" width="100%">
                        <tr class="table-primary">
                            <td><b><a class="text-default">Dia</a></b></td>
                            <td><b><a class="text-default">Saída</a></b></td>
                            <td><b><a class="text-default">Local</a></b></td>

                        </tr>
                        <?php foreach ($array_rotas as $key => $value) {
                            $data = date('d-m-Y', strtotime($value['data'])); ?>
                            <tr>
                                <td><?php echo $data ?></td>
                                <td><?php echo $value['rota_saida'] ?></td>
                                <td><?php echo $value['rota_chegada'] ?></td>
                            </tr>

                        <?php }; ?>
                    </table>


                    <b class="text-muted">Passageiros:<br></b>
                    <table id="" class="table table-striped table-hover table-sm" cellspacing="0" width="100%">
                        <tr class="table-primary">
                            <td><b><a class="text-default">Nome</a></b></td>
                            <td><b><a class="text-default">Data de Nascimento</a></b></td>
                            <td><b><a class="text-default">Documento</a></b></td>

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

                    <form method="get" id="formuser" autocomplete="off" action="printViagem.php?">
                        <input name="id_cadastro" type="hidden" value="<?php echo $row['id_viagem'] ?>">

                        <div class="btn-toolbar mb-3" role="toolbar" aria-label="Toolbar with button groups">
                            <div class="input-group" style="margin-right: 20px">
                                <input name="id_cadastro" type="hidden" value="<?php echo $row['id_cadastro'] ?>">
                                <button type="submit" value="Imprimir Ficha" class="btn btn-outline-success">
                                    <img src="http://redemobilidade.pmf.sc.gov.br/turismo/public/images/printqr1.png" class="img-circle" alt="Responsive Image" width="100" height="100" /> Imprimir Ficha</button>

                                <input name="id_cadastro" type="hidden" value="<?php echo $row['id_cadastro'] ?>">

                                <div type="submit" class="card" style="width: 18rem;">

                                    <img class="card-img-top" src="http://redemobilidade.pmf.sc.gov.br/turismo/public/images/printqr1.png" alt="Card image cap">
                                    <div class="card-body">
                                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                </form>
    </div>

    <br>
<?php }
        } else {
            echo "<div class='alert alert-danger' role='alert'>Não foi possível encontrar o cadastro!</div>";
        } ?>


<?php 
// GERANDO OS ELEMENTOS DA FICHA .pdf 
    // 1. GERA cabeçalho da ficha 

        $cabecalho = "
        <table style=\"height:200px\" width=\"100%\">
            <tr valign=\"bottom\">
            <td width=\"30%\"><img src=\"/home/www/sistemas/mobilidade/bas/img/PMFSMPU.jpg\" ></td>
            <td width=\"30%\"></td>
            <td width=\"15%\"><img align=\"right\" src=\"/home/www/sistemas/mobilidade/bas/img/REMOB_COR.jpg\" width=\"50%\"></td>
            </tr>
        </table>
        <br>
        ";

        $html = $cabecalho;

        $mpdf = new mPDF();
        $mpdf->SetDisplayMode('fullpage');
        $css = file_get_contents("/home/www/sistemas/mobilidade/bas/pdf/css/mpdfestilo.css");
        $mpdf->WriteHTML($css, 1);
        $mpdf->WriteHTML($html);
        $mpdf->Output();
        exit;


        ?>


</div>



</body>

</html>