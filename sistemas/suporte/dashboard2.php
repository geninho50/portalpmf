<?php 
header('Content-Type: charset=utf-8');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");

date_default_timezone_set ('America/Bahia'); //timezone que aparece com o horário correto

$json_nfps = file_get_contents('http://sefinnetweb.pmf.sc.gov.br/Sefinnet/script/hotSiteRemote/top5PagesHotSiteNfpe');
$json_sefinnet = file_get_contents('http://sefinnetweb.pmf.sc.gov.br/Sefinnet/script/hotSiteRemote/top5PagesHotSiteSefin');
$json_total_sites = file_get_contents('http://sefinnetweb.pmf.sc.gov.br/Sefinnet/script/hotSiteRemote/topPagesHotSite');
$json_bot = file_get_contents('http://sefinnetweb.pmf.sc.gov.br/Sefinnet/script/hotSiteRemote/qndeChatBot');
$json_notas_emitidas = file_get_contents('http://sefinnetweb.pmf.sc.gov.br/Sefinnet/script/hotSiteRemote/qndeNotasEmitidas');
$json_declaracoes_emitidas = file_get_contents('http://sefinnetweb.pmf.sc.gov.br/Sefinnet/script/hotSiteRemote/qndeDeclaracoes');
$json_impressao_dam = file_get_contents('http://sefinnetweb.pmf.sc.gov.br/Sefinnet/script/hotSiteRemote/qndeImpressaoDAM');
$json_segunda_via = file_get_contents('http://sefinnetweb.pmf.sc.gov.br/Sefinnet/script/hotSiteRemote/top5DamSegundaVia');
$json_acomp_nfps = file_get_contents('http://sefinnetweb.pmf.sc.gov.br/Sefinnet/script/hotSiteRemote/getInfoAcompNfpse');
$json_acomp_declaracao = file_get_contents('http://sefinnetweb.pmf.sc.gov.br/Sefinnet/script/hotSiteRemote/getInfoAcompSefin');

?>

<!DOCTYPE html>
<html lang="en">
<head>
  
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8"> 
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="images/favicon.ico" type="image/ico" />

  <title>Dashboard | Suporte</title>

  <!-- Bootstrap -->
  <link href="https://sefinnetweb.pmf.sc.gov.br/Sefinnet/resource/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="https://sefinnetweb.pmf.sc.gov.br/Sefinnet/resource/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">        
  <!-- Custom Theme Style -->
  <link href="https://sefinnetweb.pmf.sc.gov.br/Sefinnet/resource/css/custom.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<style type="text/css">

    #graficoAcompanhamento{
    direction: ltr;
     position: absolute; 
     left: 0px; 
     top: 0px; 
     width: 100% !important;
    height: 100% !important ;
  }
  
  #graficoAcompanhamento2{
    direction: ltr;
     position: absolute; 
     left: 0px; 
     top: 0px; 
     width: 100% !important;
      height: 100% !important ;
  }
