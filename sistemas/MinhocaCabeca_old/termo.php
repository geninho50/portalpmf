<html lang="pt-br">
<head>
    <meta http-equiv="refresh" content="1; URL='https://www.eventbrite.com.br/cc/oficinas-do-programa-minhoca-na-cabeca-da-pmf-3120799'"/>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Minhoca na Cabeça</title>
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
<?php

include_once("banco/gdb.php");

$gdb             = new gdb();

$sqlEventoLivbre = " SELECT count(*) as tem
                       FROM  evento e 
                      WHERE e.vagas>( select count(*) 
                                        From eventoInscricao i  
                                        WHERE i.id_evento = e.id_evento )
                      AND data>now()
                      ORDER BY data, hora ";

$gdb->open( $sqlEventoLivbre );

$tem = $gdb->gs["TEM"][0];

?>


<body>
    <!--::header inicio::-->

    <header class="main_menu home_menu">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <a class="navbar-brand" href="index.html"> <img src="img/logom.jpg" id="logo" class="img-fluid" alt="logo"> </a>
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

    <!-- termo inicio -->
    <section class="philosophy_part section_padding">
    <?php if( $tem != 0 ){ 
              $sqlEventoLivbre = " SELECT Upper(nome_evento) as nome_evento, 
                                          Upper(descricao) as descricao, 
                                          local, 
                                          DATE_FORMAT(data, '%d/%m/%Y') as data, 
                                          DATE_FORMAT(hora, '%H:%m') as hora
                                     FROM evento e 
                                    WHERE e.vagas>( select count(*) From eventoInscricao i WHERE i.id_evento = e.id_evento )
                                    AND data>now() 
                                    ORDER BY data, hora ";
            $gdb->open( $sqlEventoLivbre );  ?>        
                    <div class="container">
                        <div class="row align-items-center justify-content-between">                        
                            <div class="col-lg-12 col-md-12">
                                <table width="100%" class="table table table-bordered table-striped"  >                                    
                                <tr>
                                    <td align='center' colspan="5"><b><h3>Oficinas com inscrições em aberto<h3></b></td>
                                    
                                </tr>    
                                <tr>
                                    <td align='center'><b>Oficina</b></td>
                                    <td align='center'><b>Descrição</b></td>
                                    <td align='center'><b>Local</b></td>
                                    <td align='center'><b>Data</b></td>
                                    <td align='center'><b>Hora</b></td>
                                </tr>
                                <?php 
                                   foreach( $gdb->gs['NOME_EVENTO'] as $i=>$value ){ ?>
                                   <tr>
                                    <td><?=$value?></td>
                                    <td><?php print $gdb->gs['DESCRICAO'][$i]; ?></td>
                                    <td><?php print $gdb->gs['LOCAL'][$i]; ?></td>
                                    <td><?php print $gdb->gs['DATA'][$i]; ?></td>
                                    <td><?php print $gdb->gs['HORA'][$i]; ?></td>
                                    </tr>
                            <?php } ?>
                                </table>
                                <div class="philophy_text">
                                    <h2>Termo de Compromisso</h2>
                                    <div class="card-deck">
                                        <div class="card">
                                            <div class="card-body">
                                                <p><b>Para participar do projeto Minhoca na Cabeça é preciso concordar com as condições que seguem:</p> <br>
                                                <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="itemCheck" id="defaultCheck1">
                                                <label class="form-check-label" for="defaultCheck1">
                                                    Participar da oficina de capacitação no dia selecionado no momento da inscrição.
                                                </label>
                                                </div><br><br>
                                                <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="itemCheck" id="participar">
                                                <label class="form-check-label" for="participar">
                                                    Utilizar o kit (caixas e minhocas) recebidos no dia da oficina de capacitação exclusivamente para o seu objetivo que é o tratamento domiciliar dos resíduos orgânicos.
                                                </label>
                                                </div><br><br>
                                                <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="itemCheck" id="utilizar">
                                                <label class="form-check-label" for="utilizar">
                                                    Participar do sistema de monitoramento do projeto Minhoca na Cabeça com informações relativas às quantidades tratadas, por meio de campo indicado no site do projeto Minhoca na Cabeça.
                                                </label>
                                                </div><br><br>
                                                <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="itemCheck" id="participard">
                                                <label class="form-check-label" for="participard">
                                                    Informar com antecedência de dois dias (48 horas) caso não possa participar da oficina de capacitação, no campo indicado no site do projeto Minhoca na Cabeça.
                                                </label>
                                                </div><br><br>
                                                <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="itemCheck" id="informar">
                                                <label class="form-check-label" for="informar">
                                                    Assinar termo de recebimento do kit (caixas e minhocas) ao final da oficina de capacitação.
                                                </label>
                                                </div><br><br>
                                                <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="itemCheck" id="devolver">
                                                <label class="form-check-label" for="devolver">
                                                    Devolver o kit ao projeto Minhoca na Cabeça caso não se adapte ao tratamento domiciliar dos resíduos orgânicos ou por algum outro motivo, A devolução deverá ser solicitada no campo indicado no site do projeto Minhoca na Cabeça, para que a Prefeitura de Florianópolis possa providenciar sua retirada.
                                                </label>
                                                </div><br><br>
                                                    <input name="btnSubmit" onclick="cadastrar()" id="btnSubmit" class="btn btn-success" value="Enviar">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        <?php }else{?>            
            <div class="philophy_text">
                <center>
                    <div class="card-body">
                        <h2><p>Não tem nenhum evento no momento aberto para inscrições !</p></h2>
                    </div>  
                </center> 
            </div>             
        <?php } ?>                   
    </section>
    <!-- termo fim -->
    

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
    <script src="js/custom.js"></script>

    <script>
    $('#btnSubmit').bind('click', function() {

        $('#error').addClass('hide');
        var err = '';
        //$('#btnSubmit').attr("disabled", true);

    });

    function cadastrar() {
        var check = document.getElementsByName("itemCheck");

        for (var i=0;i<check.length;i++){ 
            if (check[0,1,2,3,4,5].checked == true){ 
                // CheckBox Marcado... Faça
                window.location.href = "https://www.pmf.sc.gov.br/sistemas/MinhocaCabeca/cadastro.php";
            }  else {
            // CheckBox Não Marcado... Faça...
                alert('Você precisa preencher todos is itens para fazer seu cadastro!')
            }
        }
    }
    
    
</script>
</body>

</html>