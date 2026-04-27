<?php
include_once("../banco/gdb.php");
$gdb = new gdb();
$idAnimal = $gdb->vargetpost('idAnimal');

$ip = $_SERVER['REMOTE_ADDR'];
$ip_interesse = $ip;

?>
<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet"> 
    <link rel="shortcut icon" type="image/x-icon" href="img/2093faviconpmf.ico">
    <title>Adote</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="../index.php">
                <img id="logo" src="../img/logosdp5.png" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse flex-row-reverse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link" href="index.php"><span>Home</span></a>
                    <a class="nav-item nav-link" href="../adm/login.php"><span>Administração</span></a>
                </div>
            </div>
        </nav>
    </header>
    <div class="container" style="border: 1px;">
        <h1>Interesse de Adoção</h1>
        <p class="text-center"><b>ATENÇÂO:</b><br>
            1-Adoções apenas para maiores de 18 anos e moradores do município de Florianópolis.<br>
            2-O processo de adoção passa por cadastro de intenção, análise, entrevista e visita na residência do adotante.<br>
            3-Não garantimos que o animal escolhido na plataforma esteja disponível na entrega dos documentos na Diretoria de Bem Estar Animal,<br>
            devido a rotatividade de adoções. Por isso é tão importante que todos documentos sejam entregues o quanto antes no órgão.</p>
        <h3>Dados Gerais</h3>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="nome_pessoa">Nome</label>
                <input type="text" class="form-control" id="nome_pessoa" name="nome_pessoa" placeholder="Nome do Interessado">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="cpf">CPF</label>
                <input type="text" class="form-control" id="cpf" name="cpf" placeholder="XXX.XXX.XXX-XX">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="telefone">Telefone</label>
                <input type="text" class="form-control" id="telefone" name="telefone" placeholder="(XX) XXXXX-XXXX">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="celular">Celular</label>
                <input type="text" class="form-control" id="celular" name="celular" placeholder="(XX) XXXXX-XXXX">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="email">E-mail</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="adote@pmf.sc.gov.br">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="email">Confirmar E-mail</label>
                <input type="text" class="form-control" id="confirmaremail" name="confirmaremail" placeholder="adote@pmf.sc.gov.br">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="cep">CEP</label>
                <input type="text" class="form-control" id="cep" name="cep" maxlength="8" placeholder="88010102 (Somente números)">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="endereco">Endereço</label>
                <input type="text" class="form-control" readonly="readonly" id="endereco" name="endereco" placeholder="Rod. José Carlos Daux">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="bairro">Bairro</label>
                <input type="text" class="form-control" readonly="readonly" id="bairro" name="bairro" placeholder="Itacorubi">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="numero">Número</label>
                <input type="text" class="form-control" id="numero" name="numero" placeholder="114">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="complemento">Complemento</label>
                <input type="text" class="form-control" id="complemento" name="complemento">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <div class="form-check form-check-inline">
                    <label for="aceite">Aceito os termos e condições gerais para uso da plataforma de adoção da Diretoria do Bem Estar Animal. </label> 
                    <input type="checkbox" class="form-control" id="aceite" name="aceite" value="1">
                </div>
                <a href="../pdf/termo_adesao_dibea.pdf" target="_blank">Ver termo de aceite</a>
            </div>
        </div>
        <input name="btnSubmit" onclick="javascript:incluirInteresse();" id="btnSubmit" class="btn btn-primary botao" value="Enviar">

        <br><br><br>
    </div>

    <footer>
        <div class="text-center">
            <h3 class="text-uppercase">Diretoria de Bem Estar Animal</h3>
            <p style="color:#fff; font-weight:bold;">Horário de funcionamento: Segunda a Sexta das 08:00 às 17:00<br>Endereço: SC-401, 114 - Itacorubi, Florianópolis - SC, 88010-102<br>Contato: (48) 3234-5677</p>
            <p><a href="http://www.pmf.sc.gov.br/entidades/bemestaranimal/index.php"><img src="../img/prefeitura.png" alt="Logo da Prefeitura de Florianópolis"/></a></p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="../js/jquery.scrollex.min.js"></script>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/skel.min.js"></script>
    <script src="../js/util.js"></script>
    <script src="../js/main.js"></script>
    <script>
        $(document).ready(function(){
            $("#cep").change(function () {
                if($("#cep").val() < 88000001 || $("#cep").val() > 88099999){
                    alert("Não é possível cadastrar interesse para pessoas de fora de Florianópolis.");
                } else {
                    $.get( "https://viacep.com.br/ws/"+$("#cep")[0].value+"/json/").done(function( data ) {
                        $("#endereco")[0].value = data.logradouro;
                        $("#bairro")[0].value = data.bairro;
                    }).fail(function () {
                        alert("CEP não encontrado.");
                    });
                }
            });
        });
    </script>
