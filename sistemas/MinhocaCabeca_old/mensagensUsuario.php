<?php

/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

print "<pre>";
print_r($_POST);
print "</pre>";
*/

include_once("banco/gdb.php");

$gdb = new gdb();

if ( isset( $_POST['usuario'] ) ){
    $user = $_POST['usuario'];
}else{
    $user = $_POST['user'];
}

$password = $gdb->vargetpost('password');

$pass = md5($password);

// $gdb->open("SELECT ID_PESSOA FROM usuario WHERE login = '$user' AND senha = '$pass' ");
$gdb->open("SELECT * FROM usuario WHERE login = '$user' ");

$id_usuario = $gdb->gs['ID_USUARIO'][0];
$id_pessoa = $gdb->gs["ID_PESSOA"][0];

if( empty($id_pessoa) ) {
    header('Location: php');
} 
	
if(!empty($gdb->gs['SENHA'][0])){
    
    $limite = 15;
    $pagina = $gdb->vargetpost('pag');
	
    if(!$pagina){
        $pagina = 1;
    }
    $inicio = ($pagina * $limite) - $limite;

    $gdb->open("SELECT u.id_usuario, u.id_pessoa FROM usuario u LEFT JOIN pessoa p ON u.id_pessoa = p.id_pessoa 
		WHERE p.id_pessoa = '$id_pessoa'");
	
	if ( $gdb->linhas>0 ){
		$paginas = (ceil($gdb->gs["TOTAL_REGISTROS"][0]/$limite) == 0) ? 1 : ceil($gdb->gs["TOTAL_REGISTROS"][0]/$limite);

		$gdb->open("SELECT u.id_usuario, u.id_pessoa FROM usuario u LEFT JOIN pessoa p ON u.id_pessoa = p.id_pessoa 
		WHERE p.id_pessoa = '$id_pessoa'");
		
		$id_usuario = $gdb->gs["ID_USUARIO"][0];

		$gdb->open("SELECT sm.status_mensagem 
                      FROM mensagem m
		         LEFT JOIN usuario u 
                        ON m.id_usuario = u.id_usuario
		         LEFT JOIN statusMensagem sm 
                        ON m.id_mensagem = sm.id_mensagem
		             where u.id_usuario = '$id_usuario' 
                       AND sm.status_mensagem = '1'");

		$temMensagem = $gdb->gs["STATUS_MENSAGEM"];


        // $gdb->open("DELETE FROM mensagem WHERE UPPER( mensagem  ) LIKE '%<SCRIPT%' ");

		$gdb->open("SELECT m.id_mensagem, 
                           m.id_usuario, 
                           m.id_usuario_admin, 
                           m.assunto, 
                           m.mensagem, 
                           m.resposta, 
                           m.data_envio, 
                           m.data_resposta, 
                           sm.status_mensagem  
                      FROM mensagem m 
		         LEFT JOIN usuario u 
                        ON m.id_usuario = u.id_usuario 
		         LEFT JOIN statusMensagem sm 
                        ON m.id_mensagem = sm.id_mensagem
                        WHERE u.id_usuario = '$id_usuario'      
		          ORDER BY m.id_mensagem DESC
                  LIMIT $inicio, $limite ");
 

		$id_mensagem_usuario = $gdb->gs["ID_MENSAGEM"][0];
		$assunto = $gdb->gs["ASSUNTO"];
		$mensagem = $gdb->gs["MENSAGEM"];
		$resposta = $gdb->gs["RESPOSTA"];
		$data_envio = $gdb->gs["DATA_ENVIO"];
		$data_resposta = $gdb->gs["DATA_RESPOSTA"];
		$id_usuario_admin = $gdb->gs["ID_USUARIO_ADMIN"];
		$status_mensagem = $gdb->gs["SATUS_MENSAGEM"];
	}

    ?>

    <!doctype html>
    <html lang="pt-br">

    <head>
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
                                        <a class="nav-link" href="#" onclick="document.getElementById('frm_sistema').submit()">Inicio</a>
                                    </li>
                                    <li class="nav-item">
                                        
                                        <?php
                                            if (isset($temMensagem)){
                                        ?>
                                            <a class="nav-link" href="#" onclick="document.getElementById('frm_mensagens').submit()">Mensagens</a> <a class="alerta"></a>
                                        <?php    
                                            } else {
                                        ?>
                                            <a class="nav-link" href="#" onclick="document.getElementById('frm_mensagens').submit()">Mensagens</a><a class="alerta"></a>
                                        <?php
                                            }
                                        ?>
                                        
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#" onclick="document.getElementById('frm_eventos').submit()">Eventos</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="index.html">Sair</a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </header>
        <!-- Header final-->

        <form id="frm_sistema" method="POST" action="sistemaUsuario.php">
            <input type="hidden" name="user" value="<?= $user; ?>">
            <input type="hidden" name="password" value="<?= $password; ?>">
        </form>
        <form id="frm_mensagens" method="POST" action="mensagensUsuario.php">
            <input type="hidden" name="user" value="<?= $user; ?>">
            <input type="hidden" name="password" value="<?= $password; ?>">
        </form>
        <form id="frm_eventos" method="POST" action="eventosUsuario.php">
            <input type="hidden" name="user" value="<?= $user; ?>">
            <input type="hidden" name="password" value="<?= $password; ?>">
        </form>
        <form id="frm_paginacao" method="POST" action="mensagensUsuario.php">
            <input type="hidden" name="user" value="<?=$user;?>">
            <input type="hidden" name="password" value="<?=$password;?>">
            <input type="hidden" id="pag" name="pag">
        </form>

        <!-- mensagens inicio -->
        <section class="philosophy_part section_padding">
            <div class="container">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-lg-12 col-md-12">
                            <div class="philophy_text">
                            <h2>Enviar mensagem</h2>
                            <form>
                                <div class="form-group">
                                    <label for="assunto">Assunto</label>
                                    <input type="text" class="form-control" id="assunto"><br>
                                    <label for="mensagem">Escreva aqui a sua mensagem</label>
                                    <textarea class="form-control" id="mensagem" rows="3"></textarea>
                                </div>
                                <input type="button" onclick="enviarMensagem(<?=$id_usuario?>)" class="btn btn-success" value="Enviar">
                            </form><br><br><br>
                                <div class="card-deck">
                                    <div class="card">
                                        <div class="card-body">
                                            <h2>Mensagens recebidas</h2>
                                            <div class="accordion" id="accordionExample">
                                            <?php
											if( $gdb->linhas>0 ){
                                            for ($i = 0; $i < count($gdb->gs["MENSAGEM"]); $i++) {
                                                ?>
                                                <div class="card">
                                                    <div class="card-header" id="headingOne">
                                                        <h2 class="mb-0">
                                                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                            <?=$assunto[$i];?>
                                                            </button>
                                                        </h2>
                                                    </div>

                                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                                        <div class="card-body">
                                                            <p><b>Mensagem:</b> <?=$mensagem[$i];?></p> <br>
                                                            <p><b>Resposta:</b> <?=$resposta[$i];?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                                }
											}
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
        <!-- mensagens fim -->

        <!-- paginação inicio -->
        <nav id="paginacao" aria-label="Navegação de página exemplo">
            <ul class="pagination justify-content-center">
                <li class="page-item disabled">
                <?php
				if ( isset( $paginas ) ){
                    echo '<a style="padding: 8px 8px !important;" href="#" onclick="changePag(\'1\')">'.'Primeira página'.'</a>';
                    for($i=1; $i <= $paginas; $i++)
                    {
                        if($pagina == $i)
                        {
                          echo " ".$i." ";
                        }
                        else
                        {
                          echo '<a style="padding: 8px 8px !important;" href="#" onclick="changePag('.$i.')"> '.$i.'</a>';
                        }
                    }   
                    echo '<a style="padding: 8px 8px !important;" href="#" onclick="changePag(\''.$paginas.'\')"> Última página</a>';
				}
                    ?>
                </li>
            </ul>
        </nav>
        <!-- paginação fim -->

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

        <!--<script src="js/jquery.nice-select.min.js"></script>-->
        <!-- custom js -->
        <!--<script src="js/custom.js"></script>-->

        <script>
            function changePag(pag) {
                document.getElementById('pag').value = pag; 
                document.getElementById('frm_paginacao').submit();
            }
        </script>

        <script>
            function enviarMensagem(id_usuario) {

                var Assunto = $('#assunto').val();
                var Mensagem = $('#mensagem').val();     
                var indexAssunto = Assunto.search('<');
                var indexMensagem = Mensagem.search('<');

                if ($('#assunto').val() == '') {
                    $('#assunto').focus();
                } else if ($('#mensagem').val() == '') {
                    $('#mensagem').focus();
                } else if (indexAssunto != -1 ) {
                    alert('Texto do assunto invalido para ser plubicado !');
                    $('#assunto').focus();
                } else if (indexMensagem != -1 ) {
                    alert('Texto da mensagem invalido para ser plubicado !');
                    $('#mensagem').focus();
                } else {
                    var form_data = new FormData();  
                    form_data.append('id_usuario',<?=$id_usuario;?>);    
                    form_data.append('assunto', $('#assunto').val());
                    form_data.append('mensagem', $('#mensagem').val());
                        
                    $.ajax({
                        type: "POST",
                        url: "banco/enviarMensagemUsuario.php", 
                        dataType: "text",
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,
                        success: function(data) {
                            let response = JSON.parse(data);
                            if (response['success'] == '1') {
                                alert("Sua mensagem foi enviada com sucesso!");
                                document.location.reload(true);
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

        </script>


    </body>

    </html>
<?php 
}
?>