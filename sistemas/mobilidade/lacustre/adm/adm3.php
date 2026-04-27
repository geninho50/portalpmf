<!--**
 	*  SMPU - Upload de cadastros qr-code
	*  cortesia: Michel Mittmann
 	*  lembre -se de conceder os créditos ao desenvolvedor.
 *-->

<?php
include_once("conexao.php");

//Verificar se está sendo passado na URL a página atual, senao é atribuido a pagina
$data = (isset($_REQUEST['data'])) ? $_REQUEST['data'] : date("Y-m-d");
unset($_POST);
unset($_REQUEST);
$select_data_operacao = $data; //utilizado para pesquisa no banco de dados
$orderby = (isset($_GET['orderby'])) ? $_GET['orderby'] : 1;
$orderdir = (isset($_GET['orderdir'])) ? $_GET['orderdir'] : 'DESC';
$viagens_dia = (isset($_GET['viagens_dia'])) ? $_GET['viagens_dia'] : 0;
$pagina = (isset($_GET['pagina'])) ? $_GET['pagina'] : 1;
$numresultados = (isset($_GET['numresultados'])) ? $_GET['numresultados'] : 5000; //Número inicial de resultados por página
if ($orderby == 1)  $orderbysel = 'a.id_validador';
if ($orderby == 2)  $orderbysel = 'a.data_operacao';
if ($orderby == 3)  $orderbysel = 'a.sentido';
if ($orderby == 4)  $orderbysel = 'a.id';
if ($orderby == 5)  $orderbysel = 'a.id_veiculo';
unset($_GET);


$data_ant = null;

//paginador por datas
$select_data_operacao = $data;
$select_data_anterior = strtotime('-1 days', strtotime($data));
$select_data_posterior = strtotime('+1 days', strtotime($data));

//Selecionar todos os itens da tabela 
$query_01 = "SELECT * FROM lacustre.viagens  WHERE data_operacao ='$select_data_operacao'";
$resultado_01 = $conn->query($query_01);
$total_01 = $resultado_01->rowCount(); //contagens query inicial]

//calcular o número de pagina necessárias para apresentar os resultados
$num_pagina = ceil($total_01 / $numresultados);
$total = $total_01;
$quantidadeDeLinks = ceil($total / $numresultados);

//Calcular o inicio da visualizacao
$inicio = ($numresultados * $pagina) - $numresultados;

//Selecionar os resultados a serem apresentado para cada página 
//Selecionar os resultados a serem apresentado para cada página 
$query_02 = "SELECT * FROM lacustre.viagens  WHERE data_operacao ='$select_data_operacao' ORDER BY a.data_operacao, a.horario_operacao desc LIMIT $numresultados OFFSET $inicio";
$resultado_02 = $conn->query($query_02);
$total_02 = $resultado_02->rowCount();

?>
<!DOCTYPE HTML>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="javascriptpersonalizado.js"></script>
    <script type="text/javascript" src="javascript_frota.js"></script>
    <script src="sorttable.js"></script>
    <script type="text/javascript" src="jquery.quick.search.js"></script>

    <script type="text/javascript" src="/js/jquery.js"></script>
    <script type="text/javascript" src="/js/moment.js"></script>
    <script type="text/javascript" src="/js/tempusdominus-bootstrap-4.min.js"></script>

    <link href="css/bootstrap-datepicker.standalone.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/locales/bootstrap-datepicker.pt-BR.min.js"></script>

    <style>
        .pequeno {
            width: 30px;
        }

        .medio {
            width: 50%;
        }
    </style>

    <title>Base de Dados SIM - Dash Viagens Extras</title>
</head>

