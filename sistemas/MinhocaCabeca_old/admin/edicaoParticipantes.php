<?php
include_once("../banco/gdb.php");
$gdb = new gdb();

$user = $gdb->vargetpost('user');
$password = $gdb->vargetpost('password');
$pass = md5($password);



$id_evento = $gdb->vargetpost('idEvento');

$gdb->open("SELECT id_usuario_admin FROM usuarioAdmin WHERE email_admin = '$user' AND senha = '$pass'");

if(empty($gdb->gs["ID_USUARIO_ADMIN"][0])) {
    header('Location:index.php');
} else {
    $id_usuario_admin = $gdb->gs["ID_USUARIO_ADMIN"][0];

    $gdb->open("SELECT sm.status_mensagem FROM statusMensagem sm WHERE sm.status_mensagem = '1'");
    $temMensagem = $gdb->gs["STATUS_MENSAGEM"];

    $gdb->open("SELECT p.id_pessoa, p.cpf, p.nome, ei.status_inscricao
				FROM pessoa p
			LEFT JOIN documentoPessoa d ON p.id_pessoa = d.id_pessoa
			LEFT JOIN eventoInscricao ei ON ei.id_pessoa = p.id_pessoa
			LEFT JOIN evento e ON e.id_evento = ei.id_evento
			WHERE ei.status_inscricao = 1
			AND e.id_evento = '$id_evento'");
    
    $id_pessoa = $gdb->gs["ID_PESSOA"];
    $cpf = $gdb->gs["CPF"];
    $nome = $gdb->gs["NOME"];
    $status_inscricao = $gdb->gs["STATUS_INSCRICAO"];
    

    

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
        <form id="frm_vermais" method="POST" action="../banco/inscricaoEventoAdmin.php">
            <input type="hidden" id="id_pessoa" name="idPessoa">
            <input type="hidden" name="user" value="<?=$user;?>">
            <input type="hidden" name="password" value="<?=$password;?>">
        </form>
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

        <!-- meus dados inicio -->
        <section class="philosophy_part section_padding1">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-lg-12 col-md-12">
                        <div class="philophy_text">
                            <h2>Participantes Inscritos</h2>
                            <p>Ao clicar no nome do participante automaticamente será cadastrado no evento!</p>
                            <div class="form-group">
                                <input id="autocomplete" type="text" class="form-control" aria-label="Text input with dropdown button">
                            </div>
                            <form>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th align="center" ><b>Nome</b></th>
                                            <th align="center" ><b>CPF</b></th>
                                            <th align="center" ><b>Cancelar Inscrição</b></th>
                                        </tr>	
                                    </thead>
                                    <tbody id="tbody">					
                                    <?php
                                    for ($i = 0; $i < count($gdb->gs["ID_PESSOA"]); $i++) {
                                        ?>
                                        <tr>
                                            <td align="left"   ><?= $nome[$i]; ?></td>
                                            <td align="center" ><?= $cpf[$i]; ?></td>
                                            <td align="center" ><input name="btnSubmit" onclick="javascript:cancelarInscricao(<?=$id_pessoa[$i]?>);" id="btnSubmit" class="btn btn-primary botao" value="Cancelar Inscrição"></td>		   
                                        </tr>	
                                        <?php
                                        }
                                        ?>					 						
                                    </tbody>
                                </table>
                            </form>  
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- meus dados fim -->

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

    </hmtl>


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
    <!-- custom js 
    <script src="../js/custom.js"></script>-->
     <!--autocomplete-->                                   
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script>
        function cancelarInscricao(idPessoa) {
            
            var form_data = new FormData();  
            form_data.append('id_pessoa',idPessoa);    
            form_data.append('id_evento',<?=$id_evento;?>);

            $.ajax({
                type: "POST",
                url: "../banco/cancelaInscricaoAdmin.php", 
                dataType: "text",
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                success: function(data) {
                    let response = JSON.parse(data);
                    if (response['success'] == '1') {
                        alert("A inscrição foi cancelada com sucesso!");
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
        function realizarInscricao(idPessoa) {
            
            var form_data = new FormData();  
            form_data.append('id_pessoa', idPessoa);    
            form_data.append('id_evento', <?=$id_evento;?>);

            $.ajax({
                type: "POST",
                url: "../banco/fazerInscricaoAdmin.php", 
                dataType: "text",
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                success: function(data) {
                    let response = JSON.parse(data);
                    if (response['success'] == '1') {
                        alert("A inscrição foi realizada com sucesso!");
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
        $( function() {
            $( "#autocomplete" ).autocomplete({
                source: '../banco/getNomes.php',
                minLength: 1,
                select: function( event, ui ) {
                    realizarInscricao(ui.item.id);
                }
            });
        });
    </script>
<?php 
}
?>