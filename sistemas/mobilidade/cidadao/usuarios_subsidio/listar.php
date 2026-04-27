<!--**
 	*  SMPU - Upload de cadastros qr-code
	*  cortesia: Michel Mittmann
 	*  lembre -se de conceder os créditos ao desenvolvedor.

Estudante

Carteira de identidade com CPF.
Comprovante de matricula original devidamente carimbado e assinado
Comprovante de residência original e recente (menos de 30 dias)

Cartão idoso
•	O que é?
Os cartões especiais atendem usuários com direito à gratuidade no transporte coletivo convencional de Florianópolis. 
•	Requisitos
Ter no mínimo 65 anos de idade.
•	Como obtê-lo?
Para adquirir é necessário comparecer pessoalmente com os documentos obrigatórios no Passe Rápido no TICEN.
Documentos obrigatórios:
Carteira de identidade (RG) expedida há menos de 10 anos com cópia. 
Comprovante de residência original e cópia (menos de 30 dias)


pcd
Atestado médico e demais comprovações que atestem a deficiência permanente por requerente do benefício desta gratuidade
Copia carteira de identidade (RG) expedida há menos de 10 anos
Copia comprovante de cadastro de pessoa física (CPF) 

Estudante Social 
•	O que é?
O cartão estudante social dá o direito à gratuidade nas passagens das linhas convencionais do transporte coletivo municipal para alunos moradores de baixa renda na Capital. 
•	Requisitos 
Ser estudante matriculado em instituição de ensino fundamental, medico, técnico, superior, pré-vestibulares ou em cursos de especialização com duração superior a três meses, todos reconhecidos pelo MEC. 
Ter renda familiar de até dois salários mínimos e possuir inscrição vigente no Cadastro Único para Programas Sociais do Governo Federal (CadÚnico) ou ser beneficiário do Programa Bolsa Família. 
Ser residente do município de Florianópolis.
•	 Como obtê-lo? 
Para adquirir é necessário comparecer com os documentos obrigatórios no atendimento da SMMU no TICEN.
Carteira de identidade com CPF.
Comprovante de matricula original devidamente carimbado e assinado
Comprovante de residência original e recente (menos de 30 dias)
Comprovante de inscrição vigente no CadÚnico




 *-->



<?php
require_once('/home/www/sistemas/redemobilidade/login/session_status.php');
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

</head>

<body>

    <!--CABECALHO -->
    <div class="container" theme-showcase" role="main">
        <!-- TOPO -->
        <div id="smpu_topo"></div>
        <!-- TOPO -->
        <div class="container" role="main">
            <br>
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
        <!-- RODAPE-->
        <div id="smpu_rodape"></div><!-- RODAPE-->

        <?php

        $query_02 = "SELECT * FROM sim.usuarios_subsidio";
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
                                    <a class="btn btn-danger btn-sm" href="ficha.php?id_cadastro=<?php echo $row['id_cadastro'] ?>" role="button"><?php echo $status ?></a>
                                <?php } elseif ($row['status'] == '2') {
                                    $status = "registrado";
                                ?>
                                    <a class="btn btn-success btn-sm" href="ficha.php?id_cadastro=<?php echo $row['id_cadastro'] ?>" role="button"><?php echo $status ?></a>

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
                            <h5 class="modal-title" id="MODALuser_cadastrar">Cadastrar Usuário Subsídios</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" id="formuser" autocomplete="off" action="cadastrar.php">
                                <div class="form-row">
                                    <div class="col col-md-12">
                                        <select class="form-control bg-info text-white" id="categoria" name="categoria">
                                            <option selected value="">Escolha a categoria do cadastro...</option>
                                            <option value="Social">Social</option>
                                            <option value="Social Especial">Social Especial - Estudante Social</option>
                                            <option value="Estudante">Estudante</option>
                                            <option value="PCD">PCD</option>
                                            <option value="Idoso">Idoso</option>
                                        </select>
                                    </div>
                                </div>
                                <div><br>
                                    <span id="msg-error"></span>
                                </div>
                                <div id="div_form" style="display:none">
                                    <div class="form-row">
                                        <div class="form-group col-5">
                                            <label class="col-form-label">Nome: </label>
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
                                            <input name="telefone01" type="text" class="telefone form-control" id="telefone01" size="60" placeholder="Telefone de contato" autocomplete="off">
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


                                    <div class="row" id="upload_estudante" style="display:none">
                                        <div class="col-sm-12">
                                            <h5>Estudante</h5>
                                            <div class="form-row">
                                                <div class="form-group col-3">
                                                    <label class="text-muted">Validade</label>
                                                    <input name="validade1" type="date" id="validade_estudante" class="form-control" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row" id="upload_social_especial" style="display:none">
                                        <div class="col-sm-12">
                                            <h5>Social Especial - Estudante Social</h5>
                                            <div class="form-row">
                                                <div class="form-group col-3">
                                                    <label class="col-form-label">NIS:</label>
                                                    <input name="nis"  type="text" class="form-control" id="nis_social_especial" maxlength="12" size="10" placeholder="NIS" />
                                                </div>
                                                <div class="form-group col-3">
                                                    <label class="text-muted">Validade</label>
                                                    <input name="validade1" type="date" id="validade_social_especial" class="form-control" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row" id="upload_social" style="display:none">
                                        <div class="col-sm-12">
                                            <h5>Social</h5>
                                            <div class="form-row">
                                                <div class="form-group col-3">
                                                    <label class="col-form-label">NIS:</label>
                                                    <input name="nis" id="nis_social" type="text" class="form-control" maxlength="12" size="10" placeholder="NIS" />
                                                </div>
                                                <div class="form-group col-3">
                                                    <label class="col-form-label">Validade</label>
                                                    <input name="validade1" type="date" id="validade_social" class="form-control" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row" id="upload_pcd" style="display:none">
                                    <div class="col col-md-6">
                                    <h5>PCD</h5>
                                    <label class="col-form-label">Modalidade:</label>
                                        <select class="form-control" id="pcd_deficiencia" name="pcd_deficiencia">
                                            <option selected value="">Escolha a modalidade da deficiência</option>
                                            <option value="AUDITIVO">Auditivo</option>
                                            <option value="FÍSICO">Físico</option>
                                            <option value="MENTAL">Mental</option>
                                            <option value="VISUAL">Visual</option>
                                            <option value="LC41">LC 417</option>
                                            <option value="LC648">LC 648</option>
                                        </select>
                                    </div>
                                    </div>

                                </div>



                               




                                <div class="modal-footer">
                                    <button type="button" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
                                    <button type="button" value="Limpar" class="btn btn-danger" onClick="limpa1()">Limpar</button>
                                    <button type="submit" value="Cadastrar" class="btn btn-success" onclick="return validar()">Cadastrar</button>
                                </div>
                        </div>

                        </form>
                    </div>
                </div>
                <!-- FIM MODAL cadastrar Usuários-->
            </div>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
            <script src="data_confirm.js"></script>
            <script src="listar.js">
            </script>
            <script src="bs-custom-file-input.js"></script>
</body>

</html>