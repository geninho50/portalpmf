<!--**
    * Listagem de Usuarios
    * Cortesia: Michel Mittmann
 *-->
 <?php
include_once("conexao.php");
require_once('../login/session_status.php');header('Content-type: text/html; charset=UTF-8');
setlocale(LC_ALL, 'pt_BR.UTF8');
?>

<!DOCTYPE HTML>
<html lang="pt-br">
<head>
<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <meta name="description" content="SMPU Login">
  <meta name="author" content="Michel Mittmann">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/bas/js/javascriptpersonalizado.js"></script>
    <script type="text/javascript" src="/bas/js/javascript_frota.js"></script>
    <script src="/bas/js/sorttable.js"></script>
   

    <script type="text/javascript" src="/bas/js/jquery.quick.search.js"></script>
    <script type="text/javascript" src="/home/www/sistemas/redemobilidade/cidadao/moradores_costa/js/jquery.js"></script>
    <script type="text/javascript" src="/bas/js/jquery.maskedinput-1.1.4.pack.js"></script>
    <script src="/bas/js/formrules.js"></script>
    <script src="/bas/js/cep.js"></script> <!-- análise de CEP !-->
    <script src="/bas/js/masks.js"></script> <!-- máscaras para input formularios !-->
    <script type="text/javascript" src="/bas/js/jquery.mask.min.js"></script>
    <script type="text/javascript" src="/bas/js/jquery-ui.min.js"></script>
    <script src="https://compressjs.herokuapp.com/compress.js"></script>
    <script>
        $(document).ready(function() {
            $("#smpu_topo").load("/bas/smpu_topo.php");
            $("#smpu_rodape").load("/bas/smpu_rodape.php");
        });
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
   

    <style>
        .pequeno {
            width: 30px;
        }
        .medio {
            width: 50%;
        }
 
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
        <!-- TOPO -->
        <div id="smpu_topo"></div>
        <!-- TOPO -->
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
    $query_02 = "SELECT * FROM login.usuarios ORDER BY id DESC";
    $resultado_02 = $conn->query($query_02);
    $resultado_02_count = $resultado_02->rowCount();

    if (($resultado_02_count != 0)) { 
         
        ?>

        <div class="container" theme-showcase" role="main">

            <table id="dtBasicExample" class="sortable lista-clientes table table-striped table-hover table-sm" cellspacing="0" width="100%">
                <tr class="table-primary">
                    <td><b><a class="text-default">#</a></b></td>
                    <td><b><a class="text-default">Nome</a></b></td>
                    <td><b><a class="text-default">User</a></b></td>
                    <td><b><a class="text-default">Matricula</a></b></td>
                    <td><b><a class="text-default">Email</a></b></td>
                    <td><b><a class="text-default">Sigla</a></b></td>
                    <td><b><a class="text-default">Origem</a></b></td>
                    <td><b><a class="text-default">NA</a></b></td>
                    <td><b><a class="text-default">Ação</a></b></td>
                </tr>
                <?php while ($row_usuario = $resultado_02->fetch()) { ?>
                    <tr>
                        <td width=3%><?php echo $row_usuario['id']; ?></td>
                        <td width=auto><?php echo $row_usuario['nome']; ?></td>
                        <td width=8%><?php echo $row_usuario['usuario']; ?></td>
                        <td width=8%><?php echo $row_usuario['matricula']; ?></td>
                        <td width=10%><?php echo $row_usuario['email']; ?></td>
                        <td width=10%><?php echo $row_usuario['sigla']; ?></td>
                        <td width=6%><?php echo $row_usuario['origem']; ?></td>
                        <td width=auto><?php echo $row_usuario['nivel_acesso']; ?></td>
                        <td>
                            <button type="button" class="btn btn-outline-info btn-sm fa fa-info pequeno" data-toggle="modal" data-target="#MODALuser_visualizar<?php echo $row['id']; ?>"></button>
                            <a  type="button" class="btn btn-outline-warning btn-sm fa fa-pencil-square-o pequeno" href="edit_usuario.php?id=<?php echo $row_usuario['id'] ?>" role="button"></a >
                            <button type="button" class="btn btn-outline-danger btn-sm fa fa-trash pequeno" data-toggle="modal" data-target="#MODALuser_apagar" data-var_id="<?php echo $row_usuario['id']; ?>" data-var_nome="<?php echo $row_usuario['nome']; ?>" data-var_email="<?php echo $row_usuario['email']; ?>"></button>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        <?php
    } else {
        echo "<div class='alert alert-danger' role='alert'>Nenhum usuário encontrado!</div>";
    }
        ?>

    
  <?php include_once("user_formulario.php"); ?>

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

        <script src="user_formulario.js"></script>
  

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
      
        </script>

</body>

</html>