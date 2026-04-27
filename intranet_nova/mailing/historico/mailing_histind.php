<script>
function habilitaData(){
	document.getElementById('Fdata1').disabled=false;
	document.getElementById('Fdata2').disabled=false;
}
</script>

<?php
require_once("../scripts/php/funcoes.php");
require_once("../scripts/php/paginacao.php");

//--------------------------------------------------------
// faz o controle da paginação (inicio e fim da consulta)
//--------------------------------------------------------
if(!isset($_GET['pg'])){
	$pg = 1;
}else{
	$pg = $_GET['pg'];	
}	
$inicio = ($pg * 20) - 20; 
			
if(!isset($_POST['btConsulta_x'])){
	$sqlHistorico = "SELECT * FROM mailing_historico WHERE mailing_historico_user_id = ".$_SESSION['SuserId']." ORDER BY mailing_historico_id DESC LIMIT 20";
}else{
	$TnotiInicio  = inverteDate($_POST['Fdata1']);
	$TnotiFinal   = inverteDate($_POST['Fdata2']);
	$sqlHistorico = "SELECT * FROM mailing_historico WHERE mailing_historico_user_id = ".$_SESSION['SuserId']." AND mailing_historico_data >= '$TnotiInicio' AND mailing_historico_data <= '$TnotiFinal' ORDER BY mailing_historico_data DESC ";				
}
$TreturnHist = $drive->pedido($sqlHistorico);


//-------------------------------------------------------------------------------------
// se foi feita uma consulta por datas, recupera as datas por uma questão de ergonomia
//-------------------------------------------------------------------------------------
$Tdti = $_POST['Fdata1'];
$Tdtf = $_POST['Fdata2'];
?>
<div class="centro">
    <div id="caminho_migalhas">intranet &gt; mailing</div>
    <div id="titulo_pagina">histórico individual</div>
    <div id="margem_direita"><br />
		<div class="conteudo_abas">  
			<div id="conteudo_localizar" style="display:inline">
				<p><h3>Selecione um período para consultar os mailings enviados.</h3></p>
                Será apresentada uma lista com todas as datas de envio de mailing.<br> 
                Para obter um relatório com notícias enviadas e destinatários, clique sobre o item desejado.<br><br>

				<div class="texto_formulario">Período de Envio:</div>
				<form method="post" action="inicio.php?pagina=mailhistind&menu=<?=$_GET['menu']?>" onsubmit="return habilitaData()">
                    <input name="Fdata1" id="Fdata1" type="text" class="componente_miolo_menor" disabled="disabled" value="<?=$Tdti?>" />
                    <a id="calendar-trigger"><img  align="absmiddle" src="../layout/imagens/atualiza_btn_calendario.jpg" border="0"/></a>
                    
                    <script>
                        Calendar.setup({					
                            inputField : "Fdata1",						 
                            trigger    : "calendar-trigger",
                            onSelect   : function() { this.hide() }
                        });
                    </script>
                    &nbsp;at&eacute;&nbsp; 
                    <input name="Fdata2" id="Fdata2" type="text" class="componente_miolo_menor" disabled="disabled" value="<?=$Tdtf?>"/>
                    <a id="calendar-trigger-2"><img  align="absmiddle" src="../layout/imagens/atualiza_btn_calendario.jpg" border="0"/></a>
                        
                    <script>
                        Calendar.setup({					
                            inputField : "Fdata2",						 
                            trigger    : "calendar-trigger-2",
                            onSelect   : function() { this.hide() }
                        });
                    </script>
                    <br /><br />
                    <input type="image" name="btConsulta" id="btConsulta" src="../layout/imagens/intra_btn_localizar.png" align="absmiddle"/>
          		</form>
			</div>
		</div>
	<div>
	<div id="resultado" style="display:block">   
		<div class="container_2"><br><br><h2>Mailings enviados</h2><br>  
			<table width="600" border="0" cellspacing="0" cellpadding="0">
				<?php
                $i = 0;
				while($Tmailings = pg_fetch_object($TreturnHist)){
					echo "
					<tr>
						<td class=\"container_item_result\">  
							<a href=\"inicio.php?pagina=mailhistpagina&menu=".$_GET['menu']."&mid=".$Tmailings->mailing_historico_id."\"><strong>".inverteDateBd($Tmailings->mailing_historico_data)."</strong></a> 
						</td>
					</tr>";                
				$i++;
				}
				if($i == 0){
					echo "<b>Nenhum Mailing Encontrado.</b>";	
				}  
				?>
			</table>
			<div id="area_paginacao">
				<?php
				if($i != 0){
				//------------------------------------
				// Imprime numumero de paginas rodapé 
				//------------------------------------
					$numPagTotal = pg_fetch_object($TreturnSqlNum);
					echo "<p align=\"center\">";
					$TnumPag = $numPagTotal->count;
					if($TnumPag < 20){
						$TnumPag = 20;
					}
					mostra_paginas($TnumPag, $_GET['pg'], $Tcaminho, 20);
					echo "<p>";				
				}	
				?> 
			</div>
		</div>
	</div>
</div>  
</div>
</div>