<body>







    <div class="container" theme-showcase" role="main">
        <!-- Imagem Cabeçalho -->
        <br>
        <div class="page-header rounded">
            <img src="img\cabecalho_01.jpg" class="img-fluid rounded" alt="Imagem responsiva">
        </div>
        <div class="container" role="main">

            <br>
            <!-- Fim imagem cabeçalho -->

            <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
                <div class="btn-group mr-2" role="group" aria-label="1 group">

                    <form method="POST" action="" enctype="multipart/form-data">

                        <div class="botton-group row">

                            <div class="button-group mr-2">
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#MODALpesquisacadastrar">Cadastrar</button>
                            </div>
                            <div class="button-group mr-2 ">
                                <input type="text" class="input-search btn btn-outline-secondary" alt="lista-clientes" placeholder="Buscar nesta lista" />
                            </div>
                            <div class="btn-group">
                                <input type="date" name="data" class="btn btn-outline-secondary" id="" value="<?php echo $data ?>" placeholder="<?php echo $data ?>">
                                <button class="btn btn-outline-secondary fa fa-search-plus" type="submit"></button>
                                <button type="submit" name="data" class="btn btn-outline-secondary fa fa-arrow-left" value="<?php echo date('Y-m-d', $select_data_anterior) ?>">
                                </button>
                                <button type="submit" name="data" class="btn btn-outline-secondary fa fa-arrow-right" value="<?php echo date('Y-m-d', $select_data_posterior) ?>">
                                </button>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="btn-group mr-2" role="group" aria-label="3">
                    <a type="button" class="btn btn-outline-info" href="" role="button">DashBoard</a>
                    <a type="button" class="btn btn-outline-info" href="relatorios_extras.php" role="button">Relatórios</a>
                </div>

            </div>
            <br>


            -->
            <div class="row">
                <?php while ($row = $resultado_02->fetch()) { ?>
                    <?php if (date('d-m-Y', strtotime($row['data_operacao'])) != $data_ant) { ?>
                        <br> <strong>
                            <h3><?php echo date('d-m-Y', strtotime($row['data_operacao'])) . ' |  Total de Viagens : ' . $total_01; ?> </h3>
                        </strong>
            </div>
        </div>


        <table id="dtBasicExample" class="sortable lista-clientes table table-striped table-hover table-sm" cellspacing="0" width="100%">

            <tr class="table-primary">
                <td><b><a class="text-default">#</a></b></td>
                <td><b><a class="text-default">Data</a></b></td>
                <td><b><a class="text-default">Horário</a></b></td>
                <td><b><a class="text-default">Modalidade</a></b></td>
                <td><b><a class="text-default">Sentido</a></b></td>
                <td><b><a class="text-default">Embarcação</a></b></td>
                <td><b><a class="text-default">Status</a></b></td>
                <td><b><a class="text-default">Ação</a></b></td>
            </tr>

            <?php
                        //reinicia variaveis data e numero de viagens para apresentar na tabela
                        $data_ant = (date('d-m-Y', strtotime($row['data_operacao'])));
                        $totalviagensdia = $viagens_dia;
                        $viagens_dia = 0;
            ?>
        <?php }
                    if ($row['status'] == '1')
                        $status = 'Pre-cadastro';
                    if ($row['status'] == '2')
                        $status = 'Validada';
                    if ($row['status'] == '3')
                        $status = 'Justificar';

                    $viagens_dia = $viagens_dia + 1;
        ?>
        <tr>
            <td width=5%><?php echo $row['id']; ?></td>
            <td width=12%><?php echo date('d/m/y', strtotime($row['data_viagem'])); ?></td>
            <td width=10%><?php echo date('H:i', strtotime($row['horario']));
                            $row['horario']; ?></td>
            <td width=10%><?php echo $row['modalidade']; ?></td>
            <td width=10%><?php echo $row['sentido']; ?></td>
            <td width=10%><?php echo $row['id_embarcacao']; ?></td>
            <td width=10%><?php echo $status ?></td>
            <td width=auto>
                <button type="button" class="btn btn-outline-info btn-sm fa fa-picture-o pequeno" data-toggle="modal" data-target="#MODALverimagem" data-teid="<?php echo $row['id']; ?>" data-id_embarcacao="<?php echo $row['id_embarcacao']; ?>" data-data_operacao="<?php echo date('d/m/Y', strtotime($row['data_viagem'])); ?>" data-horario_operacao="<?php echo $row['horario']; ?>" data-sentido="<?php echo $row['sentido']; ?>" data-fichadeviagem="<?php echo $row['imagem']; ?>" />
                <button type="button" class="btn btn-outline-danger btn-sm fa fa-trash pequeno" data-toggle="modal" data-target="#MODALapagar" data-teid="<?php echo $row['id']; ?>" data-id_embarcacao="<?php echo $row['id_embarcacao']; ?>" data-data_operacao="<?php echo date('d/m/Y', strtotime($row['data_viagem'])); ?>" data-horario_operacao="<?php echo $row['horario']; ?>" data-sentido="<?php echo $row['sentido']; ?>" />
            </td>
        </tr>


        <!-- Inicio Modal Detalhes-->
        <div class="modal fade" id="myModal<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title text-center" id="myModalLabel">Detalhes Viagem Extra</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                    </div>
                    <div class="modal-body">
                        <p><?php echo $row['num']; ?> | <?php echo $row['id_validador']; ?> | <?php echo $row['nome']; ?></p>
                        <p>Data: <?php echo $data_operacao; ?> Horário: <?php echo $horario_operacao; ?></p>
                        <p>Veículo: <?php echo $row['id_veiculo']; ?></p>
                        <p>Sentido: <?php echo $row['sentido']; ?></p>
                        <p>Cadastro: <?php echo $row['solicitacao_user']; ?></p>
                        <p>Motivo: <?php echo $motivo; ?></p>
                        <p>Obs: <?php echo $row['obs']; ?></p>

                    </div>
                </div>
            </div>
        </div>
        <!-- Fim Modal -->


        <!-- Inicio Modal Editar Viagens Extras-->
        <div class="modal fade" id="MODALeditar" tabindex="-1" role="dialog" aria-labelledby="MODALeditarLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title text-center">Editar Viagem Extra: </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>


                    <div class="modal-body">

                        <form>



                            <fieldset class="form-group">
                                <div class="row">
                                    <legend class="col-form-label col-sm-2 pt-0">Linha</legend>
                                    <div class="col-sm-10">
                                        <div class="form-group">

                                            <input class="form-control" type="search" id="edit_num" list="lista_linhas" name="edit_nome">
                                            <datalist id="lista_linhas">
                                                <?php while ($row4 = $resultado_04->fetch()) {
                                                    echo "<option>" . $row4['num'] . " - " . $row4['nome'] . "</option>";
                                                } ?>
                                            </datalist>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>




                            <fieldset class="form-group">
                                <div class="row">
                                    <legend class="col-form-label col-sm-2 pt-0">Dia</legend>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <input name="edit_data_operacao" type="date" class="form-control" id="edit_data_operacao">
                                        </div>

                                    </div>
                                </div>
                            </fieldset>




                            <fieldset class="form-group">
                                <div class="row">
                                    <legend class="col-form-label col-sm-2 pt-0">Horário:</legend>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <input name="edit_horario_operacao" type="time" class="form-control" id="edit_horario_operacao">
                                        </div>
                                    </div>
                                </div>
                            </fieldset>



                            <fieldset class="form-group">
                                <div class="row">
                                    <legend class="col-form-label col-sm-2 pt-0">Veículo</legend>
                                    <div class="col-sm-10">
                                        <div class="form-group">

                                            <input class="form-control" type="search" id="edit_id_veiculo" list="lista_veiculos" name="edit_id_veiculo" value="edit_id_veiculo">
                                            <datalist id="lista_veiculos">
                                                <?php while ($row3 = $resultado_03->fetch()) {
                                                    echo "<option>" . $row3['operadora'] . " - " . $row3['numordem'] . "</option>";
                                                } ?>
                                            </datalist>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>



                            <fieldset class="form-group">
                                <div class="row">
                                    <legend class="col-form-label col-sm-2 pt-0">Sentido</legend>
                                    <div class="col-sm-10">

                                        <div class="form-check form-check custom-radio">
                                            <input class="custom-control-input" type="radio" name="edit_sentido" id="edit_sentido_ida" value="IDA" <?php if ($row['sentido'] == 'IDA') echo 'checked'; ?>>
                                            <label class="custom-control-label" for="edit_sentido_ida">IDA</label>
                                        </div>

                                        <div class="form-check form-check custom-radio">
                                            <input class="custom-control-input" type="radio" name="edit_sentido" id="edit_sentido_volta" value="VOLTA" <?php if ($row['sentido'] == 'VOLTA') echo 'checked'; ?>>
                                            <label class="custom-control-label" for="edit_sentido_ida">VOLTA</label>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>


                            <fieldset class="form-group">
                                <div class="row">
                                    <legend class="col-form-label col-sm-2 pt-0">Motivo</legend>
                                    <div class="col-sm-10">
                                        <div class="form-check form-check custom-radio">
                                            <input class="custom-control-input" type="radio" name="edit_motivo" id="radio1" value="1" <?php if ($row['motivo'] == '1') echo 'checked'; ?>>
                                            <label class="custom-control-label" for="radio1">Lotação de plataforma</label>
                                        </div>

                                        <div class="form-check form-check custom-radio">
                                            <input class="custom-control-input" type="radio" name="edit_motivo" id="radio2" value="2" <?php if ($row['motivo'] == '2') echo 'checked'; ?>>
                                            <label class="custom-control-label" for="radio2">Lotação de veículo - trajeto</label>
                                        </div>

                                        <div class="form-check form-check custom-radio">
                                            <input class="custom-control-input" type="radio" name="edit_motivo" id="radio3" value="3" <?php if ($row['motivo'] == '3') echo 'checked'; ?>>
                                            <label class="custom-control-label" for="radio3">Outro</label>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="form-group">
                                <div class="row">
                                    <legend class="col-form-label col-sm-2 pt-0">Obs:</legend>
                                    <div class="col-sm-10">
                                        <div class="form-group">
                                            <textarea name="edit_obs" type="areatext" class="form-control" id="edit_obs" rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="form-group">
                                <div class="row">
                                    <legend class="col-form-label col-sm-2 pt-0">Solicitado por:</legend>
                                    <div class="col-sm-10">
                                        <div class="form-group">
                                            <select name="edit_solicitacao_users" type="text" class="form-control" id="edit_solicitacao_user">
                                                <option value="8270-8"> Ednei Domareski Corvalão </option>
                                                <option value="Tania "> Tania </option>
                                                <option value="Mauricio "> Mauricio </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            <button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-danger">Alterar</button>

                        </form>
                    </div>



                </div>
            </div>
        </div>
        <!-- Fim Modal -->




        <!-- MODAL Apagar Dados Extras-->
        <div id="MODALapagar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Apagar</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <strong>
                            <h5>
                                <p id="teid" class="text-muted"></p>
                            </h5>
                            <h6>
                                <p id="edata_operacao" class="text-muted"></p>
                                <p id="elinha" class="text-muted"></p>
                            </h6>
                        </strong>
                    </div>

                    <div class="modal-footer">
                        <form method="POST" action="extras_apagar.php" enctype="multipart/form-data">
                            <input name="eid" type="hidden" id="eid">
                            <input type="hidden" id="orderby" name="orderby" value="<?php echo $orderby ?>">
                            <input type="hidden" id="orderdir" name="orderdir" value="<?php echo $orderdir ?>">
                            <input type="hidden" id="numresultados" name="numresultados" value="<?php echo $numresultados ?>">
                            <input type="hidden" id="pagina" name="pagina" value="<?php echo $pagina ?>">
                            <input type="hidden" name="data" class="form-control" id="" value="<?php echo $data ?>" class="form-control btn-outline-primary" placeholder="<?php echo $data ?>">
                            <button type="button" class="btn btn-info" data-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-danger">Confirmar</button>
                        </form>
                    </div>
                    <div class="modal-footer">

                    </div>
                </div>

            </div>
        </div>



    <?php } ?>

    </tbody>
        </table>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <!-- fixador de quantidade de itens por página -->
                <nav class="text-center" aria-label="Paginador_quantidade">
                    <ul class="pagination justify-content-left">
                        <li class="page-item <?php if ($numresultados == 20) echo 'active';
                                                else echo ''; ?>">
                            <a class="page-link" href="main_extras.php?numresultados=20&orderby=<?php echo $orderby; ?>&pagina=<?php echo $pagina; ?>&orderby=<?php echo $orderby; ?>&data=<?php echo $data; ?>"> 10</a>
                        </li>
                        <li class="page-item <?php if ($numresultados == 50) echo 'active';
                                                else echo ''; ?>">
                            <a class="page-link" href="main_extras.php?numresultados=50&orderby=<?php echo $orderby; ?>&pagina=<?php echo $pagina; ?>&data=<?php echo $data; ?>">30</a>
                        </li>
                        <li class="page-item <?php if ($numresultados == 5000) echo 'active';
                                                else echo ''; ?>">
                            <a class="page-link" href="main_extras.php?numresultados=5000&orderby=<?php echo $orderby; ?>&pagina=<?php echo $pagina; ?>&data=<?php echo $data; ?>">Total: <?php echo $total_01; ?></a>
                        </li>
                    </ul>
                </nav>
            </div> <!-- paginador -->

            <div class="col-sm"></div> <!-- vazio central -->

            <div class="col-sm">
                <nav class="text-left" aria-label="Paginador_pagina">
                    <ul class="pagination justify-content-right">
                        <li class="page-item">
                            <a class="page-link" href="main_extras.php?pagina=1&numresultados=<?php echo $numresultados; ?>&orderby=<?php echo $orderby; ?>&data=<?php echo $data; ?>">Primeira</a>
                        </li>

                        <!-- paginador numerador-->
                        <?php
                        for ($i = $pagina - 2, $limiteDeLinks = $i + 4; $i <= $limiteDeLinks; $i++) {
                            if ($i < 1) {
                                $i = 1;
                                $limiteDeLinks = 5;
                            }
                            if ($limiteDeLinks > $quantidadeDeLinks) {
                                $limiteDeLinks = $quantidadeDeLinks;
                                $i = $limiteDeLinks - 4;
                            }
                            if ($i < 1) {
                                $i = 1;
                                $limiteDeLinks = $quantidadeDeLinks;
                            }

                            if ($i == $pagina) { ?>

                                <li class="page-item active">
                                    <a class="page-link" href="main_extras.php?pagina=<?php echo $i; ?>&numresultados=<?php echo $numresultados; ?>&orderby=<?php echo $orderby; ?>&data=<?php echo $data; ?>"><?php echo $i; ?></a>
                                </li>

                            <?php } else { ?>
                                <li class="page-item">
                                    <a class="page-link" href="main_extras.php?pagina=<?php echo $i; ?>&numresultados=<?php echo $numresultados; ?>&orderby=<?php echo $orderby; ?>&data=<?php echo $data; ?>"><?php echo $i; ?></a>
                                </li>
                        <?php  }
                        } ?>
                        <!-- paginador vai ao final-->

                        <li class="page-item ">
                            <a class="page-link" href="main_extras.php?pagina=<?php echo $quantidadeDeLinks; ?>&numresultados=<?php echo $numresultados; ?>&orderby=<?php echo $orderby; ?>&data=<?php echo $data; ?>">Última</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    </div>
    </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>



    <script type="text/javascript">
        //---- MODAL APAGAR

        $('#MODALapagar').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var recipientid = button.data('teid') // Extract info from data-* attributes
            var recipientnum = button.data('num') // Extract info from data-* attributes
            var recipientnome = button.data('nome') // Extract info from data-* attributes
            var recipientid_validador = button.data('id_validador') // Extract info from data-* attributes
            var recipientdata_operacao = button.data('data_operacao') // Extract info from data-* attributes
            var recipienthorario_operacao = button.data('horario_operacao') // Extract info from data-* attributes

            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            modal.find('#teid').text('Apagar registro ID :' + recipientid)
            modal.find('#edata_operacao').text(' Dia: ' + recipientdata_operacao + ' - Horário: ' + recipienthorario_operacao)
            modal.find('#elinha').text(' Linha: ' + recipientnum + '(' + recipientid_validador + ') | ' + recipientnome)
            modal.find('#eid').val(recipientid)
        })


        //---- MODAL EDITAR

        $('#MODALeditar').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var recipientid = button.data('id') // Extract info from data-* attributes
            var recipient_num = button.data('num') // Extract info from data-* attributes
            var recipient_nome = button.data('nome') // Extract info from data-* attributes
            var recipientid_validador = button.data('id_validador') // Extract info from data-* attributes
            var recipientdata_operacao = button.data('data_operacao') // Extract info from data-* attributes
            var recipienthorario_operacao = button.data('horario_operacao') // Extract info from data-* attributes
            var recipientid_veiculo = button.data('id_veiculo') // Extract info from data-* attributes
            var recipient_sentido = button.data('sentido') // Extract info from data-* attributes
            var recipient_motivo1 = button.data('motivo1') // Extract info from data-* attributes
            var recipient_solicitacao_user = button.data('solicitacao_user') // Extract info from data-* attributes
            var recipient_obs = button.data('obs') // Extract info from data-* attributes

            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            modal.find('.modal-title').text('Editar : ' + recipientid + ' | ' + recipient_num)
            modal.find('#edit_id').val(recipientid)
            modal.find('#edit_num').val(recipient_num + ' - ' + recipient_nome)
            modal.find('#edit_nome').val(recipient_nome)
            modal.find('#edit_id_validador').val(recipientid_validador)
            modal.find('#edit_data_operacao').val(recipientdata_operacao)
            modal.find('#edit_horario_operacao').val(recipienthorario_operacao)
            modal.find('#edit_id_veiculo').val(recipientid_veiculo)
            modal.find('#edit_sentido').val(recipient_sentido)
            modal.find('#edit_motivo1').val(recipient_motivo1)
            modal.find('#edit_solicitacao_user').val(recipient_solicitacao_user)
            modal.find('#edit_obs').val(recipient_obs)

        })
    </script>








</body>

</html>