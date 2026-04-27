<?php
include_once("../banco/gdb.php");
$gdb = new gdb();

$user = $gdb->vargetpost('user');
$password = $gdb->vargetpost('password');
$pass = md5($password);

$gdb->open("SELECT id_usuario_admin FROM usuarioAdmin WHERE email_admin = '$user' AND senha = '$pass'");

if(empty($gdb->gs["ID_USUARIO_ADMIN"][0])) {
    header('Location: php');
} else {
    $id_usuario_admin = $gdb->gs["ID_USUARIO_ADMIN"][0];

    $gdb->open("SELECT sm.status_mensagem FROM statusMensagem sm WHERE sm.status_mensagem = '1'");
    $temMensagem = $gdb->gs["STATUS_MENSAGEM"];

    ?>

    <!doctype html>
    <html lang="pt-br">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Minhoca na Cabeça</title>
        <link href="../../../layout/imagens/brasao.gif" rel="shortcut icon" type="image/x-icon" />
        <link rel="icon" href="../img/favicon.png">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <!-- animate CSS -->
        <link rel="stylesheet" href="../css/animate.css">
        <!-- owl carousel CSS -->
        <link rel="stylesheet" href="../css/owl.carousel.min.css">
        <!-- themify CSS -->
        <link rel="stylesheet" href="../css/themify-icons.css">
        <!-- flaticon CSS -->
        <link rel="stylesheet" href="../css/flaticon.css">
        <!-- font awesome CSS -->
        <link rel="stylesheet" href="../css/magnific-popup.css">
        <!-- swiper CSS -->
        <link rel="stylesheet" href="../css/slick.css">
        <link rel="stylesheet" href="../css/gijgo.min.css">
        <link rel="stylesheet" href="../css/nice-select.css">
        <link rel="stylesheet" href="../css/all.css">
        <!-- style CSS -->
        <link rel="stylesheet" href="../css/style.css">
    </head>

    <body>
        <!--::header inicio::-->
        <header class="main_menu home_menu menu_fixed animated fadeInDown">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <nav class="navbar navbar-expand-lg navbar-light">
                            <a class="navbar-brand" href="index.php"> <img src="../img/logom.jpg" id="logo" class="img-fluid" alt="logo"> </a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="menu_icon"><i class="ti-menu"></i></span>
                            </button>

                            <div class="collapse navbar-collapse main-menu-item" id="navbarSupportedContent">
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <a class="nav-link" href="#" onclick="document.getElementById('frm_admin').submit()">Início</a>
                                    </li>
                                    <li class="nav-item">
                                        
                                        <?php
                                            if (isset($temMensagem)){
                                        ?>
                                            <a class="nav-link" href="#" onclick="document.getElementById('frm_mensagens').submit()">Mensagens</a> <a class="alerta"></a>
                                        <?php    
                                            } else {
                                        ?>
                                            <a class="nav-link" href="#" onclick="document.getElementById('frm_mensagens').submit()">Mensagens</a>
                                        <?php
                                            }
                                        ?>
                                        
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#" onclick="document.getElementById('frm_eventos').submit()">Eventos</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#" onclick="document.getElementById('frm_participantes').submit()">Participantes</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#" onclick="document.getElementById('frm_filaEspera').submit()">Fila de Espera</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#" onclick="document.getElementById('frm_meusDados').submit()">Meus Dados</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../index.php">Sair</a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </header>
        <!-- Header final-->

        <form id="frm_admin" method="POST" action="admin.php">
            <input type="hidden" name="user" value="<?= $user; ?>">
            <input type="hidden" name="password" value="<?= $password; ?>">
        </form>
        

        <!-- inscrição inicio -->
        <section class="philosophy_part section_padding">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-lg-12 col-md-12">
                        <div class="philophy_text">
                            <div class="card-deck">
                                <div class="card">
                                    <div class="card-body">
                                        <h2>Dados do Administrador</h2>
                                        <p><b>Todos dos dados devem ser preenchidos</p>
                                        <form id="frm">
                                            <div class="form-group">
                                                <label for="nome">Nome</label>
                                                <input type="text" class="form-control" id="nome" placeholder="">
                                            </div>
                                            <div class="form-group">
                                                <label for="cpf">CPF</label>
                                                <input type="text" class="form-control" id="cpf" placeholder="">
                                            </div>
                                            <div class="form-group">
                                                <label for="email_admin">Email</label>
                                                <input type="text" class="form-control" id="email_admin">
                                            </div>
                                            <div class="form-group">
                                                <label for="telefone">Telefone</label>
                                                <input type="text" class="form-control" id="telefone" placeholder="">
                                            </div>
                                            <div class="form-group">
                                                <label for="celular">Celular</label>
                                                <input type="text" class="form-control" id="celular" placeholder="">
                                            </div>
                                            <div class="form-group">
                                                <label for="cargo">Cargo</label>
                                                <input type="text" class="form-control" id="cargo" placeholder="">
                                            </div>
                                            <div class="form-group">
                                                <label for="setor">Setor</label>
                                                <input type="text" class="form-control" id="setor" placeholder="">
                                            </div>
                                            <div class="form-group">
                                                <label for="senha">Senha (Mínimo 6 e máximo 10 caracteres)</label>
                                                <input type="password" class="form-control" id="senha">
                                            </div>
                                            <div class="form-group">
                                                <label for="rsenha">Repita a senha</label>
                                                <input type="password" class="form-control" id="rsenha">
                                            </div>
                                            <input type="button"  class="btn_1" name="btnSubmit" onclick="update()" id="btnSubmit"  value="Enviar">
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
                    <img src="../img/caixa.png" class="" alt="Caixa">
                </div>
                <div class="comcap">
                    <img src="../img/comcap.png" class="" alt="Comcap">
                </div>
                <div class="pmf">
                    <img src="../img/pmf.png" class="" alt="PMF">
                </div>
                <div class="fmna">
                    <img src="../img/fnma.png" class="" alt="FNMA">
                </div>
                <div class="ma">
                    <img src="../img/ministerio-meio.png" class="" alt="Ministério do Meio Ambiente">
                </div>
                <div class="gf">
                    <img src="../img/governo-federal.png" class="" alt="Governo Federal">
                </div>
            </div>
        </footer>
        <!-- footer fim -->

        <!-- jquery plugins here-->
        <script src="../js/jquery-1.12.1.min.js"></script>
        <!-- popper js -->
        <script src="../js/popper.min.js"></script>
        <!-- bootstrap js -->
        <script src="../js/bootstrap.min.js"></script>
        <!-- easing js -->
        <script src="../js/jquery.magnific-popup.js"></script>
        <!-- masonry js -->
        <script src="../js/masonry.pkgd.js"></script>
        <!-- particles js -->
        <script src="../js/owl.carousel.min.js"></script>

        <script src="../js/jquery.nice-select.min.js"></script>
        <!-- custom js -->
        <script src="../js/custom.js"></script>

        <script>
        $('#btnSubmit').bind('click', function() {

            $('#error').addClass('hide');
            var err = '';
            //$('#btnSubmit').attr("disabled", true);

        });

        function update() {
            if ($('#nome').val() == '') {
                alert('Informe seu nome!');
                $('#nome').focus();
            } else if ($('#cpf').val() == '') {
                alert('Informe o seu CPF!');
                $('#cpf').focus();
            } else if ($('#email_admin').val() == '') {
                alert('Informe seu email!');
                $('#email_admin').focus();
            } else if ($('#telefone').val() == '') {
                alert('Informe seu telefone!');
                $('#telefone').focus();
            } else if ($('#celular').val() == '') {
                alert('Informe seu celular!');
                $('#celular').focus();
            } else if ($('#cargo').val() == '') {
                alert('Informe o seu cargo!');
                $('#cargo').focus();
            } else if ($('#setor').val() == '') {
                alert('Informe seu setor!');
                $('#setor').focus();
            } else if($('#senha').val() == ''){
                alert('Informe a senha');
                $('#senha').focus();
            } else if($('#senha').val() != '' && $('#senha').val() != $('#rsenha').val() ) {
                alert('As senhas devem ser iguais!');
                $('#rsenha').focus();
                $('#btnSubmit').prop("disabled", false);
                //$('#btnSubmit').attr("disabled", false);
            }

                var form_data = new FormData();                  

                form_data.append('nome', $('#nome').val());
                form_data.append('cpf', $('#cpf').val());
                form_data.append('email_admin', $('#email_admin').val());
                form_data.append('telefone', $('#telefone').val());
                form_data.append('celular', $('#celular').val());
                form_data.append('cargo', $('#cargo').val());
                form_data.append('numero', $('#numero').val());
                form_data.append('setor', $('#setor').val());
                form_data.append('senha', $('#senha').val());

                $.ajax({
                    type: "POST",
                    url: "../banco/cadastrarAdmin.php",
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


            function validacao() {
                document.getElementById("cadastro").style.display = "block";
                document.getElementById("btnEntrar").style.display = "none";
            }
        </script>
    </body>

    </html>
<?php 
}
?>