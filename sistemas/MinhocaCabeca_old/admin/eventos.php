<?php
include_once("../banco/gdb.php");
$gdb = new gdb();


/*
$gdb->open("ALTER TABLE evento ADD observacao varchar(200)");

$gdb->open("UPDATE evento 
              SET local = 'Jardim Bot�nico de Florian�polis'
            WHERE local LIKE '%Hacked by%' ",1 );  

 print "<pre>";             
 print_r($gdb);
 print "</pre>"; 
die();

*/
$user = $gdb->vargetpost('user');
$password = $gdb->vargetpost('password');
$pass = md5($password);

$gdb->open("SELECT id_usuario_admin FROM usuarioAdmin WHERE email_admin = '$user' AND senha = '$pass'");

if(empty($gdb->gs["ID_USUARIO_ADMIN"][0])) {
    header('Location: php');
} else {
    $id_usuario_admin = $gdb->gs["ID_USUARIO_ADMIN"][0];

    $gdb->open("SELECT sm.status_mensagem FROM statusMensagem sm WHERE sm.status_mensagem = '1' ");
    $temMensagem = $gdb->gs["STATUS_MENSAGEM"];

    $dadosMeses = array();

    for($i = 1; $i <= 12; $i++) {
         

        $gdb->open("  SELECT e.id_evento, 
                             e.nome_evento, 
                             e.descricao, 
                             e.ministrante, 
                             e.carga_horaria, 
                             e.local, 
                             e.vagas, 
                             e.data, 
                             e.hora, 
                             ei.inscritos, 
                             se.status_evento,
                             e.OBSERVACAO
						FROM evento e
						LEFT JOIN statusEvento se 
                               ON e.id_evento = se.id_evento
						LEFT JOIN ( SELECT id_evento,
                                           count(id_pessoa) AS inscritos
									  FROM eventoInscricao
									  WHERE status_inscricao = 1
								   GROUP BY id_evento) ei ON e.id_evento = ei.id_evento
									  WHERE MONTH(data) = ".$i );
        $dadosMeses[$i] = $gdb->gs;        
    }

    $id_evento = $gdb->gs["ID_EVENTO"];
    $nome_evento = $gdb->gs["NOME_EVENTO"];
    $descricao = $gdb->gs["DESCRICAO"];
    $ministrante = $gdb->gs["MINISTRANTE"];
    $carga_horaria = $gdb->gs["CARGA_HORARIA"];
    $local = $gdb->gs["LOCAL"];
    $vagas = $gdb->gs["VAGAS"];
    $data = $gdb->gs["DATA"];
    $hora = $gdb->gs["HORA"];
    $inscritos = $gdb->gs["INSCRITOS"];
    $status_evento = $gdb->gs["STATUS_EVENTO"];
    $observacao = $gdb->gs["OBSERVACAO"];
    
    
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
                                            <a class="nav-link" href="#" onclick="document.getElementById('frm_mensagens').submit()">Mensagens</a>
                                        <?php    
                                            } else {
                                        ?>
                                            <a class="nav-link" href="#" onclick="document.getElementById('frm_mensagens').submit()">Mensagens</a>
                                        <?php
                                            }
                                        ?>
                                        
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#" onclick="document.getElementById('frm_eventos').submit()">Eventos</a> <a class="alerta"></a>
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
        <form id="frm_edicaoevento" method="POST" action="edicaoEvento.php">
            <input type="hidden" id="id_evento" name="idEvento">
            <input type="hidden" name="user" value="<?=$user;?>">
            <input type="hidden" name="password" value="<?=$password;?>">
        </form>
        <form id="frm_cursoExcel" method="POST" action="cursosExcel.php">
            <input type="hidden" id="id_evento_excel" name="idEvento">
            <input type="hidden" name="user" value="<?=$user;?>">
            <input type="hidden" name="password" value="<?=$password;?>">
        </form>
        <form id="frm_manutencao_participantes" method="POST" action="edicaoParticipantes.php">
            <input type="hidden" id="id_manutencao_participantes" name="idEvento">
            <input type="hidden" name="user" value="<?=$user;?>">
            <input type="hidden" name="password" value="<?=$password;?>">
        </form>

        <!-- ediçao cursos inicio -->
        <section class="philosophy_part section_padding">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-lg-12 col-md-12">
                        <h5>Cadastrar novo evento</h5>
                        <form id="frm">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="nome_evento">Nome do evento</label>
                                    <input type="text" class="form-control" id="nome_evento" placeholder="">
                                </div>
                                <div class="col-md-6">
                                    <label for="descricao">Descrição</label>
                                    <input type="textarea" class="form-control" id="descricao" placeholder="">
                                </div>
                                <div class="col-md-6">
                                    <label for="ministrante">Ministrante</label>
                                    <input type="text" class="form-control" id="ministrante" placeholder="">
                                </div>
                                <div class="col-md-6">
                                    <label for="carga_horaria">Carga Horária</label>
                                    <input type="text" class="form-control" id="carga_horaria" placeholder="">
                                </div>
                                <div class="col-md-6">
                                    <label for="local">Local</label>
                                    <input type="text" class="form-control" id="local" placeholder="">
                                </div>
                                <div class="col-md-6">
                                    <label for="vagas">Vagas</label>
                                    <input type="text" class="form-control" id="vagas" placeholder="">
                                </div>
                                <div class="col-md-6">
                                    <label for="data">Data</label>
                                    <input type="text" class="form-control" id="data" placeholder="">
                                </div>
                                <div class="col-md-6">
                                    <label for="hora">Horário</label>
                                    <input type="time" class="form-control" id="hora" placeholder="">
                                </div>
                                <div class="col-md-6">
                                    <label for="Status">Status</label><br>
                                    <select id="status_evento" class="form-control"  >
                                        <option value="1">Aberto</option>
                                        <option value="3">Aguardar Abertura</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="hora">Observação</label>
                                    <textarea name="observacao" id="observacao" class="form-control" rows="2" cols="100" ></textarea>
                                </div>  
                                <div class="col-md-12">                                                                                              
                                   <input type="button" onclick="update()" id="btnSubmit" class="btn_1" value="Enviar">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!--edição cursos fim -->

         <!-- cursos inicio -->
        <div class="container">
            <div class="row">
                <?php
                for($j = 1; $j <= 12; $j++) {
					$ano =  "";
                    switch ($j) {
                        case 1:
                            if(empty($dadosMeses[$j]["ID_EVENTO"])){
                                echo '';
                            } else {                               
                                echo '<div class="mes"><h2>Janeiro'.$ano.'</h2></div> ';
                            }
                            break;
                        case 2:
                            if(empty($dadosMeses[$j]["ID_EVENTO"])){
                                echo '';
                            } else {
                                echo '<div class="mes"><h2>Fevereiro'.$ano.'</h2></div>';
                            }
                            break;
                        case 3:
                            if(empty($dadosMeses[$j]["ID_EVENTO"])){
                                echo '';
                            } else {
                                echo '<div class="mes"><h2>Março'.$ano.'</h2></div>';
                            }
                            break;
                        case 4:
                            if(empty($dadosMeses[$j]["ID_EVENTO"])){
                                echo '';
                            } else {
                                echo '<div class="mes"><h2>Abril'.$ano.'</h2></div>';
                            }
                            break;
                        case 5:
                            if(empty($dadosMeses[$j]["ID_EVENTO"])){
                                echo '';
                            } else {
                                echo '<div class="mes"><h2>Maio'.$ano.'</h2></div>';
                            }
                            break;
                        case 6:
                            if(empty($dadosMeses[$j]["ID_EVENTO"])){
                                echo '';
                            } else {
                                echo '<div class="mes"><h2>Junho'.$ano.'</h2></div>';
                            }
                            break;
                        case 7:
                            if(empty($dadosMeses[$j]["ID_EVENTO"])){
                                echo '';
                            } else {
                                echo '<div class="mes"><h2>Julho'.$ano.'</h2></div>';
                            }
                            break;
                        case 8:
                            if(empty($dadosMeses[$j]["ID_EVENTO"])){
                                echo '';
                            } else {
                                echo '<div class="mes"><h2>Agosto'.$ano.'</h2></div>';
                            }
                            break;
                        case 9:
                            if(empty($dadosMeses[$j]["ID_EVENTO"])){
                                echo '';
                            } else {
                                echo '<div class="mes"><h2>Setembro'.$ano.'</h2></div>';
                            }
                            break;
                        case 10:
                            if(empty($dadosMeses[$j]["ID_EVENTO"])){
                                echo '';
                            } else {
                                echo '<div class="mes"><h2>Outubro'.$ano.'</h2></div>';
                            }
                            break;
                        case 11:
                            if(empty($dadosMeses[$j]["ID_EVENTO"])){
                                echo '';
                            } else {
                                echo '<div class="mes"><h2>Novembro'.$ano.'</h2></div>';
                            }
                            break;
                        case 12:
                            if(empty($dadosMeses[$j]["ID_EVENTO"])){
                                echo '';
                            } else {
                                echo '<div class="mes"><h2>Dezembro'.$ano.'</h2></div>';
                            }
                            break;
                    }
                    
                    
                    for ($i = 0; $i < count($dadosMeses[$j]["ID_EVENTO"]); $i++) {
                        ?>
                        <div class="evento">
                            <?php
                            if (  $dadosMeses[$j]["STATUS_EVENTO"][$i] == 1 ) {
                                $status = 'Aberto';
                            } else if ($dadosMeses[$j]["STATUS_EVENTO"][$i] == 3) {
                                    $status = 'Aguardando Abertura';
                            }else  {
                                $status = 'Encerrado';
                            }
                            ?>
                        
                            <h5><?=$dadosMeses[$j]["NOME_EVENTO"][$i];?></h5>
                            <p><b>Status:</b> <?=$status;?></p>
                            <p><b>Data:</b> <?php echo date('d/m/Y', strtotime($dadosMeses[$j]["DATA"][$i])); ?></p>
                            <p><b>Horário:</b> <?=$dadosMeses[$j]["HORA"][$i];?></p>
                            <p><b>Local:</b> <?=$dadosMeses[$j]["LOCAL"][$i];?></p>
                            <p><b>Vagas:</b> <?=$gdb->buscaInscritosEvento($dadosMeses[$j]["ID_EVENTO"][$i])?></p>
                            <p><b>obs.:</b> <?=$dadosMeses[$j]["OBSERVACAO"][$i];?></p>
                            <input type="button" class="btn_1" onclick="document.getElementById('id_evento').value = <?= $dadosMeses[$j]['ID_EVENTO'][$i]; ?>; document.getElementById('frm_edicaoevento').submit()" value="Editar">
                            <input type="button"  class="btn_1" onclick="document.getElementById('id_evento_excel').value = <?= $dadosMeses[$j]['ID_EVENTO'][$i]; ?>; document.getElementById('frm_cursoExcel').submit()" value="Lista de Participantes">
                            <input type="button"  class="btn_1" onclick="document.getElementById('id_manutencao_participantes').value = <?= $dadosMeses[$j]['ID_EVENTO'][$i]; ?>; document.getElementById('frm_manutencao_participantes').submit()" value="Edição de Participantes">
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
            <hr width="100%" align="right" noshade>
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
        function update() {
            if ($('#nome_evento').val() == '') {
                alert('Informe o nome do evento!');
                $('#nome_evento').focus();
            } else if ($('#descricao').val() == '') {
                alert('Informe a descricao!');
                $('#descricao').focus();
            } else if ($('#ministrante').val() == '') {
                alert('Informe o(a) ministrante!');
                $('#ministrante').focus();
            } else if ($('#carga_horaria').val() == '') {
                alert('Informe a carga horária!');
                $('#carga_horaria').focus();
            } else if ($('#local').val() == '') {
                alert('Informe o local!');
                $('#local').focus();
            } else if ($('#vagas').val() == '') {
                alert('Informe a quantidade de vagas!');
                $('#vagas').focus();
            } else if ($('#data').val() == '') {
                alert('Informe a data!');
                $('#data').focus();
            } else if ($('#hora').val() == '') {
                alert('Informe o horário!');
                $('#hora').focus();
                // $('#btnSubmit').prop("disabled", false);
                //$('#btnSubmit').attr("disabled", false);
            }

            var form_data = new FormData();                  

            form_data.append('nome_evento', $('#nome_evento').val());
            form_data.append('descricao', $('#descricao').val());
            form_data.append('ministrante', $('#ministrante').val());
            form_data.append('carga_horaria', $('#carga_horaria').val());
            form_data.append('local', $('#local').val());
            form_data.append('vagas', $('#vagas').val());
            form_data.append('data', $('#data').val());
            form_data.append('hora', $('#hora').val());
            form_data.append('observacao', $('#observacao').val());
            form_data.append('status_evento', $("#status_evento option:selected").val() );

            $.ajax({
                type: "POST",
                url: "../banco/incluirEvento.php",
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                success: function(data) {
                    console.log(data);
                    let response = JSON.parse(data);
                    if (response['success'] == '1') {	
                        alert("Evento incluído com sucesso!");
                        document.location.reload(true);
                    } else {
                        alert(response['error']);
                    }
                },
                error: function(data) {
                    console.log(data);
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