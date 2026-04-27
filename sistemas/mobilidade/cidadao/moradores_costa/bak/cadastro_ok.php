<?php
session_start();


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
    </script>

    <script>
        $(document).ready(function() {

            function limpa_formulário_cep() {
                // Limpa valores do formulário de cep.
                $("#rua").val("");
                $("#bairro").val("");
                $("#cidade").val("");
                $("#uf").val("");
            }

            //Quando o campo cep perde o foco.
            $("#cep").blur(function() {

                //Nova variável "cep" somente com dígitos.
                var cep = $(this).val().replace(/\D/g, '');

                //Verifica se campo cep possui valor informado.
                if (cep != "") {

                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if (validacep.test(cep)) {

                        //Preenche os campos com "..." enquanto consulta webservice.
                        $("#rua").val("...");
                        $("#bairro").val("...");
                        $("#cidade").val("...");
                        $("#uf").val("...");

                        //Consulta o webservice viacep.com.br/
                        $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {

                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $("#rua").val(dados.logradouro);
                                $("#bairro").val(dados.bairro);
                                $("#cidade").val(dados.localidade);
                                $("#uf").val(dados.uf);
                            } //end if.
                            else {
                                //CEP pesquisado não foi encontrado.
                                limpa_formulário_cep();
                                $("#msg-error").html('<div class="alert alert-danger" role="alert"><b>CEP INVÁLIDO</b></div>');

                            }
                        });
                    } //end if.
                    else {
                        //cep é inválido.
                        limpa_formulário_cep();
                        $("#msg-error").html('<div class="alert alert-danger" role="alert"><b>CEP INVÁLIDO</b></div>');
                    }
                } //end if.
                else {
                    //cep sem valor, limpa formulário.
                    limpa_formulário_cep();
                }
            });
        });
    </script>

</head>

