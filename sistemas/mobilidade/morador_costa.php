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
    <script type="text/javascript" src="/js/jquery.js"></script>

    <script src="masks.js"></script> <!-- máscaras para input formularios !-->


    <script type="text/javascript" src="jquery.mask.min.js"></script>
    <script>
        //limpar formulario
        $(document).ready(function() {

            limpa1

        });


        function limpa1() {
            $("input#nome").val("");
            $("input#cpf").val("");
            $("input#rg").val("");
            $("input#rg_orgao").val("");
            $("input#cep").val("");
            $("input#rua").val("");
            $("input#complemento").val("");
            $("input#bairro").val("");
            $("input#cidade").val("");
            $("input#uf").val("");
            $("input#telefone").val("");
            $("input#email").val("");
            $("select#categoria").val("");
            $("input#validade").val("");
            form_type();
            formuser.categoria.focus();


        }
    </script>

       
</head>

<body>

    <!--CABECALHO -->
    <div class="container" theme-showcase" role="main">
       
        <div class="container" role="main">11111
            <br>
            <!-- Fim imagem cabeçalho -->
            <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
                <div class="btn-group mr-2" role="group" aria-label="1 group">
                    <form method="POST" action="" enctype="multipart/form-data">
                        <div class="botton-group row">
                            <div class="button-group mr-2">
                                <button type="button" class="btn btn-success" data-toggle="modal" onClick="limpa()" data-target="#MODALuser_cadastrar">
                                    Cadastrar Usuário
                                </button>
                            </div>
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

        <?php
    } else {
        echo "<div class='alert alert-danger' role='alert'>Nenhum usuário encontrado!</div>";
    }
        ?>

        <!-- MODAL CADASTRAR-->

        <div id="MODALuser_cadastrar" class="modal fade bd-example-modal-lg" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="MODALuser_cadastrar">Cadastrar Morador Costa da Lagoa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="formuser" autocomplete="off" action="morador_costa_cadastrar.php">
                            <div class="form-row">
                                <div class="col col-md-12">
                                    <select class="form-control bg-info text-white" id="categoria" name="categoria">
                                        <option selected value="">Escolha a categoria do cadastro...</option>
                                        <option value="Morador">Morador</option>
                                        <option value="Estudante">Estudante</option>
                                        <option value="PCD">PCD</option>
                                        <option value="PCD com acompanhante">PCD com acompanhante</option>
                                        <option value="Gestante">Gestante</option>
                                        <option value="Idoso">Idoso</option>
                                        <option value="Acompanhante Aluno Infantil">Mãe de aluno do ensino Infantil Municipal</option>

                                    </select>
                                </div>
                            </div>
                            <div><br>
                                <span id="msg-error"></span>

                            </div>

                            <div id="div_form" style="display:none">
                                <div class="form-row">
                                    <div class="form-group col-5">
                                        <label class="col-form-label">Nome do Morador: </label>
                                        <input name="nome" type="text" id="nome" style="text-transform: uppercase;" class="form-control" size="70" autocomplete="off" placeholder="NOME COMPLETO" />
                                    </div>
                                    <div class="form-group col-3">
                                        <label class="col-form-label">CPF: </label>
                                        <input name="cpf" type="text" id="cpf" class="cpf form-control" onchange="validacpfdb();" size="20" placeholder="CPF do cadastro" autocomplete="off" />
                                    </div>
                                    <div class="form-group col-2">
                                        <label class="col-form-label">RG: </label>
                                        <input name="rg" type="text" id="rg" class="rg form-control" size="15" placeholder="RG (numeros)" autocomplete="off" />
                                    </div>
                                    <div class="form-group col-2">
                                        <label class="col-form-label">Emissor </label>
                                        <input name="rg_orgao" type="text" id="rg_orgao" class="form-control" size="8" style="text-transform: uppercase;" placeholder="" autocomplete="off" />
                                    </div>

                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label class="col-form-label">Nascimento: </label>
                                        <input name="data_nascimento" type="date" class="form-control" id="data_nascimento" />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="col-form-label">E-mail: </label>
                                        <input name="email" type="email" class="form-control" id="email" size="40" placeholder="Indique o melhor E-mail" autocomplete="off">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="col-form-label">Telefone: </label>
                                        <input name="telefone01" type="text" class="telefone form-control" id="telefone01" size="60" value="48" placeholder="Telefone de contato" autocomplete="off">
                                    </div>
                                </div>
                                <h5>Endereço</h5>
                                <div class="form-row">
                                    <div class="form-group col-3">
                                        <label class="col-form-label">CEP:</label>
                                        <input name="cep" id="cep" type="text" class="cep form-control" maxlength="9" size="10" placeholder="CEP" />

                                    </div>
                                    <div class="form-group col-5">
                                        <label class="col-form-label">Rua </label>
                                        <input name="rua" type="text" id="rua" class="form-control bg-light" size="70" placeholder="Rua" />
                                    </div>

                                    <div class="form-group col-4">
                                        <label class="col-form-label">Bairro: </label>
                                        <input name="bairro" type="text" id="bairro" class="form-control bg-light" size="70" placeholder="Bairro" />

                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-8">
                                        <label class="col-form-label">Complemento: </label>
                                        <input name="complemento" type="text" id="complemento" class="form-control" size="70" placeholder="Número ou referência" />
                                    </div>
                                    <div class="form-group col-3">
                                        <label class="col-form-label">Cidade: </label>
                                        <input name="cidade" type="text" id="cidade" class="form-control bg-light" size="70" placeholder="Cidade" />
                                    </div>
                                    <div class="form-group col-1">
                                        <label class="col-form-label">UF: </label>
                                        <input name="uf" type="text" id="uf" class="form-control bg-light" size="4" placeholder="UF" />
                                    </div>

                                </div>
                                <div>
                                    <span id="msg-error2"></span>
                                </div>

                                <div class="form-row">
                                    <div class="col-sm-12">
                                        <img id="preview_1" class="img-fluid rounded" style="width: 100%">
                                    </div>
                                </div>


                                <div class="row" id="upload_estudante" style="display:none">
                                    <div class="col-sm-12">
                                        <h5>Estudante</h5>
                                        <!--
                                        <div class="input-group mt-3">

                                            <div class="custom-file">
                                                <input id="file04" type="file" name="upload_estudante" class="custom-file-input" onchange="ValidateSingleInput(this);">
                                                <label class="custom-file-label" for="file04">Atestado de matrícula</label>
                                            </div>
                                        </div>
                                         -->

                                        <div class="form-row">
                                            <div class="form-group col-3">
                                                <label class="text-muted">Validade</label>
                                                <input name="validade1" type="date" id="validade_estudante" class="form-control" />
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="row" id="upload_gestante" style="display:none">
                                    <div class="col-sm-12">
                                        <hr>
                                        <h5>Gestante</h5>
                                    
                                        <div class="form-row">
                                            <div class="form-group col-3">
                                                <label class="text-muted">Data final Pré-natal</label>
                                                <input name="validade2" type="date" id="validade_gestante" class="form-control" autocomplete="off" />
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!--
                                <div class="row" id="upload_mae">
                                    <div class="col-sm-12">
                                        <hr>
                                        <h5>Mãe de estudante</h5>
                                        <div class="input-group mt-3">
                                            <div class="custom-file">
                                                <input id="file06" type="file" name="upload_mae" class="custom-file-input" onchange="ValidateSingleInput(this);">
                                                <label class="custom-file-label" for="file06">Atestado de matrícula</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                -->

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
                                    <button type="button" value="Limpar" class="btn btn-danger" onClick="limpa1()">Limpar</button>
                                    <button type="submit" value="Cadastrar" class="btn btn-success" onclick="return validar()">Cadastrar</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- FIM MODAL cadastrar Usuários-->



        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
        <script src="data_confirm.js"></script>


        <script type="text/javascript">
            $('#MODALuser_apagar').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                //extrai atributos data-
                var recipientidcadastro = button.data('var_id_cadastro')
                var recipientnome = button.data('var_nome')
                var recipientcategoria = button.data('var_categoria')
                var modal = $(this)
                //variaveis
                modal.find('#id_cadastro_apagar').val(recipientidcadastro)
                //textos
                modal.find('#shownome').text('Nome : ' + recipientnome)
                modal.find('#showcategoria').text('Categoria : ' + recipientcategoria)
                modal.find('#showidcadastro').text('Apagar registro ID : ' + recipientidcadastro)
            })
        </script>



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

        <script>
            function validacpfdb() {
                var cpf = formuser.cpf.value;
                $.ajax({
                    url: 'cadastro_analisa.php',
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
                })
            }
        </script>

        <script>
            function validar() {
                var nome = formuser.nome.value;
                var nome = nome.trim();
                var rg = formuser.rg.value;
                var cpf = formuser.cpf.value;
                var cep = formuser.cep.value;
                var categoria = formuser.categoria.value;
                var data_nascimento = formuser.data_nascimento.value;
                var strCPF = formuser.cpf.value;

                strCPF = strCPF.replace(/[_\W]+/g, "");

        
                if (cpf == "") {
                    $("#msg-error").html('<div class="alert alert-danger" role="alert">Obrigatório informar <b>CPF!</b></div>');
                    formuser.cpf.focus();
                    return false;
                }

                if (TestaCPF(strCPF) === false) {
                    $("#msg-error").html('<div class="alert alert-danger" role="alert"><b>CPF INVÁLIDO!</b></div>');
                    document.getElementById('cpf').value = "";
                    formuser.cpf.focus();
                    return false;
                }


        
                $("#msg-error").html('<div class="alert alert-success" role="alert">Registro Válido</div>');
                return;
            };

            function TestaCPF(strCPF) {
                var Soma;
                var Resto;
                Soma = 0;
                if (strCPF == "00000000000" || strCPF == "11111111111" || strCPF == "22222222222" || strCPF == "33333333333" || strCPF == "44444444444" || strCPF == "55555555555" || strCPF == "66666666666" || strCPF == "77777777777" || strCPF == "88888888888" || strCPF == "99999999999") return false;
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