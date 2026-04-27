<?php
include_once("../banco/gdb.php");
$gdb = new gdb();

$user = $gdb->vargetpost('user');
$password = $gdb->vargetpost('password');
$pass = md5($password);

$gdb->open("SELECT id_usuario_admin 
             FROM usuarioAdmin 
			WHERE email_admin = '$user' 
			  AND senha = '$pass'");

if(empty($gdb->gs["ID_USUARIO_ADMIN"][0])) {
    header('Location: php');
} else {
    $id_usuario_admin = $gdb->gs["ID_USUARIO_ADMIN"][0];

    $gdb->open("SELECT sm.status_mensagem FROM statusMensagem sm WHERE sm.status_mensagem = '1'");
    $temMensagem = $gdb->gs["STATUS_MENSAGEM"];

    $limite = 30;
    $pagina = $_POST['pag'];
    if(!$pagina){
        $pagina = 1;
    }
    $inicio = ($pagina * $limite) - $limite;


    $gdb->open("SELECT COUNT(*) AS TOTAL_REGISTROS 
              	  FROM pessoa p 
				  
             LEFT JOIN usuario u 
			        ON u.id_pessoa = p.id_pessoa
					
             LEFT JOIN statusUsuario s 
			        ON s.id_usuario = u.id_usuario
					
                WHERE s.status_usuario = '3'  ");

    $paginas = (ceil($gdb->gs["TOTAL_REGISTROS"][0]/$limite) == 0) ? 1 : ceil($gdb->gs["TOTAL_REGISTROS"][0]/$limite);
    
   // $gdb->open(" update statusUsuario  set status_usuario = '1' where status_usuario = '3' ");

    $gdb->open("SELECT p.id_pessoa, 
	                   p.cpf, p.nome, 
					   p.email, 
					   p.telefone, 
					   p.celular, 
					   u.id_pessoa, 
					   u.id_usuario, 
					   s.id_usuario, 
					   s.status_usuario 
				  FROM pessoa p
				  
             LEFT JOIN usuario u 
			        ON u.id_pessoa = p.id_pessoa
					
             LEFT JOIN statusUsuario s 
			        ON s.id_usuario = u.id_usuario
					
                WHERE s.status_usuario = '3'
				
                LIMIT $inicio, $limite");

    $id_pessoa = $gdb->gs["ID_PESSOA"];
    $cpf = $gdb->gs["CPF"];
    $nome = $gdb->gs["NOME"];
    $email = $gdb->gs["EMAIL"];
    $telefone = $gdb->gs["TELEFONE"];
    $celular = $gdb->gs["CELULAR"];
    $id_usuario = $gdb->gs["ID_USUARIO"];
    $status_usuario = $gdb->gs["STATUS_USUARIO"];

    

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
                                        <a class="nav-link" href="#" onclick="document.getElementById('frm_eventos').submit()">Eventos</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#" onclick="document.getElementById('frm_participantes').submit()">Participantes</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#" onclick="document.getElementById('frm_filaEspera').submit()">Fila de Espera</a><a class="alerta"></a>
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
        <form id="frm_paginacao" method="POST" action="filaEspera.php">
            <input type="hidden" name="user" value="<?=$user;?>">
            <input type="hidden" name="password" value="<?=$password;?>">
            <input type="hidden" id="pag" name="pag">
        </form>

        <!-- meus dados inicio -->
        <section class="philosophy_part section_padding1">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-lg-12 col-md-12">
                        <div class="philophy_text">
                            <h2>Fila de Espera</h2>
                            <form>
                                <div class="form-group">
                                    <label for="mensagem">Mensagem</label>
                                    <textarea class="form-control" id="texto" name="texto" rows="3"></textarea>
                                </div>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th align="center" ><b>Nome</b></th>
                                            <th align="center" ><b>CPF</b></th>
                                            <th align="center" ><b>Email</b></th>
                                            <th align="center" ><b>Celular</b></th>
                                            <th align="center" ><b>Telefone</b></th>
                                            <th align="center" ><b>Situa&ccedil;&atilde;o</b></th>
                                            <th align="center" ><b>Opera&ccedil;&atilde;o</b></th>
                                        </tr>	
                                    </thead>
                                    <tbody id="tbody">					
                                    <?php
                                    for ($i = 0; $i < count($gdb->gs["ID_PESSOA"]); $i++) {
                                        ?>
                                        <tr>
                                            <td align="left"   ><?= $nome[$i]; ?></td>
                                            <td align="center" ><?= $cpf[$i]; ?></td>
                                            <td align="left"   ><?= $email[$i]; ?></td>
                                            <td align="left"   ><?= $celular[$i]; ?></td>
                                            <td align="left"   ><?= $telefone[$i]; ?></td>
                                            <td align="center" >
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
                                            </td>
                                            <td align="center" >
                                                <?php
                                                    switch ($gdb->gs["STATUS_USUARIO"][$i]) {
                                                        case '1':
                                                            echo "Enviado";
                                                            break;
                                                        case '2':
                                                            echo "Inativo";
                                                            break;
                                                        case '3':
                                                            echo "<input type='checkbox' name='checkbox' id='".$id_pessoa[$i]."'> \n";
                                                            echo "<label for='checkbox'>Enviar</label>\n";
                                                            break;
                                                        default:
                                                            echo $gdb->gs["STATUS_USUARIO"][$i];
                                                            break;
                                                    }
                                                    ?>
                                            </td>
                                            <td align="center" >
                                                <?php
                                                    switch ($gdb->gs["STATUS_USUARIO"][$i]) {
                                                        case '1':
                                                            echo "";
                                                            break;
                                                        case '2':
                                                            echo "<input type='button' value='Voltar para fila' onclick='voltarFila(\"".$gdb->gs["ID_USUARIO"][$i]."\");' />\n";
                                                            break;
                                                        case '3':
                                                            echo "";
                                                            break;
                                                        default:
                                                            echo $gdb->gs["STATUS_USUARIO"][$i];
                                                            break;
                                                    }
                                                    ?>
                                            </td>					   
                                        </tr>	
                                        <?php
                                        }
                                        ?>					 						
                                        <tr>
                                        <th align="center"  colspan="9" >
                                        <input name="btnSubmit" onclick="javascript:enviarEmail();" id="btnSubmit" class="btn btn-primary botao" value="Enviar">
                                        </th>						  
                                        </tr>
                                    </tbody>
                                </table>
                            </form>  
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

        
            function voltarFila(idUsuario)
            {
                var form_data = new FormData();

                form_data.append('id_usuario', idUsuario);

                $.ajax({
                        type: "POST",
                        url: "../banco/voltarFila.php",
                        dataType: "text",
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,
                        success: function(data) {
                            let response = JSON.parse(data);
                            if (response['success'] == '1') {
                                alert("Participante adicionado à fila de espera com sucesso!");
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
            function enviarEmail()
            {
                var form_data = new FormData();

                var pessoas = [];
				$("#tbody input[type=checkbox]:checked").each(function(x){pessoas.push($(this).attr('id'))});
                if(pessoas.length == 0) {
                    alert("Não foi selecionado nenhum participante para enviar e-mail");
                } else {
					form_data = {
						 "texto": $("#texto").val(),
						 "pessoas": pessoas
					 };
                     
                    $.ajax({
                        type: "POST",
                        url: "../banco/enviaremail.php",
                        dataType: "json",
                        data: form_data,
                        success: function(form_data) {
                            if (form_data['success'] == '1') {
                                alert("E-mail enviado com sucesso! Total de pessoas : " + form_data['total'] );
								
                            } else {
                                alert(form_data['error']);
                            }

                        },
                        error: function( form_data ) {
                            alert(form_data['error']);
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