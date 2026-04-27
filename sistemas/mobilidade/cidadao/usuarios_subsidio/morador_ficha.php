<?php

session_start();
include_once("conexao.php");
$id_cadastro = $_GET['id_cadastro']; //recebe da pagina anterior o numero do cadastro 
$query_02 = "SELECT * FROM sim.moradores_costa where id_cadastro  = '$id_cadastro'";
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
    <script type="text/javascript" src="/js/jquery.js"></script>

</head>

<body>
    <div class="container" theme-showcase" role="main">



        <br>
        <div class="page-header rounded">
            <img src="img\cabecalho_01.jpg" class="img-fluid rounded" alt="Imagem responsiva">
        </div>
        <br>
        <div class="container" role="main">
            <br>
            <h4 class="text-muted" align=center>Requerimento de Cadastramento</h4>

            <?php
            if (($resultado_02_count != 0)) {
                while ($row = $resultado_02->fetch()) {


                    $data_nascimento = date('d-m-Y', strtotime($row['data_nascimento']));
                    $data_validade = date('d-m-Y', strtotime($row['data_validade']));
                    $data_criado = date('d-m-Y', strtotime($row['data_criado']));

                    $rg = substr($row['rg'], 0, strpos($row['rg'], '-'));
                    $rg_orgao = substr($row['rg'], strpos($row['rg'], '-') + 1);

                    $cpf_view1 = substr($row['cpf'], -11,3);
                    $cpf_view2 = substr($row['cpf'], -8,3);
                    $cpf_view3 = substr($row['cpf'], -5,3);
                    $cpf_view4 = substr($row['cpf'], -2);
                    $cpf =  $cpf_view1.".". $cpf_view2.".".$cpf_view3."-". $cpf_view4;
            
                    $data_nascimento = date('d-m-Y', strtotime($row['data_nascimento']));

                    $email_show = "d-none";
                    $telefone_show = "d-none";
                    $validade_show = "d-none";
                    $validade_especial_show = "d-none";
                    $validade_especial_show_2 = "d-none";

                    $validade_especial = date("d-m-Y", strtotime($row['data_validade_especial']));
                    $validade = date("d-m-Y", strtotime($row['data_validade']));
                    $today = date("d-m-Y");
                    if (($row['status']) == 1) $status = "aguardando aprovacao de cadastro";
                    if (($row['status']) == 2) $status = "Cadastro validado";
                    if (($row['email']) != "") $email_show = "d-block";
                    if (($row['telefone01']) != "") $telefone_show = "d-block";

                    if (strtotime($validade) < strtotime($today)) {
                        $validade_show = "d-block";
                    } else {
                        $validade_show = "d-none";
                    }


                    if ($row['categoria'] == "Estudante") {
                        $validade_especial_show_2 = "d-block";
                        if (strtotime($validade_especial) < strtotime($today)) {
                            $validade_especial_show = "d-block";
                        } else {
                            $validade_especial_show = "d-none";
                        }
                    }


                    if ($row['categoria'] == "Gestante") {
                        $validade_especial_show_2 = "d-block";
                        if (strtotime($validade_especial) < strtotime($today)) {
                            $validade_especial_show = "d-block";
                        } else {
                            $validade_especial_show = "d-none";
                        }
                    }


            ?>
                    <br>
                    <div class="container border rounded border-primary" role="main">
                        <h3 class="text-uppercase font-weight-bold">
                            <div class="<?php echo $validade_show ?>"><br>
                                <p class="d-inline p-2 bg-danger text-white">Validade Morador Vencida</p>
                            </div>

                            <div class="<?php echo $validade_especial_show ?>"><br>
                                <p class="d-inline p-2 bg-danger text-white">Validade Especial <?php echo $row['categoria']; ?> Vencida</p>
                            </div><br>

                            <?php
                            echo $row['id_cadastro']; ?> - <?php echo $row['categoria']; ?> <br>
                        </h3>
                        <h5>
                            <b class="text-muted">Nome: </b><?php echo $row['nome_passageiro']; ?><br>
                            <b class="text-muted">CPF: </b><?php echo $cpf; ?><br>
                            <b class="text-muted">RG: </b><?php echo $row['rg']; ?><br>
                            <b class="text-muted">Data de Nascimento: </b><?php echo $data_nascimento; ?><br>

                            <div class="<?php echo $email_show ?>">
                                <b class="text-muted">E-mail: </b><?php echo $row['email']; ?>
                            </div>
                            <div class="<?php echo $telefone_show ?>">
                                <b class="text-muted">Telefone: </b><?php echo $row['telefone01']; ?><br>
                            </div>
                            <b class="text-muted">Endereço: </b>
                            <?php echo $row['rua']; ?>, <?php echo $row['complemento']; ?>
                            <?php echo $row['bairro']; ?>, <?php echo $row['cidade']; ?> - <?php echo $row['uf']; ?><br>
                            <b class="text-muted">Validade: </b><?php echo $data_validade; ?>
                             <br>
                        </h5><br>
                        <?php

                        if ($row['status'] == 1) {
                        ?>
                            <div class='alert alert-danger' role='alert'><b>Status do Processo: </b><?php echo $status; ?></div>
                            <form method="get" id="formuser" autocomplete="off" action="morador_costa_autorizar_cadastro.php?">
                                <input name="id_cadastro" type="hidden" value="<?php echo $row['id_cadastro'] ?>">
                                <span id="msg-error"></span>
                                <div class="btn-toolbar mb-3" role="toolbar" aria-label="Toolbar with button groups">
                                    <div class="btn-group mr-2" role="group" aria-label="First group">
                                        <a class="btn btn-danger" href="print_conferir.php?id_cadastro=<?php echo $row['id_cadastro'] ?>" role="button">Imprimir ficha de análise</a>
                                        <button type="button" class="btn btn-outline-danger btn-sm fa fa-trash pequeno" data-toggle="modal" data-target="#MODAL_ficha">Imprimir ficha de análise 1</button>

                                    </div>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-success" type="submit" class="btn btn-success">Código de validação:</button>
                                        </div>
                                        <input name="codigo_registro" class="form-control btn-outline-success" placeholder="Código" aria-label="Input group example" aria-describedby="btnGroupAddon">
                                        <div class="input-group-append">
                                            <button type="submit" value="Cadastrar" class="btn btn-success">Validar Ficha</button>
                                        </div>
                                    </div>
                                </div>
                    </div>
                    </form>
                    <br>
                <?php } ?>
                <br>
        </div> <br>

        <!-- MODAL IMPRIMIR FICHA-->

        <div id="MODAL_ficha" class="modal fade bd-example-modal-lg" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="MODAL_ficha" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="MODAL_ficha">Imprimir Ficha de Análise</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="get" id="formuser" autocomplete="off" action="print_conferir.php">
                            <div class="form-row">
                                <div class="col col-md-12">
                                    <select class="form-control bg-info text-white" id="nome_fiscal" name="nome_fiscal">
                                        <option selected value="">Escolha o responsável pela autorização:</option>
                                        <option value="José Manuel - Matrícula 1234">José Manuel</option>
                                        <option value="Maria - Matrícula 5678">Maria</option>                                    
                                    </select>
                                </div>
                            </div>
                            </div>
                            <input name="id_cadastro" type="hidden" value="<?php echo $row['id_cadastro'] ?>">
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" value="Imprimir Ficha" class="btn btn-success">Imprimir Ficha</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div align=center><a href="morador_costa.php" class="btn btn-warning" align=center>Fechar | Voltar</a></div>
        <br>
    <?php
                } ?>

<?php
            } else {
                echo "<div class='alert alert-danger' role='alert'>Não foi possível efetivar o cadastro!</div>";
            } ?>
    </div>

    <br>
    <div class="p-3 mb-2 bg-primary text-white">
        <h5> Prefeitura Municipal de Florianópolis</h5>
        <h6>Secretaria de Mobilidade e Planejamento Urbano </h6>
        Rua Felipe Schmidt, n° 1320 – Centro - CEP 88.010-002 – Florianópolis/SC.<br>
    </div>
    <br>
    </div>
    </div>
    </div>



</body>

</html>