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

    $id_evento = $gdb->vargetpost("idEvento");

    $gdb->open("SELECT * FROM evento e where id_evento = '$id_evento'");

    /*
    print "<pre>";             
    print_r($gdb);
    print "</pre>";
    die();
  */

    $nome_evento = $gdb->gs["NOME_EVENTO"][0];
    $descricao = $gdb->gs["DESCRICAO"][0];
    $ministrante = $gdb->gs["MINISTRANTE"][0];
    $carga_horaria = $gdb->gs["CARGA_HORARIA"][0];
    $local = $gdb->gs["LOCAL"][0];
    $vagas = $gdb->gs["VAGAS"][0];
    $data = $gdb->gs["DATA"][0];
    $hora = $gdb->gs["HORA"][0];
    $status_evento = $gdb->gs["STATUS_EVENTO"][0];
    $observacao = $gdb->gs["OBSERVACAO"][0];


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
        <!--::he$id_evento = $gdb->vargetpost("idEvento");

    $gdb->open("SELECT e.id_evento, e.nome_evento, e.descricao, e.ministrante, e.carga_horaria, e.local, e.vagas, e.data, e.hora
                FROM evento e where id_evento = '$id_evento'");

    $nome_evento = $gdb->gs["NOME_EVENTO"][0];
    $descricao = $gdb->gs["DESCRICAO"][0];
    $ministrante = $gdb->gs["MINISTRANTE"][0];
    $carga_horaria = $gdb->gs["CARGA_HORARIA"][0];
    $local = $gdb->gs["LOCAL"][0];
    $vagas = $gdb->gs["VAGAS"][0];
    $data = $gdb->gs["DATA"][0];
    $hora = $gdb->gs["HORA"][0];

    ?>

    <!doctype html>
    <html lang="pt-br">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Minhoca na Cabeça</title>
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
        <link reader inicio::-->
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

        <!-- cursos inicio -->
        <section class="philosophy_part section_padding">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-lg-12 col-md-12">
                        <h5>Informações do evento</h5>
                        <form id="frm">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="nome_evento">Nome do evento</label>
                                    <input type="text" class="form-control" id="nome_evento" value="<?=$nome_evento;?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="descricao">Descrição</label>
                                    <input type="textarea" class="form-control" id="descricao" value="<?=$descricao;?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="ministrante">Ministrante</label>
                                    <input type="text" class="form-control" id="ministrante" value="<?=$ministrante;?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="carga_horaria">Carga Horária</label>
                                    <input type="text" class="form-control" id="carga_horaria" value="<?=$carga_horaria;?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="local">Local</label>
                                    <input type="text" class="form-control" id="local" value="<?=$local;?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="vagas">Vagas</label>
                                    <input type="text" class="form-control" id="vagas" value="<?=$vagas;?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="data">Data</label>
                                    <input type="text" class="form-control" id="data" value="<?php echo date('d/m/Y', strtotime($data)); ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="hora">Horário</label>
                                    <input type="time" class="form-control" id="hora" value="<?=$hora;?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="hora">Status</label>
                                    <?PHP print "Estatus : ".$status_evento; ?>
                                    <select id="status_evento" class="form-control"  >
                                        <option value="0" <?PHP if( $status_evento == '0') print 'Selected'; ?> >Encerrar</option>
                                        <option value="1" <?PHP if( $status_evento == '1') print 'Selected'; ?> >Aberto</option>
                                        <option value="3" <?PHP if( $status_evento == '3') print 'Selected'; ?> >Aguardar Abertura</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="hora">Observação</label>
                                    <textarea name="observacao" id="observacao" class="form-control" rows="2" cols="100" ><?=$observacao;?></textarea>
                                </div>                                                                
                            </div>
                            <br>
                            <div class="col-md-6">
                                <input type="button" name="btnSubmitEnviar"   class="btn btn-primary " onclick="update()"    id="IDbtnSubmitEnviar"  value="Enviar"> 
                                <!--<input type="button" name="btnSubmitEncerrar"  class="btn btn-warning"  onclick="encerrar()" id="IDbtnSubmitEncerrar"  value="Encerrar"> -->
                                <input type="button" name="btnSubmitExcluir"   class="btn btn-dark"  onclick="excluir()"  id="IDbtnSubmitExcluir"  value="Excluir">
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- cursos fim -->


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
                $('#btnSubmit').prop("disabled", false);
                //$('#btnSubmit').attr("disabled", false);
            }

                var form_data = new FormData();                  

                form_data.append('id_evento', '<?=$id_evento;?>');
                form_data.append('nome_evento', $('#nome_evento').val());
                form_data.append('descricao', $('#descricao').val());
                form_data.append('ministrante', $('#ministrante').val());
                form_data.append('local', $('#local').val());
                form_data.append('carga_horaria', $('#carga_horaria').val());
                form_data.append('vagas', $('#vagas').val());
                form_data.append('data', $('#data').val());
                form_data.append('hora', $('#hora').val());
                form_data.append('status_evento', $("#status_evento option:selected").val() );
                form_data.append('observacao', $('#observacao').val());

                $.ajax({
                    type: "POST",
                    url: "../banco/editarEvento.php",
                    dataType: "text",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    success: function(data) {
                        let response = JSON.parse(data);
                        if (response['success'] == '1') {	
                            alert("Evento editado com sucesso!");
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

            function encerrar() {
                var form_data = new FormData();                  

                form_data.append('id_evento', '<?=$id_evento;?>');

                $.ajax({
                    type: "POST",
                    url: "../banco/encerrarEvento.php",
                    dataType: "text",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    success: function(data) {
                        let response = JSON.parse(data);
                        if (response['success'] == '1') {	
                            alert("Evento encerrado com sucesso!");
                            document.getElementById('frm_eventos').submit()
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

            function excluir() {
                var form_data = new FormData();                  

                form_data.append('id_evento', '<?=$id_evento;?>');

                $.ajax({
                    type: "POST",
                    url: "../banco/excluirEvento.php",
                    dataType: "text",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    success: function(data) {
                        let response = JSON.parse(data);
                        if (response['success'] == '1') {	
                            alert("Evento excluido com sucesso!");
                            document.getElementById('frm_eventos').submit()
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