</body>

<script>
    function incluirInteresse() {
        if ($('#nome_pessoa').val() == '') {
            alert('Informe o seu nome!');
            $('#nome_pessoa').focus();
        } else if ($('#cpf').val() == '') {
            alert('Informe o seu CPF!');
            $('#cpf').focus();
        } else if ($('#telefone').val() == '') {
            alert('Selecione o seu telefone!');
            $('#telefone').focus();
        } else if ($('#celular').val() == '') {
            alert('Informe o seu celular!');
            $('#celular').focus();
        } else if ($('#email').val() == '') {
            alert('Informe o seu email!');
            $('#email').focus();
        } else if ($('#cep').val() == '') {
            alert('Informe o seu CEP!');
            $('#cep').focus();
        } else if ($('#numero').val() == '') {
            alert('Selecione o seu número!');
            $('#numero').focus();
        } else if($('#email').val() != '' && $('#email').val() != $('#confirmaremail').val() ) {
            alert('Os emails devem ser iguais!');
            $('#confirmaremail').focus();
        } else if($('#aceite').val() == '') {
            alert('Confirme a aceitação do termo e condições gerais!');
            $('#aceite').focus();
        } else {
            var ArrayAceite = [];
            if($("#aceite")[0].checked) {
                ArrayAceite.push($("#aceite")[0].value);
            } else {
                alert('Confirme a aceitação do termo e condições gerais!');
            }
            var form_data = new FormData();                  

            form_data.append('id_animal', <?=$idAnimal;?>);
            form_data.append('nome_pessoa', $('#nome_pessoa').val());
            form_data.append('cpf', $('#cpf').val());
            form_data.append('telefone', $('#telefone').val());
            form_data.append('celular', $('#celular').val());
            form_data.append('email', $('#email').val());
            form_data.append('cep', $('#cep').val());
            form_data.append('endereco', $('#endereco').val());
            form_data.append('bairro', $('#bairro').val());
            form_data.append('numero', $('#numero').val());
            form_data.append('complemento', $('#complemento').val());
            form_data.append('ip_interesse', '<?=$ip_interesse;?>');
            form_data.append('aceite', ArrayAceite);

            $.ajax({
                type: "POST",
                url: "../banco/incluirInteresse.php",
                dataType: "text",
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                success: function(data) {
                    let response = JSON.parse(data);
                    if (response['success'] == '1') {
                        var form_data_email = new FormData();
                        form_data_email.append('para', $('#email').val());  
                        $.ajax({
                            type: "POST",
                            url: "../email/enviaremail.php",
                            dataType: "text",
                            cache: false,
                            contentType: false,
                            processData: false,
                            data: form_data_email,
                            success: function(response) {
                                if (response == 1) {
                                    alert("Seu interesse de adoção foi incluído com sucesso!");
                                    window.location.href = "http://www.pmf.sc.gov.br/sistemas/adote/";
                                } else {
                                    alert('Ocorreu um problema no envio do e-mail.');
                                    window.location.href = "http://www.pmf.sc.gov.br/sistemas/adote/";
                                }
                            },
                            error: function(data) {
                                alert('Ocorreu um problema no envio do e-mail.');
                                window.location.href = "http://www.pmf.sc.gov.br/sistemas/adote/";
                            }
                        });
                    } else {
                        alert(response['error']);
                    }
                },
                error: function(data) {
                    let response = JSON.parse(data);
                    alert(response['error']);
                }
            });
        }
    }

    function validacao() {
        document.getElementById("cadastro").style.display = "block";
        document.getElementById("btnEntrar").style.display = "none";
    }
</script>
</html>