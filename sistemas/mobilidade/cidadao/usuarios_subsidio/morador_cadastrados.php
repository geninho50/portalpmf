<!--**
 	*  SMPU - Upload de cadastros qr-code
	*  cortesia: Michel Mittmann
 	*  lembre -se de conceder os créditos ao desenvolvedor.
 *-->
<?php
include_once("conexao.php");
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
    <script type="text/javascript" src="javascriptpersonalizado.js"></script>
    <script type="text/javascript" src="javascript_frota.js"></script>
    <script src="sorttable.js"></script>
    <script type="text/javascript" src="jquery.quick.search.js"></script>
    <script type="text/javascript" src="/js/jquery.js"></script>

    <script type="text/javascript" src="jquery.maskedinput-1.1.4.pack.js"></script>
    <script src="formrules.js"></script>
    <script src="cep.js"></script> <!-- análise de CEP !-->
    <script src="masks.js"></script> <!-- máscaras para input formularios !-->


    <script type="text/javascript" src="jquery.mask.min.js"></script>
    <script type="text/javascript" src="jquery-ui.min.js"></script>
    <script src="https://compressjs.herokuapp.com/compress.js"></script>

</head>

<body>

    <!--CABECALHO -->
    <div class="container" theme-showcase" role="main">
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
                            <div class="button-group mr-2 ">
                                <input type="text" class="input-search btn btn-outline-secondary" alt="lista-clientes" placeholder="Buscar nesta lista" />
                            </div>
                        </div>
                    </form>
                </div>
                <div class="btn-group mr-2" role="group" aria-label="3">

                </div>
            </div>
            <br>
        </div>
    </div>
    <!--FIM CABECALHO -->

    <?php

    $query_02 = "SELECT * FROM sim.moradores_costa ORDER BY id DESC";
    $resultado_02 = $conn->query($query_02);
    $resultado_02_count = $resultado_02->rowCount();

    if (($resultado_02_count != 0)) { ?>

        <div class="container" theme-showcase" role="main">

            <table id="dtBasicExample" class="sortable lista-clientes table table-striped table-hover table-sm" cellspacing="0" width="100%">
                <tr class="table-primary">
                    <td><b><a class="text-default">Registro</a></b></td>
                    <td><b><a class="text-default">Nome</a></b></td>
                    <td><b><a class="text-default">CPF</a></b></td>
                    <td><b><a class="text-default">Categoria</a></b></td>
                    <td><b><a class="text-default">validade</a></b></td>
                    <td><b><a class="text-default">Status</a></td>
                </tr>
                <?php while ($row = $resultado_02->fetch()) {

                    $data_nascimento = date('d-m-Y', strtotime($row['data_nascimento']));
                    $data_validade = date('d-m-Y', strtotime($row['data_validade']));
                    $data_criado = date('d-m-Y', strtotime($row['data_criado']));
                    $cpf_view1 = substr($row['cpf'], -11,3);
                    $cpf_view2 = substr($row['cpf'], -8,3);
                    $cpf_view3 = substr($row['cpf'], -5,3);
                    $cpf_view4 = substr($row['cpf'], -2);
                    $cpf =  $cpf_view1.".". $cpf_view2.".".$cpf_view3."-". $cpf_view4;

                ?>
                    <tr>
                        <td width=10%><?php echo $row['id_cadastro']; ?></td>
                        <td width=30%><?php echo $row['nome_passageiro']; ?></td>
                        <td width=20%><?php echo $cpf ?></td>
                        <td width=15%><?php echo $row['categoria']; ?></td>

                        <td width=10% color="danger"><?php echo $data_validade; ?></td>
                        <td width=15%>
                            <?php
                            if ($row['status'] == '1') {
                                $status = "autorizar";
                            ?>
                                <a class="btn btn-danger btn-sm role="button"><?php echo $status ?></a>
                            <?php } elseif ($row['status'] == '2') {

                                $status = "registrado";
                            ?>
                                                                                            <a class="btn btn-danger btn-sm role="button"><?php echo $status ?></a>


                            <?php  } else { ?>
                                <a class="btn btn-success btn-sm" href="" role="button">registrado</a>
                            <?php } ?>

                        </td>
                   
                    </tr>

                <?php } ?>

               

            </table>
        <?php
    } else {
        echo "<div class='alert alert-danger' role='alert'>Nenhum usuário encontrado!</div>";
    }
        ?>

    



        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
        <script src="data_confirm.js"></script>


     



        <script>
            document.getElementById("categoria").addEventListener("change", form_type);

            function form_type() {
                var x = document.getElementById("categoria").value;

                document.getElementById("upload_gestante").style.display = "none";
                document.getElementById("upload_estudante").style.display = "none";

                if (x == "") {
                    document.getElementById("div_form").style.display = "none";
                }

                if (x == "Morador") {
                    document.getElementById("div_form").style.display = "block";
                }

                if (x == "Estudante") {
                    document.getElementById("div_form").style.display = "block";
                    document.getElementById("upload_estudante").style.display = "block";
                }

                if (x == "PCD") {
                    document.getElementById("div_form").style.display = "block";
                }

                if (x == "PCD com acompanhante") {
                    document.getElementById("div_form").style.display = "block";

                }

                if (x == "Gestante") {
                    document.getElementById("div_form").style.display = "block";
                    document.getElementById("upload_gestante").style.display = "block";
                }

                if (x == "Idoso") {
                    document.getElementById("div_form").style.display = "block";
                }

                if (x == "Acompanhante Aluno Infantil") {
                    document.getElementById("div_form").style.display = "block";
                    document.getElementById("upload_estudante").style.display = "block";
                }


            }
        </script>

   

      
     
        </script>
</body>

</html>