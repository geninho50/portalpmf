<script>
function habilitaData(){
	document.getElementById('Fdata1').disabled=false;
	document.getElementById('Fdata2').disabled=false;
}
</script>

<?php
require_once("../scripts/php/funcoes.php");
$TentidadeId = $_SESSION['SuserEnt'];

if(!isset($_POST['btConsulta_x'])){
	$sqlNoticias = "SELECT * FROM noticias WHERE noti_entidade_id = $TentidadeId ORDER BY noti_data DESC LIMIT 30";
}else{
	$TnotiInicio = inverteDate($_POST['Fdata1']);
	$TnotiFinal  = inverteDate($_POST['Fdata2']);
	$sqlNoticias = "SELECT * FROM noticias WHERE noti_entidade_id = $TentidadeId AND noti_data >= '$TnotiInicio' AND noti_data <= '$TnotiFinal' ORDER BY noti_data DESC ";				
}
$TreturnNot	 = $drive->pedido($sqlNoticias);


//-------------------------------------------------------------------------------------
// se foi feita uma consulta por datas, recupera as datas por uma questão de ergonomia
//-------------------------------------------------------------------------------------
$Tdti = $_POST['Fdata1'];
$Tdtf = $_POST['Fdata2'];
?>
<div class="centro">
	<div id="caminho_migalhas">intranet &gt; mailing</div>
	<div id="titulo_pagina">enviar mailing</div>
	<div id="margem_direita">
    	<br />
		<img src="../layout/imagens/intra_mailing_passo1.png" alt="passo 1" border="0" align="absmiddle" />
		<div class="conteudo_abas">  
			<div id="conteudo_localizar" style="display:inline">
			<p><h3>Selecione até 10 notícias para enviar no mailing.</h3></p>
			Abaixo estão listadas as últimas notícias de sua entidade. <br />
			Você também pode usar os campos abaixo para fazer uma consulta por período.<br /><br />
			<div class="texto_formulario">Período de Criação:</div>
			<form method="post" action="inicio.php?pagina=mailenvionot&menu=<?=$_GET['menu']?>" onsubmit="return habilitaData()">
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
		
        <div class="tag_result_busca">Notícias Disponíveis</div>
        <div id="resultado">   
			<div class="container_2">
            	<br /> 
				<form action="?pagina=mailenviodest&menu=<?=$_GET['menu']?>" method="post" >
                <table width="600" border="0" cellspacing="0" cellpadding="0">
					<?php
                    $i = 0;
				    while($Tnoticias = pg_fetch_object($TreturnNot)){
						echo"
						<tr>  
							<td class=\"container_item_result\">
								<a href=\"#N".$Tnoticias->noti_id."\" class=\"fakecheck\"></a>
								<input type=\"checkbox\" style=\"display:none;\" name=\"N".$Tnoticias->noti_id."\" id=\"N".$Tnoticias->noti_id."\" />
							</td>
							<td class=\"container_item_result\">
								<span class=\"titulo_linkserv\">
									<a href=\"./mailing/envio/mailing_notprev.php?KeepThis=true&TB_iframe=true&height=500&width=520&notId=".$Tnoticias->noti_id."\" class=\"thickbox\"> 
										".inverteDateBd($Tnoticias->noti_data)." - ".subString($Tnoticias->noti_titulo, 60)."
									</a>
								</span> 
							</td>
						</tr>
						";
					$i++;
					}   
					?>       
				</table>
               	<?php
                if($i == 0){
					echo "<b>Nenhuma noticia encontrada!</b>";
				}else{
				?>
                <br />                 
				<input type="image" src="../layout/imagens/intra_btn_avancar.png" name="btNoticias" id="btNoticias" align="absmiddle" />
                </form>
                <?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>  

  