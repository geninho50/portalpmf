<!--**
 	*  SMPU - Upload de cadastros qr-code
	*  cortesia: Michel Mittmann
 	*  lembre -se de conceder os créditos ao desenvolvedor.
 *-->
<?php
include_once("conexao.php");
require_once('/home/www/sistemas/mobilidade/login/session_status.php');
header('Content-type: text/html; charset=UTF-8');
setlocale(LC_ALL, 'pt_BR.UTF8');

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
    <script src="/bas/js/sorttable.js"></script>
    <script type="text/javascript" src="/bas/js/jquery.quick.search.js"></script>
    <script type="text/javascript" src="/home/www/sistemas/mobilidade/bas/js/jquery.js"></script>
    <script type="text/javascript" src="/home/www/sistemas/mobilidade/bas/js/jquery.maskedinput-1.1.4.pack.js"></script>
    <script src="/bas/js/validaCPF.js"></script>
    <script src="/bas/js/validaCNPJ.js"></script>
    <script src="/bas/js/cep.js"></script> <!-- análise de CEP !-->
    <script src="/bas/js/masks.js"></script> <!-- máscaras para input formularios !-->
    <script type="text/javascript" src="/bas/js/jquery.mask.min.js"></script>
    <script type="text/javascript" src="/bas/js/jquery-ui.min.js"></script>
    <script src="https://compressjs.herokuapp.com/compress.js"></script>

    <script>
        $(document).ready(function() {
            $("#smpu_topo").load("/bas/smpu_topo.php");
            $("#smpu_rodape").load("/bas/smpu_rodape.php");
        });
    </script>


    <style>
        .pequeno {
            width: 30px;
        }

        .medio {
            width: 50%;
        }
    </style>

</head>

