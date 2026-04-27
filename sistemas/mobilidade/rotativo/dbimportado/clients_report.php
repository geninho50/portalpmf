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
            $("input.telefone_contato").mask("99-9999999999", {
                reverse: true
            });


        });
    </script>

   
</head>

<body>

    <!--CABECALHO -->
    <div class="container" role="main">

        <br>
        <div class="page-header rounded">
        <img src="http://redemobilidade.pmf.sc.gov.br/bas/img/cabecalho_02.jpg" class="img-fluid rounded" alt="Imagem responsiva">
        </div>
        <br>
        <div class="container border rounded border-primary" role="main">
            <br>
            <div align=left>
            <h4>    Base de Dados Implementada no Sistema Rotativo Público de Florianópolis <br>
                    SMPU (Versul - RIZZO) <br>
                    <br>

						Somente será concedida a autorização de acesso a esta base mediante preenchimento do cadastro e análise.
						O usuário cadastrado estará vinculado as previsões legais da Lei Geral de Proteção de Dados (Lei n.
						13.709, de 14 de agosto de 2018).
						</h4>
            </div><br>
            <!-- Formulário de Editar dados dos Usuários !-->


            <form method="post" id="formuser" action="acesso_db_clients_report_cadastrar.php">
                <span id="msg-error"></span>
                <span id="msg-error-2"></span>


                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="col-form-label">Nome Completo: </label>

                        <input name="nome" type="text" class="form-control" style="text-transform: uppercase;" id="nome" size="60" placeholder="Nome completo">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-form-label">Telefone: </label>
                        <input name="telefone_contato" type="text" class="telefone_contato form-control" id="telefone_contato" size="60" value="48" placeholder="Telefone de contato">
                    </div>
                </div>

                
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="col-form-label">E-mail(será o seu login): </label>
                        <input name="email" type="email" class="form-control" id="email" size="40" placeholder="Indique o melhor E-mail">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-form-label">Confirmar E-mail: </label>
                        <input name="rep_email" type="email" class="form-control" id="rep_email" size="40" placeholder="Confirmar E-mail">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-4">
                        <label class="col-form-label">RG: </label>
                        <input name="rg" type="text" id="rg" class="form-control" size="15" placeholder="RG" />
                    </div>
                    <div class="form-group col-4">
                        <label class="col-form-label">CPF: </label>
                        <input name="cpf" type="text" id="cpf" class="cpf form-control" size="20" placeholder="CPF" />
                    </div>
                    <div class="form-group col-4">
                        <label class="col-form-label">Órgão que está vinculado(Nome da Órgão): </label>
                        <input name="nome_orgao" type="text" id="nome_orgao" class="form-control" style="text-transform: uppercase;" size="70" placeholder="Nome do Órgão" />
                    </div>
                </div>

                <div class="form-row">
            

                    <div class="form-group col-12">
                        <label class="col-form-label">Descrever a Solitação e Justificativa): </label>
                        <textarea class="form-control" name="solicitacao" id="solicitacao" size="60"  rows="5"></textarea>
                    </div>
                    </div>


   <div class="form-row">
                <div class="form-group col-3">
                        <label class="col-form-label">senha: </label>
                        <input name="senha" id="senha" type="password" class="form-control" maxlength="8" placeholder="senha" />
                    </div>
                    <div class="form-group col-3">
                        <label class="col-form-label">confirmar senha: </label>
                        <input name="rep_senha" id="rep_senha" type="password" class="form-control" maxlength="8" placeholder="confirmar" />
                    </div>
                </div>
         
                <br>
                <div align=center>

                    <button type="submit" value="Cadastrar" class="btn btn-success" onclick="return validar()">Solicitar Cadastro</button>
                </div>
                
            </form><br>
            <div class="p-3 mb-2 bg-primary text-white">
            <h5> Prefeitura Municipal de Florianópolis</h5>
            <h6>Secretaria de Mobilidade e Planejamento Urbano </h6>
            Rua Felipe Schmidt, n° 1320 – Centro - CEP 88.010-002 – Florianópolis/SC.<br>
        </div>
        </div>
        </div><br>
      
        <br>
    </div>

    <script>
        function validar() {
            var nome = formuser.nome.value;
            var nome = nome.trim();
            var email = formuser.email.value;
            var email = email.trim();
            var rep_email = formuser.rep_email.value;
            var rep_email = rep_email.trim();
            var senha = formuser.senha.value;
            var rep_senha = formuser.rep_senha.value;
            var nome_orgao = formuser.nome_orgao.value;
            var solicitacao = formuser.solicitacao.value;
            var rg = formuser.rg.value;
            var cpf = formuser.cpf.value;
   
        
            if (nome == "") {
                $("#msg-error").html('<div class="alert alert-danger" role="alert">Necessário indicar responsável - Preencher o campo <b>Nome!</b></div>');
                formuser.nome.focus();
                return false;
            }

            if (email == "" || email.indexOf('@') == -1 || email.indexOf('.') == -1) {
                $("#msg-error").html('<div class="alert alert-danger" role="alert">Preencher corretamente o <b>E-mail!</b></div>');
                formuser.email.focus();
                return false;
            }

            if (rep_email !== email) {
                $("#msg-error").html('<div class="alert alert-danger" role="alert">Os e-mails devem ser <b>idênticos</b></div>');
                formuser.rep_email.focus();
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

            if (cpf != "") {

                var strCPF = formuser.cpf.value;
                strCPF = strCPF.replace(/[_\W]+/g, "");

                if (TestaCPF(strCPF) === false) {
                    $("#msg-error").html('<div class="alert alert-danger" role="alert"><b>CPF INVÁLIDO!</b></div>');
                    formuser.cpf.focus();
                    return false;
                }
            };

            if (nome_orgao == "") {
                $("#msg-error").html('<div class="alert alert-danger" role="alert">Preencher corretamente o <b>NOME DO ÓRGÃO!</b></div>');
                formuser.nome_orgao.focus();
                return false;
            }

            if (solicitacao == "") {
                $("#msg-error").html('<div class="alert alert-danger" role="alert">Preencher a <b> Solicitação e Justificativa</b>< do pedido de acesso !/div>');
                formuser.solicitacao.focus();
                return false;
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