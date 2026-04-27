<?php

/*
$captcha = $_POST["g-recaptcha-response"];

$ok  = false;

if( $captcha != "" ){    
	$secreto  = '6Lf0zBsaAAAAAIvyKbJg6ruDd9ixTJxky1JQ1umm';
	$ip		  = $_SERVER["REMOTE_ADDR"];
	$var      = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secreto&response=$captcha&remoteip=$ip");
	$resposta = json_decode($var,true);

	if( $resposta['success'] ){
		$ok = true;
	}

}


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
$pass     = md5($password);


if( substr_count( strtolower( $user ), 'select' ) != 0 or substr_count( strtolower( $user ), 'union' ) != 0 ){
    $user = 'invalido@invalido.com.br';
}else{ 
    $gdb->open("SELECT * FROM usuario WHERE login = '$user' AND senha = '$pass' ");
	//print "<pre>";
	//print_r ($gdb);
	//print "</pre>";
	//dead();
	
    // $gdb->open("SELECT ID_PESSOA FROM usuario WHERE login = '$user' ",1);
}

if(  $gdb->linhas == 0 ) {
    $msg = "Seu acesso não foi validado !";    
    header("location:index.php?msg=$msg");
} else {
	
	
    $id_pessoa = $gdb->gs["ID_PESSOA"][0];

	
    $gdb->open("SELECT u.id_usuario, u.id_pessoa FROM usuario u LEFT JOIN pessoa p ON u.id_pessoa = p.id_pessoa 
    WHERE p.id_pessoa = '$id_pessoa'");
    
    $id_usuario = $gdb->gs["ID_USUARIO"][0];
	
	$gdb->open("SELECT su.status_usuario from statusUsuario su where su.id_usuario = '$id_usuario'");
    $status_usuario = $gdb->gs["STATUS_USUARIO"][0];

    $gdb->open("SELECT sm.status_mensagem FROM mensagem m
    LEFT JOIN usuario u ON m.id_usuario = u.id_usuario
    LEFT JOIN statusMensagem sm ON m.id_mensagem = sm.id_mensagem
    where u.id_usuario = '$id_usuario' AND sm.status_mensagem = '1'");
    $temMensagem = $gdb->gs["STATUS_MENSAGEM"];
    

    $gdb->open("SELECT p.nome, p.email, p.telefone, p.celular, p.profissao, p.numero, p.complemento, p.quantidade_pessoa, p.id_endereco, e.id_endereco, replace(e.cep,'-','') as cep, e.logradouro, e.bairro FROM pessoa p
                LEFT JOIN endereco e ON e.id_endereco = p.id_endereco WHERE id_pessoa = '$id_pessoa'");

    $nome = $gdb->gs["NOME"][0];
    $email = $gdb->gs["EMAIL"][0];
    $telefone = $gdb->gs["TELEFONE"][0];
    $celular = $gdb->gs["CELULAR"][0];
    $profissao = $gdb->gs["PROFISSAO"][0];
    $numero = $gdb->gs["NUMERO"][0];
    $complemento = $gdb->gs["COMPLEMENTO"][0];
    $quantidade_pessoa = $gdb->gs["QUANTIDADE_PESSOA"][0];
    $cep = $gdb->gs["CEP"][0];
    $logradouro = $gdb->gs["LOGRADOURO"][0];
    $bairro = $gdb->gs["BAIRRO"][0];
    $id_endereco = $gbd->gs["ID_ENDERECO"][0];

    $gdb->open("SELECT COUNT(m.data_troca) AS quantidade 
                  from minhocario m 
                 where m.id_pessoa = '$id_pessoa'");
    
    $quantidade = $gdb->gs["QUANTIDADE"][0];

    $gdb->open(" SELECT m.id_troca, 
                        m.id_pessoa, 
                        m.data_troca
                   from minhocario m 
                  where m.id_pessoa = '$id_pessoa' 
               order by m.data_troca desc ");
    
    $id_troca = $gdb->gs["ID_TROCA"];

    $data_troca = $gdb->gs["DATA_TROCA"];

    $quantidade_troca = empty($gdb->gs["DATA_TROCA"][0]) ? 0 : count($gdb->gs["DATA_TROCA"]);
    
    $desviado = 15.9;

    $total = $quantidade_troca * $desviado;

    $gdb->open("   SELECT e.id_evento, 
                          e.nome_evento, 
                          e.data, 
                          e.hora, 
                          e.local 
                     FROM evento e 
                LEFT JOIN eventoInscricao ei 
                       ON ei.id_evento = e.id_evento
                    WHERE ei.id_pessoa = '$id_pessoa' 
                      AND ei.status_inscricao = '1'");

    $id_evento   = $gdb->gs["ID_EVENTO"][0];
    $nome_evento = $gdb->gs["NOME_EVENTO"][0];
    $data        = $gdb->gs["DATA"][0];
    $hora        = $gdb->gs["HORA"][0];
    $local       = $gdb->gs["LOCAL"][0];


    $gdb->open("SELECT ei.status_inscricao FROM eventoInscricao ei where ei.id_pessoa = '$id_pessoa'");
    $status_inscricao = $gdb->gs["STATUS_INSCRICAO"][0];

    $gdb->open("SELECT u.id_usuario, u.id_pessoa FROM usuario u left join pessoa p on u.id_pessoa = p.id_pessoa 
    where p.id_pessoa = '$id_pessoa'");
    
    $id_usuario = $gdb->gs["ID_USUARIO"][0];

    $gdb->open("SELECT su.status_usuario from statusUsuario su where su.id_usuario = '$id_usuario'");
    $status_usuario = $gdb->gs["STATUS_USUARIO"][0];

    $gdb->open("SELECT m.id_mensagem, m.id_usuario, m.id_usuario_admin, m.assunto, m.mensagem, m.resposta, m.data_envio, m.data_resposta FROM mensagem m 
    left join usuario u on m.id_usuario = u.id_usuario 
    where u.id_usuario = '$id_usuario'");

    $id_mensagem_usuario = $gdb->gs["ID_MENSAGEM"][0];
    $assunto = $gdb->gs["ASSUNTO"];
    $mensagem = $gdb->gs["MENSAGEM"];
    $resposta = $gdb->gs["RESPOSTA"];
    $data_envio = $gdb->gs["DATA_ENVIO"];
    $data_resposta = $gdb->gs["DATA_RESPOSTA"];
    $id_usuario_admin = $gdb->gs["ID_USUARIO_ADMIN"];

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
                            <a class="navbar-brand" href="index.html"> <img id="logo" class="img-fluid" src="img/logom.jpg" alt="logo"> </a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="menu_icon"><i class="ti-menu"></i></span>
                            </button>

                            <div class="collapse navbar-collapse main-menu-item" id="navbarSupportedContent">
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <a class="nav-link" href="#" onclick="document.getElementById('frm_sistema').submit()">Inicio</a> <a class="alerta"></a>
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

        <form id="frm_sistema" name="frm_sistema"  method="POST" action="sistemaUsuario.php">
            <input type="hidden" name="user" value="<?= $user; ?>">
            <input type="hidden" name="password" value="<?= $password; ?>">
        </form>
        <form id="frm_mensagens" name="frm_mensagens" method="POST" action="mensagensUsuario.php">
            <input type="hidden" name="user" value="<?= $user; ?>">
            <input type="hidden" name="password" value="<?= $password; ?>">
        </form>
        <form id="frm_eventos"  name="frm_eventos" method="POST" action="eventosUsuario.php">
            <input type="hidden" name="user" value="<?= $user; ?>">
            <input type="hidden" name="password" value="<?= $password; ?>">
        </form>
        <form id="frm_certificado" name="frm_certificado" method="POST" action="certificadoNovo.php">
            <input type="hidden" name="user" value="<?= $user; ?>">
            <input type="hidden" name="password" value="<?= $password; ?>">
        </form>
        <form id="frm_comprovante"  action="comprovanteNovo.php" method="POST">
            <input type="hidden"  name="id_pessoa" value="<?=$id_pessoa; ?>">
            
        </form>

        <!-- caixas inicio -->
        <section class="philosophy_part section_padding">
                <div class="container">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-lg-12 col-md-12">
                            <p id="bemvindo"><b>Bem-vindo(a), <?=$nome?>!</b></p>
                            <p id="usuario"><?php
                                if($status_usuario == 2){
                                    echo '<b>Você está com inscrição inativa no projeto, caso queira retornar ao projeto envie um e-mail para minhocanacabeca.comcap@gmail.com</b>';
                                } else if ($status_usuario == 3){
                                    echo '<b>Você está na fila de espera, caso abram vagas, você receberá um e-mail</b>';
                                }else{
                                    echo '';
                                }
                                ?></p>
					<? if ( $status_usuario != 3 && $status_usuario != 2 ) { ?>			
                            <div class="philophy_text">
                                <h5>Minhas caixas</h5>
                                <div class="card-deck">
                                    <div class="card">
                                        <div class="card-body">
                                            <h2>Nova troca</h2>
                                            <p>Que bom, você fez uma nova troca!</p>
                                            <p>Nos conte quando foi feita a troca.</p> <br>
                                            <input type="date" name="troca" id="troca" placeholder="01/01/2020">
                                            <input name="btnSubmit" onclick="inserirTroca()" id="btnSubmit" class="btn btn-success" value="Enviar">
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <h2>Resumo da produção</h2>
                                            <p><b>Trocas feitas:</b> <?=$quantidade_troca?></p>
                                            <p><b>Desviado do aterro:</b> <?=$total?></p>
                                            <p><b>Co2 poupado:</b> <?=$total?></p>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <h2>Últimas trocas</h2>
                                            <?php
                                            for ($i = 0; $i < (count($data_troca) > 3 ? 3 : count($data_troca)); $i++) {
                                                ?>
                                            <p><?php echo date('d/m/Y', strtotime($data_troca[$i])); ?></p> 
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
				<? } ?>			
                        </div>
                    </div>
                </div>
        </section>
        <!-- caixas fim -->

        <!-- mensagens inicio-->
        <section class="about_part section_padding">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-lg-12 col-md-12">
                        <div class="philophy_text">
                            <div class="card-deck">
                                <div class="card">
                                    <div class="card-body">
                                        <h2>Envie uma mensagem</h2>
                                        <form>
                                            <div class="form-group">
                                                <label for="assunto">Assunto</label>
                                                <input type="text" class="form-control" id="assunto">
                                            </div>
                                            <div class="form-group">
                                                <label for="mensagem">Mensagem</label>
                                                <textarea class="form-control" id="mensagem" rows="3"></textarea>
                                            </div>
                                            <input type="button" onclick="enviarMensagem(<?=$id_usuario?>)" class="btn btn-success" value="Enviar">
                                        </form>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h2>Mensagens recebidas</h2>
                                        <div class="accordion" id="accordionExample">
                                        <?php
                                        for ($i = 0; $i < (count($gdb->gs["MENSAGEM"]) > 2 ? 2 : count($gdb->gs["MENSAGEM"])); $i++) {
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
                                                        <p><?=$mensagem[$i];?></p> <br>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                        <a class="btn btn-success" href="#" onclick="document.getElementById('frm_mensagens').submit()">Mensagens</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- mensagens fim-->

        <!-- meus dados inicio -->
        <section class="philosophy_part section_padding">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-lg-12 col-md-12">
                        <div class="philophy_text">
                            <h5>Meus dados</h5>
                            <div class="card-deck">
                                <div class="card">
                                    <div class="card-body">
                                        <h2>Atualizar dados</h2>
                                        <form>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <label for="email">E-mail</label>
                                                    <input type="text" class="form-control" id="email" onblur="validateEmail();"  value="<?= $email; ?>">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="telefone">Telefone</label>
                                                    <input type="text" class="form-control" id="telefone" value="<?= $telefone; ?>">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="celular">Celular</label>
                                                    <input type="text" class="form-control" id="celular" value="<?= $celular; ?>">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="profissao">Profissão</label>
                                                    <input type="text" class="form-control" id="profissao" value="<?= $profissao; ?>">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="numero">Número</label>
                                                    <input type="text" class="form-control" id="numero" value="<?= $numero; ?>">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="complemento">Complemento</label>
                                                    <input type="text" class="form-control" id="complemento" value="<?= $complemento; ?>">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="quantidade_pessoa">Quantidade de pessoas que residem com você</label>
                                                    <input type="text" class="form-control" id="quantidade_pessoa" value="<?= $quantidade_pessoa; ?>">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="cep">CEP</label>
                                                    <input type="text" class="form-control" id="cep" name="cep" maxlength="8" value="<?= $cep; ?>">
                                                </div> 
                                                <div class="col-md-6">
                                                    <label for="logradouro">Endereço</label>
                                                    <input type="text" class="form-control" id="logradouro" readonly="readonly" placeholder="Rua Silva Araujo">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="bairro">Bairro</label>
                                                    <input type="text" class="form-control" id="bairro" readonly="readonly" placeholder="Centro">
                                                </div>
                                                <input name="btnSubmit" onclick="update()" id="btnSubmit" class="btn btn-success" value="Enviar">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- meus dados fim -->

        <!-- senha-arquivos inicio -->
        <section class="philosophy_part section_padding3">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-lg-12 col-md-12">
                        <div class="philophy_text">
                            <div class="card-deck">
                                <div class="card">
                                        <div class="card-body">
                                            <h2>Mudar senha</h2>
                                            <form>
                                                <div class="form-group col-md-12">
                                                    <label for="senha">Nova senha</label>
                                                    <input type="password" class="form-control" id="senha" placeholder="">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="confirmarsenha">Confirme a senha</label>
                                                    <input type="password" class="form-control" id="confirmarsenha">
                                                </div>
                                                <input name="btnSubmit" onclick="updateSenha()" id="btnSubmit" class="btn btn-success" value="Enviar">
                                            </form>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <h2>Enviar arquivos</h2>
                                            <form>
                                                <div class="form-group">
                                                    <label for="rg">Enviar arquivo RG</label>
                                                    <input type="file" class="form-control-file" id="rg">
                                                </div>
                                                <div class="form-group">
                                                    <label for="cpf">Enviar arquivo CPF</label>
                                                    <input type="file" class="form-control-file" id="cpf">
                                                </div>
                                                <div class="form-group">
                                                    <label for="comp">Enviar arquivo Comprovante de Residência</label>
                                                    <input type="file" class="form-control-file" id="comp">
                                                </div>
                                                <input name="btnSubmit" onclick="enviaDoc()" id="btnSubmit" class="btn btn-success botao" value="Enviar">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <!-- senha-arquivos fim -->

        <!-- inscrições-certificado-pesquisa-manual inicio -->
        <section class="philosophy_part section_padding2">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-lg-12 col-md-12">
                        <div class="philophy_text">
                            <div class="card-deck">
                                <div class="card" style="width: 18rem;">
                                    <div class="card-body">
                                        <h2>Certificado</h2> 
                                        <p>Para visualizar seu certificado clique no botão.</p><br>
                                        <a href="#" class="btn btn-success" role="button" onclick="document.getElementById('frm_certificado').submit()">Visualizar</a>
                                    </div>
                                </div>
                                <div class="card" style="width: 18rem;">
                                    <div class="card-body">
                                        <h2>Pesquisa</h2> 
                                        <p>Para participar da pesquisa clique no botão.</p><br>
                                        <a href="https://docs.google.com/forms/d/e/1FAIpQLSeHSGzchUhRwt9CLl76KlBQRggIVZgl8a8QcKjnu1goclMleQ/viewform" class="btn btn-success" role="button" target="_blank">Participar</a>
                                    </div>
                                </div>
                                <div class="card" style="width: 18rem;">
                                    <div class="card-body">
                                        <h2>Manual</h2> 
                                        <p>Para visualizar o manual clique no botão.</p><br>
                                        <a href="http://www.pmf.sc.gov.br/sistemas/MinhocaCabeca/pdf/Tutorial_Minhoca_na_Cabeca.pdf" class="btn btn-success" role="button" target="_blank">Ver</a>
                                        <a href="http://www.pmf.sc.gov.br/sistemas/MinhocaCabeca/pdf/Tutorial_Minhoca_na_Cabeca.pdf" class="btn btn-success" role="button" download="Manual">Baixar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- inscrições-certificado-pesquisa-manual fim -->

        <section class="philosophy_part section_padding2">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-lg-12 col-md-12">
                        <div class="philophy_text1" style="margin-top: -64px;">
                            <div class="card-deck">
                            <div class="card" style="width: 18rem;">
                                    <div class="card-body">
                                        <h2>Minhas inscrições</h2>
                                        <p><b>Evento:</b> <?=$nome_evento?></p>
                                        <p><b>Data:</b> <?php echo (empty($data)) ? '' : date('d/m/Y', strtotime($data)); ?></p>
                                        <p><b>Hora:</b> <?=$hora?></p>
                                        <p><b>Local:</b> <?=$local?></p>
                                    </div>
                                </div>
                                <div class="card" style="width: 18rem;">
								<div class="card-body">
									<h2>Comprovante</h2>
									<p>Para visualizar o comprovante de inscrição clique no botão.</p><br>
									<a href="#" class="btn btn-success" role="button" onclick="submitFormAndDisplayMessage()">Visualizar</a>
								</div>
							</div>
                                <div class="card" style="width: 18rem;">
                                    <div class="card-body">
                                        <h2>Cancelar participação</h2> 
                                        <p>Se você não quiser mais fazer parte do projeto Minhoca na Cabeça, poderá cancelar sua inscrição, caso não esteja inscrito em nenhum evento</p><br>
                                        <?php
                                            if($status_inscricao == 1){
                                                echo "Você precisa cancelar a inscrição no evento antes de cancelar sua participação!";
                                            } else {
                                                echo "<input type='button' value='Cancelar Participação' onclick='cancelarParticipacao(\"".$id_usuario."\");' />\n";
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- footer inicio -->
        <footer class="footer_Part padding_top">
            <hr width = 100% align = right noshade>
            <div class="rodape">
                
                <div class="pmf">
                    <img src="img/pmf.png"  class="" alt="PMF">
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
        <!-- <script src="js/custom.js"></script> -->
    </body>
    <script>
	function submitFormAndDisplayMessage() {
    document.getElementById('frm_comprovante').submit();
    alert("Mensagem de exemplo: O comprovante será exibido em breve.");
}

</script>
    <script>
        $(document).ready(function(){
            $("#cep").change(function () {
                if($("#cep").val() < 88000001 || $("#cep").val() > 88099999){
                    alert("Não é possível cadastrar pessoas fora de Florianópolis.");
                } else {
                    $.get( "https://viacep.com.br/ws/"+$("#cep")[0].value+"/json/").done(function( data ) {
                        $("#logradouro")[0].value = data.logradouro;
                        $("#bairro")[0].value = data.bairro;
                    }).fail(function () {
                        alert("CEP não encontrado.");
                    });
                }
            });
        });
    </script>

    <script>
        function update() {
            if ($('#email').val() == '') {
                
                $('#email').focus();
                $('#btnSubmit').attr("disabled", false);
            } else if ($('#telefone').val() == '') {
                $('#telefone').focus();
            } else if ($('#celular').val() == '') {
                $('#celular').focus();
            } else if ($('#profissao').val() == '') {
                $('#profissao').focus();
            } else if ($('#numero').val() == '') {
                $('#numero').focus();
            } else if ($('#complemento').val() == '') {
                $('#complemento').focus();
            } else if ($('#quantidade_pessoa').val() == '') {
                $('#quantidade_pessoa').focus();
            } else if ($('#cep').val() == '') {
                $('#cep').focus();
            } else if ($('#logradouro').val() == '') {
                $('#logradouro').focus();
            } else if ($('#bairro').val() == '') {
                $('#bairro').focus();
            }
                
                var form_data = new FormData();

                form_data.append('id_pessoa',<?=$id_pessoa;?>);
                form_data.append('email', $('#email').val());
                form_data.append('telefone', $('#telefone').val());
                form_data.append('celular', $('#celular').val());
                form_data.append('profissao', $('#profissao').val());
                form_data.append('numero', $('#numero').val());
                form_data.append('complemento', $('#complemento').val());
                form_data.append('quantidade_pessoa', $('#quantidade_pessoa').val());
                form_data.append('cep', $('#cep').val());
                form_data.append('logradouro', $('#logradouro').val());
                form_data.append('bairro', $('#bairro').val());

                $.ajax({
                    type: "POST",
                    url: "banco/editarParticipante.php",
                    dataType: "text",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    success: function(data) {
                        let response = JSON.parse(data);
                        if (response['success'] == '1') {
                            alert("Dados editados com sucesso!");
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
        function updateSenha() {
            if ($('#senha').val() == '') {
                alert('Informe a nova senha!');
                $('#senha').focus();
            } else if($('#senha').val() != '' && $('#senha').val() != $('#confirmarsenha').val() ) {
                alert('As senhas devem ser iguais!');
                $('#confirmarsehna').focus();
            }

            var form_data = new FormData();

            form_data.append('id_pessoa',<?=$id_pessoa;?>);
            form_data.append('senha', $('#senha').val());

            $.ajax({
                    type: "POST",
                    url: "banco/editarSenha.php",
                    dataType: "text",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    success: function(data) {
                        let response = JSON.parse(data);
                        if (response['success'] == '1') {
                            alert("Senha editada com sucesso!");
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
        function compareDates (date) {
            let parts = date.split('-');
            let today = new Date();
            
            date = new Date(parts[0], parts[1] - 1, parts[2]);

            return date >= today ? true : false;
          
        }
        
        function inserirTroca() {
            if ($('#troca').val() == '') {
                alert('Informe a data da troca!');
                $('#troca').focus();
            } else if(compareDates($('#troca').val())) {
                alert('Data futura!');
                $('#troca').focus();
            }else {
                var form_data = new FormData();
                var dateTime = $('#troca').val() + ' 12:30:08'
                form_data.append('id_pessoa',<?=$id_pessoa;?>);
                form_data.append('troca', dateTime );
                form_data.append('quantidade_troca', <?=$quantidade_troca;?> );
                

                // alert( <?=$id_pessoa;?> );

                $.ajax({
                        type: "POST",
                        url: "banco/troca.php",
                        dataType: "text",
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,
                        success: function(data) {
                            if (data == '1' ) {
                                alert("Troca cadastrada com sucesso!");
                                window.location.reload();
                            } else if(data == '2' ) {
                                alert("Não é possível realizar trocas com data anterior à 2019");
                            } else {
                                alert(data);
                            }
                        },
                        error: function(data) {                                                        
                            console.log('Erro : ' + data['erro']);         
                        }

                    });
            }
        }
    </script>

    <script>
        function enviaDoc(){
            var file_data_rg = $('#rg').prop('files')[0];
            var file_data_cpf = $('#cpf').prop('files')[0];
            var file_data_comp = $('#comp').prop('files')[0];

            var form_data = new FormData();                  

            form_data.append('id_pessoa',<?=$id_pessoa;?>);
            form_data.append('rg', file_data_rg);
            form_data.append('cpf', file_data_cpf);
            form_data.append('comp', file_data_comp);

            $.ajax({
                type: "POST",
                url: "banco/incluirDocumento.php",
                dataType: "text",
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                success: function(data) {
                    console.log(data);

                    let response = JSON.parse(data);

                    if (response['success'] == '1') {	
                        alert("Documento incluído com sucesso!");
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
        function enviarMensagem(id_usuario) {

            if ($('#assunto').val() == '') {
                $('#assunto').focus();
            } else if ($('#mensagem').val() == '') {
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

    <script>

        function cancelarParticipacao(idUsuario)
            {
                var form_data = new FormData();

                form_data.append('id_usuario', idUsuario);

                $.ajax({
                        type: "POST",
                        url: "banco/cancelarParticipacao.php",
                        dataType: "text",
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,
                        success: function(data) {
                            let response = JSON.parse(data);
                            if (response['success'] == '1') {
                                alert("Sua participação no projeto Minhoca na Cabeça foi cancelada com sucesso!");
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

            function validateEmail() {
                 var re = /\S+@\S+\.\S+/;
                 var email  = $('#email').val();

                 if ( ! re.test(email) ){
                    alert('Email incorreto !');
                    $('#email').val('');
                 }
            }

</script>
    </html>
<?php 
}
?>