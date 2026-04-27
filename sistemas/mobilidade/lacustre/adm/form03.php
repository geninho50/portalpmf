<?php
session_start();
include_once 'conexao.php';

$id_viagem = $_GET['id_viagem'];
$id = $_GET['id'];
$pontos = 23;

?>
<!DOCTYPE HTML>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="remob.css">  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/jquery.min.js"></script>
    <!-- Adicionando JQuery consulta CEP-->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <!-- máscaras para input formularios !-->
    <script type="text/javascript" src="jquery.mask.min.js"></script>
    <script type="text/javascript" src="jquery-ui.min.js"></script>

</script>
</head>

<body>
    <div class="container" role="main">
        <!--CABECALHO -->
        <div class="page-header rounded">
            <img src="http://redemobilidade.pmf.sc.gov.br\bas\img\cabecalho_02.jpg" class="img-fluid rounded" alt="Imagem responsiva">
        </div>
        <br>
        <div class="container border rounded border-primary" role="main">
            <br>
            <div align=center>
                <a href="http://redemobilidade.pmf.sc.gov.br" class="btn btn-warning" align=center>Fechar | Voltar Rede de Mobilidade</a>
            </div>
            <br>
            <!-- Formulário  !-->
            <form method="post" id="formuser" action="envia03.php?&id=<?php echo $id ?>&pontos=<?php echo $pontos?>" enctype="multipart/form-data">
                <h4 class="bg-primary  text-white">Embarques e Desembarques</h4>
                <span id="msg-error"></span>
                <br>
                <div class="form-row">
                    <div class="form-group col-1"></div>
                    <div class="form-group col-5">
                        <label class="text-muted"> embarque</label>
                    </div>
                    <div class="form-group col-5">
                        <label class="text-muted"> desembarque</label>
                    </div>
                </div>
                <?php
               
                $i = 1;
                for ($i = 1; $i <= $pontos; $i++) {
                ?>
                    <div class="form-row">
                        <div class="form-group col-1">
                            <h5><strong><label class="text-muted"><?php echo $i ?></label></strong></h5>
                        </div>
                        <div class="form-group col-5">
                            <input type="number" name="<?php echo $i ?>e" class="form-control bg-form01 text-dark" id="<?php echo $i ?>e" min="0" max="100" required value="0">
                        </div>
                        <div class="form-group col-5">
                            <input type="number" name="<?php echo $i ?>d" class="form-control bg-form02 text-dark" id="<?php echo $i ?>d" min="0" max="100" required value="0" >
                        </div>
                    </div>
                <?php
                }
                ?>
                <button class="btn btn-success btn-lg btn-block">Registrar Embarque e Desembarque </button>
                <a href="form03.php&id=<?php echo $id ?>&pontos=<?php echo $pontos?>" class="btn btn-warning btn-lg btn-block" align=center>Limpar</a>
                <br><br>
        </div>
        <br>
        </form>
        <br>
        <div class="p-3 mb-2 bg-primary text-white">
            <h5> Prefeitura Municipal de Florianópolis</h5>
            <h6>Secretaria de Mobilidade e Planejamento Urbano </h6>
            Rua Felipe Schmidt, n° 1320 – Centro - CEP 88.010-002 – Florianópolis/SC.<br>
        </div>
    </div>
    <br>
    <script>
        //limpar formulario
        $(document).ready(function() {
            for (var i = 1; i <= 23; i++) {
                $("input#"+ i + "e").val("0");
                $("input#"+ i + "d").val("0");
            }
        });
 
    </script>
</body>

</html>