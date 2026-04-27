<?php
include_once("../banco/gdb.php");

$gdb       = new gdb();

$user      = $gdb->vargetpost('user');
$password  = $gdb->vargetpost('password');
$pass      = md5($password);
$id_pessoa = $gdb->vargetpost('idPessoa');

$gdb->open("SELECT id_usuario_admin 
              FROM usuarioAdmin 
             WHERE email_admin = '$user' 
               AND senha = '$pass'");

if(empty($gdb->gs["ID_USUARIO_ADMIN"][0])) {
    header('Location: index.php');
} else {
    $id_usuario_admin = $gdb->gs["ID_USUARIO_ADMIN"][0];

    $gdb->open("SELECT sm.status_mensagem 
                  FROM statusMensagem sm 
                 WHERE sm.status_mensagem = '1' ");

    $temMensagem = $gdb->gs["STATUS_MENSAGEM"];

    $gdb->open("SELECT u.id_usuario, 
                       u.id_pessoa 
                  FROM usuario u 
             left join pessoa p 
                    on u.id_pessoa = p.id_pessoa 
                 where p.id_pessoa = '$id_pessoa' ");

    $id_usuario = $gdb->gs["ID_USUARIO"][0];


    $gdb->open("SELECT e.id_evento, 
                       e.nome_evento, 
                       e.data, 
                       e.hora, 
                       e.local 
                  FROM evento e 
             LEFT JOIN eventoInscricao ei ON ei.id_evento = e.id_evento
                 WHERE ei.id_pessoa = '$id_pessoa' 
                   AND ei.status_inscricao = '1' ");

    $id_evento   = $gdb->gs["ID_EVENTO"][0];
    $nome_evento = $gdb->gs["NOME_EVENTO"][0];
    $data        = $gdb->gs["DATA"][0];
    $hora        = $gdb->gs["HORA"][0];
    $local       = $gdb->gs["LOCAL"][0];

    

    $gdb->open("SELECT p.id_pessoa, 
                       p.cpf, p.nome, 
                       p.identidade, 
                       p.nascimento, 
                       p.email, 
                       p.telefone, 
                       p.celular, 
                       p.profissao,
                       p.numero, 
                       p.complemento, 
                       p.id_endereco, 
                       p.quantidade_pessoa, 
                       p.status_minhocario, 
                       d.doc_rg, 
                       d.doc_cpf, 
                       d.doc_residencia, 
                       replace(e.cep,'-','') as cep, 
                       e.logradouro, 
                       e.bairro, 
                       e.cidade
                FROM pessoa p
                JOIN documentoPessoa d 
                  ON p.id_pessoa = d.id_pessoa
                JOIN endereco e 
                  ON p.id_endereco = e.id_endereco
               WHERE p.id_pessoa = '$id_pessoa' ");
                
    $cpf = $gdb->gs["CPF"][0];
    $nome = $gdb->gs["NOME"][0];
    $identidade = $gdb->gs["IDENTIDADE"][0];
    $nascimento = $gdb->gs["NASCIMENTO"][0];
    $email = $gdb->gs["EMAIL"][0];
    $telefone = $gdb->gs["TELEFONE"][0];
    $celular = $gdb->gs["CELULAR"][0];
    $profissao = $gdb->gs["PROFISSAO"][0];
    $numero = $gdb->gs["NUMERO"][0];
    $complemento = $gdb->gs["COMPLEMENTO"][0];
    $id_endereco = $gdb->gs["ID_ENDERECO"][0];
    $quantidade_pessoa = $gdb->gs["QUANTIDADE_PESSOA"][0];
    $doc_rg = $gdb->gs["DOC_RG"][0];
    $doc_cpf = $gdb->gs["DOC_CPF"][0];
    $doc_residencia = $gdb->gs["DOC_RESIDENCIA"][0];
    $cep = $gdb->gs["CEP"][0];    
    $logradouro = $gdb->gs["LOGRADOURO"][0];
    $bairro = $gdb->gs["BAIRRO"][0];
    $cidade = $gdb->gs["CIDADE"][0];
    $status_minhocario = $gdb->gs["STATUS_MINHOCARIO"][0];


    $gdb->open("SELECT m.id_troca, 
                       m.id_pessoa, 
                       m.data_troca, 
                       m.quantidade_troca 
                  from minhocario m 
                 where m.id_pessoa = '$id_pessoa' 
              order by m.data_troca desc");

    $id_troca         = $gdb->gs["ID_TROCA"][0];
    $data_troca       = $gdb->gs["DATA_TROCA"];
    $quantidade_troca = empty($gdb->gs["DATA_TROCA"][0]) ? 0 : count($gdb->gs["DATA_TROCA"]);
    
    $desviado = 15.9;
    $total = $quantidade_troca * $desviado;

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
        <form id="frm_trocasExcel" method="POST" action="trocasExcel.php">
            <input type="hidden" id="id_pessoa" name="idPessoa">
            <input type="hidden" name="user" value="<?=$user;?>">
            <input type="hidden" name="password" value="<?=$password;?>">
        </form>

        <section class="philosophy_part section_padding1">
                <div class="container">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-lg-12 col-md-12">
                            <div class="philophy_text">
                                <div class="card-deck">
                                    <div class="card">
                                        <div class="card-body">
                                            <form>
                                                <div class="form-group">
                                                    <input type="checkbox" class="form-control-file" id="nao_compareceu">
                                                    <label for="nao_compareceu">Se o participante não compareceu ao evento marque essa opção para fazer com que o mesmo fique com status INATIVO</label>
                                                </div>
                                                <input type='button' value='Cancelar Participação' onclick='cancelarParticipacao(<?=$id_usuario?>)';/>                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row align-items-center justify-content-between">
                        <div class="col-lg-12 col-md-12">
                            <div class="philophy_text">
                                <div class="card-deck">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5>Informe o status do minhocário</h5></br>
                                            <label class="radio-inline">
                                            <input type="radio" name="status_minhocario" value="0" class="status_minhocario"> Devolveu minhocário
                                            </label><br>
                                            <label class="radio-inline">
                                            <input type="radio" name="status_minhocario" value="1" class="status_minhocario"> NÃO retirou minhocário
                                            </label><br>
                                            <label class="radio-inline">
                                            <input type="radio" name="status_minhocario" value="2" class="status_minhocario"> Retirou minhocário
                                            </label><br>
                                            <input type='button' class='btn_1' value='Enviar' onclick='statusMinhocario(<?=$id_pessoa?>)';/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
        </section>

        <!-- meus dados inicio -->
        <section class="philosophy_part section_padding1">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-lg-12 col-md-12">
                        <div class="philophy_text">
                            <h5>Dados</h5>
                            <div class="card-deck">
                                <div class="card">
                                    <div class="card-body">
                                    <form>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <label for="email">Nome</label>
                                                <input type="text" class="form-control" id="nome" value="<?= $nome; ?>">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="email">CPF</label>
                                                <input type="text" class="form-control" id="cpf" value="<?= $cpf; ?>">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="email">RG</label>
                                                <input type="text" class="form-control" id="rg" value="<?= $identidade; ?>">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="email">Nascimetno</label>
                                                <input type="text" class="form-control" id="nascimento" value="<?= $nascimento; ?>">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="email">Profissão</label>
                                                <input type="text" class="form-control" id="profissao" value="<?= $profissao; ?>">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="email">E-mail</label>
                                                <input type="text" class="form-control" id="email" value="<?= $email; ?>">
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
                                                <label for="numero">Número</label>
                                                <input type="text" class="form-control" id="numero" value="<?= $numero; ?>">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="complemento">Complemento</label>
                                                <input type="text" class="form-control" id="complemento" value="<?= $complemento; ?>">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="quantidade_pessoa">Quantidade de pessoas que residem com o participante</label>
                                                <input type="text" class="form-control" id="quantidade_pessoa" value="<?= $quantidade_pessoa; ?>">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="cep">CEP</label>
                                                <input type="text" class="form-control" id="cep" name="cep" maxlength="8" value="<?= $cep; ?>">
                                            </div> 
                                            <div class="col-md-6">
                                                <label for="logradouro">Endereço</label>
                                                <input type="text" class="form-control" id="logradouro" readonly="readonly" placeholder="Rua Silva Araujo" value="<?= $logradouro; ?>" >
                                            </div>
                                            <div class="col-md-6">
                                                <label for="bairro">Bairro</label>
                                                <input type="text" class="form-control" id="bairro" readonly="readonly" placeholder="Centro" value="<?= $bairro; ?>" >
                                            </div>
                                            <input name="btnSubmit" onclick="atualizaUsuario()" id="btnSubmit" class="btn btn-success" value="Enviar">
                                        </div>
                                    </form>
                                    
                                        <p>Arquivos enviados: <br>
                                            <?php
                                                if(!empty($doc_rg)) 
                                                {
                                                    echo '<a href="http://www.pmf.sc.gov.br/sistemas/MinhocaCabeca/pdf/'.$id_pessoa.'/'.$doc_rg.'"> Download documento RG</a> <br>';
                                                } else {
                                                    echo 'Não há documento de RG para visualizar';
                                                }
                                            ?>
                                            <br>
                                            <?php
                                                if(!empty($doc_cpf)) 
                                                {
                                                    echo '<a href="http://www.pmf.sc.gov.br/sistemas/MinhocaCabeca/pdf/'.$id_pessoa.'/'.$doc_cpf.'"> Download documento CPF</a> <br>';
                                                } else {
                                                    echo 'Não há documento de CPF para visualizar';
                                                }
                                            ?>
                                            <br>
                                            <?php
                                                if(!empty($doc_residencia)) 
                                                {
                                                    echo '<a href="http://www.pmf.sc.gov.br/sistemas/MinhocaCabeca/pdf/'.$id_pessoa.'/'.$doc_residencia.'"> Download documento Comprovante de Residência</a> <br>';
                                                } else {
                                                    echo 'Não há documento de Comprovante de Residência para visualizar';
                                                }
                                            ?>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h2>Resumo da produção</h2>
                                        <p><b>Trocas feitas:</b> <?= $quantidade_troca; ?></p>
                                        <p><b>Desviado do aterro:</b> <?= $total; ?></p>
                                        <p><b>Co2 poupado:</b> <?= $total ?></p>
                                    </div>
                                    <div class="card-body">
                                        <h2>Inscrições</h2>
                                        <p><b>Evento:</b> <?=$nome_evento?></p>
                                        <p><b>Data:</b> <?php echo (empty($data)) ? '' : date('d/m/Y', strtotime($data)); ?></p>
                                        <p><b>Hora:</b> <?=$hora?></p>
                                        <p><b>Local:</b> <?=$local?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- meus dados fim -->

        <!-- caixas inicio -->
        <section class="philosophy_part section_padding2">
                <div class="container">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-lg-12 col-md-12">
                            <div class="philophy_text">
                                <h5>Minhas caixas</h5>
                                <div class="card-deck">
                                    <div class="card">
                                        <div class="card-body">
                                            <h2>Últimas trocas</h2>
                                            <p>
                                            <?php 
                                                $numExibicaoTroca = (count($data_troca) > 10) ? 10 : count($data_troca);
                                                for($i = 0; $i < $numExibicaoTroca; $i++) {
                                                    if($i == $numExibicaoTroca - 1) {
                                                        echo date('d/m/Y', strtotime($data_troca[$i]));
                                                    } else {
                                                        echo date('d/m/Y', strtotime($data_troca[$i])).' - ';
                                                    }
                                                }
                                            ?>
                                            <input type="button"  class="btn_1" onclick="document.getElementById('id_pessoa').value = <?= $id_pessoa; ?>; document.getElementById('frm_trocasExcel').submit()" value="Ver todas as trocas">
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
        <!-- caixas fim -->

        <!--enviar documentos inicio -->
        <section class="philosophy_part section_padding2">
                <div class="container">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-lg-12 col-md-12">
                            <div class="philophy_text">
                                <div class="card-deck">
                                    <div class="card">
                                        <div class="card-body">
                                        <h2>Enviar arquivos</h2>
                                            <form>
                                                <div class="form-group">
                                                    <label for="rg_file">Enviar arquivo RG</label>
                                                    <input type="file" class="form-control-file" id="rg_file">
                                                </div>
                                                <div class="form-group">
                                                    <label for="cpf_file">Enviar arquivo CPF</label>
                                                    <input type="file" class="form-control-file" id="cpf_file">
                                                </div>
                                                <div class="form-group">
                                                    <label for="comp_file">Enviar arquivo Comprovante de Residência</label>
                                                    <input type="file" class="form-control-file" id="comp_file">
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
        <!-- enviar documentos fim -->

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
    </body>

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
        function atualizaUsuario() {
            if ($('#cpf').val() == '') {
                $('#cpf').focus();
            } else if ($('#nome').val() == '') {
                $('#nome').focus();
            } else if ($('#rg').val() == '') {
                $('#rg').focus();
            } else if ($('#nascimento').val() == '') {
                $('#nascimetno').focus();
            } else if ($('#email').val() == '') {
                $('#email').focus();
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
                form_data.append('cpf', $('#cpf').val());
                form_data.append('nome', $('#nome').val());
                form_data.append('rg', $('#rg').val());
                form_data.append('nascimento', $('#nascimento').val());
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
                    url: "../banco/atualizarParticipante.php",
                    dataType: "text",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    success: function(data) {
                        let response = JSON.parse(data);
                        if (response['success'] == '1') {
                            alert("Dados editados com sucesso!");
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
        function enviaDoc(){
            var file_data_rg = $('#rg_file').prop('files')[0];
            var file_data_cpf = $('#cpf_file').prop('files')[0];
            var file_data_comp = $('#comp_file').prop('files')[0];

            var form_data = new FormData();                  

            form_data.append('id_pessoa',<?=$id_pessoa;?>);
            form_data.append('rg', file_data_rg);
            form_data.append('cpf', file_data_cpf);
            form_data.append('comp', file_data_comp);

            $.ajax({
                type: "POST",
                url: "../banco/incluirDocumento.php",
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

    function cancelarParticipacao(idUsuario)
        {
            var form_data = new FormData();

            form_data.append('id_usuario', idUsuario);

            $.ajax({
                    type: "POST",
                    url: "../banco/cancelarParticipacao.php",
                    dataType: "text",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    success: function(data) {
                        let response = JSON.parse(data);
                        if (response['success'] == '1') {
                            alert("O status do participante foi alterado com sucesso!");
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
        function statusMinhocario() {

            $('#check').bind('click',function(){
                if($(this).is(':checked') ){
                    $('#submit').prop( "disabled", false );
                }else{
                    $('#submit').prop( "disabled", true );
                }
            });
            
                var form_data = new FormData();  
                
                form_data.append('id_pessoa',<?=$id_pessoa;?>);
                form_data.append('status_minhocario', $('.status_minhocario:checked').val());

                $.ajax({
                    type: "POST",
                    url: "../banco/statusminhocario.php",
                    dataType: "text",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    success: function(data) {
                        let response = JSON.parse(data);
                        if (response['success'] == '1') {	
                            alert("Status incluído com sucesso!");
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
        $(document).ready(function(){
            var status_minhocario = "<?=$status_minhocario?>";
            if(status_minhocario != ""){
                document.getElementsByName("status_minhocario")[status_minhocario].checked = true;
            }
        });
    </script>

    </html>
<?php 
}
?>