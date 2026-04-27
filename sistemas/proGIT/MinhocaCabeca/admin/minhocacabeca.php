<!doctype html>
<html lang="pt-br">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Minhoca na cabeça</title>
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
    <header class="main_menu home_menu">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <a class="navbar-brand" href="index.php"> <img id="logo" class="img-fluid" src="../img/logom.jpg" alt="logo"> </a>
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
    <!-- Header fim-->

       <!-- caixas inicio -->
       <section id="home-admin" class="philosophy_part section_padding">
       <script src='https://www.google.com/recaptcha/api.js' async defer></script>
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-lg-6 col-md-6">
                        <div class="philophy_text">
                            <h5>Olá administrador!</h5>
                            <h4 id="titulo">Usuário ou senha incorreto!</h4>
                            <h6>Por favor faça login para continuar</h6>
                              <!-- Botão para acionar modal -->
                              <button type="button" class="btn_1" data-toggle="modal" data-target="#modalExemplo">
                                        Fazer login
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="modalExemplo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Login de Acesso</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="admin.php" method="POST">
                                                        <div class="form-group">
                                                            <label for="email">Login</label>
                                                            <input type="text" class="form-control" id="email" name="user" placeholder="">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="senha">Senha</label>
                                                            <input type="password" class="form-control" id="senha" name="password" placeholder="">
                                                        </div>
                                                        <div class="form-group">
                                                              <label><div class="g-recaptcha" data-sitekey="6Lf0zBsaAAAAAPaI0ZpJj9u79TjRkLJuOl_d8kr5"></div></label>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Enviar</button>
                                                    </form>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="philophy_text">
                            <img src="../img/slide01.png" alt="banner">
                        </div>
                    </div>
                </div>
            </div>
       </section>
       
    <!-- caixas fim -->

    <!-- footer inicio -->
    <footer class="footer_Part padding_top">
            <hr width = "100%" align ="right" noshade>
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
</body>

</html>