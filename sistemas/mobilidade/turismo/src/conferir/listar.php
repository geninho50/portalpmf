<?php
session_start();
include_once './src/conexao.php';
$sql = "SELECT * FROM turismo.viagens ORDER BY id_viagem DESC";
    $query_result = $conn->prepare($sql);
    $query_result->execute();
    $table_fields = $query_result->fetchAll(PDO::FETCH_COLUMN);
    $count = $query_result->rowCount();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Área de gestão</title>
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="./public/styles/management_area.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="./public/scripts/management_area.js"></script>
</head>
<body>
<?php
if (($count != 0)) {  
?>
    <div class="container">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-8"><h2>Lista de <b>Viagens</b></h2></div>
                        <div class="col-sm-4">
                            <div class="search-box">
                                <i class="material-icons">&#xE8B6;</i>
                                <input type="text" class="form-control" placeholder="Pesquisar&hellip;">
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nome<br>Documento</th>
                            <th>E-mail<br>Telefone</th>
                            <th>País<br>Data Chegada<br>Data Retorno</th>
                            <th>Veiculo</th>
                            <th>Data saída</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            foreach ($conn->query($sql) as $row_usuario) {?> 
                            <tr>
                                <td width="8%"><?php echo $row_usuario['id_viagem']; ?><br><?php echo $row_usuario['cod_registro']; ?><br><?php echo $row_usuario['chave_acesso']; ?></td>
                                <td width="auto"><?php echo $row_usuario['contratantes_nome']; ?><br>  <?php echo $row_usuario['contratantes_documento']; ?></td>
                                <td width="15%">
                                <?php echo $row_usuario['contratantes_email']; ?>
                                <br>
                                <?php echo $row_usuario['contratantes_telefone_com_ddd']; ?>
                            </td>
                                <td width="10%"><?php echo $row_usuario['contratantes_pais']; ?><br> <?php echo $row_usuario['data_chegada']; ?> <br> <?php echo $row_usuario['data_saida']; ?></td>
                                <td width="15%"><?php echo $row_usuario['modelo']; ?><br><?php echo $row_usuario['placa']; ?><br><?php echo $row_usuario['tipo']; ?></td>
                                <td width="15%"></td>
                                <td width="15%">
                                <!-- ./ficha.php?id_viagem=" . $id_viagem . "' -->

                                <a href="imprimir.php?cod_registro=<?php echo $row_usuario['cod_registro'];?>" class="view" title="View" data-toggle="tooltip">Imprimir Ficha</a>
                                <a href="ficha.php?cod_registro=<?php echo $row_usuario['cod_registro'];?>" class="view" title="View" data-toggle="tooltip"><i class="material-icons" >&#xE417;</i></a>
                                <a href="#" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                                <a href="#" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                            </td>
                            </tr>
                        <?php } ?>        
                    </tbody>
                </table>
                <!-- <div class="clearfix">
                    <div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>
                    <ul class="pagination">
                        <li class="page-item disabled"><a href="#"><i class="fa fa-angle-double-left"></i></a></li>
                        <li class="page-item"><a href="#" class="page-link">1</a></li>
                        <li class="page-item"><a href="#" class="page-link">2</a></li>
                        <li class="page-item active"><a href="#" class="page-link">3</a></li>
                        <li class="page-item"><a href="#" class="page-link">4</a></li>
                        <li class="page-item"><a href="#" class="page-link">5</a></li>
                        <li class="page-item"><a href="#" class="page-link"><i class="fa fa-angle-double-right"></i></a></li>
                    </ul>
                </div> -->
            </div>
        </div>        
    </div> 
    <?php
    } else {
        echo "<div class='alert alert-danger' role='alert'>Nenhuma viagem cadastrada!</div>";
    }
?>    
</body>
</html>