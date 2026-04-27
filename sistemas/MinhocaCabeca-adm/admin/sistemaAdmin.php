<?php

  error_reporting(E_ALL);
  ini_set('display_errors', '1');
  
  include_once("../../banco/gdb.php"); 
  include_once("../../banco/iniciarPagina.php"); 

  $gdb = new gdb();
  $gdbBairro = new gdb();
  $gdbQuatidade = new gdb();
  $gdbMesAno = new gdb();  
  
  /*
  print "<pre>";
  print_r( $_SERVER );
  print "</pre>";  
  */
  
  $codigoUsuario = base64_decode( $gdb->vargetpost('codigoUsuario') );
  
  
  $gdb->open("select p.codigoPessoa, 
                     p.nome,
                     p.email
                from usuario u, 
				      pessoa p
			   where u.codigoUsuario = '$codigoUsuario' 
			     and p.email = u.login "); 
  
  $codigoUsuario = $gdb->vargetpost('codigoUsuario');	
  
  
  $nome = $gdb->gs['NOME'][0];
  $email = $gdb->gs['EMAIL'][0];
  
  // Vetores para o DASHBOARD
  
  // Quantidade de familias por bairro
  $gdbQuatidade->open("select count(*) as familia, 
					   upper( Bairro ) as bairro
				 from pessoaAuxiliar a, 
					  pessoaEndereco e,
                      (select distinct codigoPessoa as codigoPessoa from trocaCaixaMNC ) t					  
				where a.codigoProjeto = 'MNC' 
				  and a.codigoPessoa = e.codigoPessoa     
				  and t.codigoPessoa = a.codigoPessoa
			 group by upper( Bairro )
				  order by 1 desc  
				  limit 0,6");   

	/*
		print "<pre>";				  
		print_r( $gdbQuatidade->gs );
		print "</pre>";	
	*/	
	
    if( $gdbQuatidade->linhas>0 ){	   
       $bairro = implode(';', $gdbQuatidade->gs['BAIRRO']);
       $familia = implode(';', $gdbQuatidade->gs['FAMILIA']);
    }else{
       $bairro = '';
       $familia = '';
    }
	
  // Quantidade de compostagem por bairro	
  $gdbBairro->open("select sum(qtdeTroca) as qtde, 
                         upper( Bairro ) as local
   				   from trocaCaixaMNC t,
					    pessoaEndereco e 
				  where t.codigoPessoa = e.codigoPessoa     
			   group by upper( bairro )
			 order by 1 desc  
				  limit 0,6");   
				  
    if( $gdbBairro->linhas>0 ){
       $local = implode(';', $gdbBairro->gs['LOCAL']);
       $qtde = implode(';', $gdbBairro->gs['QTDE']);	   
    }else{
       $local = '';
       $qtde = '';
    }	
	
  // Quantidade de compostagem por bairro	
  $gdbMesAno->open("select sum(qtdeTroca) as  organico, 
                           count(codigoPessoa) as PESSOA,
						   date_format( dataTroca,'%m/%Y' )  as mesAno 
					 from trocaCaixaMNC 
				 group by date_format( dataTroca,'%Y%m' ) desc  
				 limit 0,12");   	
	
    if( $gdbMesAno->linhas>0 ){
       $organico = implode(';', $gdbMesAno->gs['ORGANICO']);
       $pessoa = implode(';', $gdbMesAno->gs['PESSOA']);
	   $mesAno = implode(';', $gdbMesAno->gs['MESANO']);
    }else{
       $organico = '';
       $pessoa = '';
    }
	
  // Resumo contitativo
  $gdbMesAno->open("SELECT ( sum( case when i.tipo = 'P' then 1 else 0 end ) ) as participante,  
						   ( sum( case when i.tipo = 'E' then 1 else 0 end ) ) as filaEspera,       
			( select count(*)  from eventoProgramacao ep, eventoTurma et  where et.codigoEvento = 1 and ep.codigoTurma=et.codigoTurma and date_format( data, '%Y%m%d' )<date_format( sysdate(), '%Y%m%d' ) ) as Turmas,
			( select count(bairro) from  ( select distinct upper(pe.bairro) as bairro  From  pessoaEndereco  pe where codigoProjeto = 1 ) as Bai ) as bairros,
			( ( sum( case when  tcm.codigoPessoa is null then 0 else 1 end ) ) ) as ativos,
			( ( sum( case when  i.tipo = 'P' and tcm.codigoPessoa is null then 1 else 0 end ) ) ) as inativos
					
					  FROM backend.eventoInscricao i
					  
				 LEFT JOIN  ( ( select distinct codigoPessoa as codigoPessoa  from trocaCaixaMNC )  ) tcm
				        ON  tcm.codigoPessoa = i.codigoPessoa
				 
				 ");   	
					  
	
    if( $gdbMesAno->linhas>0 ){
		$Tparticipantes = $gdbMesAno->gs['PARTICIPANTE'][0];
		$TfilaEspera    = $gdbMesAno->gs['FILAESPERA'][0];
		$Tturmas        = $gdbMesAno->gs['TURMAS'][0];
		$Tbairros       = $gdbMesAno->gs['BAIRROS'][0];
		$ativos         = $gdbMesAno->gs['ATIVOS'][0];
		$inativos       = $gdbMesAno->gs['INATIVOS'][0];
    }else{
		$Tparticipantes = "";
		$TfilaEspera = "";
		$Tturmas = "";
		$Tbairros = "";
		$ativos = "";
		$inativos = "";
    }	
	
?>

<!DOCTYPE HTML>
<html>
	<?php 
	  include_once("cabecalho.php"); 
	  cabecalho( $codigoUsuario );
	?>
	<style>
	.pie-legend {
	  list-style: none;
	  position:absolute;
	  width:100%;
      bottom:10%;
	  cursor:pointer;
	  margin: 10px 4px
	}
	.indicator_box {
	  width: 55px;
	  height: 5px;
	  padding: 5px;
	  margin: 5px 10px 5px 10px;
	  padding-left: 5px;
	  display: block;
	  float: left
	}	
	</style>	
	<body class="subpage">

		<!-- Header -->
			<header id="header">
				<div class="logo"><a href="../residuometro.html">RESIDUOMETRO</a></div>
				<a href="#menu">Menu</a>
			</header>

		<!-- Nav -->
		<? 
		include_once("menu.php");   
		menu( $codigoUsuario ); 
		?>

		<!-- One -->
			<section id="One" class="wrapper style3">
				<div class="inner">
					<header class="align-center">
						<p><Strong>PROJETO MINHOCA NA CABE&Ccedil;A</Strong></p>
						<h2>Sistema Administrativo</h2>
					</header>
				</div>
			</section>

			<section id="two" class="wrapper style2">	
			<div id="main" class="container">  
              <table width='100%'>
				<tr>
				  <td colspan="2">
						<section class="content">
						  <!-- Info boxes -->
						  <div class="row">
							<div class="col-md-3 col-sm-6 col-xs-12">
							  <div class="info-box">
								<span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

								<div class="info-box-content">
								  <span class="info-box-text">Total de Participantes</span>
								  <span class="info-box-number"><? print $Tparticipantes; ?></span>
								</div>
								<!-- /.info-box-content -->
							  </div>
							  <!-- /.info-box -->
							</div>
							

							<div class="col-md-3 col-sm-6 col-xs-12">
							  <div class="info-box">
								<span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

								<div class="info-box-content">
								  <span class="info-box-text">Total de Participantes Ativos</span>
								  <span class="info-box-number"><? print $ativos; ?></span>
								</div>
								<!-- /.info-box-content -->
							  </div>
							  <!-- /.info-box -->
							</div>							
							
							<div class="col-md-3 col-sm-6 col-xs-12">
							  <div class="info-box">
								<span class="info-box-icon bg-blue"><i class="ion ion-ios-people-outline"></i></span>

								<div class="info-box-content">
								  <span class="info-box-text">Total de Participantes Inativos</span>
								  <span class="info-box-number"><? print $inativos; ?></span>
								</div>
								<!-- /.info-box-content -->
							  </div>
							  <!-- /.info-box -->
							</div>							
							
							<!-- /.col -->
							<div class="col-md-3 col-sm-6 col-xs-12">
							  <div class="info-box">
								<span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>

								<div class="info-box-content">
								  <span class="info-box-text">Total de Pessoas na Fila de Espera</span>
								  <span class="info-box-number"><? print $TfilaEspera; ?></span>
								</div>
								<!-- /.info-box-content -->
							  </div>
							  <!-- /.info-box -->
							</div>

							<!-- /.col
							 <div class="clearfix visible-sm-block"></div>
							 -->

							<div class="col-md-3 col-sm-6 col-xs-12">
							  <div class="info-box">
								<span class="info-box-icon bg-yellow"><i class="ion ion-ios-cart-outline"></i></span>

								<div class="info-box-content">
								  <span class="info-box-text">Total de Turmas realizadas</span>
								  <span class="info-box-number"><? print $Tturmas; ?></span>
								</div>
								<!-- /.info-box-content -->
							  </div>
							  <!-- /.info-box -->
							</div>

							<!-- /.col -->
							<div class="col-md-3 col-sm-6 col-xs-12">
							  <div class="info-box">
								<span class="info-box-icon bg-margenta"><i class="ion ion-ios-people-outline"></i></span>

								<div class="info-box-content">
								  <span class="info-box-text">Total de Bairros atendidos</span>
								  <span class="info-box-number"><? print $Tbairros; ?></span>
								</div>
								<!-- /.info-box-content -->
							  </div>
							  <!-- /.info-box -->
							</div>

							<!-- /.col -->
						  </div>
						</section>		 
				  
				  </td>
				</tr>			  
                <tr>
				<td width='50%'>			  
					<div class="box box-danger">
					  <div class="box-header with-border">
						<h3 class="box-title"><b>Os seis bairros que reciclam mais orgânicos em peso ( quilo )</b></h3>
					  </div>					  
					  <div id="legendOrganicos" style="height:200px"></div>
					  <!-- /.box-body -->
					</div>
				</td>
				<td width='50%'>
					<div class="box box-danger">
					  <div class="box-header with-border">
						<h3 class="box-title"><b>Os seis bairros com maior número de participantes</b></h3>
					  </div>
					  <div id="legendQtde" style="height:200px" ></div>					  
					  <!-- /.box-body -->
					</div>			
				</td>				
				</tr>
				
                <tr>
				<td width='50%'>			  
					<div class="box box-danger">
					  <div class="box-body">
						<canvas id="pieChart" style="height:250px" ></canvas>
					  </div>
					  <!-- /.box-body -->
					</div>
				</td>
				<td width='50%'>
					<div class="box box-danger">
					  <div class="box-body" >
						<canvas id="pieChart2" style="height:250px"></canvas>
					  </div>
					  <!-- /.box-body -->
					</div>			
				</td>				
				</tr>
				
				<tr>
				<td colspan="2" >
				   <!-- BAR CHART -->
					<div class="box box-success">
					  <div class="box-header with-border">
						<h3 class="box-title"><b>Comparativo entre troca de caixa e compostagem ( em quilo ) nos últimos doze (12) meses<b></h3>

						<!--	
						<div class="box-tools pull-right">
						  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
						  </button>
						  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
						</div>
						-->
						</div>
					  </div>
					  <div class="box-body">
						<div class="chart">
						  <canvas id="barChart" style="height:250px"></canvas>
						</div>
					  </div>
					  <!-- /.box-body -->
					</div>
					<!-- /.box -->
				</td>
				</tr>
				</table>
			</div>
			</section>
			
		<!-- Footer -->
			<footer id="footer">
				<div class="container">
					<ul class="icons">
						<li><a href="https://twitter.com/_comcap" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
						<li><a href="https://www.facebook.com/comcapoficial" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
						<li><a href="https://www.instagram.com/explore/locations/240724652/prefeitura-de-florianopolis/" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
						<li><a href="mailto:minhocacabeca.comcap@pmf.sc.gov.br" class="icon fa-envelope-o"><span class="label">Email</span></a></li>
					</ul>
				</div>
				<div class="copyright">
					<header class="align-center">
							<img src="../images/Comcap.png" alt="" />
							<img src="../images/Prefeitura.png" alt=""/>
					</header>
				</div>
			</footer>

		<!-- Scripts -->
			<script src="../assets/js/jquery.min.js"></script>
			<script src="../assets/js/jquery.scrollex.min.js"></script>
			<script src="../assets/js/skel.min.js"></script>
			<script src="../assets/js/util.js"></script>
			<script src="../assets/js/main.js"></script>

		   <script src="http://www.nffacademia.com.br/nff/js/chartjs/Chart.min.js"></script>
		   <script>
		  $(function () {
			/* ChartJS
			 * -------
			 * Here we will create a few charts using ChartJS
			 */

			//-------------
			//- PIE CHART -
			//-------------
			// Get context with jQuery - using jQuery's .get() method.
			
			
			var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
			var pieChart = new Chart( pieChartCanvas );

			var pieChartCanvas2 = $("#pieChart2").get(0).getContext("2d");
			var pieChart2 = new Chart( pieChartCanvas2 );

			var local = "<? print $local; ?>";
			var arrayLocal = local.split(";");

			var quantidade = "<? print $qtde; ?>";
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

			var bairro  = "<? print $bairro; ?>";
			var arrayBairro = bairro.split(";");

			var familia = "<? print $familia; ?>";
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
			

			
			
		 var mesAnoPlano = "<? print $mesAno; ?>";
		 var arrayMesAnoPlano = mesAnoPlano.split(";");

		 var particante = "<? print $pessoa; ?>";
		 var arrayParticante = particante.split(";");

		 var organico = "<? print $organico; ?>";
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

			//-------------
			//- BAR CHART -
			//-------------
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

			
			//Create pie or douhnut chart
			// You can switch between pie and douhnut using the method below.
			var pieLegend = pieChart.Pie(PieData, pieOptions);
			document.getElementById('legendOrganicos').innerHTML = pieLegend.generateLegend();
			pieChart.Doughnut(PieData, pieOptions);
			
			var pieLegend2 = pieChart2.Pie(PieData2, pieOptions2);
			document.getElementById('legendQtde').innerHTML = pieLegend2.generateLegend();			
			pieChart2.Doughnut(PieData2, pieOptions2);			
			
			barChartOptions.datasetFill = true;
			barChart.Bar(barChartData, barChartOptions);
			
			
		  });
		</script> 			
	</body>
</html>