<?php
session_start();
include_once 'conexao.php';


$query_03 = "SELECT inscricao, nome FROM lacustre.embarcacoes";
$resultado_03 = $conn->query($query_03);
$resultado_03_count = $resultado_03->rowCount();

$id = $_GET['id'];

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
    <script type="text/javascript" src="/js/jquery.min.js"></script>
    <!-- Adicionando JQuery consulta CEP-->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <!-- máscaras para input formularios !-->
    <script type="text/javascript" src="jquery.mask.min.js"></script>
    <script type="text/javascript" src="jquery-ui.min.js"></script>
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

            <?php
            $query_02 = "SELECT * FROM lacustre.viagens WHERE id ='$id' LIMIT 1";
            $resultado_02 = $conn->query($query_02);
            $total_02 = $resultado_02->rowCount();

            while ($row = $resultado_02->fetch()) {

                $horario_operacao = date('H:i', strtotime($row['horario_operacao']));
                //converte a data do banco para introduzir em formulario deve ser o formato Y-m-d
                $data_operacao = date('Y-m-d', strtotime($row['data_operacao']));

            ?>


                <!-- Formulário  !-->
                <form method="post" id="formuser" action="form01_editar_db.php?id=<?php echo $row['id'] ?>" enctype="multipart/form-data">
                    <h4 class="bg-primary  text-white"> Editar Cadastro de Viagens</h4>
                    <span id="msg-error"></span>
                    <div class="form-row">
                        <div class="form-group col-2">
                            <h5><strong><label class="text-muted">Ficha</label></strong></h5>
                            <input type="number" name="num_ficha" class="form-control" value="<?php echo $row['num_ficha'] ?>" id="num_ficha" min="0" max="10000">
                        </div>

                        <div class="form-group col-3">
                            <h5><strong><label class="text-muted"> Data da Viagem</label></strong></h5>
                            <input name="data" type="date" value="<?php echo $data_operacao; ?>"" id=" data" class="form-control" />
                        </div>
                        <div class="form-group col-3">
                            <h5><strong><label class="text-muted"> Horario da Viagem</label></strong></h5>
                            <input name="horario" type="time" value="<?php echo $horario_operacao; ?>" id="horario" class="form-control" />
                        </div>
                        <div class="col col-md-4">
                            <div class="form-group">
                                <h5><strong><label class="text-muted" for="id_embarcacao">Embarcacao</label> </strong></h5>
                                <select class="form-control" name="id_embarcacao" id="id_embarcacao">

                                    <?php while ($row3 = $resultado_03->fetch()) { ?>
                                        <option <?php
                                                if ($row['id_embarcacao'] == $row3['inscricao']) {
                                                    echo "selected";
                                                } ?> value="<?php echo $row3['inscricao'] ?>"><?php echo $row3['inscricao'] ?> - <?php echo $row3['nome'] ?> </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    
                    <div class="form-row">
                        <div class="col col-md-3">
                            <div class="custom-control custom-radio">
                                <h5><strong><label class="text-muted">Modalidade</label></strong></h5>
                                <div class="col">
                                    <input class="custom-control-input" type="radio" name="modalidade" id="radio1" value="REGULAR" <?php if ($row['modalidade'] == "REGULAR") {
                                                                                                                                        echo "checked";
                                                                                                                                    } ?>>
                                    <label class="custom-control-label" for="radio1">Regular</label>
                                </div>
                                <br>
                                <div class="col">
                                    <input class="custom-control-input" type="radio" name="modalidade" id="radio2" value="EXTRA" <?php if ($row['modalidade'] == "EXTRA") {
                                                                                                                                        echo "checked";
                                                                                                                                    } ?>>
                                    <label class="custom-control-label" for="radio2">Extra</label>
                                </div>
                                <br>
                                <div class="col">
                                    <input class="custom-control-input" type="radio" name="modalidade" id="radio3" value="REPOSICIONAMENTO" <?php if ($row['modalidade'] == "REPOSICIONAMENTO") {
                                                                                                                                                echo "checked";
                                                                                                                                            } ?>>
                                    <label class="custom-control-label" for="radio3">Reposicionamento</label>
                                </div>
                            </div>
                        </div>

                        <div class="col col-md-6">
                            <div class="custom-control custom-radio">
                                <h5><strong><label class="text-muted">Sentido</label></strong></h5>
                                <div class="col">
                                    <input class="custom-control-input" type="radio" name="sentido" id="radio4" value="IDA" <?php if ($row['sentido'] == "IDA") {
                                                                                                                                echo "checked";
                                                                                                                            } ?>>
                                    <label class="custom-control-label" for="radio4">IDA: Costa -> Lagoa</label>
                                </div>
                                <br>
                                <div class="col">
                                    <input class="custom-control-input" type="radio" name="sentido" id="radio5" value="VOLTA" <?php if ($row['sentido'] == "VOLTA") {
                                                                                                                                    echo "checked";
                                                                                                                                } ?>>
                                    <label class="custom-control-label" for="radio5">VOLTA: Lagoa -> Costa</label>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="form-row">
                    
            
                    <div class="col col-md-12">
                    <br>

                    <h5><strong><label class="text-muted">Justificativa</label></strong></h5>
                        <textarea class="form-control" name="justificativa" id="justificativa" size="60" rows="5" value="" <?php echo $row['justificativa'] ?>></textarea>
                    </div>
                    </div>


                    <div class="form-row">

                    <div class="col col-md-12">
<br>
                    <input class="custom-control-input" type="text" name="confirmarfoco" id="confirmarfoco" value="VOLTA"></input><button type="submit" value="Cadastrar" class="btn btn-success">Confirmar a edição</button>
                    <br>

                    </div>

                    </div>

                    </form>

                    <br>

        </div>
        <br>

    <?php } ?>
    <br>
    <div class="p-3 mb-2 bg-primary text-white">
        <h5> Prefeitura Municipal de Florianópolis</h5>
        <h6>Secretaria de Mobilidade e Planejamento Urbano </h6>
        Rua Felipe Schmidt, n° 1320 – Centro - CEP 88.010-002 – Florianópolis/SC.<br>
    </div>
    </div>
    <br>

    <script>
      


        function validar() {
            var data = formuser.data.value;
            var horario = formuser.horario.value;
            var arquivo = formuser.arquivo.value;
            var modalidade = formuser.modalidade.value;
            var sentido = formuser.sentido.value;
            var id_embarcacao = formuser.id_embarcacao.value;
            var num_ficha = formuser.num_ficha.value;


            if (data == "") {
                $("#msg-error").html('<div class="alert alert-danger" role="alert">Indicar a <b>Data da viagem!</b></div>');
                formuser.data.focus();
                return false;
            }

            if (horario == "") {
                $("#msg-error").html('<div class="alert alert-danger" role="alert">Indicar o <b>Horário!</b></div>');
                formuser.horario.focus();
                return false;
            }


            if (num_ficha == "") {
                $("#msg-error2").html('<div class="alert alert-danger" role="alert">Obrigatório indicar o<b>número da ficha de viagem</b></div>');
                formuser.num_ficha.focus();
                return false;
            }


        };
    </script>
</body>

</html>