<body>

    <!--CABECALHO -->
    <div class="container" role="main">

        <br>
        <div class="page-header rounded">
            <img src="img\cabecalho_01.jpg" class="img-fluid rounded" alt="Imagem responsiva">
        </div>
        <br>
        <div class="container border rounded border-primary" role="main">
            <br>
            <div align=center>
                <a href="rededemobilidade.pmf.sc.gov.br" class="btn btn-warning" align=center>Fechar | Voltar Rede de Mobilidade</a>
            </div><br>
            <!-- Formulário de Editar dados dos Usuários !-->


            <form method="post" id="formuser" action="upload_ftp1.php" enctype="multipart/form-data">
                <h4 class="bg-primary  text-white"> Cadastro de Usuários</h4>
                <span id="msg-error"></span>


                <div class="form-row">
                    <div class="form-group col-6">
                        <label class="col-form-label">Sócio 1: </label>
                        <input name="nome" type="text" id="nome" style="text-transform: uppercase;" class="form-control" size="70" placeholder="Nome do sócio 1" />
                    </div>
                    <div class="form-group col-3">
                        <label class="col-form-label">RG: </label>
                        <input name="rg" type="text" id="rg" class="form-control" size="15" placeholder="RG">
                    </div>
                    <div class="form-group col-3">
                        <label class="col-form-label">CPF: </label>
                        <input name="cpf" type="text" id="cpf" class="cpf form-control" size="20" placeholder="CPF">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="col-form-label">E-mail: </label>
                        <input name="email" type="email" class="form-control" id="email" size="40" placeholder="Indique o melhor E-mail">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-form-label">Telefone: </label>
                        <input name="telefone" type="text" class="telefone form-control" id="telefone" size="60" value="48" placeholder="Telefone de contato">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-3">
                        <label class="col-form-label">CEP:</label>
                        <input name="cep" id="cep" type="text" class="cep form-control" maxlength="9" size="10" placeholder="Digite o CEP">
                    </div>
                    <div class="col-sm-5">
                        <label class="col-form-label">Rua: </label>
                        <input name="rua" type="text" id="rua" class="form-control form-control bg-secondary text-white" size="70" placeholder="Rua" />
                    </div>
                    <div class="col-sm-4">
                        <label class="col-form-label">Complemento: </label>

                        <input name="complemento" type="text" id="complemento" class="form-control" size="70" placeholder="Número - Bloco - Andar" />
                    </div>
                </div>

                <div class="form-row">
                    <div class="row">
                        <div class="col-sm-4">
                            <label class=" col-form-label">Bairro:
                                <input name="bairro" type="text" id="bairro" class="form-control bg-secondary text-white" size="70" placeholder="Bairro" />
                            </label>
                        </div>
                        <div class="col-sm-4">
                            <label class="col-form-label">Cidade:
                                <input name="cidade" type="text" id="cidade" class="form-control bg-secondary text-white" size="70" placeholder="Cidade" />
                            </label>
                        </div>
                        <div class="col-sm-2">
                            <label class="col-form-label">Estado:
                                <input name="uf" type="text" id="uf" class="form-control bg-secondary text-white" size="4" placeholder="UF" />
                            </label>
                        </div>
                    </div>
                </div>
                <h4 class="bg-primary  text-white"> Cadastro de Usuários</h4>
                
                <span id="msg-error2"></span> 
                <div class="row">
                    <div class="col-sm-6"><label class="col-form-label">Comprovante de Residência1</label>
                        <div class="custom-file">
                            <input type="file" name="file1" class="custom-file-input" id="file" onchange="return validararquivo()" />
                            <label class="custom-file-label" for="file">Escolha o arquivo</label>
                        </div>
                    </div>
                    <div class="col-sm-6"><label class="col-form-label">Comprovante de Residência1</label>
                        <div class="custom-file">
                            <input type="file" name="arquivo" class="custom-file-input" id="file" onchange="return validararquivo()" />
                            <label class="custom-file-label" for="file">Escolha o arquivo</label>
                        </div>
                    </div>
                    
                 
                
                </div>
                <br>
                <button type="submit" value="Cadastrar" class="btn btn-success">Cadastrar 1</button>
                <button type="submit" value="Cadastrar" class="btn btn-success" onclick="return validar()">Cadastrar1111</button>
                <a href="pdv.html" class="btn btn-warning" align=center>Fechar | Voltar</a>

                <br>

                <br>

        </div>
    </div>

    </form>

    <br>

    <div class="p-3 mb-2 bg-primary text-white">
        <h5> Prefeitura Municipal de Florianópolis</h5>
        <h6>Secretaria de Mobilidade e Planejamento Urbano </h6>
        Rua Felipe Schmidt, n° 1320 – Centro - CEP 88.010-002 – Florianópolis/SC.<br>
    </div>

    </div><br>

    <br>
    </div>

    <script>
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>

    <script>
        function validar() {
            var nome = formuser.nome.value;
            var nome = nome.trim();
            var email = formuser.email.value;
            var email = email.trim();




            var nome = formuser.nome.value;
            var nome = nome.trim();
            var rg = formuser.rg.value;
            var cpf = formuser.cpf.value;


            var cep = formuser.cep.value;
            var complemento = formuser.complemento.value;

            //ANALISE DE EMAIL


            if (nome == "") {
                $("#msg-error").html('<div class="alert alert-danger" role="alert">Necessário indicar responsável - Preencher o campo <b>Nome!</b></div>');
                formuser.nome.focus();
                return false;
            }


            if (rg == "") {
                $("#msg-error").html('<div class="alert alert-danger" role="alert">Preencher corretamente o <b>RG!</b></div>');
                formuser.rg.focus();
                return false;
            }

            if (cpf == "") {
                $("#msg-error").html('<div class="alert alert-danger" role="alert">Obrigatório informar <b>CPF!</b></div>');
                formuser.cpf.focus();
                return false;
            }

            if (cpf != "" || cpf == "") {
                $.ajax({
                    url: 'form_analisa_db.php',
                    type: 'POST',
                    data: {
                        "cpf": cpf
                    },
                    success: function(data) {
                        data = $.parseJSON(data);
                        if (data.cpf) {
                            $("#msg-error").html('<div class="alert alert-danger" role="alert"><b>CPF</b> já em uso!</div>');
                            formuser.cpf.focus();
                            document.getElementById("cpf").select();
                            document.getElementById('cpf').value = "";
                        }
                    }
                });

                if (cpf == "") {
                    $("#msg-error").html('<div class="alert alert-danger" role="alert">Obrigatório informar <b>CPF!</b></div>');
                    formuser.cpf.focus();
                    return false;
                }

                if (TestaCPF(strCPF) === false) {
                    $("#msg-error").html('<div class="alert alert-danger" role="alert"><b>CPF INVÁLIDO!</b></div>');
                    formuser.cpf.focus();
                    return false;
                }

            }

            if (cep == "") {
                $("#msg-error").html('<div class="alert alert-danger" role="alert">Preencher corretamente o <b>CEP</b></div>');
                formuser.cep.focus();
                return false;
            }

            if (complemento == "") {
                $("#msg-error").html('<div class="alert alert-danger" role="alert">Preencher corretamente o <b>complemento</b></div>');
                formuser.complemento.focus();
                return false;
            }

            $("#msg-error").html('<div class="alert alert-success" role="alert">Registro Válido</div>');

        };


        function validararquivo() {
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
                    $("#msg-error2").html('<div class="alert alert-danger" role="alert"><b>'+ file.name + ' tem TAMANHO MAIOR QUE O PERMITIDO ' + file.size + '</b></div>');
                    input.value = '';
                    return;
                }

                $("#msg-error2").html('<div class="alert alert-danger" role="alert"><b>TAMANHO DO ARQUIVO OK ' + file.size + '</b></div>');

            }
        }


        function TestaCPF(strCPF) {
            var Soma;
            var Resto;
            Soma = 0;
            if (strCPF == "00000000000" ||
                strCPF == "11111111111" ||
                strCPF == "22222222222" ||
                strCPF == "33333333333" ||
                strCPF == "44444444444" ||
                strCPF == "55555555555" ||
                strCPF == "66666666666" ||
                strCPF == "77777777777" ||
                strCPF == "88888888888" ||
                strCPF == "99999999999"

            ) return false;

            for (i = 1; i <= 9; i++) Soma = Soma + parseInt(strCPF.substring(i - 1, i)) * (11 - i);
            Resto = (Soma * 10) % 11;

            if ((Resto == 10) || (Resto == 11)) Resto = 0;
            if (Resto != parseInt(strCPF.substring(9, 10))) return false;

            Soma = 0;
            for (i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i - 1, i)) * (12 - i);
            Resto = (Soma * 10) % 11;

            if ((Resto == 10) || (Resto == 11)) Resto = 0;
            if (Resto != parseInt(strCPF.substring(10, 11))) return false;
            return true;
        };
    </script>

</body>

</html>