</style>

  <script
    src="https://code.jquery.com/jquery-3.4.1.js"
    integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
    crossorigin="anonymous"></script>

  <script>

    
     setTimeout(function(){
      window.location.reload(1);
    }, 600000);

    $(document).ready(function(){


      var notasEmitidasJson = JSON.parse('<?php echo $json_notas_emitidas ?>');
      var declaracoesEmitidasJson = JSON.parse('<?php echo $json_declaracoes_emitidas ?>');

      var notasEmitidasMes=document.getElementById("totalNotaMes");
      var notasEmitidasAno=document.getElementById("totalNotaAno");
      var declaracoesEmitidasMes=document.getElementById("totalDeclaracaoMes");
      var declaracoesEmitidasAno=document.getElementById("totalDeclaracaoAno");

      var notasMesAux = Number(notasEmitidasJson[0].mes);
      var notasAnoAux = Number(notasEmitidasJson[0].ano);
      var declaracoesMesAux = Number(declaracoesEmitidasJson[0].mes);
      var declaracoesAnoAux = Number(declaracoesEmitidasJson[0].mes);
      notasEmitidasMes.innerText = notasMesAux.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
      notasEmitidasAno.innerText = notasAnoAux.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
      declaracoesEmitidasMes.innerText = declaracoesMesAux.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
      declaracoesEmitidasAno.innerText = declaracoesAnoAux.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");



      var totalAcessosJson = JSON.parse('<?php echo $json_total_sites?>');

      var paginaTotalSefinnet = document.getElementById("paginaTotalSefinnet");
      var paginaTotalNfps = document.getElementById("paginaTotalNfps");


      for(var i=0;i<3;i++){
        if(totalAcessosJson[i].sistema=="1"){
          var acessosSefinEFiac = Number(totalAcessosJson[i].total) + Number(totalAcessosJson[totalAcessosJson.findIndex(obj=>obj.sistema=="2")].total);
          acessosSefinEFiac = acessosSefinEFiac.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
          paginaTotalSefinnet.innerText = acessosSefinEFiac;
        }else if(totalAcessosJson[i].sistema=="3"){
          var totalNfpsAux = Number(totalAcessosJson[i].total);
          paginaTotalNfps.innerText = totalNfpsAux.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

      }

      var botJson = JSON.parse('<?php echo $json_bot ?>');

      var botMes = document.getElementById("chatbotMesAcessos");
      var botAno = document.getElementById("chatbotAnoAcessos");

      var botMesAux = botJson[0].mes;
      var botAnoAux = botJson[0].ano;
      botMes.innerText = botMesAux.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
      botAno.innerText = botAnoAux.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");

      var damJson = JSON.parse('<?php echo $json_impressao_dam ?>');
      var impressoesDamMes = document.getElementById("impressoesDamMes");
      var impressoesDamAno = document.getElementById("impressoesDamAno");
      var impressoesMesAux=Number(damJson[0].mes);
      var impressoesAnoAux=Number(damJson[0].ano);

      impressoesDamMes.innerText = impressoesMesAux.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
      impressoesDamAno.innerText = impressoesAnoAux.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");


      var nfpsJson = JSON.parse('<?php echo $json_nfps ?>');

      var paginasNfps = document.getElementsByClassName("paginaNfps");
      var acessosMesNfps = document.getElementsByClassName("valorMesNfps");
      var acessosDiaNfps = document.getElementsByClassName("valorDiaNfps");
      for(var i=0; i<paginasNfps.length; i++) {
       paginasNfps[i].innerText = nfpsJson[i].tela;
       acessosMesNfps[i].innerText = nfpsJson[i].totalMes;
       acessosDiaNfps[i].innerText = nfpsJson[i].totalDia;
     }


     var sefinJson = JSON.parse('<?php echo $json_sefinnet ?>');

     var paginasSefinnet = document.getElementsByClassName("paginaSefinnet");
     var acessosMesSefinnet = document.getElementsByClassName("valorMesSefinnet");
     var acessosDiaSefinnet = document.getElementsByClassName("valorDiaSefinnet");
     for(var i=0; i<paginasSefinnet.length; i++) {
       paginasSefinnet[i].innerText = sefinJson[i].tela;
       acessosMesSefinnet[i].innerText = sefinJson[i].totalMes;
       acessosDiaSefinnet[i].innerText = sefinJson[i].totalDia;
     }

     
     var segundaViaJson = JSON.parse('<?php echo $json_segunda_via ?>');
     var damInfo = document.getElementsByClassName("damInfo");
     var valorDiarioDam = document.getElementsByClassName("valorDiarioDam");


     for(var i=0;i<= damInfo.length;i++){
      damInfo[i].innerText = segundaViaJson[i].info;
      valorDiarioDam[i].innerText = segundaViaJson[i].total;
    }

  });



 function carregaPorcentagem(){
      
      var porcentagem = document.getElementsByClassName("count_bottom");
      for (var i = 0; i  <= porcentagem.length; i++) {
        if(porcentagem[i].innerText.includes("-")){
          porcentagem[i].style.color=  "red";
        }
     }
  }
  </script>

<style> /* *{border: 1px solid black;}</style>
</head>

<body class="nav-md" sytle="overflow: hidden;" onload="carregaPorcentagem()">

  <div class="container body">
    <div class="main_container">

      <!-- page content -->
      <div class="right_col" role="main">
        <!-- top tiles --> 
        <div class="row tile_count">
          <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-clock-o"></i> Nº NFPS-e emitidas Mês</span>
            <div class="count green" id="totalNotaMes">0</div>
            <span class="count_bottom">Total ano: <span id="totalNotaAno" class="green">333</span> </span>
          </div>


          <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-clock-o"></i> Nº Declarações Mês</span>
            <div class="count green" id="totalDeclaracaoMes">0</div>
            <span class="count_bottom">Total ano: <span id="totalDeclaracaoAno" class="green">58</span> </span>
          </div>


          <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> Impressões DAM Mês</span>
            <div class="count green" id="impressoesDamMes">0</div>
            <span class="count_bottom">Total ano: <span class="green" id="impressoesDamAno">0</span> </span>
          </div>

          <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i>Acessos Portal NFPS-e(Mês)</span>
            <div class="count green" id="paginaTotalNfps">0</div>
          </div>  

          <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i>Acessos Portal Sefinnet(Mês)</span>
            <div class="count green" id="paginaTotalSefinnet">0</div>

          </div>

          <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-clock-o"></i> Nº Acessos Chatbot Mês</span>
            <div class="count green"id="chatbotMesAcessos">0</div>
            <span class="count_bottom">Total ano: <span id="chatbotAnoAcessos"class="green">0</span> </span>
          </div>


        </div>  
        <!-- /top tiles -->

         <div class="row">
          <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="dashboard_graph">

              <div class="row x_title">
                <div class="col-md-12">
                  <h3>Acompanhamento de Emissão de Notas (<?php echo date("M")?>)</h3>
                </div>
              </div>

              <div class="col-md-12 col-sm-9 col-xs-12">
                <div class="demo-placeholder" style="padding: 0px; position: relative;">
                  <canvas id="graficoAcompanhamento" class="flot-base" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 1142px; height: 600px;" width="1142" height="500"></canvas>
                </div>
              </div>
              <div class="col-md-3 col-sm-3 col-xs-12 bg-white">

            
              </div>

              <div class="clearfix"></div>
            </div>
          </div>

          <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="dashboard_graph">

              <div class="row x_title">
                <div class="col-md-12">
                  <h3>Acompanhamento de Declarações SEFINnetWeb (<?php echo date("M")?>)</h3>
                </div>
              </div>

              <div class="col-md-12 col-sm-9 col-xs-12">
                <div class="demo-placeholder" style="padding: 0px; position: relative;">
                  <canvas id="graficoAcompanhamento2" class="flot-base" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 100px !important; height: 50px !important ;" ></canvas>
                </div>
              </div>
              <div class="col-md-3 col-sm-3 col-xs-12 bg-white">

            
              </div>

              <div class="clearfix"></div>
            </div>
          </div>

        </div>



    <p style="font-size: 1px;">.</p>

    <div class="row">
    
      <div class="col-md-4 col-sm-4 col-xs-12">
        <div class="x_panel tile fixed_height_300">
          <div class="x_title">
            <h2>Mais Acessos Páginas Suporte NFPS</h2>                  
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="widget_summary">
              <div class="w_left w_55">
                <span nowrap="true">&nbsp;</span>
              </div>
              <div class="w_right w_20">
                <p>Mês</p>
              </div>
              <div class="w_right w_20">
                <p>Hoje</p>
              </div>
              <div class="clearfix"></div>
            </div>
            <div class="widget_summary">
              <div class="w_left w_55">
                <span nowrap="true" class="paginaNfps">Como emitir</span>
              </div>
              <div class="w_right w_20">
                <span class="valorMesNfps">0</span>
              </div>
              <div class="w_right w_20">
                <span class="valorDiaNfps">0</span>
              </div>
              <div class="clearfix"></div>
            </div>
            <div class="widget_summary">
              <div class="w_left w_55">
                <span class="paginaNfps">Nota Simplificada</span>
              </div>
              <div class="w_right w_20">
                <span class="valorMesNfps"></span>
              </div>
              <div class="w_right w_20">
                <span class="valorDiaNfps">0</span>
              </div>
              <div class="clearfix"></div>
            </div>                                
            <div class="widget_summary">
              <div class="w_left w_55">
                <span class="paginaNfps">Emitir Nota</span>
              </div>
              <div class="w_right w_20">
                <span class="valorMesNfps">0</span>
              </div>
              <div class="w_right w_20">
                <span class="valorDiaNfps">0</span>
              </div>
              <div class="clearfix"></div>
            </div>
            <div class="widget_summary">
              <div class="w_left w_55">
                <span class="paginaNfps">Consultar Nota</span>
              </div>
              <div class="w_right w_20">
                <span class="valorMesNfps">0</span>
              </div>
              <div class="w_right w_20">
                <span class="valorDiaNfps">0</span>
              </div>
              <div class="clearfix"></div>
            </div>
            <div class="widget_summary">
              <div class="w_left w_55">
                <span class="paginaNfps">Autenticidade Homologação</span>
              </div>
              <div class="w_right w_20">
                  <span class="valorMesNfps">0</span>
              </div>
              <div class="w_right w_20">
                <span class="valorDiaNfps">0</span>
              </div>
              <div class="clearfix"></div>
            </div>
          </div>
        </div>
      </div>


            <div class="col-md-4 col-sm-4 col-xs-12">
        <div class="x_panel tile fixed_height_300">
          <div class="x_title">
            <h2>Mais Acessos Páginas Suporte Sefinnet</h2>                  
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="widget_summary">
              <div class="w_left w_55">
                <span nowrap="true">&nbsp;</span>
              </div>
              <div class="w_right w_20">
                <p>Mês</p>
              </div>
              <div class="w_right w_20">
                <p>Hoje</p>
              </div>
              <div class="clearfix"></div>
            </div>
            <div class="widget_summary">
              <div class="w_left w_55">
                <span nowrap="true" class="paginaSefinnet">Como Acessar</span>
              </div>
              <div class="w_right w_20">
                <span class="valorMesSefinnet">0</span>
              </div>
              <div class="w_right w_20">
                <span class="valorDiaSefinnet">0</span>
              </div>
              <div class="clearfix"></div>
            </div>
            <div class="widget_summary">
              <div class="w_left w_55">
                <span class="paginaSefinnet">Instrumento Mandato</span>
              </div>
              <div class="w_right w_20">
                <span class="valorMesSefinnet">0</span>
              </div>
              <div class="w_right w_20">
                <span class="valorDiaSefinnet">0</span>
              </div>
              <div class="clearfix"></div>
            </div>                                
            <div class="widget_summary">
              <div class="w_left w_55">
                <span class="paginaSefinnet">GIF PF</span>
              </div>
              <div class="w_right w_20">
                <span class="valorMesSefinnet">0</span>
              </div>
              <div class="w_right w_20">
                <span class="valorDiaSefinnet">0</span>
              </div>
              <div class="clearfix"></div>
            </div>
            <div class="widget_summary">
              <div class="w_left w_55">
                <span class="paginaSefinnet">GIF PJ</span>
              </div>
              <div class="w_right w_20">
                <span class="valorMesSefinnet">0</span>
              </div>
              <div class="w_right w_20">
                <span class="valorDiaSefinnet">0</span>
              </div>
              <div class="clearfix"></div>
            </div>
            <div class="widget_summary">
              <div class="w_left w_55">
                <span class="paginaSefinnet">Recolhimento</span>
              </div>
              <div class="w_right w_20">
                  <span class="valorMesSefinnet">1</span>
              </div>
              <div class="w_right w_20">
                <span class="valorDiaSefinnet">0</span>
              </div>
              <div class="clearfix"></div>
            </div>
          </div>
        </div>
      </div>


             <div class="col-md-4 col-sm-4 col-xs-12">
        <div class="x_panel tile fixed_height_300">
          <div class="x_title">
            <h2>Segunda Via DAM</h2>                  
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="widget_summary">
              <div class="w_left w_55">
                <span nowrap="true">&nbsp;</span>
              </div>
              <div class="w_right w_20">
                <p>Hoje</p>
              </div>
              <div class="w_right w_20">
                <p></p>
              </div>
              <div class="clearfix"></div>
            </div>
            <div class="widget_summary">
              <div class="w_left w_55">
                <span nowrap="true" class="damInfo">Como Acessar</span>
              </div>
              <div class="w_right w_20">
                <span class="valorDiarioDam">0</span>
              </div>
              <div class="w_right w_20">
                <span class="valorDiaDam"></span>
              </div>
              <div class="clearfix"></div>
            </div>
            <div class="widget_summary">
              <div class="w_left w_55">
                <span class="damInfo">Instrumento Mandato</span>
              </div>
              <div class="w_right w_20">
                <span class="valorDiarioDam">0</span>
              </div>
              <div class="w_right w_20">
                <span class="valorDiaDam"></span>
              </div>
              <div class="clearfix"></div>
            </div>                                
            <div class="widget_summary">
              <div class="w_left w_55">
                <span class="damInfo">GIF PF</span>
              </div>
              <div class="w_right w_20">
                <span class="valorDiarioDam">0</span>
              </div>
              <div class="w_right w_20">
                <span class="valorDiaDam"></span>
              </div>
              <div class="clearfix"></div>
            </div>
            <div class="widget_summary">
              <div class="w_left w_55">
                <span class="damInfo">GIF PJ</span>
              </div>
              <div class="w_right w_20">
                <span class="valorDiarioDam">0</span>
              </div>
              <div class="w_right w_20">
                <span class="valorDiaDam"></span>
              </div>
              <div class="clearfix"></div>
            </div>
            <div class="widget_summary">
              <div class="w_left w_55">
                <span class="damInfo">Recolhimento</span>
              </div>
              <div class="w_right w_20">
                  <span class="valorDiarioDam">1</span>
              </div>
              <div class="w_right w_20">
                <span class="valorDiaDam"></span>
              </div>
              <div class="clearfix"></div>
            </div>
          </div>
        </div>
      </div>


        </div>

        <h2 style="float: right;">Atualizado as <b><?php echo date("H:i")." - ".date("d/m/Y")?></b>.</h2>
      </div>
      <!-- /page content -->

    </div>
  </div>

  <!-- jQuery -->
  <script src="https://sefinnetweb.pmf.sc.gov.br/Sefinnet/resource/js/jquery.js"></script>
  <!-- Bootstrap -->
  <script src="https://sefinnetweb.pmf.sc.gov.br/Sefinnet/resource/vendors/bootstrap/dist/js/bootstrap.min.js"></script>      

  <!-- bootstrap-progressbar -->
  <script src="https://sefinnetweb.pmf.sc.gov.br/Sefinnet/resource/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>

  <!-- Custom Theme Scripts -->
  <script src="https://sefinnetweb.pmf.sc.gov.br/Sefinnet/resource/js/custom.min.js"></script>

  <!-- Chart.js -->
  <script src="https://sefinnetweb.pmf.sc.gov.br/Sefinnet/resource/vendors/Chart.js/dist/Chart.min.js"></script>

  <!-- Flot -->
  <script src="https://sefinnetweb.pmf.sc.gov.br/Sefinnet/resource/vendors/Flot/jquery.flot.js"></script>
  <script src="https://sefinnetweb.pmf.sc.gov.br/Sefinnet/resource/vendors/Flot/jquery.flot.time.js"></script>

  <!-- Flot plugins -->    
  <script src="https://sefinnetweb.pmf.sc.gov.br/Sefinnet/resource/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>

  <!-- DateJS -->
  <script src="https://sefinnetweb.pmf.sc.gov.br/Sefinnet/resource/vendors/DateJS/build/date.js"></script>



  <script>      
Chart.defaults.global.legend.display = false;
        var data = new Date();
        var mesAtual = data.getMonth();
        var meses = new Array(
      'Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro');


        //Grafico NFPS 
        var jsonAcompNfps = JSON.parse('<?php echo $json_acomp_nfps ?>');
      
       
        if ($('#graficoAcompanhamento').length ){ 
              
          var ctx = document.getElementById("graficoAcompanhamento");
          var mybarChart = new Chart(ctx, {
            type: 'bar',
            data: {
                type: 'bar',
              labels:  jsonAcompNfps.dias,
              datasets: [{
               // label: meses[mesAtual] ,
                backgroundColor: "#1abb9c",
                data: jsonAcompNfps.valores,
              }]
            },
            options: {             
              scales: {
                xAxes: [{
                    gridLines: {
                        color: "rgba(0, 0, 0, 0)",
                    }
                }],
                yAxes: [{
                    gridLines: {
                        color: "rgba(0, 0, 0, 0)",
                    },
                    ticks: {
                        beginAtZero: true,
                        callback: function(value, index, values) {
                            return  value;
                          }
                      }   
                }]
                }
            }
          });
        }         


        var jsonAcompDeclaracao = JSON.parse('<?php echo $json_acomp_declaracao ?>');
  

         if ($('#graficoAcompanhamento2').length ){ 
              
          var ctx = document.getElementById("graficoAcompanhamento2");
           var mybarChart = new Chart(ctx, {
            type: 'bar',
            data: {
                type: 'bar',
              labels:  jsonAcompDeclaracao.dias,
              datasets: [{
                //label: meses[mesAtual] ,
                backgroundColor: "#1abb9c",
                data: jsonAcompDeclaracao.valores,
              }]
            },
            options: {             
              scales: {
                xAxes: [{
                    gridLines: {
                        color: "rgba(0, 0, 0, 0)",
                    }
                }],
                yAxes: [{
                    gridLines: {
                        color: "rgba(0, 0, 0, 0)",
                    },
                    ticks: {
                        beginAtZero: true,
                        callback: function(value, index, values) {
                            return  value;
                          }
                      }   
                }]
                }
            }
          });
        }         
  


</script>

</body>
</html>