<?php

include_once("./src/database/selectViagem.php");

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
                            <div class="col-sm-8">
                                <h2>Lista de <b>Viagens</b></h2>
                            </div>
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
                                <th>Nome <i class="fa fa-sort"></i></th>
                                <th>E-mail</th>
                                <th>Páis</th>
                                <th>Data chegada<i class="fa fa-sort"></i></th>
                                <th>Data saída<i class="fa fa-sort"></i></th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($conn->query($sql) as $row) { 
                                $contratantes = $row['contratantes'];
                                $array_contratantes = json_decode($contratantes, true);
                                $data_cadastro = date('d-m-Y', strtotime($row['data_cadastro']));
                                $data_chegada = date('d-m-Y', strtotime($row['data_chegada']));

                                //$data_chegada = date('d-m-Y', strtotime($row['data_chegada']));
                                $data_saida = date('d-m-Y', strtotime($row['data_saida']));
                                ?>
                                <tr>
                                    <td width="3%"><?php echo $row['id_viagem']; ?></td>
                                    <td width="27%"><?php echo $array_contratantes['contratantes_nome']; ?></td>
                                    <td width="15%"><?php echo $array_contratantes['contratantes_email'] ?></td>
                                    <td width="10%"><?php echo $array_contratantes['contratantes_pais']; ?></td>
                                    <td width="15%"><?php echo $data_chegada; ?></td>
                                    <td width="15%"><?php echo $data_saida; ?></td>
                                    <td width="15%">
                                        <!-- ./ficha.php?id_viagem=" . $id_viagem . "' -->
                                        <a href="./ficha.php?id_viagem=<?php echo $row['id_viagem']; ?>" class="view" title="View" data-toggle="tooltip"><i class="material-icons">&#xE417;</i></a>
                                        <a href="./imprimir.php?id_viagem=<?php echo $row['id_viagem']; ?>" class="" title="View" data-toggle="tooltip"><i class="material-icons">print</i></a>
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