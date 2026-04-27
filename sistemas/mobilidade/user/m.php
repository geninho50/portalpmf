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

    <style>
        .pequeno {
            width: 30px;
        }

        .medio {
            width: 50%;
        }
    </style>
    <style>
        #customFile.custom-file-input:lang(pt)::after {
            content: "Selecionar Arquivo...";
        }

        #customFile.custom-file-input:lang(pt)::before {
            content: "Click me";
        }

        /*when a value is selected, this class removes the content */
        .custom-file-input.selected:lang(pt)::after {
            content: "" !important;
        }

        .custom-file {
            overflow: hidden;
        }

        .custom-file-input {
            white-space: nowrap;
        }
    </style>
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

            <table id="dtBasicExample" class="sortable lista-clientes table table-striped table-hover table-sm" cellspacing="0" width="100%">
                <tr class="table-primary">
                    <td><b><a class="text-default">Categoria<br>Registro</a></b></td>
                    <td><b><a class="text-default">Nome<br>CPF<br>Identidade</a></b></td>
                    <td><b><a class="text-default">Endereço</a></b></td>
                    <td><b><a class="text-default">Email<br>
                                Telefone</a></b></td>
                    <td><b><a class="text-default">cadastro</a><br><a class="text-default">validade</a></b><br><a class="text-default">Nascimento</a></b></td>
                    <td><b><a class="text-default">Status</a></td>
                    <td><b><a class="text-default">Ação</a></b></td>
                </tr>
                <?php while ($row = $resultado_02->fetch()) {

                    $data_nascimento = date('d-m-Y', strtotime($row['data_nascimento']));
                    $data_validade = date('d-m-Y', strtotime($row['data_validade']));
                    $data_criado = date('d-m-Y', strtotime($row['data_criado']));

                    $cpf_view1 = substr($row['cpf'], -11, 3);
                    $cpf_view2 = substr($row['cpf'], -8, 3);
                    $cpf_view3 = substr($row['cpf'], -5, 3);
                    $cpf_view4 = substr($row['cpf'], -2);
                    $cpf =  $cpf_view1 . "." . $cpf_view2 . "." . $cpf_view3 . "-" . $cpf_view4;

                ?>
                    <tr>
                        <td width=10%><?php echo $row['categoria']; ?><br><?php echo $row['id_cadastro']; ?></td>
                        <td width=20%> <?php echo $row['nome_passageiro']; ?><br>
                            <?php echo $cpf; ?><br><?php echo $row['rg']; ?>
                        </td>
                        <td width=15%><?php echo $row['cep']; ?><br><?php echo $row['rua']; ?> <?php echo $row['complemento']; ?>
                            <br> <?php echo $row['bairro']; ?> </td>
                        <td width=15%><?php echo $row['email']; ?> <br><?php echo $row['telefone01']; ?> </td>
                        <td width=10% color="danger"><?php echo $data_criado; ?><br><?php echo $data_validade; ?><br><?php echo $data_nascimento; ?>
                        </td>
                        <td width=10%>
                            <?php
                            if ($row['status'] == '1') {
                                $status = "autorizar";
                            ?>
                                <a class="btn btn-danger btn-sm" href="morador_ficha.php?id_cadastro=<?php echo $row['id_cadastro'] ?>" role="button"><?php echo $status ?></a>
                            <?php } elseif ($row['status'] == '2') {
                                $status = "registrado";
                            ?>
                                <a class="btn btn-success btn-sm" href="morador_ficha.php?id_cadastro=<?php echo $row['id_cadastro'] ?>" role="button"><?php echo $status ?></a>

                            <?php  } else { ?>
                                <a class="btn btn-success btn-sm" href="" role="button">registrado</a>
                            <?php } ?>

                        </td>
                        <td width=20%>
                            <!--<a type="button" class="btn btn-outline-danger btn-sm fa fa-print pequeno" href="print_conferir.php?id_cadastro=<?php echo $row['id_cadastro'] ?>" role="button"></a> !-->
                            <a type="button" class="btn btn-outline-info btn-sm fa fa-info pequeno" href="morador_ficha.php?id_cadastro=<?php echo $row['id_cadastro'] ?>" role="button"></a>
                            <a type="button" class="btn btn-outline-warning btn-sm fa fa-pencil-square-o pequeno" href="morador_editar.php?id_cadastro=<?php echo $row['id_cadastro'] ?>" role="button"></a>
                            <button type="button" class="btn btn-outline-danger btn-sm fa fa-trash pequeno" data-toggle="modal" data-target="#MODALuser_apagar" data-var_id_cadastro="<?php echo $row['id_cadastro']; ?>" data-var_nome="<?php echo $row['nome_passageiro']; ?>" data-var_categoria="<?php echo $row['categoria']; ?>"></button>
                        </td>
                    </tr>

                <?php } ?>

                <!-- MODAL Apagar  Usuários-->
                <div id="MODALuser_apagar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4>Apagar</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <strong>
                                    <h5>
                                        <p id="showidcadastro" class="text-muted"></p>
                                    </h5>
                                    <h6>
                                        <p id="shownome" class="text-muted"></p>
                                        <p id="showcategoria" class="text-muted"></p>
                                    </h6>
                                </strong>
                            </div>
                            <div class="modal-footer">
                                <form method="POST" action="cadastro_apagar.php" enctype="multipart/form-data">
                                    <input name="id_cadastro_apagar" type="hidden" class="form-control" id="id_cadastro_apagar">
                                    <button type="button" class="btn btn-info" data-dismiss="modal">Fechar</button>
                                    <button type="submit" class="btn btn-danger">Confirmar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- FIM MODAL Apagar Dados Usuários-->


            </table>
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

                                <!--                            
                                <div class="row" id="upload_identidade">
                                    <div class="col-sm-12">
                                        <hr>
                                        <h5>Identidade</h5>
                                        <div class="input-group mt-3">
                                            <div class="custom-file">
                                                <input id="file01" type="file" name="identidade01" class="custom-file-input" onchange="ValidateSingleInput(this);">
                                                <label class="custom-file-label" for="file01">Identidade lado 1</label>
                                            </div>
                                        </div>

                                        <div class="input-group mt-3">
                                            <div class="custom-file">
                                                <input id="file02" type="file" name="identidade02" class="custom-file-input" onchange="ValidateSingleInput(this);">
                                                <label class="custom-file-label" for="file02">Identidade lado 2</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                -->

                                <!--
                                <div class="row" id="upload_residencia">
                                    <div class="col-sm-12">
                                        <hr>
                                        <h5>Comprovante Residência</h5>
                                        <div class="input-group mt-3">
                                            <div class="custom-file">
                                                <input id="file03" type="file" name="residencia" class="custom-file-input" onchange="ValidateSingleInput(this);">
                                                <label class="custom-file-label" for="file03">Comprovante de Residência</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                -->
                                <!--
                                <div class="row" id="upload_pcd">
                                    <div class="col-sm-12">
                                        <hr>
                                        <h5>PCD</h5>
                                        
                                        <div class="input-group mt-3">
                                            <div class="custom-file">
                                                <input id="file03" type="file" name="upload_pcd" class="custom-file-input" onchange="ValidateSingleInput(this);">
                                                <label class="custom-file-label" for="file03">Atestado médico com CID</label>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="acompanhante_´pcd" id="acompanhante_check">
                                            <label class="form-check-label" for="acompanhante_check">Necessita acompanhante</label>
                                        </div>
                                    </div>
                                </div>
                                -->

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
                                        <!--
                                        <div class="input-group mt-3">
                                            <div class="custom-file">
                                                <input id="file05" type="file" name="upload_gestante" class="custom-file-input" onchange="ValidateSingleInput(this);">
                                                <label class="custom-file-label" for="file05">Atestado médico</label>
                                            </div>
                                        </div>
                                        -->
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

                if (categoria == "") {
                    $("#msg-error").html('<div class="alert alert-danger" role="alert">Necessário escolher a <b>Categoria!</b></div>');
                    formuser.topo.focus();
                    return false;
                }

                if (nome == "") {
                    $("#msg-error").html('<div class="alert alert-danger" role="alert"> Necessário o campo <b>Nome!</b></div>');
                    formuser.nome.focus();
                    return false;
                }

                if (data_nascimento == "") {
                    $("#msg-error").html('<div class="alert alert-danger" role="alert">Preencher corretamente a <b>Data de Nascimento!</b></div>');
                    formuser.data_nascimento.focus();
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

                if (TestaCPF(strCPF) === false) {
                    $("#msg-error").html('<div class="alert alert-danger" role="alert"><b>CPF INVÁLIDO!</b></div>');
                    document.getElementById('cpf').value = "";
                    formuser.cpf.focus();
                    return false;
                }

                if (cep == "") {
                    $("#msg-error").html('<div class="alert alert-danger" role="alert">Preencher corretamente o <b>CEP</b></div>');
                    formuser.cep.focus();
                    return false;
                }

                if (categoria == "Estudante") {

                    var validade_estudante = formuser.validade_estudante.value;
                    if (validade_estudante == "") {

                        $("#msg-error").html('<div class="alert alert-danger" role="alert">Necessário indicar a validade da matrícula!</b></div>');
                        formuser.validade_estudante.focus();
                        return false;
                    }

                }

                if (categoria == "Gestante") {

                    var validade_gestante = formuser.validade_gestante.value;
                    if (validade_gestante == "") {

                        $("#msg-error").html('<div class="alert alert-danger" role="alert">Necessário indicar a data do pré-natal!</b></div>');
                        formuser.validade_gestante.focus();
                        return false;
                    }

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
        <script>
            var _validFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png"];

            function ValidateSingleInput(oInput) {
                if (oInput.type == "file") {
                    var imagem = oInput.files[0];
                    var sFileName = oInput.value;
                    var nome = imagem.name;
                    var preview = document.querySelector('img[id=preview_1]');


                    if (sFileName.length > 0) {
                        var blnValid = false;
                        for (var j = 0; j < _validFileExtensions.length; j++) {
                            var sCurExtension = _validFileExtensions[j];
                            if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                                $("#msg-error2").html('');
                                blnValid = true;
                                break;
                            }
                        }
                        if (!blnValid) {
                            $("#msg-error2").html('<div class="alert alert-danger" role="alert"><b>' + nome + '</b> é um formato invalido <br> Use arquivos: <b>' + _validFileExtensions.join(", ") + '</b></div>');
                            oInput.value = "";
                            preview.src = "";
                            return false;
                        }
                    }
                }

                var reader = new FileReader();
                reader.onloadend = function() {
                    preview.src = reader.result;
                }
                if (imagem) {
                    reader.readAsDataURL(imagem);
                } else {
                    preview.src = "";
                }
                return true;
            }

            // insere o nome do arquivo no id indicado
        </script>

        <script src="bs-custom-file-input.js"></script>
        <script>
            bsCustomFileInput.init()
            var btn = document.getElementById('btnResetForm')
            var form = document.querySelector('form')
            btn.addEventListener('click', function() {
                form.reset()
            })
        </script>
</body>

</html>