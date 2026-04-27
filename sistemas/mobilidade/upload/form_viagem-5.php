<?php
session_start();
include_once 'conexao.php';


$query_03 = "SELECT inscricao, nome FROM lacustre.embarcacoes";
$resultado_03 = $conn->query($query_03);
$resultado_03_count = $resultado_03->rowCount();


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

            <!-- Formulário  !-->
            <form method="post" id="formuser" action="envia.php" enctype="multipart/form-data">
                <h4 class="bg-primary  text-white"> Cadastro de Viagens</h4>
                <span id="msg-error"></span>
                <div class="form-row">
                    <div class="form-group col-12">
                        <h5><strong><label class="text-muted"> Data da Viagem</label></strong></h5>
                        <input name="data" type="date" id="data" class="form-control" />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-12">
                        <h5><strong><label class="text-muted"> Horario da Viagem</label></strong></h5>
                        <input name="horario" type="time" id="horario" class="form-control" />
                    </div>
                </div>
                <div class="form-row">
                    <div class="col col-md-12">
                        <div class="form-group">
                            <h5><strong><label class="text-muted" for="id_embarcacao">Embarcacao</label> </strong></h5>
                            <select class="form-control" name="id_embarcacao"  id="id_embarcacao">
                                <?php while ($row3 = $resultado_03->fetch()) { ?>
                                    <option value="<?php echo $row3['inscricao'] ?>"><?php echo $row3['inscricao'] ?> - <?php echo $row3['nome'] ?> </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col col-md-12">
                        <div class="custom-control custom-radio">
                            <h5><strong><label class="text-muted">Modalidade</label></strong></h5>
                            <div class="col">
                                <input class="custom-control-input" type="radio" name="modalidade" id="radio1" value="REGULAR" checked>
                                <label class="custom-control-label" for="radio1">Regular</label>
                            </div>
                            <br>
                            <div class="col">
                                <input class="custom-control-input" type="radio" name="modalidade" id="radio2" value="EXTRA">
                                <label class="custom-control-label" for="radio2">Extra</label>
                            </div>
                            <br>
                            <div class="col">
                                <input class="custom-control-input" type="radio" name="modalidade" id="radio3" value="REPOSICIONAMENTO">
                                <label class="custom-control-label" for="radio3">Reposicionamento</label>
                            </div>
                        </div>
                    </div>
                </div>
                <br>

                <div class="form-row">

                    <div class="col col-md-12">
                        <div class="custom-control custom-radio">
                            <h5><strong><label class="text-muted">Sentido</label></strong></h5>
                            <div class="col">
                                <input class="custom-control-input" type="radio" name="sentido" id="radio4" value="IDA" checked>
                                <label class="custom-control-label" for="radio4">IDA: Costa -> Lagoa</label>
                            </div>
                            <br>
                            <div class="col">
                                <input class="custom-control-input" type="radio" name="sentido" id="radio5" value="VOLTA" checked>
                                <label class="custom-control-label" for="radio5">VOLTA: Lagoa -> Costa</label>
                            </div>
                        </div>
                    </div>
                </div>
                <br>

                <span id="msg-error2"></span>

                <div class="form-row">
                    <div class="col-sm-12">
                        <h5><strong><label class="text-muted"> Envio de arquivo - Ficha de Viagem</label></strong></h5>
                        <div class="custom-file">
                            <input type="file" name="arquivo" class="custom-file-input" id="file" onchange="previewImagem()" />
                            <label class="custom-file-label" for="file">Escolha o arquivo</label>
                        </div>
                    </div>
                </div>
                <br>

                <div class="form-row">
                    <div class="col-sm-12">      
                    <h5><strong><label class="text-muted"> Numero da Ficha de Viagem</label></strong></h5>
                    <input type="number" name="num_ficha" class="form-control" id="num_ficha" min="0" max="10000">
                    </div>
                </div>
                <br>

                <button class="btn btn-success btn-lg btn-block" onclick="return validar()">Verificar</button>
                <a href="form_viagem-4.php" class="btn btn-warning btn-lg btn-block" align=center>Limpar</a>
                <br>
                <div class="col-sm-12">
                    <img id="preview" style="width: 100%"><br><br>
                </div>
                <br><br>
                <span id="confirm"></span><br>


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
            $("input#horario").val("");
            $("input#data").val("");
            $("input#file").val("");
            $("input#num_ficha").val("");

        });
        //preview imagem
        function previewImagem() {
            var imagem = document.querySelector('input[name=arquivo]').files[0];
            var preview = document.querySelector('img[id=preview]');
            var reader = new FileReader();
            reader.onloadend = function() {
                preview.src = reader.result;
            }
            if (imagem) {
                reader.readAsDataURL(imagem);
            } else {
                preview.src = "";
            }
        }

 
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });

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

            if (arquivo == "") {
                $("#msg-error2").html('<div class="alert alert-danger" role="alert">Obrigatório carregar a <b>ficha de viagem</b></div>');
                formuser.arquivo.focus();
                return false;
            }
            validararquivo();

            if (num_ficha == "") {
                $("#msg-error2").html('<div class="alert alert-danger" role="alert">Obrigatório indicar o<b>número da ficha de viagem</b></div>');
                formuser.num_ficha.focus();
                return false;
            }

            $("#msg-error").html('<div class="alert alert-success" role="alert">Registro Válido</div>');
            $("#confirm").html('<br><h5><strong>Data da Viagem: </strong> ' + data +
                '<br><strong>Horário da Viagem:</strong>  ' + horario +
                '<br><strong>Modalidade:</strong>  ' + modalidade +
                '<br><strong>Sentido:</strong>  ' + sentido +
                '<br><strong>Enbarcacao:</strong>  ' + id_embarcacao +
                '<br><br> <input class="custom-control-input" type="text" name="confirmarfoco" id="confirmarfoco" value="VOLTA"></input><button type="submit" value="Cadastrar" class="btn btn-success btn-lg btn-block">Confirmar o cadastro de viagem</button>');
            formuser.confirmarfoco.focus();
            return false;
        };

        function validararquivo() {
            var arquivo = formuser.arquivo.value;
            if (arquivo == "") {
                $("#msg-error").html('<div class="alert alert-danger" role="alert">Obrigatório carregar ficha de viagem <b>CPF!</b></div>');
                formuser.cpf.focus();
                return false;
            }
            var input, file;
            input = document.getElementById('file');
            var filePath = input.value;
            var allowedExtensions =
                /(\.jpg|\.jpeg|\.png|\.gif|\.pdf)$/i;

            if (!allowedExtensions.exec(filePath)) {
                $("#msg-error2").html('<div class="alert alert-danger" role="alert"><b>ARQUIVO INVALIDO</b></div>');
                input.value = '';
                return false;
            }

            if (!input) {
                //  bodyAppend("p", "Um, couldn't find the fileinput element.");
            } else if (!input.files) {
                //    bodyAppend("p", "This browser doesn't seem to support the `files` property of file inputs.");
            } else if (!input.files[0]) {
                //    bodyAppend("p", "Please select a file before clicking 'Load'");
            } else {
                file = input.files[0];
                //bodyAppend("p", "File " + file.name + " is " + file.size + " bytes in size");

                if (file.size > 3000000) {
                    $("#msg-error2").html('<div class="alert alert-danger" role="alert"><b>' + file.name + ' tem TAMANHO MAIOR QUE O PERMITIDO ' + file.size + '</b></div>');
                    input.value = '';
                    return;
                }

                $("#msg-error2").html('<div class="alert alert-success" role="alert"><b>Arquivo Válido</b></div>');
            }
        }
    </script>
</body>
</html>