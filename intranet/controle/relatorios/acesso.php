<?php
switch($_POST['Racesso']){
	case "1": $titulo = "geral"; 	break;
	case "2": $titulo = "usuário"; 	break;
	case "3": $titulo = "entidade"; break;
	default:  $titulo = "geral";	break;
}
?>
<script src="../scripts/js/amcharts/amcharts/amcharts.js" type="text/javascript"></script>    
<script ype="text/javascript"> 
function MostraPaineis(){ 
	var i 
	if (document.getElementById("Ruser").checked){
		document.getElementById('Dentidade').style.display = 'none';
		document.getElementById('Duser').style.display = 'block';
	}else{
		if (document.getElementById("Rentidade").checked){
			document.getElementById('Duser').style.display = 'none';
			document.getElementById('Dentidade').style.display = 'block';
		}else{
			document.getElementById('Dentidade').style.display = 'none';
			document.getElementById('Duser').style.display = 'none';
		}
	}
} 
</script>
<div class="centro">
    <div id="caminho_migalhas">intranet &gt;</div>
    <div id="titulo_pagina">relatórios de acesso</div>
    <div id="margem_direita"><br>
	    <div class="conteudo_abas">
       		<div id="conteudo_dados" style="display:inline">       
            	<form method="post" action="inicio.php?pagina=<?=$_GET['pagina']?>&menu=<?=$_GET['menu']?>">       
                    <input type="radio" id="Rgeral" name="Racesso" value="1" <?php if(($_POST['Racesso'] == 1) || (!isset($_POST['Racesso']))){echo "checked=\"checked\""; }?> onchange="javascript:MostraPaineis()" /> Geral
                    <input type="radio" id="Ruser" name="Racesso" value="2" <?php if($_POST['Racesso'] == 2){echo "checked=\"checked\""; }?> onchange="javascript:MostraPaineis()" /> Usuário                    
                    <input type="radio" id="Rentidade" name="Racesso" value="3" <?php if($_POST['Racesso'] == 3){echo "checked=\"checked\""; }?> onchange="javascript:MostraPaineis()" /> Entidade
                    <br /><br />
                    <div id="Duser" <?php if($_POST['Racesso'] == 2){echo "style=\"display:block;\"";}else{echo "style=\"display:none;\"";}?>  >
						<?php                       
						$sql 	  = "SELECT * FROM users ORDER BY user_nome ASC";
						$TretUser = $drive->pedido($sql);
						$Tnomes   = "";
						while($obj = pg_fetch_object($TretUser)) {							
							$Tnomes .= "\"".$obj->user_id." - ".$obj->user_nome."\", ";
						}
						?>
                        <script>
						$(document).ready(function() {
							$("input#Fuser").autocomplete({
								source: [<?=$Tnomes?>]
							});
						});
						</script>                   
						<input name="Fuser" id="Fuser" type="text" class="componente_miolo" value="<?=$_POST['Fuser']?>" />
                        <br /><br />
                    </div>
					<div id="Dentidade" <?php if($_POST['Racesso'] == 3){echo "style=\"display:block;\"";}else{echo "style=\"display:none;\"";}?>  >
                        <?php
                        require_once("../scripts/php/funcoes.php");
						combo_entidades_portal($drive, "Fentidade", $_POST['Fentidade']);
						?>
                        <br />
                    </div>                    
                    <input type="image" src="../layout/imagens/intra_btn_ok.png" name="btBusca" id="btBusca" align="absmiddle" />
                </form>
            </div>            
        </div>
        <br />
        <div class="conteudo_abas">
       		<div id="conteudo_dados" style="display:inline">              
				<div style="background-color:#DDDDDD; width:703px; margin:-20px 0 0 -20px; padding:10px 0 10px 10px; font-size:14px;"><b><?=$titulo?> -> navegadores</b></div>
				<div style="background-color:#FFF; border:1px solid #DDDDDD; margin-top:20px;">
					<?php
					$qie  		= "SELECT COUNT(intranet_log_id) FROM intranet_log_acesso WHERE intranet_log_navegador ILIKE '%MSIE%' ";
								if($_POST['Racesso'] == 3){$qie .= "AND intranet_log_entidade_id = ".$_POST['Fentidade'];}		
								if($_POST['Racesso'] == 2){$TuserId = explode(" ", $_POST['Fuser']); $qie .= "AND intranet_log_user_id = ".$TuserId[0];}			
					$qfirefox  	= "SELECT COUNT(intranet_log_id) FROM intranet_log_acesso WHERE intranet_log_navegador ILIKE '%Firefox%' ";
								if($_POST['Racesso'] == 3){$qfirefox .= "AND intranet_log_entidade_id = ".$_POST['Fentidade'];}			
								if($_POST['Racesso'] == 2){$TuserId = explode(" ", $_POST['Fuser']); $qfirefox .= "AND intranet_log_user_id = ".$TuserId[0];}
					$qsafari  	= "SELECT COUNT(intranet_log_id) FROM intranet_log_acesso WHERE intranet_log_navegador ILIKE '%Safari%' AND intranet_log_navegador NOT ILIKE '%Chrome%' ";
								if($_POST['Racesso'] == 3){$qsafari .= "AND intranet_log_entidade_id = ".$_POST['Fentidade'];}			
								if($_POST['Racesso'] == 2){$TuserId = explode(" ", $_POST['Fuser']); $qsafari .= "AND intranet_log_user_id = ".$TuserId[0];}
					$qchrome  	= "SELECT COUNT(intranet_log_id) FROM intranet_log_acesso WHERE intranet_log_navegador ILIKE '%Chrome%' ";
								if($_POST['Racesso'] == 3){$qchrome .= "AND intranet_log_entidade_id = ".$_POST['Fentidade'];}			
								if($_POST['Racesso'] == 2){$TuserId = explode(" ", $_POST['Fuser']); $qchrome .= "AND intranet_log_user_id = ".$TuserId[0];}
					$qoutros  	= "SELECT COUNT(intranet_log_id) FROM intranet_log_acesso ";
								if($_POST['Racesso'] == 3){$qoutros .= "WHERE intranet_log_entidade_id = ".$_POST['Fentidade'];}								
								if($_POST['Racesso'] == 2){$TuserId = explode(" ", $_POST['Fuser']); $qoutros .= "WHERE intranet_log_user_id = ".$TuserId[0];}
					$rie 		= $drive->pedido($qie);
					$rfirefox 	= $drive->pedido($qfirefox);
					$rsafari 	= $drive->pedido($qsafari);
					$rchrome 	= $drive->pedido($qchrome);
					$routros 	= $drive->pedido($qoutros);					
					$tie		= pg_fetch_object($rie);
					$tfirefox	= pg_fetch_object($rfirefox);
					$tsafari	= pg_fetch_object($rsafari);
					$tchrome	= pg_fetch_object($rchrome);
					$toutros	= pg_fetch_object($routros);					
					$toutros	= ($toutros->count - ($tie->count + $tfirefox->count + $tchrome->count + $tsafari->count));					
					?>                    
				   	<script type="text/javascript">
                        var chart;
            
                        var chartData = [{
                            navegador: "Internet Explorer",
                            visits: <?=$tie->count?>,
							color: "#01BFEF"
                        }, {
                            navegador: "Firefox",
                            visits: <?=$tfirefox->count?>,
							color: "#F29706"
                        }, {
                            navegador: "Chrome",
                            visits: <?=$tchrome->count?>,
							color: "#5BC15B"
                        }, {
                            navegador: "Safari",
                            visits: <?=$tsafari->count?>,
							color: "#7E7F7F"
                        }, {
                            navegador: "Outros",
                            visits: <?=$toutros?>,
							color: "#000000"
                        }];
            
            
                        AmCharts.ready(function () {
                            // PIE CHART
                            chart = new AmCharts.AmPieChart();
                
                            chart.dataProvider = chartData;
                            chart.titleField = "navegador";
                            chart.valueField = "visits";
							chart.colorField = "color";
                            chart.sequencedAnimation = true;
                            chart.startEffect = "elastic";
                            chart.innerRadius = "30%";
                            chart.startDuration = 2;
                            chart.labelRadius = 15;
            				chart.outlineColor = "#FFFFFF";
							chart.outlineAlpha = 0.8;
							chart.outlineThickness = 2;
                            // the following two lines makes the chart 3D
                            chart.depth3D = 10;
                            chart.angle = 15;
            
                            // WRITE                                 
                            chart.write("chartdiv");
                        });
                    </script>
                    <div id="chartdiv" style="width:100%; height:300px;"></div>
            	</div>
            </div>            
        </div>     
        <br />
        <div class="conteudo_abas">       		
       		<div id="conteudo_dados" style="display:inline">              
				<div style="background-color:#DDDDDD; width:703px; margin:-20px 0 0 -20px; padding:10px 0 10px 10px; font-size:14px;"><b><?=$titulo?> -> acesso interno / externo</b></div> 
				<div style="background-color:#FFF; border:1px solid #DDDDDD; margin-top:20px;">
                    <?php
					$qinterno1	= "SELECT COUNT(intranet_log_id) FROM intranet_log_acesso WHERE intranet_log_ip <= '192.255.255.255' AND intranet_log_ip >= '192.0.0.0' ";
									if($_POST['Racesso'] == 3){$qinterno1 .= "AND intranet_log_entidade_id = ".$_POST['Fentidade'];}	
									if($_POST['Racesso'] == 2){$TuserId = explode(" ", $_POST['Fuser']); $qinterno1 .= "AND intranet_log_user_id = ".$TuserId[0];}	
					$qinterno2	= "SELECT COUNT(intranet_log_id) FROM intranet_log_acesso WHERE intranet_log_ip <= '172.255.255.255' AND intranet_log_ip >= '172.0.0.0' ";
									if($_POST['Racesso'] == 3){$qinterno2 .= "AND intranet_log_entidade_id = ".$_POST['Fentidade'];}		
									if($_POST['Racesso'] == 2){$TuserId = explode(" ", $_POST['Fuser']); $qinterno2 .= "AND intranet_log_user_id = ".$TuserId[0];}
					$qinterno3	= "SELECT COUNT(intranet_log_id) FROM intranet_log_acesso WHERE intranet_log_ip <= '10.255.255.255' AND intranet_log_ip >= '10.0.0.0' ";
									if($_POST['Racesso'] == 3){$qinterno3 .= "AND intranet_log_entidade_id = ".$_POST['Fentidade'];}		
									if($_POST['Racesso'] == 2){$TuserId = explode(" ", $_POST['Fuser']); $qinterno3 .= "AND intranet_log_user_id = ".$TuserId[0];}				
					$qexterno  	= "SELECT COUNT(intranet_log_id) FROM intranet_log_acesso ";
									if($_POST['Racesso'] == 3){$qexterno .= "WHERE intranet_log_entidade_id = ".$_POST['Fentidade'];}	
									if($_POST['Racesso'] == 2){$TuserId = explode(" ", $_POST['Fuser']); $qexterno .= "WHERE intranet_log_user_id = ".$TuserId[0];}					
					$rinterno1	= $drive->pedido($qinterno1);
					$rinterno2	= $drive->pedido($qinterno2);
					$rinterno3	= $drive->pedido($qinterno3);					
					$rexterno	= $drive->pedido($qexterno);					
					$tinterno1	= pg_fetch_object($rinterno1);
					$tinterno2	= pg_fetch_object($rinterno2);
					$tinterno3	= pg_fetch_object($rinterno3);
					$texterno	= pg_fetch_object($rexterno);									
					$tinterno	= ($tinterno1->count + $tinterno2->count + $tinterno3->count);
					$texterno 	= $texterno->count - $tinterno;
					?>
					<script type="text/javascript">
						var chart;
						var legend;
			
						var chartData1 = [{
							country: "Interno",
							value: <?=$tinterno?>,
							color: "#0092DF"
						}, {
							country: "Externo",
							value: <?=$texterno?>,
							color: "#5BC15B"
						}];
			
						AmCharts.ready(function () {
							// PIE CHART
							chart = new AmCharts.AmPieChart();
							chart.dataProvider = chartData1;
							chart.titleField = "country";
							chart.valueField = "value";
							chart.colorField = "color";
							chart.outlineColor = "#FFFFFF";
							chart.outlineAlpha = 0.8;
							chart.outlineThickness = 2;
							// this makes the chart 3D
							chart.depth3D = 15;
							chart.angle = 30;
			
							// WRITE
							chart.write("local");
						});
					</script>
                    <div id="local" style="width: 100%; height: 300px;"></div>
                </div>
            </div>            
        </div>     
        <br />
        <div class="conteudo_abas">
       		<div id="conteudo_dados" style="display:inline">              
				<div style="background-color:#DDDDDD; width:703px; margin:-20px 0 0 -20px; padding:10px 0 10px 10px; font-size:14px;"><b><?=$titulo?> -> acessos por dia</b></div>
				<div style="background-color:#FFF; border:1px solid #DDDDDD; margin-top:20px;">
					<script type="text/javascript">        
                        var chart;
                        var chartData2 = [];
                        var chartCursor;
            
                        AmCharts.ready(function () {
                            // generate some data first
                            generateChartData();
            
							// SERIAL CHART    
                            chart = new AmCharts.AmSerialChart();
                            chart.pathToImages = "../scripts/js/amcharts/amcharts/images/";
                            chart.zoomOutButton = {
                                backgroundColor: '#000000',
                                backgroundAlpha: 0.15
                            };
                            chart.dataProvider = chartData2;
                            chart.categoryField = "date";
            
                            // listen for "dataUpdated" event (fired when chart is rendered) and call zoomChart method when it happens
                            chart.addListener("dataUpdated", zoomChart);
            
                            // AXES
                            // category
                            var categoryAxis = chart.categoryAxis;
                            categoryAxis.parseDates = true; // as our data is date-based, we set parseDates to true
                            categoryAxis.minPeriod = "DD"; // our data is daily, so we set minPeriod to DD
                            categoryAxis.dashLength = 1;
                            categoryAxis.gridAlpha = 0.15;
                            categoryAxis.axisColor = "#DADADA";
            
                            // value                
                            var valueAxis = new AmCharts.ValueAxis();
                            valueAxis.axisAlpha = 0.2;
                            valueAxis.dashLength = 1;
                            chart.addValueAxis(valueAxis);
            
                            // GRAPH
                            var graph = new AmCharts.AmGraph();
                            graph.title = "red line";
                            graph.valueField = "visits";
                            graph.bullet = "round";
                            graph.bulletBorderColor = "#FFFFFF";
                            graph.bulletBorderThickness = 2;
                            graph.lineThickness = 2;
                            graph.lineColor = "#b5030d";
                            graph.negativeLineColor = "#0352b5";
                            graph.hideBulletsCount = 50; // this makes the chart to hide bullets when there are more than 50 series in selection
                            chart.addGraph(graph);
            
                            // CURSOR
                            chartCursor = new AmCharts.ChartCursor();
                            chartCursor.cursorPosition = "mouse";
                            chart.addChartCursor(chartCursor);
            
                            // SCROLLBAR
                            var chartScrollbar = new AmCharts.ChartScrollbar();
                            chartScrollbar.graph = graph;
                            chartScrollbar.scrollbarHeight = 40;
                            chartScrollbar.color = "#FFFFFF";
                            chartScrollbar.autoGridCount = true;
                            chart.addChartScrollbar(chartScrollbar);
            
                            // WRITE
                            chart.write("dia");
                        });
            
                        // generate some random data, quite different range
                        function generateChartData() {
                            var firstDate = new Date();
                            firstDate.setDate(firstDate.getDate() - 10);
            
                            for (var i = 0; i < 10; i++) {
                                var newDate = new Date(firstDate);
                                newDate.setDate(newDate.getDate() + i);
            
                                var visits = Math.round(Math.random() * 40) - 20;
            
                                chartData2.push({
                                    date: newDate,
                                    visits: visits
                                });
                            }
                        }
            
                        // this method is called when chart is first inited as we listen for "dataUpdated" event
                        function zoomChart() {
                            // different zoom methods can be used - zoomToIndexes, zoomToDates, zoomToCategoryValues
                            chart.zoomToIndexes(chartData2.length - 40, chartData2.length - 1);
                        }
                        
                        // changes cursor mode from pan to select
                        function setPanSelect() {
                            if (document.getElementById("rb1").checked) {
                                chartCursor.pan = false;
                                chartCursor.zoomable = true;
                                
            
                            } else {
                                chartCursor.pan = true;
                            }
                            chart.validateNow();
                        }            
                    </script>
                    <div id="dia" style="width: 100%; height: 300px;"></div>                
                </div>        
            </div>            
        </div>     
        <br />
        <div class="conteudo_abas">
       		<div id="conteudo_dados" style="display:inline">              
				<div style="background-color:#DDDDDD; width:703px; margin:-20px 0 0 -20px; padding:10px 0 10px 10px; font-size:14px;"><b><?=$titulo?> -> acessos por hora </b></div>
				<div style="background-color:#FFF; border:1px solid #DDDDDD; margin-top:20px;">
					<?php
                    $qhoras	= "SELECT intranet_log_data FROM intranet_log_acesso ";
								if($_POST['Racesso'] == 3){$qhoras .= "WHERE intranet_log_entidade_id = ".$_POST['Fentidade'];}		
								if($_POST['Racesso'] == 2){$TuserId = explode(" ", $_POST['Fuser']); $qhoras .= "WHERE intranet_log_user_id = ".$TuserId[0];}
					$rhoras	= $drive->pedido($qhoras);		
					//-----------------------------------------
					// inicia vetor com 0 em todas as posições
					//-----------------------------------------
					for($i=0; $i<24; $i++){
						$vhoras[$i] = 0;
					}	
					//----------------------------------------
					// conta quantas ocorrencias em cada hora
					//----------------------------------------
					$j = 0;
					while($thoras = pg_fetch_object($rhoras)){						
						$thora = date('H', $thoras->intranet_log_data);
						switch ($thora){
							case 00: 	$vhoras[0] 	= $vhoras[0] + 1; break;
							case 01: 	$vhoras[1] 	= $vhoras[1] + 1; break;
							case 02: 	$vhoras[2] 	= $vhoras[2] + 1; break;
							case 03: 	$vhoras[3] 	= $vhoras[3] + 1; break;
							case 04: 	$vhoras[4] 	= $vhoras[4] + 1; break;
							case 05: 	$vhoras[5] 	= $vhoras[5] + 1; break;
							case 06: 	$vhoras[6] 	= $vhoras[6] + 1; break;
							case 07: 	$vhoras[7] 	= $vhoras[7] + 1; break;
							case 08: 	$vhoras[8] 	= $vhoras[8] + 1; break;
							case 09: 	$vhoras[9] 	= $vhoras[9] + 1; break;
							case 10: 	$vhoras[10] = $vhoras[10] + 1; break;
							case 11: 	$vhoras[11] = $vhoras[11] + 1; break;
							case 12: 	$vhoras[12] = $vhoras[12] + 1; break;
							case 13: 	$vhoras[13] = $vhoras[13] + 1; break;
							case 14: 	$vhoras[14] = $vhoras[14] + 1; break;
							case 15: 	$vhoras[15] = $vhoras[15] + 1; break;
							case 16: 	$vhoras[16] = $vhoras[16] + 1; break;
							case 17: 	$vhoras[17] = $vhoras[17] + 1; break;
							case 18: 	$vhoras[18] = $vhoras[18] + 1; break;
							case 19: 	$vhoras[19] = $vhoras[19] + 1; break;
							case 20: 	$vhoras[20] = $vhoras[20] + 1; break;
							case 21: 	$vhoras[21] = $vhoras[21] + 1; break;
							case 22: 	$vhoras[22] = $vhoras[22] + 1; break;
							case 23: 	$vhoras[23] = $vhoras[23] + 1; break;
						}
						$j++;						
					}
					//-------------------
					// monta porcentagem
					//-------------------
					for($i=0; $i<24; $i++){
						$vhoras[$i] = number_format((($vhoras[$i] * 100) / $j), 2, '.', '');;
					}	
														
					?>
					<script type="text/javascript">
                        var chart;            
                        var chartData3 = [{
                            hora: "00:00",
                            visits: <?=$vhoras[0]?>
                        }, {
                            hora: "01:00",
                            visits: <?=$vhoras[1]?>
                        }, {
                            hora: "02:00",
                            visits: <?=$vhoras[2]?>
                        }, {
                            hora: "03:00",
                            visits: <?=$vhoras[3]?>
                        }, {
                            hora: "04:00",
                            visits: <?=$vhoras[4]?>
                        }, {
                            hora: "05:00",
                            visits: <?=$vhoras[5]?>
                        }, {
                            hora: "06:00",
                            visits: <?=$vhoras[6]?>
                        }, {
                            hora: "07:00",
                            visits: <?=$vhoras[7]?>
                        }, {
                            hora: "08:00",
                            visits: <?=$vhoras[8]?>
                        }, {
                            hora: "09:00",
                            visits: <?=$vhoras[9]?>
                        }, {
                            hora: "10:00",
                            visits: <?=$vhoras[10]?>
                        }, {
                            hora: "11:00",
                            visits: <?=$vhoras[11]?>
                        }, {
                            hora: "12:00",
                            visits: <?=$vhoras[12]?>
                        }, {
                            hora: "13:00",
                            visits: <?=$vhoras[13]?>
                        }, {
                            hora: "14:00",
                            visits: <?=$vhoras[14]?>
                        }, {
                            hora: "15:00",
                            visits: <?=$vhoras[15]?>
                        }, {
                            hora: "16:00",
                            visits: <?=$vhoras[16]?>
                        }, {
                            hora: "17:00",
                            visits: <?=$vhoras[17]?>
                        }, {
                            hora: "18:00",
                            visits: <?=$vhoras[18]?>
                        }, {
                            hora: "19:00",
                            visits: <?=$vhoras[19]?>
                        }, {
                            hora: "20:00",
                            visits: <?=$vhoras[20]?>
                        }, {
                            hora: "21:00",
                            visits: <?=$vhoras[21]?>
                        }, {
                            hora: "22:00",
                            visits: <?=$vhoras[22]?>
                        }, {
                            hora: "23:00",
                            visits: <?=$vhoras[23]?>
                        }];
            
            
                        AmCharts.ready(function () {
                            // SERIAL CHART
                            chart = new AmCharts.AmSerialChart();
                            chart.dataProvider = chartData3;
                            chart.categoryField = "hora";							
                            chart.startDuration = 1;
            
                            // AXES
                            // category
                            var categoryAxis = chart.categoryAxis;
							categoryAxis.gridAlpha = 0;
							categoryAxis.fillAlpha = 1;
							categoryAxis.fillColor = "#FAFAFA";
							categoryAxis.gridPosition = "start";
            
                            // value
                            var valueAxis = new AmCharts.ValueAxis();
							valueAxis.unit = "%";
							chart.addValueAxis(valueAxis);
            
                            // GRAPH
                            var graph = new AmCharts.AmGraph();
                            graph.valueField = "visits";
							graph.fillColors = "#b5030d";
							graph.lineAlpha = 0;
                            graph.fillAlphas = 0.8;
               				graph.balloonText = "[[category]]: [[value]]%";								
                            graph.type = "column";
                            chart.addGraph(graph); 
							
                            chart.write("hora");
                        });
                    </script>
                    <div id="hora" style="width: 100%; height: 300px;"></div>
				</div>
            </div>            
        </div>
        <br />
        <?php if(($_POST['Racesso'] == 1) || (!isset($_POST['Racesso']))){?>
        <div class="conteudo_abas">       		
       		<div id="conteudo_dados" style="display:inline">              
				<div style="background-color:#DDDDDD; width:703px; margin:-20px 0 0 -20px; padding:10px 0 10px 10px; font-size:14px;"><b>geral -> acessos por entidade</b></div> 
				<div style="background-color:#FFF; border:1px solid #DDDDDD; margin-top:20px;">
                    <script type="text/javascript">
						var chart;
			
						var chartData4 = [
						
						<?php 
						$sql2 = "SELECT entidade_sigla, entidade_linha_1, entidade_id FROM entidades WHERE entidade_tipo = 0 AND entidade_id <> 0 ORDER BY entidade_linha_1";						
						$Tprefeitura = $drive->pedido($sql2);	
						while($Eprefeitura = pg_fetch_object($Tprefeitura)){
							$qtotal	= "SELECT COUNT(intranet_log_id) FROM intranet_log_acesso WHERE intranet_log_entidade_id = ".$Eprefeitura->entidade_id;		
							$Ttotal = $drive->pedido($qtotal);	
							$Rtotal = pg_fetch_object($Ttotal);
							echo"{
								ent: \"".$Eprefeitura->entidade_sigla."\",
								acesso: ".$Rtotal->count.",
								color: \"#81ACD9\",
								titulo: \"".$Emunicipais->entidade_linha_1."\"
							},";	
						}
						
						$sql2 = "SELECT entidade_sigla, entidade_linha_1, entidade_id FROM entidades WHERE entidade_tipo = 4 ORDER BY entidade_linha_1";
						$Tmunicipais = $drive->pedido($sql2);	
						while($Emunicipais = pg_fetch_object($Tmunicipais)){
							$qtotal	= "SELECT COUNT(intranet_log_id) FROM intranet_log_acesso WHERE intranet_log_entidade_id = ".$Emunicipais->entidade_id;		
							$Ttotal = $drive->pedido($qtotal);	
							$Rtotal = pg_fetch_object($Ttotal);
							echo"{
								ent: \"".$Emunicipais->entidade_sigla."\",
								acesso: ".$Rtotal->count.",
								color: \"#ADD981\",
								titulo: \"".$Emunicipais->entidade_linha_1."\"
							},";	
						}
						
						$sql3 = "SELECT entidade_sigla, entidade_linha_1, entidade_id FROM entidades WHERE entidade_tipo = 5 ORDER BY entidade_linha_1";
						$Texecutivas = $drive->pedido($sql3);
						while($Eexecutivas = pg_fetch_object($Texecutivas)){
							$qtotal	= "SELECT COUNT(intranet_log_id) FROM intranet_log_acesso WHERE intranet_log_entidade_id = ".$Eexecutivas->entidade_id;		
							$Ttotal = $drive->pedido($qtotal);	
							$Rtotal = pg_fetch_object($Ttotal);
							echo"{
								ent: \"".$Eexecutivas->entidade_sigla."\",
								acesso: ".$Rtotal->count.",
								color: \"#FFB133\",
								titulo: \"".$Emunicipais->entidade_linha_1."\"
							},";	
						}
						
						$sql4 = "SELECT entidade_sigla, entidade_linha_1, entidade_id FROM entidades WHERE entidade_tipo = 6 ORDER BY entidade_linha_1";
						$Torgaos = $drive->pedido($sql4);	
						while($Eorgaos = pg_fetch_object($Torgaos)){
							$qtotal	= "SELECT COUNT(intranet_log_id) FROM intranet_log_acesso WHERE intranet_log_entidade_id = ".$Eorgaos->entidade_id;		
							$Ttotal = $drive->pedido($qtotal);	
							$Rtotal = pg_fetch_object($Ttotal);
							echo"{
								ent: \"".$Eorgaos->entidade_sigla."\",
								acesso: ".$Rtotal->count.",
								color: \"#999999\",
								titulo: \"".$Emunicipais->entidade_linha_1."\"
							},";	
						}	
						?>
						];
			
	

			
						AmCharts.ready(function () {
							// SERIAL CHART
							chart = new AmCharts.AmSerialChart();
							chart.dataProvider = chartData4;
							chart.categoryField = "ent";
							chart.startDuration = 1;
							chart.plotAreaBorderColor = "#DADADA";
							chart.plotAreaBorderAlpha = 1;
							// this single line makes the chart a bar chart          
							chart.rotate = true;
			
							// AXES
							// Category
							var categoryAxis = chart.categoryAxis;
							categoryAxis.gridPosition = "start";
							categoryAxis.gridAlpha = 0.1;
							categoryAxis.axisAlpha = 0;
							categoryAxis.fillColor = "#FAFAFA";
			
							// Value
							var valueAxis = new AmCharts.ValueAxis();
							valueAxis.axisAlpha = 0;
							valueAxis.gridAlpha = 0.1;
							valueAxis.position = "top";
							chart.addValueAxis(valueAxis);
			
							// GRAPHS
							// first graph
							var graph1 = new AmCharts.AmGraph();
							graph1.type = "column";
							graph1.title = "Acessos";
							graph1.valueField = "acesso";
							graph1.balloonText = "Acessos: [[value]]";
							graph1.lineAlpha = 0;
							graph1.colorField = "color";
							
							graph1.fillAlphas = 1;
							chart.addGraph(graph1);								
			
							// WRITE
							chart.write("entidades");
						});
					</script>
                    <div id="entidades" style="width: 100%; height: 1200px;"></div>
                </div>
            </div>            
        </div>
        <?php } ?>          
	</div>
</div>