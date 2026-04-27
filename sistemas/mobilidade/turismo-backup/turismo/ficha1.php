<?php
session_start();

include_once("./src/database/conexao.php");
$id_viagem = $_GET['id_viagem']; //recebe da pagina anterior o numero do cadastro 
echo $id_viagem;
$query_02 = "SELECT * FROM turismo.viagens WHERE where id_viagem  = '$id_viagem'";
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

    <script>
        $(document).ready(function() {
            $("#smpu_topo").load("/bas/smpu_topo.php");
            $("#smpu_rodape").load("/bas/smpu_rodape.php");
        });
    </script>
</head>

<body>
    <div class="container theme-showcase" role="main">
        <!-- TOPO -->
        <div id="smpu_topo"></div>
        <!-- TOPO -->




        <div class="container" role="main">
            <h4 class="text-muted" align=center>Requerimento de Cadastramento</h4>

            <?php
            if (($resultado_02_count != 0)) {
                while ($row = $resultado_02->fetch()) {

                    $data_cadastro = date('d-m-Y', strtotime($row['data_cadastro']));
                
            ?>
                    <br>
                    <div class="container border rounded border-primary" role="main">
                        <h3 class="text-uppercase font-weight-bold">

                            <?php
                            echo $row['id_viagem']; ?><br>
                        </h3>
                        <h5>
                           <b class="text-muted">Data de Cadastro: </b><?php echo $data_cadastro; ?><br>
                      
                        </h5><br>
                                         

                            <form method="get" id="formuser" autocomplete="off" action="mtp_autorizar_cadastro.php?">
                                <input name="id_cadastro" type="hidden" value="<?php echo $row['id_viagem'] ?>">

                                <div class="btn-toolbar mb-3" role="toolbar" aria-label="Toolbar with button groups">
                                    <div class="input-group" style="margin-right: 20px">
                                        <div class="input-group-prepend">
                                        <input name="id_cadastro" type="hidden" value="<?php echo $row['id_cadastro'] ?>">
                                        <button type="submit" value="Imprimir Ficha" class="btn btn-success">Imprimir Ficha</button>

                                        </div>
                                        
                                    </div>
                                </div>

                               </form>

      
                    </div>

                    <br>
                <?php } ?>


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
                                <form method="get" id="formuser" autocomplete="off" action="mtp_print_conferir.php">
                          
                            <div class="modal-footer">
                                <button type="button" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
                <!-- MODAL IMPRIMIR FICHA-->


                <div align=center><a href="mtp.php" class="btn btn-warning" align=center>Fechar | Voltar</a></div>
            <?php
                } 
            } else {
                echo "<div class='alert alert-danger' role='alert'>Não foi possível efetivar o cadastro!</div>";
            } ?>
        </div>

        <!-- RODAPE-->
        <div id="smpu_rodape"></div><!-- RODAPE-->

    </div>
    </div>
    </div>



</body>

</html>