<?php

include_once("banco/gdb.php");
$gdb = new gdb();

$email      = $gdb->vargetpost('email');
$cpf = $gdb->vargetpost('cpf');

$gdb->open("SELECT ID_PESSOA FROM pessoa WHERE email = '$email' AND cpf = '$cpf' ");

if(empty($gdb->gs["ID_PESSOA"][0])) {
    $msg = "CPF ou E-mail incorreto !";
    header("Location: minhocacabeca.php?msg=$msg");
} else {
    $id_pessoa = $gdb->gs["ID_PESSOA"][0];

    /*
        $gdb->open("SELECT u.id_usuario, u.id_pessoa FROM minhocaCabeca.usuario u LEFT JOIN minhocaCabeca.pessoa p ON u.id_pessoa = p.id_pessoa 
        WHERE p.id_pessoa = '$id_pessoa'");
        $id_usuario = $gdb->gs["ID_USUARIO"][0]; 
    */

    ?>

    <!doctype html>
    <html lang="pt-br">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Minhoca na Cabeca</title>
        <link href="../../layout/imagens/brasao.gif" rel="shortcut icon" type="image/x-icon" />
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
                            <a class="navbar-brand" href="index.html"> <img id="logo" class="img-fluid" src="img/logom.jpg" alt="logo"> </a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="menu_icon"><i class="ti-menu"></i></span>
                            </button>
                        </nav>
                    </div>
                </div>
            </div>
        </header>
        <!-- Header final-->

    <body>
<!-- senha-arquivos inicio -->
<section class="philosophy_part section_padding">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-lg-12 col-md-12">
                        <div class="philophy_text">
                            <div class="card-deck">
                                <div class="card">
                                        <div class="card-body">
                                            <h2>Mudar senha</h2>
                                            <form>
                                                <div class="form-group col-md-12">
                                                    <label for="senha">Nova senha</label>
                                                    <input type="password" class="form-control" id="senha" placeholder="">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="confirmarsenha">Confirme a senha</label>
                                                    <input type="password" class="form-control" id="confirmarsenha">
                                                </div>
                                                <input name="btnSubmit" onclick="updateSenha()" id="btnSubmit" class="btn btn-success" value="Enviar">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <!-- senha-arquivos fim -->

        <!-- footer inicio -->
        <footer class="footer_Part padding_top">
            <hr width = 100% align = right noshade>
            <div class="rodape">
                
                <div class="pmf">
                    <img src="img/pmf.png" class="" alt="PMF">
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

        <script src="js/jquery.nice-select.min.js"></script>
        <!-- custom js -->
        <!-- <script src="js/custom.js"></script> -->
    </body>
    
    

    <script>
        function updateSenha() {
            if ($('#senha').val() == '') {
                alert('Informe a nova senha!');
                $('#senha').focus();
            } else if($('#senha').val() != '' && $('#senha').val() != $('#confirmarsenha').val() ) {
                alert('As senhas devem ser iguais!');
                $('#confirmarsehna').focus();
            }

            var form_data = new FormData();

            form_data.append('id_pessoa',<?=$id_pessoa;?>);
            form_data.append('senha', $('#senha').val());

            $.ajax({
                    type: "POST",
                    url: "banco/editarSenha.php",
                    dataType: "text",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    success: function(data) {
                        let response = JSON.parse(data);
                        if (response['success'] == '1') {
                            alert("Senha editada com sucesso!");
                            window.location="http://www.pmf.sc.gov.br/sistemas/MinhocaCabeca/index.html";
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
    </script>

    </html>
<?php 
}
?>