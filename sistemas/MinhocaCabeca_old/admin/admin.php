<?php
/*
$captcha = $_POST["g-recaptcha-response"];

$ok       = false;

if( $captcha != "" ){
   
	$secreto  = '6Lf0zBsaAAAAAIvyKbJg6ruDd9ixTJxky1JQ1umm';
	$ip		  = $_SERVER["REMOTE_ADDR"];
	$var      = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secreto&response=$captcha&remoteip=$ip");
	$resposta = json_decode($var,true);

	if( $resposta['success'] ){
		$ok = true;
	}

}
*/
$ok       = true;
include_once("../banco/gdb.php");
$gdb = new gdb();


$user     = $gdb->vargetpost('user');
$password = $gdb->vargetpost('password');

$pass = md5($password);

$gdb->open("SELECT id_usuario_admin 
              FROM usuarioAdmin 
             WHERE email_admin = '$user' AND senha = '$pass'");

if( empty($gdb->gs["ID_USUARIO_ADMIN"][0]) ) {
    if( !ok ){
        $msg = "Seu acesso não foi validado!";
    }else{
        $msg = "Login ou Senha incorreto !";
    }

    header('Location:index.php');
} else {


$gdb->open("SELECT sm.status_mensagem FROM statusMensagem sm WHERE sm.status_mensagem = '1'");
$temMensagem = $gdb->gs["STATUS_MENSAGEM"];

$gdb->open("SELECT u.nome FROM usuarioAdmin u where u.id_usuario_admin = '$id_usuario_admin'"); 
$nome = $gdb->gs["NOME"][0];


$gdb->open("SELECT COUNT(*) AS NUMERO  from usuario");
$participantes = $gdb->gs["NUMERO"][0];

$gdb->open("SELECT COUNT(*) AS NUMERO from usuario u
            /*left join usuario u on p.id_pessoa = u.id_pessoa*/
            left join statusUsuario s on u.id_usuario = s.id_usuario
            where s.status_usuario = '1'");
$ativos = $gdb->gs["NUMERO"][0];

$gdb->open("SELECT COUNT(*) AS NUMERO  from usuario u
            /*left join usuario u on p.id_pessoa = u.id_pessoa*/
            left join statusUsuario s on u.id_usuario = s.id_usuario
            where s.status_usuario = '2'");
$inativos = $gdb->gs["NUMERO"][0];

$gdb->open("SELECT COUNT(*) AS NUMERO  from usuario u
            /*left join usuario u on p.id_pessoa = u.id_pessoa*/
            left join statusUsuario s on u.id_usuario = s.id_usuario
            where s.status_usuario = '3'");
$fila_espera = $gdb->gs["NUMERO"][0];

$gdb->open("SELECT COUNT(*) AS NUMERO  from evento e
            left join statusEvento se on e.id_evento = se.id_evento
            where se.status_evento = '0'");
$eventos_finalizados = $gdb->gs["NUMERO"][0];

$gdb->open("SELECT COUNT(DISTINCT bairro) AS NUMERO from endereco");
$bairros = $gdb->gs["NUMERO"][0];

$gdb->open("SELECT COUNT(*) AS familia,
			       UPPER(e.bairro) AS bairro
			FROM pessoa p
			JOIN endereco e ON p.id_endereco = e.id_endereco
			JOIN minhocario m ON p.id_pessoa = m.id_pessoa
			GROUP BY UPPER(e.bairro)
			ORDER BY 1 DESC
			LIMIT 0,6");
    $id_usuario_admin = $gdb->gs["ID_USUARIO_ADMIN"][0];


if($gdb->linhas > 0){	   
   $bairro = implode(';', $gdb->gs['BAIRRO']);
   $familia = implode(';', $gdb->gs['FAMILIA']);
} else {
   $bairro = '';
   $familia = '';
}

$gdb->open("SELECT COUNT(m.data_troca) AS QUANTIDADE_TROCA FROM minhocario m
            JOIN pessoa p ON m.id_pessoa = p.id_pessoa
            JOIN endereco e ON p.id_endereco = e.id_endereco
            GROUP BY UPPER(e.bairro)
            ORDER BY 1 DESC");
$quantidade_troca = $gdb->gs["QUANTIDADE_TROCA"][0];

$gdb->open("SELECT (COUNT(m.data_troca)*15.9) AS qtde,
			       UPPER(e.bairro) AS local
			FROM minhocario m
			JOIN pessoa p ON m.id_pessoa = p.id_pessoa
			JOIN endereco e ON p.id_endereco = e.id_endereco
			GROUP BY UPPER(e.bairro)
			ORDER BY 1 DESC
			LIMIT 0,6");

if($gdb->linhas > 0){
	$local = implode(';', $gdb->gs['LOCAL']);
	$qtde = implode(';', $gdb->gs['QTDE']);	   
}else{
	$local = '';
	$qtde = '';
}	

$gdb->open("SELECT (COUNT(m.data_troca)*15.9) AS ORGANICO,
			       COUNT(m.id_pessoa) AS PESSOA,
			       DATE_FORMAT(m.data_troca,'%m/%Y') AS MESANO
			FROM minhocario m
			GROUP BY DATE_FORMAT(m.data_troca,'%Y%m') DESC
			LIMIT 0,12");



if($gdb->linhas > 0){
	$organico = implode(';', $gdb->gs['ORGANICO']);
	$pessoa = implode(';', $gdb->gs['PESSOA']);
	$mesAno = implode(';', $gdb->gs['MESANO']);
} else {
	$organico = '';
	$pessoa = '';
} 

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
        <link rel="stylesheet" href="../css/nice-select.css">
        <link rel="stylesheet" href="../css/all.css">
        <!-- style CSS -->
        <link rel="stylesheet" href="../css/style.css">
        <!-- style chart -->
        <style>
			.pie-legend {
				list-style: none;
				/*position:absolute;*/
				width:100%;
				bottom:10%;
				cursor:pointer;
				margin: 10px 4px;
			}
			.indicator_box {
				width: 55px;
				height: 5px;
				padding: 5px;
				margin: 5px 10px 5px 10px;
				padding-left: 5px;
				display: block;
				float: left;
			}	
		</style>
    </head>

    <body>
        <!--::header part start::-->
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
                                        <a class="nav-link" href="#" onclick="document.getElementById('frm_admin').submit()">Início</a> <a class="alerta"></a>
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
        <form id="frm_cadastro" method="POST" action="cadastroAdmin.php">
            <input type="hidden" name="user" value="<?= $user; ?>">
            <input type="hidden" name="password" value="<?= $password; ?>">
        </form>
        <form id="frm_cadastro-participante" method="POST" action="../cadastro.php">
            <input type="hidden" name="user" value="<?= $user; ?>">
            <input type="hidden" name="password" value="<?= $password; ?>">
        </form>
        <form id="frm_trocaExcel" method="POST" action="trocaAdminExcel.php">
            <input type="hidden" name="user" value="<?=$user;?>">
            <input type="hidden" name="password" value="<?=$password;?>">
        </form>

        <!-- dados inicio -->
        <section class="philosophy_part project_details section_padding">
            <div class="container">
            <p><b>Olá, <?= $nome; ?></b></p>
                <div class="row">
                    <div class="col-xl-4 col-md-5">
                        <div class="card card-stats">
                            <!-- quadro de dados -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Total de Participantes</h5>
                                    <span class="h2 font-weight-bold mb-0"><?= $participantes; ?></span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                            <i class="ni ni-active-40"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-5">
                        <div class="card card-stats">
                            <!-- quadro de dados -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Participantes Ativos</h5>
                                    <span class="h2 font-weight-bold mb-0"><?= $ativos; ?></span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                                            <i class="ni ni-chart-pie-35"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-5">
                        <div class="card card-stats">
                            <!-- quadro de dados -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Participantes Inativos</h5>
                                    <span class="h2 font-weight-bold mb-0"><?= $inativos; ?></span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                            <i class="ni ni-money-coins"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-5">
                        <div class="card card-stats">
                            <!-- quadro de dados -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Pessoas na Fila de Espera</h5>
                                    <span class="h2 font-weight-bold mb-0"><?= $fila_espera; ?></span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                            <i class="ni ni-chart-bar-32"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-5">
                        <div class="card card-stats">
                            <!-- quadro de dados -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Turmas Realizadas</h5>
                                    <span class="h2 font-weight-bold mb-0"><?= $eventos_finalizados; ?></span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                            <i class="ni ni-chart-bar-32"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-5">
                        <div class="card card-stats">
                            <!-- quadro de dados -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Bairros Atendidos</h5>
                                    <span class="h2 font-weight-bold mb-0"><?= $bairros; ?></span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                            <i class="ni ni-chart-bar-32"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
        </section>
        <!-- dados fim -->

        <!-- grárificos inicio -->
        <section class="related_project padding_bottom">
            <div class="container">
                <div class="row chart">
                <p>Comparativo entre troca de caixa e compostagem ( em quilo ) nos últimos doze (12) meses</p>
				  <canvas id="barChart" style="height:250px"></canvas>
				</div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="section_tittle">
                        </div>
                    </div>
                </div>
                <table class="row justify-content-center table table-bordless">
                    <tr class="w-50">
                        <td>Bairros que reciclam mais orgânicos(kg)</td>
                    	<td id="legendOrganicos" style="height:200px"></td>
                        <td class="single_project_details">
                            <canvas id="pieChart" style="height:250px" ></canvas>
                        </td>
                    </tr>
                    <tr class="w-50">
                        <td>Bairros com maior número de participantes</td>
                    	<td id="legendQtde" style="height:200px"></td>
                        <td class="single_project_details">
                            <canvas id="pieChart2" style="height:250px" ></canvas>
                        </td>
                    </tr>
                </table>
            </div>
        </section>
        <!-- graficos fim -->

        <!--Cadastrar participante-->
        <div class="card text-center">
                <div class="card-header">
                    <h2>Trocas de Caixa</h2>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <p class="card-text">Clique no botão para visualizar ou baixar o arquivo com todas as trocas dos participantes.</p>
                                <input type="button"  class="btn_1"  onclick="document.getElementById('frm_trocaExcel').submit()" value="Ver todas as trocas">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!--Cadastrar participante fim-->


        <!--Cadastrar participante-->
            <div class="card text-center">
                <div class="card-header">
                    <h2>Cadastro</h2>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?= $nome; ?>, aqui você pode incluir um novo <b>administrador</b>! </h5>
                                <p class="card-text">Clique no botão para continuar.</p>
                                <a class="btn btn-success" href="#" onclick="document.getElementById('frm_cadastro').submit()">Cadastre ADMIN</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?= $nome; ?>, aqui você pode incluir um novo <b>participante</b>! </h5>
                                <p class="card-text">Clique no botão para continuar.</p>
                                <a class="btn btn-success" href="#" onclick="document.getElementById('frm_cadastro-participante').submit()">Cadastre PARTICIPANTE</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!--Cadastrar participante fim-->

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

        <!--<script src="../js/jquery.nice-select.min.js"></script>-->
        <!-- custom js -->
        <!--<script src="../js/custom.js"></script>-->

        <!-- Scripts Gráfico-->
        <script src="http://www.nffacademia.com.br/nff/js/chartjs/Chart.min.js"></script>
        <script type="text/javascript">
	        $(function () {	
	        	//Gráfico de Pizza 1
	        	var pieChartCanvas = document.getElementById("pieChart").getContext("2d");

				var local = "<?= $local; ?>";
				var arrayLocal = local.split(";");

				var quantidade = "<?= $qtde; ?>";
				var arrayQuantidade = quantidade.split(";");

				var PieData = [
					{
					value: arrayQuantidade[0],
					color: "#d2d6de",
					highlight: "#d2d6de",
					label: arrayLocal[0]
					},			
					{
					value: arrayQuantidade[1],
					color: "#f56954",
					highlight: "#f56954",
					label: arrayLocal[1]
					},
					{
					value: arrayQuantidade[2],
					color: "#00a65a",
					highlight: "#00a65a",
					label: arrayLocal[2]
					},
					{
					value: arrayQuantidade[3],
					color: "#f39c12",
					highlight: "#f39c12",
					label: arrayLocal[3]
					},
					{
					value: arrayQuantidade[4],
					color: "#00c0ef",
					highlight: "#00c0ef",
					label: arrayLocal[4]
					},
					{
					value: arrayQuantidade[5],
					color: "#3c8dbc",
					highlight: "#3c8dbc",
					label: arrayLocal[5]
					}
				];

				var pieOptions = {
					//Boolean - Whether we should show a stroke on each segment
					segmentShowStroke: true,
					//String - The colour of each segment stroke
					segmentStrokeColor: "#fff",
					//Number - The width of each segment stroke
					segmentStrokeWidth: 6,
					//Number - The percentage of the chart that we cut out of the middle
					percentageInnerCutout: 25, // This is 0 for Pie charts
					//Number - Amount of animation steps
					animationSteps: 100,
					//String - Animation easing effect
					animationEasing: "easeOutBounce",
					//Boolean - Whether we animate the rotation of the Doughnut
					animateRotate: true,
					//Boolean - Whether we animate scaling the Doughnut from the centre
					animateScale: true,
					//Boolean - whether to make the chart responsive to window resizing
					responsive: true,
					// Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
					maintainAspectRatio: true,
					//String - A legend template
					legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li style=\"float: left; clear: both;\"><div class=\"indicator_box\" style=\"background-color:<%=segments[i].fillColor%>\"></div><span style=\"font-size: 12px;\"><%if(segments[i].label){%><%=segments[i].label%><%}%></span></li><%}%></ul>"
				};

				var pieChart = new Chart( pieChartCanvas );
				var pieLegend = pieChart.Pie(PieData, pieOptions);
				document.getElementById('legendOrganicos').innerHTML = pieLegend.generateLegend();
				pieChart.Doughnut(PieData, pieOptions);

				//Gráfico de Pizza 2
				var pieChartCanvas2 = document.getElementById("pieChart2").getContext("2d");

				var bairro  = "<?= $bairro; ?>";
				var arrayBairro = bairro.split(";");

				var familia = "<?= $familia; ?>";
				var arrayFamilia = familia.split(";");

				var PieData2 = [
					{
					value: arrayFamilia[0],
					color: "#d2d6de",
					highlight: "#d2d6de",
					label: arrayBairro[0]
					},			
					{
					value: arrayFamilia[1],
					color: "#f56954",
					highlight: "#f56954",
					label: arrayBairro[1]
					},
					{
					value: arrayFamilia[2],
					color: "#00a65a",
					highlight: "#00a65a",
					label: arrayBairro[2]
					},
					{
					value: arrayFamilia[3],
					color: "#f39c12",
					highlight: "#f39c12",
					label: arrayBairro[3]
					},

					{
					value: arrayFamilia[4],
					color: "#00c0ef",
					highlight: "#00c0ef",
					label: arrayBairro[4]
					},
					{
					value: arrayFamilia[5],
					color: "#3c8dbc",
					highlight: "#3c8dbc",
					label: arrayBairro[5]
					}
				];

				var pieOptions2 = {
					//Boolean - Whether we should show a stroke on each segment
					segmentShowStroke: true,
					//String - The colour of each segment stroke
					segmentStrokeColor: "#fff",
					//Number - The width of each segment stroke
					segmentStrokeWidth: 6,
					//Number - The percentage of the chart that we cut out of the middle
					percentageInnerCutout: 25, // This is 0 for Pie charts
					//Number - Amount of animation steps
					animationSteps: 100,
					//String - Animation easing effect
					animationEasing: "easeOutBounce",
					//Boolean - Whether we animate the rotation of the Doughnut
					animateRotate: false,
					//Boolean - Whether we animate scaling the Doughnut from the centre
					animateScale: true,
					//Boolean - whether to make the chart responsive to window resizing
					responsive: true,
					// Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
					maintainAspectRatio: true,
					//String - A legend template
					legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li style=\"float: left; clear: both;\"><div class=\"indicator_box\" style=\"background-color:<%=segments[i].fillColor%>\"></div><span style=\"font-size: 12px;\"><%if(segments[i].label){%><%=segments[i].label%><%}%></span></li><%}%></ul>"
				};
				
				var pieChart2 = new Chart( pieChartCanvas2 );
				var pieLegend2 = pieChart2.Pie(PieData2, pieOptions2);
				document.getElementById('legendQtde').innerHTML = pieLegend2.generateLegend();			
				pieChart2.Doughnut(PieData2, pieOptions2);	

	        	//Gráfico de barras
				var mesAnoPlano = "<?= $mesAno; ?>";
				var arrayMesAnoPlano = mesAnoPlano.split(";");

				var particante = "<?= $pessoa; ?>";
				var arrayParticante = particante.split(";");

				var organico = "<?= $organico; ?>";
				var arrayOrganico = organico.split(";");


				var areaChartData = {
				  labels: arrayMesAnoPlano,
				  datasets: [
					{
					  label: "Troca",
					  fillColor: "rgba(210, 214, 222, 1)",
					  strokeColor: "rgba(210, 214, 222, 1)",
					  pointColor: "rgba(210, 214, 222, 1)",
					  pointStrokeColor: "#c1c7d1",
					  pointHighlightFill: "#fff",
					  pointHighlightStroke: "rgba(220,220,220,1)",
					  
					  data: arrayParticante
					},
					{
					  label: "Compostagem ( KG )",
					  fillColor: "rgba(60,141,188,0.9)",
					  strokeColor: "rgba(60,141,188,0.8)",
					  pointColor: "#3b8bba",
					  pointStrokeColor: "rgba(60,141,188,1)",
					  pointHighlightFill: "#fff",
					  pointHighlightStroke: "rgba(60,141,188,1)",
					  data: arrayOrganico
					}
				  ]
				};

				var barChartCanvas = $("#barChart").get(0).getContext("2d");
				var barChart = new Chart(barChartCanvas);
				var barChartData = areaChartData;
				barChartData.datasets[1].fillColor = "#00a65a";
				barChartData.datasets[1].strokeColor = "#00a65a";
				barChartData.datasets[1].pointColor = "#00a65a";
				var barChartOptions = {
				//Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
				scaleBeginAtZero: true,
				//Boolean - Whether grid lines are shown across the chart
				scaleShowGridLines: true,
				//String - Colour of the grid lines
				scaleGridLineColor: "rgba(0,0,0,.05)",
				//Number - Width of the grid lines
				scaleGridLineWidth: 1,
				//Boolean - Whether to show horizontal lines (except X axis)
				scaleShowHorizontalLines: true,
				//Boolean - Whether to show vertical lines (except Y axis)
				scaleShowVerticalLines: true,
				//Boolean - If there is a stroke on each bar
				barShowStroke: true,
				//Number - Pixel width of the bar stroke
				barStrokeWidth: 2,
				//Number - Spacing between each of the X value sets
				barValueSpacing: 5,
				//Number - Spacing between data sets within X values
				barDatasetSpacing: 1,
				//String - A legend template
				legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
				//Boolean - whether to make the chart responsive
				responsive: true,
				maintainAspectRatio: true
				};

				barChartOptions.datasetFill = true;
				barChart.Bar(barChartData, barChartOptions);
			});
        </script>
        
    </body>

    </html>
<?php 
}
?>