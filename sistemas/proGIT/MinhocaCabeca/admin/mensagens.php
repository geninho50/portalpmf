<?php
include_once("../banco/gdb.php");
$gdb = new gdb();

$user = $gdb->vargetpost('user');
$password = $gdb->vargetpost('password');
$pass = md5($password);

$gdb->open("SELECT id_usuario_admin 
              FROM usuarioAdmin 
             WHERE email_admin = '$user' 
               AND senha       = '$pass' ");

if(empty($gdb->gs["ID_USUARIO_ADMIN"][0])) {
    header('Location: php');
} else {
    $id_usuario_admin = $gdb->gs["ID_USUARIO_ADMIN"][0];

    $limite = 15;
    $pagina = $_POST['pag'];
    if(!$pagina){
        $pagina = 1;
    }
    $inicio = ($pagina * $limite) - $limite;

    $gdb->open("SELECT COUNT(id_mensagem) AS TOTAL_REGISTROS  
                  FROM mensagem m");

    $paginas = (ceil($gdb->gs["TOTAL_REGISTROS"][0]/$limite) == 0) ? 1 : ceil($gdb->gs["TOTAL_REGISTROS"][0]/$limite);

    
    $gdb->open("SELECT id_mensagem 
                  FROM mensagem 
                 WHERE id_usuario_admin = '$id_usuario_admin'");

    $id_mensagem_usuario = $gdb->gs["ID_MENSAGEM"][0];

    $gdb->open("SELECT sm.status_mensagem 
                  FROM statusMensagem sm 
                 WHERE sm.status_mensagem = '1' ");

    $temMensagem = $gdb->gs["STATUS_MENSAGEM"];

    
    $gdb->open("SELECT  m.id_mensagem, 
	                    m.id_usuario, 
						m.assunto, 
						m.mensagem, 
						m.resposta, 
						m.data_envio, 
						m.data_resposta, 
						sm.id_usuario, 
						sm.id_usuario_admin, 
			  CASE WHEN m.data_resposta IS NULL THEN '1' ELSE '2' END as status_mensagem,
						u.nome
                   FROM mensagem m

              LEFT JOIN statusMensagem sm 
			         ON sm.id_mensagem = m.id_mensagem

				   JOIN usuario u
                     ON u.id_usuario = m.id_usuario
					 
               GROUP BY  m.id_mensagem, 
	                    m.id_usuario, 
						m.assunto, 
						m.mensagem, 
						m.resposta, 
						m.data_envio, 
						m.data_resposta, 
						sm.id_usuario, 
						sm.id_usuario_admin,
                        data_resposta,
                        u.nome

               ORDER BY  m.id_mensagem DESC
               LIMIT $inicio, $limite");

    $id_usuario = $gdb->gs["ID_USUARIO"];
	$nome = $gdb->gs["NOME"];
    $assunto = $gdb->gs["ASSUNTO"];
    $mensagem = $gdb->gs["MENSAGEM"];
    $resposta = $gdb->gs["RESPOSTA"];
    $data_envio = $gdb->gs["DATA_ENVIO"];
    $data_resposta = $gdb->gs["DATA_RESPOSTA"];
    $status_mensagem = $gdb->gs["STATUS_MENSAGEM"];
    
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
                                            <a class="nav-link" href="#" onclick="document.getElementById('frm_mensagens').submit()">Mensagens</a> <a class="alerta"></a>
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
                                        <a class="nav-link" href="../index.html">Sair</a>
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
        <form id="frm_mensagens" method="POST" action="mensagens.php">
            <input type="hidden" name="user" value="<?= $user; ?>">
            <input type="hidden" name="password" value="<?= $password; ?>">
        </form>
        <form id="frm_eventos" method="POST" action="eventos.php">
            <input type="hidden" name="user" value="<?= $user; ?>">
            <input type="hidden" name="password" value="<?= $password; ?>">
        </form>
        <form id="frm_participantes" method="POST" action="participantes.php">
            <input type="hidden" name="user" value="<?= $user; ?>">
            <input type="hidden" name="password" value="<?= $password; ?>">
        </form>
        <form id="frm_filaEspera" method="POST" action="filaEspera.php">
            <input type="hidden" name="user" value="<?= $user; ?>">
            <input type="hidden" name="password" value="<?= $password; ?>">
        </form>
        <form id="frm_meusDados" method="POST" action="meusDados.php">
            <input type="hidden" name="user" value="<?= $user; ?>">
            <input type="hidden" name="password" value="<?= $password; ?>">
        </form>
        <form id="frm_paginacao" method="POST" action="mensagens.php">
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
                                <div class="card-deck">
                                    <div class="card">
                                        <div class="card-body">
                                            <h2>Mensagens recebidas</h2>
                                            <div class="accordion" id="accordionExample">
                                            <?php
                                            for ($i = 0; $i < count($gdb->gs["ID_MENSAGEM"]); $i++) {
                                                ?>
                                                <div class="card">
                                                    <div class="card-header" id="headingOne">
                                                        <h2 class="mb-0">
                                                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                            Usuário : <b><?=$nome[$i];?></b>  | Assunto : <?=$assunto[$i];?> | Situação : 
                                                                                                        <?php
                                                                                                        if ($status_mensagem[$i]==1) {
                                                                                                            echo "Não respondido";
                                                                                                        }elseif ($status_mensagem[$i]==2) {
                                                                                                            echo "Respondido";
                                                                                                        }
                                                                                                        ?> | Data-Hora : <?=$data_envio[$i];?>
                                                            </button>
                                                        </h2>
                                                    </div>

                                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                                        <div class="card-body">
                                                            <p><b>Mensagem:</b> <?=$mensagem[$i];?></p> <br>
                                                            <p><b>Resposta:</b> <?=$resposta[$i];?></p>
                                                            <form id="frm">
                                                                <div class="form-group">
                                                                    <label for="mensagem">Escreva aqui a sua mensagem</label><textarea class="form-control" id="resposta<?=$i?>" aria-describedby="emailHelp" rows="3"></textarea>
                                                                </div>
                                                                <input name="btnSubmit" href="#" onclick="enviarMensagem(<?=$gdb->gs['ID_MENSAGEM'][$i];?>,<?=$id_usuario_admin;?>,<?=$i?>)"  id="btnSubmit" class="btn btn-success" value="Enviar">  
                                                            </form>                                                          
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
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
                    ?>
                </li>
            </ul>
        </nav>
        <!-- paginação fim -->

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
            function changePag(pag) {
                document.getElementById('pag').value = pag; 
                document.getElementById('frm_paginacao').submit();
            }
        </script>

        <script>
            function enviarMensagem(id_mensagem,id_usuario_admin,i) {
                if ($('#resposta'+i).val() == '') {
                    $('#resposta'+i).focus();
                } else {
                    var form_data = new FormData();  
                    form_data.append('id_mensagem',id_mensagem);    
                    form_data.append('id_usuario_admin','<?=$id_usuario_admin;?>');    
                    form_data.append('resposta', $('#resposta'+i).val());

                    $.ajax({
                        type: "POST",
                        url: "../banco/enviarMensagem.php", 
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