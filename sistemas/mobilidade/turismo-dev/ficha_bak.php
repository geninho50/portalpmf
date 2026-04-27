<?php
session_start();

include_once("./src/conexao.php");
include_once("./src/calculaidade.php");
// link geral do gerado de pdf - biblioteca mpdf

$cod_registro = $_GET['cod_registro']; //recebe da pagina anterior o numero do cadastro 
$query_02 = "SELECT * FROM turismo.viagens WHERE cod_registro  = '$cod_registro'";
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


</head>

<body>
    <div class="container theme-showcase" role="main">

        <?php

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
                        <br>
                        CADASTRO DE VIAGEM TURÍSTICA: <?php echo  $cod_registro; ?><br>
                    </h3>
                    <br>

                    <a href="imprimir.php?cod_registro=<?php echo $cod_registro;?>" class="btn btn-success"  target="_blank" >Imprimir ficha e QR-CODE</a>

                    <h5>
                    <br>

                        <b class="text-muted">Data de Chegada: </b> <?php echo $data_chegada; ?>
                        <b class="text-muted">&nbsp&nbsp&nbspData de Retorno: </b><?php echo $data_saida; ?>
                        <b class="text-muted">&nbsp&nbsp&nbspData de Cadastro: </b><?php echo $data_cadastro; ?><br>
                    </h5>

                    <!-- Dados do Contratante !-->

                    <h5>
                    <br><b class="text-muted">Operador:<br></b></h5>
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

                    <a href="imprimir.php?id_viagem=<?php echo $id_viagem;?>" class="btn btn-success"  target="_blank" >Imprimir ficha e QR-CODE</a>
                    <a href="email.php?id_viagem=<?php echo $id_viagem;?>" class="btn btn-success"  target="_blank" >Reenviar E-mail</a>

                    <a href="cancelarviagem.php?id_viagem=<?php echo $id_viagem;?>" class="btn btn-success"  target="_blank" >Cancelar Viagem</a>


                </div>
                </form>
    </div>

    <br>
<?php 








}
        } else {
            echo "<div class='alert alert-danger' role='alert'>Não foi possível encontrar o cadastro!</div>";
        } ?>




</div>



</body>

</html>