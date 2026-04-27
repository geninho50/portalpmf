<?php
include_once("banco/gdb.php");
$gdb = new gdb();

$user = $gdb->vargetpost('user');
$password = $gdb->vargetpost('password');

$gdb->open("SELECT ID_PESSOA FROM usuario WHERE login = '$user' AND senha = '$password'");

if(empty($gdb->gs["ID_PESSOA"][0])) {
    
    $id_pessoa = $gdb->gs["ID_PESSOA"][0];

    $gdb->open("SELECT u.id_usuario, u.id_pessoa FROM minhocaCabeca.usuario u left join minhocaCabeca.pessoa p on u.id_pessoa = p.id_pessoa 
    where p.id_pessoa = '$id_pessoa'");
    $id_usuario = $gdb->gs["ID_USUARIO"][0];

    $gdb->open("SELECT su.status_usuario from minhocaCabeca.statusUsuario su where su.id_usuario = '$id_usuario'");
    $status_usuario = $gdb->gs["STATUS_USUARIO"][0];

    $gdb->open("SELECT id_evento, id_evento_inscricao,status_inscricao FROM minhocaCabeca.eventoInscricao WHERE id_pessoa = '$id_pessoa'");

    $id_evento_pessoa = 0;
    $status_inscricao_pessoa = 0;

    if(count($gdb->gs["ID_EVENTO"]) > 1) {
        for($i = 0; $i < count($gdb->gs["ID_EVENTO"]); $i++) {
            if($gdb->gs["STATUS_INSCRICAO"][$i] == '1') {
                $id_evento_pessoa = $gdb->gs["ID_EVENTO"][$i];
                $status_inscricao_pessoa = $gdb->gs["STATUS_INSCRICAO"][$i];
            }
        }

        if($id_evento_pessoa == 0) {
            $status_inscricao_pessoa = 2;
        }
    } else {
        $id_evento_pessoa = $gdb->gs["ID_EVENTO"][0];
        $status_inscricao_pessoa = $gdb->gs["STATUS_INSCRICAO"][0];
    }

    $dadosMeses = array();

    for($i = 1; $i <= 12; $i++) {
        $gdb->open("SELECT e.id_evento,
                       e.nome_evento,
                       e.descricao,
                       e.ministrante,
                       e.carga_horaria,
                       e.local,
                       e.vagas,
                       e.data,
                       e.hora,
                       ei.status_inscricao,
                       se.status_evento
                FROM minhocaCabeca.evento e
                LEFT JOIN minhocaCabeca.statusEvento se ON e.id_evento = se.id_evento
                LEFT JOIN minhocaCabeca.eventoInscricao ei ON e.id_evento = ei.id_evento
                WHERE MONTH(data) = ".$i."
                GROUP BY e.id_evento,
                       e.nome_evento,
                       e.descricao,
                       e.ministrante,
                       e.carga_horaria,
                       e.local,
                       e.vagas,
                       e.data,
                       e.hora");
        
        $dadosMeses[$i] = $gdb->gs;        
    }    
?>

    <!doctype html>
    <html lang="pt-br">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Eventos</title>
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
                            <a class="navbar-brand" href="index.html"> <img src="img/logom.jpg" id="logo" class="img-fluid" alt="logo"> </a>
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
                                        <a class="nav-link"  href="#" onclick="document.getElementById('frm_mensagens').submit()">Mensagens</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#" onclick="document.getElementById('frm_eventos').submit()">Eventos</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="index.php">Sair</a>
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
 

        <!-- cursos inicio -->
        <div class="container" id="eventos"><br></div>
        <div class="container">
            <?php 
                if($status_usuario == 2){
                    echo '<p><b>Você não pode se inscrever em eventos pois seu usuário está inativo!</p></b>';
                }else if ($status_usuario == 3) {
                    echo '<p><b>Você não pode se inscrever em eventos pois seu usuário está na fila de espera!</p></b>';
                };             
            ?>             
            <div class="row">  
                <?php
                for($j = 1; $j <= 12; $j++) {
                    switch ($j) {
                        case 1:
                            if(empty($dadosMeses[$j]["ID_EVENTO"])){
                                echo '';
                            } else {
                                echo '<div class="mes"><h2>Janeiro</h2></div>';
                            }
                            break;
                        case 2:
                            if(empty($dadosMeses[$j]["ID_EVENTO"])){
                                echo '';
                            } else {
                                echo '<div class="mes"><h2>Fevereiro</h2></div>';
                            }
                            break;
                        case 3:
                            if(empty($dadosMeses[$j]["ID_EVENTO"])){
                                echo '';
                            } else {
                                echo '<div class="mes"><h2>Março</h2></div>';
                            }
                            break;
                        case 4:
                            if(empty($dadosMeses[$j]["ID_EVENTO"])){
                                echo '';
                            } else {
                                echo '<div class="mes"><h2>Abril</h2></div>';
                            }
                            break;
                        case 5:
                            if(empty($dadosMeses[$j]["ID_EVENTO"])){
                                echo '';
                            } else {
                                echo '<div class="mes"><h2>Maio</h2></div>';
                            }
                            break;
                        case 6:
                            if(empty($dadosMeses[$j]["ID_EVENTO"])){
                                echo '';
                            } else {
                                echo '<div class="mes"><h2>Junho</h2></div>';
                            }
                            break;
                        case 7:
                            if(empty($dadosMeses[$j]["ID_EVENTO"])){
                                echo '';
                            } else {
                                echo '<div class="mes"><h2>Julho</h2></div>';
                            }
                            break;
                        case 8:
                            if(empty($dadosMeses[$j]["ID_EVENTO"])){
                                echo '';
                            } else {
                                echo '<div class="mes"><h2>Agosto</h2></div>';
                            }
                            break;
                        case 9:
                            if(empty($dadosMeses[$j]["ID_EVENTO"])){
                                echo '';
                            } else {
                                echo '<div class="mes"><h2>Setembro</h2></div>';
                            }
                            break;
                        case 10:
                            if(empty($dadosMeses[$j]["ID_EVENTO"])){
                                echo '';
                            } else {
                                echo '<div class="mes"><h2>Outubro</h2></div>';
                            }
                            break;
                        case 11:
                            if(empty($dadosMeses[$j]["ID_EVENTO"])){
                                echo '';
                            } else {
                                echo '<div class="mes"><h2>Novembro</h2></div>';
                            }
                            break;
                        case 12:
                            if(empty($dadosMeses[$j]["ID_EVENTO"])){
                                echo '';
                            } else {
                                echo '<div class="mes"><h2>Dezembro</h2></div>';
                            }
                            break;
                    }
                    ?>
                    
                
                <?php
                for ($i = 0; $i < count($dadosMeses[$j]["ID_EVENTO"]); $i++) {
                    ?>
                <div class="evento" id="evento<?=$j.$i?>">
                    <h5><?=$dadosMeses[$j]["NOME_EVENTO"][$i];?></h5>
                    <p><b>Status:</b> <?php
                                        switch ($dadosMeses[$j]["STATUS_EVENTO"][$i]) {
                                            case 1: 
                                                echo "Aberto";
                                                break;
                                            case 0:
                                                echo "Encerrado";
                                                break;
                                        }
                                        ?></p>
                    <p><p><b>Data:</b> <?php echo date('d/m/Y', strtotime($dadosMeses[$j]["DATA"][$i])); ?></p>
                    <p><b>Horário:</b> <?=$dadosMeses[$j]["HORA"][$i];?></p>
                    <p><b>Local:</b> <?=$dadosMeses[$j]["LOCAL"][$i];?></p>
                    <p><b>Vagas:</b> <?=$gdb->buscaInscritosEvento($dadosMeses[$j]["ID_EVENTO"][$i])?></p>
                    <?php 
                        if($status_usuario == 2){
                            echo '<input type="button" class="btn_1" data-toggle="modal"  disabled="true"  value="Fazer inscrição">';
                        }else if ($status_usuario == 3) {
                            echo '<input type="button" class="btn_1" data-toggle="modal"  disabled="true"  value="Fazer inscrição">';
                        }else if ($dadosMeses[$j]["STATUS_EVENTO"][$i] == 0) {
                            echo '';
                        }else{
                            if($status_inscricao_pessoa == 1){
                                if (($id_evento_pessoa)==($dadosMeses[$j]["ID_EVENTO"][$i]) && $status_inscricao_pessoa==1){ 
                                        echo '<input class="btn_1" onclick="cancelarInscricao(\''.$dadosMeses[$j]["ID_EVENTO"][$i].'\')" value="Cancelar inscrição">';  
                                }
                            }else{
                                echo '<input type="button" '.(($gdb->buscaInscritosEvento($dadosMeses[$j]["ID_EVENTO"][$i]) == 'Vagas esgotadas') ? 'disabled="true" ' : '').' class="btn_1" data-toggle="modal" data-target="#modalExemplo'.$j.$i.'" value="Fazer inscrição">';
                            };  
                        };               
                    ?>

                        <!-- Modal inscrição -->
                        <div class="modal fade" id="modalExemplo<?=$j.$i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Inscrição</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Tem certeza que deseja realizar inscrição?</p>
                                    <form> 
                                        <input name="btnSubmit" onclick="realizarInscricao(<?=$dadosMeses[$j]['ID_EVENTO'][$i];?>)" id="btnSubmit" class="btn btn-success" value="Enviar">
                                    </form>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                }
                ?>
            </div>
        </div>
        <!-- cursos fim -->


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

        <script src="js/jquery.nice-select.min.js"></script>
        <!-- custom js -->
        <script src="js/custom.js"></script>

        <!--<script type="text/javascript">
            $valor_array = implode(",",<?=$id_evento[$i];?>);
            var i,array_valor, valor_array;
            valor_array = "<?php echo $valor_array;?>";
            array_valor = valor_array.split(",");
            function valor(array_valor){
                if ((<?=$id_evento;?>)==(array_valor)) {
                    valor = <?=$id_evento;?>
                }
            return (valor)
            }
        </script>-->

        <script>


            
            function realizarInscricao(idEvento) {
               
                var form_data = new FormData();  
                form_data.append('id_pessoa',<?=$id_pessoa;?>);    
                form_data.append('id_evento', idEvento);

                $.ajax({
                    type: "POST",
                    url: "banco/fazerInscricao.php", 
                    dataType: "text",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    success: function(data) {
                        let response = JSON.parse(data);
                        if (response['success'] == '1') {
                            alert("Sua inscrição foi realizada com sucesso!");
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

        </script>

        <script>


                    
        function cancelarInscricao(idEvento) {
        
            var form_data = new FormData();  
            form_data.append('id_pessoa',<?=$id_pessoa;?>);    
            form_data.append('id_evento', idEvento);

            $.ajax({
                type: "POST",
                url: "banco/cancelaInscricao.php", 
                dataType: "text",
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                success: function(data) {
                    let response = JSON.parse(data);
                    if (response['success'] == '1') {
                        alert("Sua inscrição foi cancelada com sucesso!");
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

        </script>

        

        <script>
            
            $('.row').on('click','.mes',function() {
                var t = $(this);
                var p = t.parent().siblings().find('.evento');
                var tp = t.next();
                var temp = 200;
                p.slideUp(temp);
                tp.slideToggle(temp);
            });
            
        </script>


    </body>

    </html>
<?php 
}
?>
