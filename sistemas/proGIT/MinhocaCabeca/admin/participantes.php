<?php
include_once("../banco/gdb.php");
$gdb = new gdb();
$gdb2 = new gdb();

$user = $gdb->vargetpost('user');
$password = $gdb->vargetpost('password');
$pass = md5($password);

$gdb->open("SELECT id_usuario_admin 
              FROM usuarioAdmin 
             WHERE email_admin = '$user' 
               AND senha = '$pass'");

if(empty($gdb->gs["ID_USUARIO_ADMIN"][0])) {
    header('Location:index.php');
} else {
    $id_usuario_admin = $gdb->gs["ID_USUARIO_ADMIN"][0];

    $gdb->open("SELECT sm.status_mensagem 
                  FROM statusMensagem sm 
                 WHERE sm.status_mensagem = '1'");
    $temMensagem = $gdb->gs["STATUS_MENSAGEM"];

    $limite = 30;
    $pagina = $_POST['pag'];
    if(!$pagina){
        $pagina = 1;
    }
    $inicio = ($pagina * $limite) - $limite;

    $gdb->open("SELECT COUNT(*) AS TOTAL_REGISTROS  
                  FROM pessoa p 
             LEFT JOIN usuario u       ON u.id_pessoa = p.id_pessoa
             LEFT JOIN statusUsuario s ON s.id_usuario = u.id_usuario
                 WHERE s.status_usuario IS NOT NULL
                   AND s.status_usuario <> ''");

    $paginas = (ceil($gdb->gs["TOTAL_REGISTROS"][0]/$limite) == 0) ? 1 : ceil($gdb->gs["TOTAL_REGISTROS"][0]/$limite);


    $gdb->open("SELECT distinct 
					   p.id_pessoa, 
                       p.cpf, 
                       p.nome, 
                       p.email, 
                       p.telefone, 
                       p.celular, 
                       p.numero, 
                       p.complemento, 
                       p.id_endereco, 
                       p.quantidade_pessoa,
                       e.id_endereco, 
                       e.cep, 
                       e.logradouro, 
                       e.bairro, 
                       e.cidade, 
                       t.id_troca, 
                       t.id_pessoa, 
                       t.data_troca,                        
                       su.id_usuario, 
                       su.status_usuario
                  FROM pessoa p
             LEFT JOIN endereco e ON e.id_endereco = p.id_endereco
             LEFT JOIN minhocario t ON t.id_pessoa = p.id_pessoa
             LEFT JOIN usuario u ON u.id_pessoa = p.id_pessoa
             LEFT JOIN statusUsuario su ON u.id_usuario = su.id_usuario
                 WHERE su.status_usuario IS NOT NULL
                   AND su.status_usuario <> ''
              ORDER BY p.nome
                LIMIT $inicio, $limite");

    $id_pessoa = $gdb->gs["ID_PESSOA"];
    $cpf = $gdb->gs["CPF"];
    $nome = $gdb->gs["NOME"];
    $email = $gdb->gs["EMAIL"];
    $telefone = $gdb->gs["TELEFONE"];
    $celular = $gdb->gs["CELULAR"];
    $numero = $gdb->gs["NUMERO"];
    $complemento = $gdb->gs["COMPLEMENTO"];
    $quantidade_pessoa = $gdb->gs["QUANTIDADE_PESSOA"];
    $cep = $gdb->gs["CEP"];
    $logradouro = $gdb->gs["LOGRADOURO"];
    $bairro = $gdb->gs["BAIRRO"];
    $cidade = $gdb->gs["CIDADE"];
    $data_troca = $gdb->gs["DATA_TROCA"];
    $status_usuario = $gdb->gs["STATUS_USUARIO"];
    $id_troca = $gdb->gs["ID_TROCA"];
    $id_usuario = $gdb->gs["ID_USUARIO"];

   
    

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
        <!-- <link rel="stylesheet" href="../css/nice-select.css"> -->
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
                                        <a class="nav-link" href="#" onclick="document.getElementById('frm_eventos').submit()">Eventos</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#" onclick="document.getElementById('frm_participantes').submit()">Participantes</a><a class="alerta"></a>
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
        <form id="frm_vermais" method="POST" action="detalhesParticipantes.php">
            <input type="hidden" id="id_pessoa" name="idPessoa">
            <input type="hidden" name="user" value="<?=$user;?>">
            <input type="hidden" name="password" value="<?=$password;?>">
        </form>
        <form id="frm_paginacao" method="POST" action="participantes.php">
            <input type="hidden" name="user" value="<?=$user;?>">
            <input type="hidden" name="password" value="<?=$password;?>">
            <input type="hidden" id="pag" name="pag">
        </form>

        

        <!-- meus dados inicio -->
        <section class="philosophy_part section_padding">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-lg-12 col-md-12">
                        <div class="philophy_text">
                            <h2>Participantes</h2>
                        <div class="form-group">
                            <input id="autocomplete" type="text" class="form-control" aria-label="Text input with dropdown button">
                        </div>
                        <div id="accordion">
                        <?php
						$ids = 0;
						$cpf = '';
                        foreach( $gdb->gs["NOME"] as $i=>$value ) {
							if( $cpf != $value ){
								$ids = $gdb->gs["ID_PESSOA"][$i];
								
                            ?>
                            <div class="card">
                                <div class="card-header" id="heading<?=$i?>">
                                <h5 class="mb-0">
                                    <button class="btn btn" data-toggle="collapse" data-target="#collapse<?=$i?>" aria-expanded="<?= ($i == 1) ? 'true' : 'false'?>" aria-controls="collapse<?=$i?>">
                                        <b><?=$nome[$i];?></b>&emsp;<b><?=$cpf[$i];?></b>&emsp;<b><?=$email[$i];?></b>&emsp;<b><?=$celular[$i];?></b>&emsp;<b>
                                        <?php
                                                switch ($gdb->gs["STATUS_USUARIO"][$i]) {
                                                    case '1':
                                                        echo "Ativo";
                                                        break;
                                                    case '2':
                                                        echo "Inativo";
                                                        break;
                                                    case '3':
                                                        echo "Fila Espera";
                                                        break;
                                                    default:
                                                        echo $gdb->gs["STATUS_USUARIO"][$i];
                                                        break;
                                                }
                                            ?>
                                            </b>
                                    </button>
									<input type="button" class="btn btn-link" onclick="document.getElementById('id_pessoa').value = '<?=$gdb->gs['ID_PESSOA'][$i];?>'; document.getElementById('frm_vermais').submit()" value="Ver mais">
                                </h5>
                                </div>

                                <div id="collapse<?=$i?>" class="collapse show" aria-labelledby="heading<?=$i?>" data-parent="#accordion">
                                <div>
                                    <p><?=$logradouro[$i];?>, nº <?=$numero[$i];?> - <?=$bairro[$i];?> - <?=$cidade[$i];?> - CEP: <?=$cep[$i];?></p>
                                    <p><b>
                                        <?php 
										
											$data_troca = "";
											$gdb2->open("SELECT t.id_troca, t.id_pessoa, t.data_troca
														   FROM pessoa p
													  LEFT JOIN minhocario t ON t.id_pessoa = p.id_pessoa
													  LEFT JOIN usuario u ON u.id_pessoa = p.id_pessoa
													  LEFT JOIN statusUsuario su ON u.id_usuario = su.id_usuario
														  WHERE su.status_usuario IS NOT NULL
															AND su.status_usuario <> ''
															AND p.id_pessoa = '$ids'				   
													  ORDER BY data_troca");
										
                                            for ($i2 = 0; $i2 < (count($gdb2->gs["ID_TROCA"]) > 3 ? 3 : count($gdb2->gs["ID_TROCA"])); $i2++) {
                                                 $data_troca .= $gdb2->gs["DATA_TROCA"][$i2]." | ";
                                            }
											
											if( $data_troca !=''){
												print 'Trocas : '.$data_troca;
											}
											
                                        ?>
                                        </b>
                                    </p>                                    
                                </div>
                                </div>
                            </div>
                            <?php
								}
								$cpf = $value;
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>
        <!-- meus dados fim -->

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
        
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="/resources/demos/style.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <!-- <script src="../js/jquery-1.12.1.min.js"></script> -->
        <!-- popper js -->
        <!-- <script src="../js/popper.min.js"></script> -->
        <!-- bootstrap js -->
        <!-- <script src="../js/bootstrap.min.js"></script> -->
        <!-- easing js -->
        <!-- <script src="../js/jquery.magnific-popup.js"></script> -->
        <!-- masonry js -->
        <!-- <script src="../js/masonry.pkgd.js"></script> -->
        <!-- particles js -->
        <!-- <script src="../js/owl.carousel.min.js"></script> -->

        <!-- <script src="../js/jquery.nice-select.min.js"></script> -->
        <!-- custom js -->
        <!-- <script src="../js/custom.js"></script> -->
        <script>
            function changePag(pag) {
                document.getElementById('pag').value = pag; 
                document.getElementById('frm_paginacao').submit();
            }
        </script>

        <script>
        $( function() {
            $( "#autocomplete" ).autocomplete({
            source: '../banco/getNomes.php',
            minLength: 1,
            select: function( event, ui ) {
                document.getElementById('id_pessoa').value = ui.item.id; document.getElementById('frm_vermais').submit()
            }
            });
        });
        </script>

    </body>

    </html>
<?php 
}
?>