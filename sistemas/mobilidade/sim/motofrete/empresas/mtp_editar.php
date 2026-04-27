<!--**
 	*  SMPU - Upload de cadastros qr-code
	*  cortesia: Michel Mittmann
 	*  lembre -se de conceder os créditos ao desenvolvedor.
 *-->
<?php
session_start();
include_once("conexao.php");
setlocale (LC_ALL, 'pt_BR.UTF8');
$id_cadastro = $_GET['id_cadastro']; //recebe da pagina anterior o numero do cadastro 
$query_02 = "SELECT * FROM sim.motofrete_profissional where id_cadastro  = '$id_cadastro'";
$resultado_02 = $conn->query($query_02);
$resultado_02_count = $resultado_02->rowCount();
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

    <!-- ler os elementos padrão das paginas !-->
    <script>
        $(document).ready(function() {
            $("#smpu_topo").load("/bas/smpu_topo.php");
            $("#smpu_rodape").load("/bas/smpu_rodape.php");
        });
    </script>


</head>

<body>

    <!--CABECALHO -->
    <div class="container" theme-showcase" role="main">

         <!-- TOPO --><div id="smpu_topo"></div><!-- TOPO -->
        

    <!--FIM CABECALHO -->


    <div class="container" theme-showcase" role="main">

        <?php

        if (($resultado_02_count != 0)) {
            while ($row = $resultado_02->fetch()) {
                $rg = substr($row['rg'], 0, strpos($row['rg'], '-'));
                $rg_orgao = substr($row['rg'], strpos($row['rg'], '-') + 1);
                $data_nascimento = date('d-m-Y', strtotime($row['data_nascimento']));
        ?>
                <form method="post" id="formuser" autocomplete="off" action="mtp_editardb.php">

                    <div class="container border rounded border-primary" role="main" id="div_form">
                        <h3 align=center>Editar Registro : <?php echo $row['id_cadastro']; ?> - <?php echo $row['nome']; ?>
                        </h3>
                        <span id="msg-error"></span>

                        <input name="id_cadastro" type="hidden" id="id_cadastro" value="<?php echo $id_cadastro ?>" />

                        <div class="form-row">
                            <div class="form-group col-6">
                                <label class="col-form-label">Nome: </label>
                                <input name="nome" type="text" id="nome" style="text-transform: uppercase;" class="form-control" size="70" autocomplete="off" placeholder="NOME COMPLETO" value="<?php echo $row['nome']; ?>" />
                            </div>
                                         <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label class="col-form-label">Nascimento: </label>
                                        <input name="data_nascimento" type="date" class="form-control" id="data_nascimento" value="<?php echo $row['data_nascimento']; ?>"/>
                                    </div>
                            <div class="form-group col-3">
                                <label class="col-form-label">CNH: </label>
                                <input name="cnh" type="text" id="cnh" class="rg form-control" size="15" placeholder="CNH(numeros)" autocomplete="off" value="<?php echo $cnh; ?>" />
                            </div>
                        
                            <div class="form-group col-3">
                                <label class="col-form-label">CPF: </label>
                                <input name="cpf" type="text" id="cpf" class="cpf form-control" onchange="validacpfdb();" size="20" placeholder="CPF do cadastro" readonly autocomplete="off" value="<?php echo $row['cpf']; ?>" />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="col-form-label">E-mail: </label>
                                <input name="email" type="email" class="form-control" id="email" size="40" placeholder="Indique o melhor E-mail" autocomplete="off" value="<?php echo $row['email']; ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="col-form-label">Telefone: </label>
                                <input name="telefone01" type="text" class="telefone form-control" id="telefone01" size="60" placeholder="Telefone de contato" autocomplete="off" value="<?php echo $row['telefone01']; ?>">
                            </div>
                        </div>

                        <hr>

                        <div class="row" id="form_endereco">
                            <div class="col-sm-12">
                                <h5>Endereço</h5>

                                <div class="input-group">
                                    <div class="row">
                                        <div class="form-group col-4">
                                            <label class="col-form-label">CEP:</label>
                                            <input name="cep" id="cep" type="text" class="cep form-control" maxlength="9" size="10" placeholder="Digite o CEP" value="<?php echo $row['cep']; ?>">
                                        </div>
                                        <div class="col-sm-4">
                                            <label class="col-form-label">Rua: </label>
                                            <input name="rua" type="text" id="rua" class="form-control form-control bg-secondary text-white" size="70" placeholder="Rua" value="<?php echo $row['rua']; ?>" />
                                        </div>
                                        <div class="col-sm-4">
                                            <label class=" col-form-label">Bairro: </label>
                                            <input name="bairro" type="text" id="bairro" class="form-control bg-secondary text-white" size="70" placeholder="Bairro" value="<?php echo $row['bairro']; ?>" />
                                        </div>


                                    </div>
                                </div>

                                <div class="input-group">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label class="col-form-label">Complemento: </label>
                                            <input name="complemento" type="text" id="complemento" class="form-control" size="70" placeholder="Número ou referência" value="<?php echo $row['complemento']; ?>" />
                                        </div>

                                        <div class="col-sm-4">
                                            <label class="col-form-label">Cidade:</label>
                                            <input name="cidade" type="text" id="cidade" class="form-control bg-secondary text-white" size="70" placeholder="Cidade" value="<?php echo $row['cidade']; ?>" />

                                        </div>
                                        <div class="col-sm-2">
                                            <label class="col-form-label">Estado:</label>
                                            <input name="uf" type="text" id="uf" class="form-control bg-secondary text-white" size="4" placeholder="UF" value="<?php echo $row['uf']; ?>" />

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div align=center>
                            <button type="submit" value="Cadastrar" class="btn btn-success" onclick="return validar()">Atualizar Cadastro</button>
                            <a href="morador_costa.php" class="btn btn-warning">Fechar | Voltar</a>
                        </div>
                        <br>

                    </div>

                </form>

                </div>

                <br>

                <div class="p-3 mb-2 bg-primary text-white">
                    <h5> Prefeitura Municipal de Florianópolis</h5>
                    <h6>Secretaria de Mobilidade e Planejamento Urbano </h6>
                    Rua Felipe Schmidt, n° 1320 – Centro - CEP 88.010-002 – Florianópolis/SC.<br>
                </div>




            <?php } ?>
        <?php
        } else {
            echo "<div class='alert alert-danger' role='alert'>Nenhum usuário encontrado!</div>";
        }
        ?>




    </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <script src="data_confirm.js"></script>
 
        <script>
        function validar() {
            var nome = formuser.nome.value;
            var nome = nome.trim();
            var cnh = formuser.cnh.value;
            var cep = formuser.cep.value;
     
            if (nome == "") {
                $("#msg-error").html('<div class="alert alert-danger" role="alert"> Necessário o campo <b>Nome!</b></div>');
                formuser.nome.focus();
                return false;
            }

            if (cnh == "") {
                $("#msg-error").html('<div class="alert alert-danger" role="alert">Preencher corretamente <b>CNH!</b></div>');
                formuser.cnh.focus();
                return false;
            }
      
            if (cep == "") {
                $("#msg-error").html('<div class="alert alert-danger" role="alert">Preencher corretamente o <b>CEP</b></div>');
                formuser.cep.focus();
                return false;
            }
            $("#msg-error").html('<div class="alert alert-success" role="alert">Registro Válido</div>');
            return;
        };

       
    </script>

</body>

</html>