<?php
session_start();
include_once 'conexao.php';

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

    <!-- máscaras para input formularios !-->
    <script type="text/javascript" src="jquery.mask.min.js"></script>
    <script type="text/javascript" src="jquery-ui.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("input.cpf").mask("999.999.999-99", {
                reverse: true
            });
            $("input.cnpj").mask("22.222.222/2222-22", {
                reverse: true
            });
            $("input.cep").mask("99999-999", {
                reverse: true
            });
            $("input.telefone").mask("99-9999999999", {
                reverse: true
            });


        });



        $(document).ready(function() {

            function limpa_formulário_cep() {
                // Limpa valores do formulário de cep.
                $("#rua").val("");
                $("#bairro").val("");
                $("#cidade").val("");
                $("#uf").val("");
                $("#cep").val("");

            }

            //Quando o campo cep perde o foco.
            $("#cep").focusout(function() {

                //Nova variável "cep" somente com dígitos.
                var cep = $(this).val().replace(/\D/g, '');

                //Verifica se campo cep possui valor informado.
                if (cep != "") {

                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if (validacep.test(cep)) {

                        //Consulta o webservice viacep.com.br/
                        $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {

                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $("#rua").val(dados.logradouro);
                                $("#bairro").val(dados.bairro);
                                $("#cidade").val(dados.localidade);
                                $("#uf").val(dados.uf);
                                $("#msg-cep").html('<div class="alert alert-success" role="alert"><b>' + dados.logradouro + ', ' + dados.bairro + ' - ' + dados.localidade + ' - ' + dados.uf + ' </b></div>');

                            } //end if.
                            else {
                                //CEP pesquisado não foi encontrado.
                                $("#rua").val("");
                                $("#bairro").val("");
                                $("#cidade").val("");
                                $("#uf").val("");
                                $("#cep").val("");
                                $("#msg-cep").html('<div class="alert alert-danger" role="alert"><b>CEP NAO ENCONTRADO</b></div>');
                                formuser.cep.focus();


                            }
                        });
                    } //end if.
                    else {
                        //cep é inválido.
                        $("#rua").val("");
                        $("#bairro").val("");
                        $("#cidade").val("");
                        $("#uf").val("");
                        $("#cep").val("");

                        $("#msg-cep").html('<div class="alert alert-danger" role="alert"><b>CEP INVÁLIDO</b></div>');
                        formuser.cep.focus();
                    }
                } //end if.
                else {
                    //cep sem valor, limpa formulário.
                    $("#rua").val("");
                    $("#bairro").val("");
                    $("#cidade").val("");
                    $("#uf").val("");
                    $("#cep").val("");
                }
            });
        });
    </script>






</head>

<body>
    <div class="container" role="main">
        <!--CABECALHO -->
        <div class="page-header rounded">
            <img src="http://redemobilidade.pmf.sc.gov.br\bas\img\cabecalho_02.jpg" class="img-fluid rounded" alt="Imagem responsiva">
        </div>
        <br>

        <div class="container border rounded border-primary bg-primary text-white" align="center">
            <h4 >Pesquisa Shoppings</h4>
        </div> 
        <br>

        <div class="container border rounded border-primary" role="main">
            <!-- Formulário  !-->
            <form method="post" id="formuser" action="shopping_envia.php" enctype="multipart/form-data">
                <br>

                <div class="form-row">
                    <div class="form-group col-12">
                        <h5><strong><label class="text-muted">Horário que saio de casa:</label></strong></h5>
                        <input name="horario1" type="time" id="horario1" class="form-control" />
                    </div>
                </div>
                <span id="msg-error-horario1"></span>

                <div class="form-row">
                    <div class="form-group col-12">
                        <h5><strong><label class="text-muted">Horário que saio do trabalho:</label></strong></h5>
                        <input name="horario2" type="time" id="horario2" class="form-control" />
                    </div>
                </div>
                <span id="msg-error-horario2"></span>


                <div class="form-row">
                    <div class="form-group col-12">
                        <h5><strong><label class="text-muted">Eu trabalho no:</label></strong></h5>
                        <select name="origem" id="origem" class="form-control" required> 
                            <option>Beira Mar Shopping</option>
                            <option>Iguatemi</option>
                            <option>Floripa Shopping</option>
                        </select>
                    </div>
                </div>




                <div class="form-row">
                    <div class="form-group col-12">
                        <h5><strong><label class="text-muted">Eu moro no CEP:</label></strong></h5>
                        <input name="cep" id="cep" type="text" class="cep form-control" maxlength="9" size="10" placeholder="Digite o seu CEP">
                    </div>
                    <input name="rua" type="hidden" id="rua" class="form-control form-control bg-secondary text-white" size="70" placeholder="Rua" />
                    <input name="bairro" type="hidden" id="bairro" class="form-control bg-secondary text-white" size="70" placeholder="Bairro" />
                    <input name="cidade" type="hidden" id="cidade" class="form-control bg-secondary text-white" size="70" placeholder="Cidade" />
                    <input name="uf" type="hidden" id="uf" class="form-control bg-secondary text-white" size="4" placeholder="UF" />

                    <div class="form-group col-12">



                        <h5 class="text-muted" align=center><strong> <span id="msg-cep"></span>
                                </span></strong></h5>
                    </div>
                    <div class="form-group col-12">
                        <h5><strong><label class="text-muted">Eu moro no Número:</label></strong></h5>
                        <input name="complemento" type="text" id="complemento" class="form-control" size="70" placeholder="Número onde moro" />
                    </div>
                    <span id="msg-error-complemento"></span>



                </div>
                <button class="btn btn-success btn-lg btn-block" onclick="return validar()">Enviar</button>
                <br>
            </form>
        </div>

        <br>

        <div class="p-3 mb-2 bg-primary text-white">
            <h5> Prefeitura Municipal de Florianópolis</h5>
            <h6>Secretaria de Mobilidade e Planejamento Urbano </h6>
            Rua Felipe Schmidt, n° 1320 – Centro - CEP 88.010-002 – Florianópolis/SC.<br>
        </div>
        <br>

        <script>
            //limpar formulario
            $(document).ready(function() {
                $("input#horario").val("");

            });

            function validar() {
                var horario1 = formuser.horario1.value;
                var horario2 = formuser.horario2.value;

                var complemento = formuser.complemento.value;
                var cep = formuser.cep.value;
                cep = cep.replace(/\D/g, '');

                if (horario1 == "") {
                    $("#msg-error-horario1").html('<div class="alert alert-danger" role="alert">Indicar o <b>Horário de ida ao trabalho!</b></div>');
                    formuser.horario1.focus();
                    return false;
                }

                $("#msg-error-horario1").html('');



                if (horario2 == "") {
                    $("#msg-error-horario2").html('<div class="alert alert-danger" role="alert">Indicar o <b>Horário de saída do trabalho!</b></div>');
                    formuser.horario2.focus();
                    return false;
                }

                $("#msg-error-horario2").html('');


                if (cep == "") {
                    $("#msg-cep").html('<div class="alert alert-danger" role="alert">Indicar o <b>CEP!</b></div>');
                    formuser.cep.focus();
                    return false;
                }

                $("#msg-cep").html('');


                if (complemento == "") {
                    $("#msg-error-numero").html('<div class="alert alert-danger" role="alert">Indicar o <b>número</b></div>');
                    formuser.complemento.focus();
                    return false;
                }

            }
        </script>




</body>

</html>