<body>

    <!--CABECALHO -->
    <div class="container" theme-showcase" role="main">

        <!-- TOPO -->
        <div id="smpu_topo"></div>
        <!-- TOPO -->

        <div class="container" role="main">

            <!-- Fim imagem cabeçalho -->
            <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
                <div class="btn-group mr-2" role="group" aria-label="1 group">
                    <div class="botton-group row">
                        <div class="button-group mr-2">


                            <a class="btn btn-success btn-sm" href="/sim/motofrete/profissionais/mtv.php" role="button">Profissionais</a>
                            <a class="btn btn-success btn-sm" href="/sim/motofrete/empresas/mtv.php" role="button">Empresas</a>
                            <a class="btn btn-success btn-sm" href="/sim/motofrete/veiculos/mtv.php" role="button">Veiculos</a>


                        </div>

                    </div>
                    <br>

                </div>
                <div class="btn-group mr-2" role="group" aria-label="3">

                </div>
            </div>
            <br>
        </div>
    </div>
    <!--FIM CABECALHO -->

    <?php

    $query_02 = "SELECT * FROM sim.motofrete_veiculos ORDER BY id DESC";
    $resultado_02 = $conn->query($query_02);
    $resultado_02_count = $resultado_02->rowCount();

    if (($resultado_02_count != 0)) { ?>

        <div class="container" theme-showcase" role="main">
            <div class="p-2 mb-2 bg-primary text-white">
                <div class="row">
                    <div class="col">
                        <b>Veículos: <?php echo $resultado_02_count ?></b>
                    </div>

                    <div class="col col-md-auto">
                        <button type="button" class="btn btn-outline-light btn-sm" data-toggle="modal" onClick="limpa()" data-target="#MODALuser_cadastrar">
                            Cadastrar Veículo
                        </button>
                        <input type="text" class="input-search btn btn-light btn-sm" alt="lista-clientes" placeholder="Buscar nesta lista" />

                    </div>
                </div>
            </div>

            <table id="dtBasicExample" class="sortable lista-clientes table table-striped table-hover table-sm" cellspacing="0" width="100%">

                <tr class="table-primary">
                    <td><b><a class="text-default">Cadastro</a></b></td>
                    <td><b><a class="text-default">Placa</a></b></td>
                    <td><b><a class="text-default">RENAVAM</a></b></td>
                    <td><b><a class="text-default">Chassi</a></b></td>
                    <td><b><a class="text-default">Proprietário</a></td>
                    <td><b><a class="text-default">Veículo</a></td>
                    <td><b><a class="text-default">Status</a></td>

                    <td><b><a class="text-default">Ação</a></b></td>
                </tr>
                <?php while ($row = $resultado_02->fetch()) {

                    $data_abertura = date('d-m-Y', strtotime($row['data_abertura']));
                    $data_criado = date('d-m-Y', strtotime($row['data_criado']));
                    $cnpj_view1 = substr($row['cnpj'], -14, 2);
                    $cnpj_view2 = substr($row['cnpj'], -12, 3);
                    $cnpj_view3 = substr($row['cnpj'], -9, 3);
                    $cnpj_view4 = substr($row['cnpj'], -6, 4);
                    $cnpj_view5 = substr($row['cnpj'], -2);
                    $cnpj =  $cnpj_view1 . "." . $cnpj_view2 . "." . $cnpj_view3 . "/" . $cnpj_view4 . "-" . $cnpj_view5;;

                ?>
                    <tr>
                        <td width=10%><?php echo $row['id']; ?></td>
                        <td width=6%><?php echo $row['veiculo_placa']; ?></td>
                        <td width=10%><?php echo $row['veiculo_renavam']; ?></td>
                        <td width=10%><?php echo $row['chassi']; ?></td>
                        <td width=20%><?php echo $row['proprietario']; ?></td>
                        <td width=10%><?php echo $row['veiculo_tipo']; ?></td>
         
                        <!-- <td width=20%> ?php echo $cnpj; ?</td> -->

                        <td width=10%>
                            <?php
                            if ($row['status'] == '1') {
                                $status = "autorizar";
                            ?>
                                <a class="btn btn-danger btn-sm" href="mtv_ficha.php?id_cadastro=<?php echo $row['id_cadastro'] ?>" role="button"><?php echo $status ?></a>
                            <?php } elseif ($row['status'] == '2') {
                                $status = "registrado";
                            ?>
                                <a class="btn btn-success btn-sm" href="mtv_ficha.php?id_cadastro=<?php echo $row['id_cadastro'] ?>" role="button"><?php echo $status ?></a>

                            <?php  } elseif ($row['status'] == '22') {
                                $status = "Indeferido";
                            ?>
                                <a class="btn btn-secondary btn-sm" href="mtv_ficha.php?id_cadastro=<?php echo $row['id_cadastro'] ?>" role="button"><?php echo $status ?></a>

                            <?php  } else { ?>
                                <a class="btn btn-success btn-sm" href="" role="button">registrado</a>
                            <?php } ?>

                        </td>
                        <td width=10%>
                            <!--<a type="button" class="btn btn-outline-danger btn-sm fa fa-print pequeno" href="print_conferir.php?id_cadastro=<?php echo $row['id_cadastro'] ?>" role="button"></a> !-->
                            <a type="button" class="btn btn-outline-info btn-sm fa fa-info pequeno" href="mtv_ficha.php?id_cadastro=<?php echo $row['id_cadastro'] ?>" role="button"></a>
                            <a type="button" class="btn btn-outline-warning btn-sm fa fa-pencil-square-o pequeno" href="mtv_editar.php?id_cadastro=<?php echo $row['id_cadastro'] ?>" role="button"></a>
                            <button type="button" class="btn btn-outline-danger btn-sm fa fa-trash pequeno" data-toggle="modal" data-target="#MODALuser_apagar" data-var_id_cadastro="<?php echo $row['id_cadastro']; ?>" data-var_razao_social="<?php echo $row['razao_social']; ?>"></button>
                        </td>
                    </tr>

                <?php } ?>

                <!-- MODAL Apagar  Usuários-->
                <div id="MODALuser_apagar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4>Apagar</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <strong>
                                    <h5>
                                        <p id="showidcadastro" class="text-muted"></p>
                                    </h5>
                                    <h6>
                                        <p id="showrazao_social" class="text-muted"></p>
                                        <p id="showcategoria" class="text-muted"></p>
                                    </h6>
                                </strong>
                            </div>
                            <div class="modal-footer">
                                <form method="POST" action="cadastro_apagar.php" enctype="multipart/form-data">
                                    <input name="id_cadastro_apagar" type="hidden" class="form-control" id="id_cadastro_apagar">
                                    <button type="button" class="btn btn-info" data-dismiss="modal">Fechar</button>
                                    <button type="submit" class="btn btn-danger">Confirmar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- FIM MODAL Apagar Dados Usuários-->


            </table>
        <?php
    } else {
        echo "<div class='alert alert-danger' role='alert'>Nenhunha empresa encontrada!</div></div>";
    }


    include_once("mtv_formulario.php");

        ?>

        <!-- RODAPE -->
        <div id="smpu_rodape"></div>
        <!-- RODAPE -->



        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
        <script src="mtv_formulario.js"></script>
        <script src="data_confirm.js"></script>
        <script type="text/javascript">
            $('#MODALuser_apagar').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                //extrai atributos data-
                var recipientidcadastro = button.data('var_id_cadastro')
                var recipientrazao_social = button.data('var_razao_social')
                var modal = $(this)
                //variaveis
                modal.find('#id_cadastro_apagar').val(recipientidcadastro)
                //textos
                modal.find('#showrazao_social').text('razao_social : ' + recipientrazao_social)
                modal.find('#showidcadastro').text('Apagar registro ID : ' + recipientidcadastro)
            })
        </script>


</body>

</html>