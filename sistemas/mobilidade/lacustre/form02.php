<?php
session_start();
include_once 'conexao.php';

$id_viagem = $_GET['id_viagem'];
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
            <!-- Formulário  !-->
            <form method="post" id="formuser" action="envia02.php?id_viagem=<?php echo $id_viagem?>&id=<?php echo $id?>" enctype="multipart/form-data">
                <h4 class="bg-primary  text-white">Usuários Cadastrados</h4>
                <span id="msg-error"></span>
                <br>

                <div class="form-group row">
                    <label for="morador_cadastrado" class="col-sm-2 col-form-label">Morador</label>
                    <div class="col-sm-10">
                        <input type="number" name="morador_cadastrado"  class="form-control" id="morador_cadastrado" min="0" max="100" required value="1" onchange="return validar()">
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <label for="morador_gestante" class="col-sm-2 col-form-label">Gestante</label>
                    <div class="col-sm-10">
                        <input type="number"  name="morador_gestante" class="form-control" id="morador_gestante" min="0" max="100" required value="0"   onchange="return validar()">
                    </div>
                </div>
                <hr>

                <div class="form-group row">
                    <label for="PCD" class="col-sm-2 col-form-label">PCD</label>
                    <div class="col-sm-10">
                        <input type="number" name="pcd" class="form-control" id="PCD" min="0" max="100" required value="0"  onchange="return validar()">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="PCD_acompanhante" class="col-sm-2 col-form-label">PCD Acompanhante</label>
                    <div class="col-sm-10">
                        <input type="number" name="pcd_acompanhante" class="form-control" id="PCD_acompanhante" min="0" max="100" required value="0"  onchange="return validar()">
                    </div>
                </div>

                <hr>
                <div class="form-group row">
                    <label for="estudante_menor" class="col-sm-2 col-form-label">Estudante Menor</label>
                    <div class="col-sm-10">
                        <input type="number" name="estudante_menor" class="form-control" id="estudante_menor" min="0" max="100" required value="0"   onchange="return validar()">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="mae_estudante" class="col-sm-2 col-form-label">Mãe estudante</label>
                    <div class="col-sm-10">
                        <input type="number" name="mae_estudante" class="form-control" id="mae_estudante" min="0" max="100" required value="0"  onchange="return validar()">
                    </div>
                </div>
                <hr>

                <div class="form-group row">
                    <label for="estudante" class="col-sm-2 col-form-label">Estudante</label>
                    <div class="col-sm-10">
                        <input type="number" name="estudante" class="form-control" id="estudante" min="0" max="100"  required value="0"  onchange="return validar()">
                    </div>
                </div>
                <hr>

                <div class="form-group row">
                    <label for="idoso" class="col-sm-2 col-form-label">Idoso</label>
                    <div class="col-sm-10">
                        <input type="number" name="idoso" class="form-control" id="idoso" min="0" max="100" required value="0"  onchange="return validar()">
                    </div>
                </div>
                <h4 class="bg-primary text-white">Usuários não cadastrados</h4>

                <div class="form-group row">
                    <label for="nao_cadastrado" class="col-sm-2 col-form-label">Não Cadastrados</label>
                    <div class="col-sm-10">
                        <input type="number" name="nao_cadastrado" class="form-control" id="nao_cadastrado" min="0" max="100" onchange="return validar()">
                    </div>
                </div>
                <button class="btn btn-success btn-lg btn-block">Registrar passageiros <span class="badge badge-light" id="resultado">0</span></button>
                <a href="form_viagem-6.php" class="btn btn-warning btn-lg btn-block" align=center>Limpar</a>
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
            $("input#morador_cadastrado").val("0");
            $("input#morador_gestante").val("0");
            $("input#PCD").val("0");
            $("input#PCD_acompanhante").val("0");
            $("input#estudante_menor").val("0");
            $("input#mae_estudante").val("0");
            $("input#estudante").val("0");
            $("input#idoso").val("0");
            $("input#nao_cadastrado").val("0");

        });

        function validar() {
            var morador_cadastrado = 0;
            var morador_cadastrado = parseInt(document.getElementById('morador_cadastrado').value, 10);
            var morador_gestante = parseInt(document.getElementById('morador_gestante').value, 10);
            var PCD = parseInt(document.getElementById('PCD').value, 10);
            var PCD_acompanhante = parseInt(document.getElementById('PCD_acompanhante').value, 10);
            var estudante_menor = parseInt(document.getElementById('estudante_menor').value, 10);
            var mae_estudante = parseInt(document.getElementById('mae_estudante').value, 10);
            var estudante = parseInt(document.getElementById('estudante').value, 10);
            var idoso = parseInt(document.getElementById('idoso').value, 10);
            var nao_cadastrado = parseInt(document.getElementById('nao_cadastrado').value, 10);

            document.getElementById('resultado').innerHTML =
            morador_cadastrado +
            morador_gestante +
            PCD +
            PCD_acompanhante +
            estudante_menor +
            mae_estudante +
            estudante +
            idoso +
            nao_cadastrado;
            return false;
        };

     
    </script>
</body>

</html>