<?php

include_once("banco/gdb.php");
$gdb = new gdb();
?>

<!doctype html>
<html lang="pt-br">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Minhoca na Cabeça</title>
    <link href="../../../layout/imagens/brasao.gif" rel="shortcut icon" type="image/x-icon" />
    <link rel="icon" href="img/favicon.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- animate CSS -->
    <link rel="stylesheet" href="css/animate.css">
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <!-- themify CSS -->
    <link rel="stylesheet" href="css/themify-icons.css">
    <!-- flaticon CSS -->
    <link rel="stylesheet" href="css/flaticon.css">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="css/magnific-popup.css">
    <!-- swiper CSS -->
    <link rel="stylesheet" href="css/slick.css">
    <link rel="stylesheet" href="css/gijgo.min.css">
    <link rel="stylesheet" href="css/nice-select.css">
    <link rel="stylesheet" href="css/all.css">
    <!-- style CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!--::header inicio::-->
    <header class="main_menu home_menu menu_fixed animated fadeInDown">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <a class="navbar-brand" href="index.php"> <img src="img/logom.jpg" id="logo" class="img-fluid" alt="logo"> </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="menu_icon"><i class="ti-menu"></i></span>
                        </button>

                        <div class="collapse navbar-collapse main-menu-item" id="navbarSupportedContent">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php">Home</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- Header final-->

    <!-- inscrição inicio -->
    <section class="philosophy_part section_padding">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-12 col-md-12">
                    <div class="philophy_text">
                        <h5>Faça sua inscrição</h5>
                        <div class="card-deck">
                            <div class="card">
                                <div class="card-body">
                                    <h2>Dados do Participante</h2>
                                    <p><b>Todos dos dados devem ser preenchidos</p>
                                    <p><b>Ao finalizar a incrição faça login com seu e-mail e senha, ao final da página de início você vai encontrar um campo onde poderá visualizar seu comprovante de inscriçao, imprima-o e leve-o no dia da Oficina.</p> <br>
                                    <form id="frm">
                                        <div class="form-group">
                                            <label for="nome">Nome</label>
                                            <input type="text" class="form-control" id="nome" placeholder="Nome completo">
                                        </div>
                                        <div class="form-group">
                                            <label for="cpf">CPF</label>
                                            <input type="text" class="form-control" id="cpf" aria-describedby="emailHelp" placeholder="(Somente números)">
                                        </div>
                                        <div class="form-group">
                                            <label for="data_nascimento">Data de nascimento</label>
                                            <input type="text" class="form-control" id="data_nascimento">
                                        </div>
                                        <div class="form-group">
                                            <label for="profissao">Profissão</label>
                                            <input type="text" class="form-control" id="profissao">
                                        </div>
                                        <div class="form-group">
                                            <label for="rg">RG</label>
                                            <input type="text" class="form-control" id="rg" placeholder="(Somente números)">
                                        </div>
                                        <div class="form-group">
                                            <label for="cep">CEP</label>
                                            <input type="text" class="form-control" id="cep" name="cep" maxlength="8" placeholder="Ex.: 88010102 (Somente números)">
                                        </div>
                                        <div class="form-group">
                                            <label for="logradouro">Endereço</label>
                                            <input type="text" class="form-control" id="logradouro" readonly="readonly" placeholder="(Nome da rua)">
                                        </div>
                                        <div class="form-group">
                                            <label for="complemento">Complemento</label>
                                            <input type="text" class="form-control" id="complemento">
                                        </div>
                                        <div class="form-group">
                                            <label for="numero">Número</label>
                                            <input type="text" class="form-control" id="numero" placeholder="(Somente números)">
                                        </div>
                                        <div class="form-group">
                                            <label for="bairro">Bairro</label>
                                            <input type="text" class="form-control" id="bairro" readonly="readonly">
                                        </div>
                                        <div class="form-group">
                                            <label for="cidade">Município</label>
                                            <input type="text" class="form-control" id="cidade" readonly="readonly">
                                        </div>
                                        <div class="form-group">
                                            <label for="quantidade_pessoa">Número de moradores na residência</label>
                                            <input type="text" class="form-control" id="quantidade_pessoa" placeholder="(Somente números)">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">E-mail</label>
                                            <input type="text" class="form-control" id="email">
                                        </div>
                                        <div class="form-group">
                                            <label for="telefone">Telefone</label>
                                            <input type="text" class="form-control" id="telefone">
                                        </div>
                                        <div class="form-group">
                                            <label for="celular">Celular</label>
                                            <input type="text" class="form-control" id="celular">
                                        </div>
                                        <div class="form-group">
                                            <label for="senha">Senha (Mínimo 6 e máximo 10 caracteres)</label>
                                            <input type="password" class="form-control" id="senha">
                                        </div>
                                        <div class="form-group">
                                            <label for="rsenha">Repita a senha</label>
                                            <input type="password" class="form-control" id="rsenha">
                                        </div>
                                        <input type="button"  class="btn_1" name="btnSubmit" onclick="update()"  id="btnSubmit"  value="Enviar">
                                    </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- inscrição fim -->


    <!-- footer inicio -->
    <footer class="footer_Part padding_top">
        <hr width = 100% align = right noshade>
        <div class="rodape">
            <div class="caixa">
                <img src="img/caixa.png" class="" alt="Caixa">
            </div>
            <div class="comcap">
                <img src="img/comcap.png" class="" alt="Comcap">
            </div>
            <div class="pmf">
                <img src="img/pmf.png" class="" alt="PMF">
            </div>
            <div class="fmna">
                <img src="img/fnma.png" class="" alt="FNMA">
            </div>
            <div class="ma">
                <img src="img/ministerio-meio.png" class="" alt="Ministério do Meio Ambiente">
            </div>
            <div class="gf">
                <img src="img/governo-federal.png" class="" alt="Governo Federal">
            </div>
        </div>
    </footer>
    <!-- footer fim -->

    <!-- jquery plugins here-->
    <script src="js/jquery-1.12.1.min.js"></script>
    <!-- popper js -->
    <script src="js/popper.min.js"></script>
    <!-- bootstrap js -->
    <script src="js/bootstrap.min.js"></script>
    <!-- easing js -->
    <script src="js/jquery.magnific-popup.js"></script>
    <!-- masonry js -->
    <script src="js/masonry.pkgd.js"></script>
    <!-- particles js -->
    <script src="js/owl.carousel.min.js"></script>

    <!-- <script src="js/jquery.nice-select.min.js"></script> -->
    <!-- custom js -->
    <!-- <script src="js/custom.js"></script> -->

    <script>
        $(document).ready(function(){
            $("#cep").change(function () {
                if($("#cep").val() < 88000001 || $("#cep").val() > 88099999){
                    alert("Não é possível cadastrar pessoas fora de Florianópolis.");
                } else {
                    $.get( "https://viacep.com.br/ws/"+$("#cep")[0].value+"/json/").done(function( data ) {
                        $("#logradouro")[0].value = data.logradouro;
                        $("#bairro")[0].value = data.bairro;
                        $("#cidade")[0].value = data.localidade;
                    }).fail(function () {
                        alert("CEP não encontrado.");
                    });
                }
            });
        });


        $('#btnSubmit').bind('click', function() {

            $('#error').addClass('hide');
            var err = '';
            //$('#btnSubmit').attr("disabled", true);

        });

        function update() {
            if ($('#cpf').val() == '') {
                alert('Informe seu CPF!');
                $('#cpf').focus();
            } else if ($('#nome').val() == '') {
                alert('Informe o seu nome!');
                $('#nome').focus();
            } else if ($('#rg').val() == '') {
                alert('Informe seu RG!');
                $('#rg').focus();
            } else if ($('#data_nascimento').val() == '') {
                alert('Informe sua data de nascimento!');
                $('#data_nascimento').focus();
            } else if ($('#email').val() == '') {
                alert('Informe seu e-mail!');
                $('#email').focus();
            } else if ($('#telefone').val() == '') {
                alert('Informe o seu telefone!');
                $('#telefone').focus();
            } else if ($('#celular').val() == '') {
                alert('Informe seu celular!');
                $('#celular').focus();
            } else if ($('#profissao').val() == '') {
                alert('Informe sua profissao!');
                $('#profissao').focus();
            } else if ($('#numero').val() == '') {
                alert('Informe o número da sua casa!');
                $('#numero').focus();
            } else if($('#complemento').val() == ''){
                alert('Informe o complemento!');
                $('#complemento').focus();
            } else if($('#quantdade_pessoa').val() == ''){
                alert('Informe quantas pessoas residem com você!');
                $('#quantdade_pessoa').focus();
            } else if($('#cep').val() == ''){
                alert('Informe o cep!');
                $('#cep').focus();
            } else if($('#logradouro').val() == ''){
                alert('Informe o endereço!');
                $('#logradouro').focus();
            } else if($('#bairro').val() == ''){
                alert('Informe o bairro!');
                $('#bairro').focus();
            } else if($('#cidade').val() == ''){
                alert('Informe o municípiio!');
                $('#cidade').focus();
            } else if($('#senha').val() == ''){
                alert('Informe a senha');
                $('#senha').focus();
            } else if($('#senha').val() != '' && $('#senha').val() != $('#rsenha').val() ) {
                alert('As senhas devem ser iguais!');
                $('#rsenha').focus();
                //$('#btnSubmit').prop("disabled", false);
                //$('#btnSubmit').attr("disabled", false);
            } else {

                var form_data = new FormData();                  

                form_data.append('cpf', $('#cpf').val());
                form_data.append('nome', $('#nome').val());
                form_data.append('rg', $('#rg').val());
                form_data.append('data_nascimento', $('#data_nascimento').val());
                form_data.append('email', $('#email').val());
                form_data.append('telefone', $('#telefone').val());
                form_data.append('celular', $('#celular').val());
                form_data.append('profissao', $('#profissao').val());
                form_data.append('numero', $('#numero').val());
                form_data.append('complemento', $('#complemento').val());
                form_data.append('quantidade_pessoa', $('#quantidade_pessoa').val());
                form_data.append('cep', $('#cep').val());
                form_data.append('logradouro', $('#logradouro').val());
                form_data.append('bairro', $('#bairro').val());
                form_data.append('cidade', $('#cidade').val());
                form_data.append('senha', $('#senha').val());

                $.ajax({
                    type: "POST",
                    url: "banco/cadastrarParticipante.php",
                    dataType: "text",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    success: function(data) {
                        let response = JSON.parse(data);
                        if (response['success'] == '1') {
                            alert("Seu cadastro foi realizado com sucesso!");
                            $('#frm')[0].reset();
                            // var form_data_cadastro = new FormData();
                            // $.ajax({
                            //     type: "POST",
                            //     url: "comprovante.php",
                            //     dataType: "text",
                            //     cache: false,
                            //     contentType: false,
                            //     processData: false,
                            //     data: form_data_cadastro,
                            //     success: function(response) {
                            //         if (response == 1) {
                            //             alert("Seu cadastro foi realizado com sucesso!");
                            //             window.location.href = "http://www.pmf.sc.gov.br/sistemas/MinhocaCabeca/comprovante.php";
                            //         } else {
                            //             alert('Ocorreu um problema ao realizar seu cadastro.');
                            //             // window.location.href = "http://www.pmf.sc.gov.br/sistemas/MinhocaCabeca/index.php";
                            //         }
                            //     },
                            //     error: function(data) {
                            //         alert('Ocorreu um problema ao realizar seu cadastro.');
                            //         // window.location.href = "http://www.pmf.sc.gov.br/sistemas/MinhocaCabeca/index.php";
                            //     }
                            // });
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
</body>

</html>