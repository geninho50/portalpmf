<!--**
 	*  SMPU - Upload de cadastros qr-code
	*  cortesia: Michel Mittmann
 	*  lembre -se de conceder os créditos ao desenvolvedor.
 *-->

<?php
include_once("conexao.php");
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

    <!-- máscaras para input formularios !-->
    <script type="text/javascript" src="jquery.maskedinput-1.1.4.pack.js"></script>
    <script src="formrules.js"></script>

    <style>
        .pequeno {
            width: 30px;
        }
        .medio {
            width: 50%;
        }
    </style>

</head>

<body>

    <!--CABECALHO -->
    <div class="container" theme-showcase" role="main">
        <br>
        <div class="page-header rounded">
            <img src="img\cabecalho_03.jpg" class="img-fluid rounded" alt="Imagem responsiva">
        </div>
        <div class="container" role="main">
            <br>
            <!-- Fim imagem cabeçalho -->
            <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
                <div class="btn-group mr-2" role="group" aria-label="1 group">
                    <form method="POST" action="" enctype="multipart/form-data">
                        <div class="botton-group row">
                            <div class="button-group mr-2">
                                <a type="button" class="btn btn-outline-info" href="cadastro_ok.php" role="button">cadastro_ok</a>
                            </div>
                            <div class="button-group mr-2 ">
                                <input type="text" class="input-search btn btn-outline-secondary" alt="lista-clientes" placeholder="Buscar nesta lista" />
                            </div>
                        </div>
                    </form>
                </div>
                <div class="btn-group mr-2" role="group" aria-label="3">
                    <!-- Botoes desabilitados
                    <a type="button" class="btn btn-outline-info" href="" role="button">DashBoard</a>
                    <a type="button" class="btn btn-outline-info" href="relatorios_extras.php" role="button">Relatórios</a>
                        !-->
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
                    <td><b><a class="text-default">#</a></b></td>
                    <td><b><a class="text-default">Nome<br>CPF<br>Identidade</a></b></td>
                    <td><b><a class="text-default">Endereço</a></b></td>
                    <td><b><a class="text-default">Email<br>
                                Telefone</a></b></td>
                    <td><b><a class="text-default">data cadastro</a></b></td>
                    <td><b><a class="text-default">Ação</a></b></td>
                </tr>
                <?php while ($row = $resultado_02->fetch()) { ?>
                    <tr>
                        <td width=3%><?php echo $row['id']; ?></td>
                        <td width=auto> <?php echo $row['nome_passageiro']; ?><br>
                            <?php echo $row['cpf']; ?><br><?php echo $row['rg']; ?>
                        </td>
                        <td width=15%><?php echo $row['cep']; ?><br><?php echo $row['rua']; ?> <?php echo $row['complemento']; ?>
                            <br> <?php echo $row['bairro']; ?> </td>
                        <td width=10%><?php echo $row['email']; ?> <br><?php echo $row['telefone01']; ?> </td>
                        <td width=auto><?php echo $row['data_criado']; ?></td>
                        <td>
                            <button type="button" class="btn btn-outline-info btn-sm fa fa-info pequeno" data-toggle="modal" data-target="#MODALuser_visualizar<?php echo $row['id']; ?>"></button>
                            <a type="button" class="btn btn-outline-warning btn-sm fa fa-pencil-square-o pequeno" href="edit_usuario.php?id=<?php echo $row['id'] ?>" role="button"></a>
                            <button type="button" class="btn btn-outline-danger btn-sm fa fa-trash pequeno" data-toggle="modal" data-target="#MODALuser_apagar" data-var_id="<?php echo $row['id']; ?>" data-var_nome="<?php echo $row['nome']; ?>" data-var_email="<?php echo $row['email']; ?>"></button>
                        </td>
                    </tr>

                <?php } ?>
            </table>
        <?php
    } else {
        echo "<div class='alert alert-danger' role='alert'>Nenhum usuário encontrado!</div>";
    }
        ?>

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
                                <p id="showuser" class="text-muted"></p>
                            </h5>
                            <h6>
                                <p id="shownome" class="text-muted"></p>
                                <p id="showemail" class="text-muted"></p>
                            </h6>
                        </strong>
                    </div>
                    <div class="modal-footer">
                        <form method="POST" action="user_apagar.php" enctype="multipart/form-data">
                            <input name="id" type="hidden" class="form-control" id="id-user">
                            <button type="button" class="btn btn-info" data-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-danger">Confirmar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL Apagar Dados Usuários-->

        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
        <script src="data_confirm.js"></script>

        <script type="text/javascript">
            $('#MODALuser_apagar').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                //extrai atributos data-
                var recipient = button.data('var_id')
                var recipientnome = button.data('var_nome')
                var recipientemail = button.data('var_email')
                var modal = $(this)
                //variaveis
                modal.find('#id-user').val(recipient)
                //textos
                modal.find('#shownome').text('Nome : ' + recipientnome)
                modal.find('#showemail').text('Email : ' + recipientemail)
                modal.find('#showuser').text('Apagar registro ID : ' + recipient)
            })



            function validar() {
                var nome = formuser.nome.value;
                var nome = nome.trim();
                var usuario = formuser.usuario.value;
                var usuario = usuario.trim();
                var email = formuser.email.value;
                var email = email.trim();
                var matricula = formuser.matricula.value;

                var cpf = formuser.cpf.value;
                var senha = formuser.senha.value;
                var rep_senha = formuser.rep_senha.value;

                //VARIAVEIS TESTE CPF

                var strCPF = formuser.cpf.value;
                strCPF = strCPF.replace(/[_\W]+/g, "");


                if (nome == "") {
                    $("#msg-error").html('<div class="alert alert-danger" role="alert">Preencher o campo <b>Nome!</b></div>');
                    formuser.nome.focus();
                    return false;
                }

                $.ajax({
                    url: 'user_analisa.php',
                    type: 'POST',
                    data: {
                        "nome": nome

                    },
                    success: function(data) {
                        data = $.parseJSON(data);
                        if (data.nome) {
                            $("#msg-error").html('<div class="alert alert-danger" role="alert">Pessoa já cadastrada no sistema!</div>');
                            formuser.nome.focus();
                            document.getElementById("nome").select();
                            document.getElementById('nome').value = "";
                        }
                    }
                });

                if (usuario == "") {
                    $("#msg-error").html('<div class="alert alert-danger" role="alert">Preencher o campo <b>Usuário</b></div>');
                    formuser.usuario.focus();
                    return false;
                }

                $.ajax({
                    url: 'user_analisa.php',
                    type: 'POST',
                    data: {
                        "usuario": usuario

                    },
                    success: function(data) {
                        data = $.parseJSON(data);
                        if (data.usuario) {
                            $("#msg-error").html('<div class="alert alert-danger" role="alert">nome de <b>usuário</b> já em uso!</div>');
                            formuser.usuario.focus();
                            document.getElementById("usuario").select();
                            document.getElementById('usuario').value = "";
                        }
                    }
                });

                if (email == "" || email.indexOf('@') == -1 || email.indexOf('.') == -1) {
                    $("#msg-error").html('<div class="alert alert-danger" role="alert">Preencher corretamente o <b>E-mail<!/b></div>');
                    formuser.email.focus();
                    return false;
                }

                $.ajax({
                    url: 'user_analisa.php',
                    type: 'POST',
                    data: {
                        "email": email
                    },
                    success: function(data) {
                        data = $.parseJSON(data);
                        if (data.email) {
                            $("#msg-error").html('<div class="alert alert-danger" role="alert"><b>E-mail</b> já em uso!</div>');
                            formuser.usuario.focus();
                            document.getElementById("email").select();
                            document.getElementById('email').value = "";
                        }
                    }
                });

                if (matricula == "") {
                    $("#msg-error").html('<div class="alert alert-danger" role="alert">Preencher corretamente a <b>Matrícula</b></div>');
                    formuser.matricula.focus();
                    return false;
                }

                $.ajax({
                    url: 'user_analisa.php',
                    type: 'POST',
                    data: {
                        "matricula": matricula
                    },
                    success: function(data) {
                        data = $.parseJSON(data);
                        if (data.matricula) {
                            $("#msg-error").html('<div class="alert alert-danger" role="alert"><b>Matrícula</b> já em uso!</div>');
                            formuser.usuario.focus();
                            document.getElementById("matricula").select();
                            document.getElementById('matricula').value = "";
                        }
                    }
                });

                if (cpf != "" || cpf == "") {
                    $.ajax({
                        url: 'user_analisa.php',
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

                if (senha == "" || senha.length <= 5) {
                    $("#msg-error").html('<div class="alert alert-danger" role="alert">A <b>senha</b> deve conter no mínimio 6 caracteres!</div>');
                    formuser.senha.focus();
                    return false;
                }

                if (rep_senha == "" || rep_senha.length <= 5) {
                    $("#msg-error").html('<div class="alert alert-danger" role="alert">A <b>senha</b> deve conter no mínimio 6 caracteres 2!</div>');
                    formuser.rep_senha.focus();
                    return false;
                }

                if (senha != rep_senha) {
                    $("#msg-error").html('<div class="alert alert-danger" role="alert">As <b>senhas</b> devem ser iguais!</div>');
                    formuser.rep_senha.focus();
                    return false;
                }

                $("#msg-error").html('<div class="alert alert-success" role="alert">Registro Válido</div>');

            };

            function limpa() {
                if (document.getElementById('nome').value != "" ||
                    document.getElementById('usuario').value != "" ||
                    document.getElementById('email').value != "" ||
                    document.getElementById('matricula').value != "" ||
                    document.getElementById('cpf').value != "" ||
                    document.getElementById('senha').value != "" ||
                    document.getElementById('rep_senha').value != ""

                ) {
                    $("#msg-error").html('<div class="alert alert-danger" role="alert">Formuário Limpo!</div>');

                    document.getElementById('nome').value = "";
                    document.getElementById('usuario').value = "";
                    document.getElementById('email').value = "";
                    document.getElementById('matricula').value = "";
                    document.getElementById('cpf').value = "";
                    document.getElementById('senha').value = "";
                    document.getElementById('rep_senha').value = "";
                    formuser.nome.focus();

                } else

                {
                    $("#msg-error").html('<div class="alert alert-success" role="alert">Preencher</div>');
                    formuser.nome.focus();
                    document.getElementById('nome').value === "";
                    document.getElementById('usuario').value = "";
                    document.getElementById('email').value = "";
                    document.getElementById('matricula').value = "";
                    document.getElementById('cpf').value = "";
                    document.getElementById('senha').value = "";
                    document.getElementById('rep_senha').value = "";

                }
            };
        </script>

</body>

</html>